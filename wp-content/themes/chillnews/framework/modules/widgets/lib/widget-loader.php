<?php

if (!function_exists('chillnews_mikado_register_widgets')) {

	function chillnews_mikado_register_widgets() {

		$widgets = array(
			'ChillNewsBreakingNews',
			'ChillNewsDateWidget',
			'ChillNewsImageWidget',
			'ChillNewsPostLayoutOne',
			'ChillNewsPostLayoutTwo',
			'ChillNewsPostLayoutSix',
			'ChillNewsPostLayoutSeven',
            'ChillNewsPostLayoutNine',
            'ChillNewsPostLayoutTabs',
            'ChillNewsRecentComments',
			'ChillNewsSearchOpener',
			'ChillNewsSeparatorWidget',
			'ChillNewsSocialIconWidget',
			'ChillNewsStickySidebar',
			'ChillNewsPostTabs',
			'ChillNewsWeatherWidget',
		);

		foreach ($widgets as $widget) {
			register_widget($widget);
		}
	}
}

add_action('widgets_init', 'chillnews_mikado_register_widgets');