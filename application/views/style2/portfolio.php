<div class="col-md-12">
    <div id="content" class="panel-container">
        <div id="portfolio" class="row bottom_45">
            <section class="col-md-12">
                <div class="col-md-12 content-header bottom_15">
                    <div class="section-title top_30 bottom_30"><span></span><h2>Portfolio</h2></div>
                    <div id="filters-container">
                        <div data-filter="*" class="cbp-filter-item cbp-filter-item-active">All</div>
                        <?php foreach ($categories as $category): ?>
                            <div data-filter=".<?php echo html_escape($category->slug) ?>" class="cbp-filter-item"><?php echo html_escape($category->name) ?></div>
                        <?php endforeach ?>
                    </div>
                </div>

                <div id="grid-container" class="top_60">
                    <?php foreach ($portfolios as $portfolio): ?>
                        <div class="cbp-item <?php echo html_escape($portfolio->category) ?>">
                            <a href="<?php echo base_url('portfolio/'.html_escape($user->slug).'/'.html_escape($portfolio->id)) ?>" data-toggle="modal">
                                <figure>
                                    <img src="<?php echo base_url($portfolio->image) ?>" alt="" >
                                    <figcaption>
                                        <span class="title"><?php echo html_escape($portfolio->title) ?></span><br/>
                                        <span class="info"><?php echo character_limiter($portfolio->details, 100) ?></span>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>

                <div class="row">
                    <div class="cbp-l-loadMore-button top_60">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
                
            </section>
        </div>
    </div>
</div>