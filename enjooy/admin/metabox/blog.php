<?php

return array(
	'id'          => 'ozy_enjooy_meta_post',
	'types'       => array('post'),
	'title'       => __('Post Options', 'vp_textdomain'),
	'priority'    => 'high',
	'template'    => array(
		/*array(
			'type' => 'textbox',
			'name' => 'ozy_enjooy_meta_post_like_count',
			'label' => __('Default Like Count', 'vp_textdomain'),
			'default' => '0',
			'validation' => 'number',
		),*/	
		array(
			'type' => 'notebox',
			'name' => 'ozy_enjooy_meta_post_infobox',
			'label' => __('Post Options', 'vp_textdomain'),
			'description' => __('Some of those options only available for specific listing types, like Megafolio.', 'vp_textdomain'),
			'status' => 'info',
		),	
		array(
			'type' => 'radiobutton',
			'name' => 'ozy_enjooy_meta_post_caption_background',
			'label' => __('Caption Background', 'vp_textdomain'),
			'description' => __('Caption background type of your post.', 'vp_textdomain'),			
			'items' => array(
				array(
					'value' => '-1',
					'label' => 'Transparent',
				),
				array(
					'value' => '1',
					'label' => 'Visible',
				),
			),
			'default' => '{{first}}'
		),	
		array(
			'type' => 'radiobutton',
			'name' => 'ozy_enjooy_meta_post_caption_type',
			'label' => __('Caption Type', 'vp_textdomain'),
			'description' => __('Caption type of your post.', 'vp_textdomain'),			
			'items' => array(
				array(
					'value' => '1',
					'label' => 'Title and Date',
				),
				array(
					'value' => '2',
					'label' => 'Title Only',
				),
				array(
					'value' => '3',
					'label' => 'Title, Date and Excerpt',
				),
				array(
					'value' => '4',
					'label' => 'Title, Date, Excerpt and inline Read More link',
				),				
				array(
					'value' => '-1',
					'label' => 'Empty',
				),
			),
			'default' => '{{first}}'
		),
		array(
			'type' => 'radiobutton',
			'name' => 'ozy_enjooy_meta_post_caption_position',
			'label' => __('Caption Position', 'vp_textdomain'),
			'description' => __('Caption position type of your post.', 'vp_textdomain'),			
			'items' => array(
				array(
					'value' => 'top',
					'label' => 'Top',
				),
				array(
					'value' => 'right',
					'label' => 'Right',
				),
				array(
					'value' => 'bottom',
					'label' => 'Bottom',
				),
				array(
					'value' => 'left',
					'label' => 'Left',
				),
			),
			'default' => '{{first}}'
		),
		array(
			'type' => 'toggle',
			'name' => 'ozy_enjooy_meta_post_thumbnail_color',
			'label' => __('Use Custom Thumbnail Coloring', 'vp_textdomain'),
			'description' => __('Related options only available few layout types, like Blog : Metro Style.', 'vp_textdomain'),
		),
		array(
			'type'      => 'group',
			'repeating' => false,
			'length'    => 1,
			'name'      => 'ozy_enjooy_meta_post_thumbnail_color_group',
			'title'     => __('Custom Thumbnail Coloring', 'vp_textdomain'),
			'dependency' => array(
				'field'    => 'ozy_enjooy_meta_post_thumbnail_color',
				'function' => 'vp_dep_boolean',
			),
			'fields'    => array(
				/*array(
					'type' => 'fontawesome',
					'name' => 'ozy_enjooy_meta_post_thumbnail_icon',
					'label' => __('Thumbnail Icon', 'vp_textdomain'),
					'description' => __('Select an icon for your thumbnail.', 'vp_textdomain'),
					'default' => '',
				),*/
				array(
					'type' => 'textbox',
					'name' => 'ozy_enjooy_meta_post_thumbnail_icon',
					'label' => __('Thumbnail Icon', 'vp_textdomain'),
					'description' => __('Select an icon for your thumbnail.', 'vp_textdomain'),
					'default' => '',
				),							
				array(
					'type' => 'color',
					'name' => 'ozy_enjooy_meta_post_thumbnail_color_overlay',
					'label' => __('Overlay Color', 'vp_textdomain'),
					'description' => __('Select a Overlay Color.', 'vp_textdomain'),
					'default' => 'rgba(0,0,0,0.8)',
					'format' => 'rgba',
				),
				array(
					'type' => 'color',
					'name' => 'ozy_enjooy_meta_post_thumbnail_color_text',
					'label' => __('Overlay Text Color', 'vp_textdomain'),
					'description' => __('Select a text color.', 'vp_textdomain'),
					'default' => '#ffffff',
					'format' => 'hex',
				)											
			),
		)		
	),	
);

/**
 * EOF
 */