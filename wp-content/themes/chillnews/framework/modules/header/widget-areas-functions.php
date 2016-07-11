<?php

if(!function_exists('chillnews_mikado_register_top_header_areas')) {
    /**
     * Registers widget areas for top header bar when it is enabled
     */
    function chillnews_mikado_register_top_header_areas() {
        $top_bar_enabled = chillnews_mikado_options()->getOptionValue('top_bar');

        if($top_bar_enabled == 'yes') {
            register_sidebar(array(
                'name'          => esc_html__('Top Bar Left', 'chillnews'),
                'id'            => 'mkdf-top-bar-left',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-top-bar-widget">',
                'after_widget'  => '</div>'
            ));

            register_sidebar(array(
                'name'          => esc_html__('Top Bar Right', 'chillnews'),
                'id'            => 'mkdf-top-bar-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-top-bar-widget">',
                'after_widget'  => '</div>'
            ));
        }
    }

    add_action('widgets_init', 'chillnews_mikado_register_top_header_areas');
}

if(!function_exists('chillnews_mikado_header_type3_widget_areas')) {
    /**
     * Registers widget areas for header type 3
     */
    function chillnews_mikado_header_type3_widget_areas() {
        register_sidebar(array(
            'name'          => esc_html__('Header Banner', 'chillnews'),
            'id'            => 'mkdf-header-banner',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-header-banner-widget">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the right hand side from the logo', 'chillnews')
        ));
    }

    add_action('widgets_init', 'chillnews_mikado_header_type3_widget_areas');
}

if(!function_exists('chillnews_mikado_register_mobile_header_areas')) {
    /**
     * Registers widget areas for mobile header
     */
    function chillnews_mikado_register_mobile_header_areas() {
        if(chillnews_mikado_is_responsive_on()) {
            register_sidebar(array(
                'name'          => esc_html__('Right From Mobile Logo', 'chillnews'),
                'id'            => 'mkdf-right-from-mobile-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-right-from-mobile-logo">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the mobile logo', 'chillnews')
            ));
        }
    }

    add_action('widgets_init', 'chillnews_mikado_register_mobile_header_areas');
}