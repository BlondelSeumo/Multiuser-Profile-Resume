<div class="col-md-12">
    <div id="content" class="panel-container col-md-12">
      
        <div id="blog-post">
            <div class="row">
                <!--Blog Post-->
                <div class="col-md-8 post">
                    <div class="blog-image">
                        <img src="<?php echo base_url($post->image) ?>" alt="image">
                    </div>
                    <div class="post-content">
                        <h1 class="blog-title bottom_20 top_30"><?php echo html_escape($post->title) ?></h1><br>
                        <p class="top_20"><i class="fa fa-folder-open"></i> <?php echo html_escape($post->category_name) ?> &emsp; <i class="fa fa-calender"></i> <?php echo my_date_show($post->created_at) ?> &emsp; <i class="fa fa-user"></i> <?php echo html_escape($user->name) ?></p>
                        <p class="top_30"><?php echo strip_tags($post->details) ?></p>
                    </div>
                    <div class="tags top_30">
                        <span><b>Tags:</b></span>
                        <?php foreach ($tags as $tag): ?>
                            <a class="btn btn-default btn-sm" href="#"># <?php echo html_escape($tag->tag) ?></a>
                        <?php endforeach ?>
                    </div>

                    <!-- Post Comments -->
                    <div class="post-comment">
                        <div class="section-title bottom_10 top_60"><span></span><h2>Comments - (<?php if(!empty($total_comment)){echo html_escape($total_comment);} ?>)</h2></div>
                        <ul>
                            <?php foreach ($comments as $comment): ?>
                                <li>
                                    <div class="row">
                                       
                                        <div class="col-md-12 col-sm-12 col-xs-12 comment-content">
                                            <div class="name"> <?php echo html_escape($comment->name); ?> &emsp; 
                                                <span class="date"><?php echo my_date_show($comment->created_at); ?></span>   
                                            </div> 
                                            <p><?php echo html_escape($comment->message); ?></p>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>   
                    </div>

                    <div class="leave-comment">
                        <div class="section-title bottom_30 top_60"><span></span><h2>Leave a Comment</h2></div>
                        <form method="post" class="site-form" action="<?php echo base_url('profile/send_comment/'.html_escape($post->id)); ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="site-input" type="input" name="name" placeholder="Name" required>
                                </div>
                                <div class="col-md-6">
                                    <input class="site-input" type="input" name="email" placeholder="E-mail" required>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="site-area" name="message" placeholder="Message" required></textarea>
                                </div>
                                <!-- csrf token -->
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                                <div class="col-md-12 top_15 bottom_30">
                                    <button class="site-btn" type="submit"><i class="fa fa-check"></i> Submit </button>
                                </div>
                            </div>
                        </form>   
                    </div>
                </div> <!-- post end -->
                <!--Sidebar-->
                <div class="col-md-4 blog-sidebar">
                    <div class="category bottom_30">
                        <div class="section-title bottom_15 top_15"><span></span><h3>Categories</h3></div>
                        <ul class="category-list">
                            <?php foreach ($categories as $category): ?>
                                <li> <a href="<?php echo base_url('category/'.html_escape($user->slug).'/'.html_escape($category->slug)) ?>"><?php echo html_escape($category->name) ?></a>
                                <span>(<b><?php echo count_posts_by_categories($category->id) ?></b>)</span></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <!-- Popular Post -->
                    <div class="post-list">
                        <div class="section-title bottom_15"><span></span><h3>Related Posts</h3></div>
                        <ul>
                            
                            <?php foreach ($related_posts as $rel_post): ?>
                                <li>
                                    <a href="<?php echo base_url('post/'.$user->slug.'/'.html_escape($rel_post->slug)) ?>">
                                        <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12 text-left">
                                            <img width="70px" src="<?php echo base_url($rel_post->thumb) ?>">
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <p class="little-text"><?php echo character_limiter($rel_post->title, 15); ?></p>
                                            <div class="info">
                                                <i class="icon-folder"></i> <?php echo html_escape($rel_post->category) ?> 
                                                &nbsp; <span><i class="icon-clock"></i> <?php echo my_date_show($rel_post->created_at) ?></span>
                                            </div>
                                        </div>
                                        </div>
                                        
                                    </a>
                                </li>
                            <?php endforeach ?>
                          
                        </ul>
                    </div>

                    <div class="tags-list top_30">
                        <div class="section-title bottom_15"><span></span><h3>Tags</h3></div>
                        <div class="tagcloud">
                            <?php foreach ($tags as $tag): ?>
                                <?php if ($tag->tag != ''): ?>
                                    <a href="#" type="button" class="custom-btn-sm"><?php echo html_escape($tag->tag) ?></a>
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                    
                </div> 
            </div>
        </div>
        
    </div>
</div>