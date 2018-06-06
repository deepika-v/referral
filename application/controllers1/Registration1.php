<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors', 1);
 
class Registration extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->helper('sms');
          $this->load->helper('referralcode');
          $this->load->database();
          $this->load->library('form_validation');
          $this->load->library('Curl');
          //load the login model
          $this->load->model('Loginmodel');
     }

     public function index()
     {  
        $uid = $this->uri->segment(2);
        $data['universityid']= $uid;
        $data['uni_details'] = $this->Loginmodel->find_university($uid);
        $data['city'] = $this->Loginmodel->select_city();
        $this->load->view('Register_view',$data);          
     }

     public function add_member($universityid){
      $terms = $this->input->post('terms');
      if ($terms == '') {
        echo "<span>*You must accept terms and conditions.</span>";
        die();
      }
      
      //$universityid = $this->input->post('universityid');
      $fname = $this->input->post('first_name');
      $lname = $this->input->post('last_name');
      $primary_email = $this->input->post('primary_email');
      $secondary_email = $this->input->post('secondary_email');
      $primary_number = $this->input->post('primary_number');
      $secondary_number = $this->input->post('secondary_number');
      $password = md5($this->input->post('password'));
      $confirm_password = md5($this->input->post('confirm_password'));
      $address = $this->input->post('address');
      $city = $this->input->post('city');
      $pin_code = $this->input->post('pin_code');
      $string = '0123456789';
      $string_shuffled = str_shuffle($string);
      $otp = substr($string_shuffled, 1, 6);
      $query = $this->db->query('select * from ref_registereduser where MobileNo = '.$primary_number.' AND UnvId= '.$universityid.'');
      $check_num = $query->num_rows();
      $this->session->set_userdata('mobile', $primary_number);
      $this->session->set_userdata('universityid', $universityid);
      
      if ($check_num == '1' ) {
        $check_otp = $query->row();
        $otp_verify = $check_otp->IsOTPVerified;
        if ($otp_verify == 0) {
          //echo $universityid;
          echo "<span>You are already register with us. Please confirm your OTP once.</span><a href='".base_url()."Registration/verify_otp/".$universityid."'>Click here for verify now</a>";
        die();
        }
      }
      if ($check_num > 0 ) {
        echo "<span>*Mobile number already registered.</span>";
        die();
      }
      if ($fname == '') {
        echo "<span>*First name is required</span>";
        die();
      }
      if ($lname == '') {
        echo "<span>*Last name is required</span>";
        die();
      }
      if ($primary_email == '') {
        echo "<span>*Emailid  is required</span>";
        die();
      }
      if ($primary_number == '') {
        echo "<span>*Mobile is required</span>";
        die();
      }
      if ($city == '') {
        echo "<span>*Please select city from list</span>";
        die();
      }
      if ($pin_code == '') {
        echo "<span>*Pin code can not be empty.</span>";
        die();
      }
      if ($password != $confirm_password) {
        echo "<span>*Password does not match.</span>";
        die();
      }    
      
      $query = $this->db->query('select StateId from gen_city where CityId = '.$city.'')->row();
      $state = $query->StateId;
      $referralcode = referralcode();
      $query = $this->Loginmodel->add_new_member($fname,$lname,$primary_email,$primary_number,$password,$address,$city,$state,$pin_code,$otp,$referralcode,$secondary_email,$secondary_number,$universityid);

      $sendsms = sendsms($primary_number,$otp);
      
      echo "success";
    }

     public function verify_otp(){
        $universityid = $this->session->userdata('universityid');  
        $data['universityid'] = $universityid;
        $this->load->view('varify_otp_view',$data);
     }

     public function Check_otp(){
		$universityid = $this->session->userdata('universityid'); 
        $mobile_number = $this->session->userdata('mobile');
        $otp = $this->input->post('otp');
        $sql = $this->db->query('select * from ref_registereduser where MobileNo = '.$mobile_number.' AND UnvId= '.$universityid.'');
        $query = $sql->row();
        $num_rows = $sql->num_rows();
        $first_name = $query->FirstName;
        $last_name = $query->LastName;
        $userid = $query->UserID;
        if ($num_rows == '0') {
           $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Mobile number not found.</div>');
            redirect(base_url().'Registration/verify_otp/'.$universityid);
        }else{
          
          $register_otp = $query->OTP;
          $update = $this->db->query('update ref_registereduser set IsOTPVerified = 1 where MobileNo = '.$mobile_number.' AND UnvId= '.$universityid.'');
          $afftectedRows = $this->db->affected_rows();
          if ($afftectedRows == '1')
           {
            $this->session->set_userdata('logged_in', $sessiondata);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Registered Successfully</div>');
             $Templatename = "Referrer registration";
             //$univid = $universityid;
             $sourcelink = base_url()."Login/".$universityid;
             $sendsms = send_transactional_sms($this->session->userdata['logged_in']['MobileNo'],$Templatename,$first_name,$university,$sourcelink);
             redirect(base_url().'Login/'.$universityid);
          }else{
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Otp not matched.</div>');
            redirect(base_url().'Registration/verify_otp/'.$universityid);
          }
        }
        if ($otp == $register_otp) {
          $sessiondata = array(
                              'FirstName' => $first_name,
                              'LastName' => $last_name,
                              'userid' => $userid
                         );
            $this->session->set_userdata('logged_in', $sessiondata);
            redirect(base_url().'Login/'.$universityid);
            

        }else{
           $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">OTP not matched.</div>');
           redirect(base_url().'Registration/verify_otp/'.$universityid);
        }
     }
  }
?>
