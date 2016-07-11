<?php

    $standard_post_format_meta_box = chillnews_mikado_add_meta_box(
        array(
            'scope' => array('post'),
            'title' => 'Standard Post Format',
            'name'  => 'post_format_standard_meta'
        )
    );

    chillnews_mikado_add_meta_box_field(
        array(
            'name'        => 'mkdf_post_disable_feature_image',
            'type'        => 'select',
            'default_value' => 'no',
            'label'       => 'Disable Feature Image',
            'description' => 'Enabling this option you will hide feature image on single post',
            'parent'      => $standard_post_format_meta_box,
            'options'     => array(
                'no' => 'No',
                'yes' => 'Yes'
            )
        )
    );

    chillnews_mikado_add_meta_box_field(
        array(
            'name'        => 'mkdf_show_featured_post',
            'type'        => 'select',
            'default_value' => 'no',
            'label'       => 'Set as featured post',
            'description' => 'Enable this option will show this post as featured',
            'parent'      => $standard_post_format_meta_box,
            'options'     => array(
                'no' => 'No',
                'yes' => 'Yes'
            )
        )
    );