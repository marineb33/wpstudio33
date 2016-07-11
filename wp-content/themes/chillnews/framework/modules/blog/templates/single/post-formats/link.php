<?php
$featured_image = '';
if ( has_post_thumbnail() ) {
	$thumb_id = get_post_thumbnail_id();
	$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
	$featured_image = "background-image: url('".$thumb_url[0]."');";
} 

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
	<div class="mkdf-post-content" <?php chillnews_mikado_inline_style($featured_image); ?>>
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner clearfix">
				<div class="mkdf-post-mark">
					<i class="ion-link"></i>
				</div>
				<div class="mkdf-post-title">
					<h2 class="mkdf-link-text"><span><?php the_title(); ?></span></h2>
				</div>
			</div>
		</div>
		<a itemprop="url" class="mkdf-post-link-link" href="<?php echo esc_html(get_post_meta(get_the_ID(), "mkdf_post_link_link_meta", true)); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
	<div class="mkdf-post-info">
		<?php chillnews_mikado_post_info(array(
			'date' => $display_date,
			'category' => $display_category,
			'author' => $display_author, 
			'comments' => $display_comments, 
			'like' => $display_like, 
			'count' => $display_count
		)) ?>
	</div>	
	<?php the_content(); ?>
	<?php do_action('chillnews_mikado_before_blog_article_closed_tag'); ?>
</article>