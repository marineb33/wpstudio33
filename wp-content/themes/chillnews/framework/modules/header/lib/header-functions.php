<?php
use ChillNewsNamespace\Modules\Header\Lib;

if(!function_exists('chillnews_mikado_set_header_object')) {
    function chillnews_mikado_set_header_object() {
        $header_type = 'header-type3';

        $object = Lib\HeaderFactory::getInstance()->build($header_type);
    }

    add_action('wp', 'chillnews_mikado_set_header_object', 1);
}