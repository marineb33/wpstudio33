<?php do_action('chillnews_mikado_before_page_header'); ?>

<header class="mkdf-page-header">
    <div class="mkdf-logo-area">
        <?php if($bottom_header_area_in_grid) : ?>
        <div class="mkdf-grid">
        <?php endif; ?>
        <div class="mkdf-vertical-align-containers">
            <div class="mkdf-position-left">
                <div class="mkdf-position-left-inner">
                    <?php if(!$hide_logo) {
                        chillnews_mikado_get_logo();
                    } ?>
                </div>
            </div>
            <div class="mkdf-position-right">
                <div class="mkdf-position-right-inner">
                    <?php if(is_active_sidebar('mkdf-header-banner')) : ?>
                        <?php dynamic_sidebar('mkdf-header-banner'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if($bottom_header_area_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <?php if($show_fixed_wrapper) : ?>
        <?php if($show_nav_search) { ?>
        <div class="mkdf-fixed-wrapper mkdf-search">
        <?php } else { ?>
        <div class="mkdf-fixed-wrapper mkdf-no-search">
        <?php } ?>
    <?php endif; ?>
    <div class="mkdf-menu-area">
        <?php if($bottom_header_area_in_grid) : ?>
        <div class="mkdf-grid">
        <?php endif; ?>
        <div class="mkdf-vertical-align-containers">
            <?php if(!$hide_logo) { ?>
                <div class="mkdf-fixed-logo-holder">
                    <?php chillnews_mikado_get_logo(); ?>
                </div>
            <?php } ?>
            <div class="mkdf-position-left">
                <div class="mkdf-position-left-inner">
                    <?php chillnews_mikado_get_main_menu(); ?>
                </div>
            </div>
            <div class="mkdf-position-right">
                <div class="mkdf-position-right-inner">
                    <?php if($show_nav_search) { ?>
                    <form class="mkdf-search-menu-holder" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                        <div class="mkdf-form-holder">
                            <div class="mkdf-column-left">
                                <input type="text" placeholder="<?php esc_html_e('Search...', 'chillnews'); ?>" name="s" class="mkdf-search-field" autocomplete="off" />
                            </div>
                            <div class="mkdf-column-right">
                                <button class="mkdf-search-submit" type="submit" value="Search"><span class="ion-android-search"></span></button>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php if($bottom_header_area_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <?php if($show_fixed_wrapper) : ?>
        </div>
    <?php endif; ?>
</header>

<?php do_action('chillnews_mikado_after_page_header'); ?>