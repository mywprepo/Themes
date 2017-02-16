<?php
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		
		/*get post format*/
		$post_format = get_post_format();
		if ( false === $post_format ) {
			$post_format = 'standard';
		}							
		
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'blog');
	   
		$caption_bg 	= vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_caption_background') == '1' ? 'mega-white' : '';
		$caption_post 	= vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_caption_position');
		$caption_type 	= vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_caption_type');
		$like_count		= (int)get_post_meta(get_the_ID(), "ozy_post_like_count", true);
		$caption_type	= $caption_type == '' ? '1' : $caption_type;
		
		$caption_bg_color = $caption_text_color = '';
		if( vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_thumbnail_color') == '1' ) {
			$caption_bg_color 	= vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_thumbnail_color_group.0.ozy_enjooy_meta_post_thumbnail_color_overlay'); 
			$caption_bg_color 	= ' style="background-color:'. $ozyHelper->rgba2rgb($caption_bg_color) . ';background-color:'. $caption_bg_color. '"';
			$caption_text_color = ' style="color:'. vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_thumbnail_color_group.0.ozy_enjooy_meta_post_thumbnail_color_text') .'"';
		}
?>
        <div class="mega-entry cat-all <?php foreach(get_the_category() as $category) { echo 'cat-' . $category->slug . ' ';} ?>" id="mega-entry-<?php echo get_the_ID() ?>0" data-src="<?php echo $large_image_url[0]; ?>"   data-width="<?php echo $large_image_url[1] ?>" data-height="<?php echo $large_image_url[2] ?>">
        
        	<div>
                <div<?php echo $caption_bg_color ?> class="mega-covercaption mega-square-<?php echo $caption_post ?> mega-landscape-<?php echo $caption_post ?> mega-portrait-<?php echo $caption_post ?> <?php echo $caption_bg ?> mega-transparent mega-withsocialbar mega-smallcaptions">
                    <?php
                        if($caption_type === '1' || $caption_type === '2' || $caption_type === '3' || $caption_type === '4') {
                           echo '<div class="mega-title"><a href="'. get_permalink() .'"'. $caption_text_color .'>';the_title();echo '</a></div>';
                        }
                        if($caption_type === '1' || $caption_type === '3' || $caption_type === '4') {
                            echo '<div class="mega-date"'. $caption_text_color .'>';the_time('F j, Y');echo '</div>';
                        }
                        if($caption_type === '3' || $caption_type === '4') {
                            echo '<p'. $caption_text_color .'>'. get_the_excerpt() .'</p>';
                            if($caption_type === '4') {
                                echo '<br/><br/><a href="' . get_permalink() . '"'. $caption_text_color .'>' . __('Read the whole story', 'vp_textdomain') . '</a>';
                            }
                        }
                    ?>
                </div>
        	</div>
            
            <div class="mega-socialbar">
                <span class="mega-leftfloat post-format fa fa-<?php echo $ozyHelper->post_format_icon($post_format)?>"></span>
                <a href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>" class="mega-leftfloat mega-soc"><i class="oic-facebook"></i></a>
                <a href="https://twitter.com/share?url=<?php the_permalink() ?>" class="mega-leftfloat mega-soc"><i class="oic-twitter"></i></a>
                <a href="<?php the_permalink() ?>" class="mega-show-more oic-forward mega-rightfloat"></a>
                <a href="#" class="mega-rightfloat blog-like-link" data-post_id="<?php the_ID(); ?>"><i class="oic-heart-3"></i>&nbsp;<span><?php echo $like_count; ?></span></a>
                <a href="<?php the_permalink() ?>#comments" class="mega-rightfloat post-comment-count"><i class="oic-comment-2"></i>&nbsp;<span><?php echo comments_number('0', '1', '%') ?></span></a>
            </div>
        </div>                    
<?php
	}
?>