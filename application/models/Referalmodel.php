<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Referalmodel extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

  
      
function get_enquiryid($form_data)
 {
      $MobileNo = $form_data['MobileNo'];
      $emailid = $form_data['EmailId'];
      $unvid = $form_data['UnvId'];
      $userid = $form_data['CreatedBy'];
       $sql1 = "Select ReferalID From ref_referals where (MobileNo = '$MobileNo' OR EmailId = '$emailid') AND CreatedBy = '$userid' AND UnvId='$unvid' ";
       //echo $sql1;
       $q = $this->db->query($sql1);
       if($q->num_rows() > 0)
        {
          foreach ($q->result() as $row)
          {
            $data[] = $row;
          }
          return FALSE;
        }
        else
        { 
               $this->db->insert('ref_referals', $form_data);     
              if ($this->db->affected_rows() == '1')
             { 
                return $this->db->insert_id();
             }
             else
             {
              return FALSE;
             }        
        }
}
 function add_to_ref_referals($form_data)
 {
    $this->db->insert('ref_referals', $form_data);     
       if ($this->db->affected_rows() == '1')
         {
         return TRUE;
         }
         else
         {
          return FALSE; 
         }
  }
  function get_totalamount($userid){
   $query= $this->db->query("SELECT
                                    ref_referals.UserID,
                                    ref_referals.IsVisible,
                                    referalID,
                                    std_admission.UnvId,
                                    enq_enquiry.Firstname,
                                    enq_enquiry.Lastname,
                                    enq_enquiry.EmailId,
                                     enq_enquiry.MobileNo,
                                    ref_referals.EnquiryId,
                                    std_admission.Status,
                                    fees_referraldiscount.WEF,
                                    sum(fees_referraldiscount.Bonus) as bonus
                                FROM
                                    ref_referals
                                        LEFT JOIN
                                    enq_enquiry ON ref_referals.EnquiryId = enq_enquiry.EnquiryId
                                        LEFT JOIN
                                    std_admission ON std_admission.EnquiryId = ref_referals.EnquiryId
                                        LEFT JOIN
                                    fees_referraldiscount ON fees_referraldiscount.UnivId =  ref_referals.UnvId
                                WHERE
                                    ref_referals.UserID = ".$userid )->row();
   return $query;
  }
    function get_approvedamount($userid){
   $query= $this->db->query("SELECT
                                    ref_referals.UserID,
                                    ref_referals.IsVisible,
                                    referalID,
                                    std_admission.UnvId,
                                    enq_enquiry.Firstname,
                                    enq_enquiry.Lastname,
                                    enq_enquiry.EmailId,
                                    enq_enquiry.MobileNo,
                                    ref_referals.EnquiryId,
                                    std_admission.Status,
                                    fees_referraldiscount.WEF,
                                    sum(fees_referraldiscount.Bonus) as bonus
                                FROM
                                    ref_referals
                                        LEFT JOIN
                                    enq_enquiry ON ref_referals.EnquiryId = enq_enquiry.EnquiryId
                                        LEFT JOIN
                                    std_admission ON std_admission.EnquiryId = ref_referals.EnquiryId
                                        LEFT JOIN
                                    fees_referraldiscount ON fees_referraldiscount.UnivId =  ref_referals.UnvId
                                WHERE
                                    ref_referals.UserID = ".$userid ." AND std_admission.Status IN ('C','D','E','Y')" )->row();
   return $query;
  }
   function get_redeemamount($userid)
  {
   $query= $this->db->query("SELECT SUM(Amount) as Amount FROM `ref_request_redemption` WHERE ref_request_redemption.UserID = ".$userid )->row();
   return $query;
  }
    function get_claimuserdetails($userid)
  {
   $query= $this->db->query('select EmailID,FirstName,LastName from ref_registereduser where UserID = '.$userid)->row();
   return $query;
  }
  
  function find_referal_status($userid){
    $query = "SELECT ref_referals.UserID,ref_referals.Status as referalstatus, ref_referals.IsVisible,referalID,gen_university.University, ref_referals.Firstname, ref_referals.Lastname,ref_referals.EmailId,ref_referals.MobileNo, ref_referals.EnquiryId,std_admission.Status 
              FROM ref_referals
              LEFT JOIN enq_enquiry ON ref_referals.EnquiryId = enq_enquiry.EnquiryId
              LEFT JOIN std_admission ON std_admission.EnquiryId = ref_referals.EnquiryId
              LEFT JOIN gen_university ON gen_university.UnvId = ref_referals.UnvId
              where ref_referals.UserID = $userid";
    $sql = $this->db->query($query);
    return $sql->result();     
  }
  
  function Send_request($userid,$cash){
    $query = $this->db->query("insert into ref_request_redemption(UserID,Amount,RequestedOn) values ('$userid','$cash',now())");
    if ($query) {
      return TRUE;
    }
  }
 
     function hide_contact($referalID){
      $sql="UPDATE `ref_referals` SET `IsVisible` = '0' WHERE `ref_referals`.`referalID` = '$referalID'";
      //echo $sql;
      $query = $this->db->query($sql);
    if ($query) 
    {
      return TRUE;
    }
    else{
      return FALSE;
    }
}

function show_contact($referalID){
      $sql="UPDATE `ref_referals` SET `IsVisible` = '1' WHERE `ref_referals`.`referalID` = '$referalID'";
      //echo $sql;
      $query = $this->db->query($sql);
    if ($query) {
      return TRUE;
    }
    else{
      return FALSE;
    }
}
    
  


   
     
}?>
