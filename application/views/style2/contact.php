

<div class="col-md-12">

    <div class="row">
        <?php if (!empty($this->session->flashdata('msg'))): ?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong><?php echo $this->session->flashdata('msg'); ?> !</strong>
            </div>
        <?php endif ?>
    </div>


    <div id="content" class="panel-container">

        <div id="contact">

            <div class="row">
                <!-- Contact Form -->

                <section class="contact-form col-md-6 padding_30 padbot_45">
                    <div class="section-title top_15 bottom_30"><span></span><h2>Contact Form</h2></div>
                    <form method="post" class="site-form" action="<?php echo base_url('send-message'); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="input" name="name" placeholder="Name">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="input" name="email" placeholder="E-mail">
                            </div>
                            <div class="col-md-12 top_30">
                                <textarea class="form-control" name="message" placeholder="Message" rows="8"></textarea>
                            </div>
                            <!-- csrf token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                            <div class="col-md-12 top_15 bottom_30">
                                <button class="site-btn" type="submit"><i class="fa fa-paper-plane"></i> Send</button>
                            </div>
                        </div>
                    </form> 
                </section>
                <section class="contact-info col-md-6 top_60">
                    <div class="section-title"><span></span></div>
                    <ul>
                        <li><span><i class="fa fa-map-marker"></i> Address:</span> <?php echo html_escape($user->address) ?></li>
                        <li><span><i class="fa fa-phone"></i> Phone:</span> <?php echo html_escape($user->phone) ?></li>
                        <li><span><i class="fa fa-envelope"></i> E-mail:</span> <?php echo html_escape($user->email) ?></li>
                        <li><span><i class="fa fa-skype"></i> Skype:</span> <?php echo html_escape($user->skype) ?></li>
                        <li><span><i class="fa fa-whatsapp"></i> Whatsapp:</span> <?php echo html_escape($user->whatsapp) ?></li>
                        <li>
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
                        </li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</div>