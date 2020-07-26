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


<!-- Favicon -->  
<link rel="icon" href="<?php echo base_url($settings->favicon) ?>">

<!-- CSS -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/reset.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/cubeportfolio.min.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/owl.theme.css"/> 
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/owl.carousel.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/style.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/colors/yellow.csss" id="color"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/simple-line-icons.css" id="color"/>

<link href="<?php echo base_url() ?>assets/default/datetime/datetimepicker.css" rel="stylesheet">

<!-- Colors --> 
<link href="<?php echo base_url(); ?>assets/default/css/colors/colors.php?color=<?php echo $user->site_color; ?>" rel="stylesheet"/>
<link href="<?php echo base_url(); ?>assets/default/css/fonts/fonts.php?font=<?php echo $user->font; ?>" rel="stylesheet"/>

<!-- fonts -->
<link href="https://fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', $user->font); ?>:400,500,600,700" rel="stylesheet">

<!-- Font Icons --> 
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/icon-fonts/font-awesome-4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/icon-fonts/web-design/flaticon.css" />

<!-- google analytics -->
<?php if (!empty($user->google_analytics)): ?>
    <?php echo base64_decode($user->google_analytics) ?>
<?php endif ?>

</head>
<body>

<!-- Wrapper --> 

        

<?php if ($user->account_type == 'pro'): ?>
    
<!-- Profile Section --> 
<div class="col-lg-3 col-md-4 hidden">
    <div class="profile" >
        
        <figure class="profile-image" >
            <img width="150px" class="img-circle" src="<?php echo base_url($user->thumb) ?>" alt="">
        </figure> 
        <div class="profile-name">
            <span class="name"><?php echo html_escape($user->name) ?></span><br>
            <p class="job"><?php echo html_escape($user->designation) ?></p>
            <div class="social-icons top_15"> 
                <?php if (!empty($user->facebook)): ?>
                    <a class="fb" href="<?php echo html_escape($user->facebook) ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a> 
                <?php endif ?>
                <?php if (!empty($user->twitter)): ?>
                    <a class="tw" href="<?php echo html_escape($user->twitter) ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <?php endif ?>
                <?php if (!empty($user->instagram)): ?>
                    <a class="ins" href="<?php echo html_escape($user->instagram) ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <?php endif ?>
                <?php if (!empty($user->linkedin)): ?>
                    <a class="ins" href="<?php echo html_escape($user->linkedin) ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a> 
                <?php endif ?>
            </div>
            <?php if ($user->layouts == 1): ?>
                <br><a href="<?php echo base_url('download/'.html_escape($user->id)) ?>" id="download-cv" class="site-btn cv top_30">Download CV <i class="fa fa-cloud-download" aria-hidden="true"></i></a>
            <?php endif ?>
        </div>

    </div>
</div>

<!-- Page Tab Container Div -->   
<div id="ajax-tab-container" class="col-lg-12 col-md-12 tab-container">
    
<!-- Header --> 
<div class="row">

    <div class="main-nav">

        <header class="containers">
            <nav>
                <div class="row">
                    <!-- navigation bar -->
                    <div class="col-md-12 col-sm-12 col-xs-12 top-navs text-center">

                        <div class="nav-tab">
                            <ul class="tabs">
                              
                                <li class="tab <?php if(isset($page_title) && $page_title == 'Home'){echo 'active';}?>">
                                    <a class="home-btns" href="<?php echo base_url(html_escape($user->slug)) ?>" data-toggle="tooltip" title="Home" data-placement="bottom"><i class="icon-home"></i> <span class="hidden-lg hidden-md"> Home </span></i></a>
                                </li>
                             
                                <li class="tab <?php if(isset($page_title) && $page_title == 'About me'){echo 'active';}?>">
                                    <a class="home-btns" href="<?php echo base_url('about-me/'.html_escape($user->slug)) ?>" data-toggle="tooltip" title="About me" data-placement="bottom"><i class="icon-user"></i> <span class="hidden-lg hidden-md"> About me </span></i></a>
                                </li>
                                <li class="tab <?php if(isset($page_title) && $page_title == 'Resume'){echo 'active';} ?>"><a href="<?php echo base_url('resume/'.html_escape($user->slug)) ?>" data-toggle="tooltip" title="Resume" data-placement="bottom"><i class="icon-book-open"></i> <span class="hidden-lg hidden-md"> Resume</span> </a>
                                </li>

                                <?php if ($user->enable_portfolio == 1): ?>
                                    <li class="tab <?php if(isset($page_title) && $page_title == 'Portfolio'){echo 'active';} ?>"><a href="<?php echo base_url('portfolio/'.html_escape($user->slug)) ?>" data-toggle="tooltip" title="Portfolio" data-placement="bottom"><i class="icon-briefcase"></i> <span class="hidden-lg hidden-md"> Portfolio </span></a>
                                    </li>
                                <?php endif ?>

                                <?php if ($user->enable_blog == 1): ?>
                                    <li class="tab <?php if(isset($page_title) && $page_title == 'Blog Posts' || $page_title == 'Post details'){echo 'active';}else{echo "";} ?>"><a href="<?php echo base_url('blog/'.html_escape($user->slug)) ?>" data-toggle="tooltip" title="Blog" data-placement="bottom"><i class="icon-speech"></i> <span class="hidden-lg hidden-md"> Blog </span></a>
                                    </li>
                                <?php endif ?>

                                <li class="tab <?php if(isset($page_title) && $page_title == 'Contact'){echo 'active';} ?>"><a href="<?php echo base_url('contact/'.html_escape($user->slug)) ?>" data-toggle="tooltip" title="Contact" data-placement="bottom"><i class="icon-location-pin"></i> <span class="hidden-lg hidden-md"> Contact </span></a>
                                </li>

                                <?php if ($user->enable_appointment == 1): ?>
                                <li class="tab <?php if(isset($page_title) && $page_title == 'Appointment'){echo 'active';} ?>"><a href="<?php echo base_url('appointment/'.html_escape($user->slug)) ?>" data-toggle="tooltip" title="Appointment" data-placement="bottom"><i class="icon-calendar"></i> <span class="hidden-lg hidden-md"> Appointment </span></a>
                                </li>
                                <?php endif ?>

                                <?php if ($this->session->userdata('logged_in') == FALSE):?>
                                    <li class="tab"><a href="<?php echo base_url('login') ?>" data-toggle="tooltip" title="Login" data-placement="bottom"><i class="icon-login"></i> <span class="hidden-lg hidden-md"> Login </span></a>
                                <?php endif ?>

                            </ul>
                        </div>

                        <div class="hamburger pull-right hidden-lg hidden-md"><i class="fa fa-bars" aria-hidden="true"></i></div>
                        
                    </div>
                </div>

            </nav>
        </header>
        <div class="row head-bg">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 3510.8 349.9" xml:space="preserve"><style type="text/css">.st0{opacity:0.35;fill:#f5f5f5;}.st1{fill:#f5f5f5;}</style><path class="st0" d="M1538.6,349.9c-8.5-5.8-17-11.5-25.4-17.2c-201.1-134-443.1-203.1-683.1-195.3    c-227.5,7.5-446.5,85.8-635.3,212.4H1538.6z"></path><path class="st1" d="M3510.8,204.2c-20.4-11.2-41.6-21.2-62.2-29.5c-82.7-33.3-189.3-48.1-283.7-29.4
            c-145.5,29-226.9,126.3-365.6,165.7c-122,34.6-266.8,18.4-392.2-11.3c-243.9-57.8-476.4-125.1-746.4-111c-148,7.7-291,38.8-421.4,82
            c-134.5,44.6-293.8,106.7-448.7,58.3c-131.8-41.3-200.4-132.1-322.4-182c-91.2-37.3-207.8-50.7-315.1-36.3
            C98,118.1,45.7,132.9,0,153.3v197.2h3510.8V204.2z"></path><path class="st0" d="M3510.8,282.8c-117.5-97.4-255.6-201.2-413.4-176.4c-111.4,17.5-184.7,114-282.7,161
            c-127.3,61-227.1-16.9-341-69.3c-153.7-70.6-343.6-51.4-480.7,48.6c-42.4,31-83,70-125.2,103.2h1643V282.8z"></path><path class="st0" d="M3510.8,161.9c-21.6-2.7-43-3.1-62.3-1.6c-73,5.5-142.2,33.4-209.5,62.3c-67.3,28.9-134.9,59.4-207.2,70.9
            c-241.2,38.3-440.7-133.6-663.5-189c-201.9-50.2-415.8-6.8-611.8,62.6c-199.5,70.6-405.5,169.7-612.9,127.5
            c-146-29.7-268.2-125.9-403.1-189.1C501.4-6.7,247.5-4.2,0,50.1v299.8h3510.8V161.9z"></path></svg>
        </div>
        <div class="col-md-12 text-center">
            <h3 class="page-title">
                <?php if (!empty($page_title) && $page_title == 'Post details'): ?>
                    <?php echo character_limiter($post->title, 25) ?>
                <?php elseif(!empty($page_title) && $page_title == 'Home'): ?>
                    <?php if ($this->session->userdata('logged_in') == TRUE):?>
                        <a target="_blank" href="<?php echo base_url('admin/profile') ?>"><img class="img-circle" width="30px" src="<?php echo base_url($user->thumb) ?>" alt=""> Manage profile <i class="fa fa-long-arrow-right"></i></a>
                    <?php else: ?>
                        <a target="_blank" href="<?php echo base_url('admin/profile') ?>" class="hidden-md hidden-lg"><img class="img-circle" width="30px" src="<?php echo base_url($user->thumb) ?>" alt="Image"> <?php echo html_escape($user->name); ?></a>
                    <?php endif ?>
                <?php else: ?>
                    <?php echo $page_title; ?>
                <?php endif ?>
            </h3>
        </div>
    </div>

<?php endif ?>

<div class="wrapper top_10 container">
<div class="row">