<?php

if( !function_exists('chillnews_mikado_search_body_class') ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function chillnews_mikado_search_body_class($classes) {

		if ( is_active_widget( false, false, 'mkd_search_opener' ) ) {

			$classes[] = 'mkdf-search-widget-class';
		}

		return $classes;
	}

	add_filter('body_class', 'chillnews_mikado_search_body_class');
}