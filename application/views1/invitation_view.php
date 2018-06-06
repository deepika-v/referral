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
<body>
	<?php
					 $ref_id = base64_encode($id);
					 $token = str_replace('=','.', $ref_id);
		      	?>	

	<div id="ref-form" class="col-md-6 col-md-offset-3" style="margin-top:25px;">
    <div class="row" >
        <div class="col-lg-12 logo-ref text-center">
       		<img src="http://ums.ksouonline.edu.in/Document/Data_<?= $uid;?>/<?= $logo;?>" alt="aisect"/>
        </div>
        <p class="text-center lead"><?= $Uname; ?></p>
        
        <div id="message">
        </div>
        
        <div class="clearfix"></div>
        <?php if($status=="I"){?>
        <form class="form-horizontal" style="margin-top:20px;" id="invitation" method="post" class="text-center" >
		    <div class="form-group">
		      <label class="control-label col-sm-4">First Name  </label>
		      <div class="col-sm-6">
		      	<input type="hidden" name="id" value="<?= $id; ?>">
		      	
		      	<input type="hidden" value="<?= $uid?>" name="uid">
		      	<input type="hidden" name="link" value="<?= $link?>">
		      	<input type="hidden" name="uname" value="<?= $Uname; ?>">
		      	<input type="hidden" name="shortname" value="<?= $shortname; ?>">
		        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?= $fname; ?>" required>
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-4">Last Name</label>
		      <div class="col-sm-6">
		        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?= $lname; ?>" required>
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-4">Mobile Number  </label>
		      <div class="col-sm-6">
		        <input type="text" class="form-control" id="number" name="number" placeholder="Mobile Number" value="<?= $number; ?>" required>
		      </div>
		    </div>
			<div class="form-group">
		      <label class="control-label col-sm-4">Email Id </label>
		      <div class="col-sm-6">
		        <input type="email" class="form-control" id="email" name="email" placeholder="Email Id" value="<?= $Email; ?>" required>
		      </div>
		    </div>		    
		    <div class="form-group">
		      <div class="text-center">
		        <button type="submit" id="submit" class="btn btn-success btn-lg">Accept</button>
		      </div>
		    </div>
  		</form>
  		<?php
  		}
  		else
  		{
       
	   echo "<p class='text-aqua text-center lead'>Thank you for accepting invitation!</p><p class='lead text-center'><a href='".$link."'>Click here </a> to continue.</p>";
      

  			 
  		 }?>
	</div>
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
        var form=$("#invitation");
          $("#invitation").submit(function(e){
            e.preventDefault();
            $.ajax({
              type: "POST",
              data:form.serialize(),
              url:"<?= base_url()?>Invitation/accept_invitation",
              success: function(data) {
               		$("#message").html(data);
               		$("#invitation").hide();
               		
               		$('#submit').prop("disabled", true);
                }
            });
          });
          });
    </script>

</body>
</html>
