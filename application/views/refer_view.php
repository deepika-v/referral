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
.body
{
    min-height: 650px;
}

.info-box-content {
    margin-left: 60px;
}
.fonttext {
    font-size: 12px;
}
.fonttext1 {
    font-size: 17px;
}
.helpbox{
  margin-top:15px;
}
.helpbox1{
  margin-top:5px;
}
  </style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view('Header_view');
   $this->load->helper('shorturl');
   $referralcode=$this->session->userdata['logged_in']['referralcode']; 
  $i=1;
  $universityid = $this->session->userdata['logged_in']['universityid'];
  $url = $this->session->userdata['logged_in']['url'];
  $link = $url."?token=".base64_encode($referralcode)."";
  $keyword = "ref".$this->session->userdata['logged_in']['userid'];
  $sourcelink = shorten_url($link,$keyword);
  $logo =  $this->session->userdata['logged_in']['universitylogo'];
  $universityname = $this->session->userdata['logged_in']['University'];
  $universitylink = $this->session->userdata['logged_in']['umsurl'];

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
          <div id="message"><?php echo $this->session->flashdata('msg');?></div>
          <div align="center">
              
         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red" style="width:30%;"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
            <a  href="https://accounts.google.com/o/oauth2/auth?client_id=<?= $this->config->item('google_clientid');?>&redirect_uri=<?= base_url();?>Inviteusers/&scope=https://www.google.com/m8/feeds/&response_type=code"> <span class="info-box-text">Invite Your</span>
              <span class="info-box-number fonttext1">Google Contacts</span></a><span><button type="button" class="btn btn-box-tool pull-right" data-widget="collapse" id="helpbutton" title="Help"><i class="fa fa-question-circle" ></i>
                </button><br></span>
             
              
            </div>
            <!-- /.info-box-content -->
              
          <div class="box collapsed-box helpbox" id="helpbox">            
            <!-- /.box-header -->
            <div class="box-body" style="text-align: justify;">
               You can refer  friends from your google contact list to take up course at  <?=$this->session->userdata['logged_in']['University'];?> university.<br><br>
               It will help you to earn cash and your friend can enhance his career. 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        
          </div>
          <!-- /.info-box -->
        </div>
     
        
            <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow" style="width:30%;"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
            <a href="<?php echo base_url()?>Referfriend/view/<?= $universityid;?>/1">
              <span class="info-box-text">Invite</span>
              <span class="info-box-number">Friends </span></a><span><button type="button" class="btn btn-box-tool pull-right" data-widget="collapse" id="helpbutton1" title="Help"><i class="fa fa-question-circle"></i>
                </button><br>
            </div>
             
            <!-- /.info-box-content -->
              <div class="box collapsed-box helpbox" id="helpbox1">
            
            <!-- /.box-header -->
            <div class="box-body">
               <p style="text-align: justify;">You can refer friends by entering few details in form to take up course at  <?=$universityid = $this->session->userdata['logged_in']['University'];?> university.<br><br>
                It is important to fill the form.<br><br> Filling the form would enable us to approach your contacts and help you earn cash!
               </p>          
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          <!-- /.info-box -->
        </div>

         
          
          <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green" style="width:30%;"><i class="fa fa-share-alt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Share Your Link</span>
              <span class="info-box-number"> <input type="text" class="form-control" placeholder="Share this link" id="sharelink" value="<?=$sourcelink?>" onfocus='this.select();' name="sharelink" id="sharelink" readonly="true" style="width:150px;">
              <a  href='<?= $sourcelink?>' class="fonttext"   target = '_blank'>View page</a><button type="button" class="btn btn-box-tool pull-right" data-widget="collapse" id="helpbutton2" title="Help"><i class="fa fa-question-circle"></i>
                </button>
        </span>    </div>
            <!-- /.info-box-content -->
              <div class="box collapsed-box helpbox1" id="helpbox2">
            
            <!-- /.box-header -->
            <div class="box-body">
                <p style="text-align: justify;">You can copy and share above link on social networking sites, or through mail with your friends and help them to take up course at  <?=$universityid = $this->session->userdata['logged_in']['University'];?> university.<br><br>
                 Once your friend is enrolled for course with  <?=$universityid = $this->session->userdata['logged_in']['University'];?> university you can earn cash!
               </p>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          <!-- /.info-box -->
        </div>
            
         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue" style="width:30%;"><i class="fa fa-facebook"></i></span>

            <div class="info-box-content">
            <a  href="#" id="sharebtn">
              <span class="info-box-text">Share Your Link</span>
              <span class="info-box-number">On Facebook</span></a><span><button type="button" class="btn btn-box-tool pull-right" data-widget="collapse" id="helpbutton3" title="Help"><i class="fa fa-question-circle"></i>
                </button><br>

            </div>
            <!-- /.info-box-content -->
              <div class="box collapsed-box helpbox" id="helpbox3">
            
            <!-- /.box-header -->
            <div class="box-body">
               <p style="text-align: justify;">Share link to enrol for a course in <?= $this->session->userdata['logged_in']['University'];?> university with your Facebook friends. <br><br>
                 Once your friend is enrolled for course with  <?=$this->session->userdata['logged_in']['University'];?> university you can earn cash!
               </p>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          <!-- /.info-box -->
        </div>
         
       </div>
       <div class="clearfix"></div>
        <br>
        
        <?php $g_flag = '' ;
             if(!empty($google_contacts))
             $g_flag = '1';
              else
               $g_flag = '0';         
        ?>
        <form id="referform" action="<?php echo base_url('Referfriend/add');?>" method="post"  onsubmit="return(selectcontacts(<?php echo $g_flag;?>));">
        <?php  $usermobileno = $this->session->userdata['logged_in']['MobileNo'];
               $useremailid = $this->session->userdata['logged_in']['Emailid'];
        ?>

        <input type="hidden" value="<?php echo $usermobileno;?>" id='usermobileno'>
        <input type="hidden" value="<?php echo $useremailid;?>" id='useremailid'>
        <input type="hidden" value="<?php echo $g_flag;?>" id='gflag'>
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
                echo '
                  <th class="table-checkbox"><input type="checkbox" class="group-checkable" value="0" id ="select_all" name="chk[]" data-set="#refertable .checkboxes"  hidden/>First Name</th>
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
    <td><input type="hidden" class="form-control" placeholder="First Name" id="firstname" name="firstname1[]" value="<?php echo $firstname;?>"  readonly >
     <input type="hidden" class="form-control" placeholder="Last Name" id="lastname1" name="lastname1[]" value="<?php echo NULL;?>" ><?php echo $firstname;?></td>
    <td><input type="hidden" class="form-control" placeholder="Email Id" id="email" name="email1[]" value="<?php echo $email;?>" onblur="checkemailcontacts(this)" readonly><?php echo $email;?></td>
    <td><input type="tel" maxlength="10" minlength="10" class="form-control" placeholder="Mobile Number" id="mobile1"  name="mobile1[]" pattern="[7-9]{1}[0-9]{9}" onkeypress="validate_mobile(event)" onblur="checkmobilenumber(this)"></td>
    
    </tr>
       <?php
     $i=$i+1;
  }
          
        }
        else{?>

         <tr id="rows">
                
                <td><input type='checkbox' class='checkboxes' name='chk[]'  value='0' hidden/><input type="text" class="form-control" placeholder="First Name" id="firstname1" name="firstname1[]" onkeypress="return validate_text(event)" required></td>
                <td> <input type="text" class="form-control" placeholder="Last Name" id="lastname1" name="lastname1[]" onkeypress="return validate_text(event)"  required></td>
                <td><input type="email" class="form-control" placeholder="Email Id" id="email1" name="email1[]" onblur="checkemail(this)"></td>
                <td> <input type="tel" class="form-control" maxlength="10" minlength="10"  placeholder="Mobile Number"  id="mobile1" onkeypress="validate_mobile(event)"   onblur="checkmobilenumber(this)" name="mobile1[]" required></td>
                
                </tr>
             <?php for($i=0;$i<4;$i++){?>   
                <tr>
                
                <td><input type='checkbox' class='checkboxes' name='chk[]'  value='0' hidden/><input type="text" class="form-control" placeholder="First Name" id="firstname1" name="firstname1[]" onkeypress="return validate_text(event)" ></td>
                  <td> <input type="text" class="form-control" placeholder="Last Name" id="lastname1" name="lastname1[]" onkeypress="return validate_text(event)" ></td>
                  <td><input type="email" class="form-control" placeholder="Email Id" id="email1" name="email1[]" onblur="checkemail(this)"></td>
                  <td> <input type="tel" class="form-control" maxlength="10" minlength="10" placeholder="Mobile Number" id="mobile1" pattern="[7-9]{1}[0-9]{9}" onkeypress="validate_mobile(event)"  onblur="checkmobilenumber(this)" name="mobile1[]"></td>
                </tr>
          <?php 
             }
          }?> 
                 
          </tbody>
            </table>
            <br>
          <div align="center">
           <div class="col-md-3 col-sm-6 col-xs-12" align="center">
           <?php if($g_flag != "1"){?>
          <div class="info-box">
            <button type="button" class="btn btn-default btn-block btn-flat btn-lg" id="add_new" >Add More</button>
          
            <!-- /.info-box-content -->
          </div>
          <?php
          }?>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12" align="center">
          <div class="info-box" align="center">
              <button type="submit" class="btn btn-primary btn-block btn-flat btn-lg" id="refer"  >Invite Your Friends</button>
          </div>
          <!-- /.info-box -->
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
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : "<?= $this->config->item('facebook_appid');?>",
      xfbml      : true,
      version    : "<?= $this->config->item('facebook_graph_version');?>"
    });
  }; 
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<script type="text/javascript">
$("#helpbutton").click(function (){
    if ($("#helpbox").hasClass("box collapsed-box")) {
        $("#helpbox").removeClass("box collapsed-box").addClass("box");
    }
    else if ($("#helpbox").hasClass("box")) {
        $("#helpbox").removeClass("box").addClass("box collapsed-box");
    }
});
$("#helpbutton1").click(function (){
    if ($("#helpbox1").hasClass("box collapsed-box")) {
        $("#helpbox1").removeClass("box collapsed-box").addClass("box");
    }
    else if ($("#helpbox1").hasClass("box")) {
        $("#helpbox1").removeClass("box").addClass("box collapsed-box");
    }

});

$("#helpbutton2").click(function (){
    if ($("#helpbox2").hasClass("box collapsed-box")) {
        $("#helpbox2").removeClass("box collapsed-box").addClass("box");
    }
    else if ($("#helpbox2").hasClass("box")) {
        $("#helpbox2").removeClass("box").addClass("box collapsed-box");
    }

});

$("#helpbutton3").click(function (){
    if ($("#helpbox3").hasClass("box collapsed-box")) {
        $("#helpbox3").removeClass("box collapsed-box").addClass("box");
    }
    else if ($("#helpbox3").hasClass("box")) {
        $("#helpbox3").removeClass("box").addClass("box collapsed-box");
    }

});

document.getElementById('sharebtn').onclick = function() {

FB.ui({
    method: 'share',
    action_type: 'og.shares',
    display:'popup',
    action_properties: JSON.stringify({
        object : {
           'og:url': '<?= $sourcelink?>', // your url to share
           'og:title': 'Admission link for <?=$universityname;?>',
           'og:description': 'Click on link given below and enroll for course at <?=$universityname;?>',
           'og:image': '<?= $universitylink;?>/Document/Data_<?= $universityid;?>/<?= $logo;?>'
        }
    })
    },
    // callback
    function(response) {
    if (response && !response.error_message) {
        // then get post content
        console.log('successfully posted. Status id : '+response.post_id);
    } else {
        console.log('Something went error.');
    }
});


 // FB.ui({
   // method: 'share',
    //display: 'popup',
    //href: '<?= $sourcelink?>',
  //}, function(response){}
 // );
}
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
      "searching": true,
      "ordering": false,
      "info": true,
      "pageLength": 20,
      "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]]//,
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
function checkmobilenumber(mobileno)
{  entered_mobileno = mobileno.value;
  usermobileno = document.getElementById('usermobileno').value;
  if(entered_mobileno==usermobileno)
  {
   alert("You cannot refer your self");
   return mobileno.value= ""; 
  }
  else
  {
    return mobileno.value;
  }
   
}
function checkemail(email)
{
    entered_email = email.value;
  useremailid = document.getElementById('useremailid').value;
  if(entered_email==useremailid){
   alert("You cannot refer your self");
   return email.value= ""; 
  }
  else
  {
    return email.value;
  }
   
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