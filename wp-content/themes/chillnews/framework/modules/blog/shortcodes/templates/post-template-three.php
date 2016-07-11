<div class="mkdf-pt-three-item mkdf-post-item">
    <div class="mkdf-pt-three-item-inner">
        <div class="mkdf-pt-three-item-inner2">
            <?php if(has_post_thumbnail()){ ?>
                <div class="mkdf-pt-three-image-holder">
                    <a itemprop="url" class="mkdf-pt-three-link mkdf-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                    <?php
                    if($thumb_image_size != 'custom_size') {
                        echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
                    }
                    elseif($thumb_image_width != '' && $thumb_image_height != ''){
                        echo chillnews_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$thumb_image_width,$thumb_image_height);
                    }
                    ?>
                    </a>
                </div>
            <?php } ?>
            <div class="mkdf-pt-three-content-holder">
                <<?php echo esc_html( $title_tag)?> class="mkdf-pt-three-title <?php echo chillnews_mikado_has_title_substring($title_length) ?>">
                <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo chillnews_mikado_get_title_substring($title_length) ?></a>
                </<?php echo esc_html($title_tag) ?>>
                <div class="mkdf-pt-three-info-section">
                    <?php chillnews_mikado_post_info_date(array(
                        'date' => $display_date,
                        'date_format' => $date_format
                    )) ?>
                    <?php chillnews_mikado_post_info_author(array(
                        'author' => $display_author
                    )) ?>
                    <?php chillnews_mikado_post_info_category(array(
                        'category' => $display_category
                    )); ?>
                </div>
            </div>
        </div>
    </div>
</div>