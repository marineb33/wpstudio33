<?php do_action('chillnews_mikado_before_site_logo'); ?>

<div class="mkdf-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php chillnews_mikado_inline_style($logo_styles); ?>>
        <img class="mkdf-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('logo','chillnews'); ?>"/>
        <?php if(!empty($logo_image_fixed)){ ?><img class="mkdf-fixed-logo" src="<?php echo esc_url($logo_image_fixed); ?>" alt="fixed logo"/><?php } ?>
    </a>
</div>

<?php do_action('chillnews_mikado_after_site_logo'); ?>