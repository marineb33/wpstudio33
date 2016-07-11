<div class="mkdf-pt-eight-item mkdf-post-item">
    <div class="mkdf-pt-eight-item-inner">
        <div class="mkdf-pt-eight-item-inner2">
            <div class="mkdf-pt-eight-image-holder">
                <?php if(has_post_thumbnail()){ ?>
                    <div class="mkdf-pt-eight-image">
                        <a itemprop="url" class="mkdf-pt-eight-link mkdf-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                        <?php
                        if($thumb_image_size != 'custom_size') {
                            echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
                        } elseif($thumb_image_width != '' && $thumb_image_height != ''){
                            echo chillnews_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$thumb_image_width,$thumb_image_height);
                        }
                        ?>
                        </a>
                        <?php chillnews_mikado_post_info_category(array(
                            'category' => $display_category
                        )) ?>
                        <div class="mkdf-pt-eight-content">
                            <div class="mkdf-pt-eight-info">
                                <?php chillnews_mikado_post_info_date(array(
                                    'date' => $display_date,
                                    'date_format' => $date_format
                                )) ?>
                                <?php chillnews_mikado_post_info_author(array(
                                    'author' => $display_author
                                )) ?>
                                <?php chillnews_mikado_post_info_comments(array(
                                    'comments' => $display_comments
                                )) ?>
                            </div>
                            <?php chillnews_mikado_post_info_share(array(
                                'share' => $display_social_share
                            )) ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="mkdf-pt-eight-content-holder">
                <<?php echo esc_html( $title_tag)?> class="mkdf-pt-eight-title <?php echo chillnews_mikado_has_title_substring($title_length) ?>">
                    <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo chillnews_mikado_get_title_substring($title_length) ?></a>
                </<?php echo esc_html($title_tag) ?>>
                <?php if($display_excerpt == 'yes'){ ?>
                    <div class="mkdf-pt-eight-excerpt">
                        <?php chillnews_mikado_excerpt($excerpt_length); ?>
                    </div>
                <?php } ?>
                <?php if($display_button == 'yes'){ ?>
                    <div class="mkdf-pt-eight-button">
                        <?php chillnews_mikado_read_more_button('', '', $button_text); ?>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>