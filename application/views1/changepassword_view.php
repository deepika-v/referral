<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Referral Module | Change Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->

  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/flat/blue.css');?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/morris/morris.css');?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css');?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datepicker/datepicker3.css');?>">

  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css');?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/referal.css');?>"/>
</head>
<body class="hold-transition register-page">
<div class="wrapper">

  <?php //$this->load->view('Header_view');?>

    <div class="tab-content">
      <!-- Home tab content -->
      
<div class="register-box">
  <div class="register-logo">
   
  </div>

    <!-- /.login-logo -->
     <div class="login-logo">
    <a href="#">Referral <b>Module</b></a>
  </div>
  <div class="login-box-body">  
    <p class="login-box-msg">Change Password</p>
    <p class="flash-messages"><?php echo $this->session->flashdata('msg');?></p>
 <form action="<?php echo base_url('Login/updatepassword/'.$universityid.'');?>" method="post">
 <div class="form-group">
<?php if($this->session->flashdata('message')) {?>
 <label class="flash-messages"><span style="color: #CC6633"><?php echo $this->session->flashdata('message');?><span></label>
<?php }?>
</div>
<div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email Id" name="emailid" id="emailid" value="<?php echo $emailid;?>" readonly>
        <!--<input type="number" class="form-control" placeholder="MobileNo" name="username" id="username">-->
        
</div>
<div class="form-group has-feedback">
       <input type="text" maxlength="10" minlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  name="mobileno" class="form-control" min="0" placeholder="Mobile Number" value="<?php echo $mobileno;?>" required="required" readonly>
        <!--<input type="number" class="form-control" placeholder="MobileNo" name="username" id="username">-->
        
</div>
<div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="<?php echo set_value('password');?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" id="cpassword" value="<?php echo set_value('cpassword');?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>
<div class="form-group">
     <span style="color:red"><?php echo form_error('emailid');?></span>
</div>
      
  
  <button type="submit" class="btn btn-default">Submit</button>
</form>
   <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <!--<a href="<?php echo base_url('Login/'.$universityid.'');?>">Login</a><br>
    <a href="<?php echo base_url('Registration/'.$universityid.'');?>" class="text-center">Not User? Register</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
  <!-- /.form-box -->
</div>
<!-- jQuery 2.2.3 -->
<script src="<?php echo  base_url('assets/global/plugins/jquery-migrate.min.js');?>" type="text/javascript"></script>
<script src="<?php echo  base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo  base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/morris/morris.min.js');?>"></script>
<!-- Sparkline -->
<script src="<?php echo  base_url('assets/plugins/sparkline/jquery.sparkline.min.js');?>"></script>
<!-- jvectormap -->
<script src="<?php echo  base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js');?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo  base_url('assets/plugins/knob/jquery.knob.js');?>"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/daterangepicker/daterangepicker.js');?>"></script>
<!-- datepicker -->
<script src="<?php echo  base_url('assets/plugins/datepicker/bootstrap-datepicker.js');?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo  base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>"></script>
<!-- Slimscroll -->
<script src="<?php echo  base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
<!-- FastClick -->
<script src="<?php echo  base_url('assets/plugins/fastclick/fastclick.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo  base_url('assets/dist/js/app.min.js');?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo  base_url('assets/dist/js/pages/dashboard.js');?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo  base_url('assets/dist/js/demo.js');?>"></script>
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>

</body>
</html>





















