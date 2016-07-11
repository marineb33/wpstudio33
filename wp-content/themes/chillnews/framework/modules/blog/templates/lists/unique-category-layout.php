<?php

/***** Get current category page ID and meta boxes options from category admin panel *****/

$current_cat_id = chillnews_mikado_get_current_object_id();
$cat_array = get_option( "post_tax_term_$current_cat_id");

$blog_page_range = chillnews_mikado_get_blog_page_range();
$max_number_of_pages = chillnews_mikado_get_max_number_of_pages();

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

/***** Get unique category template layout *****/

$template = 'type1';
if(isset($cat_array['template']) && $cat_array['template'] != ''){
	$template = $cat_array['template'];
}

/***** Get featured layout options *****/

$featured_excerpt_length = 24;
if(isset($cat_array['featured_excerpt_length']) && $cat_array['featured_excerpt_length'] != ''){
	$featured_excerpt_length = $cat_array['featured_excerpt_length'];
}

$featured_thumb_image_width = '';
if(isset($cat_array['featured_thumb_image_width']) && $cat_array['featured_thumb_image_width'] != ''){
	$featured_thumb_image_width = $cat_array['featured_thumb_image_width'];
}

$featured_thumb_image_height = '';
if(isset($cat_array['featured_thumb_image_height']) && $cat_array['featured_thumb_image_height'] != ''){
	$featured_thumb_image_height = $cat_array['featured_thumb_image_height'];
}

/***** Get featured layout options for small image *****/

$featured_small_thumb_image_width = '';
if(isset($cat_array['featured_small_thumb_image_width']) && $cat_array['featured_small_thumb_image_width'] != ''){
	$featured_small_thumb_image_width = $cat_array['featured_small_thumb_image_width'];
}

$featured_small_thumb_image_height = '';
if(isset($cat_array['featured_small_thumb_image_height']) && $cat_array['featured_small_thumb_image_height'] != ''){
	$featured_small_thumb_image_height = $cat_array['featured_small_thumb_image_height'];
}

/***** Get non-featured layout options *****/

$excerpt_length = 24;
if(isset($cat_array['excerpt_length']) && $cat_array['excerpt_length'] != ''){
	$excerpt_length = $cat_array['excerpt_length'];
}

$thumb_image_width = '';
if(isset($cat_array['thumb_image_width']) && $cat_array['thumb_image_width'] != ''){
	$thumb_image_width = $cat_array['thumb_image_width'];
}

$thumb_image_height = '';
if(isset($cat_array['thumb_image_height']) && $cat_array['thumb_image_height'] != ''){
	$thumb_image_height = $cat_array['thumb_image_height'];
}

/***** Get number of posts from current category *****/

$query_params = array();
$query_params['cat'] = $current_cat_id;
$query_params['post_status'] = 'publish';
$category_query = new WP_Query($query_params);
$postInCategory = $category_query->found_posts;
wp_reset_postdata();

/***** Get number of posts per page for current category *****/

$postsPerPage = intval(get_option('posts_per_page'));

/***** Set params for feature posts on category page *****/

$featured_params = '';
$featured_params .= ' category_id="'.$current_cat_id.'"';

if($template == "type1" || $template == "type5"){
	if($featured_thumb_image_width != '' && $featured_thumb_image_height != '') {
		$featured_params .= ' featured_thumb_image_size="custom_size"';
		$featured_params .= ' featured_thumb_image_width="'.$featured_thumb_image_width.'"';
		$featured_params .= ' featured_thumb_image_height="'.$featured_thumb_image_height.'"';
	}

	if($featured_small_thumb_image_width != '' && $featured_small_thumb_image_height != '') {
		$featured_params .= ' thumb_image_size="custom_size"';
		$featured_params .= ' thumb_image_width="'.$featured_small_thumb_image_width.'"';
		$featured_params .= ' thumb_image_height="'.$featured_small_thumb_image_height.'"';
	}
} else {
	if($featured_thumb_image_width != '' && $featured_thumb_image_height != '') {
		$featured_params .= ' thumb_image_size="custom_size"';
		$featured_params .= ' thumb_image_width="'.$featured_thumb_image_width.'"';
		$featured_params .= ' thumb_image_height="'.$featured_thumb_image_height.'"';
	}
}

if($featured_excerpt_length != '' && !($template == "type1" || $template == "type5")){
	$featured_params .= ' excerpt_length="'.$featured_excerpt_length.'"';
}

if($featured_excerpt_length != '' && ($template == "type1" || $template == "type5")){
	$featured_params .= ' featured_excerpt_length="'.$featured_excerpt_length.'"';
}

if($template == "type1"){

	$featured_number_of_posts = 6;
	$featured_params .= ' number_of_posts="'.$featured_number_of_posts.'"';

	$block_proportion = 'two_half';
	$featured_params .= ' block_proportion="'.$block_proportion.'"';

	$featured_skin = 'mkdf-pt-light';
	$featured_params .= ' skin="'.$featured_skin.'"';

	$display_author = 'no';
	$featured_params .= ' featured_display_author="'.$display_author.'"';
	$featured_params .= ' display_author="'.$display_author.'"';

	$featured_extra_class_name = 'unique-category-template-one-featured';
	$featured_params .= ' extra_class_name="'.$featured_extra_class_name.'"';

	$featured_thumb_image_shape_type = 'mkdf-image-circle';
	$featured_params .= ' thumb_image_shape_type="'.$featured_thumb_image_shape_type.'"';

} else if ($template == "type2") {

	$featured_number_of_posts = 3;
	$featured_params .= ' number_of_posts="'.$featured_number_of_posts.'"';

	$featured_column_number = 3;
	$featured_params .= ' column_number="'.$featured_column_number.'"';

	$featured_display_button = 'yes';
	$featured_params .= ' display_button="'.$featured_display_button.'"';

	$featured_extra_class_name = 'unique-category-template-two-featured';
	$featured_params .= ' extra_class_name="'.$featured_extra_class_name.'"';

} else if ($template == "type3") {

	$featured_number_of_posts = 1;
	$featured_params .= ' number_of_posts="'.$featured_number_of_posts.'"';

	$featured_display_button = 'yes';
	$featured_params .= ' display_button="'.$featured_display_button.'"';

	$featured_extra_class_name = 'unique-category-template-three-featured';
	$featured_params .= ' extra_class_name="'.$featured_extra_class_name.'"';

} else if ($template == "type4") {

	$featured_number_of_posts = 1;
	$featured_params .= ' number_of_posts="'.$featured_number_of_posts.'"';

	$featured_display_button = 'yes';
	$featured_params .= ' display_button="'.$featured_display_button.'"';

	$featured_extra_class_name = 'unique-category-template-four-featured';
	$featured_params .= ' extra_class_name="'.$featured_extra_class_name.'"';

} else if ($template == "type5") {

	$featured_number_of_posts = 7;
	$featured_params .= ' number_of_posts="'.$featured_number_of_posts.'"';

	$block_proportion = 'two_third_one_third';
	$featured_params .= ' block_proportion="'.$block_proportion.'"';

	$featured_skin = 'mkdf-pt-dark';
	$featured_params .= ' skin="'.$featured_skin.'"';

	$featured_display_button = 'yes';
	$featured_params .= ' featured_display_button="'.$featured_display_button.'"';

	$featured_extra_class_name = 'unique-category-template-five-featured';
	$featured_params .= ' extra_class_name="'.$featured_extra_class_name.'"';

	$featured_thumb_image_shape_type = 'mkdf-image-circle';
	$featured_params .= ' thumb_image_shape_type="'.$featured_thumb_image_shape_type.'"';

} else if ($template == "type6") {
	$featured_number_of_posts = 4;
	$featured_params .= ' number_of_posts="'.$featured_number_of_posts.'"';

	$featured_column_number = 2;
	$featured_params .= ' column_number="'.$featured_column_number.'"';

	$featured_display_excerpt = 'no';
	$featured_params .= ' display_excerpt="'.$featured_display_excerpt.'"';

	$featured_extra_class_name = 'unique-category-template-six-featured';
	$featured_params .= ' extra_class_name="'.$featured_extra_class_name.'"';
}

/***** Set params for non-feature posts on category page *****/

$params = '';
$params .= ' category_id="'.$current_cat_id.'"';
$params .= ' offset="'.$featured_number_of_posts.'"';

if($thumb_image_width != '' && $thumb_image_height != '') {
	$params .= ' thumb_image_size="custom_size"';
	$params .= ' thumb_image_width="'.$thumb_image_width.'"';
	$params .= ' thumb_image_height="'.$thumb_image_height.'"';
}

if($excerpt_length != ''){
	$params .= ' excerpt_length="'.$excerpt_length.'"';
}

if ($template == "type1") {

	if($postInCategory > $postsPerPage){
		$number_of_posts = $postsPerPage - intval($featured_number_of_posts);
		$params .= ' number_of_posts="'.$number_of_posts.'"';	
	} else {
		$number_of_posts = $postInCategory - intval($featured_number_of_posts);
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	}

	$column_number = 2;
	$params .= ' column_number="'.$column_number.'"';

	$display_excerpt = 'no';
	$params .= ' display_excerpt="'.$display_excerpt.'"';

	$display_pagination = 'yes';
	$params .= ' display_pagination="'.$display_pagination.'"';

	$pagination_type = 'np-horizontal';
	$params .= ' pagination_type="'.$pagination_type.'"';

	$extra_class_name = 'unique-category-template-one';
	$params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template == "type2") {

	if($postInCategory > 9){
		$number_of_posts = 6;
		$params .= ' number_of_posts="'.$number_of_posts.'"';	
	} else {
		$number_of_posts = $postInCategory - intval($featured_number_of_posts);
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	}

	$column_number = 3;
	$params .= ' column_number="'.$column_number.'"';

	$display_pagination = 'yes';
	$params .= ' display_pagination="'.$display_pagination.'"';

	$pagination_type = 'np-horizontal';
	$params .= ' pagination_type="'.$pagination_type.'"';

	$extra_class_name = 'unique-category-template-two';
	$params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template == "type3") {

	if($postInCategory > 4){
		$number_of_posts = 3;
		$params .= ' number_of_posts="'.$number_of_posts.'"';	
	} else {
		$number_of_posts = $postInCategory - intval($featured_number_of_posts);
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	}

	$column_number = 3;
	$params .= ' column_number="'.$column_number.'"';

	$display_button = 'yes';
	$params .= ' display_button="'.$display_button.'"';

	$display_pagination = 'yes';
	$params .= ' display_pagination="'.$display_pagination.'"';

	$pagination_type = 'np-horizontal';
	$params .= ' pagination_type="'.$pagination_type.'"';

	$extra_class_name = 'unique-category-template-three';
	$params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template == "type4") {

	if($postInCategory > $postsPerPage){
		$number_of_posts = $postsPerPage - intval($featured_number_of_posts);
		$params .= ' number_of_posts="'.$number_of_posts.'"';	
	} else {
		$number_of_posts = $postInCategory - intval($featured_number_of_posts);
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	}

	$column_number = 3;
	$params .= ' column_number="'.$column_number.'"';

	$display_pagination = 'yes';
	$params .= ' display_pagination="'.$display_pagination.'"';

	$pagination_type = 'np-horizontal';
	$params .= ' pagination_type="'.$pagination_type.'"';

	$extra_class_name = 'unique-category-template-four';
	$params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template == "type5") {

	if($postInCategory > 10){
		$number_of_posts = 3;
		$params .= ' number_of_posts="'.$number_of_posts.'"';	
	} else {
		$number_of_posts = $postInCategory - intval($featured_number_of_posts);
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	}

	$column_number = 3;
	$params .= ' column_number="'.$column_number.'"';

	$display_pagination = 'yes';
	$params .= ' display_pagination="'.$display_pagination.'"';

	$pagination_type = 'np-horizontal';
	$params .= ' pagination_type="'.$pagination_type.'"';

	$extra_class_name = 'unique-category-template-five';
	$params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template == "type6") {

	if($postInCategory > $postsPerPage){
		$number_of_posts = $postsPerPage - intval($featured_number_of_posts);
		$params .= ' number_of_posts="'.$number_of_posts.'"';	
	} else {
		$number_of_posts = $postInCategory - intval($featured_number_of_posts);
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	}

	$display_excerpt = 'yes';
	$params .= ' display_excerpt="'.$display_excerpt.'"';

	$display_pagination = 'yes';
	$params .= ' display_pagination="'.$display_pagination.'"';

	$pagination_type = 'np-horizontal';
	$params .= ' pagination_type="'.$pagination_type.'"';

	$extra_class_name = 'unique-category-template-six';
	$params .= ' extra_class_name="'.$extra_class_name.'"';
}
?>

<div class="mkdf-unique-category-layout clearfix">
	<?php
		switch ($template) {								 
			case 'type1':						
				echo do_shortcode("[mkdf_block_one $featured_params]"); // XSS OK
			break;
			case 'type2':						
				echo do_shortcode("[mkdf_post_layout_one $featured_params]"); // XSS OK
			break;
			case 'type3':						
				echo do_shortcode("[mkdf_post_layout_one $featured_params]"); // XSS OK
			break;
			case 'type4':						
				echo do_shortcode("[mkdf_post_layout_one $featured_params]"); // XSS OK
			break;
			case 'type5':						
				echo do_shortcode("[mkdf_block_one $featured_params]"); // XSS OK
			break;
			case 'type6':						
				echo do_shortcode("[mkdf_post_layout_one $featured_params]"); // XSS OK
			break;
		}
    ?>

    <?php if($template == 'type2' || $template == 'type4' || $template == 'type5') { ?>
    	<div class="mkdf-separator-holder clearfix"><div class="mkdf-separator mkdf-usl-one"></div></div>
    <?php } else if ($template == 'type6') { ?>
    	<div class="mkdf-separator-holder clearfix"><div class="mkdf-separator mkdf-usl-two"></div></div>
    <?php } else { ?>
    	<div class="mkdf-separator-holder clearfix"><div class="mkdf-separator"></div></div>
    <?php } ?>

    <?php
    	switch ($template) {								 
			case 'type1':
				if($postInCategory > intval($featured_number_of_posts)){
					echo do_shortcode("[mkdf_post_layout_one $params]"); // XSS OK
				}									
			break;
			case 'type2':
				if($postInCategory > intval($featured_number_of_posts)){
					echo do_shortcode("[mkdf_post_layout_three $params]"); // XSS OK
				}									
			break;
			case 'type3':
				if($postInCategory > intval($featured_number_of_posts)){
					echo do_shortcode("[mkdf_post_layout_one $params]"); // XSS OK
				}									
			break;
			case 'type4':
				if($postInCategory > intval($featured_number_of_posts)){
					echo do_shortcode("[mkdf_post_layout_three $params]"); // XSS OK
				}									
			break;
			case 'type5':
				if($postInCategory > intval($featured_number_of_posts)){
					echo do_shortcode("[mkdf_post_layout_three $params]"); // XSS OK
				}									
			break;
			case 'type6':
				if($postInCategory > intval($featured_number_of_posts)){
					echo do_shortcode("[mkdf_post_layout_two $params]"); // XSS OK
				}									
			break;
		}
	?>
</div>