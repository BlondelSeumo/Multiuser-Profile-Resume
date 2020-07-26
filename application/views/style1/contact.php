

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
                    <form method="post" class="site-form" action="<?php echo base_url('send-message'); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="input" name="name" placeholder="Name">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="input" name="email" placeholder="E-mail">
                            </div>
                            <div class="col-md-12 top_25">
                                <textarea class="form-control" name="message" placeholder="Message" rows="8"></textarea>
                            </div>
                            <!-- csrf token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                            <div class="col-md-12 top_15 bottom_30">
                                <input type="hidden" name="user_id" value="<?php echo html_escape($user->id) ?>">
                                <button class="site-btn" type="submit"><i class="fa fa-paper-plane"></i> Send</button>
                            </div>
                        </div>
                    </form>  
                </section>
                <!-- Contact Informations -->
                <section class="contact-info col-md-6 top_10 padbot_45">
                    <div class="section-title"><span></span><!-- <h2>Contact Informations</h2> --></div>
                    <ul>
                        <?php if (!empty($user->address)): ?>
                            <li><span><i class="icon-location-pin"></i> Address:</span> <?php echo html_escape($user->address) ?></li>
                        <?php endif ?>
                        <?php if (!empty($user->phone)): ?>
                            <li><span><i class="icon-call-end"></i> Phone:</span> <?php echo html_escape($user->phone) ?></li>
                        <?php endif ?>
                        <?php if (!empty($user->email)): ?>
                            <li><span><i class="icon-envelope-open"></i> E-mail:</span> <?php echo html_escape($user->email) ?></li>
                        <?php endif ?>
                        <?php if (!empty($user->skype)): ?>
                            <li><span><i class="fa fa-skype"></i> Skype:</span> <?php echo html_escape($user->skype) ?></li>
                        <?php endif ?>
                        <?php if (!empty($user->whatsapp)): ?>
                            <li><span><i class="fa fa-whatsapp"></i> Whatsapp:</span> <?php echo html_escape($user->whatsapp) ?></li>
                        <?php endif ?>
                    </ul>

                    <div class="user-social-acount top_15">
                        <?php if (!empty($user->facebook)): ?>
                          <a target="_blank" href="<?php echo html_escape($user->facebook) ?>" class="btn btn-circle btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                        <?php endif ?>

                        <?php if (!empty($user->twitter)): ?>
                          <a target="_blank" href="<?php echo html_escape($user->twitter) ?>" class="btn btn-circle btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                        <?php endif ?>

                        <?php if (!empty($user->instagram)): ?>
                          <a target="_blank" href="<?php echo html_escape($user->instagram) ?>" class="btn btn-circle btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                        <?php endif ?>

                        <?php if (!empty($user->linkedin)): ?>
                          <a target="_blank" href="<?php echo html_escape($user->linkedin) ?>" class="btn btn-circle btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
                        <?php endif ?>
                    </div>

                </section>
            </div>
        </div>
    </div>
</div>