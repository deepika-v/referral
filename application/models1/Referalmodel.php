<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Referalmodel extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

  function get_City($stateid)
     {
           $this->db->where('StateId',$stateid);
           $this->db->order_by("CityName","asc");
       $q= $this->db->get('gen_city');  
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
     function get_state()
     {
       $this->db->order_by("StateName","asc");
       $q= $this->db->get('gen_state');  
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
