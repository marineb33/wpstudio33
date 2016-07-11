<?php

//top header bar
add_action('chillnews_mikado_before_page_header', 'chillnews_mikado_get_header_top');

//mobile header
add_action('chillnews_mikado_after_page_header', 'chillnews_mikado_get_mobile_header');