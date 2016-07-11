<?php

if(!function_exists('chillnews_mikado_vc_grid_elements_enabled')) {

	/**
	 * Function that checks if Visual Composer Grid Elements are enabled
	 *
	 * @return bool
	 */
	function chillnews_mikado_vc_grid_elements_enabled() {

		return (chillnews_mikado_options()->getOptionValue('enable_grid_elements') == 'yes') ? true : false;
	}
}

if(!function_exists('chillnews_mikado_visual_composer_grid_elements')) {

	/**
	 * Removes Visual Composer Grid Elements post type if VC Grid option disabled
	 * and enables Visual Composer Grid Elements post type
	 * if VC Grid option enabled
	 */
	function chillnews_mikado_visual_composer_grid_elements() {

		if(!chillnews_mikado_vc_grid_elements_enabled()) {
			remove_action('init', 'vc_grid_item_editor_create_post_type');
		}
	}

	add_action('vc_after_init', 'chillnews_mikado_visual_composer_grid_elements', 12);
}

if(!function_exists('chillnews_mikado_get_vc_version')) {
	/**
	 * Return Visual Composer version string
	 *
	 * @return bool|string
	 */
	function chillnews_mikado_get_vc_version() {
		if(chillnews_mikado_visual_composer_installed()) {
			return WPB_VC_VERSION;
		}

		return false;
	}
}