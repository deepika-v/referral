<?php $universityid = $this->session->userdata['logged_in']['universityid'];
      $emailid = $this->session->userdata['logged_in']['Emailid'];
      $mobileno = $this->session->userdata['logged_in']['MobileNo'];
      $userid = $this->session->userdata['logged_in']['userid'];
      $userphoto = $this->session->userdata['logged_in']['userphoto'];
      $facebookphoto = $this->session->userdata['logged_in']['facebookphoto'];
      $IsOTPVerified = $this->session->userdata['logged_in']['IsOTPVerified'];
      $universityencode= str_replace('=','.', base64_encode($universityid));
      $emailencode =  str_replace('=','.', base64_encode($emailid));
      $mobilenoencode =  str_replace('=','.', base64_encode($mobileno));
      $url = base_url()."login/resetpassword/";
      $link = $url.$emailencode.'/'.$universityencode.'/'.$mobilenoencode;
      if($facebookphoto!= '')
      {
        $userphoto = base_url('uploads/userphotos/'.$facebookphoto);

      }
      else if(($userphoto==''||$userphoto==NULL)&& ($facebookphoto==''||$facebookphoto==NULL))
        $userphoto = base_url('assets/dist/img/default.jpg');
      else
        $userphoto = base_url('uploads/userphotos/'.$userphoto);



?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('Referfriend/view');?>/<?= $universityid;?>/0" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Referral <b>Program</b></span><br>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
     

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
          <!-- Notifications: style can be found in dropdown.less -->
        
          <!-- Tasks: style can be found in dropdown.less -->
             <li class="dropdown notifications-menu"  id="ddown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-gear"></i>
            </a>
            <ul class="dropdown-menu">
               <li>
               

                    <a href="<?= $link?>">
                      <i class="fa fa-key"></i> Change Password
                    </a>
                  </li>
                <!-- inner menu: contains the actual data -->
                <li>
                    <a href="<?php echo base_url('Login/upload/'.$userid.'');?>">
                      <i class="fa fa-photo"></i> Change Photo
                    </a>
                  </li>
                                  
                 <li>
                    <a href="<?php echo base_url('Login/logout/'.$universityid.'');?>">
                      <i class="fa fa-user"></i> Sign Out
                    </a>
                  </li>
                
              </li>
              </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          
          <!-- Control Sidebar Toggle Button -->
  
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        
        <div class="pull-left image">
          <a href="<?php echo base_url('Login/upload/'.$userid.'');?>"><img src="<?php echo $userphoto;?>" class="img-circle" width="65" height="70"  alt="User Image" title="Change Photo" ></a>
        </div>
        <div class="pull-right info" style="margin-left:10%">
          <p ><?php echo ucfirst($this->session->userdata['logged_in']['FirstName'])." ".ucfirst($this->session->userdata['logged_in']['LastName']); ?></p>
        </div>
        </div>
      
     <!-- sidebar menu: : style can be found in sidebar.less -->
     
      <ul class="sidebar-menu">
        <li class="header"></li>
        <li class="active treeview">
          <a href="<?php echo base_url('Referfriend/view');?>/<?= $universityid;?>/0">
            <i class="fa fa-dashboard"></i> <span>Refer Friends</span>
            <span class="pull-right-container">
            </span>
          </a>
       </li>
        <li class="treeview">
          <a href="<?php echo base_url('Progress/track');?>/<?= $universityid;?>/1">
            <i class="fa fa-dashboard"></i> <span>Track Progress</span>
            <span class="pull-right-container">              
            </span>
          </a>           
        </li>
        <li class="treeview">
          <a href="<?php echo base_url('Progress_support/request');?>">
            <i class="fa fa-dashboard"></i> <span>Request Redemption</span>
            <span class="pull-right-container">
            </span>
          </a>
       </li>
        <li class="treeview">
          <a href="<?php echo base_url('Progress/track/');?>/<?= $universityid;?>/0">
            <i class="fa fa-dashboard"></i> <span>View Hidden Contacts</span>
            <span class="pull-right-container">
            </span>
          </a>
       </li>
       <li class="treeview">
          <a href="<?php echo base_url('About');?>/<?= $universityid;?>">
            <i class="fa fa-dashboard"></i> <span>About Referral Program</span>
            <span class="pull-right-container">
            </span>
          </a>
       </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
   

    <!-- /.content-wrapper -->
  