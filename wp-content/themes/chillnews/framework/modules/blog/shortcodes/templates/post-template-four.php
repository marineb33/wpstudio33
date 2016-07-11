<div class="mkdf-pt-four-item mkdf-post-item">
    <div class="mkdf-pt-four-item-inner">
        <div class="mkdf-pt-four-content-holder">
            <<?php echo esc_html( $title_tag)?> class="mkdf-pt-four-title <?php echo chillnews_mikado_has_title_substring($title_length) ?>">
                <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo chillnews_mikado_get_title_substring($title_length) ?></a>
            </<?php echo esc_html($title_tag) ?>>
            <div class="mkdf-pt-four-info-section">
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