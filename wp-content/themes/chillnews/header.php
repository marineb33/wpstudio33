<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php chillnews_mikado_wp_title(); ?>
    <?php
    /**
     * @see chillnews_mikado_header_meta() - hooked with 10
     * @see mkd_user_scalable - hooked with 10
     */
    ?>
	<?php do_action('chillnews_mikado_header_meta'); ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<div class="mkdf-wrapper">
    <div class="mkdf-wrapper-inner">
        <?php chillnews_mikado_get_header(); ?>

        <?php if(chillnews_mikado_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='mkdf-back-to-top'  href='#'>
                <span class="mkdf-icon-stack">
                     <?php
                        chillnews_mikado_icon_collections()->getBackToTopIcon('font_elegant');
                    ?>
                </span>
            </a>
        <?php } ?>

        <div class="mkdf-content" <?php chillnews_mikado_content_elem_style_attr(); ?>>
            <div class="mkdf-content-inner">