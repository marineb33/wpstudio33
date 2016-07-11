<?php
namespace ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutTwo;

use ChillNewsNamespace\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class PostLayoutTwo
 */
class PostLayoutTwo extends ListShortcode {

	/**
	 * @var string
	 */

    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
		$this->base = 'mkdf_post_layout_two';
        $this->css_class = 'mkdf-pl-two';
        $this->shortcode_title = 'Mikado Post Layout 2';

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
            'display_date' => 'yes',
            'date_format' => 'M, d, Y',
            'display_author' => 'no',
            'display_excerpt' => 'no',
            'excerpt_length' => '20',
            'thumb_image_width' => '77',
            'thumb_image_height' => '77',
            'thumb_image_shape_type' => 'mkdf-image-circle'
		);

		$params = shortcode_atts($args, $atts);
        $html = '';

        $params['image_style'] = $this->getImageStyle($params);

        if($atts['query_result']->have_posts()):
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= chillnews_mikado_get_list_shortcode_module_template_part('post-template-two', 'templates', '', $params);

            endwhile;
        else:
                $html .= $this->errorMessage();

        endif;
        wp_reset_postdata();

		return $html;
	}

    protected function getAdditionalClasses($params){
        $holder_classes = array();

        if (isset($params['skin']) && $params['skin'] !== '') {
            $holder_classes[] = $params['skin'];
        }

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