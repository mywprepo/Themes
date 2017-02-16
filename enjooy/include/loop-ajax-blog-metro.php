<?php
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		
		/*get post format*/
		$post_format = get_post_format();
		if ( false === $post_format ) {
			$post_format = 'standard';
		}

		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'blog');
		$full_image_url  = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
		//print_r($large_image_url);
		//echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
	   
		$caption_bg 	= vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_caption_background') == '1' ? 'mega-white' : '';
		$caption_post 	= vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_caption_position');
		$caption_type 	= vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_caption_type');
		$like_count		= (int)get_post_meta(get_the_ID(), "ozy_post_like_count", true);							
		$caption_type	= $caption_type == '' ? '1' : $caption_type;
		
		$caption_bg_color 	= $caption_bg_color 	= $caption_icon = '';
		$caption_text_color = ' style="color:#fff"';
		if( vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_thumbnail_color') == '1' ) {
			$caption_bg_color 	= vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_thumbnail_color_group.0.ozy_enjooy_meta_post_thumbnail_color_overlay'); 
			$caption_bg_color 	= ' style="background-color:'. $ozyHelper->rgba2rgb($caption_bg_color) . '"';//;background-color:'. $caption_bg_color. ';
			$caption_text_color = ' style="color:'. vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_thumbnail_color_group.0.ozy_enjooy_meta_post_thumbnail_color_text') .'"';
			$caption_icon 		= vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_thumbnail_color_group.0.ozy_enjooy_meta_post_thumbnail_icon');
			$caption_icon		= $caption_icon ? '<span class="ozy-metro-icon fa '. vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_thumbnail_color_group.0.ozy_enjooy_meta_post_thumbnail_icon') .'" '. $caption_text_color .'></span>' : '';
		}
?>
	<div class="mega-entry cat-all <?php foreach(get_the_category() as $category) { echo 'cat-' . $category->slug . ' ';} ?>" id="mega-entry-<?php echo get_the_ID() ?>" data-src="<?php echo $large_image_url[0]; ?>" data-width="<?php echo $large_image_url[1] ?>" data-height="<?php echo $large_image_url[2] ?>">
    
		<div>
            <div<?php echo $caption_bg_color ?> class="mega-covercaption mega-square-<?php echo $caption_post ?> mega-landscape-<?php echo $caption_post ?> mega-portrait-<?php echo $caption_post ?> <?php echo $caption_bg ?> mega-transparent mega-withsocialbar mega-smallcaptions">
                <?php
                    echo $caption_icon;
                    
                    if($caption_type === '1' || $caption_type === '2' || $caption_type === '3' || $caption_type === '4') {
                        echo '<div class="mega-title"><a href="'. get_permalink() .'"'. $caption_text_color .'>';the_title();echo '</a></div>';
                    }
                    if($caption_type === '1' || $caption_type === '3' || $caption_type === '4') {
                        echo '<div'. $caption_text_color .'>';the_time('F j, Y');echo '</div>';
                    }
                    if($caption_type === '3' || $caption_type === '4') {
                        echo '<p'. $caption_text_color .'>'. get_the_excerpt() .'</p>';
                        if($caption_type === '4') {
                            echo '<br/><br/><a href="' . get_permalink() . '"'. $caption_text_color .' class="read-the-whole-story">' . __('Read the whole story', 'vp_textdomain') . '</a>';
                        }
                    }
                ?>
            </div>
        </div>
		
		<div class="mega-coverbuttons">
			<a href="<?php the_permalink() ?>"><div class="mega-link mega-black" <?php echo $caption_bg_color ?>></div></a>
			<a class="fancybox" rel="group" href="<?php echo $full_image_url[0] ?>" title="<?php echo get_the_title() ?>"><div class="mega-view mega-black" <?php echo $caption_bg_color ?>></div></a>
		</div>                            
	</div>                    
<?php
	}
?>