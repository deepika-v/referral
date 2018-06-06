<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Refer Friend</title>
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


  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view('Header_view');
  $i=1;
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper body">

    <!-- Content Header (Page header) -->
  
    <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Refer Friends</h3>
          </div>
          <div class="box-body">
          <p><?php echo $this->session->flashdata('msg');?></p>
     
           <br/>
          <table class="table table-bordered" id="refertable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email Id</th>
                  <th>Mobile No</th>
                  <th></th>
                </tr>                
              </thead>
              <tbody>
       <?php
     $i=0;
       foreach($google_contacts as $list)
  {
    ?>
    <tr>
    <td><img src="<?php echo $list['img_url'];?>" height="50" width="50"/></td>
    <td><?php if($list['name']==''){ echo $list['email'];}else{ echo $list['name'];}?></td>
    <td><?php echo $list['email'];?></td>        
    <td><input type="text" class="form-control" placeholder="Mobile Number" id="mobile1" pattern="[7-9]{1}[0-9]{9}" name="mobile1[]"></td>
    <td><p id="btn<?php echo $i;?>"><button type="button" onclick="invite_friends('<?php echo $list['name']?>,<?php echo $list['email'];?>,<?php echo $i;?>');">Invite</button></p></td>
    </tr>
       <?php
     $i=$i+1;
  }
  ?>
  </tbody>
    </table>
  </div>
    
        
  </body>
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
<!--Datatables-->
<!-- DataTables -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript">
 

$("#add_new").click(function () { 

    $("#refertable").each(function () {
       
        var tds = '<tr>';
        jQuery.each($('tr:last td', this), function () {
            tds += '<td>' + $(this).html() + '</td>';
        });
        tds += '</tr>';
        if ($('tbody', this).length > 0) {
            $('tbody', this).append(tds);
        } else {
            $(this).append(tds);
        }
    });
});

// JavaScript Document

//function for sending invite using javascript

function invite_friends(nameemail)
{
  var res = nameemail.split(",");
  
  var name = res[0];
  
  var email = res[1];
  
  var count = res[2];
  
  
  
  var dataString = 'name=' + name + '&email=' + email + '&page=invite';
  $url = "<?php echo base_url();?>/Referfriend/"
        $.ajax({
            type: "POST",
            url: $url,
            data: dataString,
            cache: false,
            beforeSend: function() {
                $("#btn"+count).html('');
        $("#btn"+count).html('<button type="button">Inviting...</button>');
            },
            success: function(response) {
                var response_brought = response.indexOf("invited");
                if (response_brought != -1) {
                    $("#btn"+count).html('');
          $("#btn"+count).html('<button type="button">Invited</button>');
          $(".inviteDiv"+count).fadeOut(500);
          
                } else {
                  
                }
            }
        });
  
}

  $('#refertable').DataTable({
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "pageLength": 5,
      "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]]//,
      
    });



</script>

</body>
</html>
