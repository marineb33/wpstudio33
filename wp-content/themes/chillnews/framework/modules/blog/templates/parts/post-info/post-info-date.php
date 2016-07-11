<?php
$month = get_the_time('m');
$year = get_the_time('Y');
if(!isset($date_format) || $date_format == ''){
    $date_format = get_option('date_format');
}
?>
<div itemprop="dateCreated" class="mkdf-post-info-date entry-date updated"><?php if(!chillnews_mikado_post_has_title()) { ?><a itemprop="url" href="<?php the_permalink() ?>"><?php } else { ?><a itemprop="url" href="<?php echo get_month_link($year, $month); ?>"><?php } ?><?php the_time($date_format); ?><?php if(!chillnews_mikado_post_has_title()) { ?></a><?php } else { ?></a><?php } ?><meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(chillnews_mikado_get_page_id()); ?>"/></div>