<!--Contact Section-->
    <section class="contact-form-area section-padding">
        <div class="container">
            <div class="row">
                <div class="page-title">
                    <h2 class="title">Say Hi!</h2>
                    <div class="desc">Contact us</div>
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
                <div class="col-md-offset-2 col-md-8">
                    <div class="contact-form">
                        <form method="post" action="<?php echo base_url('home/send_message'); ?>">
                            <div class="col-sm-6">
                                <div class="floating-label-form-group input-controls control-group">
                                    <input type="text" placeholder="Name" name="name" id="name" required />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="floating-label-form-group input-controls control-group">
                                    <input type="email" placeholder="Email" name="email" id="email" required />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="floating-label-form-group input-controls control-group">
                                    <textarea id="message" name="message" required placeholder="Write your Message"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <!-- csrf token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            
                            <div class="col-sm-6">
                                <?php if ($settings->enable_captcha == 1 && $settings->captcha_site_key != ''): ?>
                                    <div class="g-recaptcha pull-left" data-sitekey="<?php echo html_escape($settings->captcha_site_key); ?>"></div>
                                <?php endif ?>
                            </div>
                            <div class="col-sm-6">
                                <div id="success"></div>
                                <button type="submit">Send Message</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Contact Section-->