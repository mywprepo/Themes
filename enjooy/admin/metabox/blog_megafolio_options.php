<?php

return array(
	'id'          => 'ozy_enjooy_meta_page_blog',
	'types'       => array('page'),
	'title'       => __('Blog Options', 'vp_textdomain'),
	'priority'    => 'high',
	'template'    => array(	
		array(
			'type' => 'notebox',
			'name' => 'ozy_enjooy_meta_page_blog_infobox',
			'label' => __('Post Options', 'vp_textdomain'),
			'description' => __('Below this point all the options are only works with blog page template types.', 'vp_textdomain'),
			'status' => 'info',
		),
		array(
			'type' => 'checkbox',
			'name' => 'ozy_enjooy_meta_page_blog_category',
			'label' => __('Display Items From Categories', 'vp_textdomain'),
			'description' => __('If you select "All" select, all the Blog items will be displayed. When another category is selected, only the Blog items that belong to this category or this category\'s subcategories will be displayed. By this way, you can create multiple blog pages with different items.', 'vp_textdomain'),
			'items' => array(
				'data' => array(
					array(
						'source' => 'function',
						'value' => 'vp_bind_ozy_enjooy_blog_categories',
					),
				),
			),
			'default' => '{{first}}'
		),
		array(
			'type' => 'radiobutton',
			'name' => 'ozy_enjooy_meta_page_blog_order',
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
					'value' => 'title-desc',
					'label' => 'Title DESC',
				),
				array(
					'value' => 'title-asc',
					'label' => 'Title ASC',
				),
			),
			'default' => '{{first}}'
		),		
		array(
			'type' => 'toggle',
			'name' => 'ozy_enjooy_meta_page_blog_filter',
			'label' => __('Category Filter', 'vp_textdomain'),
			'description' => __('A category filter will be displayed.', 'vp_textdomain'),
			'default' => '1',
		),
		array(
			'type' => 'textbox',
			'name' => 'ozy_enjooy_meta_page_blog_count',
			'label' => __('Item Count Per Load', 'vp_textdomain'),
			'description' => __('How many post will be loaded for each load.', 'vp_textdomain'),
			'default' => '32',
			'validation' => 'numeric',
		),
		array(
			'type' => 'select',
			'name' => 'ozy_enjooy_meta_page_blog_grid_layout',
			'label' => __('Grid Layout', 'vp_textdomain'),
			'description' => __('Grid layout type of your page.', 'vp_textdomain'),			
			'items' => array(
				array(
					'value' => '0',
					'label' => 'Random',
				),			
				array(
					'value' => '2',
					'label' => 'Special #2',
				),
				array(
					'value' => '3',
					'label' => 'Special #3',
				),
				array(
					'value' => '4',
					'label' => 'Special #4',
				),
				array(
					'value' => '5',
					'label' => 'Special #5',
				),
				array(
					'value' => '6',
					'label' => 'Special #6',
				),
				array(
					'value' => '7',
					'label' => 'Special #7',
				),
				array(
					'value' => '8',
					'label' => 'Special #8',
				),
				array(
					'value' => '9',
					'label' => 'Special #9',
				),
				array(
					'value' => '10',
					'label' => 'Basic #10',
				),				
				array(
					'value' => '11',
					'label' => 'Basic #11',
				),
				array(
					'value' => '12',
					'label' => 'Basic #12',
				),
				array(
					'value' => '13',
					'label' => 'Basic #13',
				),
				array(
					'value' => '14',
					'label' => 'Different Height #14',
				),				
				array(
					'value' => '15',
					'label' => 'Different Height #15',
				),
				array(
					'value' => '16',
					'label' => 'Different Height #16',
				),
				array(
					'value' => '17',
					'label' => 'Different Height #17',
				),		

			),
			'default' => '9'
		),
		array(
			'type' => 'select',
			'name' => 'ozy_enjooy_meta_page_blog_animation_type',
			'label' => __('Animation Type', 'vp_textdomain'),
			'description' => __('Type of animation. Apllied on each item..', 'vp_textdomain'),			
			'items' => array(
				array(
					'value' => 'fade',
					'label' => 'Fade',
				),
				array(
					'value' => 'rotate',
					'label' => 'Rotate',
				),
				array(
					'value' => 'scale',
					'label' => 'Scale',
				),
				array(
					'value' => 'rotatescale',
					'label' => 'Rotate - Scale',
				),
				array(
					'value' => 'pagetop',
					'label' => 'Page Top',
				),
				array(
					'value' => 'pagebottom',
					'label' => 'Page Bottom',
				),
				array(
					'value' => 'pagemiddle',
					'label' => 'Page Middle',
				),
			),
			'default' => 'scale'
		),
		array(
			'type' => 'textbox',
			'name' => 'ozy_enjooy_meta_page_blog_padding',
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