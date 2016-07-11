<?php
/**
 * Section Table shortcode template
 */
?>
<div class="mkdf-section-title-holder clearfix">
    <?php if($title !== '') { ?>
        <?php echo '<'.esc_html($title_tag) ?> class="mkdf-st-title">
        <?php echo esc_attr($title); ?>
        <?php echo '</'.esc_html($title_tag) ?>>
    <?php } ?>
</div>