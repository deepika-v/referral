<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referfriend extends CI_Controller {


  public function index()
  {
    $this->load->helper('url');
    $this->load->model('Referalmodel');
    //$data["city"]=$this->Referalmodel->get_city();
   $data['viewform']=$value;
    $data["state"]=$this->Referalmodel->get_state();
    $this->load->view('refer_view',$data);
  }
  public function view($universityid,$value)
  {
    $this->load->helper('url');
    $this->load->model('Referalmodel');
    //$data["city"]=$this->Referalmodel->get_city();
      $this->load->helper('shorturl');
   $referralcode=$this->session->userdata['logged_in']['referralcode']; 
  $i=1;
  $universityid = $this->session->userdata['logged_in']['universityid'];
  $url = $this->session->userdata['logged_in']['url'];
  $link = $url."?token=".base64_encode($referralcode)."";
  $keyword = "ref".$this->session->userdata['logged_in']['userid'];
  $sourcelink = shorten_url($link,$keyword);
  //echo "link".$link;
  //echo "keyword".$keyword;
  //echo "sourcelink".$sourcelink;
  //exit;
   $data['viewform']=$value;
   
    $this->load->view('refer_view',$data);
  }


  function add()
  {         $this->load->model('Loginmodel'); 

            $data['uni_details'] = $this->Loginmodel->find_university($this->session->userdata['logged_in']['universityid']);
            $logo = $data['uni_details']->logo;
            $uid = $data['uni_details']->CustomerId;
            $universitylogo = "http://ums.ksouonline.edu.in/Document/Data_".$uid."/".$logo."";
             $this->load->model('Referalmodel');
             $this->load->helper('sms');
             $this->load->helper('shorturl');
             $this->load->helper('referralcode');
             $flag = '1';
             $failedusername = '';
             $username = '';
             $usercount = '0';
             $failedcount = '0';
             $faileduser= array();
             $succededuser=array();
             $k='0';
             $l='0';
             $j='0';
             $keyword = "ref".$this->session->userdata['logged_in']['userid'];
             $post_data = $_POST;
             $referralcode = $this->session->userdata['logged_in']['referralcode'];
             $university = $this->session->userdata['logged_in']['University'];
             $url = $this->session->userdata['logged_in']['url'];
             $discount = 500;
             $universitylink = $url."?token=".base64_encode($referralcode)."";
              $userphoto = $this->session->userdata['logged_in']['userphoto'];

              if($userphoto==''||$userphoto==NULL)$userphoto = base_url('assets/mail_templates/placeholder_avatar.jpg');
             else
             $userphoto = base_url('uploads/userphotos/'.$userphoto);
             //print_r($this->session->userdata['logged_in']['url']);
             //exit;
             $count = count($post_data);
             $detailscount = count($post_data['firstname1']);             
             for($j=0;$j<$detailscount;$j++)
                  { 
                    //;referralcode();
                    if(empty($post_data['chk']))
                    {
                          if($post_data['email1'][$j]!="" || $post_data['mobile1'][$j]!="")
                         { 
                            //s$description = "Refered By:-".$this->session->userdata['logged_in']['FirstName']." ".$this->session->userdata['logged_in']['LastName'];
                            $form_data = array(  'UserID' => $this->session->userdata['logged_in']['userid'],
                                           'UnvId'=>$this->session->userdata['logged_in']['universityid'], 
                                           'Firstname'=>$post_data['firstname1'][$j],
                                            'Lastname'=>$post_data['lastname1'][$j],
                                            'MobileNo'=> $post_data['mobile1'][$j],
                                            'EmailId' =>$post_data['email1'][$j],
                                            'ReferalCode'=>$referralcode,
                                            'Status' =>'I',
                                            'CreatedBy'=>$this->session->userdata['logged_in']['userid'],
                                            'CreatedOn'=>date("Y-m-d H:i:s")); 
                      //print_r($form_data);
                      //exit;                      
                      $enqid = $this->Referalmodel->get_enquiryid($form_data);
                      if($enqid==FALSE)
                      { 
                        $failedcount++;
                        $faileduser[$k]['name'] = $post_data['firstname1'][$j]." ".$post_data['lastname1'][$j];
                        $k++;
                      }
                        else
                       {
                          $usercount++;
                          $succededuser[$l]['name'] = $post_data['firstname1'][$j]." ".$post_data['lastname1'][$j];
                          $l++; 
                          try
                              {                              
                                  $this->load->helper('mail');
                                  $firstname = ucfirst($post_data['firstname1'][$j]);
                                  
                                  $invitationlink = base_url()."Invitation/accept/".str_replace('=','.',base64_encode($enqid));
                                  $to = $post_data['email1'][$j];
                                  $subject = "Enrol for Course at ".$university;
                                  $message = file_get_contents(base_url('assets/mail_templates/reference_submission_referred.html'));
                                  $message = str_replace('#FirstName#',$firstname,$message);
                                  $message = str_replace('#universitylogo#',$universitylogo,$message);
                                  $message = str_replace('#University#',$university,$message);
                                  $message = str_replace('#userphoto#',$userphoto,$message);
                                  $message = str_replace('#Invitation#', $invitationlink,$message);
                                  $message = str_replace('#Discount#', $discount,$message);
                                  //$message = str_replace('#universitylink#', $universitylink,$message);
                                  $message = str_replace('#RefererName#', ucfirst($this->session->userdata['logged_in']['FirstName']),$message);
                                  $cc = '';
                                  $bcc = "";
                                  $altmessage = "";
                                  $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
                                  //echo "referred mail status";
                                  //print_r($status);
                                 //SMS to Referee
                                  if($post_data['mobile1'][$j]!="")
                                  {
                                   $Templatename = "to Referred person";
                                   $univid = $this->session->userdata['logged_in']['universityid'];
                                   $sourcelink = shorten_url($universitylink,$keyword);
                                   $sendsms = send_transactional_sms($post_data['mobile1'][$j],$Templatename,ucfirst($this->session->userdata['logged_in']['FirstName']." ".$this->session->userdata['logged_in']['LastName']),$discount,$sourcelink);
                                  }
                              }
                              catch(Exceptions $ex)
                              {

                              }

                      }
                     }
                    }
                    else
                    {  //echo "in else";
                  //$usercount='0';
                      $chk_count=count($post_data['chk']);
                      //print_r($post_data['chk']);
                      for($a=0;$a<$chk_count;$a++)
                      {
                        if($post_data['email1'][$j]== $post_data['chk'][$a])
                         { 
                          if($post_data['mobile1'][$j]=="")$mobileno = NULL;
                          else $mobileno = $post_data['mobile1'][$j];
                          $form_data = array(  'UserID' => $this->session->userdata['logged_in']['userid'],
                                           'UnvId'=>$this->session->userdata['logged_in']['universityid'], 
                                           'Firstname'=>$post_data['firstname1'][$j],
                                            'Lastname'=>NULL,//$post_data['lastname1'][$j],
                                            'MobileNo'=> $mobileno,//$post_data['mobile1'][$j],
                                            'EmailId' =>$post_data['email1'][$j],
                                            'ReferalCode'=>$referralcode,
                                            'Status' =>'I',
                                            'CreatedBy'=>$this->session->userdata['logged_in']['userid'],
                                            'CreatedOn'=>date("Y-m-d H:i:s")); 
                     
                        //print_r($form_data);
                      $enqid = $this->Referalmodel->get_enquiryid($form_data);
                      //echo "enqid".$enqid;
                      if($enqid==FALSE)
                      { 
                        $failedcount++;
                        $faileduser[$k]['name'] = $post_data['firstname1'][$j]." ".$post_data['lastname1'][$j];
                        $k++;
                      }
                      else
                      {
                        $usercount++;
                        $succededuser[$l]['name'] = $post_data['firstname1'][$j]." ".$post_data['lastname1'][$j];
                        $l++; 
                        try
                            {                              
                              $this->load->helper('mail');
                              $invitationlink = base_url()."Invitation/accept/".str_replace('=','.',base64_encode($enqid));
                              $subject = "Enrol for Course at ".$university;
                              $message = file_get_contents(base_url('assets/mail_templates/reference_submission_referred.html'));
                              $message = str_replace('#FirstName#',$firstname,$message);
                              $message = str_replace('#universitylogo#',$universitylogo,$message);
                              $message = str_replace('#University#',$university,$message);
                              $message = str_replace('#userphoto#',$userphoto,$message);
                              $message = str_replace('#Invitation#', $invitationlink,$message);
                              $message = str_replace('#Discount#', $discount,$message);
                              //$message = str_replace('#universitylink#', $universitylink,$message);
                              $message = str_replace('#RefererName#', ucfirst($this->session->userdata['logged_in']['FirstName']),$message);
                              $to = $post_data['email1'][$j];
                              $subject = "Enrol for Course at ".$university;
                              $cc = '';
                              $bcc = "";
                              $altmessage = "";
                              $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
                              //echo "referred mail status";
                              //print_r($status);
                              if($post_data['mobile1'][$j]!="")
                              {
                                  $Templatename = " to Referred person";
                                  $univid = $this->session->userdata['logged_in']['universityid'];
                                  //$firstname = ucfirst($post_data['firstname1'][$j]);
                                  $sourcelink = shorten_url($universitylink,$keyword);
                                  $sendsms = send_transactional_sms($post_data['mobile1'][$j],$Templatename,ucfirst($this->session->userdata['logged_in']['FirstName']." ".$this->session->userdata['logged_in']['LastName']),$discount,$sourcelink);
                              }
                             }
                            
                            
                            catch(Exceptions $ex)
                            {

                            }

                      }
                    }

                      }


               
                    }
                 }
                      
                  if($failedcount!=0 && $usercount==0)
                      {
                        for($p=0;$p<count($faileduser);$p++)
                        {
                           $failedusername .= $faileduser[$p]['name'].", ";

                        }

                          $text = '<div class="alert alert-danger alert-dismissible text-center flashdata">You have referred '.$failedusername.' earlier for '.ucfirst($this->session->userdata['logged_in']['UniversityName']).'</div>';

                        
                      }
                       if($usercount!=0)
                      {
                        for($p=0;$p<count($succededuser);$p++)
                        {
                           $username .= $succededuser[$p]['name'];

                        }
                        if($failedcount=="0")
                        $text = '<div class="alert alert-success alert-dismissible text-center flashdata">You have successfully referred '.$usercount.' friend</div>';
                        else
                         $text = '<div class="alert alert-success alert-dismissible text-center flashdata">You have successfully referred '.$usercount.' friend.<br>
                                     <p>And You have referred '.$failedusername.' earlier for '.ucfirst($this->session->userdata['logged_in']['UniversityName']).'</p></div>'; 
                         try
                            {                              
                              $this->load->helper('mail');
                              $firstname = ucfirst($this->session->userdata['logged_in']['FirstName']);
                              $statuslink = base_url()."Login/".$this->session->userdata['logged_in']['universityid'];
                              $statusimage = base_url('assets/mail_templates/status.png');
                              $to = $this->session->userdata['logged_in']['Emailid'];
                              $subject = "Thank you for referring friends";
                              $message = file_get_contents(base_url('assets/mail_templates/reference_submission_referrer.html'));
                              $message = str_replace('#FirstName#',$firstname,$message);
                              $message = str_replace('#University#',$university,$message);
                              $message = str_replace('#statuslink#', $statuslink,$message);
                              $message = str_replace('#statusimage#', $statusimage,$message);
                              $message = str_replace('#universitylogo#',$universitylogo,$message);
                              //$message = str_replace('#RefererName#', ucfirst($this->session->userdata['logged_in']['FirstName']." ".$this->session->userdata['logged_in']['LastName']));
                              $cc = '';
                              $bcc = "";
                              $altmessage = "";
                              $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
                              //print_r($status);

                              if($this->session->userdata['logged_in']['MobileNo']!="")
                               { 
                                   $Templatename = "Referrer submission";
                                   $univid = $this->session->userdata['logged_in']['universityid'];
                                   $sourcelink = base_url()."Login/$univid";
                                   $sendsms = send_transactional_sms($this->session->userdata['logged_in']['MobileNo'],$Templatename,$firstname,$university,$sourcelink);
                               }
                            }
                            catch(Exceptions $ex)
                            {

                            }
                      }
                      $this->session->set_flashdata('msg', $text);
                      redirect(base_url().'Referfriend/view/'.$this->session->userdata['logged_in']['universityid'].'/0');
                      
                    
     }
}
?>
