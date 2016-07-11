<?php

use ChillNewsNamespace\Modules\Header\Lib\HeaderFactory;

if(!function_exists('chillnews_mikado_get_header')) {
    /**
     * Loads header HTML based on header type option. Sets all necessary parameters for header
     * and defines chillnews_mikado_header_type_parameters filter
     */
    function chillnews_mikado_get_header() {

        //will be read from options
        $header_type     = 'header-type3';
        $header_behavior = chillnews_mikado_options()->getOptionValue('header_behaviour');

        if(HeaderFactory::getInstance()->validHeaderObject()) {
            $parameters = array(
                'hide_logo'          => chillnews_mikado_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
                'show_nav_search'    => chillnews_mikado_options()->getOptionValue('show_nav_search') == 'yes' ? true : false,
                'show_fixed_wrapper' => in_array($header_behavior, array('fixed-on-scroll')) ? true : false,
            );

            $parameters = apply_filters('chillnews_mikado_header_type_parameters', $parameters, $header_type);

            HeaderFactory::getInstance()->getHeaderObject()->loadTemplate($parameters);
        }
    }
}

if(!function_exists('chillnews_mikado_get_header_top')) {
    /**
     * Loads header top HTML and sets parameters for it
     */
    function chillnews_mikado_get_header_top() {

        $params = array(
            'column_widths'      => '50-50',
            'show_header_top'    => chillnews_mikado_options()->getOptionValue('top_bar') == 'yes' ? true : false,
            'top_bar_in_grid'    => chillnews_mikado_options()->getOptionValue('top_bar_in_grid') == 'yes' ? true : false
        );

        $params = apply_filters('chillnews_mikado_header_top_params', $params);

        chillnews_mikado_get_module_template_part('templates/parts/header-top', 'header', '', $params);
    }
}

if(!function_exists('chillnews_mikado_get_logo')) {
    /**
     * Loads logo HTML
     *
     * @param $slug
     */
    function chillnews_mikado_get_logo($slug = '') {

        $slug = $slug !== '' ? $slug : 'header-type3';

        $logo_image = chillnews_mikado_options()->getOptionValue('logo_image');

        $logo_image_fixed = chillnews_mikado_options()->getOptionValue('logo_image_fixed');


        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = chillnews_mikado_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px;'; //divided with 2 because of retina screens
        }

        $params = array(
            'logo_image'  => $logo_image,
            'logo_styles' => $logo_styles,
            'logo_image_fixed' => $logo_image_fixed    
        );

        chillnews_mikado_get_module_template_part('templates/parts/logo', 'header', $slug, $params);
    }
}

if(!function_exists('chillnews_mikado_get_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function chillnews_mikado_get_main_menu($additional_class = 'mkdf-default-nav') {
        chillnews_mikado_get_module_template_part('templates/parts/navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('chillnews_mikado_get_mobile_header')) {
    /**
     * Loads mobile header HTML only if responsiveness is enabled
     */
    function chillnews_mikado_get_mobile_header() {
        if(chillnews_mikado_is_responsive_on()) {
            $header_type = 'header-type3';

            $mobile_menu_title = chillnews_mikado_options()->getOptionValue('mobile_menu_title');

            //this could be read from theme options
            $mobile_header_type = 'mobile-header';

            $parameters = array(
                'show_logo'              => chillnews_mikado_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
                'menu_opener_icon'       => chillnews_mikado_icon_collections()->getMobileMenuIcon(chillnews_mikado_options()->getOptionValue('mobile_icon_pack'), true),
                'show_navigation_opener' => has_nav_menu('main-navigation'),
                'mobile_menu_title' => $mobile_menu_title
            );

            chillnews_mikado_get_module_template_part('templates/types/'.$mobile_header_type, 'header', $header_type, $parameters);
        }
    }
}

if(!function_exists('chillnews_mikado_get_mobile_logo')) {
    /**
     * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
     *
     * @param string $slug
     */
    function chillnews_mikado_get_mobile_logo($slug = '') {

        $slug = $slug !== '' ? $slug : 'header-type3';

        //check if mobile logo has been set and use that, else use normal logo
        if(chillnews_mikado_options()->getOptionValue('logo_image_mobile') !== '') {
            $logo_image = chillnews_mikado_options()->getOptionValue('logo_image_mobile');
        } else {
            $logo_image = chillnews_mikado_options()->getOptionValue('logo_image');
        }

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = chillnews_mikado_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px'; //divided with 2 because of retina screens
        }

        //set parameters for logo
        $parameters = array(
            'logo_image'      => $logo_image,
            'logo_dimensions' => $logo_dimensions,
            'logo_height'     => $logo_height,
            'logo_styles'     => $logo_styles
        );

        chillnews_mikado_get_module_template_part('templates/parts/mobile-logo', 'header', $slug, $parameters);
    }
}

if(!function_exists('chillnews_mikado_get_mobile_nav')) {
    /**
     * Loads mobile navigation HTML
     */
    function chillnews_mikado_get_mobile_nav() {

        $slug = 'header-type3';

        chillnews_mikado_get_module_template_part('templates/parts/mobile-navigation', 'header', $slug);
    }
}