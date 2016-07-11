<?php

if ( ! function_exists('chillnews_mikado_reset_options_map') ) {
	/**
	 * Reset options panel
	 */
	function chillnews_mikado_reset_options_map() {

		chillnews_mikado_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => 'Reset',
				'icon'  => 'fa fa-retweet'
			)
		);

		$panel_reset = chillnews_mikado_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => 'Reset'
			)
		);

		chillnews_mikado_add_admin_field(array(
			'type'	=> 'yesno',
			'name'	=> 'reset_to_defaults',
			'default_value'	=> 'no',
			'label'			=> 'Reset to Defaults',
			'description'	=> 'This option will reset all Select Options values to defaults',
			'parent'		=> $panel_reset
		));

	}

	add_action( 'chillnews_mikado_options_map', 'chillnews_mikado_reset_options_map', 20 );
}