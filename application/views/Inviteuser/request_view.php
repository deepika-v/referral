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
                  <p>You can choose amount to transfer in your account.</p>
                  <form class="form-horizontal" id="claim_amount">
                    <p><label>Approved amount: </label>
                        <span><?= $total_amount; ?></span>
                        <i class="fa fa-fw fa-rupee"></i>
                        <input type="hidden" name="min_amount" id="min_amount" value="<?= $total_amount; ?>">
                    </p>
                    <label>Enter amount :</label>
                    <input type="text" name="amount" style="width:100px;">
                    <i class="fa fa-fw fa-rupee"></i>
                    <p class="text-muted">* Minimum amount you can claim is 500 <i class="fa fa-fw fa-rupee"></i></p>
                    <center>
                      <button type="submit" class="btn bg-olive margin btn-sm">Claim cash</button>    
                    </center>
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
<script type="text/javascript">
   $(document).ready(function(){
        var form=$("#claim_amount");
          $("#claim_amount").submit(function(e){
            e.preventDefault();
            $.ajax({
              type: "POST",
              data:form.serialize(),
              url:"<?= base_url() ?>Progress/Claim_request",
              success: function(data) {
                $("#msg").html(data);
              }
            });
          });
        });
</script>

</body>
</html>










