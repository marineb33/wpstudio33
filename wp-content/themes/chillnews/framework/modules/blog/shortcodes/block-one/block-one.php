<?php
namespace ChillNewsNamespace\Modules\Blog\Shortcodes\BlockOne;

use ChillNewsNamespace\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class BlockOne
 */
class BlockOne extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkdf_block_one';
        $this->css_class = 'mkdf-pb-one';
        $this->shortcode_title = 'Mikado Block 1';

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
     * @return string
     */
    public function render($atts, $content = null) {

        $args_featured = array(
            'featured_title_tag' => 'h3',
            'featured_title_length' => '',
            'featured_display_date' => 'yes',
            'featured_date_format' => 'M, d, Y',
            'featured_display_category' => 'yes',
            'featured_display_author' => 'no',
            'featured_display_comments' => 'yes',
            'featured_display_like' => 'no',
            'featured_display_social_share' => 'yes',
            'featured_display_rating' => 'no',
            'featured_display_button' => 'yes',
            'featured_button_text' => '',
            'featured_display_excerpt' => 'yes',
            'featured_excerpt_length' => '20',
            'featured_thumb_image_size' => '',
            'featured_thumb_image_width' => '',
            'featured_thumb_image_height' => ''
        );

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
        $params_featured = shortcode_atts($args_featured, $atts);

        $params_featured_filtered = chillnews_mikado_get_filtered_params($params_featured, 'featured');

        $html = '';

        $params['image_style'] = $this->getImageStyle($params);

        $loop_counter = 0;
        if ($atts['query_result']->have_posts()):

            $html .= '<div class="mkdf-bnl-inner">';
            
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();
                $loop_counter++;

                if($loop_counter == 1){
                    $html .= '<div class="mkdf-post-block-part mkdf-pb-one-featured">';
                        //Get HTML from template
                        $html .= chillnews_mikado_get_list_shortcode_module_template_part('post-template-one', 'templates', '', $params_featured_filtered);
                    $html .= '</div>';
                    $html .= '<div class="mkdf-post-block-part mkdf-pb-one-non-featured">';
                } else {
                    //Get HTML from template
                    $html .= chillnews_mikado_get_list_shortcode_module_template_part('post-template-two', 'templates', '', $params);
                }

            endwhile;

            $html .= '</div>'; // close mkdf-pb-one-non-featured
            $html .= '</div>'; // close mkdf-bnl-inner

        else:
            $html .= $this->errorMessage();
        endif;

        wp_reset_postdata();

        return $html;
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

    protected function getAdditionalClasses($params){
        $holder_classes = array();

        if (isset($params['skin']) && $params['skin'] !== '') {
            $holder_classes[] = $params['skin'];
        }

        if (isset($params['block_proportion']) && $params['block_proportion'] !== '') {
            $holder_classes[] = $params['block_proportion'];
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

        return implode('; ', $style);
    }
}