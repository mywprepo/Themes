<?php function thb_testimonial_parent( $atts, $content = null ) {
	$autoplay = $autoplay_speed = false;
	$atts = vc_map_get_attributes( 'thb_testimonial_parent', $atts );
	extract( $atts );
	
	$element_id = 'thb-testimonials-' . mt_rand(10, 99);
	$el_class[] = 'thb-testimonials';
	$el_class[] = 'slick';
	$el_class[] = $thb_style;

	$out ='';
	ob_start();
	?>
	<div id="<?php echo esc_attr($element_id); ?>" class="<?php echo implode(' ', $el_class); ?>" data-columns="1" data-pagination="true" data-fade="true" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-autoplay-speed="<?php echo esc_attr($autoplay_speed); ?>">
		<?php echo wpb_js_remove_wpautop($content, false); ?>
	</div>
	<?php
	$out = ob_get_contents();
	if (ob_get_contents()) ob_end_clean();
	return $out;
}
thb_add_short('thb_testimonial_parent', 'thb_testimonial_parent');