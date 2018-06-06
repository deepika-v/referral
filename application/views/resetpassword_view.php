<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Referral Program | Refer Friend</title>
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
            <h3 class="box-title">Change Password</h3>
          </div>
          <div class="box-body">
        <form action="<?php echo base_url('Login/reset_password/'.$universityid.'');?>" method="post">
 <div class="form-group">
<?php if($this->session->flashdata('message')) {?>
 <label class="flash-messages"><span><?php echo $this->session->flashdata('message');?></span></label>
<?php }?>
</div>
<div class="form-group has-feedback">
        <input type="hidden" class="form-control" placeholder="Email Id" name="emailid" id="emailid" value="<?php echo $emailid;?>" readonly>
        <!--<input type="number" class="form-control" placeholder="MobileNo" name="username" id="username">-->
        
</div>
<div class="form-group has-feedback">
       <input type="hidden" maxlength="10" minlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  name="mobileno" class="form-control" min="0" placeholder="Mobile Number" value="<?php echo $mobileno;?>" required="required" readonly>
        <!--<input type="number" class="form-control" placeholder="MobileNo" name="username" id="username">-->
        
</div>
<div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Enter New Password" name="password" id="password" value="<?php echo set_value('password');?>">
        
</div>
<div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" id="cpassword" value="<?php echo set_value('cpassword');?>">
        <!--<span class="glyphicon glyphicon-lock form-control-feedback"></span>-->
</div>
<div class="form-group">
     <span style="color:red"><?php echo form_error('emailid');?></span>
</div>    
  
  <button type="submit" class="btn btn-default">Submit</button>
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
<?php

  if($viewform=="1")
  {
    echo '<script type="text/javascript">
        document.getElementById("referform").style.display = "block";
     </script>';
}
else{
echo '<script type="text/javascript">
   document.getElementById("referform").style.display = "none";
</script>';
}
?>
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
g_flag = document.getElementById('gflag').value;
if(g_flag=="0")
{
  $.fn.dataTable.ext.errMode = 'none';
$('#refertable').DataTable({
      "paging": true,
      "searching": false,
      "ordering": false,
      "info": false,
       "paging": false
      //"bPaginate": false
    });


}
else
{
  $.fn.dataTable.ext.errMode = 'none';
$('#refertable').DataTable({
      "paging": true,
      "searching": false,
      "ordering": false,
      "info": true,
      "pageLength": 10,
      "lengthMenu": [[10, 15, 20, -1], [10, 15, 20, "All"]]//,
    });


}

     $('#select_all').click(function(event)
                     {
                       if (this.checked) 
                        {
                          // Iterate each checkbox
                          $(':checkbox').each(function()
                           {
                              this.checked = true;
                              this.value = "1";
                           });
                        }
                        else
                        {
                          $(':checkbox').each(function()
                           {
                              this.checked = false;
                           });
                        }
                     });
function checkmobilenumber(entered_mobileno)
{
  usermobileno = document.getElementById('usermobileno').value;
  if(entered_mobileno==usermobileno)
   alert("You cannot refer your self");
   $(this).value= "";
}
function checkemail(entered_email)
{
  useremailid = document.getElementById('useremailid').value;
  if(entered_email==useremailid)
   alert("You cannot refer your self");
   this.value= "";
}
function checkemailcontacts(entered_email)
{
  var data1 = new Array();
        $("input[name='chk[]']:checked").each(function(i)
         {
            data1.push($(this).val());
         });
        console.log(data1);

        if(data1=='0'||data1=="")
        {
          return true;
        }
        else
        {
          useremailid = document.getElementById('useremailid').value;
          if(entered_email==useremailid)
          alert("You cannot refer your self");

          return false;
        }  
}
function selectcontacts(g_flag)
{ 
  if(g_flag =='1')
  {
    var data1 = new Array();
        $("input[name='chk[]']:checked").each(function(i)
         {
            data1.push($(this).val());
         });
        console.log(data1);

        if(data1=='0'||data1=="")
        {
          alert("Select Contacts to refer");
          return false;
        }
        else
        {
          //alert(g_flag);

          return true;
        }
  }
  else
    return true;
}

</script>
<script type="text/javascript">
function validate_mobile(e)
{
    var regex = new RegExp("^[0-9-]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str))
    {
        return true;
    }
    e.preventDefault();
    return false;

}

function validate_text(event)
{
  var chCode = ('charCode' in event) ? event.charCode : event.keyCode;

                // returns false if a numeric character has been entered
  return (chCode < 48 /* '0' */ || chCode > 57 /* '9' */);

}
$("#copylink").click(function(){
  var holdtext = $("#sharelink").innerText;
  Copied = holdtext.createTextRange();
  Copied.execCommand("Copy");
}); 
</script>

</body>
</html>
