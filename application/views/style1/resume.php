<div class="col-md-12">
    <div id="content" class="panel-container">

        <div id="resume">
            <!-- Resume Section -->
            <div class="row">
                <section class="education">

                    <div class="row">
                        
                        <?php foreach ($experiences as $exp): ?>

                            <div class="working-history col-md-6 padding_15 padbot_30">
                                <ul class="timeline col-md-12 top_30">
                                    <li><i class="fa fa-suitcase" aria-hidden="true"></i><h2 class="timeline-title"><?php echo html_escape($exp['name']) ?></h2></li>
                                    
                                    <?php foreach ($exp['sub_exp'] as $sub_exp): ?>
                                        <li><h3 class="line-title"><?php echo html_escape($sub_exp['name']) ?> - <?php echo html_escape($sub_exp['company']) ?></h3>
                                            <span><?php echo html_escape($sub_exp['date']) ?></span>
                                            <p class="little-text"><?php echo html_escape($sub_exp['details']) ?></p>
                                        </li>
                                    <?php endforeach ?>

                                </ul> 
                            </div>  

                        <?php endforeach ?>

                     
                    </div>
                </section>
            </div>

            <!-- Testimonials -->
            <div class="row">
                <section class="testimonials bottom_30">
                    <div class="section-title top_60 bottom_30"><span></span><h2>Testimonials</h2></div>
                    <div class="owl-carousel row" data-items="3" data-autoplay="3000" data-pagination="true">
                       
                       <?php foreach ($testimonials as $test): ?>
                            <div class="col-md-12 item">
                                <div class="comment">
                                    <div class="top-section">
                                        <figure>
                                            <img src="<?php echo base_url($test->thumb) ?>" alt="">
                                        </figure>
                                        <div class="name-info">
                                            <span class="name"><?php echo html_escape($test->name) ?></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <p><?php echo html_escape($test->feedback) ?></p>
                                </div>
                            </div>
                        <?php endforeach ?>

                    </div>
                </section>
            </div>
        </div>
    </div>
</div>