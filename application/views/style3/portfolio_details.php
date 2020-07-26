<div class="col-md-12">
    <div id="content" class="panel-container col-md-12">
      
        <div id="blog-post">
            <div class="row">
                <!--Post details-->
                <div class="col-md-12 post">
                <a class="pull-right" href="<?php echo base_url('profile/portfolio/'.html_escape($user->slug)) ?>"><i class="fa fa-angle-left"></i> Back</a><br>
                    <div class="blog-image">
                        <img src="<?php echo base_url($post->image) ?>" alt="image">
                    </div>
                    <div class="post-content">
                        <h1 class="blog-title bottom_20 top_30"><?php echo html_escape($post->title) ?></h1><br>
                        <p class="top_20">
                            <?php if (!empty($post->link)): ?>
                                <a target="_blank" href="<?php echo html_escape($post->link) ?>"><b><i class="fa fa-link" aria-hidden="true"></i> Visit Link </b></a>
                            <?php endif ?>
                        </p>
                        <p class="top_30"><?php echo html_escape($post->details) ?></p>
                    </div>

                </div> <!-- post end -->
                
            </div>
        </div>
        
    </div>
</div>