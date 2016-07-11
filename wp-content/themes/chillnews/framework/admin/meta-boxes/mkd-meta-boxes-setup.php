<?php

add_action('after_setup_theme', 'chillnews_mikado_meta_boxes_map_init', 1);
function chillnews_mikado_meta_boxes_map_init() {
    /**
    * Loades all meta-boxes by going through all folders that are placed directly in meta-boxes folder
    * and loads map.php file in each.
    *
    * @see http://php.net/manual/en/function.glob.php
    */

    do_action('chillnews_mikado_before_meta_boxes_map');

	global $chillnews_mikado_global_options;
	global $chillnews_mikado_global_Framework;
	global $chillnews_mikado_global_options_fontstyle;
	global $chillnews_mikado_global_options_fontweight;
	global $chillnews_mikado_global_options_texttransform;
	global $chillnews_mikado_global_options_fontdecoration;
	global $chillnews_mikado_global_options_arrows_type;

    foreach(glob(MIKADO_FRAMEWORK_ROOT_DIR.'/admin/meta-boxes/*/map.php') as $meta_box_load) {
        include_once $meta_box_load;
    }

	do_action('chillnews_mikado_meta_boxes_map');

	do_action('chillnews_mikado_after_meta_boxes_map');
}