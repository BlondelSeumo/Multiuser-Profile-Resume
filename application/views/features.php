<!-- Pricing Area -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="page-title">
                        <h2 class="title">Explore Our Features</h2>
                        <div class="desc">Check our free & Pro features</div>
                        <div class="space-20"></div>
                    </div>
                </div>
            </div>

            <div class="row minh-400">

                <?php if (empty($features)): ?>
                    <h3 class="text-center" style="margin-top: 100px">No features found!</h3>
                <?php else: ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                          <div class="list-group">
                            <?php $i=1; foreach ($features as $feature): ?>
                                <a href="#" class="list-group-item text-center <?php echo($i==1) ? 'active' : '';?>">
                                  <?php echo html_escape($feature->name); ?>
                                </a>
                            <?php $i++; endforeach ?>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                            <?php $a=1; foreach ($features as $feature): ?>
                                <div class="bhoechie-tab-content <?php echo($a==1) ? 'active' : '';?>">
                                    <center class="wow">
                                      <h5 style="margin-top: 0; color:#55518a;"><?php echo $feature->details; ?></h5>
                                      <div class="space-30"></div>
                                      <img width="70%" src="<?php echo base_url($feature->image) ?>">
                                    </center>
                                </div>
                            <?php $a++; endforeach ?>
                        </div>
                    </div>
                <?php endif ?>
     
            </div>

        </div>
    </section><!-- /Pricing Area -->