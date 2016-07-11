<div class="mkdf-pt-one-item mkdf-post-item">
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="mkdf-pt-one-image-holder">
            <?php
            chillnews_mikado_post_info_category(array(
                'category' => $display_category
            )); ?>
            <?php chillnews_mikado_post_info_share(array(
                'share' => $display_social_share
            )) ?>
            <div class="mkdf-pt-one-image-inner-holder">
                <a itemprop="url" class="mkdf-pt-one-slide-link mkdf-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
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
        </div>
    <?php } ?>
    <?php if($display_date == 'yes' || $display_comments == 'yes' || $display_like == 'yes'){ ?>
    <div class="mkdf-pt-one-info-section">
        <?php chillnews_mikado_post_info_date(array(
            'date' => $display_date,
            'date_format' => $date_format
        )) ?>
        <?php
        chillnews_mikado_post_info_comments(array(
            'comments' => $display_comments,
            'type' => 'icon'
        )) ?>
        <?php chillnews_mikado_post_info_author(array(
            'author' => $display_author
        )) ?>
        <?php chillnews_mikado_post_info_like(array(
            'like' => $display_like
        )) ?>
    </div>
    <?php } ?>
    <div class="mkdf-pt-one-content-holder">
        <div class="mkdf-pt-one-title-holder">
            <<?php echo esc_html($title_tag)?> class="mkdf-pt-one-title <?php echo chillnews_mikado_has_title_substring($title_length) ?>" >
            <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo chillnews_mikado_get_title_substring($title_length) ?></a>
        </<?php echo esc_html($title_tag) ?>>
        </div>
        <?php if($display_excerpt == 'yes'){ ?>
            <div class="mkdf-pt-one-excerpt">
                <?php chillnews_mikado_excerpt($excerpt_length); ?>
            </div>
        <?php } ?>
        <?php chillnews_mikado_post_info_rating(array(
            'rating' => $display_rating
        )) ?>
        <?php if($display_button == 'yes'){ ?>
            <div class="mkdf-pt-one-button">
                <?php chillnews_mikado_read_more_button('', '', $button_text); ?>
            </div>
        <?php } ?>
    </div>
</div>