<div class="mkdf-tabs clearfix <?php echo esc_attr($tabs_layout) ?>">
    <div class="mkdf-tabs-nav">
        <ul>
            <?php if($tabs_title != '') { ?>
                <li class="mkdf-tabs-title-holder <?php echo esc_attr($tab_class); ?>">
                    <?php foreach ($title_metas as $title_image) { ?>
                        <div class="mkdf-tabs-title-image"><img src="<?php echo esc_url($title_image['url']); ?>" alt="<?php echo esc_attr($title_image['title']); ?>" width="<?php echo esc_attr($title_image['width']); ?>" height="<?php echo esc_attr($title_image['height']); ?>"></div>
                    <?php } ?>    

                    <?php echo '<'.esc_html($title_tag) ?> class="mkdf-tabs-title"><?php echo esc_attr($tabs_title); ?><?php echo '</'.esc_html($title_tag) ?>>
                </li>
            <?php } ?>
            <?php  foreach ($tabs_titles as $tab_title) {?>
                <li>
                    <a href="#tab-<?php echo sanitize_title($tab_title)?>"><?php echo esc_attr($tab_title)?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <?php echo do_shortcode($content) ?>
</div>