<?php
//ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Progress_support extends CI_Controller {
  

  public function index()
  {
    

    
  }

  public function hidecontact($referalID)
  {
    $this->load->model('Referalmodel');

    $request = $this->Referalmodel->hide_contact($referalID);
    echo $request;
  }
   public function showcontact($referalID)
  {
    $this->load->model('Referalmodel');

    $request = $this->Referalmodel->show_contact($referalID);
    echo $request;
  }
   public function sendreminder($universityid,$referalID,$firstname,$MobileNo)
  {
    try
       {      
        $emailid= $_POST['emailid'];                        
        $status= $_POST['status'];   
        //echo $emailid;
        //echo $status;
        //exit;
        $this->load->helper('mail');
        $firstname = ucfirst($firstname);
                              $university = $this->session->userdata['logged_in']['UniversityName'];
                              $url = $this->session->userdata['logged_in']['url'];
                              $to = $emailid;
                              if($status==''|| $status=='R')
                              {
                                $formalities = "<br><ol><li>Fill Admission Form</li><li>Pay Fees</li><li>Verify Documents</li></ol><br>";
                                 $message = file_get_contents(base_url('assets/mail_templates/send_reminder.html'));
                              $message = str_replace('#FirstName#',$firstname,$message);
                              $message = str_replace('#UnivName#',$university,$message);
                              $message = str_replace('#Formalities#',$formalities,$message);
                              $message = str_replace('#University#', $this->session->userdata['logged_in']['universitylink'],$message);
                              $message = str_replace('#RefererName#', ucfirst($this->session->userdata['logged_in']['FirstName']." ".$this->session->userdata['logged_in']['LastName']),$message);
                              }
                              else if ($status == ('A' || 'B' || 'C' || 'D' || 'E' || 'Y'))
                              {
                                $formalities = "<br><ol><li>Pay Fees</li><li>Verify Documents</li></ol></br>";
                                 $message = file_get_contents(base_url('assets/mail_templates/send_reminder.html'));
                              $message = str_replace('#FirstName#',$firstname,$message);
                              $message = str_replace('#UnivName#',$university,$message);
                              $message = str_replace('#Formalities#',$formalities,$message);
                              $message = str_replace('#University#', $this->session->userdata['logged_in']['universitylink'],$message);
                              $message = str_replace('#RefererName#', ucfirst($this->session->userdata['logged_in']['FirstName']." ".$this->session->userdata['logged_in']['LastName']),$message);
                              }
                              else
                              {
                                $formalities = "<br><ol><li>Verify Documents</li></ol></br>";
                                 $message = file_get_contents(base_url('assets/mail_templates/send_reminder.html'));
                              $message = str_replace('#FirstName#',$firstname,$message);
                              $message = str_replace('#UnivName#',$university,$message);
                              $message = str_replace('#Formalities#',$formalities,$message);
                              $message = str_replace('#University#', $this->session->userdata['logged_in']['universitylink'],$message);
                              $message = str_replace('#RefererName#', ucfirst($this->session->userdata['logged_in']['FirstName']." ".$this->session->userdata['logged_in']['LastName']),$message);
                              }

                              $subject = "Reminder mail from ".$university;
                             
                              $cc = '';
                              $bcc = "";
                              $altmessage = "";
                              $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
                              echo $status;//"referred mail status";
                              //print_r($status);
                             /* if($MobileNo!="")
                              {
                                  $Templatename = "Referred to person";
                                  $univid = $this->session->userdata['logged_in']['universityid'];
                                  //$firstname = ucfirst($post_data['firstname1'][$j]);
                                  $sourcelink = shorten_url($link);
                                  $sendsms = send_transactional_sms($MobileNo,$Templatename,ucfirst($this->session->userdata['logged_in']['FirstName']." ".$this->session->userdata['logged_in']['LastName']),$university,$sourcelink);
                              }*/
                             }
                            
                            
                            catch(Exceptions $ex)
                            {

                            }

   
  }
 public function Send_request()
  {
    $userid = $this->session->userdata['logged_in']['userid'];
    $cash = $this->input->post('total_cash');
    $universityid = $this->session->userdata['logged_in']['universityid'];
    $this->load->model('Referalmodel');
    $request = $this->Referalmodel->Send_request($userid,$cash);
    if ($request == '1')
    {
      $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Request sent successfully.</div>');
      redirect('Progress/'.$universityid.'/');
    }else
    {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Failed to connect.</div>');
      redirect('Progress'.$universityid.'/');
    }
  }
  public function request()
  {
    $this->load->model('Referalmodel');
    $userid = $this->session->userdata['logged_in']['userid'];
    $query = $this->Referalmodel->get_totalamount($userid);
    $data['total_amount'] = $query->bonus; 
    $sql = $this->Referalmodel->get_approvedamount($userid);
    $data['approved_amount'] = $sql->bonus;
    $q= $this->Referalmodel->get_redeemamount($userid);
    $redeem_amt = $q->Amount;
    $data['approved_amount'] = $sql->bonus-$redeem_amt;
    $data['redeemed_amount'] = $redeem_amt;
    $this->load->view("request_view",$data);
  }
  public function Claim_request($min_amount,$amount,$redeem_amt)
  {
     //echo "in Claim_request";
    
    $this->load->helper('mail');
    $this->load->model('Referalmodel');
    $userid = $this->session->userdata['logged_in']['userid'];
    $uname = $this->session->userdata['logged_in']['UniversityName'];
    $uid = $this->session->userdata['logged_in']['universityid'];
    $link = base_url('/Login/'.$uid);
    $query = $this->Referalmodel->get_claimuserdetails($userid);
    $fname = $query->FirstName;
    $lname = $query->LastName;
    $name = $fname.' '.$lname;
    $to = $query->EmailID;
    $cc = '';
    $bcc = '';
    $subject = 'Redemption request submission';
    $message = file_get_contents(base_url().'assets/mail_templates/request.html');
    $message = str_replace('#Name#',$name,$message);
    $message = str_replace('#Amount#',$amount,$message);      
    $message = str_replace('#Link#',$link,$message);    
    $message = str_replace('#UnivName#',$uname,$message);     
    $altmessage = '';            
    
    if ($amount>$min_amount) {
      echo "<span class='text-red'>*Amount should be less than approved amount.</span>";
      die();
    }
    if ($amount<500) {
      echo "<span class='text-red'>*You can claim minimum 500 <i class='fa fa-fw fa-rupee'></i>.</span>";
      die();
    }
    if ($redeem_amt>=$min_amount) {
      echo "<span class='text-red'>*You have claimed your redemption</i>.</span>";
      die();
    }

    
    $request = $this->Referalmodel->Send_request($userid,$amount);
     //echo $request;
     //exit;
    if ($request == TRUE)
    {

      $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
      
      if ($status == 1) {
    echo "<span class='text-green'>Request has been sent successfully.</span>";
      }else{
        echo "<span class='text-red'>Something went wrong.Please,try again later.</span>";
      }
     
    
    }
    else
    {
      echo "<span class='text-red'>Something went wrong.Please,try again later.</span>";
    }
    
  }

  


 
  
 
}
