<div class="col-md-12">
    <div id="content" class="panel-container">

        <div id="blog">
            <div class="row">
                <section class="blog col-md-12 bottom_30">
                    <div class="col-md-12 content-header">
                        <div class="section-title top_30 bottom_30"><span></span><h2><?php if(isset($page_title)) {echo html_escape($page_title);} ?></h2></div>
                    </div>
                    <div class="row">
                        <?php foreach ($blog_posts as $post): ?>
                            <?php if (!empty($blog_posts)): ?>
                                <a href="<?php echo base_url('post/'.$user->slug.'/'.$post->slug) ?>">
                                    <div class="blog-item col-md-4 bottom_45">
                                        <div class="item-box">
                                            <div class="blog-img" style="background-image: url(<?php echo base_url($post->image) ?>);">
                                                
                                            </div>
                                            <div class="blog-box-info">
                                                <span class="date top_10"><i class="fa fa-folder-open"></i> <?php echo html_escape($post->category) ?> &nbsp; <i class="fa fa-clock-o"></i> <?php echo my_date_show($post->created_at) ?></span>
                                                <h2 class="title top_10"><?php echo html_escape($post->title) ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endif ?>
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
</div>