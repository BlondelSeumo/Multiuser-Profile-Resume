
<!-- start section -->
<section class="section-padding">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8 col-xl-9">
				<div class="content-container">
					<!-- start posts -->
					<div class="posts">
						<div class="__item">
							<img class="img-fluid" width="878" height="586" src="<?php echo base_url($post->image) ?>" alt="demo" />

							<div class="mt-6 mt-lg-10 mb-lg-4 mtb">
								<div class="row align-items-sm-center justify-content-sm-between">
									<div class="col-md-6">
										<div class="post-author">
											<div class="d-table">
												<div class="d-table-cell align-middle">
													<span class="post-author__name"><?php echo html_escape($post->category_name) ?></span>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-6 text-right">
										<time> <?php echo my_date_show($post->created_at) ?></time>
									</div>
								</div>
							</div>

							<h3>
								<?php echo html_escape($post->title) ?>
							</h3>

							<p>
								<?php echo $post->details; ?>
							</p>

							<?php if (!empty($tags)): ?>
								<div class="my-6 my-md-11">
									<div class="h5">Tags:</div>
									<div class="tags-list">
										<ul class="">
											<?php foreach ($tags as $tag): ?>
												<li><a href="#"><?php echo html_escape($tag->tag) ?></a></li>
											<?php endforeach ?>
										</ul>
									</div>
								</div>
							<?php endif ?>

						</div>
					</div>
					<!-- end posts -->
				</div>

			</div>

			<div class="spacer py-4 d-lg-none"></div>

			<div class="col-12 col-lg-4 col-xl-3">

				<!-- start sidebar -->
				<aside class="sidebar">
					<!-- start widget -->
					<div class="widgets widgets--categories">
						<h4 class="widgets-title">Category</h4>

						<ul class="list">
							<?php foreach ($categories as $category): ?>
								<li class="list__item">
									<a class="list__item__link" href="<?php echo base_url('category/'.$category->slug) ?>"><?php echo html_escape($category->name) ?><span class="post-count"><?php echo count_posts_by_categories($category->id) ?></span></a>
								</li>
							<?php endforeach ?>
						</ul>
					</div>
					<!-- end widget -->

					<!-- start widget -->
					<div class="widgets widgets--posts">
						<h4 class="widgets-title">Related Posts</h4>

						<div>
							<?php foreach ($related_posts as $post): ?>
							<article>
								<div class="row no-gutters">
									<div class="col-sm-5 col-xs-6 __image-wrap">
										<figure class="__image">
											<a href="<?php echo base_url('post/'.$post->slug) ?>">
												<img src="<?php echo base_url($post->image) ?>" alt="demo" />
											</a>
										</figure>
									</div>

									<div class="col-sm-7 col-xs-6">
										<h5 class="__title"><a href="<?php echo base_url('post/'.$post->slug) ?>"><?php echo html_escape($post->title) ?></a></h5>

										<div class="post-meta">
											<time class="post-meta__item __date-post"><?php echo my_date_show($post->created_at) ?></time>
										</div>
									</div>
								</div>
							</article>
							<?php endforeach ?>
						</div>
					</div>
					<!-- end widget -->

				</aside>
				<!-- end sidebar -->

			</div>
		</div>
	</div>
</section>
<!-- end section -->