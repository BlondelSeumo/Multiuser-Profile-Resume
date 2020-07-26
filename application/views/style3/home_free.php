
<div class="col-md-8 col-md-offset-2 top_60">
    <div id="content" class="panel-container">
        
        <div class="profiles text-center">
            <figure class="profile-images top_30">
                <img width="150px" class="img-circle" src="<?php echo base_url($user->thumb) ?>" alt="">
            </figure> 
            <div class="profile-name">
                <h4 class="p-0"><?php echo html_escape($user->name) ?></h4>
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
            </div>
        </div>

        <div id="home">
            <!-- Text Section -->
            <div class="row">
                <section class="about-me line col-md-12 padding_30 padbot_45 text-center">
                    <div class="section-title"><span></span><h2>About Me</h2></div>
                    <p class="top_30"><?php echo html_escape($user->about_me) ?></p>
                </section>
            </div>
           
        </div>
    </div>
</div>