<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors', 1);
//include_once APPPATH."libraries/facebook-api-php-codexworld/facebook.php";
 include_once APPPATH."libraries/facebook-api-php-codexworld/src/Facebook/autoload.php";

class Facebookcallback extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->helper('sms');
          $this->load->helper('facebook');
          $this->load->helper('referralcode');
          $this->load->database();
          $this->load->library('form_validation');
          $this->load->library('Curl');
          //load the login model
          $this->load->model('Loginmodel');
     }
//http://localhost/referralsystem/Facebookcallback/11?
     public function index()
      {  
        $uid = $this->uri->segment(2);
        $data['universityid']= $uid;        
        $user = getdata();
        $usr_result = $this->Loginmodel->get_userid($user['id'],$uid,$user['email']);
        $data['email']=$user['email'];
        $data['facebookid']= $user['id']; 
        if(!file_exists('./uploads/userphotos/'.$data['facebookid'].'.png'))
        {
         $fbprofileimage = file_get_contents($user['picture']['url']);  
         file_put_contents('./uploads/userphotos/'.$data['facebookid'].'.png', $fbprofileimage);
        }
        $data['photourl']= $data['facebookid'].'.png';
        
        
        $data['uni_details'] = $this->Loginmodel->find_university($uid);
        //$data['universityid']= $uid;
        $data['first_name'] = $user['first_name'];
        $data['last_name'] = $user['last_name'];
        $data['accesstoken'] = $_SESSION['facebook_access_token'];
  //print_r($usr_result);
  if($usr_result['0']=="0")//no record exists in database
  {
   
    $data['emailcheck'] = "0";
    $this->load->view('associateuser_view',$data);   
  }
  else if($usr_result['0']=="1") //facebook id associated with user id in database
  {

     $this->login(
                       $uid,
                       $usr_result['1']->FirstName,
                       $usr_result['1']->LastName,
                       $usr_result['1']->UserID,
                       $usr_result['1']->UserPhoto,
                       $usr_result['1']->Referralcode,
                       $usr_result['1']->EmailID,
                       $usr_result['1']->MobileNo,
                       $data['photourl'],
                       $usr_result['1']->IsOTPVerified);

  }
  else if($usr_result['0']=="2")//email id exists in database
  {  
     $data['emailcheck']="2";
      $this->load->view('associateuser_view',$data);

   
  }
  
  }
public function displaylogin($uid,$action)
{    $data['action']= $action;//$this->input->post('action');
     $data['email']=$this->input->post('email');
     $data['photourl']= $this->input->post('photourl');
     $data['facebookid']= $this->input->post('facebookid');
     $data['uni_details'] = $this->Loginmodel->find_university($uid);
     if($data['action']=="1") $data['emailcheck']="2";
     elseif($data['action']=="0") $data['emailcheck']="1";
     $data['universityid']=$uid;
     $data['first_name'] = $this->input->post('first_name');
     $data['last_name'] = $this->input->post('last_name');
     $data['accesstoken'] = $this->input->post('accesstoken');
     //print_r($data);
     //echo $data['emailcheck'];
     //echo $data['action'];
     $this->load->view('associateuser_view',$data);
}
 public function loginuser($uid)
 {  
      $username = $this->input->post("username");
      $password = $this->input->post("password");
      $email = $this->input->post("email");
      $photourl = $this->input->post("photourl");
      $facebookid = $this->input->post("facebookid");      
      //check if username and password is correct
      $usr_result = $this->Loginmodel->get_details($username,$password,$uid);
      //print_r($usr_result);
      if($usr_result!= FALSE)
      {
        $update_facebookid = $this->Loginmodel->update_facebookid($usr_result['0']->UserID,$facebookid);
        //echo $update_facebookid;
        if($update_facebookid!= 0)
        {
           $this->login(
                       $uid,
                       $usr_result['0']->FirstName,
                       $usr_result['0']->LastName,
                       $usr_result['0']->UserID,
                       $usr_result['0']->UserPhoto,
                       $usr_result['0']->Referralcode,
                       $usr_result['0']->EmailID,
                       $usr_result['0']->MobileNo,
                       $photourl,
                       $usr_result['0']->IsOTPVerified);
          //echo "success";
        }
        else{
             $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">Failed to Login! Please try again</div>');
             redirect("Facebookcallback/displaylogin/".$uid."/1");
            }
      
      }
      else
      { 
       // echo "1";
        $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">You are not registered user! <a href = "'.base_url('facebookcallback/registeruser/').$uid.'"class="btn btn-default">Register with us</a></div>');
        redirect("Facebookcallback/displaylogin/".$uid."/1");
      }    
 }
public function registeruser($universityid){
      $terms = $this->input->post('terms');
      if ($terms == '')
      {
        echo "<span>*You must accept terms and conditions.</span>";
        die();
      }      
      $facebookid = $this->input->post('facebookid');
      $photourl = $this->input->post('photourl');
      $fname = $this->input->post('first_name');
      $lname = $this->input->post('last_name');
      $email = $this->input->post('email');
      $primary_number = $this->input->post('primary_number');
      $password = md5($this->input->post('password'));
      $otp = generate_otp();
      $confirm_password = md5($this->input->post('confirm_password'));
      $query = $this->db->query('select * from ref_registereduser where MobileNo = '.$primary_number.' AND UnivId= '.$universityid.'');
      $check_num = $query->num_rows();
      $this->session->set_userdata('mobile', $primary_number);
      $this->session->set_userdata('universityid', $universityid); 
      $this->session->set_userdata('source','facebook'); 
      if ($check_num == '1' ){
        $check_otp = $query->row();
        $otp_verify = $check_otp->IsOTPVerified;
        if ($otp_verify == 0){
          //echo $universityid;
          echo "<span>You are already register with us. Please confirm your OTP once.</span><a href='".base_url()."Registration/verify_otp/".$universityid."'>Click here for verify now</a>";
        die();
        }
      }
      if ($check_num > 0 ) {
        echo "<span>*Mobile number already registered.</span>";
        die();
      }
      if ($primary_number == '') {
        echo "<span>*Mobile is required</span>";
        die();
      }
      if ($password != $confirm_password) {
        echo "<span>*Password does not match.</span>";
        die();
      }    
      $referralcode = referralcode();
      $otp = generate_otp();
      $query = $this->Loginmodel->registerfacebookuser($fname,$lname,$email,$primary_number,$password,$referralcode,$universityid,$facebookid,$otp,$photourl);   
       //echo $query;
       if($query=="1"){
        //$sendsms = sendsms($primary_number,$otp);
       $this->session->set_userdata('photourl', $photourl);
       $this->session->set_userdata('email', $email);
       $this->session->set_userdata('facebookid', $facebookid);
       $sendsms = sendsms($primary_number,$otp);
        echo "success";
       }      
    }
  function redirectuser($uid)
  {
    $usr_result = $this->Loginmodel->get_userid($this->session->userdata('facebookid'),$uid,$this->session->userdata('email'));
    if($usr_result['0']=="1") //facebook id associated with user id in database
    {
     $this->login(
                       $uid,
                       $usr_result['1']->FirstName,
                       $usr_result['1']->LastName,
                       $usr_result['1']->UserID,
                       $usr_result['1']->UserPhoto,
                       $usr_result['1']->Referralcode,
                       $usr_result['1']->EmailID,
                       $usr_result['1']->MobileNo,
                       $this->session->userdata('photourl'),
                       $usr_result['1']->IsOTPVerified);

    }

  }
  function login($uid,$firstname,$lastname,$userid,$userphoto,$referralcode,$emailid,$mobileno,$photourl,$IsOTPVerified)
  {
     $uni_name = $this->Loginmodel->find_university($uid); 
 // $uni_name = $data['uni_details'];
                        if(stristr($uni_name->LmsURL,'lms1'))
                        $url = str_replace('lms1','ums',$uni_name->LmsURL);
                      else if(stristr($uni_name->LmsURL,'lms'))
                        $url = str_replace('lms','ums',$uni_name->LmsURL);
      $referralcount = $this->Loginmodel->get_referralcount($userid);
      //print_r($referralcount);
       //exit;
      $sessiondata = array(
                             'loginuser' => TRUE,
                              'FirstName' => $firstname,
                              'LastName' => $lastname,
                              'userid' => $userid,
                              'universityid'=>$uid,
                               'userphoto'=>$userphoto,
                              'facebookphoto' =>$photourl,
                              'IsOTPVerified' =>$IsOTPVerified,
                              //'referenceid'=>$referenceid,
                              'referralcode'=>$referralcode,
                              'Emailid'=> $emailid,
                              'MobileNo'=> $mobileno,
                              'umsurl'=> $url,
                              'UniversityName' => $uni_name->UniversityName,
                              'url'=> $url."/web/checklistform.aspx",
                              'universitylink'=>$uni_name->website,
                              'universitylogo'=>$data['uni_details']->logo,
                              'University'=> $uni_name->University
                           );
                         //print_r($sessiondata);
                         //exit;
                        $this->session->set_userdata('logged_in', $sessiondata);
                        if($referralcount['0']->count=="0")
                        {
                            
                          redirect("Referfriend/view/".$uid."/0");

                        }
                        else
                        {
                          redirect("Progress/track/".$uid."/1");

                        }
  }     
  
  
}?>
