<?php

/*
	Layouts - shortcodes
*/
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutOne\PostLayoutOne;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutTwo\PostLayoutTwo;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutThree\PostLayoutThree;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutFour\PostLayoutFour;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutFive\PostLayoutFive;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutSix\PostLayoutSix;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutSeven\PostLayoutSeven;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutEight\PostLayoutEight;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutNine\PostLayoutNine;

/*
	Blocks - combinations of several layouts
*/
use ChillNewsNamespace\Modules\Blog\Shortcodes\BlockOne\BlockOne;
use ChillNewsNamespace\Modules\Blog\Shortcodes\BlockTwo\BlockTwo;


if(!function_exists('chillnews_mikado_list_ajax')) {
    function chillnews_mikado_list_ajax()
    {

        $params = ($_POST);

        $prefix_block = 'mkdf_block_';
        $prefix_layout = 'mkdf_post_layout_';

        switch($params['base']){
            case 'mkdf_block_one' : {
                $newShortcode = new BlockOne();
            }   break;
            case 'mkdf_block_two' : {
                $newShortcode = new BlockTwo();
            }   break;
            case 'mkdf_post_layout_one' : {
                $newShortcode = new PostLayoutOne();
            }   break;
            case 'mkdf_post_layout_two' : {
                $newShortcode = new PostLayoutTwo();
            }   break;
            case 'mkdf_post_layout_three' : {
                $newShortcode = new PostLayoutThree();
            }   break;
            case 'mkdf_post_layout_four' : {
                $newShortcode = new PostLayoutFour();
            }   break;
            case 'mkdf_post_layout_five' : {
                $newShortcode = new PostLayoutFive();
            }   break;
            case 'mkdf_post_layout_six' : {
                $newShortcode = new PostLayoutSix();
            }   break;
            case 'mkdf_post_layout_seven' : {
                $newShortcode = new PostLayoutSeven();
            }   break;
            case 'mkdf_post_layout_eight' : {
                $newShortcode = new PostLayoutEight();
            }   break;
            case 'mkdf_post_layout_nine' : {
                $newShortcode = new PostLayoutNine();
            }   break;
        }

        $params['query_result'] = $newShortcode->generatePostsQuery($params);
        $html_response = $newShortcode->render($params);

        $show_next_page = true;
        if ($params['paged'] < 1 || $params['paged'] > $params['query_result']->max_num_pages) {
            $show_next_page = false;
        }


        $return_obj = array(
            'html' => $html_response,
            'showNextPage' => $show_next_page,
            'pagedResult' => $params['paged']
        );

        echo json_encode($return_obj); exit;
    }

    add_action('wp_ajax_chillnews_mikado_list_ajax', 'chillnews_mikado_list_ajax');
    add_action('wp_ajax_nopriv_chillnews_mikado_list_ajax', 'chillnews_mikado_list_ajax');
}