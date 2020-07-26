
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="page-title">
                    <h2 class="title">Explore Our Pricing</h2>
                    <div class="desc">Select your comfortable plan</div>
                    <div class="space-60"></div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <?php $p=0; foreach ($packages as $package): ?>
                <div class="col-md-4 col-sm-4 col-xs-12 <?php if($p == 0){echo "col-md-offset-2";} ?> wow fadeInRight <?php if($package['is_special'] == 1){echo "special-pricing";} ?>" data-wow-delay="0.2s">
                    <div class="single-pricing">
                        <div class="price-type"><?php echo html_escape($package['name']) ?></div>
                        <div class="price-amount"><?php echo html_escape($settings->currency_symbol);?><?php echo round($package['price']) ?> <?php if($package['slug'] != 'free'){echo "<small>Per year</small>";} ?>
                        </div>
                        <div class="price-features">
                            <ul>
                                <?php foreach ($package['features'] as $feature): ?>
                                    <li><?php echo html_escape($feature['name']) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <a href="<?php echo base_url('create-profile?package='.html_escape($package['slug'])) ?>" class="bttn-1">Select Plan</a>
                    </div>
                    <div class="hidden visible-xs space-30"></div>
                </div>
            <?php $p++; endforeach ?>
        </div>
    </div>
</section><!-- /Pricing Area
