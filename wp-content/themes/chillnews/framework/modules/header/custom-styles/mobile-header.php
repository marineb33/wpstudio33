<?php

if(!function_exists('chillnews_mikado_mobile_header_general_styles')) {
    /**
     * Generates general custom styles for mobile header
     */
    function chillnews_mikado_mobile_header_general_styles() {
        $mobile_header_styles = array();
        if(chillnews_mikado_options()->getOptionValue('mobile_header_height') !== '') {
            $mobile_header_styles['height'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('mobile_header_height')).'px';
        }

        if(chillnews_mikado_options()->getOptionValue('mobile_header_background_color')) {
            $mobile_header_styles['background-color'] = chillnews_mikado_options()->getOptionValue('mobile_header_background_color');
        }

        echo chillnews_mikado_dynamic_css('.mkdf-mobile-header .mkdf-mobile-header-inner', $mobile_header_styles);
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_mobile_header_general_styles');
}

if(!function_exists('chillnews_mikado_mobile_logo_styles')) {
    /**
     * Generates styles for mobile logo
     */
    function chillnews_mikado_mobile_logo_styles() {
        if(chillnews_mikado_options()->getOptionValue('mobile_logo_height') !== '') { ?>
            @media only screen and (max-width: 1000px) {
            <?php echo chillnews_mikado_dynamic_css(
                '.mkdf-mobile-header .mkdf-mobile-logo-wrapper a',
                array('height' => chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('mobile_logo_height')).'px !important')
            ); ?>
            }
        <?php }

        if(chillnews_mikado_options()->getOptionValue('mobile_logo_height_phones') !== '') { ?>
            @media only screen and (max-width: 480px) {
            <?php echo chillnews_mikado_dynamic_css(
                '.mkdf-mobile-header .mkdf-mobile-logo-wrapper a',
                array('height' => chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('mobile_logo_height_phones')).'px !important')
            ); ?>
            }
        <?php }
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_mobile_logo_styles');
}

if(!function_exists('chillnews_mikado_mobile_icon_styles')) {
    /**
     * Generates styles for mobile icon opener
     */
    function chillnews_mikado_mobile_icon_styles() {
        $mobile_icon_styles = array();
        if(chillnews_mikado_options()->getOptionValue('mobile_icon_color') !== '') {
            $mobile_icon_styles['color'] = chillnews_mikado_options()->getOptionValue('mobile_icon_color');
        }

        if(chillnews_mikado_options()->getOptionValue('mobile_icon_size') !== '') {
            $mobile_icon_styles['font-size'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('mobile_icon_size')).'px';
        }

        echo chillnews_mikado_dynamic_css('.mkdf-mobile-header .mkdf-mobile-menu-opener a', $mobile_icon_styles);

        if(chillnews_mikado_options()->getOptionValue('mobile_icon_hover_color') !== '') {
            echo chillnews_mikado_dynamic_css(
                '.mkdf-mobile-header .mkdf-mobile-menu-opener a:hover',
                array('color' => chillnews_mikado_options()->getOptionValue('mobile_icon_hover_color')));
        }
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_mobile_icon_styles');
}