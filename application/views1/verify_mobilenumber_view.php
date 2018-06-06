<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Referral Program | Verify Mobile Number</title>
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
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/progress-wizard.min.css');?>">
  
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
  <!--Datatables-->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css');?>"/>
  <style type="text/css">
.required{
 color: red;   
}
.body{
    min-height: 650px;
}

.info-box-content {
    margin-left: 60px;
}
.fonttext {
    font-size: 12px;
}
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view('Header_view');
  
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper body">

    <!-- Content Header (Page header) -->    
  
    <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Verify Mobile Number</h3>
          </div>
          <div class="box-body">
          
             <form class="form-horizontal" role="form" method="post" action="<?= base_url()?>Login/Check_otp/<?= $universityid?>">
             <div id="msg" class=""><p class="flash-messages"><?php echo $this->session->flashdata('msg');?></p></div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="number">Mobile Number:</label>
              <div class="col-sm-8">
                <input type="number" value="<?php echo $this->session->userdata['logged_in']['MobileNo'];?>" readonly required="required" class="form-control" name="number" id="number" placeholder="Enter mobile number" maxlength="10" minlength="10" required>
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
    </section>
    
  </div>
  <!-- /.content-wrapper -->

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="<?php echo  base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo  base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<!-- FastClick -->

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo  base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<!-- Morris.js charts -->

<script src="<?php echo  base_url('assets/plugins/morris/morris.min.js');?>"></script>
<!-- Sparkline -->
<script src="<?php echo  base_url('assets/plugins/sparkline/jquery.sparkline.min.js');?>"></script>
<!-- jvectormap -->
<script src="<?php echo  base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js');?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo  base_url('assets/plugins/knob/jquery.knob.js');?>"></script>
<!-- daterangepicker -->

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
<!-- DataTables -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript">
  function resendOTP()
  {
          var mobilenumber = $('#number').val();
          url = '<?php echo base_url()."Login/resendotp/<?= $universityid;?>";?>';
          $.ajax({
              type: "POST",
              data:{mobileno: mobilenumber},
              url:url,
              success: function(data) {
                //alert(data);
                console.log(data);
                if(data=="0"){
                    //document.getElementById("otp").disabled = true;
                    $("#msg").html("");
                   $("#msg").html("<div class='alert alert-success text-center'>Mobile Number is verified earlier</div>");

                }
                else
                {
                   $("#msg").html("");
                   $("#msg").html("<div class='alert alert-success text-center'>OTP has been sent to your registered Mobile Number</div>");

                }
              
                
              }
            });
     
      }     
</script>
</body>
</html>