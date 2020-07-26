<!DOCTYPE html>
<html lang="en">
<head>
  <?php $settings = get_settings(); ?>
  <?php $user = get_logged_user($this->session->userdata('id')); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?php echo base_url($settings->favicon) ?>">

  <title><?php echo html_escape($settings->site_name); ?> - Dashboard</title>
  
  <!-- Bootstrap 4.0-->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css">

  <!-- Bootstrap 4.0-->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap-extend.css">


  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/font-awesome.min.css">
  <link href="<?php echo base_url() ?>assets/admin/css/toast.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>assets/admin/css/bootstrap-tagsinput.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>assets/admin/css/sweet-alert.css" rel="stylesheet" />
  <!-- DataTables -->
  <link href="<?php echo base_url() ?>assets/admin/js/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/master_style.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/skins/_all-skins.css">   
  <link href="<?php echo base_url() ?>assets/admin/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/admin/css/icons.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/simple-line-icons.css">
  <link href="<?php echo base_url() ?>assets/admin/css/bootstrap-switch.min.css" rel="stylesheet">
  <?php if (isset($page_title) && $page_title == 'Appointment'): ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" rel="stylesheet">
  <?php endif ?>
  
  <link href="<?php echo base_url() ?>assets/admin/css/select2.min.css" rel="stylesheet" />
  <!-- Color picker plugins css -->
  <link href="<?php echo base_url() ?>assets/admin/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

  <script type="text/javascript">
    var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
    var token_name = '<?php echo $this->security->get_csrf_token_name();?>'
  </script>


</head>

<body class="hold-transition skin-blue-light sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo">
        <span class="logo-lg">
          <img width="100px" src="<?php echo base_url($settings->logo) ?>" alt="<?php echo html_escape($settings->site_name); ?>">
        </span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle</span>
        </a>



        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <?php if (!is_admin()): ?>
              <?php if (check_my_payment_status() == 0 && $settings->enable_paypal == 1): ?>
                <li>
                  <div class="alert-danger-cus mt-15 mr-20"> <i class="fa fa-info-circle"></i> Your account is limited due to payment</div>
                </li>
              <?php endif ?>
            
              <?php if (user()->status == 2): ?>
                <li>
                  <div class="alert-danger-cus mt-15 mr-20"> <i class="fa fa-ban"></i> Your account has been suspended !</div>
                </li>
              <?php endif ?>
            <?php endif ?>

            <li>
              <?php if (user()->role == 'admin'): ?>
                <a target="_blank" href="<?php echo base_url() ?>" class="btn btn-info btn-sm pull-left mt-15 mr-20">
                  <i class="fa fa-eye"></i> View Site
                </a>
                <?php $avatar = 'assets/front/images/avatar.png'; ?>
              <?php else: ?>
                  <a target="_blank" href="<?php echo base_url(user()->slug) ?>" class="btn btn-info btn-sm pull-left mt-15 mr-20">
                    <i class="fa fa-eye"></i> View Profile
                  </a>
                  <?php $avatar = user()->thumb; ?>
              <?php endif ?>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url($avatar) ?>" class="user-image rounded-circle" alt="User Image">
              </a>
              
              <ul class="dropdown-menu scale-up">
                <!-- User image -->
                <?php if (user()->role == 'admin'): ?>
                  <li class="user-header">
                    <img src="<?php echo base_url($settings->logo) ?>" class="float-left" alt="User Image">
                  </li>
                <?php else: ?>
                  <li class="user-header">
                    <img src="<?php echo base_url($avatar) ?>" class="float-left rounded-circle" alt="User Image">
                    <p class="mt-5">
                      <?php echo html_escape(user()->name); ?>
                      <small class="mb-5"><?php echo html_escape(user()->email); ?></small>
                    </p>
                  </li>
                <?php endif ?>
                
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row no-gutters">
                    <div class="col-12 text-left">
                      <a href="<?php echo base_url('admin/dashboard/change_password') ?>"><i class="fa fa-lock"></i> Change Password</a>
                    </div>
                    <div role="separator" class="divider col-12"></div>
                    <div class="col-12 text-left">
                      <a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-power-off"></i> Logout</a>
                    </div>     

                  </div>
                  <!-- /.row -->
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar"></a>
            </li>
          </ul>
        </div>
      </nav>

    </header>


