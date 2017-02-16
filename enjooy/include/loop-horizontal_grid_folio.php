<?php
	$thumb_size_arr = array('gridfolio-regular', 'gridfolio-large', 'gridfolio-regular', 'gridfolio-tall', 'gridfolio-regular', 'gridfolio-tall', 'gridfolio-regular');

	while ( $hg_query->have_posts() ) {

		$hg_query->the_post();

		$like_count			= (int)get_post_meta(get_the_ID(), "ozy_post_like_count", true);
		
		$post_categories 	= get_the_terms(get_the_ID(), 'portfolio_category');
		$category_arr		= array();
		foreach ($post_categories as $cat) 
		{
			$category_arr[$cat->slug] = $cat->name;
		}
		
		$color_background = $color_overlay = $color_normal = $color_selected = $thumb_type = $data_url = $data_target = '';
		
		// Custom thumbnail coloring options		
		if( vp_metabox('ozy_enjooy_meta_portfolio.ozy_enjooy_meta_portfolio_thumbnail_color') == 1) {
			$meta_opt_path 		= 'ozy_enjooy_meta_portfolio.ozy_enjooy_meta_portfolio_thumbnail_color_group.0.ozy_enjooy_meta_portfolio_thumbnail_color_';
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
		$thumb_size = vp_metabox('ozy_enjooy_meta_portfolio.ozy_enjooy_meta_portfolio_thumbnail_size');
		
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
				//$thumb_size = 'gridfolio-regular';
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
		
		// Find post type
		$thumb_type = 'media'; $data_url = $large_image[0];
		
		// Overlay Icon
		$overlay_icon = 'picture-streamline';
		
		if(vp_metabox('ozy_enjooy_meta_portfolio.ozy_enjooy_meta_portfolio_custom_thumbnail') == 1) 
		{
			$meta_opt_path 	= 'ozy_enjooy_meta_portfolio.ozy_enjooy_meta_portfolio_custom_thumbnail_group.0.ozy_enjooy_meta_portfolio_custom_thumbnail_';
			
			$thumb_type 	= vp_metabox($meta_opt_path . 'type');
			
			if('video' 		== $thumb_type) {
				
				$data_url 	= vp_metabox($meta_opt_path . 'video');
				$thumb_type = 'media';
				$overlay_icon = 'simple-line-icons-57';
				
			}else if('url' 	== $thumb_type) {
				
				$data_url 	= vp_metabox($meta_opt_path . 'url');
				$thumb_type = 'iframe';
				$overlay_icon = 'frames';
				
			}else if('link' == $thumb_type) {
				
				$data_url 	= vp_metabox($meta_opt_path . 'link');
				$thumb_type = 'link';
				$overlay_icon = 'link-1';
				$data_target = ' data-target="'. vp_metabox($meta_opt_path . 'link_target') .'" ';
			}
			
		}

		// HTML Output
		echo '
			<ul>
				<li data-type="' . $thumb_type . '" '. $data_target .' data-url="' . $data_url . '" data-linktogo="' . ( $thumb_type=='link' || $thumb_type=='iframe' ? $data_url : get_permalink() ) . '" data-width="800" data-height="550"></li>
				<li data-thumbnail-path="' . $thumb_image[0] . '"></li>
				 <li data-thumbnail-text>
					<' . $label_size . ' class="largeLabel heading-font">' . get_the_title() . '</' . $label_size . '>
					<p class="smallLabel ' . $thumb_size . ' heading-font">' . ozy_excerpt_max_charlength(70, true, true) . '</p>
					<div class="hg_categoryName heading-font"><span class="oic oic-'. $overlay_icon .'"></span> ' . join(array_values($category_arr), ', '). '<span class="oic oic-heart-empty"></span> ' . $like_count . '</div>
					<div class="hg_goToPage heading-font"><span class="oic oic-simple-line-icons-120"></span></div>
				</li>
				<li data-info="">
					<p class="mediaDescriptionHeader">' . get_the_title() . '</p>
					<p class="mediaDescriptionText">' . get_the_excerpt() . '</p>
				</li>'. $color_background . $color_overlay . $color_normal . $color_selected .'
			</ul>';
	}
	
	wp_reset_postdata();
?>