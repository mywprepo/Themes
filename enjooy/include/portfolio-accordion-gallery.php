<?php
	$output 	= '';
	$item_count = 0;
	foreach(ozy_grab_ids_from_gallery() as $attachment_id) {
		
		$attachment = get_post($attachment_id);

		$output .= '
		<div class="as-panel">
			<a href="'. $attachment->guid .'" rel="gallery" class="fancybox">
				<img class="as-background" src="'. $attachment->guid .'" data-src="'. $attachment->guid .'"/>
			</a>
			<div class="as-layer" data-position="bottomLeft" data-horizontal="5%" data-vertical="40" data-width="50%" data-height="28%">						
				<h3 class="as-layer as-opened as-black as-padding" 
					data-show-transition="down" data-hide-transition="up">
					'. $attachment->post_title .'
				</h3>';
				if($attachment->post_excerpt) {
					$output .= '<p class="as-layer as-opened as-white as-padding hide-small-screen" 
						data-vertical="60"
						data-show-transition="up" data-hide-transition="down">
						<span class="hide-medium-screen">'. $attachment->post_excerpt .'</span>
					</p>';
				}
		$output .= '</div>
		</div>';
		
		$item_count++;
	}
?>    
    <div id="accordion-carousel" class="accordion-slider as-horizontal overlap as-opened full-portfolio-accordion-slider" data-count="<?php echo $item_count; ?>">
        <div class="as-panels as-grab">
        <?php echo $output; ?>
        </div>
    </div>
    <!--.accordion-slider-->
    
    <div id="full-portfolio-like">
        <a href="#" class="blog-like-link" data-post_id="<?php the_ID(); ?>">
            <div class="fawrapper"><i class="oic-heart-3"></i></div>&nbsp;
            <span><?php echo (int)get_post_meta(get_the_ID(), "ozy_post_like_count", true); ?></span>
        </a>
    </div>
    <!--.like-button-->