<?php
	$thumb_size_arr = array('gridfolio-regular', 'gridfolio-large', 'gridfolio-regular', 'gridfolio-tall', 'gridfolio-regular', 'gridfolio-tall', 'gridfolio-regular');

	while ( $hg_query->have_posts() ) {

		$hg_query->the_post();

		$like_count			= (int)get_post_meta(get_the_ID(), "ozy_post_like_count", true);
		
		$post_categories 	= get_the_terms($post->ID, 'video_gallery_category');
		$category_arr		= array();
		foreach ($post_categories as $cat) 
		{
			$category_arr[$cat->slug] = $cat->name;
		}
		
		$color_background = $color_overlay = $color_normal = $color_selected = '';
		
		// Custom thumbnail coloring options		
		if( vp_metabox('ozy_enjooy_meta_video_gallery.ozy_enjooy_meta_video_gallery_thumbnail_color') == 1) {
			$meta_opt_path 		= 'ozy_enjooy_meta_video_gallery.ozy_enjooy_meta_video_gallery_thumbnail_color_group.0.ozy_enjooy_meta_video_gallery_thumbnail_color_';
			$color_background 	= vp_metabox($meta_opt_path . 'background') ;
			$color_overlay 		= vp_metabox($meta_opt_path . 'overlay') ;
			$color_normal 		= vp_metabox($meta_opt_path . 'normal') ;
			$color_selected 	= vp_metabox($meta_opt_path . 'border_selected') ;

			$color_background	= $color_background ? '<li data-thumbnail-background-color="' . $color_background . '"></li>' : '';
			$color_overlay 		= $color_background ? '<li data-thumbnail-overlay-color="' . $color_overlay . '"></li>' : '';
			$color_normal 		= $color_background ? '<li data-thumbnail-border-normal-color="' . $color_normal . '"></li>' : '';
			$color_selected 	= $color_background ? '<li data-thumbnail-border-selected-color="' . $color_selected . '"></li>' : '';
		}
	
		
		// Get thumbnail size
		$thumb_size = vp_metabox('ozy_enjooy_meta_video_gallery.ozy_enjooy_meta_video_gallery_thumbnail_size');
		
		switch($thumb_size) {
			case 'random':
				$thumb_size = $thumb_size_arr[rand(0,4)];
				break;
			case 'regular':
				$thumb_size = 'gridfolio-regular';
				break;
			case 'large':
				$thumb_size = 'gridfolio-large';
				break;
			case 'tall':
				$thumb_size = 'gridfolio-tall';
				break;
			default :
				$thumb_size = 'gridfolio-regular';
				break;
		}
		
		$label_size = "h4";
		if($thumb_size == 'gridfolio-large') {
			$label_size = "h1";
		}
		
		// Get featured image (thumbnail and image in lightbox)
		$thumb_image 	= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $thumb_size );
		$large_image 	= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		
		// HTML Output
		echo '
			<ul>
				<li data-type="link" data-target="_self" data-url="' .  get_permalink() . '" data-linktogo="' . get_permalink() . '" data-width="800" data-height="550"></li>
				<li data-thumbnail-path="' . $thumb_image[0] . '"></li>
				 <li data-thumbnail-text>
					<' . $label_size . ' class="largeLabel heading-font">' . get_the_title() . '</' . $label_size . '>
					<p class="smallLabel ' . $thumb_size . ' heading-font">' . ozy_excerpt_max_charlength(70, true, true) . '</p>
					<div class="hg_categoryName heading-font"><span class="fa fa-youtube-play"></span> ' . join(array_values($category_arr), ', '). '</div>
					<div class="hg_goToPage heading-font"><span class="fa fa-long-arrow-right"></span></div>
				</li>
				<li data-info="">
					<p class="mediaDescriptionHeader">' . get_the_title() . '</p>
					<p class="mediaDescriptionText">' . get_the_excerpt() . '</p>
				</li>'. $color_background . $color_overlay . $color_normal . $color_selected .'
			</ul>';

	}
?>