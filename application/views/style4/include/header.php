<!doctype html>
<html lang="en">

<head>

<?php $settings = get_settings(); ?>

<title>
    <?php if (isset($page) && $page == 'Post'): ?>
        <?php echo html_escape($post->title) ?>
    <?php else: ?>
        <?php echo html_escape($user->name) ?> - <?php if(empty($user->designation)){echo "Profile";}else{echo html_escape($user->designation);} ?>
    <?php endif ?>
</title>

<meta charset="UTF-8">
<meta name="description" content="<?php echo html_escape($user->about_me) ?>">
<meta name="keywords" content="profile, vcard, portfolio">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<!-- Favicon ================================================== -->  
<link rel="icon" href="<?php echo base_url($settings->favicon) ?>">

<!-- CSS ================================================== -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/reset.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/cubeportfolio.min.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/owl.theme.css"/> 
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/owl.carousel.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/style4.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/colors/yellow.css" id="color"/>


<!-- Colors --> 
<link href="<?php echo base_url(); ?>assets/default/css/colors/colors.php?color=<?php echo html_escape($user->site_color); ?>" rel="stylesheet"/>

<!-- fonts -->
<link href="<?php echo base_url(); ?>assets/default/css/fonts/fonts.php?font=<?php echo html_escape($user->font); ?>" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', html_escape($user->font)); ?>:400,500,600,700" rel="stylesheet">


<!-- Font Icons ================================================== --> 
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/icon-fonts/font-awesome-4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/icon-fonts/web-design/flaticon.css" />


</head>
<body style="background-image: url(<?php echo base_url() ?>assets/default/images/profilebg.jpg);">

    
<!-- Wrapper --> 
<div class="wrapper top_60 container">
<div class="row">


<!-- Profile Section
================================================== --> 
<div class="col-lg-3 col-md-4">
    <div class="profile">
           
        <div class="profile-up">

            <figure class="profile-image" >
                <img width="150px" class="img-circle" src="<?php echo base_url($user->thumb) ?>" alt="">
            </figure> 
            <div class="profile-name">
                <span class="name"><?php echo html_escape($user->name) ?></span><br>
             
                <p class="job"><?php echo html_escape($user->designation) ?></p>
                <div class="user-social-acount text-center top_15">
                    <?php if (!empty($user->facebook)): ?>
                      <a href="<?php echo html_escape($user->facebook) ?>" class="btn btn-circle btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                    <?php endif ?>

                    <?php if (!empty($user->twitter)): ?>
                      <a href="<?php echo html_escape($user->twitter) ?>" class="btn btn-circle btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                    <?php endif ?>

                    <?php if (!empty($user->instagram)): ?>
                      <a href="<?php echo html_escape($user->instagram) ?>" class="btn btn-circle btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                    <?php endif ?>

                    <?php if (!empty($user->linkedin)): ?>
                      <a href="<?php echo html_escape($user->linkedin) ?>" class="btn btn-circle btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
                    <?php endif ?>

                </div>
                <br>

                <?php if (!empty($user->cv)): ?>
                    <a href="<?php echo base_url('download/'.html_escape($user->id)) ?>" id="download-cv" class="site-btn cv top_30">Download CV <i class="fa fa-cloud-download" aria-hidden="true"></i></a>
                <?php endif ?>
            </div>
        </div>


      

      
        <div class="col-md-12 p-0 bottom_30">
            <div class="profile-usermenu">
                <ul class="nav">

                    <?php if ($this->session->userdata('logged_in') == TRUE):?>
                        <li class="tab"><a target="_blank" href="<?php echo base_url('admin/profile') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <?php endif; ?>

                    <li class="tab <?php if(isset($page_title) && $page_title == 'About me'){echo 'active';}else{echo "";} ?>"><a href="<?php echo base_url('about-me/'.html_escape($user->slug)) ?>"><i class="fa fa-user"></i> About me</a></li>
                    <li class="tab <?php if(isset($page_title) && $page_title == 'Resume'){echo 'active';}else{echo "";} ?>"><a href="<?php echo base_url('resume/'.html_escape($user->slug)) ?>"><i class="fa fa-id-card-o"></i> Resume</a></li>

                    <li class="tab <?php if(isset($page_title) && $page_title == 'Portfolio'){echo 'active';}else{echo "";} ?>"><a href="<?php echo base_url('portfolio/'.html_escape($user->slug)) ?>"><i class="fa fa-image"></i> Portfolio</a></li>
                    <li class="tab <?php if(isset($page_title) && $page_title == 'Blog Posts' || $page_title == 'Post details'){echo 'active';}else{echo "";} ?>"><a href="<?php echo base_url('blog/'.html_escape($user->slug)) ?>"><i class="fa fa-comments-o"></i> Blog</a></li>
                    <li class="tab <?php if(isset($page_title) && $page_title == 'Contact'){echo 'active';}else{echo "";} ?>"><a href="<?php echo base_url('contact/'.html_escape($user->slug)) ?>"><i class="fa fa-map-marker"></i> Contact</a></li>
                    <li class="tab <?php if(isset($page_title) && $page_title == 'Appointment'){echo 'active';}else{echo "";} ?>"><a href="<?php echo base_url('appointment/'.html_escape($user->slug)) ?>"><i class="fa fa-calendar"></i> Appoinment</a></li>

                    <?php if ($this->session->userdata('logged_in') == FALSE):?>
                        <li class="tab"><a href="<?php echo base_url('login') ?>"><i class="fa fa-sign-in"></i> Login </a>
                    <?php endif ?>

                </ul>
            </div>
        </div>
      

    </div>
</div>

<!-- Page Tab Container Div -->   
<div id="ajax-tab-container" class="col-lg-9 col-md-8 tab-container">
    
<!-- Header
================================================== --> 
<div class="row">
