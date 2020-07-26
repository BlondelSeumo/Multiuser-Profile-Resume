<!--Contact Section-->
    <section class="contact-form-area section-padding" id="contact-page">
        <div class="container">

            <?php if ($settings->enable_registration == 0): ?>
                <div class="col-md-12 text-center">
                    <h2 class="text-danger" style="padding: 200px">Registration system is disabled !</h2>
                </div>
            <?php else: ?>
                

            <div class="row">
                <div class="page-title">
                    <h2 class="title">Create your page</h2>
                    <div class="space-40"></div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-offset-2 col-md-8">
                    <?php if (!empty($this->session->flashdata('msg'))): ?>
                        <div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong><i class="icon-check"></i> <?php echo $this->session->flashdata('msg'); ?> !</strong>
                        </div>
                    <?php endif ?>
                    
                    <?php if (!empty($this->session->flashdata('error'))): ?>
                        <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong><i class="icon-close"></i> <?php echo $this->session->flashdata('error'); ?> !</strong>
                        </div>
                    <?php endif ?>
                </div>

                <div class="col-md-offset-3 col-md-6">
                    <div class="contact-form">
                        <form id="register-form" method="post" action="<?php echo base_url('register_user'); ?>">
                            <div class="col-sm-12">

                                <div class="floating-label-form-group input-controls control-group">
                                    <input type="text" placeholder="Your name" name="name" autocomplete="off" required />
                                    <p class="help-block text-danger"></p>
                                </div>
                                
                                <div class="floating-label-form-group input-controls control-group">
                                    <input type="email" placeholder="Email" name="email" autocomplete="off" id="email" required />
                                    <p class="help-block text-danger"></p>
                                </div>

                                <div class="floating-label-form-group input-controls control-group">
                                    <input type="text" placeholder="User Name" name="user_name" autocomplete="off" id="user-name" required />
                                    <div class="space-10"></div>
                                    
                                    <div class="bubble loader-bubble" style="display: none;">
                                      <div class="bounce1"></div>
                                      <div class="bounce2"></div>
                                      <div class="bounce3"></div>
                                    </div>

                                    <h5 class="text-danger" id="name_exist" style="display: none;"><i class="icon-close"></i> Username already taken, try another</h5>
                                    <h5 class="text-success" id="name_available" style="display: none;"><i class="icon-check"></i> Username is available</h5>
                                </div>

                                <div class="floating-label-form-group input-controls control-group">
                                    <input type="password" placeholder="Password" name="password" id="password" required />
                                    <p class="help-block text-danger"></p>
                                </div>

                                <div class="space-10"></div>
                                <div class="floating-label-form-group input-controls control-group">
                                    <label>Select Package</label>
                                    <div class="radio-inline">
                                        <input type="radio" id="test1" name="package" value="free" <?php if(isset($_GET['package']) && $_GET['package'] == 'free'){echo "checked";} ?>>
                                        <label for="test1">Free</label>
                                    </div>
                                    <div class="radio-inline">
                                        <input type="radio" id="test2" name="package" value="pro" <?php if(isset($_GET['package']) && $_GET['package'] == 'pro'){echo "checked";} ?>>
                                        <label for="test2">Pro</label>
                                    </div>
                                </div>
                                <div class="space-20"></div>
                                
                            </div>
                            <!-- csrf token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            
                            <div class="col-sm-12">
                                <?php if ($settings->enable_captcha == 1 && $settings->captcha_site_key != ''): ?>
                                    <div class="g-recaptcha pull-left" data-sitekey="<?php echo html_escape($settings->captcha_site_key); ?>"></div>
                                    <div class="space-30"></div>
                                <?php endif ?>
                            </div>

                            <div class="col-sm-12">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" class="terms_cond" value="" required>
                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                    I have read the <a href="<?php echo base_url('terms-and-conditions') ?>">terms and conditions</a> and accept them.
                                  </label>
                                </div>

                                <div id="success"></div>
                                <button type="submit" id="create-btn">Create</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <?php endif ?>

        </div>
    </section><!--/Contact Section-->