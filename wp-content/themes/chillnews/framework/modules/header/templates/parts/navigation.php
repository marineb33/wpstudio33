<?php do_action('chillnews_mikado_before_top_navigation'); ?>

<nav class="mkdf-main-menu mkdf-drop-down <?php echo esc_attr($additional_class); ?>">
    <?php wp_nav_menu( array(
        'theme_location' => 'main-navigation' ,
        'container'  => '',
        'container_class' => '',
        'menu_class' => 'clearfix',
        'menu_id' => '',
        'fallback_cb' => 'chillnews_mikado_top_navigation_fallback',
        'link_before' => '<span>',
        'link_after' => '</span>',
        'walker' => new ChillNewsTopNavigationWalker()
    )); ?>
</nav>

<?php
    /* If menu not exist, show fallback function */
    function chillnews_mikado_top_navigation_fallback() {
        print '<ul id="menu-main_menu"><li class="menu-item menu-item-first"><a href="'.esc_url(home_url('/')).'wp-admin/nav-menus.php?action=locations">'.esc_html__('Click here - to select or create a menu','chillnews').'</a></li></ul>';
    }
?>

<?php do_action('chillnews_mikado_after_top_navigation'); ?>