
    <div id="home-page"></div>

    <!-- Hero-Area -->
    <section class="hero-area" style="background-image: url('<?php echo base_url() ?>assets/front/images/footer-shape.png'); background-position: left top;">
        <div class="container">
            <div class="row equal-height">
                <div class="col-xs-12 col-sm-12 col-md-5">
                    <h1 class="head-title c-p wow fadeInLeft" data-wow-delay="0.5s"><?php echo html_escape($settings->site_name) ?></h1>
                    <h2 class="head-title-sm wow fadeInLeft" data-wow-delay="0.7s">Freelancers and entrepreneurs use to grow their audience and get more clients.</h2>
                    <div class="space-40"></div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7">
                    <div class="hidden visible-xs visible-sm space-60"></div>
                    <figure class="wow fadeInRight" data-wow-delay="0.7s">
                        <img src="<?php echo base_url() ?>assets/front/images/header-shape-2.png" alt="illustration">
                    </figure>
                </div>
            </div>
        </div>
    </section><!-- /Hero-Area -->

    <section class="section-padding">
        <div class="container">
            <div class="row equal-height">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <h2 class="head-title wow fadeInRight" data-wow-delay="0.3s">4 Different layouts for pro users</h2>
                    <div class="space-40"></div>
                </div>
                <div class="row">
                    <?php for ($i=1; $i < 5; $i++) { ?>
                        <div class="col-xs-6 col-sm-6 col-md-3">
                            <div class="hidden visible-xs visible-sm space-60"></div>
                            <figure class="wow fadeInUp bs" data-wow-duration="1s" data-wow-delay="0.3s">
                                <img src="<?php echo base_url() ?>assets/admin/layouts/style<?php echo $i; ?>.png" alt="Layout">
                            </figure>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Services Section -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="page-title">
                        <h3 class="title"> Create a page to present who you are and what you do in one link.</h3>
                        <a href="<?php echo base_url('create-profile') ?>" class="bttn-1 mt-10">Get your page now <i class="fa fa-angle-right"></i></a>
                        <div class="space-60"></div>
                    </div>
                </div>
            </div>
            
            <?php $i=1; foreach ($services as $service): ?>
                <div class="row equal-height <?php echo($i % 2 == 0) ? 'revers' : '' ?>">
                    <div class="col-xs-12 col-sm-5">
                        <figure class="text-left wow fadeInLeft" data-wow-delay="0.3s">
                            <img src="<?php echo base_url($service->image) ?>" alt="">
                        </figure>
                        <div class="space-10 hidden visible-xs"></div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-sm-offset-1">
                        <div class="single-service-two wow fadeInRight" data-wow-delay="0.3s">
                            <h3 class="title text-<?php echo($i % 2 == 0) ? 'left' : 'left' ?>"><?php echo html_escape($service->name); ?></h3>
                            <p class="text-<?php echo($i % 2 == 0) ? 'left' : 'left' ?>"><?php echo $service->details; ?></p>
                        </div>
                    </div>
                </div>
                <div class="space-50"></div>
            <?php $i++; endforeach; ?>

        </div>
    </section><!-- /Section -->


    <!-- Services Section -->
    <?php if ($settings->enable_blog == 1 && !empty($posts)): ?>
      
        <section class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="page-title">
                            <h2 class="title"> Learn More & Empower yourself </h2>
                            <div class="space-20"></div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <!-- start posts -->
                        <div class="posts posts-style-1">
                            <div class="__inner">
                                <div class="row">
                                    <!-- start item -->
                                    <?php foreach ($posts as $post): ?>
                                        <div class="col-12 col-sm-6 col-lg-4 d-sm-flex">
                                            <div class="__item __item--preview">
                                                <div class="__header">
                                                    <a href="<?php echo base_url('post/'.$post->slug) ?>">
                                                        <figure class="__image">
                                                            <img width="303" height="223" src="<?php echo base_url($post->image) ?>" alt="demo" />
                                                        </figure>
                                                    </a>
                                                </div>

                                                <div class="__body">
                                                    <div class="__content">
                                                        <a class="post_category" href="<?php echo base_url('category/'.$post->category_slug) ?>">
                                                            <?php echo html_escape($post->category) ?>
                                                        </a>

                                                        <h4 class="__title"><a href="<?php echo base_url('post/'.$post->slug) ?>"><?php echo html_escape($post->title) ?></a></h4>

                                                        <p>
                                                            <?php echo character_limiter($post->details, 100)?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                    <!-- end item -->

                                </div>
                            </div>
                        </div>
                        <!-- end posts -->

                        <!-- start pagination -->
                        <div class="row">
                            <div class="mt-md-12 text-center">
                                <?php echo $this->pagination->create_links(); ?>
                            </div>
                        </div>
                        <!-- end pagination -->
                    </div>
                </div>

            </div>
        </section><!-- /Section -->

    <?php endif ?>


    