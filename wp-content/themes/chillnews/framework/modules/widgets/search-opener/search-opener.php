<?php

/**
 * Widget that adds search icon that triggers opening of search form
 *
 * Class Mikado_Search_Opener
 */
class ChillNewsSearchOpener extends ChillNewsWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_search_opener', // Base ID
            'Mikado Search Opener' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'name'        => 'search_icon_size',
                'type'        => 'textfield',
                'title'       => 'Search Icon Size (px)',
                'description' => 'Define size for Search icon'
            ),
            array(
                'name'        => 'search_icon_color',
                'type'        => 'textfield',
                'title'       => 'Search Icon Color',
                'description' => 'Define color for Search icon'
            ),
            array(
                'name'        => 'search_icon_hover_color',
                'type'        => 'textfield',
                'title'       => 'Search Icon Hover Color',
                'description' => 'Define hover color for Search icon'
            ),
            array(
                'name'        => 'show_label',
                'type'        => 'dropdown',
                'title'       => 'Enable Search Icon Text',
                'description' => 'Enable this option to show \'Search\' text next to search icon in header',
                'options'     => array(
                    ''    => '',
                    'yes' => 'Yes',
                    'no'  => 'No'
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
        global $chillnews_mikado_global_options, $chillnews_mikado_global_IconCollections;

        $search_type_class    = 'mkdf-search-opener';
        $search_opener_styles = array();
        $show_search_text     = $instance['show_label'] == 'yes' || $chillnews_mikado_global_options['enable_search_icon_text'] == 'yes' ? true : false;

        if(!empty($instance['search_icon_size'])) {
            $search_opener_styles[] = 'font-size: '.$instance['search_icon_size'].'px';
        }

        if(!empty($instance['search_icon_color'])) {
            $search_opener_styles[] = 'color: '.$instance['search_icon_color'];
        }
        ?>

        <a <?php echo chillnews_mikado_get_inline_attr($instance['search_icon_hover_color'], 'data-hover-color'); ?>
            <?php chillnews_mikado_inline_style($search_opener_styles); ?>
            <?php chillnews_mikado_class_attribute($search_type_class); ?> href="javascript:void(0)">
            <?php if($show_search_text) { ?>
                <span class="mkdf-search-icon-text"><?php esc_html_e('Search', 'chillnews'); ?></span>
            <?php } ?>
            <?php $chillnews_mikado_global_IconCollections->getSearchIcon('font_elegant', false); ?>
        </a>

        <div class="mkdf-search-widget-holder">
            <form id="searchform" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                <div class="mkdf-form-holder">
                    <div class="mkdf-column-left">
                        <input type="text" placeholder="<?php esc_html_e('Search', 'chillnews'); ?>" name="s" class="mkdf-search-field" autocomplete="off" />
                    </div>
                    <div class="mkdf-column-right">
                        <input type="submit" class="mkdf-search-submit" value="GO" />
                    </div>
                </div>
            </form>
        </div>
    <?php }
}