<!-- Footer-Area -->
    <footer class="footer-area" style="background-image: url('<?php echo base_url() ?>assets/front/images/footer-shape.png'); background-position: left top;">
        <div class="footer-top">
            <div class="container">
                <div class="row start-height">
                    <div class="col-xs-12 col-md-5">
                        <img width="40%" src="<?php echo base_url($settings->logo) ?>" alt="Footer Logo">
                        <div class="space-10"></div>
                        <p><?php echo html_escape($settings->footer_about) ?></p>
                        <div class="space-10"></div>
                        <ul class="footer-list list-inline">
                            <?php if (!empty($settings->facebook)) : ?>
                                <li><a target="_blank" href="<?php echo html_escape($settings->facebook) ?>" title="Facebook">
                                    <i class="fab fa-facebook"></i>
                                </a></li>
                            <?php endif; ?>
                            <!--if twitter url exists-->
                            <?php if (!empty($settings->twitter)) : ?>
                                <li><a target="_blank" href="<?php echo html_escape($settings->twitter) ?>" title="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a></li>
                            <?php endif; ?>
                            <!--if google url exists-->
                            <?php if (!empty($settings->linkedin)) : ?>
                                <li><a target="_blank" href="<?php echo html_escape($settings->instagram) ?>" title="instagram">
                                    <i class="fab fa-linkedin"></i>
                                </a></li>
                            <?php endif; ?>
                            <!--if flickr url exists-->
                            <?php if (!empty($settings->instagram)) : ?>
                                <li><a target="_blank" href="<?php echo html_escape($settings->instagram) ?>" title="instagram">
                                    <i class="fab fa-instagram"></i>
                                </a></li>
                            <?php endif; ?>
                        </ul>

                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3 xs-full">
                        <h4 class="footer-title">Useful links</h4>
                        <ul class="footer-list">
                            <li><a href="<?php echo base_url('features') ?>">Features</a></li>
                            <li><a href="<?php echo base_url('pricing') ?>">Pricing</a></li>
                            <li><a href="<?php echo base_url('create-profile') ?>">Create your page</a></li>
                            <li><a href="<?php echo base_url('terms-and-conditions') ?>">Terms & Conditions</a></li>
                            
                        </ul>
                        <div class="hidden visible-xs visible-sm space-60"></div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3 xs-full">
                        <h4 class="footer-title">Pages</h4>
                        <ul class="footer-list">
                            <?php $pages = get_pages(); ?>
                            <?php foreach ($pages as $page): ?>
                                <li><a href="<?php echo base_url('page/'.html_escape($page->slug)) ?>"><?php echo html_escape($page->title); ?></a></li>
                            <?php endforeach ?>
                        </ul>
                        <div class="hidden visible-xs visible-sm space-60"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row start-height">
                    <div class="col-md-12 text-center">
                        <p><?php echo html_escape($settings->copyright) ?></p>
                        <div class="hidden visible-xs space-30"></div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </footer><!-- /Footer-Area -->

    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <!--Vendor-JS-->
    <script src="<?php echo base_url() ?>assets/front/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/vendor/bootstrap.min.js"></script>
    <!--Plugin-JS-->
    <script src="<?php echo base_url() ?>assets/front/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/waypoints.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/magnific-popup.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/isotope.pkgd.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/slicknav.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/jqBootstrapValidation.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/wow.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/scrollUp.min.js"></script>
    <!--Main-active-JS-->
    <script src="<?php echo base_url() ?>assets/front/js/main.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/sweet-alert.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var base_url = $('#base_url').val();
            // follow user
            $(document).on('click', ".follow", function() {
                var id = $(this).attr('data-id');

                var url = base_url+'home/follow/'+id;
                $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
                    if(json.st == 1){
                        $("#item_"+id+" .follow").html('<i class="fa fa-check"></i> Following');
                        $("#item_"+id+" .follow").addClass('unfollow');
                        $("#item_"+id+" .follow").removeClass('follow');
                    }
                 },'json');
                return false;
            });

            // unfollow user
            $(document).on('click', ".unfollow", function() {
                var id = $(this).attr('data-id');
                var url = base_url+'home/unfollow/'+id;
                $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
                    if(json.st == 1){
                        $("#item_"+id+" .unfollow").html('<i class="fa fa-user-plus"></i> Follow');
                        $("#item_"+id+" .unfollow").addClass('follow');
                        $("#item_"+id+" .unfollow").removeClass('unfollow');
                    }
                 },'json');
                return false;
            });

            $(".sort_user").change(function(){
                var url = $(this).val();
                window.location = url;
            });

            $(".terms_cond").on('click', function() {
              var $box = $(this);
              if ($box.is(":checked")) {
                $($box).val("1");
                $box.prop("checked", true);
              } else {
                $($box).val("");
                $box.prop("checked", false);
              }
            });

            $(document).ready(function() {
                $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
                    e.preventDefault();
                    $(this).siblings('a.active').removeClass("active");
                    $(this).addClass("active");
                    var index = $(this).index();
                    $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                    $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
                });
            });

        });
    </script>
    
</body>
</html>