<?php
namespace ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutFive;

use ChillNewsNamespace\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class PostLayoutFive
 */
class PostLayoutFive extends ListShortcode {

	/**
	 * @var string
	 */

    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
		$this->base = 'mkdf_post_layout_five';
        $this->css_class = 'mkdf-pl-five';
        $this->shortcode_title = 'Mikado Post Layout 5';

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
            'display_author' => 'yes',
            'display_comments' => 'yes',
            'display_like' => 'no',
            'display_social_share' => 'yes',
            'display_rating' => 'no',
            'display_button' => 'no',
            'button_text' => '',
            'display_excerpt' => 'no',
            'excerpt_length' => '20',
            'thumb_image_size' => '',
            'thumb_image_width' => '',
            'thumb_image_height' => ''
		);

		$params = shortcode_atts($args, $atts);
        $html = '';

        if($atts['query_result']->have_posts()):
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= chillnews_mikado_get_list_shortcode_module_template_part('post-template-five', 'templates', '', $params);

            endwhile;
        else:
                $html .= $this->errorMessage();

        endif;
        wp_reset_postdata();

		return $html;
	}

}