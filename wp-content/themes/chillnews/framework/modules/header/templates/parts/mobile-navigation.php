<?php do_action('chillnews_mikado_before_mobile_navigation'); ?>

<nav class="mkdf-mobile-nav">
    <div class="mkdf-grid">
        <?php wp_nav_menu(array(
            'theme_location' => 'mobile-navigation' ,
            'container'  => '',
            'container_class' => '',
            'menu_class' => '',
            'menu_id' => '',
            'fallback_cb' => 'chillnews_mikado_mobile_navigation_fallback',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'walker' => new ChillNewsMobileNavigationWalker()
        )); ?>
    </div>
</nav>

<?php
    /* If menu not exist, show fallback function */
    function chillnews_mikado_mobile_navigation_fallback() {
        print '<ul id="menu-mobile_menu"><li class="menu-item"><a href="'.esc_url(home_url('/')).'wp-admin/nav-menus.php?action=locations">'.esc_html__('Click here - to select or create a mobile menu','chillnews').'</a></li></ul>';
    }
?>

<?php do_action('chillnews_mikado_after_mobile_navigation'); ?>