<?php $sidebar = chillnews_mikado_sidebar_layout(); ?>
<?php get_header(); ?>
<?php 
$blog_page_range = chillnews_mikado_get_blog_page_range();
$max_number_of_pages = chillnews_mikado_get_max_number_of_pages();

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

$enable_search_page_sidebar = true;
if(chillnews_mikado_options()->getOptionValue('enable_search_page_sidebar') === "no"){
	$enable_search_page_sidebar = false;
}
?>
<?php chillnews_mikado_get_title(); ?>
	<div class="mkdf-container">
		<?php do_action('chillnews_mikado_after_container_open'); ?>
		<div class="mkdf-container-inner clearfix">
			<div class="mkdf-container">
				<?php do_action('chillnews_mikado_after_container_open'); ?>
				<div class="mkdf-container-inner">
					<?php if($enable_search_page_sidebar) { ?>
					<div class="mkdf-two-columns-66-33 mkdf-content-has-sidebar clearfix">
						<div class="mkdf-column1 mkdf-content-left-from-sidebar">
							<div class="mkdf-column-inner">
					<?php } ?>		
								<div class="mkdf-search-page-holder">

				                	<h1 class="mkdf-search-results-holder"><?php echo get_search_query() . esc_html__(' - Search Results', 'chillnews') ?></h1>

									<form action="<?php echo esc_url(home_url('/')); ?>" class="mkdf-search-page-form" method="get">
										<div class="mkdf-form-holder">
											<div class="mkdf-column-left">
												<input type="text"  name="s" class="mkdf-search-field" autocomplete="off" />
											</div>
											<div class="mkdf-column-right">
												<button class="mkdf-search-submit" type="submit" value="Search"><span class="ion-ios-search"></span></button>
											</div>
										</div>
										<span class="mkdf-search-label"><?php esc_html_e("If you're not happy with the results, please do another search", 'chillnews'); ?></span>
									</form>	

									<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
										<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
											<div class="mkdf-post-content">

												<?php if ( has_post_thumbnail() ) { ?>
													<div class="mkdf-post-image">
														<a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
															<?php the_post_thumbnail('chillnews_mikado_search_page_image'); ?>
														</a>
														<?php chillnews_mikado_post_info_category(array('category' => 'yes')) ?>
													</div>
												<?php } else { ?>
													<div class="mkdf-post-image">
														<a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
															<img src="<?php echo MIKADO_ASSETS_ROOT.'/img/search_image.png'; ?>" alt="Post Feature Image" />
														</a>
														<?php chillnews_mikado_post_info_category(array('category' => 'yes')) ?>
													</div>
												<?php } ?>

												<div class="mkdf-post-title-area">
													<h3 itemprop="name" class="entry-title"><a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
													<div class="mkdf-post-info">
														<?php chillnews_mikado_post_info_date(array('date' => 'yes', 'date_format' => 'M, d, Y')) ?>
														<?php chillnews_mikado_post_info_comments(array('comments' => 'yes')) ?>
													</div>
													<?php
														$my_excerpt = get_the_excerpt();
														//explode current excerpt to words
														$excerpt_word_array = explode(' ', $my_excerpt);

														//cut down that array based on the number of the words option
														$excerpt_word_array = array_slice($excerpt_word_array, 0, 22);

														//and finally implode words together
														$my_excerpt = implode (' ', $excerpt_word_array);
														if ($my_excerpt != '') { ?>
															<p class="mkdf-post-excerpt"><?php echo esc_html($my_excerpt); ?></p>
														<?php }
													?>
												</div>
											</div>
										</article>
									<?php endwhile; ?>
									<?php
										if(chillnews_mikado_options()->getOptionValue('pagination') == 'yes') {
											chillnews_mikado_pagination($max_number_of_pages, $blog_page_range, $paged);
										}
									?>
									<?php else: ?>
									<div class="entry">
										<p><?php esc_html_e('No posts were found.', 'chillnews'); ?></p>
									</div>
									<?php endif; ?>
								</div>
								<?php do_action('chillnews_mikado_page_after_content'); ?>
					<?php if($enable_search_page_sidebar) { ?>			
							</div>
						</div>
						<div class="mkdf-column2">
							<?php get_sidebar(); ?>
						</div>
					</div>
					<?php } ?>
				<?php do_action('chillnews_mikado_before_container_close'); ?>
				</div>
			</div>
		</div>
		<?php do_action('chillnews_mikado_before_container_close'); ?>
	</div>
<?php get_footer(); ?>