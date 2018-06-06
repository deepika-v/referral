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

       $query =$this->Referalmodel->get_totalamount($userid);

     $data['total_amount'] = $query->bonus;
     $q = $this->db->query("SELECT SUM(Amount) as Amount FROM `ref_request_redemption` WHERE ref_request_redemption.UserID = ".$userid )->row();
     $redeem_amt = $q->Amount;


    $sql = $this->Referalmodel->get_approvedamount($userid);
   
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
