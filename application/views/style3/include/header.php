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
<meta name="description" content="Mat - Resume & vCard HTML Template">
<meta name="keywords" content="personal, vcard, portfolio">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<!-- Favicon -->  
<link rel="icon" href="<?php echo base_url($settings->favicon) ?>">

<!-- CSS -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/reset.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/cubeportfolio.min.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/owl.theme.css"/> 
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/owl.carousel.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/default/css/style3.css"/>
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