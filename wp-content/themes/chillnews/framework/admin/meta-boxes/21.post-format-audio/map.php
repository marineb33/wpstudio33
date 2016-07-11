<?php

/*** Audio Post Format ***/

$audio_post_format_meta_box = chillnews_mikado_add_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => 'Audio Post Format',
		'name' 	=> 'post_format_audio_meta'
	)
);

	chillnews_mikado_add_meta_box_field(
		array(
			'name'        => 'mkdf_post_audio_link_meta',
			'type'        => 'text',
			'label'       => 'Link',
			'description' => 'Enter Audion Link',
			'parent'      => $audio_post_format_meta_box,

		)
	);

	chillnews_mikado_add_meta_box_field(
        array(
            'name'        => 'mkdf_post_disable_audio_feature_image',
            'type'        => 'select',
            'default_value' => 'no',
            'label'       => 'Disable Audio Feature Image',
            'description' => 'Enabling this option you will hide feature image on audio single post',
            'parent'      => $audio_post_format_meta_box,
            'options'     => array(
                'no' => 'No',
                'yes' => 'Yes'
            )
        )
    );