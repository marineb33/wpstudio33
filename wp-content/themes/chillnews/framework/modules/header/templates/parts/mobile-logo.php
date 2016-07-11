<?php do_action('chillnews_mikado_before_mobile_logo'); ?>

<div class="mkdf-mobile-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php chillnews_mikado_inline_style($logo_styles); ?>>
        <img src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('mobile-logo','chillnews'); ?>"/>
    </a>
</div>

<?php do_action('chillnews_mikado_after_mobile_logo'); ?>