
<div class="col-md-12">
    <div id="content" class="panel-container">
        
        <div id="home">
            <!-- Text Section -->
            <div class="row">
                <section class="about-me line col-md-12 padding_30 padbot_45">
                    <p class="top_30"><?php echo html_escape($user->about_me) ?></p>
                </section>
            </div>

            <?php if ($user->enable_service == 1): ?>
                <div class="row">
                    <section class="services line graybg col-md-12 padding_50 padbot_50">
                        <div class="section-title bottom_15"><span></span><h2>My Services</h2></div>
                        <div class="row">
                            
                            <?php foreach ($services as $service): ?>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="service text-center">
                                        <div class="icon">
                                            <img width="100px" class="img-circles" src="<?php echo base_url($service->thumb) ?>">
                                        </div>
                                        <span class="title"><?php echo html_escape($service->name) ?></span>
                                    </div>
                                </div>
                            <?php endforeach ?>

                        </div>
                    </section>
                </div>
            <?php endif ?>

            <!-- Skills Section -->
            <div class="row">
                <?php foreach ($skills as $skill): ?>
                    <section class="design-skills col-md-6 padding_60 padbot_50">
                        <div class="section-title bottom_15"><span></span><h2><?php echo html_escape($skill['name']) ?></h2></div>
                        <ul class="skill-list">
                            <?php foreach ($skill['sub_skills'] as $sub_skill): ?>
                                <li> 
                                    <h3><?php echo html_escape($sub_skill['name']) ?> <span class="pull-right"><b><?php echo html_escape($sub_skill['skill_level']) ?>%</b></span></h3>
                                    <div class="progress">
                                        <div class="percentage" style="width:<?php echo html_escape($sub_skill['skill_level']) ?>%;"></div>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </section>
                <?php endforeach ?>
            </div>

            <?php if ($user->enable_followers == 1): ?>
                <div class="row">
                    <section class="services line graybg col-md-12 padding_50 padbot_50">
                        <div class="section-title bottom_15"><span></span><h2>Followers</h2></div>
                        <div class="row">
                            <?php if (empty($followers)): ?>
                                <p class="p-20">Nobody follows you</p>
                            <?php else: ?>

                                <?php foreach ($followers as $follower): ?>
                                    <div class="col-md-1 col-sm-1 col-xs-2">
                                        <div class="small-item">
                                            <a data-title="<?php echo html_escape($follower->name) ?>" target="_blank" href="<?php echo base_url('profile/'.$follower->slug) ?>">
                                                <img width="80px" class="img-circles" src="<?php echo base_url($follower->thumb) ?>">
                                            </a>
                                            <!-- <p><?php echo html_escape($follower->name) ?></p> -->
                                        </div>
                                    </div>
                                <?php endforeach ?>

                            <?php endif ?>
                        </div>
                    </section>
                </div>

                <div class="row">
                    <section class="services line graybg col-md-12 padding_50 padbot_50">
                        <div class="section-title bottom_15"><span></span><h2>Following</h2></div>
                        <div class="row">
                            
                            <?php if (empty($followings)): ?>
                                <p class="p-20">You haven't following yet</p>
                            <?php else: ?>
                            
                                <?php foreach ($followings as $follow): ?>
                                    <div class="col-md-1 col-sm-1 col-xs-2">
                                        <div class="small-item">
                                            <a data-title="<?php echo html_escape($follow->name) ?>" target="_blank" href="<?php echo base_url('profile/'.$follower->slug) ?>">
                                                <img width="80px" class="img-circles" src="<?php echo base_url($follow->thumb) ?>">
                                            </a>
                                            <!-- <p><?php echo html_escape($follower->name) ?></p> -->
                                        </div>
                                    </div>
                                <?php endforeach ?>

                            <?php endif ?>

                        </div>
                    </section>
                </div>
            <?php endif ?>

        </div>
    </div>
</div>