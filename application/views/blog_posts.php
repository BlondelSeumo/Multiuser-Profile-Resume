
<!-- start section -->
<section class="section minh-500">
	<div class="container">
		
		<div class="space-60"></div>
		<?php if (empty($posts)): ?>
            <div class="text-center">
            	<div class="space-60"></div>
                <h3 class="ptb-200"><span>No posts found!</span></h3>
            </div>
        <?php else: ?>

			<div class="row">
				<div class="col-12">
					<?php if (isset($title)): ?>
						<div class="section-heading">
							<h3 class="mb-2"><span>Category - <?php echo html_escape($title); ?></span></h3>
						</div>
						<div class="space-20"></div>
					<?php endif ?>
					<!-- start posts -->
					<div class="posts posts-style-1">
						<div class="__inner">
							<div class="row">
								<!-- start item -->
								<?php foreach ($posts as $post): ?>
									<div class="col-12 col-sm-6 col-lg-4 d-sm-flex">
										<div class="__item __item--preview">
											<div class="__header">
												<a href="<?php echo base_url('post/'.$post->slug) ?>">
													<figure class="__image">
														<img width="303" height="223" src="<?php echo base_url($post->image) ?>" alt="demo" />
													</figure>
												</a>
											</div>

											<div class="__body">
												<div class="__content">
													<a class="post_category" href="<?php echo base_url('category/'.$post->category_slug) ?>">
														<?php echo html_escape($post->category) ?>
													</a>

													<h4 class="__title"><a href="<?php echo base_url('post/'.$post->slug) ?>"><?php echo html_escape($post->title) ?></a></h4>

													<p>
														<?php echo character_limiter($post->details, 100)?>
													</p>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach ?>
								<!-- end item -->

							</div>
						</div>
					</div>
					<!-- end posts -->

					<!-- start pagination -->
					<div class="row">
						<div class="mt-md-12 text-center">
							<?php echo $this->pagination->create_links(); ?>
						</div>
					</div>
					<!-- end pagination -->

				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
<!-- end section -->