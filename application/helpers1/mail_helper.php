<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('sendemail'))
{
    function sendemail($to, $cc,$bcc,$subject,$message, $altmessage)
    {
        try{

                  require_once('PHPMailer/class.phpmailer.php');
                  require_once('PHPMailer/PHPMailerAutoload.php');
                
                  $mail = new PHPMailer(true); 
                  $mail->CharSet="windows-1251";
                  $mail->CharSet="utf-8";
                  $mail->IsSMTP();
                  $mail->Host = "smtp.gmail.com";
                  $mail->SMTPAuth   = true;                  // enable SMTP authentication
                  $mail->Port       = 587;                    // set the SMTP port for the server
                  $mail->Username   = "noreply@schoolguru.in"; // SMTP account username
                  $mail->Password   = "No@123sg";        // SMTP account password
                  $mail->AddAddress($to); //email address of receiver
                  $mail->SetFrom('noreply@schoolguru.in', 'Referral Program'); //email address of sender
                  $mail->isHTML(true);  
                  $mail->SMTPSecure = 'tls';
                  $mail->Subject = $subject;
                  if($cc!="") $mail->AddCC($cc);
                  if($bcc!="") $mail->AddBCC($bcc);
                  $mail->Body = ($message);
                  $mail->AltBody  = $altmessage;            
                  $status = $mail->send();
                  //$mail->SMTPDebug = 2;
                  //echo $status;
                  //exit;
                  return $status;
            }catch (phpmailerException $e)
            { //echo "<pre>"; 
              return $e;              //echo "</pre>";
                    //echo $e->errorMessage(); //Pretty error messages from PHPMailer
            } catch(Execptions $ex)
            {
   

            }  
        
    }
}

/* End of file mail_helper.php */
/* Location: ./system/helpers/mail_helper.php */
