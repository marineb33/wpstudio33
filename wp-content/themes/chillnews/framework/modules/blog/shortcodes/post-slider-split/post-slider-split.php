<?php
namespace ChillNewsNamespace\Modules\Blog\Shortcodes\PostSliderSplit;

use ChillNewsNamespace\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class PostSliderSplit
 */
class PostSliderSplit extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkdf_post_slider_split';
        $this->css_class = 'mkdf-pss';
        $this->shortcode_title = 'Mikado Post Split Slider';

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

        $args = array(
            'slider_layout' => '',
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
        $params_non_featured = $this->setParams($params);

        $html = '';

        $loop_counter = 0;
        if ($atts['query_result']->have_posts()):

            $html .= '<ul class="mkdf-split-holder">';

            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();
                $loop_counter++;

            if($params['slider_layout'] == 'two-posts' && ($loop_counter%2 == 1)
                || (($params['slider_layout'] == 'three-posts' || $params['slider_layout'] == 'three-posts-with-featured') && ($loop_counter%3 === 1))){
                $html .= '<li class="mkdf-split-item">';
            }

            if($params['slider_layout'] == 'three-posts-with-featured' && $loop_counter%3 != 1){
                //Get HTML from template
                $html .= chillnews_mikado_get_list_shortcode_module_template_part('post-template-five', 'templates', '', $params_non_featured);
            }
            else{
                //Get HTML from template
                $html .= chillnews_mikado_get_list_shortcode_module_template_part('post-template-five', 'templates', '', $params);
            }

            if($params['slider_layout'] == 'two-posts' && ($loop_counter%2 == 0)
                || (($params['slider_layout'] == 'three-posts' || $params['slider_layout'] == 'three-posts-with-featured') && ($loop_counter%3 === 0))){
                $html .= '</li>'; // close mkdf-split-item
            }

            endwhile;

            $html .= '</ul>'; // mkdf-split-holder

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

        if (isset($params['slider_layout']) && $params['slider_layout'] !== '') {
            $holder_classes[] = $params['slider_layout'];
        }

        return $holder_classes;
    }

    private function setParams($params){

        $params_non_featured = $params;

        switch($params_non_featured['title_tag']){
            case 'h1' : $params_non_featured['title_tag'] = 'h2';
                break;
            case 'h2' : $params_non_featured['title_tag'] = 'h3';
                break;
            case 'h3' : $params_non_featured['title_tag'] = 'h4';
                break;
            case 'h4' : $params_non_featured['title_tag'] = 'h5';
                break;
            case 'h5' : $params_non_featured['title_tag'] = 'h6';
                break;
            default : break;
        }


        return $params_non_featured;
    }

}