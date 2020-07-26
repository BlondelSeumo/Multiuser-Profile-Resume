
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-lext">
                        <?php if (isset($page_title) && $page_title == 'Terms & Condition'): ?>
                            <h3 class="title">Terms & Conditions</h3>
                            <div class="desc"><?php echo get_settings()->terms_condition ?></div>
                        <?php else: ?>
                            <h3 class="title"><?php echo html_escape($page_name) ?></h3>
                            <div class="desc"><?php echo $page->details ?></div>
                        <?php endif ?>
                        <div class="space-200"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>