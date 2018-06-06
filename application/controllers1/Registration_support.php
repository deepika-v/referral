<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors', 1);
//require_once __DIR__ . '/path/to/facebook-php-sdk-v4/src/Facebook/autoload.php';
//include_once APPPATH."libraries/facebook-api-php-codexworld/src/Facebook/autoload.php";
//include_once APPPATH."libraries/facebook-api-php-codexworld/src/Facebook/Helpers/FacebookRedirectLoginHelper.php";
 
class Registration_support extends CI_Controller
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
      public function index()
     {  
                  
     }
      public function verify_otp(){
        $universityid = $this->session->userdata('universityid');  
        $data['uni_details'] = $this->Loginmodel->find_university($universityid);
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
            redirect(base_url().'Registration_support/verify_otp/'.$universityid);
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
             if($this->session->userdata('source')=="manual")
            {
              redirect(base_url().'Login/'.$universityid);
            }
            else
            {
              redirect(base_url().'Facebookcallback/redirectuser/'.$universityid);
            }
          }else{
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Otp not matched.</div>');
            redirect(base_url().'Registration_support/verify_otp/'.$universityid);
          }
        }
        if ($otp == $register_otp) {
          $sessiondata = array(
                              'FirstName' => $first_name,
                              'LastName' => $last_name,
                              'userid' => $userid
                         );
            $this->session->set_userdata('logged_in', $sessiondata);
            if($this->session->userdata('source')=="manual")
            {
              redirect(base_url().'Login/'.$universityid);
            }
            else
            {
              redirect(base_url().'Facebookcallback/redirectuser/'.$universityid);
            }

            
                       

        }else{
           $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">OTP not matched.</div>');
           redirect(base_url().'Registration_support/verify_otp/'.$universityid);
        }
     }
     
      public function resendotp(){
        $universityid = $this->session->userdata('universityid'); 
        $mobile_number = $this->session->userdata('mobile');
        $sql = $this->db->query('select * from ref_registereduser where MobileNo = '.$mobile_number.' AND UnvId= '.$universityid.'');
        $query = $sql->row();
        $num_rows = $sql->num_rows();
        $first_name = $query->FirstName;
        $last_name = $query->LastName;
        $userid = $query->UserID;
        if ($num_rows == '0') {
           $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Mobile number not found.</div>');
            redirect(base_url().'Registration_support/verify_otp/'.$universityid);
        }else{
          
          $register_otp = $query->OTP;
          if($query->IsOTPVerified=="0")
          {
            $sendsms = sendsms($mobile_number,$register_otp);
            echo "OTP sent to your registered mobile number.";

          }
          
          }
        }    

     
        
  }?>
