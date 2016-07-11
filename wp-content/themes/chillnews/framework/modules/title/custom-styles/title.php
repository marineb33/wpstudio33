<?php

if (!function_exists('chillnews_mikado_title_area_typography_style')) {

    function chillnews_mikado_title_area_typography_style(){

        $breadcrumb_styles = array();

        if(chillnews_mikado_options()->getOptionValue('page_breadcrumb_color') !== '') {
            $breadcrumb_styles['color'] = chillnews_mikado_options()->getOptionValue('page_breadcrumb_color');
        }
        if(chillnews_mikado_options()->getOptionValue('page_breadcrumb_google_fonts') !== '-1') {
            $breadcrumb_styles['font-family'] = chillnews_mikado_get_formatted_font_family(chillnews_mikado_options()->getOptionValue('page_breadcrumb_google_fonts'));
        }
        if(chillnews_mikado_options()->getOptionValue('page_breadcrumb_fontsize') !== '') {
            $breadcrumb_styles['font-size'] = chillnews_mikado_options()->getOptionValue('page_breadcrumb_fontsize').'px';
        }
        if(chillnews_mikado_options()->getOptionValue('page_breadcrumb_lineheight') !== '') {
            $breadcrumb_styles['line-height'] = chillnews_mikado_options()->getOptionValue('page_breadcrumb_lineheight').'px';
        }
        if(chillnews_mikado_options()->getOptionValue('page_breadcrumb_texttransform') !== '') {
            $breadcrumb_styles['text-transform'] = chillnews_mikado_options()->getOptionValue('page_breadcrumb_texttransform');
        }
        if(chillnews_mikado_options()->getOptionValue('page_breadcrumb_fontstyle') !== '') {
            $breadcrumb_styles['font-style'] = chillnews_mikado_options()->getOptionValue('page_breadcrumb_fontstyle');
        }
        if(chillnews_mikado_options()->getOptionValue('page_breadcrumb_fontweight') !== '') {
            $breadcrumb_styles['font-weight'] = chillnews_mikado_options()->getOptionValue('page_breadcrumb_fontweight');
        }
        if(chillnews_mikado_options()->getOptionValue('page_breadcrumb_letter_spacing') !== '') {
            $breadcrumb_styles['letter-spacing'] = chillnews_mikado_options()->getOptionValue('page_breadcrumb_letter_spacing').'px';
        }

        $breadcrumb_selector = array(
            '.mkdf-title .mkdf-title-holder .mkdf-breadcrumbs a, .mkdf-title .mkdf-title-holder .mkdf-breadcrumbs span'
        );

        echo chillnews_mikado_dynamic_css($breadcrumb_selector, $breadcrumb_styles);

        $breadcrumb_selector_styles = array();
        if(chillnews_mikado_options()->getOptionValue('page_breadcrumb_hovercolor') !== '') {
            $breadcrumb_selector_styles['color'] = chillnews_mikado_options()->getOptionValue('page_breadcrumb_hovercolor');
        }

        $breadcrumb_hover_selector = array(
            '.mkdf-title .mkdf-title-holder .mkdf-breadcrumbs a:hover'
        );

        echo chillnews_mikado_dynamic_css($breadcrumb_hover_selector, $breadcrumb_selector_styles);

    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_title_area_typography_style');

}


