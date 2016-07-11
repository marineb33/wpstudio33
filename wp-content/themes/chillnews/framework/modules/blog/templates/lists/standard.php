<div class="mkdf-blog-holder mkdf-blog-type-standard">
	<?php
		if($blog_query->have_posts()) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
			chillnews_mikado_get_post_format_html($blog_type);
		endwhile;
		else:
			chillnews_mikado_get_module_template_part('templates/parts/no-posts', 'blog');
		endif;
	?>
</div>
<?php
	if(chillnews_mikado_options()->getOptionValue('pagination') == 'yes') {
		chillnews_mikado_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
	}
?>