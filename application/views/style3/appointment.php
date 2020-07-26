<div class="col-md-12">

    <div id="content" class="panel-container">

        <div id="contact">

            <div class="row">
                <!-- Contact Form -->
                
                <div class="row">
                    <?php if (!empty($this->session->flashdata('msg'))): ?>
                        <section class="contact-form col-md-12 padding_30">
                            <div class="alert alert-success alert-dismissible">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <strong><?php echo $this->session->flashdata('msg'); ?> !</strong>
                            </div>
                        </section>
                    <?php endif ?>
                </div>

                <section class="contact-form col-md-7 padding_30 padbot_45">

                    <form method="post" class="site-form" action="<?php echo base_url('book-appointment/'.html_escape($user->slug)); ?>">
                        
                        <div class="row">
                            
                            <div class="col-md-12">
                                <label class="cus-label">Appointment Title <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input class="form-control" type="input" name="title" >
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="cus-label">Select Date & Time <span class="text-danger">*</span>
                                    </label>
                                    <div class='input-group date datetimepicker1' id=''>
                                      <input type='text' name="book_time" class="form-control" value="" autocomplete="off" required />
                                      <span class="input-group-addon">
                                          <span class="icon-calendar"></span>
                                      </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="cus-label">Email</label>
                                    <input class="form-control" type="input" name="email">
                                </div>
                            </div>
                           
                            <!-- csrf token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                            <div class="col-md-12 top_15 bottom_30">
                                <input type="hidden" name="user_id" value="<?php echo html_escape($user->id) ?>">
                                <button class="site-btn" type="submit"> Book Appointment</button>
                            </div>
                        </div>
                    </form>  
                </section>

                <section class="contact-info col-md-5 padding_30 padbot_45">
                    <p><i class="icon-info"></i> Before booking an appointment please check my availability</p>

                    <?php $days = get_days(); ?>
                    <ul>
                        <?php if (empty($my_days)): ?>
                            <li><i class="fa fa-ban"></i> No days selected for appointment</li>
                        <?php else: ?>
                            <?php  $i=1; foreach ($days as $day): ?>
                                
                                <?php foreach ($my_days as $asnday): ?>
                                  <?php if ($asnday['day'] == $i) {
                                    $check = 'check';
                                    break;
                                  } else {
                                    $check = 'times not';
                                  }
                                  ?>
                                <?php endforeach ?>

                                <li><span><i class="fa fa-<?php echo $check; ?>"></i> <?php echo $day ?> 
                                <?php if (!empty($my_days[$i-1]['start'])): ?>
                                    &emsp; <strong>(<?php echo $my_days[$i-1]['start'].' - '.$my_days[$i-1]['end'] ?>)</strong>
                                <?php endif ?>
                                </span></li>

                            <?php  $i++; endforeach ?>
                        <?php endif ?>
                    </ul>

                </section>
                
            </div>
        </div>
    </div>
</div>