<?php 
	$id = get_the_ID();
	$fs_footer = get_post_meta($id, 'fs_footer', true);
	$fs_slides = get_post_meta($id, 'fs_slides', true);
	$fs_autoplay_speed = get_post_meta($id, 'fs_autoplay_speed', true) ? get_post_meta($id, 'fs_autoplay_speed', true) : 5000;
	$fs_autoplay = get_post_meta($id, 'fs_autoplay', true) == 'on' ? $fs_autoplay_speed : false;
	$fs_slides = get_post_meta($id, 'fs_slides', true);
	$total = sizeof($fs_slides);
	
	$portfolios = array();
?>
<div class="style4-container">
	<div class="swiper-container full-page style4 thb-portfolio <?php echo esc_attr($fs_footer); ?>" data-autoplay="<?php echo esc_attr($fs_autoplay); ?>" data-footer-style="<?php echo esc_attr($fs_footer); ?>">
	   <div class="swiper-wrapper">
			<?php $i = 1; foreach ($fs_slides as $slide) { 
				$id = $slide['portfolio'];
				$image_id = get_post_thumbnail_id($id);
				$image_url = wp_get_attachment_image_src($image_id, 'full');
				
				$main_color = get_post_meta($id, 'main_color', true);
				$main_color_title = get_post_meta($id, 'main_color_title', true);
				
				$categories = get_the_term_list( $id, 'portfolio-category', '', ', ', '' ); 
				if ($categories !== '' && !empty($categories)) {
					$categories = strip_tags($categories);
				}
				
				$title = get_the_title($id);
				if (isset($slide['slide_title']) && $slide['slide_title'] === 'on') {
				 $title = 	$slide['title'];
				}
				$main_listing_type = get_post_meta($id, 'main_listing_type', true);
				$permalink = '';
				if ($main_listing_type == 'link') {
					$permalink = get_post_meta($id, 'main_listing_link', true);	
				} else {
					$permalink = get_the_permalink($id);	
				}
				$bg_position = isset($slide['bg_position']) ? $slide['bg_position'] : 'bg-center';
				
				$portfolios[] = array(
					'title' => $title,
					'image_id' => $image_id,
					'cats' => $categories,
					'link' => $permalink,
					'bg_position' => $bg_position
				);
			?>
			<div class="swiper-slide center-contents type-portfolio">
				<div class="row align-center">
					<div class="small-12 medium-8 columns">
						<h1><span><a href="<?php echo esc_attr($permalink); ?>"><?php echo esc_attr($title); ?></a></span></h1>
						<aside class="thb-categories"><span><?php echo esc_html($categories); ?></span></aside>
					</div>
				</div>
			</div>
			<?php $i++; } ?>
		</div>
	</div>
	
	<?php do_action('thb-all-projects', $fs_footer, $portfolios); ?>
	<div class="swiper-pagination"></div>
	<div class="swiper-container style4-thumbnails thb-portfolio <?php echo esc_attr($fs_footer); ?>" data-footer-style="<?php echo esc_attr($fs_footer); ?>">
		<div class="swiper-wrapper">
			<?php 
				 foreach ($portfolios as $portfolio) {
				 	$image_url = wp_get_attachment_image_src($portfolio["image_id"], 'full');
				 	echo '
				 	<div class="swiper-slide">
				 		<a href="'. esc_attr($portfolio["link"]) .'" class="slider-inner '. esc_attr($portfolio["bg_position"]) .'" style="background-image:url('. esc_attr($image_url[0]) .')">
				 		</a>
				 	</div>';
				 }
			?>
		</div>
		<?php do_action('thb-swiper-navigation', $fs_footer); ?>
	</div>
	
</div>