<?php do_action('chillnews_mikado_before_page_title'); ?>
<?php if($show_title_area) { ?>

    <div class="mkdf-title mkdf-breadcrumbs-type <?php echo chillnews_mikado_title_classes(); ?>" style="<?php echo esc_attr($title_height); echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
        <div class="mkdf-title-image"><?php if($title_background_image_src != ""){ ?><img src="<?php echo esc_url($title_background_image_src); ?>" alt="&nbsp;" /> <?php } ?></div>
        <div class="mkdf-title-holder" <?php chillnews_mikado_inline_style($title_holder_height); ?>>
            <div class="mkdf-container clearfix">
                <div class="mkdf-container-inner">
                    <div class="mkdf-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
                        <div class="mkdf-title-subtitle-holder-inner">
                            <div class="mkdf-breadcrumbs-holder"> <?php chillnews_mikado_custom_breadcrumbs(); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<?php do_action('chillnews_mikado_after_page_title'); ?>