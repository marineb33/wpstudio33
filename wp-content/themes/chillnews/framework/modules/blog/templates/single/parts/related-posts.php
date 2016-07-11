<div class="mkdf-related-posts-holder">
	<?php if ( $related_posts && $related_posts->have_posts() ) : ?>
		<div class="mkdf-related-posts-title">
			<h6><?php esc_html_e('RELATED ARTICLES', 'chillnews' ); ?></h6>
		</div>
		<div class="mkdf-related-posts-inner clearfix">
			<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
				<div class="mkdf-related-post">
					<div class="mkdf-related-post-inner">
                        <?php if (has_post_thumbnail()) { ?>
						    <div class="mkdf-related-post-image">
								<a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php if($related_posts_image_size !== '') {
										the_post_thumbnail(array($related_posts_image_size, 0));
									} else {
										the_post_thumbnail('chillnews_mikado_post_feature_image');
									} ?>
								</a>
							<?php chillnews_mikado_post_info_category(array('category' => 'yes')) ?>
						    </div>
                        <?php }
                        else { ?>
                            <?php chillnews_mikado_post_info_category(array('category' => 'yes')) ?>
                        <?php } ?>
						<div class="mkdf-related-post-title">
							<?php
								$excerpt = '';
								if(get_the_title() != '') {
									$title_text = get_the_title();
									$excerpt = rtrim(substr($title_text, 0, 20));
								}
							?>
							<h5><a itemprop="name" class="entry-title mkdf-post-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html($excerpt); ?></a></h5>
						</div>
					</div>	
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif; 
	wp_reset_postdata();
	?>
</div>