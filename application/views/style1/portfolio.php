<div class="col-md-12">
    <div id="content" class="panel-container">

        <div id="portfolio" class="row bottom_45">
            <section class="col-md-12">
                <div class="col-md-12 content-header top_30 bottom_15">
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
                                    <img src="<?php echo base_url($portfolio->image) ?>" alt="">
                                    <!-- <figcaption>
                                        <span class="title"><?php echo html_escape($portfolio->title) ?></span><br/>
                                        <span class="info"><?php echo character_limiter($portfolio->details, 100) ?></span>
                                    </figcaption> -->
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




<!-- Modal -->
<?php foreach ($portfolios as $portfolio): ?>
<div id="portfolio_modal_<?php echo html_escape($portfolio->id) ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo html_escape($portfolio->title) ?></h4>
      </div>
      <div class="modal-body">
        <img width="100%" src="<?php echo base_url($portfolio->image) ?>" alt=""> <br><br>
        <?php if (!empty($portfolio->link)): ?>
            <a target="_blank" href="<?php echo html_escape($portfolio->link) ?>"><b><i class="fa fa-link" aria-hidden="true"></i> Visit Link </b></a>
        <?php endif ?>
        <p class="m-t-10"><?php echo html_escape($portfolio->details) ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php endforeach ?>