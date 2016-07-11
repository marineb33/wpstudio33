<?php if(chillnews_mikado_options()->getOptionValue('blog_single_tags') == 'yes' || chillnews_mikado_options()->getOptionValue('blog_single_share') == 'yes'){ ?>
<div class="mkdf-single-tags-share-holder">
<?php } ?>
<?php if(chillnews_mikado_options()->getOptionValue('blog_single_tags') == 'yes' && has_tag()){ ?>
	<div class="mkdf-single-tags-holder">
		<h6 class="mkdf-single-tags-title"><?php esc_html_e('POST TAGS:', 'chillnews'); ?></h6>
		<div class="mkdf-tags">
			<?php the_tags('', '', ''); ?>
		</div>
	</div>
<?php } ?>
<?php if(chillnews_mikado_options()->getOptionValue('blog_single_share') == 'yes'){ ?>
	<?php chillnews_mikado_get_module_template_part('templates/single/parts/share', 'blog'); ?>
<?php } ?>
<?php if(chillnews_mikado_options()->getOptionValue('blog_single_tags') == 'yes' || chillnews_mikado_options()->getOptionValue('blog_single_share') == 'yes'){ ?>
</div>
<?php } ?>