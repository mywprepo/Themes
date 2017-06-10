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
<div class="swiper-container full-page style5 thb-portfolio <?php echo esc_attr($fs_footer); ?>" data-autoplay="<?php echo esc_attr($fs_autoplay); ?>" data-footer-style="<?php echo esc_attr($fs_footer); ?>">
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
			$bg_position = $slide['bg_position'] ? $slide['bg_position'] : 'bg-center';
			
			$portfolios[] = array(
				'title' => $title,
				'image_id' => $image_id,
				'cats' => $categories
			);
		?>
			<div class="swiper-slide center-contents type-portfolio <?php echo esc_attr($main_color_title); ?> <?php echo esc_attr($bg_position); ?>" data-color="<?php echo esc_attr($main_color_title); ?>" style="background-image:url(<?php echo esc_attr($image_url[0]); ?>)">
				<a href="<?php echo esc_attr($permalink); ?>" title="<?php echo esc_attr($title); ?>">
					<h1><span><?php echo esc_attr($title); ?></span></h1>
				</a>
			</div>
		<?php $i++; } ?>
	</div>
	<?php do_action('thb-swiper-navigation', $fs_footer); ?>
	<?php do_action('thb-all-projects', $fs_footer, $portfolios); ?>
	<div class="swiper-pagination"></div>
</div>