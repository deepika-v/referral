<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Referral Program | Progress Tracking</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/progress-wizard.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/flat/blue.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/morris/morris.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datepicker/datepicker3.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css');?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/referal.css');?>"/>
  <style type="text/css">
.required{
 color: red;   
}

.fontsize{
  font-size: 16px;
}
.boxwidth{
  width: 300px;
}
.info-box-number {
  font-size: 22px;
}
.info-box-text {
  text-transform: none;
}
div.dataTables_length label{
  padding-left: 10px;
  padding-right: 10px;
}
div.dataTables_filter label {
  padding-left: 10px;
  padding-right: 10px;
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view('Header_view');?>
  <div class="content-wrapper" style="height:auto;">
    <section class="content" >
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><?php if($showcontact =="1")echo "Progress Tracking";  else echo "Hidden Contacts";?></h3><br>
           
                  <div id="msg" ></div>
          </div>
          <?php if($showcontact =="1")
          {?>

          <br><br>
          <div class="box-body" id="redemptiondetails">
          <form class="form-inline" role="form" method="post">
           <div style="float:left">
             
         <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box boxwidth">
            <span class="info-box-icon bg-blue" style="width:20%;"><i class="fa fa-rupee"></i></span>

            <div class="info-box-content" style="width:80%;">
              <span class="info-box-text fontsize">Your Earnings</span>
              <span class="info-box-number"><?php if($total_amount>0) echo $total_amount; else echo 0;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
            <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box boxwidth">
            <span class="info-box-icon bg-yellow" style="width:20%;"><i class="fa fa-rupee"></i></span>

            <div class="info-box-content">
              <span class="info-box-text fontsize" >Available for redemption</span>
              <span class="info-box-number"><?php if($approved_amount>0) echo $approved_amount; else echo 0;?></span>
              <?php
            if($approved_amount > 0 ){
              echo '<a href='.base_url("Progress_support/request/").' class="btn btn-info btn-sm pull-right">Request redemption</a>';
            }
                    ?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box boxwidth">
            <span class="info-box-icon bg-blue" style="width:20%;"><i class="fa fa-rupee"></i></span>

            <div class="info-box-content">
              <span class="info-box-text fontsize">Redeemed Amount</span>
              <span class="info-box-number"><?php if($redeemed_amount>0) echo $redeemed_amount; else echo 0;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         
       </div>   
        
                                       
              </form> 
            </div>
<?php
}
?>
            <?php echo $this->session->flashdata('msg');?>
            <table class="table table-bordered" id="progresstable" width="98%" align="center" style="padding:20px" >
              <thead>
                <tr>
                  <th>Sr. no</th>
                  <th>Refree Details</th>
                  <th>Referred To</th>
                  <th>Progress</th>
                  <th></th>
                  
                </tr>
              </thead>
              <tbody>
              <?php
                $index = '1';
                 //print_r($referals);  
                foreach ($referals as $row) 
                {
                  $name = $row->Firstname.' '.$row->Lastname;
                  $progress_status = $row->Status;  
                  $form_id = "sendreminder_".$index; 
                  $uid = $universityid; 
                  if($showcontact=="1")
                  {
                     
                     if($row->IsVisible=="1")
                 {
                ?>
                <tr>
                  <td><?= $index; ?></td>
                  <td><?= ucfirst($name); ?><br><b>Email Id:-</b>&nbsp;<?= $row->EmailId; ?><br><?= $row->MobileNo; ?><br></td>
                   <td><?= $row->University; ?></td>
                  <td>
                    <ul class="progress-indicator">
                      <li class="completed">
                        <span class="bubble"></span>Invited
                      </li>
                      
                      <li <?php if ($row->referalstatus == ('A')) {echo 'class="completed"' ;}; ?>>
                        <span class="bubble"></span>Accepted
                      </li>
                      
                      <li <?php if ($progress_status == ('B' || 'C' || 'D' || 'E' || 'Y') && $progress_status != 'A') {echo 'class="completed"' ;}; ?>> 
                        <span class="bubble"></span>Fees Paid
                      </li>
                      
                      <li <?php if ($progress_status == ('C' || 'D' || 'E' || 'Y') && $progress_status != 'A' && $progress_status != 'B') {echo 'class="completed"' ;}; ?>> 
                        <span class="bubble"></span>Enrolled
                      </li>
                    </ul>
                  </td>
                  <td>
                  <?php
                   if ($progress_status == ('C' || 'D' || 'E' || 'Y') && $progress_status != 'A' && $progress_status != 'B')
                   echo '<button class="btn btn-default" disabled>Send Reminder</button>';
                   else 
                   {
                    if($progress_status==''||$progress_status==NULL)  $progress_status='R';
                      
                      echo '<button class="btn btn-info" onclick=send_reminder("'.$universityid.'","'.$row->referalID.'","'.$progress_status.'","'.$row->Firstname.'","'.$row->EmailId.'","'.$row->MobileNo.'");>Send Reminder</button>';
                   }


                   echo '<br><br><button class="btn btn-default" onclick=hidecontact("'.$row->referalID.'","'.$universityid.'");>Hide</button>';
                   echo "</td></tr>";
                      $index ++;
                    }  
                  }
                  else
                  {
                    if($row->IsVisible=="0")
                 {
                ?>
                <tr>
                  <td><?= $index; ?></td>
                  <td><?= ucfirst($name); ?><br><b>Email Id:-</b>&nbsp;<?= $row->EmailId; ?><br><?= $row->MobileNo; ?><br></td>
                   <td><?= $row->University; ?></td>
                  <td>
                    <ul class="progress-indicator">
                      <li class="completed">
                        <span class="bubble"></span>Invited
                      </li>
                      
                      <li <?php if ($row->referalstatus == ('A')) {echo 'class="completed"' ;}; ?>>
                        <span class="bubble"></span>Accepted
                      </li>
                      
                      <li <?php if ($progress_status == ('B' || 'C' || 'D' || 'E' || 'Y') && $progress_status != 'A') {echo 'class="completed"' ;}; ?>> 
                        <span class="bubble"></span>Fees Paid
                      </li>
                      
                      <li <?php if ($progress_status == ('C' || 'D' || 'E' || 'Y') && $progress_status != 'A' && $progress_status != 'B') {echo 'class="completed"' ;}; ?>> 
                        <span class="bubble"></span>Enrolled
                      </li>
                    </ul>
                  </td>
                  <td>
                  <?php
                   echo '<br><br><button class="btn btn-default" onclick=showcontact("'.$row->referalID.'","'.$universityid.'");>Show</button>';
                   echo "</td></tr>";
                      $index ++;
                    }  
                  }
                 
                  }
                ?>
              </tbody>
            </table>
          </div>
          <p align="center"><a  href="<?php echo base_url()?>Referfriend/view/<?= $universityid;?>/0" class="btn btn-primary btn-block btn-flat btn-lg" id="refer" style="width:300px;" >Invite More Friends</a></p>
        </div>
      </div>
    </div>
    </section>

    
  </div>
  <div class="control-sidebar-bg"></div>
</div>

<script src="<?php echo  base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?php echo  base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/morris/morris.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/sparkline/jquery.sparkline.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/knob/jquery.knob.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/fastclick/fastclick.js');?>"></script>
<script src="<?php echo  base_url('assets/dist/js/app.min.js');?>"></script>
<script src="<?php echo  base_url('assets/dist/js/demo.js');?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript">
$("#ddown").click(function (){
    if ($(this).hasClass("dropdown notifications-menu")) {
        $(this).removeClass("dropdown notifications-menu").addClass("dropdown notifications-menu open");
    }
    else if ($(this).hasClass("dropdown notifications-menu open")) {
        $(this).removeClass("dropdown notifications-menu open").addClass("dropdown notifications-menu");
    }

});
  </script>
<script>

$.fn.dataTable.ext.errMode = 'none';
$('#progresstable').DataTable({
      "paging": true,
      "searching": true,
      "ordering": true,    
    });

  function send_reminder(universityid,referalID,progress_status,firstname,EmailId,mobileno)
    {   
         url = '<?php echo base_url()."Progress_support/sendreminder/'+universityid+'/'+referalID+'/'+firstname+'/'+mobileno+'";?>';
        $.ajax({
              type: "POST",
              data:{uid: universityid, refid: referalID, status: progress_status, FirstName: firstname, emailid: EmailId, MobileNo: mobileno},
              url:url,//"<?= base_url('Progress/sendreminder/') ?>",
              success: function(data) 
              {
                if(data=='1')
                {
                  $("#msg").html('<div class="alert alert-success text-center flash-messages" ">Reminder Mail Sent Successfully</div>'); 
                   $('html, body').animate({ scrollTop: 0 }, 0);
                }
                else
                {
                 $("#msg").html('<div class="alert alert-danger text-center flash-messages"">Failed to send reminder mail. Please Try Again!!</div>'); 
                }  $('html, body').animate({ scrollTop: 0 }, 0);               
                  //$("#msg").html(data);
                console.log(data);
              }
            });
          
     }
   function hidecontact(referalID,uid) 
   {
     url = '<?php echo base_url()."Progress_support/hidecontact/'+referalID+'";?>';
        $.ajax({
              type: "POST",
              data:{referalID: referalID},
              url:url,//"<?= base_url('Progress/sendreminder/') ?>",
              success: function(data) {
                if(data=='1')
                {
                  window.location = '<?= base_url()?>Progress/track/<?= $uid;?>/1';
                }
                else
                {
                 $("#msg").html('<div class="alert alert-danger text-center flash-messages"">Failed to hide contact. Please Try Again!!</div>'); 
                }                
                 console.log(data);
              }
            });
         
   }  
      function showcontact(referalID,uid) 
   {
     url = '<?php echo base_url()."Progress_support/showcontact/'+referalID+'";?>';
     //alert(url);
        $.ajax({
              type: "POST",
              data:{referalID: referalID},
              url:url,//"<?= base_url('Progress/sendreminder/') ?>",
              success: function(data) {
                //alert(data);
                if(data=='1')
                {
                  window.location = '<?= base_url()?>Progress/track/<?= $uid;?>/0';
                }
                else
                {
                 $("#msg").html('<div class="alert alert-danger text-center flash-messages"">Failed to hide contact. Please Try Again!!</div>'); 
                }                
                 console.log(data);
              }
            });
         
   } 
</script>
</body>
</html>