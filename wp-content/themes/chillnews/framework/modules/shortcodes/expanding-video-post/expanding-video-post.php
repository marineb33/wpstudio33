<?php
namespace ChillNewsNamespace\Modules\ExpandingVideoPost;

use ChillNewsNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class ExpandingVideoPost
 */
class ExpandingVideoPost implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkdf_expanding_video_post';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {

		vc_map( array(
				'name' => esc_html__('Mikado Expanding Video Post', 'chillnews'),
				'base' => $this->getBase(),
				'category' => 'by MIKADO',
				'icon' => 'icon-wpb-expanding-video-post extended-expanding-video-post',
				'allowed_container_element' => 'vc_row',
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => 'Video Post ID',
						'param_name' => 'post_in',
						'description' => 'Enter the ID of the video post format you want to display'
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Image Size',
						'param_name' => 'image_size',
						'value' => array(
							'Original' => 'original',
							'Landscape' => 'landscape',
							'Square' => 'square'
						),
                        'save_always'	=> true,
						'description' => ''
					),
					array(
		                'type' => 'dropdown',
		                'heading' => 'Display Category',
		                'param_name' => 'display_category',
		                'value' => array(
		                    'Yes' => 'yes',
		                    'No' => 'no'
		                ),
                        'save_always'	=> true,
		                'description' => ''
		            ),
		            array(
		                'type' => 'dropdown',
		                'heading' => 'Display Date',
		                'param_name' => 'display_date',
		                'value' => array(
		                    'Yes' => 'yes',
		                    'No' => 'no'
		                ),
                        'save_always'	=> true,
		                'description' => ''
		            ),
					array(
						'type' => 'dropdown',
						'heading' => 'Title Tag',
						'param_name' => 'title_tag',
						'value' => array(
							''   => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'description' => ''
					)
				)
		) );
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'post_in' => '',
			'image_size' => 'original',
			'display_category' => 'yes',
			'display_date' => 'yes',
			'title_tag' => 'h3',
		);

		$params = shortcode_atts($args, $atts);

		$queryArray = $this->generateQueryArray($params);
		$queryResult = new \WP_Query($queryArray);
		$params['query_result'] = $queryResult;

		$thumbImageSize = $this->generateImageSize($params);
		$params['thumb_image_size'] = $thumbImageSize;

		//Get HTML from template
		$html = chillnews_mikado_get_shortcode_module_template_part('templates/expanding-video-post-template', 'expanding-video-post', '', $params);

		return $html;
	}

	/**
	   * Generates query array
	   *
	   * @param $params
	   *
	   * @return array
	*/
	public function generateQueryArray($params){

		$queryArray = array();

		if($params['post_in'] !== '') {
			$queryArray['post__in'] = explode(",", $params['post_in']);
        }
		
		return $queryArray;
	}

	/**
	   * Generates image size option
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function generateImageSize($params){
		$thumbImageSize = '';
		$imageSize = $params['image_size'];
		
		if ($imageSize !== '' && $imageSize == 'landscape') {
            $thumbImageSize = 'chillnews_mikado_landscape';
        } else if($imageSize === 'square'){
			$thumbImageSize = 'chillnews_mikado_square';
		} else if ($imageSize !== '' && $imageSize == 'original') {
            $thumbImageSize = 'full';
        }

		return $thumbImageSize;
	}
}