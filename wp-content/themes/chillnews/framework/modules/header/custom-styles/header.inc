<?php

if(!function_exists('chillnews_mikado_header_top_bar_styles')) {
    /**
     * Generates styles for header top bar
     */
    function chillnews_mikado_header_top_bar_styles() {
        global $chillnews_mikado_global_options;

        $background_color = chillnews_mikado_options()->getOptionValue('top_bar_background_color');
        $top_bar_styles = array();
        if($background_color !== '') {
            $top_bar_styles['background-color'] = $background_color;
        }

        echo chillnews_mikado_dynamic_css('.mkdf-top-bar', $top_bar_styles);
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_header_top_bar_styles');
}

if(!function_exists('chillnews_mikado_header_top_bar_responsive_styles')) {
    /**
     * Generates styles for header top bar
     */
    function chillnews_mikado_header_top_bar_responsive_styles() {
        global $chillnews_mikado_global_options;

        $top_bar_responsive_styles = array();
        $hide_top_bar_on_mobile = chillnews_mikado_options()->getOptionValue('hide_top_bar_on_mobile');

        if($hide_top_bar_on_mobile === 'yes') { ?>
            @media only screen and (max-width: 700px) {
                .mkdf-top-bar {
                    height: 0;
                    display: none;
                }
            }
        <?php }
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_header_top_bar_responsive_styles');
}

if(!function_exists('chillnews_mikado_header_type3_logo_styles')) {
    /**
     * Generates styles for header type 3 logo
     */
    function chillnews_mikado_header_type3_logo_styles() {
        global $chillnews_mikado_global_options;

        $logo_area_header_type3_styles = array();

        if($chillnews_mikado_global_options['logo_area_height_header_type3'] !== '') {
            $logo_area_header_type3_styles['height'] = chillnews_mikado_filter_px($chillnews_mikado_global_options['logo_area_height_header_type3']).'px';
        }

        echo chillnews_mikado_dynamic_css('.mkdf-header-type3 .mkdf-page-header .mkdf-logo-area', $logo_area_header_type3_styles);

        $logo_area_header_link_styles = array();

        if($chillnews_mikado_global_options['logo_area_height_header_type3'] !== '') {
            $logo_area_header_link_styles['max-height'] = chillnews_mikado_filter_px($chillnews_mikado_global_options['logo_area_height_header_type3']).'px';
        }

        echo chillnews_mikado_dynamic_css('.mkdf-page-header .mkdf-logo-wrapper a', $logo_area_header_link_styles);
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_header_type3_logo_styles');
}

if(!function_exists('chillnews_mikado_header_type3_menu_area_styles')) {
    /**
     * Generates styles for header type 3 menu area
     */
    function chillnews_mikado_header_type3_menu_area_styles() {
        global $chillnews_mikado_global_options;

        $menu_area_header_type3_styles = array();

        if($chillnews_mikado_global_options['menu_area_height_header_type3'] !== '') {
            $menu_area_header_type3_styles['height'] = chillnews_mikado_filter_px($chillnews_mikado_global_options['menu_area_height_header_type3']).'px';
        }

        echo chillnews_mikado_dynamic_css('.mkdf-header-type3 .mkdf-page-header .mkdf-menu-area', $menu_area_header_type3_styles);
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_header_type3_menu_area_styles');
}

if(!function_exists('chillnews_mikado_fixed_header_styles')) {
    /*          
     * Generates styles for fixed header
     */
    function chillnews_mikado_fixed_header_styles() {

        global $chillnews_mikado_global_options;

        if($chillnews_mikado_global_options['fixed_header_background_color'] !== '') {

            $fixed_header_background_color              = $chillnews_mikado_global_options['fixed_header_background_color'];
            $fixed_header_background_color_transparency = 1;

            if($chillnews_mikado_global_options['fixed_header_background_color_transparency'] !== '') {
                $fixed_header_background_color_transparency = $chillnews_mikado_global_options['fixed_header_background_color_transparency'];
            }

            echo chillnews_mikado_dynamic_css('.mkdf-page-header .mkdf-fixed-wrapper.mkdf-fixed .mkdf-fixed-logo-holder,
                                                 .mkdf-page-header .mkdf-fixed-wrapper.mkdf-fixed .mkdf-menu-area .mkdf-position-left',
                array('background-color' => chillnews_mikado_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency)));
            }

            $fixed_menu_item_styles = array();
            if($chillnews_mikado_global_options['fixed_color'] !== '') {
                $fixed_menu_item_styles['color'] = $chillnews_mikado_global_options['fixed_color'];
            }
            if($chillnews_mikado_global_options['fixed_google_fonts'] !== '-1') {
                $fixed_menu_item_styles['font-family'] = chillnews_mikado_get_formatted_font_family($chillnews_mikado_global_options['fixed_google_fonts']);
            }
            if($chillnews_mikado_global_options['fixed_fontsize'] !== '') {
                $fixed_menu_item_styles['font-size'] = $chillnews_mikado_global_options['fixed_fontsize'].'px';
            }
            if($chillnews_mikado_global_options['fixed_lineheight'] !== '') {
                $fixed_menu_item_styles['line-height'] = $chillnews_mikado_global_options['fixed_lineheight'].'px';
            }
            if($chillnews_mikado_global_options['fixed_texttransform'] !== '') {
                $fixed_menu_item_styles['text-transform'] = $chillnews_mikado_global_options['fixed_texttransform'];
            }
            if($chillnews_mikado_global_options['fixed_fontstyle'] !== '') {
                $fixed_menu_item_styles['font-style'] = $chillnews_mikado_global_options['fixed_fontstyle'];
            }
            if($chillnews_mikado_global_options['fixed_fontweight'] !== '') {
                $fixed_menu_item_styles['font-weight'] = $chillnews_mikado_global_options['fixed_fontweight'];
            }
            if($chillnews_mikado_global_options['fixed_letterspacing'] !== '') {
                $fixed_menu_item_styles['letter-spacing'] = $chillnews_mikado_global_options['fixed_letterspacing'].'px';
            }

            $fixed_menu_item_selector = array(
                '.mkdf-fixed-wrapper.mkdf-fixed .mkdf-main-menu > ul > li > a'
            );

            echo chillnews_mikado_dynamic_css($fixed_menu_item_selector, $fixed_menu_item_styles);

            $fixed_menu_item_hover_styles = array();
            if($chillnews_mikado_global_options['fixed_hovercolor'] !== '') {
                $fixed_menu_item_hover_styles['color'] = $chillnews_mikado_global_options['fixed_hovercolor'];
            }

            $fixed_menu_item_hover_selector = array(
                '.mkdf-fixed-wrapper.mkdf-fixed .mkdf-main-menu > ul > li:hover > a',
                '.mkdf-fixed-wrapper.mkdf-fixed .mkdf-main-menu > ul > li.mkdf-active-item:hover > a'
            );

            echo chillnews_mikado_dynamic_css($fixed_menu_item_hover_selector, $fixed_menu_item_hover_styles);

    }
    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_fixed_header_styles');
}

if(!function_exists('chillnews_mikado_main_menu_styles')) {
    /**
     * Generates styles for main menu
     */
    function chillnews_mikado_main_menu_styles() {
        global $chillnews_mikado_global_options;

        if($chillnews_mikado_global_options['menu_color'] !== '' || $chillnews_mikado_global_options['menu_fontsize'] != '' || $chillnews_mikado_global_options['menu_lineheight'] != '' || $chillnews_mikado_global_options['menu_fontstyle'] !== '' || $chillnews_mikado_global_options['menu_fontweight'] !== '' || $chillnews_mikado_global_options['menu_texttransform'] !== '' || $chillnews_mikado_global_options['menu_letterspacing'] !== '' || $chillnews_mikado_global_options['menu_google_fonts'] != "-1") { ?>
            .mkdf-main-menu.mkdf-default-nav > ul > li > a {
            <?php if($chillnews_mikado_global_options['menu_color']) { ?> color: <?php echo esc_attr($chillnews_mikado_global_options['menu_color']); ?>; <?php } ?>
            <?php if($chillnews_mikado_global_options['menu_google_fonts'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $chillnews_mikado_global_options['menu_google_fonts'])); ?>', sans-serif;
            <?php } ?>
            <?php if($chillnews_mikado_global_options['menu_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($chillnews_mikado_global_options['menu_fontsize']); ?>px; <?php } ?>
            <?php if($chillnews_mikado_global_options['menu_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($chillnews_mikado_global_options['menu_lineheight']); ?>px; <?php } ?>
            <?php if($chillnews_mikado_global_options['menu_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($chillnews_mikado_global_options['menu_fontstyle']); ?>; <?php } ?>
            <?php if($chillnews_mikado_global_options['menu_fontweight'] !== '') { ?> font-weight: <?php echo esc_attr($chillnews_mikado_global_options['menu_fontweight']); ?>; <?php } ?>
            <?php if($chillnews_mikado_global_options['menu_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($chillnews_mikado_global_options['menu_texttransform']); ?>;  <?php } ?>
            <?php if($chillnews_mikado_global_options['menu_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($chillnews_mikado_global_options['menu_letterspacing']); ?>px; <?php } ?>
            }
        <?php } ?>

        <?php if($chillnews_mikado_global_options['menu_hovercolor'] !== '') { ?>
            .mkdf-main-menu.mkdf-default-nav > ul > li:hover > a,
            .mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item:hover > a {
                color: <?php echo esc_attr($chillnews_mikado_global_options['menu_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if($chillnews_mikado_global_options['menu_activecolor'] !== '') { ?>
            .mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item > a {
                color: <?php echo esc_attr($chillnews_mikado_global_options['menu_activecolor']); ?>;
            }
        <?php } ?>

        <?php if($chillnews_mikado_global_options['menu_text_background_color'] !=='') { ?>
            .mkdf-main-menu.mkdf-default-nav > ul > li > a {
                background-color: <?php echo esc_attr($chillnews_mikado_global_options['menu_text_background_color']); ?>;
            }
        <?php } ?>

        <?php if($chillnews_mikado_global_options['menu_hover_background_color'] !== '') { ?>
            
            .mkdf-main-menu.mkdf-default-nav > ul > li:hover > a ,
            .mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item:hover > a {
                background-color: <?php echo esc_attr($chillnews_mikado_global_options['menu_hover_background_color']); ?>;
            }
        <?php } ?>

        <?php if($chillnews_mikado_global_options['menu_active_background_color'] !== '') { ?>

            .mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item > a {
                background-color: <?php echo esc_attr($chillnews_mikado_global_options['menu_active_background_color']); ?>;
            }
        <?php }
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_main_menu_styles');
}