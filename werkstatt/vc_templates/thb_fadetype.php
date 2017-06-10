<?php function thb_fadetype( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_fadetype', $atts );
  extract( $atts );
  
	$out = $text = '';
	$element_id = 'thb-fadetype-' . mt_rand(10, 99);
	$fade_text_safe = vc_value_from_safe($fade_text);
	
	ob_start();
	?>
	<div id="<?php echo esc_attr($element_id); ?>" class="thb-fadetype">
		<?php 
		if(preg_match_all("/(\*.*?\*)/is", $fade_text_safe, $entries)) {
			foreach($entries[0] as $entry) {
			  $text = substr($entry, 1, -1);
			  
			  $fade_text_safe = str_replace($entry, '<placeholder>', $fade_text_safe);

			}
			echo str_replace('<placeholder>', '<div class="thb-fadetype-entry">'.$text.'</div>', $fade_text_safe);
		}
		
		?>
	</div>
  
  <?php
  $out = ob_get_contents();
  if (ob_get_contents()) ob_end_clean();
     
  return $out;
}
thb_add_short('thb_fadetype', 'thb_fadetype');