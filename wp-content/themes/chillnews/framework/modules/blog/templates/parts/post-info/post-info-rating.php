<?php $post_rating = chillnews_mikado_get_post_rating(); ?>
<div class="mkdf-post-info-rating">
    <span class="mkdf-post-info-rating-inactive">
        <span class="mkdf-post-info-rating-active" style="width: <?php echo esc_attr($post_rating) ?>%"></span>
    </span>
    <div class="mkdf-post-info-rating-value"></div>
    <div class="mkdf-post-info-rating-message"></div>
</div>