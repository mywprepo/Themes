<?php
	$vars = $wp_query->query_vars;
	$thb_masonry = array_key_exists('thb_masonry', $vars) ? $vars['thb_masonry'] : false;
	$thb_size = array_key_exists('thb_size', $vars) ? $vars['thb_size'] : false;
	$thb_style = array_key_exists('thb_style', $vars) ? $vars['thb_style'] : false;
	$thb_animation = array_key_exists('thb_animation', $vars) ? $vars['thb_animation'] : false;
	$thb_hover_style = array_key_exists('thb_hover_style', $vars) ? $vars['thb_hover_style'] : false;
	$id = get_the_ID();
	$image_id = get_post_thumbnail_id($id);
	$image_url = wp_get_attachment_image_src($image_id, 'full');
	$aspect_ratio = $image_id ? (($image_url[2] / $image_url[1]) * 100).'%' : '100%';
	$aspect_ratio = $thb_masonry ? $aspect_ratio : '80%';
	$hover_id = get_post_meta($id, 'main_hover_image', true);
	if ($hover_id !== '') {
	$hover_url = wp_get_attachment_image_src($hover_id, 'full');
	} else {
		$hover_url = $image_url;
	}
	
	$main_color_title = get_post_meta($id, 'main_color_title', true);
	
	$categories = get_the_term_list( $id, 'portfolio-category', '', ', ', '' ); 
	if ($categories !== '') {
		$categories = strip_tags($categories);
	}
	
	$terms = get_the_terms( $id, 'portfolio-category' );
	
	$cats = '';	
	if (!empty($terms)) {
		foreach ($terms as $term) { $cats .= ' thb-cat-'.strtolower($term->slug); }
	} else {
		$cats = '';	
	}
	
	$class[] = 'medium-6 columns';
	$class[] = $thb_size;
	$class[] = $thb_animation;
	$class[] = $thb_style;
	$class[] = $thb_hover_style;
	$class[] = $cats;
	$class[] = 'style2';
	
	$main_listing_type = get_post_meta($id, 'main_listing_type', true);
	$permalink = '';
	if ($main_listing_type == 'lightbox') {
		$permalink = $image_url[0];
		$class[] = 'portfolio-image-links';
	} else if ($main_listing_type == 'link') {
		$permalink = get_post_meta($id, 'main_listing_link', true);	
	} else {
		$permalink = get_the_permalink();	
	}
?>
<a href="<?php echo esc_url($permalink); ?>" title="<?php the_title_attribute(); ?>" <?php post_class($class); ?> id="portfolio-<?php the_ID(); ?>">
	<div class="portfolio-holder">
		<div class="portfolio-inner <?php echo esc_attr($thb_hover_style); ?>" style="<?php echo esc_attr('padding-bottom: '.$aspect_ratio.';'); ?>">
			<?php if ($thb_hover_style === 'thb-image-hover') { ?>
				<div class="thb-placeholder first" style="background-image: url(<?php echo esc_url($image_url[0]); ?>);"></div>
				<div class="thb-placeholder second" style="background-image: url(<?php echo esc_url($hover_url[0]); ?>);"></div>
			<?php } else { ?>
				<div class="thb-placeholder" style="background-image: url(<?php echo esc_url($image_url[0]); ?>);"></div>
			<?php } ?>
		</div>
		<h2><?php the_title(); ?></h2>
		<aside class="thb-categories"><?php echo esc_html($categories); ?></aside>
	</div>
</a>