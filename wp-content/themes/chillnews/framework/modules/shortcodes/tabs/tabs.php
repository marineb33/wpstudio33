<?php
namespace ChillNewsNamespace\Modules\Tabs;

use ChillNewsNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tabs
 */

class Tabs implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'mkdf_tabs';
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
			'name' => esc_html__('Mikado Tabs', 'chillnews'),
			'base' => $this->getBase(),
			'as_parent' => array('only' => 'mkdf_tab'),
			'content_element' => true,
			'show_settings_on_create' => true,
			'category' => 'by MIKADO',
			'icon' => 'icon-wpb-tabs extended-custom-icon',
			'js_view' => 'VcColumnView',
			'params' => array(
                array(
                    'type' => 'dropdown',
                    'admin-label' => true,
                    'heading' => 'Tabs Layout',
                    'param_name' => 'tabs_layout',
                    'value' => array(
                        'Default' => 'mkdf-tabs-regular',
                        'With Title' => 'mkdf-tabs-with-title'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => 'Tab Title',
                    'param_name' => 'tabs_title',
                    'description' => '',
                    'dependency'  => array('element' => 'tabs_layout', 'value' => array('mkdf-tabs-with-title')),
                    'group'      => 'Title Settings'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Title Tag',
                    'param_name' => 'title_tag',
                    'value' => array(
                        'Default'   => '',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                        'h5' => 'h5',
                        'h6' => 'h6',
                    ),
                    'description' => '',
                    'dependency' => array('element' => 'tabs_title', 'not_empty' => true),
                    'group'      => 'Title Settings'
                )
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'tabs_layout' => 'mkdf-tabs-regular',
			'tabs_title' => '',
			'title_tag' => 'h6'
		);
		
		$args = array_merge($args, chillnews_mikado_icon_collections()->getShortcodeParams());
        $params  = shortcode_atts($args, $atts);
		
		extract($params);
		
		// Extract tab titles
		preg_match_all('/title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
		$tab_titles = array();

		/**
		 * get tab titles array
		 *
		 */
		if (isset($matches[0])) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach($tab_titles as $tab) {
			preg_match('/title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['tabs_titles'] = $tab_title_array;

		// Extract tab titles images
		preg_match_all('/title_image="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
		$title_images = array();

		/**
		 * get title images array
		 *
		 */
		if (isset($matches[0])) {
			$title_images = $matches[0];
		}
		
		$title_images_array = array();
		
		foreach($title_images as $title_image) {
			preg_match('/title_image="([^\"]+)"/i', $title_image[0], $title_image_matches, PREG_OFFSET_CAPTURE);
			$title_images_array[] = $title_image_matches[1][0];
		}
		
		$params['title_images'] = $title_images_array;

		if(!empty($params['title_images'])){
			$params['tab_class'] = '';
		} else {
			$params['tab_class'] = 'mkdf-tab-title-without-image';
		}

		$params['title_metas'] = $this->getImageMeta($params);
		$params['content'] = $content;

		$output = chillnews_mikado_get_shortcode_module_template_part('templates/tabs-template','tabs', '', $params);
		
		return $output;
	}

	/**
	 * Return images
	 *
	 * @param $params
	 * @return array
	 */
	private function getImageMeta($params) {

		$title_meta = array();

		if(!empty($params['title_images'])){
			$size = array(53,53);

			foreach ($params['title_images'] as $image_id) {
				$img = wp_get_attachment_image_src($image_id, $size);

				$image['url'] = $img[0];
				$image['width'] = $img[1];
				$image['height'] = $img[2];
				$image['title'] = get_the_title($image_id);

				$title_meta[] = $image;
			}
		}

		return $title_meta;
	}
}