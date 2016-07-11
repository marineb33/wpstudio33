<?php

/**
 * Widget that adds post tabs
 *
 * Class PostTabs
 */
class ChillNewsPostTabs extends ChillNewsWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_post_tabs_widget', // Base ID
            'Mikado Post Tabs Widget' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type' => 'textfield',
                'title' => 'Widget Title',
                'name' => 'widget_title'
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Style',
                'name' => 'style',
                'options' => array(
                    'style-one' => 'Style 1',
                    'style-two' => 'Style 2'
                )
            ),
            array(
                'type' => 'textfield',
                'title' => 'Number of Posts',
                'name' => 'number_of_posts'
            ),
            array(
                'type' => 'dropdown',
                'title' => 'First Category',
                'name' => 'category_id_1',
                'options' => array_flip(chillnews_mikado_get_post_categories_VC()),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Second Category',
                'name' => 'category_id_2',
                'options' => array_flip(chillnews_mikado_get_post_categories_VC()),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Third Category',
                'name' => 'category_id_3',
                'options' => array_flip(chillnews_mikado_get_post_categories_VC()),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Fourth Category',
                'name' => 'category_id_4',
                'options' => array_flip(chillnews_mikado_get_post_categories_VC()),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Sort',
                'name' => 'sort',
                'options' => array_flip(chillnews_mikado_get_sort_array()),
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'title' => 'Image Width (px)',
                'name' => 'thumb_image_width',
                'description' => 'Set custom image width (px)',
            ),
            array(
                'type' => 'textfield',
                'title' => 'Image Height (px)',
                'name' => 'thumb_image_height',
                'description' => 'Set custom image height (px)',
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Image Shape Type',
                'name' => 'thumb_image_shape_type',
                'options' => array(
                    'mkdf-image-circle' => 'Circle',
                    'mkdf-image-square' => 'Square'
                ),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Title Tag',
                'name' => 'title_tag',
                'options' => array(
                    'h5' => 'h5',
                    'h2' => 'h2',
                    'h3' => 'h3',
                    'h4' => 'h4',
                    'h6' => 'h6'
                )
            ),
            array(
                'type' => 'textfield',
                'title' => 'Title Max Characters',
                'name' => 'title_length',
                'description' => 'Enter max character of title post list that you want to display'
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Display Date',
                'name' => 'display_date',
                'options' => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                )
            ),
            array(
                'type' => 'textfield',
                'title' => 'Date Format',
                'name' => 'date_format',
                'description' => 'Enter the date format that you want to display'
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Display Post Type Icon',
                'name' => 'display_post_type_icon',
                'options' => array(
                    'yes' => 'Yes',
                    'no' => 'No',
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Display Author',
                'name' => 'display_author',
                'options' => array(
                    'no' => 'No',
                    'yes' => 'Yes'
                )
            ),
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        extract($args);

        //prepare variables
        if(is_array($instance) && count($instance)) {
            $params_label = 'params';
            $id_label = array();
            $categories = array();
            $holder_class = '';

            if (!empty($instance['style']) || $instance['style'] !== '') {
                $holder_class = 'mkdf-'.$instance['style'];
            }
            
            if (empty($instance['thumb_image_width']) || $instance['thumb_image_width'] == '') {
                $instance['thumb_image_width'] = 65;
            }

            if (empty($instance['thumb_image_height']) || $instance['thumb_image_height'] == '') {
                $instance['thumb_image_height'] = 65;
            }

            for($i = 1; $i <= 4; $i++) {
                ${$params_label.$i} = '';
                if(!empty($instance['category_id_'.$i]) && $instance['category_id_'.$i] !== '') {
                    $categories[$i] = $instance['category_id_'.$i];
                    $id_label[$i] = 'mkdf-widget-tab-'.$categories[$i];
                    unset($instance['category_id_'.$i]);
                }
            }

            //generate shortcode params
            for($i = 1; $i <= 4; $i++) {
                foreach ($instance as $key => $value) {
                    ${$params_label.$i} .= " ".$key."='".$value."' ";
                }
                if(!empty($categories[$i]) && $categories[$i] !== ''){
                    ${$params_label.$i} .= " category_id='".$categories[$i]."' ";
                }
                ${$params_label.$i} .= " thumb_image_size='custom_size' ";
                ${$params_label.$i} .= " skin='mkdf-pt-light' ";
            }
        }

        echo '<div class="widget mkdf-ptw-holder mkdf-tabs">';
            if (!empty($instance['widget_title']) && $instance['widget_title'] !== '') {
                print $args['before_title'].$instance['widget_title'].$args['after_title'];
            }
            echo '<div class="mkdf-ptw-nav mkdf-tabs-nav '.$holder_class.'"><ul>';
                $i = 1;
                foreach($categories as $key => $value){
                    $category_name = $value != 0 ? get_the_category_by_ID($value) : '';
                    if($category_name !== ''){
                        echo '<li><a href="#'.$id_label[$i].'">'.$category_name.'</a></li>';
                        $i++;
                    } else if ($value !== 0 && $category_name === ''){
                        echo '<li><a href="#'.$id_label[$i].'">'.esc_html__("All", "chillnews").'</a></li>';
                        $i++;
                    }
                }
            echo '</ul></div>';

            $j = 1;
            foreach($categories as $key => $value){
                if($value != 0) {
                    echo '<div class="mkdf-ptw-content mkdf-tab-container" id="'.$id_label[$j].'">';
                        echo '<div class="mkdf-plw-tabs-content">';
                        echo do_shortcode('[mkdf_post_layout_two '.${$params_label.$j}.']'); // XSS OK
                        echo'</div>';
                        $j++;
                    echo '</div>';
                }
            }
        echo '</div>';
    }
}