<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Referral Program | Registration Form</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/registerform/css/bootstrap.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/registerform/css/referal-form.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <style type="text/css">
    span{
      color: red;
    };   
  </style>
</head>
<body class="hold-transition register-page">

  <div class="login-logo">
    <a href="#"><b>Referral</b> Program</a>
  </div>
  <div id="ref-form" class="col-md-6 col-md-offset-3">
      <div class="row">
       <?php
              $name = $uni_details->CustomerName;
              $uid = $uni_details->CustomerId;
              $logo = $uni_details->logo;
            ?>
          <div class="col-lg-12 logo-ref text-center">
              <img src="http://ums.ksouonline.edu.in/Document/Data_<?= $uid;?>/<?= $logo;?>" alt="aisect"/>
            </div>
            <div class="clearfix"></div>
            <div><p class="flash-messages"><?php echo $this->session->flashdata('msg');?></p>
    <?php if($this->session->flashdata('message')) {?>
 <label class="flash-messages"><span style="color: #CC6633"><?php echo $this->session->flashdata('message');?><span></label>
<?php }?></div>
          
            <div class="clearfix"></div>
            <hr> 
            <div id="message"></div>
            
            <?php if($emailcheck=="1"){?>           
             <form id="registration_form" method="post">
            <input type="hidden" value="<?= $email;?>" id="email" name="email">
            <input type="hidden" value='<?= $photourl;?>' id="photourl" name="photourl">
            <input type="hidden" value='<?= $facebookid;?>' id="facebookid" name="facebookid">
            <input name="first_name" value='<?= $first_name;?>' type="hidden">
            <input name="last_name"  value='<?= $last_name;?>' type="hidden">
            <input name="accesstoken"  value='<?= $accesstoken;?>' type="hidden">
            <input name="action" value="0" id="action" type="hidden">
            <h4 class="text-center">Enter Details</h4>
              <div class="row">              
               <div class="form-group" align="center">
                <input maxlength="10" minlength="10" name="primary_number" id="primary_number" class="form-control" min="0" placeholder="Mobile Number" required="required" type="text">
              </div>
              </div>                       
              <div class="row">
              <div class="form-group" align="center">
                <input name="password" class="form-control" placeholder="Password" required="required" type="password">
               </div>
               </div>
               <div class="row">
               <div class="form-group" align="center">
                <input name="confirm_password" class="form-control" placeholder="Confirm Password" required="required" type="password">
              </div>
              </div>
            <div class="row">
            <div class="form-group" align="center">
              <div class="checkbox">
                <label>
                <input name="terms" type="checkbox">
                  I agree to the <a href="#">Terms and Conditions.</a>
                </label>
              </div>
            </div>
            </div>
            <div class="row">
              <div class="col-xs-4 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Continue</button>
              </div>
            </div>
            </form>
            <?php 
          }
          elseif($emailcheck=="2"){
            ?>
              <div class="row login-box">
                   <form action="<?php echo base_url('facebookcallback/loginuser/'.$uid.'');?>" method="post">
                <h4 class="text-center">Login</h4>
                <div class="col-lg-5 col-md-6 form-group">
               <input type="hidden" value="<?= $email;?>" id="email" name="email">
                <input type="hidden" value='<?= $photourl;?>' id="photourl" name="photourl">
                <input type="hidden" value='<?= $facebookid;?>' id="facebookid" name="facebookid">
                 <input name="first_name" value='<?= $first_name;?>' type="hidden">
                <input name="last_name"  value='<?= $last_name;?>' type="hidden">
                <input name="accesstoken"  value='<?= $accesstoken;?>' type="hidden">
                <input name="action" value="1" id="action" type="hidden">

                <input maxlength="10" minlength="10" name="username" id="username" class="form-control" min="0" placeholder="Mobile Number" required="required" type="text">
                </div>
                <div class="col-lg-5 col-md-6 form-group">
                <input name="password" class="form-control" placeholder="Password" required="required" type="password">
                </div>
                <div class="col-lg-2 col-md-2 form-group">
                <button type="submit" class="btn btn-primary btn-block btn-flat pull-right">Login</button>
                </div>
                <!--<a href="<?php echo base_url('Login/forgotpassword/'.$universityid.'');?>">Forgot Password?</a><br>-->
                </form>
              </div>
           <?php }
          elseif($emailcheck=="0"){
          ?> 
          <div class="panel panel-primary">
                <div class="panel-body">
                <form action="" method="post" id="requestform">
                <input type="hidden" value="<?= $email;?>" id="email" name="email">
                <input type="hidden" value='<?= $photourl;?>' id="photourl" name="photourl">
                <input type="hidden" value='<?= $facebookid;?>' id="facebookid" name="facebookid">
                 <input name="first_name" value='<?= $first_name;?>' type="hidden">
                <input name="last_name"  value='<?= $last_name;?>' type="hidden">
                <input name="accesstoken"  value='<?= $accesstoken;?>' type="hidden">
                <input name="action" value="" id="action" type="hidden">
                <div class="panel panel-primary">
                 <div class="panel-heading">
                   <h4 align="center">Are you  a registered user of Referral Program?</h4>
                 </div>
                <div class="panel-body">
                  <input type="submit"  class="btn btn-default btn-lg pull-right" style="margin-left:10px;" onclick="displayregistereduser(1)" value="Yes">
                  <input type="submit" class="btn btn-default btn-lg pull-right" id="nobutton" value="No" onclick="displayregistereduser(0)">             
                </div>
                </div>
              </div>      
              </form>
                </div>             
          <?php
        }
          ?>        
</div>
<script src="<?php echo  base_url('assets/global/plugins/jquery-migrate.min.js');?>" type="text/javascript"></script>
<script src="<?php echo  base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
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
<script type="text/javascript">
      $(document).ready(function(){
        var form=$("#registration_form");
          $("#registration_form").submit(function(e){
            e.preventDefault();
            $.ajax({
              type: "POST",
              data:form.serialize(),
              url:"<?= base_url() ?>facebookcallback/registeruser/<?= $uid;?>",
              success: function(data) {
                console.log(data);
                if(data != null && data == "success"){ 
                  window.location = '<?= base_url()?>Registration_support/verify_otp/';
                }else
                {
                  $("#message").html(data);
                }
              }
            });
          });
       
        });
    </script>
    <script type="text/javascript">
     $("#username").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
       // $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
      $("#primary_number").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
       // $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
  $("#pin_code").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
       // $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
function validate_text(event)
{
  var chCode = ('charCode' in event) ? event.charCode : event.keyCode;

                // returns false if a numeric character has been entered
  return (chCode < 48 /* '0' */ || chCode > 57 /* '9' */);

}
function displayregistereduser(act){
  console.log(act);
  document.getElementById("requestform").action = "<?= base_url() ?>facebookcallback/displaylogin/<?= $uid;?>/"+act;  
  //<?php echo base_url('facebookcallback/displaylogin/'.$uid.'');?>
  console.log(document.getElementById("requestform").action);
  document.getElementById('action').value=act;
  return true;
}
</script>
</body>
</html>
