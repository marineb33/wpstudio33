<?php

if(!function_exists('chillnews_mikado_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function chillnews_mikado_register_sidebars() {

        register_sidebar(array(
            'name' => 'Sidebar',
            'id' => 'sidebar',
            'description' => 'Default Sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h6>',
            'after_title' => '</h6>'
        ));

    }

    add_action('widgets_init', 'chillnews_mikado_register_sidebars');
}

if(!function_exists('chillnews_mikado_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates ChillNewsSidebar object
     */
    function chillnews_mikado_add_support_custom_sidebar() {
        add_theme_support('ChillNewsSidebar');
        if (get_theme_support('ChillNewsSidebar')) new ChillNewsSidebar();
    }

    add_action('after_setup_theme', 'chillnews_mikado_add_support_custom_sidebar');
}
