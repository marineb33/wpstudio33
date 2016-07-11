<?php if(chillnews_mikado_options()->getOptionValue('blog_single_navigation') == 'yes'){ ?>
	<?php $navigation_blog_through_category = chillnews_mikado_options()->getOptionValue('blog_navigation_through_same_category') ?>
	<div class="mkdf-blog-single-navigation">
		<?php if(get_previous_post() != ""){ ?>
			<div class="mkdf-blog-single-prev">
				<?php
				if($navigation_blog_through_category == 'yes'){
					previous_post_link('%link','<span class="mkdf-blog-single-nav-mark arrow_carrot-2left"></span><span class="mkdf-blog-single-nav-text">Previous article</span>', true,'','category');
					if(get_previous_post(true) != ""){
						$prev_post = get_previous_post(true);
						$prev_post_title = '';
						if($prev_post->post_title != '') {
							$prev_post_title = $prev_post->post_title;
							$excerpt = rtrim(substr($prev_post_title, 0, 20));
						}
						
						echo '<h5>'.esc_html($excerpt).'</h5>';
					}
				} else {
					previous_post_link('%link','<span class="mkdf-blog-single-nav-mark arrow_carrot-2left"></span><span class="mkdf-blog-single-nav-text">Previous article</span>');
					if(get_previous_post() != ""){
						$prev_post = get_previous_post();
						$prev_post_title = '';
						if($prev_post->post_title != '') {
							$prev_post_title = $prev_post->post_title;
							$excerpt = rtrim(substr($prev_post_title, 0, 20));
						}
						
						echo '<h5>'.esc_html($excerpt).'</h5>';
					}
				}
				?>
			</div>
		<?php } ?>
		<?php if(get_next_post() != ""){ ?>
			<div class="mkdf-blog-single-next">
				<?php
				if($navigation_blog_through_category == 'yes'){
					if(get_next_post(true) != ""){
						$next_post = get_next_post(true);
						$next_post_title = '';
						if($next_post->post_title != '') {
							$next_post_title = $next_post->post_title;
							$excerpt = rtrim(substr($next_post_title, 0, 20));
						}
						
						echo '<h5>'.esc_html($excerpt).'</h5>';
					}
					next_post_link('%link','<span class="mkdf-blog-single-nav-text">Next article</span><span class="mkdf-blog-single-nav-mark arrow_carrot-2left"></span>', true,'','category');
				} else {
					if(get_next_post() != ""){
						$next_post = get_next_post();
						$next_post_title = '';
						if($next_post->post_title != '') {
							$next_post_title = $next_post->post_title;
							$excerpt = rtrim(substr($next_post_title, 0, 20));
						}
						
						echo '<h5>'.esc_html($excerpt).'</h5>';
					}
					next_post_link('%link','<span class="mkdf-blog-single-nav-text">Next article</span><span class="mkdf-blog-single-nav-mark arrow_carrot-2right"></span>');
				}
				?>
			</div>
		<?php } ?>
	</div>
<?php } ?>