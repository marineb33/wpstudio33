<?php

if(!function_exists('chillnews_mikado_header_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function chillnews_mikado_header_class($classes) {
        $header_type = 'header-type3';

        $classes[] = 'mkdf-'.$header_type;

        return $classes;
    }

    add_filter('body_class', 'chillnews_mikado_header_class');
}

if(!function_exists('chillnews_mikado_header_behaviour_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function chillnews_mikado_header_behaviour_class($classes) {

        $classes[] = 'mkdf-'.chillnews_mikado_options()->getOptionValue('header_behaviour');

        return $classes;
    }

    add_filter('body_class', 'chillnews_mikado_header_behaviour_class');
}

if(!function_exists('chillnews_mikado_mobile_header_class')) {
    function chillnews_mikado_mobile_header_class($classes) {
        $classes[] = 'mkdf-default-mobile-header';

        $classes[] = 'mkdf-sticky-up-mobile-header';

        return $classes;
    }

    add_filter('body_class', 'chillnews_mikado_mobile_header_class');
}

if(!function_exists('chillnews_mikado_header_class_first_level_bg_color')) {
    /**
     * Function that adds first level menu background color class to header tag
     * @param array array of classes from main filter
     * @return array array of classes with added first level menu background color class
     */
    function chillnews_mikado_header_class_first_level_bg_color($classes) {

        //check if first level hover background color is set
        if(chillnews_mikado_options()->getOptionValue('menu_hover_background_color') !== ''){
            $classes[]= 'mkdf-menu-item-first-level-bg-color';
        }

        return $classes;
    }

    add_filter('body_class', 'chillnews_mikado_header_class_first_level_bg_color');
}

if(!function_exists('chillnews_mikado_header_global_js_var')) {
    function chillnews_mikado_header_global_js_var($global_variables) {

        $global_variables['mkdfTopBarHeight'] = chillnews_mikado_get_top_bar_height();

        return $global_variables;
    }

    add_filter('chillnews_mikado_js_global_variables', 'chillnews_mikado_header_global_js_var');
}

if(!function_exists('chillnews_mikado_aps_custom_style_class')) {
    function chillnews_mikado_aps_custom_style_class($classes) {

        if(chillnews_mikado_options()->getOptionValue('aps_custom_style') !== ''){
            $classes[] = 'mkdf-'.chillnews_mikado_options()->getOptionValue('aps_custom_style');
        }

        return $classes;
    }

    add_filter('body_class', 'chillnews_mikado_aps_custom_style_class');
}

if(!function_exists('chillnews_mikado_header_in_grid_class')) {
    function chillnews_mikado_header_in_grid_class($classes) {

        if(chillnews_mikado_options()->getOptionValue('bottom_header_area_in_grid') == 'yes') {
            $classes[] = 'mkdf-bottom-header-area-in-grid';    
        }

        return $classes;
    }

    add_filter('body_class', 'chillnews_mikado_header_in_grid_class');
}