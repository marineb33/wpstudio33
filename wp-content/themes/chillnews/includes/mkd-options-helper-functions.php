<?php

if(!function_exists('chillnews_mikado_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function chillnews_mikado_is_responsive_on() {
        return chillnews_mikado_options()->getOptionValue('responsiveness') !== 'no';
    }
}