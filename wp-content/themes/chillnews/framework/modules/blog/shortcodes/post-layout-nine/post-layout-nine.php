<?php
namespace ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutNine;

use ChillNewsNamespace\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class PostLayoutNine
 */
class PostLayoutNine extends ListShortcode {

	/**
	 * @var string
	 */

    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
		$this->base = 'mkdf_post_layout_nine';
        $this->css_class = 'mkdf-pl-nine';
        $this->shortcode_title = 'Mikado Post Layout 9';

        parent::__construct($this->base, $this->css_class, $this->shortcode_title);

		add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * add params for shortcode in next function
     * function gets $base for each shortcode
     *
     * @see chillnews_mikado_get_shortcode_params()
     */

    /**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 *
     * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
            'title_tag' => 'h5',
            'title_length' => '',
            'thumb_image_width' => '65',
            'thumb_image_height' => '65',
            'thumb_image_shape_type' => 'mkdf-image-circle'
		);

		$params = shortcode_atts($args, $atts);
        $html = '';

        $params['image_style'] = $this->getImageStyle($params);

        if($atts['query_result']->have_posts()):
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= chillnews_mikado_get_list_shortcode_module_template_part('post-template-nine', 'templates', '', $params);

            endwhile;
        else:
                $html .= $this->errorMessage();

        endif;
        wp_reset_postdata();

		return $html;
	}

    protected function getAdditionalClasses($params){
        $holder_classes = array();

        if (isset($params['thumb_image_shape_type']) && $params['thumb_image_shape_type'] !== '') {
            $holder_classes[] = $params['thumb_image_shape_type'];
        }

        return $holder_classes;
    }

    private function getImageStyle($params) {
        $style = array();

        if ($params['thumb_image_width'] !== '') {
            $style[] = 'width: '.chillnews_mikado_filter_px($params['thumb_image_width']).'px';
        }

        if ($params['thumb_image_height'] !== '') {
            $style[] = 'height: '.chillnews_mikado_filter_px($params['thumb_image_height']).'px';
        }

        return implode(';', $style);
    }
}