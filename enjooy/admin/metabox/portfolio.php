<?php

return array(
	'id'          => 'ozy_enjooy_meta_portfolio',
	'types'       => array('ozy_portfolio'),
	'title'       => __('Portfolio Options', 'vp_textdomain'),
	'priority'    => 'high',
	'template'    => array(
		array(
			'type' => 'notebox',
			'name' => 'ozy_enjooy_meta_portfolio_info',
			'label' => __('IMPORTANT!', 'vp_textdomain'),
			'description' => __('To use "Video" Post Type, you have to enable "Use Custom Thumbnail" and enter path of one Vimeo or YouTube video.', 'vp_textdomain'),
			'status' => 'info',
		),	
		array(
			'type' => 'radioimage',
			'name' => 'ozy_enjooy_meta_portfolio_post_format',
			'label' => __('Project Type', 'vp_textdomain'),
			'description' => __('Select the one suits your project.', 'vp_textdomain'),
			'default' => 'standard',
			'items' => array(
				array(
					'value' => 'standard',
					'label' => __('Standard Page', 'vp_textdomain'),
					'img' => OZY_BASE_URL . 'admin/images/portfolio-standard.png',
				),
				array(
					'value' => 'video',
					'label' => __('Video', 'vp_textdomain'),
					'img' => OZY_BASE_URL . 'admin/images/portfolio-video.png',
				),			
				array(
					'value' => 'inpage-slider',
					'label' => __('Classic Slider With Content', 'vp_textdomain'),
					'img' => OZY_BASE_URL . 'admin/images/portfolio-classic-slider.png',
				),
				array(
					'value' => 'full-page-slider',
					'label' => __('Full Page Slider', 'vp_textdomain'),
					'img' => OZY_BASE_URL . 'admin/images/portfolio-full-page-classic.png',
				),
				array(
					'value' => 'full-page-accordion-slider',
					'label' => __('Full Page Accordion Slider', 'vp_textdomain'),
					'img' => OZY_BASE_URL . 'admin/images/portfolio-accordion.png',
				),
				array(
					'value' => 'full-page-nearby-slider',
					'label' => __('Full Page Visible Nearby Slider', 'vp_textdomain'),
					'img' => OZY_BASE_URL . 'admin/images/portfolio-nearby.png',
				),
			),
		),	
		array(
			'type' => 'toggle',
			'name' => 'ozy_enjooy_meta_portfolio_custom_thumbnail',
			'label' => __('Use Custom Thumbnail', 'vp_textdomain'),
			'description' => __('Checking this will show custom thumbnail options Video and URL.', 'vp_textdomain'),
		),
		array(
			'type'      => 'group',
			'repeating' => false,
			'length'    => 1,
			'name'      => 'ozy_enjooy_meta_portfolio_custom_thumbnail_group',
			'title'     => __('Custom Thumbnail', 'vp_textdomain'),
			'dependency' => array(
				'field'    => 'ozy_enjooy_meta_portfolio_custom_thumbnail',
				'function' => 'vp_dep_boolean',
			),
			'fields'    => array(
				array(
					'type' => 'radiobutton',
					'name' => 'ozy_enjooy_meta_portfolio_custom_thumbnail_type',
					'label' => __('Custom Thumbnail', 'vp_textdomain'),
					'description' => __('Select a custom thumbnail type', 'vp_textdomain'),
					'items' => array(
						array(
							'value' => 'video',
							'label' => __('Video', 'vp_textdomain'),
						),
						array(
							'value' => 'url',
							'label' => __('URL', 'vp_textdomain'),
						),
						array(
							'value' => 'link',
							'label' => __('Link', 'vp_textdomain'),
						),						
					),
				),
				array(
					'type' => 'textbox',
					'name' => 'ozy_enjooy_meta_portfolio_custom_thumbnail_video',
					'label' => __('Video', 'vp_textdomain'),
					'description' => __('Please type URL of your video (YouTube or Vimeo).', 'vp_textdomain'),
					'default' => '',
					'validation' => 'url',
					'dependency' => array(
						'field'    => 'ozy_enjooy_meta_portfolio_custom_thumbnail_type',
						'function' => 'vp_dep_ozy_enjooy_portfolio_video',
					),
				),
				array(
					'type' => 'textbox',
					'name' => 'ozy_enjooy_meta_portfolio_custom_thumbnail_url',
					'label' => __('Content URL', 'vp_textdomain'),
					'description' => __('Please type your URL.', 'vp_textdomain'),
					'default' => 'http://',
					'validation' => 'url',
					'dependency' => array(
						'field'    => 'ozy_enjooy_meta_portfolio_custom_thumbnail_type',
						'function' => 'vp_dep_ozy_enjooy_portfolio_url',
					),
				),
				array(
					'type' => 'textbox',
					'name' => 'ozy_enjooy_meta_portfolio_custom_thumbnail_link',
					'label' => __('Link URL', 'vp_textdomain'),
					'description' => __('Please type your link URL.', 'vp_textdomain'),
					'default' => 'http://',
					'validation' => 'url',
					'dependency' => array(
						'field'    => 'ozy_enjooy_meta_portfolio_custom_thumbnail_type',
						'function' => 'vp_dep_ozy_enjooy_portfolio_link',
					),
				),
				array(
					'type' => 'radiobutton',
					'name' => 'ozy_enjooy_meta_portfolio_custom_thumbnail_link_target',
					'label' => __('Target Window', 'vp_textdomain'),
					'description' => __('Select target window which link will be opened.', 'vp_textdomain'),
					'items' => array(
						array(
							'value' => '_blank',
							'label' => __('New Window (_blank)', 'vp_textdomain'),
						),
						array(
							'value' => '_self',
							'label' => __('Current Window (_self)', 'vp_textdomain'),
						),			
					),
					'default' => array(
						'_blank',
					),
				)				
			),
		),
		array(
			'type' => 'radiobutton',
			'name' => 'ozy_enjooy_meta_portfolio_thumbnail_size',
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
			'name' => 'ozy_enjooy_meta_portfolio_thumbnail_color',
			'label' => __('Use Custom Thumbnail Coloring', 'vp_textdomain'),
			'description' => __('Checking this will show custom thumbnail options Video and URL.', 'vp_textdomain'),
		),
		array(
			'type'      => 'group',
			'repeating' => false,
			'length'    => 1,
			'name'      => 'ozy_enjooy_meta_portfolio_thumbnail_color_group',
			'title'     => __('Custom Thumbnail Coloring', 'vp_textdomain'),
			'dependency' => array(
				'field'    => 'ozy_enjooy_meta_portfolio_thumbnail_color',
				'function' => 'vp_dep_boolean',
			),
			'fields'    => array(
				array(
					'type' => 'color',
					'name' => 'ozy_enjooy_meta_portfolio_thumbnail_color_background',
					'label' => __('Background Color', 'vp_textdomain'),
					'description' => __('Select a Background Color.', 'vp_textdomain'),
					'default' => '#FFFF00',
					'format' => 'hex',
				),
				array(
					'type' => 'color',
					'name' => 'ozy_enjooy_meta_portfolio_thumbnail_color_overlay',
					'label' => __('Overlay Color', 'vp_textdomain'),
					'description' => __('Select a Overlay Color.', 'vp_textdomain'),
					'default' => '#FF0000',
					'format' => 'hex',
				),
				array(
					'type' => 'color',
					'name' => 'ozy_enjooy_meta_portfolio_thumbnail_color_border_normal',
					'label' => __('Border Color', 'vp_textdomain'),
					'description' => __('Select a Border Color.', 'vp_textdomain'),
					'default' => '#FF00FF',
					'format' => 'hex',
				),
				array(
					'type' => 'color',
					'name' => 'ozy_enjooy_meta_portfolio_thumbnail_color_border_selected',
					'label' => __('Border Selected Color', 'vp_textdomain'),
					'description' => __('Select a Border Selected Color.', 'vp_textdomain'),
					'default' => '#FF0000',
					'format' => 'hex',
				)												
			),
		),
		array(
			'type' => 'toggle',
			'name' => 'ozy_enjooy_meta_portfolio_hide_meta_info',
			'label' => __('Hide Meta Info', 'vp_textdomain'),
			'description' => __('Check this box if you like to hide Meta Information section.', 'vp_textdomain'),
		),		
		array(
			'type'      => 'group',
			'repeating' => true,
			'sortable'	=> true,
			'name'      => 'ozy_enjooy_meta_portfolio_meta_info',
			'title'     => __('Meta Info', 'vp_textdomain'),
			'fields'    => array(
				array(
					'type' => 'textbox',
					'name' => 'ozy_enjooy_meta_portfolio_meta_info_label',
					'label' => __('Label', 'vp_textdomain'),
					'description' => __('Enter a label, like "Client"', 'vp_textdomain'),
					'default' => ''
				),
				array(
					'type' => 'textbox',
					'name' => 'ozy_enjooy_meta_portfolio_meta_info_value',
					'label' => __('Value', 'vp_textdomain'),
					'description' => __('Type something, like "John Doe Inc."', 'vp_textdomain'),
					'default' => ''
				),				
			),
		),				
	),
);

/**
 * EOF
 */