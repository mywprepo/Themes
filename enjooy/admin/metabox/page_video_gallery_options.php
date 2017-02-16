<?php

return array(
	'id'          => 'ozy_enjooy_meta_page_video_gallery',
	'types'       => array('page'),
	'title'       => __('Video Gallery Options', 'vp_textdomain'),
	'priority'    => 'high',
	'template'    => array(
		array(
			'type' => 'notebox',
			'name' => 'ozy_enjooy_meta_page_video_gallery_infobox',
			'label' => __('Video Gallery Options', 'vp_textdomain'),
			'description' => __('Below this point all the options are only works with Video Gallery template types.', 'vp_textdomain'),
			'status' => 'info',
		),
		array(
			'type' => 'checkbox',
			'name' => 'ozy_enjooy_meta_page_video_gallery_category',
			'label' => __('Display Items From Categories', 'vp_textdomain'),
			'description' => __('If you select "All" select, all the Video Gallery items will be displayed. When another category is selected, only the Video Gallery items that belong to this category or this category\'s subcategories will be displayed. By this way, you can create multiple listing pages with different items.', 'vp_textdomain'),
			'items' => array(
				'data' => array(
					array(
						'source' => 'function',
						'value' => 'vp_bind_ozy_enjooy_video_gallery_categories',
					),
				),
			),
			'default' => '{{first}}'
		),
		array(
			'type' => 'radiobutton',
			'name' => 'ozy_enjooy_meta_page_video_gallery_order',
			'label' => __('Item Order', 'vp_textdomain'),
			'description' => __('By selecting "Custom Order ..." you will have to set the order field of each of the items.', 'vp_textdomain'),			
			'items' => array(
				array(
					'value' => 'date-desc',
					'label' => 'Date DESC',
				),
				array(
					'value' => 'date-asc',
					'label' => 'Date ASC',
				),
				array(
					'value' => 'custom-desc',
					'label' => 'Custom DESC',
				),
				array(
					'value' => 'custom-asc',
					'label' => 'Custom ASC',
				),
			),
			'default' => '{{first}}'
		),		
		array(
			'type' => 'toggle',
			'name' => 'ozy_enjooy_meta_page_video_gallery_filter',
			'label' => __('Category Filter', 'vp_textdomain'),
			'description' => __('A category filter will be displayed.', 'vp_textdomain'),
			'default' => '1',
		),
		array(
			'type' => 'textbox',
			'name' => 'ozy_enjooy_meta_page_video_gallery_count',
			'label' => __('Item Count Per Load', 'vp_textdomain'),
			'description' => __('How many video gallery item will be loaded for each load.', 'vp_textdomain'),
			'default' => '32',
			'validation' => 'numeric',
		),
		array(
			'type' => 'select',
			'name' => 'ozy_enjooy_meta_page_video_gallery_scroll_type',
			'label' => __('Scroll Type', 'vp_textdomain'),
			'description' => __('Type of scrolling.', 'vp_textdomain'),			
			'items' => array(
				array(
					'value' => 'drag',
					'label' => 'drag',
				),
				array(
					'value' => 'scrollbar',
					'label' => 'scrollbar',
				),
			),
			'default' => 'drag'
		),
		array(
			'type' => 'textbox',
			'name' => 'ozy_enjooy_meta_page_video_gallery_padding',
			'label' => __('Padding Between Entries', 'vp_textdomain'),
			'description' => __('The space between the Entries (value is in px)', 'vp_textdomain'),
			'default' => '1',
			'validation' => 'numeric|minlength[0]|maxlength[20]',
		),			
	),	
);

/**
 * EOF
 */