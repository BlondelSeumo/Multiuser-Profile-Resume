<section class="section-padding">
    <div class="container">
        <div class="row mb-20">
            <div class="col-md-6 col-xs-4">
                <div class="stats-counts">
                    <h4><?php echo html_escape($pro); ?></h4>
                    <p>
                        Pro Users
                    </p>
                </div>
                <div class="stats-counts">
                    <h4><?php echo html_escape($free); ?></h4>
                    <p>
                        Free Users
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-xs-4">
                <div class="pull-right">
                  <label for="sel1">Search by skills</label>
                  <select class="form-control sort_user" id="sel1">
                      <option value="<?php echo base_url('home/users?sort=all') ?>">Select Skills</option>
                      <?php foreach ($skills as $skill): ?>
                        <option <?php if(isset($_GET['skill']) && $_GET['skill'] == $skill->slug){echo "selected";} ?> value="<?php echo base_url('home/users?skill='.$skill->slug) ?>"><?php echo html_escape($skill->name) ?></option>
                      <?php endforeach ?>
                  </select>
                </div>
            </div>
            <div class="col-md-3 col-xs-4">
                <div class="pull-right">
                  <label for="sel1">Sort users</label>
                  <select class="form-control sort_user" id="sel1">
                    <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'all'){echo "selected";} ?> value="<?php echo base_url('home/users?sort=all') ?>">All users</option>
                    <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'free'){echo "selected";} ?> value="<?php echo base_url('home/users?sort=free') ?>">Free users</option>
                    <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'pro'){echo "selected";} ?> value="<?php echo base_url('home/users?sort=pro') ?>">Pro users</option>
                    <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'views'){echo "selected";} ?> value="<?php echo base_url('home/users?sort=views') ?>">Most views</option>
                  </select>
                </div>
            </div>
        </div>

        <div class="row">
            <?php if (empty($users)): ?>
                <div class="col-md-12 text-center" style="padding: 100px">
                    <h3>No users found !</h3>
                </div>
            <?php else: ?>
                <?php foreach ($users as $user): ?>
                    <div class="col-md-4 col-sm-12" id="item_<?php echo $user->id; ?>">
                         <div class="card-container manual-flip">
                            <div class="card">
                                <div class="front">

                                    <a target="_blank" href="<?php echo base_url($user->slug) ?>">
                                        <div class="user">
                                            <img class="img-circle" src="<?php echo base_url($user->thumb) ?>">
                                            <?php if ($user->account_type == 'pro'): ?>
                                                <label class="label label-warning custom" data-toggle="tooltip" title="Pro Member"><i class="fa fa-star"></i></label>
                                            <?php endif ?>
                                        </div>
                                    </a>

                                    <div class="content">
                                        <div class="main">
                                            <h3 class="name"><?php echo html_escape($user->name) ?> </h3>
                                            <p class="profession"><?php echo html_escape($user->designation) ?></p>
                                            
                                            <?php if ($this->session->userdata('logged_in') == TRUE): ?>
                                                <?php $follow = check_follower($user->id); ?>
                                                    <div class="card-btns text-center">
                                                        <?php if ($follow == 0): ?>
                                                            <a href="#" id="follow_<?php echo $user->id; ?>" data-id="<?php echo $user->id; ?>" class="btn follow mr-5"><i class="fa fa-user-plus"></i> Follow</a>
                                                        <?php else: ?>
                                                            <a href="#" id="unfollow_<?php echo $user->id; ?>" data-id="<?php echo $user->id; ?>" class="btn unfollow mr-5"><i class="fa fa-check"></i> Following</a>
                                                        <?php endif ?>
                                                        <a target="_blank" href="<?php echo base_url($user->slug) ?>" class="btn default"><i class="fa fa-eye"></i> View Profile</a>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="card-btns text-center">
                                                        <a href="<?php echo base_url('login') ?>" class="btn default mr-5"><i class="fa fa-user-plus"></i> Follow</a>

                                                        <a target="_blank" href="<?php echo base_url($user->slug) ?>" class="btn default"><i class="fa fa-eye"></i> View Profile</a>
                                                    </div>
                                                <?php endif ?>

                                            <div class="stats-container">
                                                <div class="stats">
                                                    <h4><?php echo get_total_followers($user->id); ?></h4>
                                                    <p>
                                                        Followers
                                                    </p>
                                                </div>
                                                <div class="stats br">
                                                    <h4><?php echo get_total_followings($user->id); ?></h4>
                                                    <p>
                                                        Following
                                                    </p>
                                                </div>
                                                <div class="stats">
                                                    <h4><?php echo get_total_portfolio($user->id); ?></h4>
                                                    <p>
                                                        Portfolio
                                                    </p>
                                                </div>
                                                <div class="stats">
                                                    <h4><?php echo $user->hit; ?></h4>
                                                    <p>
                                                        Views
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end front panel -->
                            </div> <!-- end card -->
                        </div> <!-- end card-container -->
                    </div>
                <?php endforeach ?>
            <?php endif ?>

            <div class="col-md-12 text-center">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</section>