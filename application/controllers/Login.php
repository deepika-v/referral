<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller
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
          $this->load->database();
          $this->load->library('form_validation');
          //load the login model
          $this->load->model('Loginmodel');
     }
     public function index($universityid)
     {
       $data["universityid"] = $universityid;
       $data['authUrl'] = authurl($universityid);
       $data['uni_details'] = $this->Loginmodel->find_university($universityid);

       //print_r($data['uni_details']);
       //exit;
       try{//get the posted values
          //set validations
          $this->form_validation->set_rules("username", "Mobile No", "trim|required|numeric|exact_length[10]");
          $this->form_validation->set_rules("password", "Password", "trim|required");
          if ($this->form_validation->run() == FALSE)
          {
               //validation fails
               $uid = $universityid;                
               
               $data['city'] = $this->Loginmodel->select_city();

               $this->load->view('Register_view',$data);
          }
          else
          {
                 //validation succeeds                 
                  $username = $this->input->post("username");
                  $password = $this->input->post("password");
                   //check if username and password is correct
                    $usr_result = $this->Loginmodel->get_user($username, $password,$universityid);
                    //print_r($usr_result);
                    if ($usr_result != FALSE) //active user record is present
                    {   
                      if($usr_result['0']->IsOTPVerified=="0")
                      {
                        $this->session->set_userdata('source','manual');  
                        $this->session->set_userdata('mobile', $usr_result['0']->MobileNo);
                        $this->session->set_userdata('universityid', $universityid);
                        $text = "<a href='".base_url()."Registration_support/verify_otp/".$universityid."'>Click here for verify now</a>";
                         $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">You have not verified your OTP.<br>'.$text.' </div>');
                         redirect('Login/'.$universityid);

                      }
                      else
                      {

                        //$uni_name = $data['uni_details'];
                        if(stristr( $data['uni_details']->LmsURL,'lms1'))
                        $url = str_replace('lms1','ums', $data['uni_details']->LmsURL);
                        else if(stristr( $data['uni_details']->LmsURL,'lms'))
                        $url = str_replace('lms','ums', $data['uni_details']->LmsURL);
                        $referralcount = $this->Loginmodel->get_referralcount($usr_result['0']->UserID);
                        $sessiondata = array(
                              'loginuser' => TRUE,
                              'FirstName' => $usr_result['0']->FirstName,
                              'LastName' => $usr_result['0']->LastName,
                              'userid' => $usr_result['0']->UserID,
                              'universityid'=>$universityid,
                              'facebookphoto' =>'',
                              'IsOTPVerified' =>$usr_result['0']->IsOTPVerified,
                              'userphoto'=>$usr_result['0']->UserPhoto,
                               'referralcode'=>$usr_result['0']->Referralcode,
                              'Emailid'=> $usr_result['0']->EmailID,
                              'MobileNo'=> $usr_result['0']->MobileNo,
                              'UniversityName'=>  $data['uni_details']->UniversityName,
                              'umsurl'=> $url,
                              'url'=> $url."/web/checklistform.aspx",
                              'universitylink'=> $data['uni_details']->website,
                              'universitylogo'=>$data['uni_details']->logo,
                              'University'=>  $data['uni_details']->University
                         );
                        $this->session->set_userdata('logged_in', $sessiondata);
                        if($referralcount['0']->count=="0")
                        {
                            
                          redirect("Referfriend/view/".$universityid."/0");

                        }
                        else
                        {
                          redirect("Progress/track/".$universityid."/1");

                        }                       
                         
                      }
                        
                    }
                    else
                    {
                         $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">Invalid Credentials! Please try again</div>');
                         redirect('Login/'.$universityid);
                    }
               }

        }
        catch(Exceptions $e)
        {

        }
     }
     public function forgotpassword($universityid)
      {
        $data["universityid"] = $universityid;
        $this->load->view('forgot_password_view',$data);
      } 
     public function doforget($universityid)
     {
    //echo "in doforget function";
    $this->load->helper('url');
    $this->load->library('form_validation');
    $email= $this->input->post('emailid');
    $mobileno= $this->input->post('mobileno');
    $this->form_validation->set_rules('emailid','emailid','required|trim');
    $this->form_validation->set_rules('mobileno','Mobile No','required|trim');
     if ($this->form_validation->run() == FALSE)
      {
        $data["universityid"] = $universityid;
  
        $this->load->view('forgot_password_view',$data);
   
      }
      else
      {
        $result = $this->Loginmodel->get_userdetails($email,$universityid,$mobileno);
         if ($result!=FALSE)
         {
            $user=$result[0];
            $this->load->helper('string');
            $this->load->helper('mail');
            $password= random_string('alnum',6);
            $result = $this->Loginmodel->update_password($email,$mobileno,$password);
            $firstname = ucfirst($user->FirstName);
            $university = $user->UniversityName;
            $universityencode= str_replace('=','.', base64_encode($universityid));
            $emailencode =  str_replace('=','.', base64_encode($user->EmailID));
            $mobilenoencode =  str_replace('=','.', base64_encode($user->MobileNo));
            $url = base_url()."login/changepassword/";
                              $link = $url.$emailencode.'/'.$universityencode.'/'.$mobilenoencode;
                              $to = $user->EmailID;
                              $subject = "Password Reset";
                              $message = file_get_contents(base_url('assets/mail_templates/forgot_password.html'));
                              $message = str_replace('#FirstName#',$firstname,$message);
                              $message = str_replace('#UnivName#',$university,$message);
                              $message = str_replace('#Link#', $link,$message);
                              $cc = '';
                              $bcc = "";
                              $altmessage = "";
                              $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
            $this->session->set_flashdata('message','<p style="color: #00b33c">Link has been sent to '.$email.'. <br>Click on link to reset password</p>' );    
            redirect('Login/forgotpassword/'.$universityid.'/');
       }
       else
         {
           $this->session->set_flashdata('message','<p style="color: #ff3300">User with email id '.$email.' and mobile no  '.$mobileno.' does not exists</p>');    
           redirect('Login/forgotpassword/'.$universityid.'/');
         }
    }
     }
     public function changepassword($emailid,$universityid,$mobileno)
     {    
    $universitydecode= str_replace('.','=', $universityid);
    $emaildecode =  str_replace('.','=', $emailid);
    $mobilenodecode =  str_replace('.','=', $mobileno);
    $data['emailid']= base64_decode($emaildecode);
    $data['universityid']= base64_decode($universitydecode);
    $data['mobileno']= base64_decode($mobilenodecode);
    $this->load->view('changepassword_view',$data);
     }
    public function resetpassword($emailid,$universityid,$mobileno)
    {    $universitydecode= str_replace('.','=', $universityid);
       $emaildecode =  str_replace('.','=', $emailid);
       $mobilenodecode =  str_replace('.','=', $mobileno);
       $data['emailid']= base64_decode($emaildecode);
       $data['universityid']= base64_decode($universitydecode);
       $data['mobileno']= base64_decode($mobilenodecode);
       $this->load->view('resetpassword_view',$data);
    }
    public function updatepassword($universityid)
    {    
    $this->load->helper('url');
    $email= $this->input->post('emailid');
    $mobileno= $this->input->post('mobileno');
    $password = $this->input->post('password');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('emailid','Email Id','required|trim');
    $this->form_validation->set_rules('mobileno','Mobile No','required|trim');
    $this->form_validation->set_rules('password','password','required|trim|min_length[4]|max_length[10]');
    $this->form_validation->set_rules('cpassword','cpassword','required|trim|min_length[4]|max_length[10]|matches[password]');
    if ($this->form_validation->run() == FALSE)
     {
        $data['emailid']= $email;
        $data['mobileno']= $mobileno;
        $data['universityid']= $universityid;
        $this->load->view('changepassword_view',$data);
      }
      else
      {
         $result = $this->Loginmodel->get_userdetails($email,$universityid,$mobileno);
         if ($result!=FALSE)
         {
            $user=$result[0];
            $this->load->helper('string');
            $this->load->library('user_agent');
            $this->db->where('EmailID', $user->EmailID);
            $this->db->update('ref_registereduser',array('password'=>MD5($password),'ModifiedOn'=>date("Y-m-d H:i:s")));
            $this->load->helper('mail');
            $firstname = ucfirst($user->FirstName);
            $university = $user->UniversityName;
            $universityencode= str_replace('=','.', base64_encode($universityid));
            $emailencode =  str_replace('=','.', base64_encode($user->EmailID));
            $datetime = date('l jS \of F Y h:i:s A');
            $ipaddress=$this->input->ip_address();
            $browser = $this->agent->browser().' '.$this->agent->version();
            $platform = $this->agent->platform();
            $url = base_url()."login/";
            $link = $url.'/'.$universityid;
            $to = $user->EmailID;
            $subject = "Referral Module Password Reset";
            $message = file_get_contents(base_url('assets/mail_templates/reset_password.html'));
            $message = str_replace('#FirstName#',$firstname,$message);
            $message = str_replace('#UnivName#',$university,$message);
            $message = str_replace('#Email#', $email,$message);
            $message = str_replace('#Datetime#', $datetime,$message);
            $message = str_replace('#IPAddress#', $ipaddress,$message);
            $message = str_replace('#Browser#', $browser,$message);
            $message = str_replace('#Platform#', $platform,$message);
            $cc = '';
            $bcc = "";
            $altmessage = "";
            $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
            $this->session->set_flashdata('message','<p style="color: #00b33c">Password changed successfully.</p>');    
            redirect('Login/'.$universityid.'/');
         }
         else
         {
            $this->session->set_flashdata('message','<p style="color: #ff3300">Failed to update password. Please try again!!!</p>');    
            redirect('Login/forgotpassword/'.$universityid.'/');
         }
          
      }
    }
    public function reset_password($universityid)
    {    
    $this->load->helper('url');
    $email= $this->input->post('emailid');
    $mobileno= $this->input->post('mobileno');
    $password = $this->input->post('password');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('password','password','required|trim|min_length[4]|max_length[10]');
    $this->form_validation->set_rules('cpassword','cpassword','required|trim|min_length[4]|max_length[10]|matches[password]');
     if ($this->form_validation->run() == FALSE)
      {
        $data['emailid']= $email;
        $data['mobileno']= $mobileno;
        $data['universityid']= $universityid;
        $this->load->view('changepassword_view',$data);
      }
      else
      {
         //echo "in else";
         $result = $this->Loginmodel->get_userdetails($email,$universityid,$mobileno);
         //echo "<br>result";
         //print_r($result);
        if ($result!=FALSE)
         {
            $user=$result[0];
            //print_r($user);
            $this->load->helper('string');
            $this->load->library('user_agent');
            //$password= random_string('alnum',6);
            $this->db->where('EmailID', $user->EmailID);
            $this->db->update('ref_registereduser',array('password'=>MD5($password),'ModifiedOn'=>date("Y-m-d H:i:s")));
            $this->load->helper('mail');
            $firstname = ucfirst($user->FirstName);
            $university = $user->UniversityName;
            $universityencode= str_replace('=','.', base64_encode($universityid));
            $emailencode =  str_replace('=','.', base64_encode($user->EmailID));
            //$date = date("Y-m-d H:i:s");
            $datetime = date('l jS \of F Y h:i:s A');
            $ipaddress=$this->input->ip_address();
            $browser = $this->agent->browser().' '.$this->agent->version();
            $platform = $this->agent->platform();
            $url = base_url()."login/";
            $link = $url.'/'.$universityid;
            $to = $user->EmailID;
            $subject = "Referral Module Password Reset";
            $message = file_get_contents(base_url('assets/mail_templates/reset_password.html'));
            $message = str_replace('#FirstName#',$firstname,$message);
            $message = str_replace('#UnivName#',$university,$message);
            $message = str_replace('#Email#', $email,$message);
            $message = str_replace('#Datetime#', $datetime,$message);
            $message = str_replace('#IPAddress#', $ipaddress,$message);
            $message = str_replace('#Browser#', $browser,$message);
            $message = str_replace('#Platform#', $platform,$message);
            //$message = str_replace('#RefererName#', ucfirst($this->session->userdata['logged_in']['FirstName']." ".$this->session->userdata['logged_in']['LastName']),$message);
             $cc = '';
             $bcc = "";
             $altmessage = "";
             $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
             //print_r($status);     
             //exit;  
             $universityencode= str_replace('=','.', base64_encode($universityid));
                 $emailencode =  str_replace('=','.', base64_encode($user->EmailID));
                 $mobilenoencode =  str_replace('=','.', base64_encode($mobileno));
                 $url = base_url()."login/resetpassword/";
                 $link = $url.$emailencode.'/'.$universityencode.'/'.$mobilenoencode;
            $this->session->set_flashdata('message','<p style="color: #00b33c">Password changed successfully.</p>');    
            redirect($link);
         }
         else
         {
          $universityencode= str_replace('=','.', base64_encode($universityid));
                 $emailencode =  str_replace('=','.', base64_encode($user->EmailID));
                 $mobilenoencode =  str_replace('=','.', base64_encode($mobileno));
                 $url = base_url()."login/resetpassword/";
                 $link = $url.$emailencode.'/'.$universityencode.'/'.$mobilenoencode;

          $this->session->set_flashdata('message','<p style="color: #ff3300">Failed to update password. Please try again!!!</p>');    
            redirect($link);
         }         
    }
    }
    public function upload($userid)
      {
        $data["userid"] = $userid;
        $this->load->view('upload_view',$data);
      }
    public function do_upload()
        {
                $config['upload_path']          = './uploads/userphotos';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
                $userid=$this->session->userdata['logged_in']['userid'];

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload_view', $error);
                }
                else
                {
                        $data['uploaded_data'] = $this->upload->data();
                        $file_name = $data['uploaded_data']['file_name'];
                        //echo $file_name;
                        if($file_name==$this->session->userdata['logged_in']['userphoto'])
                         {
                           $error = array('error' => '<div class="alert alert-danger">Uploaded Image matches with your current image</div>');
                           $this->load->view('upload_view', $error);
     
                          } 
                        else
                         {
                          $result = $this->Loginmodel->updatephoto($userid,$file_name);
                          if($result=="1")
                          {
                            $this->session->userdata['logged_in']['userphoto'] = $file_name;
                            //print_r($this->session->userdata['logged_in']);
                            //exit;
                            $error = array('error' => '<div class="alert alert-success">Image uploaded Successfully</div>');
                           $this->load->view('upload_view', $error);
                           $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-success">Image uploaded Successfully</div>');
                           redirect('Login/upload/'.$userid);
                          }
                         }
                          

                      }
                        //$this->load->view('upload_view', $data);
                }
    public function verifymobilenumber($uid)
    {
    $data['universityid']=$uid;
    $this->load->view('verify_mobilenumber_view',$data);
    } 
    public function Check_otp()
    {
        $universityid = $this->session->userdata('universityid'); 
        $mobile_number = $this->session->userdata('mobile');
        $otp = $this->input->post('otp');
        $sql = $this->db->query('select * from ref_registereduser where MobileNo = '.$mobile_number.' AND UnivId= '.$universityid.'');
        $query = $sql->row();
        $num_rows = $sql->num_rows();
        $first_name = $query->FirstName;
        $last_name = $query->LastName;
        $userid = $query->UserID;
        if ($num_rows == '0') {
           $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Mobile number not found.</div>');
            redirect(base_url().'Registration_support/verify_otp/'.$universityid);
        }else{
          if($otp == $query->OTP)
          {
            $update = $this->db->query('update ref_registereduser set IsOTPVerified = 1 where MobileNo = '.$mobile_number.' AND UnivId= '.$universityid.'');
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
        else
        {
           $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Otp not matched.</div>');
            redirect(base_url().'Registration_support/verify_otp/'.$universityid);
        }
          if($this->session->userdata('source')=="manual")
            {
              redirect(base_url().'Login/'.$universityid);
            }
            else
            {
              redirect(base_url().'Facebookcallback/redirectuser/'.$universityid);
            }

          }
    }
    public function resendotp()
    {
        $this->load->helper('referralcode');
        $universityid = $this->session->userdata['logged_in']['universityid']; 
        $mobile_number = $this->session->userdata['logged_in']['MobileNo']; 
        $sql = $this->db->query('select * from ref_registereduser where MobileNo = '.$mobile_number.' AND UnivId= '.$universityid.'');
        $query = $sql->row();
        $num_rows = $sql->num_rows();
        $first_name = $query->FirstName;
        $last_name = $query->LastName;
        $userid = $query->UserID;
        if ($num_rows == '0') {
           $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Mobile number not found.</div>');
            redirect(base_url().'Login/verifymobilenumber/'.$universityid);
        }else{
          $register_otp = $query->OTP;
          if($query->IsOTPVerified=="0")
          { 
            $otp = generate_otp();
            $query = "UPDATE `ref_registereduser` SET `OTP` = '$otp',`IsOTPVerified` = '0'  WHERE MobileNo = '$mobile_number' AND UnivId= '$universityid'";
            $sql = $this->db->query($query);
            $sendsms = sendsms($mobile_number,$otp);
            echo "1";
          }
          else
          {
            echo "0";
          }
          
          }
        } 
     public function logout($universityid) 
     {
      $this->session->unset_userdata('logged_in', $sess_array);
      $this->session->sess_destroy();
      redirect('Login/'.$universityid);
      }
 }
?>
