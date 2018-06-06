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
          $this->load->helper('sms_helper');
          $this->load->database();
          $this->load->library('form_validation');
          $this->load->library('Curl');
          //load the login model
          $this->load->model('Loginmodel');
     }

     public function index()
     {  
        $data['city'] = $this->Loginmodel->select_city();
        $this->load->view('Register_view',$data);          
     }

     public function add_member(){
      //var_dump($this->input->post());
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
      $query = $this->db->query('select * from ref_registereduser where MobileNo = '.$primary_number.'');
      $check_num = $query->num_rows();
      
      if ($check_num == '1' ) {
        $check_otp = $query->row();
        $otp_verify = $check_otp->IsOTPVerified;
        if ($otp_verify == 0) {
          echo "<span>You are already register with us. Please confirm your OTP once.</span><a href='".base_url()."Registration/varify_otp'>Click here for verify now</a>";
        die();
        }
      }
      if ($check_num > 0 ) {
        echo "<span>*Mobile number already register.</span>";
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

      $query = $this->Loginmodel->add_new_member($fname,$lname,$primary_email,$primary_number,$password,$address,$city,$state,$pin_code,$otp,$secondary_email,$secondary_number);

      $sendsms = sendsms($primary_number,$otp);
      
      echo "success";
      
      //redirect(base_url().'dashboard');

      //redirect('Login/verifyOTP');
      


       /*   
      if(!preg_match($emailval, $primary_email)){
        echo "<span>*Please enter valid emailid.</span>";
        die();
      }
      if(!preg_match($emailval, $secondary_email)){
        echo "<span>*Please enter valid emailid.</span>";
        die();
      }
       
      if(!preg_match($mob, $primary_number)){
        echo "<span>*Please enter valid emailid.</span>";
        die();
      }
      if(!preg_match($mob, $secondary_number)){
        echo "<span>*Please enter valid emailid.</span>";
        die();
      }
      */

     }

     public function varify_otp(){
        $this->load->view('varify_otp_view');
     }

     public function Check_otp(){
        $mobile_number = $this->input->post('number');
        $otp = $this->input->post('otp');
        $sql = $this->db->query('select OTP from ref_registereduser where MobileNo = '.$mobile_number.'');
        $query = $sql->row();
        $num_rows = $sql->num_rows();
        if ($num_rows == '0') {
           $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Mobile number not found.</div>');
            redirect(base_url().'Registration/varify_otp');
        }else{
          
          $register_otp = $query->OTP;
          $update = $this->db->query('update ref_registereduser set IsOTPVerified = 1 where MobileNo = '.$mobile_number.'');
          $afftectedRows = $this->db->affected_rows();
          if ($afftectedRows == '1') {
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Updated Successfully</div>');
            redirect(base_url().'dashboard');
          }else{
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Otp not matched11.</div>');
            redirect(base_url().'Registration/varify_otp');
          }
        }
        if ($otp == $register_otp) {
          redirect(base_url().'dashboard');
        }else{
           $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">OTP not matched.</div>');
            redirect(base_url().'Registration/varify_otp');
        }
     }
  }
?>