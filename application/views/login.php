<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url() ?>assets/images/favicon.ico">
    <?php $settings = get_settings(); ?>
    <title><?php echo html_escape($settings->site_name); ?> - Login</title>
  
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css">
    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap-extend.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/master_style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/fontawesome.min.css">
    <link href="<?php echo base_url() ?>assets/admin/css/sweet-alert.css" rel="stylesheet" />
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <?php if (!empty($settings->logo)): ?>
      <a href="<?php echo base_url() ?>"><img class="circles" src="<?php echo base_url($settings->logo) ?>"></a><br>
    <?php endif ?>
  </div>
  
  <!-- /.login-logo -->
  <div id="login-area" class="login-box-body">
    <p class="login-box-msg">Sign In</p>

    <form id="login-form" method="post" action="<?php echo base_url('auth/log'); ?>">

      <div class="form-group has-feedback">
        <input type="text" name="user_name" class="form-control" placeholder="Username" autocomplete="off">
        <span class="ion ion-email form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
        <span class="ion ion-locked form-control-feedback"></span>
        <a class="pull-right forgot_pass" href="#">Forgot password ?</a>
      </div>

      <div class="row">
        <!-- csrf token -->
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary btn-block signin_btn margin-top-10">Sign In</button> 
        </div> 
      </div>
    </form>
    <!-- /.social-auth-links -->

    <div class="margin-top-30 text-center">
    </div>

  </div>
  <!-- /.login-box-body -->


  <!-- forgot area -->
  <div id="forgot-area" class="login-box-body" style="display: none;">
    <p class="login-box-msg">Recover Password </p>

    <form id="lost-form" method="post" action="<?php echo base_url('auth/forgot_password'); ?>">

      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Enter your email">
        <span class="ion ion-email form-control-feedback"></span>
        <a class="pull-right back_login" href="#"><i class="fa fa-angle-left"></i> Back</a>
      </div>

      <div class="row">
        <!-- csrf token -->
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-info btn-block signin_btn margin-top-10">Submit</button> 
        </div> 
      </div>
    </form>
    <!-- /.social-auth-links -->

    <div class="margin-top-30 text-center">
    </div>

  </div>


</div>
<!-- /.login-box -->

  
  <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

  <!-- jQuery 3 -->
   <script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script> 
  <!-- popper -->
  <script src="<?php echo base_url() ?>assets/admin/js/popper.min.js"></script>
  <!-- Bootstrap 4.0-->
  <script src="<?php echo base_url() ?>assets/admin/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin/js/admin.js"></script>
  <script src="<?php echo base_url()?>assets/admin/js/sweet-alert.min.js"></script>
  
  <script type="text/javascript">
    $(document).ready(function(){
      
      $(document).on('submit', "#login-form", function() {

        $.post($('#login-form').attr('action'), $('#login-form').serialize(), function(json){

            if (json.st == 1) {

                window.location = json.url;

            }else if (json.st == 0) {
                $('#login_pass').val('');
                swal({
                  title: "Error..",
                  text: "Sorry your username or password is not correct!",
                  type: "error",
                  confirmButtonText: "Try Again"
                });
            }else if (json.st == 2) {
                swal({
                  title: "Error..",
                  text: "Your account is not active",
                  type: "error",
                  confirmButtonText: "Try Again"
                });
            }else if (json.st == 3) {
                swal({
                  title: "Error..",
                  text: "Your account has been suspended",
                  type: "warning",
                  confirmButtonText: "Try Again"
                });
            }else if (json.st == 4) {
                swal({
                  title: "Error",
                  text: "Your email is not verified, Please verify your email",
                  type: "warning",
                  confirmButtonText: "Close"
                });
            }

        },'json');
        return false;
      });

      //recover password form
      $('#lost-form').submit(function(){
          $.post($('#lost-form').attr('action'), $('#lost-form').serialize(), function(json){
              
              if ( json.st == 1 ){

                  swal({
                        title: "Password Reset Successfully!",
                        text: "We've sent a password to your email address. Please check your inbox",
                        type: "success",
                        showConfirmButton: true
                      }, function(){
                          window.location = json.url;
                  });
              
              } else {
                swal({
                    title: "Sorry !",
                    text: "You are not a valid user",
                    type: "error",
                    confirmButtonText: "Try Again"
                  });
              }
          },'json');
          return false;
      });


      $(document).on('click', ".forgot_pass", function() {
          $('#login-area').slideUp();
          $('#forgot-area').slideDown();
      });

      $(document).on('click', ".back_login", function() {
          $('#login-area').slideDown();
          $('#forgot-area').slideUp();
      });


    });
  </script>
</body>
</html>
