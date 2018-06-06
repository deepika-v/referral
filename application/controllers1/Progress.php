<?php
//ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Progress extends CI_Controller {
  

  public function index()
  {
   
    
  }
 public function track($universityid,$showcontact)
  {
    if($this->session->userdata('logged_in')) 
      { 
        $this->load->helper('url');

        $userid = $this->session->userdata['logged_in']['userid'];

        $this->load->model('Referalmodel');

        $data['referals'] = $this->Referalmodel->find_referal_status($userid);
        $data['universityid']=$universityid;
        $data['showcontact']=$showcontact;

       $query = $this->db->query("SELECT
                                    ref_referals.UserID,
                                    ref_referals.IsVisible,
                                    ref_referals.Status as referalstatus,
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

     $data['total_amount'] = $query->bonus;
     $q = $this->db->query("SELECT SUM(Amount) as Amount FROM `ref_request_redemption` WHERE ref_request_redemption.UserID = ".$userid )->row();
     $redeem_amt = $q->Amount;


    $sql = $this->db->query("SELECT
                                    ref_referals.UserID,
                                    ref_referals.IsVisible,
                                    ref_referals.Status as referalstatus,
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
   
    $data['approved_amount'] = $sql->bonus-$redeem_amt;
    $data['redeemed_amount'] = $redeem_amt;
    $this->load->view('progress_view',$data);

      }
  else
  {

  }
    
  }
 
 

  
  
 
}
?>
