<?php
namespace ChillNewsNamespace\Modules\Tab;

use ChillNewsNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Tab
 */

class Tab implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'mkdf_tab';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Mikado Tab', 'chillnews'),
			'base' => $this->getBase(),
			'as_parent' => array('except' => 'vc_row'),
			'as_child' => array('only' => 'mkdf_tabs'),
			'is_container' => true,
			'category' => 'by MIKADO',
			'icon' => 'icon-wpb-tab extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' =>
				array(
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Title',
						'param_name' => 'title',
						'description' => ''
					),
					array(
						'type'			=> 'attach_image',
						'heading'		=> 'Title Image',
						'param_name'	=> 'title_image',
						'description'	=> 'Select tab title image from media library',
					),
				)
        ));
	}

	public function render($atts, $content = null) {
		
		$default_atts = array(
			'title' => 'Tab',
			'title_image' => '',
			'tab_id' => ''
		);

		$params       = shortcode_atts($default_atts, $atts);
		extract($params);

		$rand_number = rand(0, 1000);

		$params['title'] = $params['title'].'-'.$rand_number;

		$params['content'] = $content;
		
		$output = '';
		$output .= chillnews_mikado_get_shortcode_module_template_part('templates/tab_content','tabs', '', $params);
		return $output;
	}
}