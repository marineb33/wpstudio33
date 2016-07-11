<?php
$blog_archive_pages_classes = chillnews_mikado_blog_archive_pages_classes(chillnews_mikado_get_author_blog_list());
?>
<?php get_header(); ?>
<?php chillnews_mikado_get_title(); ?>
<div class="<?php echo esc_attr($blog_archive_pages_classes['holder']); ?>">
<?php do_action('chillnews_mikado_after_container_open'); ?>
	<div class="<?php echo esc_attr($blog_archive_pages_classes['inner']); ?>">
		<?php chillnews_mikado_get_blog(chillnews_mikado_get_author_blog_list()); ?>
	</div>
<?php do_action('chillnews_mikado_before_container_close'); ?>
</div>
<?php get_footer(); ?>