<?php

/***** Set params for posts on 404 page *****/

$params = '';

$number_of_posts = 6;
$params .= ' number_of_posts="'.$number_of_posts.'"';	

$column_number = 3;
$params .= ' column_number="'.$column_number.'"';

$display_excerpt = 'no';
$params .= ' display_excerpt="'.$display_excerpt.'"';
?>
<?php get_header(); ?>

	<?php chillnews_mikado_get_title(); ?>

	<div class="mkdf-container">
	<?php do_action('chillnews_mikado_after_container_open'); ?>
		<div class="mkdf-container-inner mkdf-404-page">
			<div class="mkdf-page-not-found">
				<h1>
					<?php if(chillnews_mikado_options()->getOptionValue('404_title')){
						echo esc_html(chillnews_mikado_options()->getOptionValue('404_title'));
					} else {
						esc_html_e('Sorry.......404 Error Page', 'chillnews');
					} ?>
				</h1>
				<h3>
					<?php if(chillnews_mikado_options()->getOptionValue('404_text')){
						echo esc_html(chillnews_mikado_options()->getOptionValue('404_text'));
					} else {
						esc_html_e("Sorry, but the page you are looking for doesn't exist.", "chillnews");
					} ?>
				</h3>
				<?php
					$button_params = array();
					if (chillnews_mikado_options()->getOptionValue('404_back_to_home')){
						$button_params['text'] = chillnews_mikado_options()->getOptionValue('404_back_to_home');
					} else {
						$button_params['text'] = "Back To Home Page";
					}
					$button_params['type'] = 'solid';
					$button_params['link'] = esc_url(home_url('/'));
					$button_params['target'] = '_self';
				echo chillnews_mikado_execute_shortcode('mkdf_button', $button_params);?>

				<div class="mkdf-separator-holder clearfix"><div class="mkdf-separator"></div></div>
			</div>
			<?php echo do_shortcode("[mkdf_post_layout_one $params]"); ?>
		</div>
		<?php do_action('chillnews_mikado_before_container_close'); ?>
	</div>
<?php get_footer(); ?>