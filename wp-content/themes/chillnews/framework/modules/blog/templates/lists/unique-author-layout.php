<?php

/***** Get current author page ID and meta boxes options from author admin panel *****/
$author_id = chillnews_mikado_get_current_object_id();

$blog_page_range = chillnews_mikado_get_blog_page_range();
$max_number_of_pages = chillnews_mikado_get_max_number_of_pages();

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

/***** Set params for posts on author page *****/

$params = '';
$params .= ' author_id="'.$author_id.'"';

$number_of_posts = 6;
$params .= ' number_of_posts="'.$number_of_posts.'"';	

$column_number = 2;
$params .= ' column_number="'.$column_number.'"';

$display_excerpt = 'no';
$params .= ' display_excerpt="'.$display_excerpt.'"';

?>

<div class="mkdf-unique-author-layout clearfix">
	<div class="mkdf-author-description">
		<div class="mkdf-author-description-inner">
			<div class="mkdf-author-description-image">
				<?php echo chillnews_mikado_kses_img(get_avatar(get_the_author_meta( 'ID' ), 86)); ?>
			</div>
			<div class="mkdf-author-description-text-holder">
				<h5 class="mkdf-author-name vcard author">
					<?php
						if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
							echo esc_attr(get_the_author_meta('first_name')) . " " . esc_attr(get_the_author_meta('last_name'));
						} else {
							echo esc_attr(get_the_author_meta('display_name'));
						}
					?>
					<span><?php esc_html_e('/ Author', 'chillnews' ); ?></span>
				</h5>
				<?php if(is_email(get_the_author_meta('email'))){ ?>
					<p class="mkdf-author-email"><?php echo sanitize_email(get_the_author_meta('email')); ?></p>
				<?php } ?>
				<?php if(get_the_author_meta('description') != "") { ?>
					<div class="mkdf-author-text">
						<p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

    <?php
    	echo do_shortcode("[mkdf_post_layout_one $params]");
	?>
	<?php
		if(chillnews_mikado_options()->getOptionValue('pagination') == 'yes') {
			chillnews_mikado_pagination($max_number_of_pages, $blog_page_range, $paged);
		}
	?>
</div>