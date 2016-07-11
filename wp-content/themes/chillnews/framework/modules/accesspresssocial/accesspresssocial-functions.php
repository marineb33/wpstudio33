<?php

if(!function_exists('chillnews_mikado_access_press_social_plugin')) {
	/**
	 * Map Access Press Social Count plugin
	 * Hooks on vc_after_init action
	 */
	function chillnews_mikado_access_press_social_plugin() {

		chillnews_mikado_add_admin_page(
			array(
				'slug' => '_aps_plugin_page',
				'title' => 'Access Press Social',
				'icon' => 'fa fa-home'
			)
		);

		$aps_panel = chillnews_mikado_add_admin_panel(
			array(
				'title' => 'Access Press Social Count',
				'name' => 'aps_plugin',
				'page' => '_aps_plugin_page'
			)
		);

		chillnews_mikado_add_admin_field(
			array(
				'parent'		=> $aps_panel,
				'type'			=> 'select',
				'name'			=> 'aps_custom_style',
				'default_value'	=> '',
				'label' 		=> 'Enable Custom Style',
				'description' 	=> "Enabling this option you will set our custom style for Access Press Social Count elements",
				'options' 		=> array(
					'apsc-custom-style-enabled' => 'Yes',
					'' => 'No',
				)
			)
		);
	}

	add_action('vc_after_init', 'chillnews_mikado_access_press_social_plugin', 16);
}