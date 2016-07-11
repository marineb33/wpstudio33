<?php
namespace ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutOne;

use ChillNewsNamespace\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class PostLayoutOne
 */
class PostLayoutOne extends ListShortcode {

	/**
	 * @var string
	 */

    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
		$this->base = 'mkdf_post_layout_one';
        $this->css_class = 'mkdf-pl-one';
        $this->shortcode_title = 'Mikado Post Layout 1';

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
            'title_tag' => 'h3',
            'title_length' => '',
            'display_date' => 'yes',
            'date_format' => 'M, d, Y',
            'display_category' => 'yes',
            'display_author' => 'no',
            'display_comments' => 'yes',
            'display_like' => 'no',
            'display_social_share' => 'yes',
            'display_rating' => 'no',
            'display_button' => 'no',
            'button_text' => '',
            'display_excerpt' => 'yes',
            'excerpt_length' => '20',
            'thumb_image_size' => '',
            'thumb_image_width' => '',
            'thumb_image_height' => ''
		);


		$params = shortcode_atts($args, $atts);
        $params['excerpt_length'] = esc_attr($params['excerpt_length']);
        $html = '';

        if($atts['query_result']->have_posts()):
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= chillnews_mikado_get_list_shortcode_module_template_part('post-template-one', 'templates', '', $params);

            endwhile;
        else:
                $html .= $this->errorMessage();

        endif;
        wp_reset_postdata();

		return $html;
	}
}