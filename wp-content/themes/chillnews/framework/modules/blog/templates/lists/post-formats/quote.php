<?php
$featured_image = '';
if ( has_post_thumbnail() ) {
	$thumb_id = get_post_thumbnail_id();
	$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
	$featured_image = "background-image: url('".$thumb_url[0]."');";
} 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content" <?php chillnews_mikado_inline_style($featured_image); ?>>
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner clearfix">
				<div class="mkdf-post-mark">
					<i class="ion-quote"></i>
				</div>
				<div class="mkdf-post-title">
					<h2 class="mkdf-quote-text"><?php echo esc_html(get_post_meta(get_the_ID(), "mkdf_post_quote_text_meta", true)); ?></h2>
					<span class="mkdf-quote-author"><?php the_title(); ?></span>
				</div>
			</div>
		</div>
		<a itemprop="url" class="mkdf-post-quote-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
	<?php do_action('chillnews_mikado_before_blog_list_article_closed_tag'); ?>
</article>