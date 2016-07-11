<?php
if( !function_exists('chillnews_mikado_get_blog') ) {
	/**
	 * Function which return holder for all blog lists
	 *
	 * @return holder.php template
	 */
	function chillnews_mikado_get_blog($type) {

		$sidebar = chillnews_mikado_sidebar_layout();

		$params = array(
			"blog_type" => $type,
			"sidebar" => $sidebar
		);
		chillnews_mikado_get_module_template_part('templates/lists/holder', 'blog', '', $params);
	}
}

if( !function_exists('chillnews_mikado_get_blog_type') ) {

	/**
	 * Function which create query for blog lists
	 *
	 * @return blog list template
	 */

	function chillnews_mikado_get_blog_type($type) {
		global $wp_query;

		$id = chillnews_mikado_get_page_id();
		$category = get_post_meta($id, "mkdf_blog_category_meta", true);
		$post_number = esc_attr(get_post_meta($id, "mkdf_show_posts_per_page_meta", true));

		$paged = chillnews_mikado_paged();

		if(!is_archive()) {
            $blog_query = new WP_Query('post_type=post&paged=' . $paged . '&cat=' . $category . '&posts_per_page=' . $post_number . '&post_status=publish');
		}else{
			$blog_query = $wp_query;
		}

		if(chillnews_mikado_options()->getOptionValue('blog_page_range') != ""){
			$blog_page_range = esc_attr(chillnews_mikado_options()->getOptionValue('blog_page_range'));
		} else{
			$blog_page_range = $blog_query->max_num_pages;
		}
		$params = array(
			'blog_query' => $blog_query,
			'paged' => $paged,
			'blog_page_range' => $blog_page_range,
			'blog_type' => $type
		);

		chillnews_mikado_get_module_template_part('templates/lists/' .  $type, 'blog', '', $params);
	}
}

if( !function_exists('chillnews_mikado_get_post_format_html') ) {

	/**
	 * Function which return html for post formats
	 * @param $type
	 * @return post hormat template
	 */

	function chillnews_mikado_get_post_format_html($type = "") {

		$post_format = get_post_format();
		$supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');
		
		if(in_array($post_format, $supported_post_formats)) {
			$post_format = $post_format;
		} else {
			$post_format = 'standard';
		}

		$slug = '';
		if($type !== ""){
			$slug = $type;
		}

		$params = array();

		$chars_array = chillnews_mikado_blog_lists_number_of_chars();
		if(isset($chars_array[$type])) {
			$params['excerpt_length'] = $chars_array[$type];
		} else {
			$params['excerpt_length'] = '';
		}


		chillnews_mikado_get_module_template_part('templates/lists/post-formats/' . $post_format, 'blog', $slug, $params);
	}
}

if( !function_exists('chillnews_mikado_get_default_blog_list') ) {
	/**
	 * Function which return default blog list for archive post types
	 *
	 * @return post format template
	 */

	function chillnews_mikado_get_default_blog_list() {

		$blog_list = chillnews_mikado_options()->getOptionValue('blog_list_type');

		return $blog_list;
	}
}

if( !function_exists('chillnews_mikado_get_category_blog_list') ) {
	/**
	 * Function which return blog list for category post types
	 *
	 * @return post format template
	 */

	function chillnews_mikado_get_category_blog_list() {

		$blog_list = chillnews_mikado_options()->getOptionValue('blog_list_type');
		
		if(chillnews_mikado_options()->getOptionValue('unigue_category_layout') === 'yes'){
			$blog_list = 'unique-category-layout';
		}

		return $blog_list;
	}
}

if( !function_exists('chillnews_mikado_get_author_blog_list') ) {
	/**
	 * Function which return blog list for author post types
	 *
	 * @return post format template
	 */

	function chillnews_mikado_get_author_blog_list() {

		$blog_list = chillnews_mikado_options()->getOptionValue('blog_list_type');
		
		if(chillnews_mikado_options()->getOptionValue('unigue_author_layout') === 'yes'){
			$blog_list = 'unique-author-layout';
		}

		return $blog_list;
	}
}

if (!function_exists('chillnews_mikado_pagination')) {

	/**
	 * Function which return pagination
	 *
	 * @return blog list pagination html
	 */

	function chillnews_mikado_pagination($pages = '', $range = 4, $paged = 1){

		$showitems = $range+1;

		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages){
				$pages = 1;
			}
		}
		if(1 != $pages){

			echo '<span class="mkdf-pagination-new-holder">'. get_the_posts_pagination().'</span>';

			echo '<div class="mkdf-pagination">';
				echo '<ul>';
					if($paged > 2 && $paged > $range+1 && $showitems < $pages){
						echo '<li class="mkdf-pagination-first-page"><a href="'.esc_url(get_pagenum_link(1)).'"><span class="mkdf-pagination-icon arrow_carrot-2left"></span></a></li>';
					}
					if ($paged > 1) {
						echo "<li class='mkdf-pagination-prev'><a href='".esc_url(get_pagenum_link($paged - 1))."'><span class='mkdf-pagination-icon arrow_carrot-left'></span></a></li>";
					}
					for ($i=1; $i <= $pages; $i++){
						if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
							echo ($paged == $i)? "<li class='active'><span>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
						}
					}
					if ($paged !== intval($pages)){
						echo '<li class="mkdf-pagination-next"><a href="';
						if($pages > $paged){
							echo esc_url(get_pagenum_link($paged + 1));
						} else {
							echo esc_url(get_pagenum_link($paged));
						}
						echo '"><span class="mkdf-pagination-icon arrow_carrot-right"></span></a></li>';
					}

					if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
						echo '<li class="mkdf-pagination-last-page"><a href="'.esc_url(get_pagenum_link($pages)).'"><span class="mkdf-pagination-icon arrow_carrot-2right"></span></a></li>';
					}
				echo '</ul>';
			echo "</div>";
		}
	}
}

if(!function_exists('chillnews_mikado_post_info')){
	/**
	 * Function that loads parts of blog post info section
	 * Possible options are:
	 * 1. date
	 * 2. category
	 * 3. author
	 * 4. comments
	 * 5. like
	 * 6. share
	 *
	 * @param $config array of sections to load
	 */
	function chillnews_mikado_post_info($config){
		$default_config = array(
			'date' => '',
			'category' => '',
			'author' => '',
			'comments' => '',
			'like' => '',
			'count' => '',
			'share' => '',
			'rating' => ''
		);

		extract(shortcode_atts($default_config, $config));

		if($date == 'yes'){
			chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-date', 'blog');
		}
		if($category == 'yes'){
			chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-category', 'blog');
		}
		if($author == 'yes'){
			chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-author', 'blog');
		}
		if($comments == 'yes'){
			chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-comments', 'blog');
		}
		if($like == 'yes'){
			chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-like', 'blog');
		}
		if($count == 'yes'){
			chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-count', 'blog');
		}
		if($share == 'yes'){
			chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-share', 'blog');
		}
		if($rating == 'yes'){
			chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-rating', 'blog');
		}
	}
}

if(!function_exists('chillnews_mikado_post_info_date')){
	/**
	 * Function that loads parts of blog post date info section
	 *
	 * @param $config array of sections to load
	 */
	function chillnews_mikado_post_info_date($config){
		$default_config = array(
			'date' => '',
            'date_format' => ''
		);

		$params = (shortcode_atts($default_config, $config));

		if($params['date'] == 'yes'){
			chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-date', 'blog', '', $params);
		}
	}
}

if(!function_exists('chillnews_mikado_post_info_category')){
	/**
	 * Function that loads parts of blog post category info section
	 *
	 * @param $config array of sections to load
	 */
	function chillnews_mikado_post_info_category($config){
		$default_config = array(
			'category' => ''
		);

        $params = (shortcode_atts($default_config, $config));

		if($params['category'] == 'yes'){
			chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-category', 'blog', '', $params);
		}
	}
}

if(!function_exists('chillnews_mikado_post_info_author')){
	/**
	 * Function that loads parts of blog post author info section
	 *
	 * @param $config array of sections to load
	 */
	function chillnews_mikado_post_info_author($config){
		$default_config = array(
			'author' => ''
		);

        $params = (shortcode_atts($default_config, $config));

		if($params['author'] == 'yes'){
			chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-author', 'blog', '', $params);
		}
	}
}

if(!function_exists('chillnews_mikado_post_info_comments')){
	/**
	 * Function that loads parts of blog post comments info section
	 *
	 * @param $config array of sections to load
	 */
	function chillnews_mikado_post_info_comments($config){
		$default_config = array(
			'comments' => ''
		);

        $params = (shortcode_atts($default_config, $config));

        if($params['comments'] == 'yes'){
            chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-comments', 'blog', '', $params);
		}
	}
}

if(!function_exists('chillnews_mikado_post_info_like')){
    /**
     * Function that loads parts of blog post author info section
     *
     * @param $config array of sections to load
     */
    function chillnews_mikado_post_info_like($config){
        $default_config = array(
            'like' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        if($params['like'] == 'yes'){
            chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-like', 'blog', '', $params);
        }
    }
}

if(!function_exists('chillnews_mikado_post_info_share')){
    /**
     * Function that loads parts of blog post share info section
     *
     * @param $config array of sections to load
     */
    function chillnews_mikado_post_info_share($config){
        $default_config = array(
            'share' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        if($params['share'] == 'yes'){
            chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-share', 'blog', '', $params);
        }
    }
}

if(!function_exists('chillnews_mikado_post_info_rating')){
    /**
     * Function that loads parts of blog post rating info section
     *
     * @param $config array of sections to load
     */
    function chillnews_mikado_post_info_rating($config){
        $default_config = array(
            'rating' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        if($params['rating'] == 'yes'){
            chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-rating', 'blog', '', $params);
        }
    }
}

if(!function_exists('chillnews_mikado_post_info_type')){
    /**
     * Function that loads parts of blog post type icon section
     *
     * @param $config array of sections to load
     */
    function chillnews_mikado_post_info_type($config){
        $default_config = array(
            'icon' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        $params['post_type'] = get_post_format() ? 'mkdf-post-'.get_post_format(): 'mkdf-post-standard';

        if($params['icon'] == 'yes'){
            chillnews_mikado_get_module_template_part('templates/parts/post-info/post-info-icon-type', 'blog', '', $params);
        }
    }
}

if(!function_exists('chillnews_mikado_excerpt')) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in mkd_set_blog_word_count function.
	 *
	 * It current post has read more tag set it will return content of the post, else it will return post excerpt
	 *
	 */
	function chillnews_mikado_excerpt($excerpt_length) {
		global $post;

		if(post_password_required()) {
			echo get_the_password_form();
		}

		//does current post has read more tag set?
		elseif(chillnews_mikado_post_has_read_more()) {
			global $more;

			//override global $more variable so this can be used in blog templates
			$more = 0;
			the_content(true);
		}

		//is word count set to something different that 0?
		elseif($excerpt_length != '0') {
			//if word count is set and different than empty take that value, else that general option from theme options
			$word_count = '45';
			if(isset($excerpt_length) && $excerpt_length != "") {
				$word_count = $excerpt_length;
			} elseif (chillnews_mikado_options()->getOptionValue('number_of_chars') != '') {
				$word_count = esc_attr(chillnews_mikado_options()->getOptionValue('number_of_chars'));
			}

			//if post excerpt field is filled take that as post excerpt, else that content of the post
			$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);

			//remove leading dots if those exists
			$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

			//if clean excerpt has text left
			if($clean_excerpt !== '') {
				//explode current excerpt to words
				$excerpt_word_array = explode (' ', $clean_excerpt);

				//cut down that array based on the number of the words option
				$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);

				//and finally implode words together
				$excerpt = implode (' ', $excerpt_word_array);

				//is excerpt different than empty string?
				if($excerpt !== '') {
					echo '<p class="mkdf-post-excerpt">'.wp_kses_post($excerpt).'</p>';
				}
			}
		}
	}
}

if(!function_exists('chillnews_mikado_get_blog_single')) {

	/**
	 * Function which return holder for single posts
	 *
	 * @return single holder.php template
	 */

	function chillnews_mikado_get_blog_single() {
		$sidebar = chillnews_mikado_sidebar_layout();

		$params = array(
			"sidebar" => $sidebar
		);

		chillnews_mikado_get_module_template_part('templates/single/holder', 'blog', '', $params);
	}
}

if( !function_exists('chillnews_mikado_get_single_html') ) {

	/**
	 * Function return all parts on single.php page
	 *
	 *
	 * @return single.php html
	 */
	function chillnews_mikado_get_single_html() {

		$post_format = get_post_format();
		if($post_format === false){
			$post_format = 'standard';
		}

		$post_id = chillnews_mikado_get_page_id();

		//Related posts
		$related_posts_params = array();
		$show_related = (chillnews_mikado_options()->getOptionValue('blog_single_related_posts') == 'yes') ? true : false;
		if ($show_related) {
			$hasSidebar = chillnews_mikado_sidebar_layout();
			$related_post_number = ($hasSidebar == '' || $hasSidebar == 'default' || $hasSidebar == 'no-sidebar') ? 4 : 3;
			$related_posts_options = array('posts_per_page' => $related_post_number);
			$related_posts_image_size = (chillnews_mikado_options()->getOptionValue('blog_single_related_image_size') !== '') ? intval(chillnews_mikado_options()->getOptionValue('blog_single_related_image_size')) : '';
			$related_posts_params = array('related_posts' => chillnews_mikado_get_related_post_type($post_id, $related_posts_options), 'related_posts_image_size' => $related_posts_image_size);
		}

		chillnews_mikado_get_module_template_part('templates/single/post-formats/' . $post_format, 'blog');
		chillnews_mikado_get_module_template_part('templates/single/parts/single-navigation', 'blog');
		chillnews_mikado_get_module_template_part('templates/single/parts/author-info', 'blog');
		$show_ratings = (chillnews_mikado_options()->getOptionValue('blog_single_ratings') == 'yes') ? true : false;
        if($show_ratings){
            chillnews_mikado_get_module_template_part('templates/single/parts/ratings', 'blog', '');
        }
		if ($show_related) {
			chillnews_mikado_get_module_template_part('templates/single/parts/related-posts', 'blog', '', $related_posts_params);
		}
		if(chillnews_mikado_show_comments()){
			comments_template('', true);
		}
	}
}

if( !function_exists('chillnews_mikado_additional_post_items') ) {

	/**
	 * Function which return parts on single.php which are just below content
	 *
	 * @return single.php html
	 */
	function chillnews_mikado_additional_post_items() {

		chillnews_mikado_get_module_template_part('templates/single/parts/tags', 'blog');

		$args_pages = array(
			'before'           => '<div class="mkdf-single-links-pages"><div class="mkdf-single-links-pages-inner">',
			'after'            => '</div></div>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'pagelink'         => '%'
		);

		wp_link_pages($args_pages);

	}
	add_action('chillnews_mikado_before_blog_article_closed_tag', 'chillnews_mikado_additional_post_items');
}

if( !function_exists('chillnews_mikado_additional_post_list_items') ) {

    /**
     * Function which return parts on default blog list which are just below content
     *
     * @return tags html
     */
    function chillnews_mikado_additional_post_list_items() {

        chillnews_mikado_get_module_template_part('templates/lists/parts/tags', 'blog');

        $args_pages = array(
            'before'           => '<div class="mkdf-single-links-pages"><div class="mkdf-single-links-pages-inner">',
            'after'            => '</div></div>',
            'link_before'      => '<span>',
            'link_after'       => '</span>',
            'pagelink'         => '%'
        );

        wp_link_pages($args_pages);

    }
    add_action('chillnews_mikado_blog_list_tags', 'chillnews_mikado_additional_post_list_items');
}


if (!function_exists('chillnews_mikado_comment')) {

	/**
	 * Function which modify default wordpress comments
	 *
	 * @return comments html
	 */
	function chillnews_mikado_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		global $post;

		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment  = $post->post_author == $comment->user_id;

		$comment_class = 'mkdf-comment clearfix';

		if($is_author_comment) {
			$comment_class .= ' mkdf-post-author-comment';
		}

		if($is_pingback_comment) {
			$comment_class .= ' mkdf-pingback-comment';
		}
		?>
		<li>
		<div class="<?php echo esc_attr($comment_class); ?>">
			<div class="mkdf-comment-info">
				<h5 class="mkdf-comment-name">
					<?php if($is_pingback_comment) { esc_html_e('Pingback:', 'chillnews'); } ?><span class="mkdf-comment-author"><?php echo wp_kses_post(get_comment_author_link()); ?></span>
					<?php if($is_author_comment) { ?>
					<span class="mkdf-comment-mark"><?php esc_html_e('/', 'chillnews'); ?></span>
					<span class="mkdf-comment-author-label"><?php esc_html_e('Author', 'chillnews'); ?></span>
					<?php } ?>
					<span class="mkdf-comment-mark"><?php esc_html_e('/', 'chillnews'); ?></span>
					<span class="mkdf-comment-date"><?php comment_time(get_option('date_format')); ?></span>
				</h5>
			</div>
			<?php if(!$is_pingback_comment) { ?>
				<div class="mkdf-comment-image"> <?php echo chillnews_mikado_kses_img(get_avatar($comment, 35)); ?> </div>
			<?php } ?>
			<?php if(!$is_pingback_comment) { ?>
				<div class="mkdf-comment-text">
					<div class="mkdf-text-holder" id="comment-<?php echo comment_ID(); ?>">
						<?php comment_text(); ?>
					</div>
				</div>
			<?php } ?>
			<div class="mkdf-comment-links">
				<?php
					comment_reply_link( array_merge( $args, array('reply_text' => esc_html__('Leave reply', 'chillnews'), 'depth' => $depth, 'max_depth' => $args['max_depth']) ) );
					edit_comment_link(esc_html__('Edit comment','chillnews'));
				?>
			</div>	
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>
		<?php
	}
}

if( !function_exists('chillnews_mikado_blog_archive_pages_classes') ) {

	/**
	 * Function which create classes for container in archive pages
	 *
	 * @return array
	 */
	function chillnews_mikado_blog_archive_pages_classes($blog_type) {

		$classes = array();
		if(in_array($blog_type, chillnews_mikado_blog_full_width_types())){
			$classes['holder'] = 'mkdf-full-width';
			$classes['inner'] = 'mkdf-full-width-inner';
		} elseif(in_array($blog_type, chillnews_mikado_blog_grid_types())){
			$classes['holder'] = 'mkdf-container';
			$classes['inner'] = 'mkdf-container-inner clearfix';
		}

		return $classes;
	}
}

if( !function_exists('chillnews_mikado_blog_full_width_types') ) {

	/**
	 * Function which return all full width blog types
	 *
	 * @return array
	 */
	function chillnews_mikado_blog_full_width_types() {

		$types = array();

		return $types;
	}
}

if( !function_exists('chillnews_mikado_blog_grid_types') ) {

	/**
	 * Function which return in grid blog types
	 *
	 * @return array
	 */
	function chillnews_mikado_blog_grid_types() {

		$types = array('standard', 'standard-whole-post', 'unique-category-layout', 'unique-author-layout');

		return $types;
	}
}

if( !function_exists('chillnews_mikado_blog_types') ) {

	/**
	 * Function which return all blog types
	 *
	 * @return array
	 */
	function chillnews_mikado_blog_types() {

		$types = array_merge(chillnews_mikado_blog_grid_types(), chillnews_mikado_blog_full_width_types());

		return $types;
	}
}

if( !function_exists('chillnews_mikado_blog_templates') ) {

	/**
	 * Function which return all blog templates names
	 *
	 * @return array
	 */
	function chillnews_mikado_blog_templates() {

		$templates = array();
		$grid_templates = chillnews_mikado_blog_grid_types();
		$full_templates = chillnews_mikado_blog_full_width_types();
		foreach($grid_templates as $grid_template){
			array_push($templates, 'blog-'.$grid_template);
		}
		foreach($full_templates as $full_template){
			array_push($templates, 'blog-'.$full_template);
		}

		return $templates;
	}
}

if( !function_exists('chillnews_mikado_blog_lists_number_of_chars') ) {

	/**
	 * Function that return number of characters for different lists based on options
	 *
	 * @return int
	 */
	function chillnews_mikado_blog_lists_number_of_chars() {

		$number_of_chars = array();
		if(chillnews_mikado_options()->getOptionValue('standard_number_of_chars')) {
			$number_of_chars['standard'] = chillnews_mikado_options()->getOptionValue('standard_number_of_chars');
		}

		return $number_of_chars;
	}
}

if (!function_exists('chillnews_mikado_excerpt_length')) {
	
	/**
	 * Function that changes excerpt length based on theme options
	 * @param $length int original value
	 * @return int changed value
	 */
	function chillnews_mikado_excerpt_length( $length ) {

		if(chillnews_mikado_options()->getOptionValue('number_of_chars') !== ''){
			return esc_attr(chillnews_mikado_options()->getOptionValue('number_of_chars'));
		} else {
			return 45;
		}
	}

	add_filter( 'excerpt_length', 'chillnews_mikado_excerpt_length', 999 );
}

if(!function_exists('chillnews_mikado_post_has_read_more')) {
	
	/**
	 * Function that checks if current post has read more tag set
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function chillnews_mikado_post_has_read_more() {
		global $post;

		return strpos($post->post_content, '<!--more-->');
	}
}

if(!function_exists('chillnews_mikado_post_has_title')) {
	
	/**
	 * Function that checks if current post has title or not
	 * @return bool
	 */
	function chillnews_mikado_post_has_title() {
		return get_the_title() !== '';
	}
}

if (!function_exists('chillnews_mikado_modify_read_more_link')) {
	
	/**
	 * Function that modifies read more link output.
	 * Hooks to the_content_more_link
	 * @return string modified output
	 */
	function chillnews_mikado_modify_read_more_link() {
		$link = '<div class="mkdf-more-link-container">';
		$link .= chillnews_mikado_get_button_html(array(
			'link' => get_permalink().'#more-'.get_the_ID(),
			'text' => esc_html__('Continue reading', 'chillnews')
		));

		$link .= '</div>';

		return $link;
	}

	add_filter( 'the_content_more_link', 'chillnews_mikado_modify_read_more_link');
}

if(!function_exists('chillnews_mikado_load_blog_assets')) {
	
	/**
	 * Function that checks if blog assets should be loaded
	 *
	 * @see mkd_is_blog_template()
	 * @see is_home()
	 * @see is_single()
	 * @see mkd_has_blog_shortcode()
	 * @see is_archive()
	 * @see is_search()
	 * @see mkd_has_blog_widget()
	 * @return bool
	 */
	function chillnews_mikado_load_blog_assets() {
		return chillnews_mikado_is_blog_template() || is_home() || is_single() || is_archive() || is_search();
	}
}

if(!function_exists('chillnews_mikado_is_blog_template')) {
	
	/**
	 * Checks if current template page is blog template page.
	 *
	 *@param string current page. Optional parameter.
	 *
	 *@return bool
	 *
	 * @see chillnews_mikado_get_page_template_name()
	 */
	function chillnews_mikado_is_blog_template($current_page = '') {

		if($current_page == '') {
			$current_page = chillnews_mikado_get_page_template_name();
		}

		$blog_templates = chillnews_mikado_blog_templates();

		return in_array($current_page, $blog_templates);
	}
}

if(!function_exists('chillnews_mikado_read_more_button')) {
	
	/**
	 * Function that outputs read more button html if necessary.
	 * It checks if read more button should be outputted only if option for given template is enabled and post does'nt have read more tag
	 * and if post isn't password protected
	 *
	 * @param string $option name of option to check
	 * @param string $class additional class to add to button
	 * @param string $read_more_text additional option to rename read to more button
	 *
	 */
	function chillnews_mikado_read_more_button($option = '', $class = '', $read_more_text = '') {
		if($option != '') {
			$show_read_more_button = chillnews_mikado_options()->getOptionValue($option) == 'yes';
		}else {
			$show_read_more_button = 'yes';
		}
		if ($read_more_text !== '') {
			$readMoreText = $read_more_text;
		} else {
			$readMoreText = esc_html__('Read More', 'chillnews');
		}
		if($show_read_more_button && !chillnews_mikado_post_has_read_more() && !post_password_required()) {
			echo chillnews_mikado_get_button_html(array(
				'size'         => '',
				'type'         => 'solid',
				'link'         => get_the_permalink(),
				'text'         => $readMoreText,
				'icon_pack'    => 'font_elegant',
                'fe_icon'      => 'arrow_carrot-2right',
				'custom_class' => $class
			));
		}
	}
}

if(!function_exists('chillnews_mikado_update_post_count_views')) {

	function chillnews_mikado_update_post_count_views(){
		$postID = chillnews_mikado_get_page_id();
		if(is_singular('post')){	
			if(isset($_COOKIE['mkd-post-views_'. $postID])){
				return;
			} else {
				$count = get_post_meta($postID, 'count_post_views', true);
				if ($count === ''){
					update_post_meta($postID, 'count_post_views', 1);
					setcookie('mkd-post-views_'. $postID, $postID, time()*20, '/');
				} else {
					$count++;
					update_post_meta($postID, 'count_post_views', $count);
					setcookie('mkd-post-views_'. $postID, $postID, time()*20, '/');
				}	
			}		
		}
	}

	add_action('wp', 'chillnews_mikado_update_post_count_views');
}

if(!function_exists('chillnews_mikado_get_post_count_views')) {

	function chillnews_mikado_get_post_count_views($postID){
		$count = get_post_meta($postID, 'count_post_views', true);
		if($count === ''){
			update_post_meta($postID, 'count_post_views', '0');
			return 0;
		}
		return $count;
	}
}

if(!function_exists('chillnews_mikado_post_rating_ajax_function')) {
    function chillnews_mikado_post_rating_ajax_function() {

        $post_ID = '';
        $rating_value = '';
        if (!empty($_POST['postID'])) {
            $post_ID = $_POST['postID'];
        }
        if (!empty($_POST['value'])) {
            $rating_value = $_POST['value'];
        }

        $rateResponse = chillnews_mikado_set_post_rating($rating_value, $post_ID); //update total count of rates

        $newRateCount = chillnews_mikado_get_post_rating($post_ID); // get total count of votes

        $return_obj = array(
            'newCount' => $newRateCount,
            'rateAnswer' => $rateResponse
        );

        echo json_encode($return_obj);
        exit;

    }

    add_action('wp_ajax_chillnews_mikado_post_rating_ajax_function', 'chillnews_mikado_post_rating_ajax_function');
    add_action('wp_ajax_nopriv_chillnews_mikado_post_rating_ajax_function', 'chillnews_mikado_post_rating_ajax_function' );
}

if(!function_exists('chillnews_mikado_get_post_rating')) {

    function chillnews_mikado_get_post_rating($post_id = false){

        if($post_id == false) {
            $post_id = get_the_ID();
        }

        $rating_value = get_post_meta($post_id, 'mkdf_post_rating_value' , true);
        $rating_number_of_rates = get_post_meta($post_id, 'mkdf_post_rating_number' , true);
        if($rating_value == '' || $rating_number_of_rates == ''){
            update_post_meta($post_id, 'mkdf_post_rating_value' , '0');
            update_post_meta($post_id, 'mkdf_post_rating_number' , '0');
        }

        if($rating_number_of_rates > 0 && $rating_value > 0){
            return round($rating_value/$rating_number_of_rates, 2);
        }
        else{
            return 0;
        }
    }
}

if(!function_exists('chillnews_mikado_set_post_rating')) {
/*
 * return string message in html
 */
    function chillnews_mikado_set_post_rating($new_rating_value, $post_id = false){

        if($post_id == false){
            $post_id = get_the_ID();
        }

        if(isset($_COOKIE['mkdf_post_rating_'. $post_id])){
            return '<span>'. esc_html__('You already rated this post!', 'chillnews').'</span>';
        } else {

            $rating_number_of_rates = get_post_meta($post_id, 'mkdf_post_rating_number' , true);
            $rating_value = get_post_meta($post_id, 'mkdf_post_rating_value', true);

            if ($rating_number_of_rates == ''){
                update_post_meta($post_id, 'mkdf_post_rating_number' , 1);
            } else {
                $rating_number_of_rates++;
                update_post_meta($post_id, 'mkdf_post_rating_number', $rating_number_of_rates);
            }

            if ($rating_value == ''){
                update_post_meta($post_id, 'mkdf_post_rating_value' , $new_rating_value);
                setcookie('mkdf_post_rating_'. $post_id, $post_id, time()*20, '/');
                return '<span>'. esc_html__('Thank you! You have succesfully rated this post!', 'chillnews').'</span>';
            } else {
                $rating_value += $new_rating_value ;
                update_post_meta($post_id, 'mkdf_post_rating_value', $rating_value);
                setcookie('mkdf_post_rating_'. $post_id, $post_id, time()*20, '/');
                return '<span>'. esc_html__('Thank you! You have succesfully rated this post!', 'chillnews').'</span>';
            }
        }
    }
}

function chillnews_mikado_taxonomy_custom_fields($tag) {
    $t_id = $tag->term_id; // Get the ID of the category you're editing  
	$term_meta = get_option( "post_tax_term_$t_id" );
    ?>

    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Template', 'chillnews'); ?></label>
        </th>
        <td>
            <select name="term_meta[template]" id="term_meta[template]">
                <option <?php if( isset($term_meta['template']) && $term_meta['template'] == 'type1' ){ echo "selected='selected'"; } ?> value='type1'>Template 1</option>
				<option <?php if( isset($term_meta['template']) && $term_meta['template'] == 'type2' ){ echo "selected='selected'"; } ?> value='type2'>Template 2</option>
				<option <?php if( isset($term_meta['template']) && $term_meta['template'] == 'type3' ){ echo "selected='selected'"; } ?> value='type3'>Template 3</option>
				<option <?php if( isset($term_meta['template']) && $term_meta['template'] == 'type4' ){ echo "selected='selected'"; } ?> value='type4'>Template 4</option>
				<option <?php if( isset($term_meta['template']) && $term_meta['template'] == 'type5' ){ echo "selected='selected'"; } ?> value='type5'>Template 5</option>
				<option <?php if( isset($term_meta['template']) && $term_meta['template'] == 'type6' ){ echo "selected='selected'"; } ?> value='type6'>Template 6</option>
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Enable Sidebar', 'chillnews'); ?></label>
        </th>
        <td>
            <select name="term_meta[enable_sidebar]" id="term_meta[enable_sidebar]">
                <option <?php if( isset($term_meta['enable_sidebar']) && $term_meta['enable_sidebar'] == '' ){ echo "selected='selected'"; } ?> value=''>Default</option>
				<option <?php if( isset($term_meta['enable_sidebar']) && $term_meta['enable_sidebar'] == 'no' ){ echo "selected='selected'"; } ?> value='no'>No</option>
            </select>
        </td>
    </tr>
	<tr class="form-field">
		<th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Template Settings', 'chillnews'); ?></label>
        </th>
    </tr>
    <tr>
    	<th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e(' - Featured Post Settings', 'chillnews'); ?></label>
        </th>
        <td>
        	<div style="display: inline;">
				<label style="margin-right:5px" for="shortcode"><?php esc_html_e('Custom Image Width(px)', 'chillnews'); ?></label>
				<input style="width:100px" type="text" name="term_meta[featured_thumb_image_width]" id="term_meta[featured_thumb_image_width]" size="3" value="<?php if( isset($term_meta['featured_thumb_image_width']) && $term_meta['featured_thumb_image_width'] != '' ){ echo esc_attr($term_meta['featured_thumb_image_width']); } ?>">
			</div>
			<div style="display: inline;">
				<label style="margin-right:5px" for="shortcode"><?php esc_html_e('Custom Image Height(px)', 'chillnews'); ?></label>
				<input style="width:100px" type="text" name="term_meta[featured_thumb_image_height]" id="term_meta[featured_thumb_image_height]" size="3" value="<?php if( isset($term_meta['featured_thumb_image_height']) && $term_meta['featured_thumb_image_height'] != '' ){ echo esc_attr($term_meta['featured_thumb_image_height']); } ?>">
			</div>
			<div style="display: inline;">
				<label style="margin-right:5px" for="shortcode"><?php esc_html_e('Excerpt Length', 'chillnews'); ?></label>
				<input style="width:100px" type="text" name="term_meta[featured_excerpt_length]" id="term_meta[featured_excerpt_length]" size="3" value="<?php if( isset($term_meta['featured_excerpt_length']) && $term_meta['featured_excerpt_length'] != '' ){ echo esc_attr($term_meta['featured_excerpt_length']); } ?>">
			</div>
		</td>
    </tr>
    <tr>
    	<th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e(' - Featured Post Small Image Settings', 'chillnews'); ?></label>
            <p class="description"><?php esc_html_e('This options work only for Template 1 or Template 5', 'chillnews'); ?></p>
        </th>
        <td>
        	<div style="display: inline;">
				<label style="margin-right:5px" for="shortcode"><?php esc_html_e('Custom Image Width(px)', 'chillnews'); ?></label>
				<input style="width:100px" type="text" name="term_meta[featured_small_thumb_image_width]" id="term_meta[featured_small_thumb_image_width]" size="3" value="<?php if( isset($term_meta['featured_small_thumb_image_width']) && $term_meta['featured_small_thumb_image_width'] != '' ){ echo esc_attr($term_meta['featured_small_thumb_image_width']); } ?>">
			</div>
			<div style="display: inline;">
				<label style="margin-right:5px" for="shortcode"><?php esc_html_e('Custom Image Height(px)', 'chillnews'); ?></label>
				<input style="width:100px" type="text" name="term_meta[featured_small_thumb_image_height]" id="term_meta[featured_small_thumb_image_height]" size="3" value="<?php if( isset($term_meta['featured_small_thumb_image_height']) && $term_meta['featured_small_thumb_image_height'] != '' ){ echo esc_attr($term_meta['featured_small_thumb_image_height']); } ?>">
			</div>
		</td>
    </tr>
    <tr>
    	<th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e(' - Non-Featured Post Settings', 'chillnews'); ?></label>
        </th>
        <td>
        	<div style="display: inline;">
				<label style="margin-right:5px" for="shortcode"><?php esc_html_e('Custom Image Width(px)', 'chillnews'); ?></label>
				<input style="width:100px" type="text" name="term_meta[thumb_image_width]" id="term_meta[thumb_image_width]" size="3" value="<?php if( isset($term_meta['thumb_image_width']) && $term_meta['thumb_image_width'] != '' ){ echo esc_attr($term_meta['thumb_image_width']); } ?>">
			</div>
			<div style="display: inline;">
				<label style="margin-right:5px" for="shortcode"><?php esc_html_e('Custom Image Height(px)', 'chillnews'); ?></label>
				<input style="width:100px" type="text" name="term_meta[thumb_image_height]" id="term_meta[thumb_image_height]" size="3" value="<?php if( isset($term_meta['thumb_image_height']) && $term_meta['thumb_image_height'] != '' ){ echo esc_attr($term_meta['thumb_image_height']); } ?>">
			</div>
			<div style="display: inline;">
				<label style="margin-right:5px" for="shortcode"><?php esc_html_e('Excerpt Length', 'chillnews'); ?></label>
				<input style="width:100px" type="text" name="term_meta[excerpt_length]" id="term_meta[excerpt_length]" size="3" value="<?php if( isset($term_meta['excerpt_length']) && $term_meta['excerpt_length'] != '' ){ echo esc_attr($term_meta['excerpt_length']); } ?>">
			</div>
		</td>
    </tr>

<?php
}

function chillnews_mikado_save_taxonomy_custom_fields( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;		
		$term_meta = get_option( "post_tax_term_$t_id" );
		
        $cat_keys = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ){
            if ( isset( $_POST['term_meta'][$key] ) ){
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
		update_option( "post_tax_term_$t_id", $term_meta );		
    }
}

add_action( 'category_edit_form_fields', 'chillnews_mikado_taxonomy_custom_fields', 10, 2 );
add_action( 'edited_term', 'chillnews_mikado_save_taxonomy_custom_fields', 10, 2 );

?>