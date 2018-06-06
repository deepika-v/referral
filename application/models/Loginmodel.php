<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loginmodel extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     //get the username & password from tbl_usrs
     function get_user($usr, $pwd, $universityid)
     {
           //echo $usr;           
           $this->db->where('UnivId',$universityid);
           $this->db->where('MobileNo',$usr);
           $this->db->where('Password',md5($pwd));                   
           //$this->db->where('IsActive',"1");
           $q= $this->db->get('ref_registereduser');  
            if($q->num_rows() > 0)
           {
            foreach ($q->result() as $row)
            {
              $data[] = $row;
            }
            //print_r($data);
            return $data;
          }
          else
          {
            return FALSE;
          }
      }
 public function update_password($email,$mobileno,$password)
 {
            $this->db->where('EmailID', $email);
            $this->db->where('MobileNo', $mobileno);
            $this->db->update('ref_registereduser',array('password'=>MD5($password),'ModifiedOn'=>date("Y-m-d H:i:s")));
            if($this->db->affected_rows())
            {
              return TRUE;
            }      
 }
 public function get_referralcount($userid)
    {
      $sql = "SELECT COUNT(*) AS count FROM `ref_referals` where UserID='$userid'";
      $q = $this->db->query($sql); 
       if($q->num_rows() > 0)
           {
            foreach ($q->result() as $row)
            {
              $data[] = $row;
            }
            //print_r($data);
            return $data;
          }
          else
          {
            return FALSE;
          }
       
        
     }
  public function get_userdetails($email,$universityid,$mobileno){
       $sql="select FirstName, EmailID,MobileNo, (Select UniversityName from gen_university where UnivId=$universityid)
              As UniversityName from ref_registereduser  where EmailId='".$email."' and MobileNo = '".$mobileno."' ";
        $q = $this->db->query($sql); 
        //$rows = $q->num_rows();
          if($q->num_rows() > 0)
           {
            foreach ($q->result() as $row)
            {
              $data[] = $row;
            }
            
            return $data;
          }
          else
          { 
            //echo "in else";
            //echo "rows".$rows;
            return FALSE;
          }
     }
     public function select_city(){
        $query = $this->db->query('select * from gen_city order by CityName asc');
        return $query->result();
     }

     public function add_new_member($fname,$lname,$primary_email,$primary_number,$password,$address,$city,$state,$pin_code,$otp,$referralcode,$secondary_email,$secondary_number,$universityid){
        $query = "insert into ref_registereduser(FirstName,LastName,EmailID,MobileNo,Password,Address,CityID,StateID,PinCode,IsOTPVerified,OTP,Referralcode,AltMobileNo,AltEmailID,UnivId)
                  values ('$fname','$lname','$primary_email','$primary_number','$password','$address','$city','$state','$pin_code',0,'$otp','$referralcode','$secondary_number','$secondary_email','$universityid')";
        $sql = $this->db->query($query);
     }
   public function find_university($uid){
        $query = $this->db->query('SELECT gen_university.UnvId, gen_university.University, gen_university.UniversityName,customers.CustomerId,customers.logo,customers.LmsURL,customers.CustomerName,customers.website
                                   FROM `gen_university`
                                   JOIN customers ON customers.CustomerId = gen_university.UnvId
                                   where gen_university.UnvId = '.$uid);
        return $query->row();
      }

 function get_discount($unvid)
     {
        $query = $this->db->query("SELECT * FROM `fees_referraldiscount` WHERE UnivId='$unvid' ORDER By WEF DESC LIMIT 1");
        return $query->row(); 
      } 

   public function updatephoto($userid,$file_name)
   {
    $query = "UPDATE `ref_registereduser` SET `UserPhoto` = '$file_name' WHERE `ref_registereduser`.`UserID` = '$userid'";
    $sql = $this->db->query($query);
    return $this->db->affected_rows();      
   }  
  function get_userid($facebookid,$universityid,$usremail)
     {
           //echo $usr;           
           $this->db->where('UnivId',$universityid);
           $this->db->where('FacebookId',$facebookid);
           $q= $this->db->get('ref_registereduser'); //check if facebook id is associated with user. 
            if($q->num_rows() > 0)
           {
            $data['0']="1";
            foreach ($q->result() as $row)
            {
              $data[] = $row;
            }
            //print_r($data);

            return $data;
          }
          else
          {
           //if facebook id is not associated with user, check if facebook email id is avaliable in ref_registereduser table,
           $this->db->where('UnivId',$universityid);
           $this->db->where('EmailID',$usremail);
           //$this->db->where('Password',md5($pwd));                   
           //$this->db->where('IsActive',"1");
           $q= $this->db->get('ref_registereduser');  
            if($q->num_rows() > 0)
           {
            $data['0']="2";
            foreach ($q->result() as $row)
            {
              $data[] = $row;
            }
            //print_r($data);
            return $data;
          }
          else
          {
            $data['0']="0";
            return $data;
          }
          }
      } 
    public function get_details($mobileno,$password,$universityid){

       $sql="select * from ref_registereduser where MobileNo = '".$mobileno."' and UnivId ='".$universityid."' and Password='".md5($password)."'";
        $q = $this->db->query($sql); 
        //$rows = $q->num_rows();
          if($q->num_rows() > 0)
           {
            foreach ($q->result() as $row)
            {
              $data[] = $row;
            }
            
            return $data;
          }
          else
          { 
            return FALSE;
          }
     }     
   public function update_facebookid($userid,$facebookid)
   {
    $query = "UPDATE `ref_registereduser` SET `FacebookId` = '$facebookid' WHERE `ref_registereduser`.`UserID` = '$userid'";
    $sql = $this->db->query($query);
    return $this->db->affected_rows();      
   } 
   public function registerfacebookuser($fname,$lname,$email,$primary_number,$password,$referralcode,$universityid,$facebookid,$otp)   
   {
    $query = "insert into ref_registereduser(FirstName,LastName,EmailID,MobileNo,Password,IsOTPVerified,Referralcode,UnivId,FacebookId,OTP)
                  values ('$fname','$lname','$email','$primary_number','$password',0,'$referralcode','$universityid','$facebookid','$otp')";
        $sql = $this->db->query($query);
    return $this->db->affected_rows();  
   }
}?>
