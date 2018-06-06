<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Referral Module | OTP verification form</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/flat/blue.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/morris/morris.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datepicker/datepicker3.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">
</head>
<body class="hold-transition register-page">
<div class="wrapper">
  <div class="tab-content">
   <div class="login-logo">
    <a href="#"><b>Referral</b> Program</a>
          <?php
              $name = $uni_details->CustomerName;
              $uid = $uni_details->CustomerId;
              $logo = $uni_details->logo;
            ?>
          <!--<div class="col-lg-12 logo-ref text-center">
              <img src="http://ums.ksouonline.edu.in/Document/Data_<?= $uid;?>/<?= $logo;?>" alt="aisect"/>
            </div> -->
      </div>   
            <div class="clearfix"></div>
  
     
  

    <div class="register-box">

      <div class="panel panel-primary">

        <div class="panel-heading">
        Verify mobile number 
        </div>
        <div class="panel-body">

        <div id="msg"></div>
         <?php echo $this->session->flashdata('msg');?> 
         <form class="form-horizontal" role="form" method="post" action="<?= base_url()?>Registration_support/Check_otp/<?= $universityid?>">
            <div class="form-group">
              <label class="control-label col-sm-4" for="number">Mobile Number:</label>
              <div class="col-sm-8">
                <input type="number" value="<?php echo $this->session->userdata('mobile');?>" readonly required="required" class="form-control" name="number" id="number" placeholder="Enter mobile number" maxlength="10" minlength="10" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="otp">OTP:</label>
              <div class="col-sm-8"> 
                <input type="text" required="required" class="form-control" id="otp" name="otp" placeholder="Enter otp received on your phone">
              </div>
            </div>
            <div class="form-group"> 
              <div class="col-sm-offset-4 col-sm-10">
                <button type="submit" class="btn btn-success">Submit</button>
                  <button type="button" class="btn btn-primary" onclick="resendOTP()">Resend OTP</button>
              </div>
              
              
              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>  
<script src="<?php echo  base_url('assets/global/plugins/jquery-migrate.min.js');?>" type="text/javascript"></script>
<script src="<?php echo  base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?php echo  base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/morris/morris.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/sparkline/jquery.sparkline.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/knob/jquery.knob.js');?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/daterangepicker/daterangepicker.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/datepicker/bootstrap-datepicker.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/fastclick/fastclick.js');?>"></script>
<script src="<?php echo  base_url('assets/dist/js/app.min.js');?>"></script>
<script src="<?php echo  base_url('assets/dist/js/pages/dashboard.js');?>"></script>
<script src="<?php echo  base_url('assets/dist/js/demo.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  function resendOTP()
  {
          var mobilenumber = $('#number').val();
      //var amount = $('#amount').val();
      //var redeemamount =  $('#redeemamount').val();
       url = '<?php echo base_url()."Registration_support/resendotp/";?>';
       //alert(url);
        $.ajax({
              type: "POST",
              data:{mobileno: mobilenumber},
              url:url,
              success: function(data) {
                //alert(data);
                console.log(data);
                var NAME = document.getElementById("msg");
                NAME.className = (NAME.className == "") ? "alert alert-success" : "";
                $("#msg").html(data);
                
              }
            });
     
      }     
  
</script>
</body>
</html>
