<?php

$display_category = 'yes';
if(chillnews_mikado_options()->getOptionValue('blog_single_category') !== ''){
	$display_category = chillnews_mikado_options()->getOptionValue('blog_single_category');
}

$display_date = 'yes';
if(chillnews_mikado_options()->getOptionValue('blog_single_date') !== ''){
	$display_date = chillnews_mikado_options()->getOptionValue('blog_single_date');
}

$display_author = 'yes';
if(chillnews_mikado_options()->getOptionValue('blog_single_author') !== ''){
	$display_author = chillnews_mikado_options()->getOptionValue('blog_single_author');
}

$display_comments = 'yes';
if(chillnews_mikado_options()->getOptionValue('blog_single_comment') !== ''){
	$display_comments = chillnews_mikado_options()->getOptionValue('blog_single_comment');
}

$display_like = 'yes';
if(chillnews_mikado_options()->getOptionValue('blog_single_like') !== ''){
	$display_like = chillnews_mikado_options()->getOptionValue('blog_single_like');
}

$display_count = 'yes';
if(chillnews_mikado_options()->getOptionValue('blog_single_count') !== ''){
	$display_count = chillnews_mikado_options()->getOptionValue('blog_single_count');
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content">
		<div class="mkdf-post-title-area">
			<?php chillnews_mikado_post_info_category(array('category' => $display_category)) ?>

			<?php chillnews_mikado_get_module_template_part('templates/single/parts/title', 'blog'); ?>
		</div>
		<?php chillnews_mikado_get_module_template_part('templates/single/parts/gallery', 'blog'); ?>
		<div class="mkdf-post-info">
			<?php chillnews_mikado_post_info(array(
				'date' => $display_date,
				'author' => $display_author, 
				'comments' => $display_comments, 
				'like' => $display_like, 
				'count' => $display_count
			)) ?>
		</div>		
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner clearfix">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<?php do_action('chillnews_mikado_before_blog_article_closed_tag'); ?>
</article>