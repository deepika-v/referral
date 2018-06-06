<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Invitation extends CI_Controller {

	public function accept()
	{
	
	$this->load->helper('url');
	$string = $this->uri->segment(3);
	
	
	$dec_id = str_replace(".","=",$string);
    $id = base64_decode($dec_id);
    
	
    //$id= 123;

    $query = $this->db->query("select * from ref_referals where referalID = ".$id)->row();
    $find_uni = $this->db->query("select * from customers where CustomerId = ".$query->UnvId)->row();
    $shortname = $find_uni->SiteName;
    $lms_link = $find_uni->LmsURL;
    $ref_code = $query->ReferalCode;
    $ref_id = base64_encode($ref_code);
    $token = str_replace('=','.', $ref_id);

    $ums_link = str_replace('lms','ums',$lms_link);
    $link = $ums_link."/web/checklistform.aspx?token=".$token;
    
    $data['id'] = $id;
    $data['fname'] = $query->FirstName;
    $data['lname'] = $query->LastName;
    $data['number'] = $query->MobileNo;
    $data['Email'] = $query->EmailId; 
    $data['Uni'] = $query->UnvId;
    $data['logo'] = $find_uni->logo;
    $data['Uname'] = $find_uni->CustomerName;
    $data['uid'] = $find_uni->CustomerId;
    $data['link'] = $link;
    $data['shortname'] = $shortname;
    $data['status'] = $query->Status;
    
    $this->load->view('invitation_view',$data);
  }

  public function accept_invitation(){
    
    $this->load->helper('sms');
    $this->load->helper('shorturl');
    $this->load->helper('referralcode');
    $this->load->helper('mail');
    
    $id = $this->input->post('id');
    $uid = $this->input->post('uid');
    $link = $this->input->post('link');
    $shortname = $this->input->post('shortname');
    $fname = $this->input->post('fname');
    $lname = $this->input->post('lname');
    $email = $this->input->post('email');
    $number = $this->input->post('number');
    $uname = $this->input->post('uname');


    $update_status = $this->db->query("UPDATE ref_referals SET FirstName = '$fname',
     LastName = '$lname', MobileNo = '$number', EmailId = '$email', Status = 'A', ModifiedOn = now()
     WHERE referalID = ".$id);
    if ($update_status) {
      $to = $email;
      $subject = "Referral invitation confirmation";
      $message = file_get_contents(base_url('assets/mail_templates/invitation.html'));
      $message = str_replace('#FirstName#',$fname, $message);
      $message = str_replace('#Link#',$link, $message);
      $message = str_replace('#UnivName#',$uname, $message);
      $message = str_replace('#shortname#',$shortname, $message);
      $cc = '';
      $bcc = "";
      $altmessage = "";
      
      $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
      $Templatename = "Accept Invitation";
      $sendsms = send_transactional_sms($number,$Templatename,'',$shortname,'');
	
      echo "<p class='text-aqua text-center lead'>Thank you for accepting invitation!</p><p class='lead text-center'><a href='".$link."'>Click here </a> to continue.</p>";
      
    }else{
      echo "Connection error found. Please, try again later";
    }

  }

}
