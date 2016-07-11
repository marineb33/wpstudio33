<?php

if ( ! function_exists('chillnews_mikado_like') ) {
	/**
	 * Returns ChillNewsLike instance
	 *
	 * @return ChillNewsLike
	 */
	function chillnews_mikado_like() {
		return ChillNewsLike::get_instance();
	}

}

function chillnews_mikado_get_like() {

	echo wp_kses(chillnews_mikado_like()->add_like(), array(
		'span' => array(
			'class' => true,
			'aria-hidden' => true,
			'style' => true,
			'id' => true
		),
		'a' => array(
			'href' => true,
			'class' => true,
			'id' => true,
			'title' => true,
			'style' => true
		)
	));
}

if ( ! function_exists('chillnews_mikado_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function chillnews_mikado_like_latest_posts() {
		return chillnews_mikado_like()->add_like();
	}

}

if ( ! function_exists('chillnews_mikado_like_portfolio_list') ) {
	/**
	 * Add like to portfolio project
	 *
	 * @param $portfolio_project_id
	 * @return string
	 */
	function chillnews_mikado_like_portfolio_list($portfolio_project_id) {
		return chillnews_mikado_like()->add_like_portfolio_list($portfolio_project_id);
	}

}