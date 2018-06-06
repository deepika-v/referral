<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors', 1);
//require_once __DIR__ . '/path/to/facebook-php-sdk-v4/src/Facebook/autoload.php';
//include_once APPPATH."libraries/facebook-api-php-codexworld/src/Facebook/autoload.php";
//include_once APPPATH."libraries/facebook-api-php-codexworld/src/Facebook/Helpers/FacebookRedirectLoginHelper.php";
 
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
          $this->load->helper('facebook');
          $this->load->database();
          $this->load->library('form_validation');
          $this->load->library('Curl');
          //load the login model
          $this->load->model('Loginmodel');
     }
    
     public function index($universityid)
     {  
             $data["universityid"] = $universityid;
             $data['authUrl'] = authurl($universityid);
             $data['uni_details'] = $this->Loginmodel->find_university($universityid);
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
      $otp = generate_otp();
      $query = $this->db->query('select * from ref_registereduser where MobileNo = '.$primary_number.' AND UnvId= '.$universityid.'');
      $check_num = $query->num_rows();
      $this->session->set_userdata('mobile', $primary_number);
      $this->session->set_userdata('universityid', $universityid); 
      $this->session->set_userdata('source','manual');      
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

    
        
  }?>
