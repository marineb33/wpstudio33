<?php

/**
 * Widget that adds post layout tabs
 *
 * Class PostLayoutTabs
 */
class ChillNewsPostLayoutTabs extends ChillNewsWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_post_layout_tabs_widget', // Base ID
            'Mikado Post Layout Tabs Widget' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type' => 'dropdown',
                'title' => 'Number of Columns',
                'name' => 'column_number',
                'options' => array(
                    4 => 'Four Columns',
                    1 => 'One Column',
                    2 => 'Two Columns',
                    3 => 'Three Columns',
                    5 => 'Five Columns'
                ),
                'description' => ''
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
                'title' => 'Display Author',
                'name' => 'display_author',
                'options' => array(
                    'no' => 'No',
                    'yes' => 'Yes',
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Display Post Type Icon',
                'name' => 'display_post_type_icon',
                'options' => array(
                    'yes' => 'Yes',
                    'no' => 'No',
                )
            )
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
            $categories = array();
            $instance['number_of_posts'] = $instance['column_number'];
            $instance['thumb_image_size'] = 'custom_size';
            $instance['thumb_image_width'] = $instance['thumb_image_width'] != '' ? $instance['thumb_image_width'] : '164';
            $instance['thumb_image_height'] = $instance['thumb_image_height'] != '' ? $instance['thumb_image_height'] : '92';

            for($i = 1; $i <= 4; $i++) {
                ${$params_label.$i} = '';
                $categories[$i] = $instance['category_id_'.$i];
                unset($instance['category_id_'.$i]);
            }

            //generate shortcode params
            for($i = 1; $i <= 4; $i++) {
                foreach ($instance as $key => $value) {
                    ${$params_label.$i} .= " ".$key." = '".$value."' ";
                }
                ${$params_label.$i} .= " category_id = '".$categories[$i]."' ";
            }
        }

        echo '<div class="widget mkdf-plw-tabs">';
            echo '<div class="mkdf-plw-tabs-inner">';
                echo '<div class="mkdf-plw-tabs-tabs-holder">';
                    $i = 1;
                    foreach($categories as $key => $value){
                        $category_name = $value != 0 ? get_the_category_by_ID($value) : esc_html__('All','chillnews');
                        echo '<div class="mkdf-plw-tabs-tab"><a href="#"><span class="item_text">'.$category_name.'</span></a></div>';
                    }
                echo '</div>'; //close div.mkdf-plw-tabs-tabs-holder

                echo '<div class="mkdf-plw-tabs-content-holder">';
                    $i = 1;
                    foreach($categories as $key => $value){
                        echo '<div class="mkdf-plw-tabs-content">';
                        echo do_shortcode('[mkdf_post_layout_six '.${$params_label.$i}.']'); // XSS OK
                        echo'</div>';
                        $i++;
                    }
                echo '</div>'; //close div.mkdf-plw-tabs-content-holder
            echo '</div>'; //close div.mkdf-plw-tabs-inner
        echo '</div>'; //close div.mkdf-plw-tabs
    }
}