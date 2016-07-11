<?php

if(!function_exists('chillnews_mikado_header_register_main_navigation')) {
    /**
     * Registers main navigation and mobile navigation
     */
    function chillnews_mikado_header_register_main_navigation() {
        register_nav_menus(
            array(
                'main-navigation' => esc_html__('Main Navigation', 'chillnews'),
                'mobile-navigation' => esc_html__('Mobile Navigation', 'chillnews')
            )
        );
    }

    add_action('after_setup_theme', 'chillnews_mikado_header_register_main_navigation');
}

if(!function_exists('chillnews_mikado_is_top_bar_transparent')) {
    /**
     * Checks if top bar is transparent or not
     *
     * @return bool
     */
    function chillnews_mikado_is_top_bar_transparent() {
        $top_bar_enabled = chillnews_mikado_is_top_bar_enabled();

        $top_bar_bg_color = chillnews_mikado_options()->getOptionValue('top_bar_background_color');
        $top_bar_transparency = chillnews_mikado_options()->getOptionValue('top_bar_background_transparency');

        if($top_bar_enabled && $top_bar_bg_color !== '' && $top_bar_transparency !== '') {
            return $top_bar_transparency >= 0 && $top_bar_transparency < 1;
        }

        return false;
    }
}

if(!function_exists('chillnews_mikado_is_top_bar_completely_transparent')) {
    function chillnews_mikado_is_top_bar_completely_transparent() {
        $top_bar_enabled = chillnews_mikado_is_top_bar_enabled();

        $top_bar_bg_color = chillnews_mikado_options()->getOptionValue('top_bar_background_color');
        $top_bar_transparency = chillnews_mikado_options()->getOptionValue('top_bar_background_transparency');

        if($top_bar_enabled && $top_bar_bg_color !== '' && $top_bar_transparency !== '') {
            return $top_bar_transparency === '0';
        }

        return false;
    }
}

if(!function_exists('chillnews_mikado_is_top_bar_enabled')) {
    function chillnews_mikado_is_top_bar_enabled() {
        $top_bar_enabled = chillnews_mikado_options()->getOptionValue('top_bar') == 'yes';

        return $top_bar_enabled;
    }
}

if(!function_exists('chillnews_mikado_get_top_bar_height')) {
    /**
     * Returns top bar height
     *
     * @return bool|int|void
     */
    function chillnews_mikado_get_top_bar_height() {
        if(chillnews_mikado_is_top_bar_enabled()) {

            return 33;
        }

        return 0;
    }
}