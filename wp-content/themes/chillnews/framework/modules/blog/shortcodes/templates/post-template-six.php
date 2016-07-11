<div class="mkdf-pt-six-item mkdf-post-item">
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="mkdf-pt-six-image-holder">
            <a itemprop="url" class="mkdf-pt-six-slide-link mkdf-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                <?php
                if($thumb_image_size != 'custom_size') {
                    echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
                }
                elseif($thumb_image_width != '' && $thumb_image_height != ''){
                    echo chillnews_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$thumb_image_width,$thumb_image_height);
                }
                chillnews_mikado_post_info_type(array(
                    'icon' => 'yes',
                )) ?>
            </a>
        </div>
    <?php } ?>
    <div class="mkdf-pt-six-content-holder">
        <div class="mkdf-pt-six-title-holder">
            <<?php echo esc_html($title_tag)?> class="mkdf-pt-six-title <?php echo chillnews_mikado_has_title_substring($title_length) ?>">
                <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo chillnews_mikado_get_title_substring($title_length) ?></a>
            </<?php echo esc_html($title_tag) ?>>
        </div>
    </div>
    <?php if($display_date == 'yes' || $display_comments == 'yes' || $display_like == 'yes'){ ?>
    <div class="mkdf-pt-six-info-section">
        <?php chillnews_mikado_post_info_date(array(
            'date' => $display_date,
            'date_format' => $date_format
        )) ?>
    </div>
    <?php } ?>
</div>