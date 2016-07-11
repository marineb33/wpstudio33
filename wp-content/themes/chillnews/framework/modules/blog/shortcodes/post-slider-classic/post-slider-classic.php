<?php
namespace ChillNewsNamespace\Modules\Blog\Shortcodes\PostSliderClassic;

use ChillNewsNamespace\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class PostSliderClassic
 */
class PostSliderClassic extends ListShortcode {

	/**
	 * @var string
	 */
    private $base;
    private $css_class;
    private $shortcode_title;

	public function __construct() {
		$this->base = 'mkdf_post_slider_classic';
        $this->css_class = 'mkdf-psc';
        $this->shortcode_title = 'Mikado Post Slider Classic';

        parent::__construct($this->base, $this->css_class, $this->shortcode_title);

        add_action('vc_before_init', array($this, 'vcMap'));
	}

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * add params for shortcode in next function
     *
     * @see chillnews_mikado_get_shortcode_params()
     */

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
            'title_tag' => 'h2',
            'display_category' => 'yes',
            'display_date' => 'yes',
            'date_format' => 'M, d, Y',
            'display_author' => 'yes',
            'display_comments' => 'yes',
            'thumb_image_size' => '',
            'thumb_image_width' => '',
            'thumb_image_height' => ''
		);

		$params = shortcode_atts($args, $atts);
        $html = '';

        if($atts['query_result']->have_posts()):
            $html .= '<ul class="mkdf-psc-slides">';

            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= chillnews_mikado_get_list_shortcode_module_template_part('templates/post-slider-classic-template', 'post-slider-classic', '', $params);

            endwhile;

            $html .= '</ul>';
            else:
                $html .= $this->errorMessage();
        endif;

        wp_reset_postdata();

        return $html;
	}

    protected function getAdditionalClasses($params) {

        $holderClasses = array();

        if ($params['number_of_posts'] !== '') {
            $holderClasses[] = 'mkdf-psc-number-'.$params['number_of_posts'];
        }

        if ($params['display_control'] == 'thumbnails') {
            $holderClasses[] = 'mkdf-psc-thumbnail';
        }

        if ($params['display_navigation'] == 'yes') {
            $holderClasses[] = 'mkdf-psc-navigation';
        }

        return $holderClasses;
    }

    /**
     * Enabling inner holder in shortcode if layout is used,
     * because block has its own inner holder
     *
     * @return boolean
     */
    protected function isBlockElement() {
        return true;
    }
}