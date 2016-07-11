<?php
$categories = get_the_category();
$output = '';
if (!empty($categories)) {
    foreach( $categories as $category ) {
        $output .= esc_html($category->name);
        break;
    }
}

?>
<li class="mkdf-psi-slide"
    data-thumb="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id()))?>"
    data-posttitle="<?php echo esc_attr(get_the_title()) ?>"
    <?php if($display_category == 'yes'){ ?>
        data-postcategory="<?php echo esc_attr($output); ?>"
    <?php } ?>
    <?php if($display_author == 'yes'){ ?>
        data-postauthor="<?php echo esc_attr(the_author_meta('display_name')); ?>"
    <?php } ?>
    <?php if($display_date == 'yes'){ ?>
        data-postdate="<?php echo esc_attr(the_time($date_format));?>"
    <?php } ?>
    >
    <div class="mkdf-psi-image-holder">
        <a itemprop="url" class="mkdf-psi-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
            <?php
                if($thumb_image_size != 'custom_size') {
                    echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
                } elseif($thumb_image_width != '' && $thumb_image_height != ''){
                    echo chillnews_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$thumb_image_width,$thumb_image_height);
                }
            ?>
            <div class="mkdf-psi-image-holder-overlay"></div>
        </a>
    </div>
    <div class="mkdf-psi-content">
        <<?php echo esc_html($title_tag)?> class="mkdf-psi-title">
            <a itemprop="url" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo esc_attr(get_the_title()) ?></a>
        </<?php echo esc_html($title_tag) ?>>
    </div>
</li>