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
           $this->db->where('UnvId',$universityid);
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
 public function get_universityname($universityid){
       $sql="SELECT gen_university.UnvId, gen_university.University, gen_university.UniversityName,customers.LmsURL,customers.CustomerName,customers.website
             FROM `gen_university`
             JOIN customers ON customers.CustomerId = gen_university.UnvId
             where gen_university.UnvId = '$universityid'";
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
       $sql="select FirstName, EmailID,MobileNo, (Select UniversityName from gen_university where UnvId=$universityid)
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
        $query = "insert into ref_registereduser(FirstName,LastName,EmailID,MobileNo,Password,Address,CityID,StateID,PinCode,IsOTPVerified,OTP,Referralcode,AltMobileNo,AltEmailID,UnvId)
                  values ('$fname','$lname','$primary_email','$primary_number','$password','$address','$city','$state','$pin_code',0,'$otp','$referralcode','$secondary_number','$secondary_email','$universityid')";
        $sql = $this->db->query($query);
     }
   public function find_university($uid){
        $query = $this->db->query('select CustomerId,CustomerName,logo from customers where CustomerId = '.$uid);
        return $query->row();
      }
   public function updatephoto($userid,$file_name)
   {
    $query = "UPDATE `ref_registereduser` SET `UserPhoto` = '$file_name' WHERE `ref_registereduser`.`UserID` = '$userid'";
    $sql = $this->db->query($query);
    return $this->db->affected_rows();      
   }   
     
}?>