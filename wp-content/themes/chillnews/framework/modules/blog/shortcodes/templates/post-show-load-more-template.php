<div class="mkdf-bnl-navigation-holder">
    <div data-rel="<?php echo esc_attr($params['query_result']->max_num_pages) ?> " class="mkdf-btn mkdf-bnl-load-more mkdf-load-more mkdf-btn-solid">
        <?php echo get_next_posts_link( esc_html__('Show More', 'chillnews'), $params['query_result']->max_num_pages ) ?>
    </div>
    <div class="mkdf-btn mkdf-bnl-load-more-loading mkdf-btn-solid">
        <a href="javascript: void(0)" class="">
            <?php echo esc_html__('LOADING...', 'chillnews') ?>
        </a>
    </div>
</div>