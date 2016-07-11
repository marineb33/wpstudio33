<div class="mkdf-pt-seven-item mkdf-post-item">
    <div class="mkdf-pt-seven-item-inner">
        <?php if(has_post_thumbnail()){ ?>
            <div class="mkdf-pt-seven-image-holder">
                <a itemprop="url" class="mkdf-pt-seven-link mkdf-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                    <?php
                        echo chillnews_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$thumb_image_width,$thumb_image_height);
                    ?>
                </a>
            </div>
        <?php } ?>
        <div class="mkdf-pt-seven-content-holder">
            <<?php echo esc_html( $title_tag)?> class="mkdf-pt-seven-title <?php echo chillnews_mikado_has_title_substring($title_length) ?>">
                <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo chillnews_mikado_get_title_substring($title_length) ?></a>
            </<?php echo esc_html($title_tag) ?>>
            <div class="mkdf-pt-seven-info-section">
                <?php chillnews_mikado_post_info_date(array(
                    'date' => $display_date,
                    'date_format' => $date_format
                )) ?>
                <?php chillnews_mikado_post_info_author(array(
                    'author' => $display_author
                )) ?>
            </div>
        </div>
    </div>
</div>