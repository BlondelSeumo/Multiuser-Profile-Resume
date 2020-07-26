<div class="col-md-12">
    <div id="content" class="panel-container">

        <div id="blog">
            <div class="row">
                <section class="blog col-md-12 bottom_30">
                    <div class="col-md-12 content-header">
                        <div class="section-title top_30 bottom_15"><span></span><h2><?php if(isset($page_title)) {echo html_escape($page_title);} ?></h2></div>
                    </div>
                    <div id="grid-blog" class="row">
                        
                        <?php foreach ($blog_posts as $post): ?>
                            <?php if (!empty($post->id)): ?>
                                <div class="cbp-item">
                                    <a href="<?php echo base_url('post/'.$user->slug.'/'.$post->slug) ?>" class="blog-box">
                                        <div class="blog-img">
                                            <img src="<?php echo base_url($post->image) ?>" alt="Image">
                                        </div>
                                        <div class="blog-box-info">
                                            <span class="date"><i class="fa fa-folder-open"></i> <?php echo html_escape($post->category) ?> &emsp; <i class="fa fa-clock-o"></i> <?php echo my_date_show($post->created_at) ?></span> 
                                            <h2 class="title"><?php echo html_escape($post->title) ?></h2>
                                            <p class="little-text"><?php echo character_limiter($post->details, 40) ?></p>
                                        </div>
                                    </a>
                                </div>
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