<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>EMIS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url() ?>assets/images/header.png" rel="icon">
  <link href="<?php echo base_url() ?>assets/images/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!--scripts for autosuggestion -->
  <script src="<?= base_url() ?>assets/js/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="<?= base_url() ?>assets/js/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> 

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url() ?>assets/css/style1.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<?= base_url(); ?>profile_management" class="logo d-flex align-items-center">
        <img src="<?php echo base_url() ?>assets/images/new.png" alt="">
        <span class="d-none d-lg-block">- EMIS</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?php echo base_url() ?>assets/images/profile.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $this->session->userdata('full_name');?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $this->session->userdata('full_name');?></h6>
              <span><?php echo $this->session->userdata('profession');?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= base_url('Profile_Management');?>">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url() ?>auth/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <?php
          $menus = $this->session->userdata('allowed');
          if(count($menus) > 0){
                for ($i = 0; $i < count($menus); $i++) {
                  if($menus[$i]->is_menu == 1){ 
                      $active_menu = $this->Login_Model->is_submenu_in_this_menu($module_name,$menus[$i]->module_id);
                    ?>
                    <li class="nav-item">
                      <?php if($active_menu){ ?>
                        <a class="nav-link" data-bs-target="#<?= 'nav_'.$menus[$i]->module_id;?>" data-bs-toggle="collapse" href="#">
                      <?php }else{ ?>
                        <a class="nav-link collapsed" data-bs-target="#<?= 'nav_'.$menus[$i]->module_id;?>" data-bs-toggle="collapse" href="#">
                      <?php } ?>
                        <i class="<?= $menus[$i]->icon_name; ?>"></i>
                        <span><?= $menus[$i]->label; ?></span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                      </a>
                      <?php if($active_menu){ ?>
                        <ul id="<?= 'nav_'.$menus[$i]->module_id;?>" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                      <?php }else{ ?>
                        <ul id="<?= 'nav_'.$menus[$i]->module_id;?>" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                      <?php } ?>
                      
                        <?php 
                        $submenus = $this->Login_Model->getallowedsubmenus($this->session->userdata('user_Role'),$this->session->userdata('employee_id'),$menus[$i]->module_id);
                        if(count($submenus) > 0){
                          foreach($submenus as $side){ ?>
                              <li class="nav-item">

                                <?php if($side->name == $module_name){ ?>
                                  <a href="<?= base_url(); ?><?= $side->root_path; ?>" class="active">
                                <?php }else{ ?>
                                  <a href="<?= base_url(); ?><?= $side->root_path; ?>">
                                <?php } ?>
                                
                                  <i class="<?= $side->icon_name; ?>"></i>
                                  <span><?= $side->label; ?></span> &nbsp;

                                  <!--Here are the codes to set notifications -->
                                  <?php 
                                    $notification = "";
                                      if($side->notification){
                                          if($side->label == "Annual Leave Approval"){ 
                                            $notification = $this->Notification_Model->unapproved_leave_dept_head();
                                          }else if($side->label == "Hr Dashboard"){
                                            $notification = $this->Notification_Model->unapproved_leave_hr();
                                          }else if($side->label == "Accoutant Dashboard"){
                                            $notification = $this->Notification_Model->unapproved_leave_accoutant();
                                          }else if($side->label == "Employee Performance Review"){
                                            $notification = $this->Notification_Model->unapproved_performance();
                                          }else if($side->label == "Employee Dependents Review"){
                                            $notification = $this->Notification_Model->unapproved_dependent();
                                          }else if($side->label == "Emergency Leave Approval"){
                                            $notification = $this->Notification_Model->unapproved_emergency_leave();
                                          }else if($side->label == "Emergency Leaves"){
                                            $notification = $this->Notification_Model->hr_unapproved_emergency();
                                          }
                                            ?>
                                            <span class="badge bg-success badge-number"><?= $notification; ?></span>
                                          <?php 
                                       } ?> 
                                </a>
                              </li>
                            <?php } } ?>
                      </ul>
                    </li>
        <?php } } } ?>
    </ul>

  </aside><!-- End Sidebar-->