<?php
if(!function_exists('chillnews_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function chillnews_mikado_design_styles() {

		if (chillnews_mikado_options()->getOptionValue('google_fonts')){
			$font_family = chillnews_mikado_options()->getOptionValue('google_fonts');
			if(chillnews_mikado_is_font_option_valid($font_family)) {
				echo chillnews_mikado_dynamic_css('body', array('font-family' => chillnews_mikado_get_font_option_val($font_family)));
			}
		}

        if(chillnews_mikado_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
                'h1 a:hover', 
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'a:hover',
                'p a:hover',
                'blockquote:before',
                '.mkdf-post-author-comment .mkdf-comment-info .mkdf-comment-author-label',
                '.mkdf-post-author-comment .mkdf-comment-info .mkdf-comment-mark',
                '.mkdf-post-author-comment .mkdf-comment-text .mkdf-text-holder:before',
                'aside.mkdf-sidebar .widget.widget_pages ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_archive ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_categories ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_meta ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_recent_comments ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_nav_menu ul li a:hover',
                '.wpb_widgetised_column .widget.widget_pages ul li a:hover',
                '.wpb_widgetised_column .widget.widget_archive ul li a:hover',
                '.wpb_widgetised_column .widget.widget_categories ul li a:hover',
                '.wpb_widgetised_column .widget.widget_meta ul li a:hover',
                '.wpb_widgetised_column .widget.widget_recent_comments ul li a:hover',
                '.wpb_widgetised_column .widget.widget_nav_menu ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_recent_entries a:hover',
                '.wpb_widgetised_column .widget.widget_recent_entries a:hover',
                '.mkdf-drop-down .mkdf-menu-second .mkdf-menu-inner > ul > li > a .item_text:after',
                '.mkdf-drop-down .mkdf-menu-second .mkdf-menu-inner ul li.mkdf-menu-sub ul li:hover > a',
                '.mkdf-drop-down .mkdf-menu-second .mkdf-menu-inner ul li.mkdf-menu-sub ul li.current_page_item > a',
                '.mkdf-drop-down .mkdf-menu-second .mkdf-menu-inner ul li.mkdf-menu-sub ul li.current-menu-item > a',
                '.mkdf-drop-down .mkdf-menu-wide .mkdf-menu-second .mkdf-menu-inner > ul > li > a .menu_icon_wrapper i',
                '.mkdf-drop-down .mkdf-menu-wide .mkdf-menu-second .mkdf-menu-inner ul li ul li a .item_text:after',
                '.mkdf-top-bar .widget.widget_nav_menu ul li a:hover',
                '.mkdf-mobile-header .mkdf-mobile-nav > ul > li > a span:before',
                '.mkdf-mobile-header .mkdf-mobile-nav > .mkdf-grid > ul > li > a span:before',
                '.mkdf-mobile-header .mkdf-mobile-nav li ul li a:hover',
                '.mkdf-mobile-header .mkdf-mobile-nav li ul li.current_page_item > a',
                '.mkdf-mobile-header .mkdf-mobile-nav li ul li.current-menu-item > a',
                '.mkdf-mobile-header .mkdf-mobile-nav li ul li.current-menu-ancestor > a',
                '.mkdf-search-page-holder article .mkdf-post-image .mkdf-post-info-category a:hover',
                '.mkdf-search-page-holder article .mkdf-post-title-area .mkdf-post-info > div a:hover',
                '.mkdf-search-widget-holder .mkdf-search-submit:hover',
                '.mkdf-btn.mkdf-btn-outline',
                '.mkdf-dropcaps',
                '.mkdf-evp-holder .mkdf-evp-image-holder .mkdf-evp-image-text .mkdf-evp-info-section > div',
                '.mkdf-evp-holder .mkdf-evp-video-holder .mkdf-evp-video-close a',
                '.mkdf-icon-shortcode .mkdf-icon-element',
                '.wpb_gallery_slides.wpb_flexslider .flex-direction-nav li a:hover',
                '.mkdf-ordered-list ol li',
                '.mkdf-ordered-list ul li',
                '.mkdf-tabs .mkdf-tabs-nav li.ui-state-active a',
                '.mkdf-tabs .mkdf-tabs-nav li.ui-state-hover a',
                '.mkdf-psc-holder .mkdf-psc-slides .mkdf-psc-image .mkdf-post-info-category a:hover',
                '.mkdf-psc-holder .mkdf-psc-slides .mkdf-psc-content .mkdf-psc-info > div > a:hover',
                '.mkdf-psc-holder .flex-direction-nav a:hover',
                '.mkdf-psc-holder .flex-control-nav.flex-control-thumbs li:hover .mkdf-psc-thumb-categories',
                '.mkdf-psc-holder .flex-control-nav.flex-control-thumbs li img.flex-active ~ .mkdf-psc-thumb-categories',
                '.mkdf-psc-holder .flex-control-nav.flex-control-thumbs li:hover .mkdf-psc-thumb-title',
                '.mkdf-psc-holder .flex-control-nav.flex-control-thumbs li img.flex-active ~ .mkdf-psc-thumb-title',
                '.mkdf-pss-holder .flex-direction-nav a:hover',
                '.mkdf-psi-holder .flex-direction-nav a:hover',
                '.mkdf-psi-holder .flex-control-nav.flex-control-thumbs li:hover .mkdf-psi-thumb-title',
                '.mkdf-psi-holder .flex-control-nav.flex-control-thumbs li.mkdf-psi-active-thumb .mkdf-psi-thumb-title',
                '.mkdf-pt-one-item.mkdf-item-hovered .mkdf-pt-one-title a',
                '.mkdf-pt-one-item .mkdf-pt-one-image-holder .mkdf-post-info-category a:hover',
                '.mkdf-pt-one-item .mkdf-pt-one-info-section > div > a:hover',
                '.mkdf-pt-one-item .mkdf-pt-one-content-holder .mkdf-post-info-rating .mkdf-post-info-rating-active',
                '.mkdf-pt-two-item .mkdf-pt-two-content-holder .mkdf-pt-two-info-section > div > a:hover',
                '.mkdf-pt-three-item .mkdf-pt-three-content-holder .mkdf-pt-three-info-section > div > a:hover',
                '.mkdf-pt-light .mkdf-pt-three-item .mkdf-pt-three-content-holder .mkdf-pt-three-info-section .mkdf-post-info-category a:hover',
                '.mkdf-pt-dark .mkdf-pt-three-item .mkdf-pt-three-content-holder .mkdf-pt-three-info-section .mkdf-post-info-category a:hover',
                '.mkdf-pt-four-item .mkdf-pt-four-content-holder .mkdf-pt-four-info-section > div > a:hover',
                '.mkdf-pt-five-item .mkdf-pt-five-image .mkdf-post-info-category a:hover',
                '.mkdf-pt-five-item .mkdf-pt-five-content .mkdf-pt-five-info > div > a:hover',
                '.mkdf-pt-five-item .mkdf-post-info-rating .mkdf-post-info-rating-active',
                '.mkdf-pt-six-item .mkdf-pt-six-info-section > div > a:hover',
                '.mkdf-pt-seven-item .mkdf-pt-seven-content-holder .mkdf-pt-seven-info-section > div > a:hover',
                '.mkdf-pt-eight-item .mkdf-pt-eight-image-holder .mkdf-post-info-category a:hover',
                '.mkdf-pt-eight-item .mkdf-pt-eight-content .mkdf-pt-eight-info > div > a:hover',
                '.mkdf-blog-holder article.sticky .mkdf-post-title a',
                '.mkdf-blog-holder article .mkdf-post-info a:hover',
                '.mkdf-blog-holder article .mkdf-post-info .mkdf-like.liked',
                '.mkdf-blog-holder article .mkdf-pg-slider .flex-direction-nav li a:hover',
                '.mkdf-blog-holder:not(.mkdf-blog-single) .mkdf-post-info-category a:hover',
                '.mkdf-post-pag-np-horizontal .mkdf-bnl-navigation-holder .mkdf-bnl-nav-icon:hover',
                '.mkdf-ratings-holder .mkdf-ratings-stars-holder .mkdf-ratings-stars-inner > span.mkdf-active-rating-star',
                '.mkdf-ratings-holder .mkdf-ratings-stars-holder .mkdf-ratings-stars-inner > span.mkdf-hover-rating-star',
                '.mkdf-bn-holder ul.mkdf-bn-slide .mkdf-bn-text a:hover',
                '.mkdf-rpc-holder .mkdf-rpc-inner ul li .mkdf-rpc-date:hover',
                '.mkdf-rpc-holder .mkdf-rpc-inner ul li:before',
                '.mkdf-top-bar .mkdf-social-icon-widget-holder:hover',
                '.mkdf-footer-bottom-holder .mkdf-social-icon-widget-holder:hover',
                '.mkdf-plw-six h1 a:hover',
                '.mkdf-plw-six h2 a:hover',
                '.mkdf-plw-six h3 a:hover',
                '.mkdf-plw-six h4 a:hover',
                '.mkdf-plw-six h5 a:hover',
                '.mkdf-plw-six h6 a:hover',
                '.mkdf-plw-six .mkdf-post-pag-np-horizontal .mkdf-bnl-navigation-holder .mkdf-bnl-nav-icon:hover',
                '.mkdf-plw-seven h1 a:hover',
                '.mkdf-plw-seven h2 a:hover',
                '.mkdf-plw-seven h3 a:hover',
                '.mkdf-plw-seven h4 a:hover',
                '.mkdf-plw-seven h5 a:hover',
                '.mkdf-plw-seven h6 a:hover',
                '.mkdf-plw-tabs h1 a:hover',
                '.mkdf-plw-tabs h2 a:hover',
                '.mkdf-plw-tabs h3 a:hover',
                '.mkdf-plw-tabs h4 a:hover',
                '.mkdf-plw-tabs h5 a:hover',
                '.mkdf-plw-tabs h6 a:hover',
                '.mkdf-plw-tabs .mkdf-plw-tabs-tabs-holder .mkdf-plw-tabs-tab a .item_text:after',
                '.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a',
                '.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover'
            );

            $woo_color_selector = array();
            if(chillnews_mikado_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.woocommerce .mkdf-product-info-holder .price ins',
                    '.woocommerce .star-rating span',
                    '.mkdf-single-product-summary .price ins',
                    '.mkdf-single-product-summary .product_meta > span a:hover',
                    '.mkdf-woocommerce-page.mkdf-woocommerce-single-page .comment-respond .stars a.active:after',
                    '.mkdf-woocommerce-page .mkdf-content .mkdf-quantity-buttons .mkdf-quantity-minus:hover',
                    '.mkdf-woocommerce-page .mkdf-content .mkdf-quantity-buttons .mkdf-quantity-plus:hover',
                    '.mkdf-woocommerce-page .woocommerce-info .showcoupon:hover',
                    '.mkdf-woocommerce-page table.cart tr.cart_item td.product-name a:hover',
                    '.mkdf-woocommerce-page table.cart tr.cart_item td.product-remove a:hover',
                    '.woocommerce-page .widget.widget_products ul li ins',
                    '.woocommerce-page .widget.widget_recent_reviews ul li ins',
                    '.woocommerce-page .widget.widget_top_rated_products ul li ins',
                    '.woocommerce-page .widget.widget_product_categories ul li a:hover',
                    '.select2-container .select2-choice:hover',
                    '.select2-container .select2-choice:hover .select2-arrow'
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector); 

            $color_important_selector = array(
                '.mkdf-title .mkdf-title-holder .mkdf-breadcrumbs a:hover',
                '.mkdf-pt-two-item.mkdf-item-hovered .mkdf-pt-two-title',
                '.mkdf-pt-three-item.mkdf-item-hovered .mkdf-pt-three-title',
                '.mkdf-pt-five-item.mkdf-item-hovered .mkdf-pt-five-title',
                '.mkdf-pt-seven-item.mkdf-item-hovered .mkdf-pt-seven-title',
                '.mkdf-pt-eight-item.mkdf-item-hovered .mkdf-pt-eight-title',
                '.mkdf-pt-nine-item.mkdf-item-hovered .mkdf-pt-nine-title'
            );

            $background_color_selector = array(
                '.mkdf-comment-holder .mkdf-comment-number > *',
                '.mkdf-comment-form > .comment-respond > .comment-reply-title',
                '#submit_comment:hover',
                '.post-password-form input[type="submit"]:hover',
                'input.wpcf7-form-control.wpcf7-submit:hover',
                '.mkdf-pagination ul li a:hover',
                '.mkdf-pagination ul li.active span',
                '#mkdf-back-to-top > span',
                'aside.mkdf-sidebar .widget #wp-calendar td#today',
                '.wpb_widgetised_column .widget #wp-calendar td#today',
                'aside.mkdf-sidebar .widget.widget_search input[type="submit"]',
                '.wpb_widgetised_column .widget.widget_search input[type="submit"]',
                '.mkdf-main-menu > ul > li:hover > a',
                '.mkdf-main-menu > ul > li.mkdf-active-item > a',
                '.mkdf-main-menu > ul > li.current_page_item > a',
                '.mkdf-main-menu > ul > li.current-menu-ancestor > a',
                '.mkdf-search-menu-holder .mkdf-search-submit',
                'footer .widget #wp-calendar td#today',
                'footer .widget.widget_search input[type="submit"]:hover',
                'footer .widget.widget_tag_cloud a:hover',
                '.mkdf-search-page-holder .mkdf-search-page-form .mkdf-form-holder .mkdf-search-submit',
                '.mkdf-search-widget-holder .mkdf-search-submit',
                '.mkdf-btn.mkdf-btn-solid',
                '.mkdf-dropcaps.mkdf-square, .mkdf-dropcaps.mkdf-circle',
                '.mkdf-evp-holder .mkdf-evp-image-holder .mkdf-evp-image-text .mkdf-post-info-category a',
                '.mkdf-icon-shortcode.circle, .mkdf-icon-shortcode.square',
                '.wpb_gallery_slides.wpb_flexslider .flex-control-nav li:hover a:before',
                '.wpb_gallery_slides.wpb_flexslider .flex-control-nav li a.flex-active:before',
                '.mkdf-section-title-holder .mkdf-st-title',
                '.mkdf-social-share-holder.mkdf-dropdown .mkdf-social-share-dropdown-opener:after',
                '.mkdf-tabs .mkdf-tabs-nav li.mkdf-tabs-title-holder .mkdf-tabs-title',
                '.mkdf-psc-holder .flex-control-paging > li:hover a:before',
                '.mkdf-psc-holder .flex-control-paging > li a.flex-active:before',
                '.mkdf-pss-holder .flex-control-paging > li:hover a:before',
                '.mkdf-pss-holder .flex-control-paging > li a.flex-active:before',
                '.mkdf-blog-holder article .mkdf-blog-audio-holder .mejs-container .mejs-controls > .mejs-time-rail .mejs-time-total .mejs-time-current',
                '.mkdf-blog-holder article .mkdf-blog-audio-holder .mejs-container .mejs-controls > a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
                '.mkdf-blog-single-share .mkdf-social-share-holder ul li a',
                '.mkdf-single-links-pages .mkdf-single-links-pages-inner > span',
                '.mkdf-single-links-pages .mkdf-single-links-pages-inner > a:hover',
                '.mkdf-related-posts-holder .mkdf-related-posts-title > *',
                '.mkdf-post-pag-np-horizontal .mkdf-bnl-navigation-holder .mkdf-paging-button-holder:hover .mkdf-paging-button',
                '.mkdf-post-pag-np-horizontal .mkdf-bnl-navigation-holder .mkdf-paging-button-holder.mkdf-bnl-paging-active .mkdf-paging-button',
                '.mkdf-post-ajax-preloader .mkdf-pulse',
                '.mkdf-plw-six .mkdf-post-pag-np-horizontal .mkdf-bnl-navigation-holder .mkdf-paging-button-holder:hover .mkdf-paging-button',
                '.mkdf-plw-six .mkdf-post-pag-np-horizontal .mkdf-bnl-navigation-holder .mkdf-paging-button-holder.mkdf-bnl-paging-active .mkdf-paging-button',
                '.mkdf-ptw-holder.mkdf-tabs .mkdf-tabs-nav.mkdf-style-two li.ui-state-active a',
                '.mkdf-ptw-holder.mkdf-tabs .mkdf-tabs-nav.mkdf-style-two li.ui-state-hover a'
            );

            $woo_background_color_selector = array();
            if(chillnews_mikado_is_woocommerce_installed()) {
                $woo_background_color_selector = array(
                    '.woocommerce-pagination .page-numbers li span.current',
                    '.woocommerce-pagination .page-numbers li a:hover',
                    '.woocommerce-pagination .page-numbers li span:hover',
                    '.woocommerce-pagination .page-numbers li span.current:hover',
                    '.mkdf-woocommerce-single-page .mkdf-single-product-summary .cart .single_add_to_cart_button',
                    '.mkdf-woocommerce-single-page .mkdf-single-product-summary .cart .single_add_to_cart_button:hover:after',
                    '.mkdf-woocommerce-page.mkdf-woocommerce-single-page .woocommerce-tabs ul.tabs > li:hover a',
                    '.mkdf-woocommerce-page.mkdf-woocommerce-single-page .woocommerce-tabs ul.tabs > li.active a',
                    '.mkdf-woocommerce-page .woocommerce-message a.button.wc-forward',
                    '.mkdf-woocommerce-page .woocommerce-message a.button.wc-forward:hover:after',
                    '.mkdf-woocommerce-page .mkdf-content a.button:hover',
                    '.mkdf-woocommerce-page .mkdf-content input[type="submit"]:hover',
                    '.mkdf-woocommerce-page .mkdf-content button[type="submit"]:hover',
                    '.mkdf-woocommerce-page .mkdf-content a.added_to_cart',
                    '.mkdf-woocommerce-page .mkdf-content a.add_to_cart_button',
                    '.mkdf-woocommerce-page .mkdf-content a.added_to_cart:hover:after',
                    '.mkdf-woocommerce-page .mkdf-content a.add_to_cart_button:hover:after',
                    '.woocommerce .mkdf-product-featured-image-holder a.button',
                    '.woocommerce .mkdf-product-featured-image-holder a.added_to_cart',
                    '.woocommerce .mkdf-product-featured-image-holder a.button:hover:after',
                    '.woocommerce .mkdf-product-featured-image-holder a.added_to_cart:hover:after',
                    '.woocommerce-page .widget.widget_price_filter .ui-slider .ui-slider-handle',
                    '.woocommerce-page .widget.widget_price_filter .ui-slider-horizontal .ui-slider-range',
                    '.woocommerce-page .widget.widget_price_filter .button',
                    '.woocommerce-page .widget.widget_price_filter .button:hover:after',
                    '.woocommerce-page .widget.widget_product_search input[type="submit"]',
                    '.select2-drop .select2-results .select2-highlighted'
                );
            }

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector); 

            $background_color_important_selector = array(
                '.mkdf-btn.mkdf-btn-outline:not(.mkdf-btn-custom-hover-bg):hover'
            );
    
            $border_color_selector = array(
                '.mkdf-comment-holder .mkdf-comment-image',
                'aside.mkdf-sidebar .widget.widget_search input:not([type="submit"]):focus',
                '.wpb_widgetised_column .widget.widget_search input:not([type="submit"]):focus',
                '.mkdf-search-menu-holder .mkdf-search-field:focus',
                '.mkdf-search-page-holder .mkdf-search-page-form .mkdf-form-holder .mkdf-search-field:focus',
                '.mkdf-search-widget-holder .mkdf-search-field:focus',
                '.mkdf-search-widget-holder .mkdf-search-submit:hover',
                '.mkdf-btn.mkdf-btn-outline',
                '.mkdf-evp-holder .mkdf-evp-image-holder .mkdf-evp-image-text .mkdf-post-info-category a:before',
                '.mkdf-tabs .mkdf-tabs-nav li.mkdf-tabs-title-holder .mkdf-tabs-title-image',
                '.mkdf-psc-holder .flex-direction-nav a',
                '.mkdf-psi-holder .flex-direction-nav a.flex-prev',
                '.mkdf-psi-holder .flex-direction-nav a.flex-next',
                '.mkdf-psi-holder .flex-control-nav.flex-control-thumbs li.mkdf-psi-active-thumb .mkdf-psi-thumb-inner',
                '.mkdf-psi-holder .flex-control-nav.flex-control-thumbs li.mkdf-psi-active-thumb .mkdf-psi-thumb-image-holder',
                '.mkdf-image-circle .mkdf-pt-two-item .mkdf-pt-two-image-holder .mkdf-pt-two-link.mkdf-image-link:after',
                '.mkdf-image-circle .mkdf-pt-nine-item .mkdf-pt-nine-image-holder .mkdf-pt-nine-link.mkdf-image-link:after',
                '.mkdf-pt-two-item:after',
                '.mkdf-pt-nine-item:after'
            );

            $woo_border_color_selector = array();
            if(chillnews_mikado_is_woocommerce_installed()) {
                $woo_border_color_selector = array(
                    '.mkdf-woocommerce-page.mkdf-woocommerce-single-page .woocommerce-tabs ul.tabs > li:hover a',
                    '.mkdf-woocommerce-page.mkdf-woocommerce-single-page .woocommerce-tabs ul.tabs > li.active a',
                    '.woocommerce-page .widget.widget_product_search .search-field:focus'
                );
            }

            $border_color_selector = array_merge($border_color_selector, $woo_border_color_selector); 

            $border_top_color_selector = array(
                '.mkdf-mobile-header .mkdf-mobile-nav',
                '.mkdf-main-menu > ul > li > a:after',
                'footer'
            );

            $border_bottom_color_selector = array(
                '.mkdf-comment-holder .mkdf-comment-links a',
                'aside.mkdf-sidebar .widget > h6',
                '.wpb_widgetised_column .widget > h6',
                'aside.mkdf-sidebar .widget.widget_tag_cloud a',
                '.wpb_widgetised_column .widget.widget_tag_cloud a',
                '.mkdf-top-bar',
                '.mkdf-mobile-header .mkdf-mobile-header-inner',
                'footer .mkdf-footer-bottom-holder',
                '.mkdf-search-page-holder article .mkdf-post-image .mkdf-post-info-category a',
                '.mkdf-tabs .mkdf-tabs-nav li a',
                '.mkdf-tabs .mkdf-tabs-nav li a:after',
                '.mkdf-psc-holder .mkdf-psc-slides .mkdf-psc-image .mkdf-post-info-category a',
                '.mkdf-psc-holder .mkdf-psc-slides .mkdf-psc-content .mkdf-psc-info',
                '.mkdf-psc-holder .flex-control-nav.flex-control-thumbs li .mkdf-psc-thumb-categories',
                '.mkdf-psi-holder .flex-control-nav.flex-control-thumbs li .mkdf-psi-thumb-categories',
                '.mkdf-pt-one-item .mkdf-pt-one-image-holder .mkdf-post-info-category a',
                '.mkdf-pt-three-item .mkdf-pt-three-content-holder .mkdf-pt-three-info-section .mkdf-post-info-category a',
                '.mkdf-pt-five-item .mkdf-pt-five-image .mkdf-post-info-category a',
                '.mkdf-pt-five-item .mkdf-pt-five-content .mkdf-pt-five-info',
                '.mkdf-pt-eight-item .mkdf-pt-eight-image-holder .mkdf-post-info-category a',
                '.mkdf-pt-eight-item .mkdf-pt-eight-content .mkdf-pt-eight-info',
                '.mkdf-blog-holder article .mkdf-post-title-area .mkdf-post-info-category a',
                '.mkdf-single-tags-holder .mkdf-tags a',
                '.mkdf-blog-single-navigation .mkdf-blog-single-prev a',
                '.mkdf-blog-single-navigation .mkdf-blog-single-next a',
                '.mkdf-related-posts-holder .mkdf-related-posts-inner .mkdf-post-info-category a',
                '.mkdf-related-posts-holder .mkdf-related-posts-inner .mkdf-related-post-title',
                '.mkdf-blog-holder:not(.mkdf-blog-single) .mkdf-post-info-category a',
                '.mkdf-page-header .mkdf-fixed-wrapper'
            );

            $woo_border_bottom_color_selector = array();
            if(chillnews_mikado_is_woocommerce_installed()) {
                $woo_border_bottom_color_selector = array(
                    '.woocommerce .mkdf-onsale',
                    '.mkdf-woocommerce-page.mkdf-woocommerce-single-page .woocommerce-tabs ul.tabs',
                    '.woocommerce-page .widget.widget_product_tag_cloud .tagcloud a'
                );
            }

            $border_bottom_color_selector = array_merge($border_bottom_color_selector, $woo_border_bottom_color_selector); 

            $border_color_important_selector = array(
                '.mkdf-main-menu > ul > li:hover > a',
                '.mkdf-main-menu > ul > li.mkdf-active-item > a',
                '.mkdf-main-menu > ul > li.current_page_item > a',
                '.mkdf-main-menu > ul > li.current-menu-ancestor > a',
                '.mkdf-page-header .mkdf-fixed-wrapper.mkdf-fixed .mkdf-search-menu-holder .mkdf-search-field',
                '.mkdf-btn.mkdf-btn-outline:not(.mkdf-btn-custom-border-hover):hover'
            ); 

            echo chillnews_mikado_dynamic_css('::selection', array('background' => chillnews_mikado_options()->getOptionValue('first_color')));
            echo chillnews_mikado_dynamic_css('::-moz-selection', array('background' => chillnews_mikado_options()->getOptionValue('first_color')));
            echo chillnews_mikado_dynamic_css($color_selector, array('color' => chillnews_mikado_options()->getOptionValue('first_color')));
            echo chillnews_mikado_dynamic_css($color_important_selector, array('color' => chillnews_mikado_options()->getOptionValue('first_color').'!important'));
            echo chillnews_mikado_dynamic_css($background_color_selector, array('background-color' => chillnews_mikado_options()->getOptionValue('first_color')));
            echo chillnews_mikado_dynamic_css($background_color_important_selector, array('background-color' => chillnews_mikado_options()->getOptionValue('first_color').'!important'));
            echo chillnews_mikado_dynamic_css($border_color_selector, array('border-color' => chillnews_mikado_options()->getOptionValue('first_color')));
            echo chillnews_mikado_dynamic_css($border_top_color_selector, array('border-top-color' => chillnews_mikado_options()->getOptionValue('first_color')));
            echo chillnews_mikado_dynamic_css($border_bottom_color_selector, array('border-bottom-color' => chillnews_mikado_options()->getOptionValue('first_color')));
            echo chillnews_mikado_dynamic_css($border_color_important_selector, array('border-color' => chillnews_mikado_options()->getOptionValue('first_color').'!important'));
        }

		if (chillnews_mikado_options()->getOptionValue('page_background_color')) {
			$background_color_selector = array(
				'.mkdf-wrapper-inner',
				'.mkdf-content'
			);
			echo chillnews_mikado_dynamic_css($background_color_selector, array('background-color' => chillnews_mikado_options()->getOptionValue('page_background_color')));
		}

        if (chillnews_mikado_options()->getOptionValue('page_content_background_color')) {
            $background_color_selector = array(
                '.mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner'
            );
            echo chillnews_mikado_dynamic_css($background_color_selector, array('background-color' => chillnews_mikado_options()->getOptionValue('page_content_background_color')));
        }

		if (chillnews_mikado_options()->getOptionValue('selection_color')) {
			echo chillnews_mikado_dynamic_css('::selection', array('background' => chillnews_mikado_options()->getOptionValue('selection_color')));
			echo chillnews_mikado_dynamic_css('::-moz-selection', array('background' => chillnews_mikado_options()->getOptionValue('selection_color')));
		}

		$boxed_background_style = array();
		if (chillnews_mikado_options()->getOptionValue('page_background_color_in_box')) {
			$boxed_background_style['background-color'] = chillnews_mikado_options()->getOptionValue('page_background_color_in_box');
		}

		if (chillnews_mikado_options()->getOptionValue('boxed_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(chillnews_mikado_options()->getOptionValue('boxed_background_image')).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}

		if (chillnews_mikado_options()->getOptionValue('boxed_pattern_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(chillnews_mikado_options()->getOptionValue('boxed_pattern_background_image')).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}

		if (chillnews_mikado_options()->getOptionValue('boxed_background_image_attachment')) {
			$boxed_background_style['background-attachment'] = (chillnews_mikado_options()->getOptionValue('boxed_background_image_attachment'));
		}

		echo chillnews_mikado_dynamic_css('.mkdf-boxed .mkdf-wrapper', $boxed_background_style);
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_design_styles');
}


if(!function_exists('chillnews_mikado_content_styles')) {
    /**
     * Generates content custom styles
     */
    function chillnews_mikado_content_styles() {

        $content_style = array();
        if (chillnews_mikado_options()->getOptionValue('content_top_padding') !== '') {
            $padding_top = (chillnews_mikado_options()->getOptionValue('content_top_padding'));
            $content_style['padding-top'] = chillnews_mikado_filter_px($padding_top).'px';
        }

        $content_selector = array(
            '.mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner',
        );

        echo chillnews_mikado_dynamic_css($content_selector, $content_style);

        $content_style_in_grid = array();
        if (chillnews_mikado_options()->getOptionValue('content_top_padding_in_grid') !== '') {
            $padding_top_in_grid = (chillnews_mikado_options()->getOptionValue('content_top_padding_in_grid'));
            $content_style_in_grid['padding-top'] = chillnews_mikado_filter_px($padding_top_in_grid).'px';

        }

        $content_selector_in_grid = array(
            '.mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner',
        );

        echo chillnews_mikado_dynamic_css($content_selector_in_grid, $content_style_in_grid);

    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_content_styles');
}


if (!function_exists('chillnews_mikado_h1_styles')) {

    function chillnews_mikado_h1_styles() {

        $h1_styles = array();

        if(chillnews_mikado_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = chillnews_mikado_options()->getOptionValue('h1_color');
        }
        if(chillnews_mikado_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = chillnews_mikado_get_formatted_font_family(chillnews_mikado_options()->getOptionValue('h1_google_fonts'));
        }
        if(chillnews_mikado_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = chillnews_mikado_options()->getOptionValue('h1_texttransform');
        }
        if(chillnews_mikado_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = chillnews_mikado_options()->getOptionValue('h1_fontstyle');
        }
        if(chillnews_mikado_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = chillnews_mikado_options()->getOptionValue('h1_fontweight');
        }
        if(chillnews_mikado_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h1_letterspacing')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo chillnews_mikado_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_h1_styles');
}

if (!function_exists('chillnews_mikado_h2_styles')) {

    function chillnews_mikado_h2_styles() {

        $h2_styles = array();

        if(chillnews_mikado_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = chillnews_mikado_options()->getOptionValue('h2_color');
        }
        if(chillnews_mikado_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = chillnews_mikado_get_formatted_font_family(chillnews_mikado_options()->getOptionValue('h2_google_fonts'));
        }
        if(chillnews_mikado_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = chillnews_mikado_options()->getOptionValue('h2_texttransform');
        }
        if(chillnews_mikado_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = chillnews_mikado_options()->getOptionValue('h2_fontstyle');
        }
        if(chillnews_mikado_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = chillnews_mikado_options()->getOptionValue('h2_fontweight');
        }
        if(chillnews_mikado_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h2_letterspacing')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo chillnews_mikado_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_h2_styles');
}

if (!function_exists('chillnews_mikado_h3_styles')) {

    function chillnews_mikado_h3_styles() {

        $h3_styles = array();

        if(chillnews_mikado_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = chillnews_mikado_options()->getOptionValue('h3_color');
        }
        if(chillnews_mikado_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = chillnews_mikado_get_formatted_font_family(chillnews_mikado_options()->getOptionValue('h3_google_fonts'));
        }
        if(chillnews_mikado_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = chillnews_mikado_options()->getOptionValue('h3_texttransform');
        }
        if(chillnews_mikado_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = chillnews_mikado_options()->getOptionValue('h3_fontstyle');
        }
        if(chillnews_mikado_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = chillnews_mikado_options()->getOptionValue('h3_fontweight');
        }
        if(chillnews_mikado_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h3_letterspacing')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo chillnews_mikado_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_h3_styles');
}

if (!function_exists('chillnews_mikado_h4_styles')) {

    function chillnews_mikado_h4_styles() {

        $h4_styles = array();

        if(chillnews_mikado_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = chillnews_mikado_options()->getOptionValue('h4_color');
        }
        if(chillnews_mikado_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = chillnews_mikado_get_formatted_font_family(chillnews_mikado_options()->getOptionValue('h4_google_fonts'));
        }
        if(chillnews_mikado_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = chillnews_mikado_options()->getOptionValue('h4_texttransform');
        }
        if(chillnews_mikado_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = chillnews_mikado_options()->getOptionValue('h4_fontstyle');
        }
        if(chillnews_mikado_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = chillnews_mikado_options()->getOptionValue('h4_fontweight');
        }
        if(chillnews_mikado_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h4_letterspacing')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo chillnews_mikado_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_h4_styles');
}

if (!function_exists('chillnews_mikado_h5_styles')) {

    function chillnews_mikado_h5_styles() {

        $h5_styles = array();

        if(chillnews_mikado_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = chillnews_mikado_options()->getOptionValue('h5_color');
        }
        if(chillnews_mikado_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = chillnews_mikado_get_formatted_font_family(chillnews_mikado_options()->getOptionValue('h5_google_fonts'));
        }
        if(chillnews_mikado_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = chillnews_mikado_options()->getOptionValue('h5_texttransform');
        }
        if(chillnews_mikado_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = chillnews_mikado_options()->getOptionValue('h5_fontstyle');
        }
        if(chillnews_mikado_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = chillnews_mikado_options()->getOptionValue('h5_fontweight');
        }
        if(chillnews_mikado_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h5_letterspacing')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo chillnews_mikado_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_h5_styles');
}

if (!function_exists('chillnews_mikado_h6_styles')) {

    function chillnews_mikado_h6_styles() {

        $h6_styles = array();

        if(chillnews_mikado_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = chillnews_mikado_options()->getOptionValue('h6_color');
        }
        if(chillnews_mikado_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = chillnews_mikado_get_formatted_font_family(chillnews_mikado_options()->getOptionValue('h6_google_fonts'));
        }
        if(chillnews_mikado_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = chillnews_mikado_options()->getOptionValue('h6_texttransform');
        }
        if(chillnews_mikado_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = chillnews_mikado_options()->getOptionValue('h6_fontstyle');
        }
        if(chillnews_mikado_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = chillnews_mikado_options()->getOptionValue('h6_fontweight');
        }
        if(chillnews_mikado_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('h6_letterspacing')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo chillnews_mikado_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_h6_styles');
}

if (!function_exists('chillnews_mikado_text_styles')) {

    function chillnews_mikado_text_styles() {

        $text_styles = array();

        if(chillnews_mikado_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = chillnews_mikado_options()->getOptionValue('text_color');
        }
        if(chillnews_mikado_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = chillnews_mikado_get_formatted_font_family(chillnews_mikado_options()->getOptionValue('text_google_fonts'));
        }
        if(chillnews_mikado_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('text_fontsize')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('text_lineheight')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = chillnews_mikado_options()->getOptionValue('text_texttransform');
        }
        if(chillnews_mikado_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = chillnews_mikado_options()->getOptionValue('text_fontstyle');
        }
        if(chillnews_mikado_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = chillnews_mikado_options()->getOptionValue('text_fontweight');
        }
        if(chillnews_mikado_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('text_letterspacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if (!empty($text_styles)) {
            echo chillnews_mikado_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_text_styles');
}

if (!function_exists('chillnews_mikado_boxy_text_styles')) {

    function chillnews_mikado_boxy_text_styles() {

        $text_styles = array();

        if(chillnews_mikado_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = chillnews_mikado_options()->getOptionValue('text_color');
        }
        if(chillnews_mikado_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('text_fontsize')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('text_lineheight')).'px';
        }
        if(chillnews_mikado_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = chillnews_mikado_options()->getOptionValue('text_fontweight');
        }

        $text_selector = array(
            'body'
        );

        if (!empty($text_styles)) {
            echo chillnews_mikado_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_boxy_text_styles');
}

if (!function_exists('chillnews_mikado_link_styles')) {

    function chillnews_mikado_link_styles() {

        $link_styles = array();

        if(chillnews_mikado_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = chillnews_mikado_options()->getOptionValue('link_color');
        }
        if(chillnews_mikado_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = chillnews_mikado_options()->getOptionValue('link_fontstyle');
        }
        if(chillnews_mikado_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = chillnews_mikado_options()->getOptionValue('link_fontweight');
        }
        if(chillnews_mikado_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = chillnews_mikado_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo chillnews_mikado_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_link_styles');
}

if (!function_exists('chillnews_mikado_link_hover_styles')) {

    function chillnews_mikado_link_hover_styles() {

        $link_hover_styles = array();

        if(chillnews_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = chillnews_mikado_options()->getOptionValue('link_hovercolor');
        }
        if(chillnews_mikado_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = chillnews_mikado_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo chillnews_mikado_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(chillnews_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = chillnews_mikado_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo chillnews_mikado_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('chillnews_mikado_style_dynamic', 'chillnews_mikado_link_hover_styles');
}