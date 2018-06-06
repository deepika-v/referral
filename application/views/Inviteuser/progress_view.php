<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Referral Module | Progress Tracking</title>
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
.body
{
    min-height: 1024px;
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view('Header_view');?>
  <div class="content-wrapper body">
    <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Progress Tracking</h3>
            <div style="float:right">
              <form class="form-inline" role="form" method="post">
                <div class="form-group">
                    <label for="total_cash" class="text-light-blue">Total amount : <?= $total_amount; ?></label> ||
                    <label for="total_cash" class="text-green">Approved amount : <?= $approved_amount; ?></label>
                    <a href=<?= base_url("Progress/request");?> class="btn btn-info">Claim Cash</a>
                  </div>                      
              </form> 
            </div>
                  <div id="msg"></div>
          </div>
          <div class="box-body">
            <?php echo $this->session->flashdata('msg');?>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Refree Details</th>
                  <th>Referred To</th>
                  <th>Progress</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $index = '1';
                foreach ($referals as $row) {
                  $name = $row->Firstname.' '.$row->Lastname;
                  if ($name == ' ') {
                    $name = 'Demo User';
                }
                $progress_status = $row->Status;
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
                      
                      <li <?php if ($progress_status == ('A' || 'B' || 'C' || 'D' || 'E' || 'Y')) {echo 'class="completed"' ;}; ?>>
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
                </tr>
                <?php
                    $index ++;
                  }
                ?>
              </tbody>
            </table>
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

</body>
</html>
