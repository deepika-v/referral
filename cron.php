<?php
include('./application/config/web_config.php');
include('./application/config/database.php');
$GLOBALS['sender_emailid'] = $config['sender_emailid'];
$GLOBALS['sender_name']=$config['sender_name'];
$GLOBALS['smtp_host'] = $config['smtp_host'];
$GLOBALS['smtp_port'] = $config['smtp_port'];
$GLOBALS['smtp_username'] = $config['smtp_username'];
$GLOBALS['smtp_password'] = $config['smtp_password'];

$GLOBALS['conn'] = mysqli_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password'],$db['default']['database']);
$GLOBALS['baseurl']="http://localhost/referralsystem1/";
$data = get_userdetails($conn);
$count = count($data);
 for($i=0;$i<$count;$i++)
 { 
    $userid = $data[$i]['UserID'];
    $pendinginvites=get_pendinginvites($userid);
    $acceptedinvites=get_acceptedinvites($userid);

    $totalearnedcashed=  get_totalearnedcash($userid);
    $approvecash = get_approvedcash($userid);
    $redeemcash=  get_redeemcash($userid);
    $approvedcashed= $approvecash-$redeemcash;
    if($totalearnedcashed <=0 ||$totalearnedcashed=='' ) $totalearnedcashed = "0";
    if($redeemcash <=0 || $redeemcash=='') $redeemcash = "0";
    if($approvedcashed <=0 || $approvedcashed=='') $approvedcashed = "0";

    echo "<br>totalearnedcashed =".$totalearnedcashed;
    echo "<br>approvecash =".$approvecash;
    echo "<br>redeemcash =".$redeemcash;
    echo "<br>approvedcashed=".$approvedcashed;
    
    $totalinvities = get_totalinvites($userid);
    $pendingadmissions = get_pendingadmissions($userid);
    $university[$i] = get_universitydetails($data[$i]['UnivId']);
    $referraldetails[$i] = get_referraldetails($data[$i]['UserID']);
     if(stristr($university[$i]['0']['LmsURL'],'lms1'))
                        $url = str_replace('lms1','ums',$university[$i]['0']['LmsURL']);
                      else if(stristr($university[$i]['0']['LmsURL'],'lms'))
                        $url = str_replace('lms','ums',$university[$i]['0']['LmsURL']);
    $universitylogo = $url."/Document/Data_".$university[$i]['0']['UnvId']."/".$university[$i]['0']['logo'];
    $day = date("D"); 
    if($day == 'Tue')
    { 
                 send_statusmail($data[$i]['Firstname'],
                      $data[$i]['EmailId'],
                      $pendinginvites,
                      $acceptedinvites,
                      $totalearnedcashed,
                      $approvedcashed,
                      $redeemcash,
                      $pendingadmissions,
                      $totalinvities,
                      $university[$i]['0']['University'],
                      $university[$i]['0']['UnvId'],
                      $universitylogo);
    }    
 }
$referralcount = count($referraldetails);
for($i=0;$i<$referralcount;$i++)
{    
  $arraycount = count($referraldetails[$i]);
  for($j=0;$j<$arraycount;$j++) 
  {
    $date2 = $referraldetails[$i][$j]['CreatedOn'];
$date1 = date("Y-m-d H:i:s");
$datetimeObj1 = new DateTime($date1);
$datetimeObj2 = new DateTime($date2);
$interval = $datetimeObj1->diff($datetimeObj2);
$dateDiff = $interval->format('%R%a');

if($dateDiff == "-2") 
  {
    $discount = get_discount($referraldetails[$i][$j]['UnvId']);
    if($referraldetails[$i][$j]['Status']=="I")
      {
         send_acceptinvitation_mail(
            $referraldetails[$i][$j]['Firstname'],
            $referraldetails[$i][$j]['EmailId'],
            $referraldetails[$i][$j]['referrerfname'],
            $discount,
            $university[$i]['0']['University'],
            $universitylogo,
            $referraldetails[$i][$j]['referalID']);
  }        
    else if($referraldetails[$i][$j]['Status']=="A")
    {    
        send_admissionlink_mail(
            $referraldetails[$i][$j]['Firstname'],
            $referraldetails[$i][$j]['EmailId'],
            $referraldetails[$i][$j]['referrerfname'],
            $discount,
            $university[$i]['0']['University'],
            $universitylogo,
            $referraldetails[$i][$j]['referalID']);            
    }
   }
 }
}

 mysqli_close($GLOBALS['conn']);
 
 function send_statusmail($firstname,$emailid,$pendinginvites,$acceptedinvites,$totalearnedcashed,$approvedcashed,$redeemcash,
                          $pendingadmissions, $totalinvities,$universityname,$universityid,$universitylogo)
 { 
    $statuslink = $GLOBALS['baseurl']."/Registration/".$universityid;
    $firstname = ucfirst( $firstname);
    $to = $emailid;
    $subject = "Weekly Status for Referral Program of ".$universityname;
    $message = file_get_contents('./assets/mail_templates/status_mail.html');
    $message = str_replace('#referrer#',$firstname,$message);
    $message = str_replace('#universitylogo#',$universitylogo,$message);
    $message = str_replace('#University#',$universityname,$message);
    $message = str_replace('#pendinginvities#',$pendinginvites,$message);
    $message = str_replace('#acceptedinvities#',$acceptedinvites,$message);
    $message = str_replace('#totalinvities#',$totalinvities,$message);
    $message = str_replace('#totalearnedcash#',$totalearnedcashed,$message);
    $message = str_replace('#approvedcash#',$approvedcashed,$message);
    $message = str_replace('#redeemcash#',$redeemcash,$message);
    $message = str_replace('#pendingadmissions#', $pendingadmissions,$message);
    $message = str_replace('#statuslink#', $statuslink,$message);
    $cc = '';
    $bcc = "";
    $altmessage = "";
    $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
    
 }
function sendemail($to, $cc,$bcc,$subject,$message, $altmessage)
    {
        try{

                  require_once('PHPMailer/class.phpmailer.php');
                  require_once('PHPMailer/PHPMailerAutoload.php');
                  //echo "in sendmail<br>";
                  //echo "sender_emailid".$config['sender_emailid'];
                  //echo "sender_sendername".$config['sender_name'];

                  $mail = new PHPMailer(true); 
                  $mail->CharSet="windows-1251";
                  $mail->CharSet="utf-8";
                  $mail->IsSMTP();
                  $mail->Host = $GLOBALS['smtp_host'];
                  $mail->SMTPAuth   = true;                  // enable SMTP authentication
                  $mail->Port       = $GLOBALS['smtp_port'];                    // set the SMTP port for the server
                  $mail->Username   = $GLOBALS['smtp_username']; // SMTP account username
                  $mail->Password   = $GLOBALS['smtp_password'];        // SMTP account password
                  $mail->AddAddress($to); //email address of receiver
                  $mail->SetFrom($GLOBALS['sender_emailid'],$GLOBALS['sender_name']); //email address of sender
                  $mail->isHTML(true);  
                  $mail->SMTPSecure = 'tls';
                  $mail->Subject = $subject;
                  if($cc!="") $mail->AddCC($cc);
                  if($bcc!="") $mail->AddBCC($bcc);
                  $mail->Body = ($message);
                  $mail->AltBody  = $altmessage;            
                  $status = $mail->send();
                  echo "status:-". $status;
                  return $status;
            }catch (phpmailerException $e)
            { 
              //print_r($e);
              return $e;   
            } catch(Execptions $ex)
            {
   

            }  
        
    }
function  send_acceptinvitation_mail($firstname,$emailid,$referrerfname, $discount,$universityname, $universitylogo, $referalID)
{
    try {

    $firstname = ucfirst($firstname);
    $to = $emailid;
    $statuslink = $GLOBALS['baseurl']."Invitation/accept/".str_replace('=','.',base64_encode($referalID));
    $subject = "Enrol for course at ".$universityname;
    $message = file_get_contents('./assets/mail_templates/cron_acceptinvitation.html');
    $message = str_replace('#referalname#',$firstname,$message);
    $message = str_replace('#universitylogo#',$universitylogo,$message);
    $message = str_replace('#University#',$universityname,$message);
    $message = str_replace('#ReferrerName#',$referrerfname,$message);
    $message = str_replace('#discount#',$discount,$message);
    $message = str_replace('#statuslink#', $statuslink,$message);
    $cc = '';
    $bcc = "";
    $altmessage = "";
    $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
   } catch (Exception $e)
      {

        
      }

}
function  send_admissionlink_mail($firstname,$emailid,$referrerfname, $discount,$universityname, $universitylogo, $referalID)
{
    try {

    $firstname = ucfirst($firstname);
    $to = $emailid;
    $statuslink = $GLOBALS['baseurl']."Invitation/accept/".str_replace('=','.',base64_encode($referalID));
   $subject = "Enrol for course at ".$universityname;
   $message = file_get_contents('./assets/mail_templates/cron_admissionlink.html');
    $message = str_replace('#referalname#',$firstname,$message);
    $message = str_replace('#universitylogo#',$universitylogo,$message);
    $message = str_replace('#University#',$universityname,$message);
    $message = str_replace('#ReferrerName#',$referrerfname,$message);
    $message = str_replace('#discount#',$discount,$message);
    $message = str_replace('#statuslink#', $statuslink,$message);
    $cc = '';
    $bcc = "";
    $altmessage = "";
    $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
     } catch (Exception $e)
      {
        
      }

}
function get_userdetails()
{
 try {
        $i=0;
       $sql = mysqli_query($GLOBALS['conn'],"SELECT * FROM `ref_registereduser` WHERE IsOTPVerified = '1'");
         while ($result = mysqli_fetch_assoc($sql))
         {
            $data[$i]['Firstname']= $result['FirstName'];
            $data[$i]['Lastname']= $result['LastName'];
            $data[$i]['MobileNo']= $result['MobileNo'];
            $data[$i]['EmailId']= $result['EmailID'];
            $data[$i]['UnvId']= $result['UnivId'];
            $data[$i]['UserID']= $result['UserID'];
            $data[$i]['Referralcode']=$result['Referralcode'];
            $data[$i]['IsOTPVerified']=$result['IsOTPVerified'];
            $i++;
         }
         //print_r($result);
        //print_r($data);
         //mysqli_close($GLOBALS['conn']);
       return $data;
      } catch (Exception $e)
      {

        
      }
}
function get_universitydetails($unvid)
{
 try {
    $i=0;
       $sql = mysqli_query($GLOBALS['conn'],"SELECT gen_university.UnvId, gen_university.University, gen_university.UniversityName,customers.LmsURL,customers.CustomerName,customers.website,customers.logo
                                  FROM `gen_university`
                                  JOIN customers ON customers.CustomerId = gen_university.UnvId
                                  where gen_university.UnvId = '$unvid'");
         while ($result = mysqli_fetch_assoc($sql))
         {
            $data[$i]['UnvId']= $result['UnvId'];
            $data[$i]['University']= $result['University'];
            $data[$i]['UniversityName']= $result['UniversityName'];
            $data[$i]['LmsURL']= $result['LmsURL'];
            $data[$i]['CustomerName']= $result['CustomerName'];
            $data[$i]['website']= $result['website'];
            $data[$i]['logo']=$result['logo'];
            //$data[$i]['IsOTPVerified']=$result['IsOTPVerified'];
            $i++;
         }
        
       return $data;
      } catch (Exception $e)
      {

        
      }
}

function get_referraldetails($userid)
{
    
    try {
         $i=0;
         $q="SELECT ref_referals.referalID,ref_referals.FirstName,ref_referals.LastName,ref_referals.MobileNo,
ref_referals.EmailId, ref_referals.UnvId,ref_referals.CreatedOn,ref_referals.Status,
ref_referals.ReferalCode,ref_referals.IsVisible, ref_registereduser.FirstName As referrerfname,
ref_registereduser.LastName As referrerlname
FROM `ref_referals` JOIN ref_registereduser ON ref_registereduser.UserID = ref_referals.UserID
where ref_referals.Status IN ('I','A') AND ref_referals.UserID='$userid' AND ref_referals.CreatedOn >= DATE_SUB(NOW(),INTERVAL 5 day)";
          $sql = mysqli_query($GLOBALS['conn'],$q);
          while ($result = mysqli_fetch_assoc($sql))
         {  
            $data[$i]['referalID']=$result['referalID'];
            $data[$i]['Firstname']=$result['FirstName'];
            $data[$i]['Lastname']=$result['LastName'];
            $data[$i]['MobileNo']=$result['MobileNo'];
            $data[$i]['EmailId']=$result['EmailId'];
            $data[$i]['Status']=$result['Status'];
            $data[$i]['UnvId']=$result['UnvId'];
            $data[$i]['CreatedOn']=$result['CreatedOn'];
            $data[$i]['IsVisible']=$result['IsVisible'];
            $data[$i]['referrerfname']=$result['referrerfname'];
            $data[$i]['referrerlname']=$result['referrerlname'];
            $i++;
         }
        return $data;
        
        } catch (Exception $e)
        {
          echo $e->getMessage() . "\n";
        }
}


function get_totalinvites($userid)
{
    try {
         $sql = mysqli_query($GLOBALS['conn'],"SELECT Count(*) As count FROM `ref_referals` where UserID='$userid'");
         while ($result = mysqli_fetch_assoc($sql))
            $total = $result['count'];
         
        return $total;
        
        } catch (Exception $e)
        {
          echo $e->getMessage() . "\n";
        }
}
function get_pendinginvites($userid)
{
    try {
          $sql = mysqli_query($GLOBALS['conn'],"SELECT Count(*) As count FROM `ref_referals` where UserID='$userid' AND Status='I'");
         while ($result = mysqli_fetch_assoc($sql))
                  $pending = $result['count'];
         
         return $pending;
        
        } catch (Exception $e)
        {
          echo $e->getMessage() . "\n";
        }
}
function get_acceptedinvites($userid)
{
    try {
         $sql = mysqli_query($GLOBALS['conn'],"SELECT Count(*) As count FROM `ref_referals` where UserID='$userid' AND Status='A'");
         
         while ($result = mysqli_fetch_assoc($sql))
            $accept = $result['count'];         
         
         return $accept;
        } catch (Exception $e)
        {
          echo $e->getMessage() . "\n";
        }
   

}
function get_discount($unvid)
{
    try {
             $sql = mysqli_query($GLOBALS['conn'],"SELECT * FROM `fees_referraldiscount` WHERE UnvId='$unvid' ORDER By WEF DESC LIMIT 1");
             
             while ($result = mysqli_fetch_assoc($sql))
             $discount = $result['Discount'];         
                      
             return $discount;
                 
        } catch (Exception $e)
        {
              echo $e->getMessage() . "\n";
        }
   

}
function get_totalearnedcash($userid)
{
    try {
         $sql = mysqli_query($GLOBALS['conn'],"SELECT
                                    ref_referals.UserID,
                                    ref_referals.IsVisible,
                                    referalID,
                                    std_admission.UnvId,
                                    enq_enquiry.Firstname,
                                    enq_enquiry.Lastname,
                                    enq_enquiry.EmailId,
                                    enq_enquiry.MobileNo,
                                    ref_referals.EnquiryId,
                                    std_admission.Status,
                                    fees_referraldiscount.WEF,
                                    fees_referraldiscount.Discount,
                                    sum(fees_referraldiscount.Bonus) as bonus
                                FROM
                                    ref_referals
                                        LEFT JOIN
                                    enq_enquiry ON ref_referals.EnquiryId = enq_enquiry.EnquiryId
                                        LEFT JOIN
                                    std_admission ON std_admission.EnquiryId = ref_referals.EnquiryId
                                        LEFT JOIN
                                    fees_referraldiscount ON fees_referraldiscount.UnivId =  ref_referals.UnvId
                                WHERE
                                    ref_referals.UserID = '$userid'");
                     while ($result = mysqli_fetch_assoc($sql))         
                        $bonus = $result['bonus'];
         
                     return $bonus;
           } catch (Exception $e) 
           {
        
           }

}
function get_approvedcash($userid)
{
    try {
         $sql = mysqli_query($GLOBALS['conn'],"SELECT
                                    ref_referals.UserID,
                                    ref_referals.IsVisible,
                                    ref_referals.Status as referalstatus,
                                    referalID,
                                    std_admission.UnvId,
                                    enq_enquiry.Firstname,
                                    enq_enquiry.Lastname,
                                    enq_enquiry.EmailId,
                                    enq_enquiry.MobileNo,
                                    ref_referals.EnquiryId,
                                    std_admission.Status,
                                    fees_referraldiscount.WEF,
                                    sum(fees_referraldiscount.Bonus) as bonus
                                FROM
                                    ref_referals
                                        LEFT JOIN
                                    enq_enquiry ON ref_referals.EnquiryId = enq_enquiry.EnquiryId
                                        LEFT JOIN
                                    std_admission ON std_admission.EnquiryId = ref_referals.EnquiryId
                                        LEFT JOIN
                                    fees_referraldiscount ON fees_referraldiscount.UnivId =  ref_referals.UnvId
                                WHERE
                                    ref_referals.UserID = ".$userid ." AND std_admission.Status IN ('C','D','E','Y')");
                     while ($result = mysqli_fetch_assoc($sql))         
                        $bonus = $result['bonus'];
         
                     return $bonus;
           } catch (Exception $e) 
           {
        
           }

}
function get_redeemcash($userid)
{
    try {
         $sql = mysqli_query($GLOBALS['conn'],"SELECT SUM(Amount) as Amount FROM `ref_request_redemption` WHERE ref_request_redemption.UserID ='$userid'");
                     while ($result = mysqli_fetch_assoc($sql))         
                        $bonus = $result['Amount'];
         
                     return $bonus;
           } catch (Exception $e) 
           {
        
           }

}

function get_pendingadmissions($userid)
{
    try {
          $sql = mysqli_query($GLOBALS['conn'],"SELECT Count(*) As count FROM `ref_referals` where UserID='$userid' and UnvId = $universityid AND (Status='I' OR Status='A')");
         while ($result = mysqli_fetch_assoc($sql))
         {
            $pendingadmissions = $result['count'];
         }
          return $pendingadmissions;
         } catch (Exception $e)
          {
              echo $e->getMessage() . "\n";
          }
}
?>
