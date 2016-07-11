<div class="mkdf-pt-nine-item mkdf-post-item">
    <div class="mkdf-pt-nine-item-inner">
        <?php if(has_post_thumbnail()){ ?>
            <div class="mkdf-pt-nine-image-holder">
                <a itemprop="url" class="mkdf-pt-nine-link mkdf-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self" ></a>
                <span class="mkdf-pt-nine-image-holder-inner" <?php chillnews_mikado_inline_style($image_style); ?>>   
                <?php
                    echo chillnews_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$thumb_image_width,$thumb_image_height);
                ?>
                </span> 
            </div>
        <?php } ?>
        <div class="mkdf-pt-nine-content-holder">
            <<?php echo esc_html( $title_tag)?> class="mkdf-pt-nine-title <?php echo chillnews_mikado_has_title_substring($title_length) ?>">
            <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo chillnews_mikado_get_title_substring($title_length) ?></a>
            </<?php echo esc_html($title_tag) ?>>
        </div>
    </div>
</div>