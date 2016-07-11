<?php

$display_category = 'yes';
if(chillnews_mikado_options()->getOptionValue('blog_list_category') !== ''){
	$display_category = chillnews_mikado_options()->getOptionValue('blog_list_category');
}

$display_date = 'yes';
if(chillnews_mikado_options()->getOptionValue('blog_list_date') !== ''){
	$display_date = chillnews_mikado_options()->getOptionValue('blog_list_date');
}

$display_author = 'yes';
if(chillnews_mikado_options()->getOptionValue('blog_list_author') !== ''){
	$display_author = chillnews_mikado_options()->getOptionValue('blog_list_author');
}

$display_comments = 'yes';
if(chillnews_mikado_options()->getOptionValue('blog_list_comment') !== ''){
	$display_comments = chillnews_mikado_options()->getOptionValue('blog_list_comment');
}

$display_like = 'yes';
if(chillnews_mikado_options()->getOptionValue('blog_list_like') !== ''){
	$display_like = chillnews_mikado_options()->getOptionValue('blog_list_like');
}

$display_share = 'yes';
if(chillnews_mikado_options()->getOptionValue('blog_list_share') !== ''){
	$display_share = chillnews_mikado_options()->getOptionValue('blog_list_share');
}

$display_feature_image = true;
if(chillnews_mikado_options()->getOptionValue('blog_list_feature_image') === 'no'){
	$display_feature_image = false;
}

$display_pattern_separator = true;
if(chillnews_mikado_options()->getOptionValue('blog_list_pattern_separator') === 'no'){
	$display_pattern_separator = false;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content">
		<div class="mkdf-post-image-holder">
			<?php chillnews_mikado_get_module_template_part('templates/parts/video', 'blog'); ?>
		</div>
			
		<div class="mkdf-post-info">
			<?php chillnews_mikado_post_info(array(
				'date' => $display_date,
				'category' => $display_category,
				'author' => $display_author, 
				'comments' => $display_comments, 
				'like' => $display_like,
				'share' => $display_share
			)) ?>
		</div>

		<?php chillnews_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>

		<?php chillnews_mikado_excerpt($excerpt_length); ?>

		<div class="mkdf-post-read-more-holder">
			<?php chillnews_mikado_read_more_button(); ?>
		</div>

		<?php if($display_pattern_separator) { ?>
			<div class="mkdf-separator-holder clearfix"><div class="mkdf-separator"></div></div>
		<?php } ?>
	</div>
	<?php do_action('chillnews_mikado_before_blog_list_article_closed_tag'); ?>
</article>