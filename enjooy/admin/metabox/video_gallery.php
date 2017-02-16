<?php

return array(
	'id'          => 'ozy_enjooy_meta_video_gallery',
	'types'       => array('ozy_video'),
	'title'       => __('Video Options', 'vp_textdomain'),
	'priority'    => 'high',
	'template'    => array(
		array(
			'type' => 'notebox',
			'name' => 'ozy_enjooy_meta_video_gallery_info',
			'label' => __('IMPORTANT!', 'vp_textdomain'),
			'description' => __('To use "Video" Post Type, you have to enable "Use Custom Thumbnail" and enter path of one Vimeo or YouTube video.', 'vp_textdomain'),
			'status' => 'info',
		),	
		array(
			'type' => 'textbox',
			'name' => 'ozy_enjooy_meta_video_gallery_custom_thumbnail_video',
			'label' => __('Video', 'vp_textdomain'),
			'description' => __('Please type URL of your video (YouTube or Vimeo).', 'vp_textdomain'),
			'default' => '',
			'validation' => 'url'
		),
		array(
			'type' => 'radiobutton',
			'name' => 'ozy_enjooy_meta_video_gallery_thumbnail_size',
			'label' => __('Thumbnail Size', 'vp_textdomain'),
			'description' => __('Select your thumbnail size.', 'vp_textdomain'),
			'items' => array(
				array(
					'value' => 'random',
					'label' => __('Random', 'vp_textdomain'),
				),
				array(
					'value' => 'regular',
					'label' => __('Regular', 'vp_textdomain'),
				),
				array(
					'value' => 'large',
					'label' => __('Large', 'vp_textdomain'),
				),
				array(
					'value' => 'tall',
					'label' => __('Tall', 'vp_textdomain'),
				),				
			),
			'default' => array(
				'random',
			),
		),
		array(
			'type' => 'toggle',
			'name' => 'ozy_enjooy_meta_video_gallery_thumbnail_color',
			'label' => __('Use Custom Thumbnail Coloring', 'vp_textdomain'),
			'description' => __('Checking this will show custom thumbnail options Video and URL.', 'vp_textdomain'),
		),
		array(
			'type'      => 'group',
			'repeating' => false,
			'length'    => 1,
			'name'      => 'ozy_enjooy_meta_video_gallery_thumbnail_color_group',
			'title'     => __('Custom Thumbnail Coloring', 'vp_textdomain'),
			'dependency' => array(
				'field'    => 'ozy_enjooy_meta_video_gallery_thumbnail_color',
				'function' => 'vp_dep_boolean',
			),
			'fields'    => array(
				array(
					'type' => 'color',
					'name' => 'ozy_enjooy_meta_video_gallery_thumbnail_color_background',
					'label' => __('Background Color', 'vp_textdomain'),
					'description' => __('Select a Background Color.', 'vp_textdomain'),
					'default' => '#FFFF00',
					'format' => 'hex',
				),
				array(
					'type' => 'color',
					'name' => 'ozy_enjooy_meta_video_gallery_thumbnail_color_overlay',
					'label' => __('Overlay Color', 'vp_textdomain'),
					'description' => __('Select a Overlay Color.', 'vp_textdomain'),
					'default' => '#FF0000',
					'format' => 'hex',
				),
				array(
					'type' => 'color',
					'name' => 'ozy_enjooy_meta_video_gallery_thumbnail_color_border_normal',
					'label' => __('Border Color', 'vp_textdomain'),
					'description' => __('Select a Border Color.', 'vp_textdomain'),
					'default' => '#FF00FF',
					'format' => 'hex',
				),
				array(
					'type' => 'color',
					'name' => 'ozy_enjooy_meta_video_gallery_thumbnail_color_border_selected',
					'label' => __('Border Selected Color', 'vp_textdomain'),
					'description' => __('Select a Border Selected Color.', 'vp_textdomain'),
					'default' => '#FF0000',
					'format' => 'hex',
				)												
			),			
		),
		array(
			'type'      => 'group',
			'repeating' => true,
			'sortable'	=> true,
			'name'      => 'ozy_enjooy_meta_video_gallery_meta_info',
			'title'     => __('Meta Info', 'vp_textdomain'),
			'fields'    => array(
				array(
					'type' => 'textbox',
					'name' => 'ozy_enjooy_meta_video_gallery_meta_info_label',
					'label' => __('Label', 'vp_textdomain'),
					'description' => __('Enter a label, like "Author"', 'vp_textdomain'),
					'default' => ''
				),
				array(
					'type' => 'textbox',
					'name' => 'ozy_enjooy_meta_video_gallery_meta_info_value',
					'label' => __('Value', 'vp_textdomain'),
					'description' => __('Type something, like "John Doe"', 'vp_textdomain'),
					'default' => ''
				),				
			),
		),				
	),
);

/**
 * EOF
 */