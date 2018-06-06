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
          <p class="flash-messages"><?php echo $this->session->flashdata('msg');?></p>
          <div class="social-auth-links text-center">  
         <!--<a href="#" class="btn btn-social btn-facebook btn-flat pull-right"  style="width:25%;margin-left:1%"><i class="fa fa-facebook"></i> Invite friends using
        Facebook</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
        <a href="https://accounts.google.com/o/oauth2/auth?client_id=260406686958-je88b0aeajvrlf8g8rejaev988kp4na7.apps.googleusercontent.com&redirect_uri=<?php echo base_url();?>Inviteusers/&scope=https://www.google.com/m8/feeds/&response_type=code" class="btn btn-social btn-google btn-flat pull-right"><i class="fa fa-google-plus"></i>Invite your Google Contacts</a>
        </div>
        <br>
        <br>
        <?php $g_flag = '' ;
             if(!empty($google_contacts))
             $g_flag = '1';
              else
               $g_flag = '0';         
        ?>
        <form action="<?php echo base_url('Referfriend/add');?>" method="post" onsubmit="return(selectcontacts(<?php echo $g_flag;?>));">
        <?php  $usermobileno = $this->session->userdata['logged_in']['MobileNo'];
               $useremailid = $this->session->userdata['logged_in']['Emailid'];


        ?>

        <input type="hidden" value="<?php echo $usermobileno;?>" id='usermobileno'>
        <input type="hidden" value="<?php echo $useremailid;?>" id='useremailid'>
        <table class="table table-bordered" id="refertable">
              <thead>
                <tr>
                <?php
                if(!empty($google_contacts))
                {
                  echo '
                  <th class="table-checkbox"><input type="checkbox" class="group-checkable" value="0" id ="select_all" name="chk[]" data-set="#refertable .checkboxes" /></th>
                  <th>Name</th>
                  <th>Email Id</th>
                  <th>Mobile No</th>';
               } 
               else
               {
                echo '<th class="table-checkbox"><input type="checkbox" class="group-checkable" value="0" id ="select_all" name="chk[]" data-set="#refertable .checkboxes"  hidden/>#</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email Id</th>
                  <th>Mobile No</th>';
                  
               }?> </tr>                
              </thead>
              <tbody>
              <?php 
        if(!empty($google_contacts))
        {

     $i=0;
       foreach($google_contacts as $list)
  {
    ?> 
    <tr>
    <?php if($list['name']==''){ $firstname = $list['email'];}else{ $firstname= $list['name'];}
     $email = $list['email']; ?>
    <td><input type='checkbox' class='checkboxes' name='chk[]'  value='<?php echo $email;?>'/></td>
    <td><input type="text" class="form-control" placeholder="First Name" id="firstname" name="firstname1[]" value="<?php echo $firstname;?>"  readonly >
     <input type="hidden" class="form-control" placeholder="Last Name" id="lastname1" name="lastname1[]" value="<?php echo NULL;?>" ></td>
    <td><input type="email" class="form-control" placeholder="Email Id" id="email" name="email1[]" value="<?php echo $email;?>" onblur="checkemailcontacts(this.value)" readonly></td>
    <td><input type="tel" maxlength="10" minlength="10" class="form-control" placeholder="Mobile Number" id="mobile1"  name="mobile1[]" pattern="[7-9]{1}[0-9]{9}" onkeypress="validate_mobile(event)" onblur="checkmobilenumber(this.value)"></td>
    
    </tr>
       <?php
     $i=$i+1;
  }
          
        }
        else{?>

         <tr id="rows">
                <td><input type='checkbox' class='checkboxes' name='chk[]'  value='0' hidden/></td>
                <td><input type="text" class="form-control" placeholder="First Name" id="firstname1" name="firstname1[]" onkeypress="return validate_text(event)" required></td>
                <td> <input type="text" class="form-control" placeholder="Last Name" id="lastname1" name="lastname1[]" onkeypress="return validate_text(event)"  required></td>
                <td><input type="email" class="form-control" placeholder="Email Id" id="email1" name="email1[]" onblur="checkemail(this.value)"></td>
                <td> <input type="tel" class="form-control" maxlength="10" minlength="10"  placeholder="Mobile Number"  id="mobile1" onkeypress="validate_mobile(event)"   onblur="checkmobilenumber(this.value)" name="mobile1[]" required></td>
                <td><button type="button" class="btn btn-primary btn-block btn-flat" id="add_new" >+</button></td>
                </tr>
             <?php for($i=0;$i<4;$i++){?>   
                <tr>
                <td><input type='checkbox' class='checkboxes' name='chk[]'  value='0' hidden/></td>
                <td><input type="text" class="form-control" placeholder="First Name" id="firstname1" name="firstname1[]" onkeypress="return validate_text(event)" ></td>
                  <td> <input type="text" class="form-control" placeholder="Last Name" id="lastname1" name="lastname1[]" onkeypress="return validate_text(event)" ></td>
                  <td><input type="email" class="form-control" placeholder="Email Id" id="email1" name="email1[]" onblur="checkemail(this.value)"></td>
                  <td> <input type="tel" class="form-control" maxlength="10" minlength="10" placeholder="Mobile Number" id="mobile1" pattern="[7-9]{1}[0-9]{9}" onkeypress="validate_mobile(event)"  onblur="checkmobilenumber(this.value)" name="mobile1[]"></td>
                </tr>
          <?php 
             }
          }?> 
                 
          </tbody>
            </table>
            <br>
            <button type="submit" class="btn btn-primary btn-block btn-flat pull-right" id="refer" style="width:100px;" >Refer</button>
            
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
$.fn.dataTable.ext.errMode = 'none';
$('#refertable').DataTable({
      "paging": true,
      "searching": false,
      "ordering": false,
      "info": true,
      "pageLength": 10,
      "lengthMenu": [[10, 15, 20, -1], [10, 15, 20, "All"]]//,
    });

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
 
</script>

</body>
</html>
