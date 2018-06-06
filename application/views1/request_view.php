<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Redemption request</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
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
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/referal.css');?>"/>
  <style type="text/css">
.required{
 color: red;   
}
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view('Header_view');?>
  <div class="content-wrapper body">
    <section class="content">
     <div class="panel panel-default">
     <div class="panel-heading">Redemption request</div>
     <div class="panel-body">
        <div class="row">
            <div class="col-md-8">
              <div class="panel panel-primary">
                <div class="panel-body">
                  <p class="text-aqua lead">About redemption request</p>
                  <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus congue gravida magna nec ultrices. Vivamus hendrerit, ex et tincidunt volutpat, elit mauris sodales nulla, quis vehicula metus purus nec purus.</p>
                  <p class="text-muted">Maecenas rutrum, odio id molestie rhoncus, arcu lorem tempus nunc, sit amet tincidunt turpis est et urna.</p>
                  <p class="text-muted">Donec aliquam iaculis neque at vehicula. Sed et tincidunt lectus. Etiam a ultricies turpis, non facilisis dolor.</p>
                  <p class="text-muted">ICras pretium fringilla libero ut egestas.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="panel panel-primary">
                <div class="panel-body">
                  <p class="lead text-green">Claim your cash :</p>
                   <form  method="post" id="claim_amount">
  <?php
                        if ($approved_amount > 0) {
        ?>                  
                          
                <p>You can choose amount to transfer in your account.</p>
                <p><label>Available for redemption: </label>
                <span><?=$approved_amount?></span>
                <i class="fa fa-fw fa-rupee"></i>
                <input type="hidden" name="min_amount" id="min_amount" value="<?=$approved_amount?>">
                <input type="hidden" name="redeemamount" id="redeemamount" value="<?=$redeemed_amount?>">
                </p>
                <label>Enter amount :</label>
                <input type="text" name="amount" id="amount" style="width:100px;">
                <i class="fa fa-fw fa-rupee"></i>
                <p class="text-muted">* Minimum amount you can claim is 500 <i class="fa fa-fw fa-rupee"></i></p>
                <center>
                <button type="submit" class="btn bg-olive margin btn-sm" onclick="claimrequest();return false;">Request redemption</button>
                </center>
            <?php 
             }else{
                echo '<p>We will reward you when you refer friends and family.</p>';
              }
              ?>
            </form>
                 
                  <div id="msg"></div>
                </div>
              </div>
            </div>
        </div> 
     </div>
</div>
    </section>
  </div>
  <div class="control-sidebar-bg"></div>
</div>

<script src="<?php echo  base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<script src="<?php echo  base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="<?php echo  base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/morris/morris.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/sparkline/jquery.sparkline.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/knob/jquery.knob.js');?>"></script>
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


function claimrequest()
    {   
      //alert("in claim script");
      var min_amount = $('#min_amount').val();
      var amount = $('#amount').val();
      var redeemamount =  $('#redeemamount').val();
       url = '<?php echo base_url()."Progress_support/Claim_request/'+min_amount+'/'+amount+'/'+redeemamount+'";?>';
       //alert(url);
        $.ajax({
              type: "POST",
              data:{min_amt: min_amount, amt: amount},
              url:url,
              success: function(data) {
                //alert(data);
                $("#msg").html(data);
                
              }
            });
     
      }
</script>


</body>
</html>










