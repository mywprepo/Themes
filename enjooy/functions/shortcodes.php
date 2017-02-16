<?php
//Icon Selector Attribute Type
function ozy_select_an_icon_settings_field($settings, $value) {
   //$dependency = vc_generate_dependencies_attributes($settings);
   return '<div class="select_an_icon">'
             .'<input name="'.$settings['param_name']
             .'" id="field_'.$settings['param_name']
             .'_select" class="wpb_vc_param_value wpb-textinput '
             .$settings['param_name'].' '.$settings['type'].'_field" type="text" value="'
             .$value.'"/>'
         .'</div>';
}

vc_add_shortcode_param('select_an_icon', 'ozy_select_an_icon_settings_field', OZY_BASE_URL .'scripts/admin/admin.js');

$add_css_animation = array(
	"type" => "dropdown",
	"heading" => __("CSS Animation", "vp_textdomain"),
	"param_name" => "css_animation",
	"admin_label" => true,
	"value" => array("", __("No", "vp_textdomain") => '', __("Top to bottom", "vp_textdomain") => "top-to-bottom", __("Bottom to top", "vp_textdomain") => "bottom-to-top", __("Left to right", "vp_textdomain") => "left-to-right", __("Right to left", "vp_textdomain") => "right-to-left", __("Appear from center", "vp_textdomain") => "appear"),
	"description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "vp_textdomain")
);

$animate_css_effects = array("flash","bounce","shake","tada","swing","wobble","pulse","flip","flipInX","flipOutX","flipInY","flipOutY","fadeIn","fadeInUp","fadeInDown","fadeInLeft","fadeInRight","fadeInUpBig","fadeInDownBig","fadeInLeftBig","fadeInRightBig","fadeOut","fadeOutUp","fadeOutDown","fadeOutLeft","fadeOutRight","fadeOutUpBig","fadeOutDownBig","fadeOutLeftBig","fadeOutRightBig","bounceIn","bounceInDown","bounceInUp","bounceInLeft","bounceInRight","bounceOut","bounceOutDown","bounceOutUp","bounceOutLeft","bounceOutRight","rotateIn","rotateInDownLeft","rotateInDownRight","rotateInUpLeft","rotateInUpRight","rotateOut","rotateOutDownLeft","rotateOutDownRight","rotateOutUpLeft","rotateOutUpRight","hinge","rollIn","rollOut");

/**
* Read 3D Flip Book Button
*/
if(is_plugin_active("real3d-flipbook/real3d-flipbook.php")) {
	if (!function_exists('ozy_vc_3dflipbook_button')) {
		function ozy_vc_3dflipbook_button( $atts, $content = null ) {
			$atts = vc_map_get_attributes('ozy_vc_3dflipbook_button', $atts);
			extract(shortcode_atts(array(
				'book_id' => 0,
				'color' => '',
				'icon' => '',
				'size' => '',
				'style' => '',
				'el_class' => ''
			), $atts));
			
			$book_id = (int)$book_id;
			//vc_btn vc_btn_white vc_btn-white vc_btn_md vc_btn-md vc_btn_square_outlined
			
			if($book_id>0) {
				$class = 'vc_btn ';
				$class .= ($color!='') ? 'vc_btn_'.$color.' ' : '';
				$class .= ($color!='') ? 'vc_btn-'.$color.' ' : '';
				$class .= ($size!='') ? 'vc_btn_'.$size.' ' : '';
				$class .= ($size!='') ? 'vc_btn-'.$size.' ' : '';
				$class .= ($style!='') ? 'vc_btn_'.$style.' ' : '';
				$class .= ($style!='') ? 'vc_btn-'.$style.' ' : '';
				$class .= $el_class;				

				$flipbooks = get_option('flipbooks');
				$flipbook = $flipbooks[$book_id];
				$flipbook['rootFolder'] = plugins_url()."/real3d-flipbook/";
				return ('<div class="'. $class .' real3dflipbook" id="'. $book_id .'" ><div id="options" style="display:none;">'. json_encode($flipbook) .'</div></div>');
			}
		}
	
		add_shortcode('ozy_vc_3dflipbook_button', 'ozy_vc_3dflipbook_button');
	
		vc_map( array(
			'name' => __( '3D Flipbook Button', 'vp_textdomain' ),
			'base' => 'ozy_vc_3dflipbook_button',
			'icon' => 'icon-wpb-ozy-el',
			'category' => 'by OZY',
			'description' => __( 'Eye catching 3D Flipbook button', 'vp_textdomain' ),
			'params' => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Book ID#", "vp_textdomain"),
					"param_name" => "book_id",
					"admin_label" => true,
					"value" => "",
					"description" => __("Enter ID of your 3D Flipbook. Flipbook Mode has to be set as Lightbox in order to use this button.", "vp_textdomain")
				),			
			  array(
				'type' => 'dropdown',
				'heading' => __( 'Style', 'vp_textdomain' ),
				'param_name' => 'style',
				'value' => getVcShared( 'button styles' ),
				'description' => __( 'Button style.', 'vp_textdomain' )
			  ),
			  array(
				'type' => 'dropdown',
				'heading' => __( 'Color', 'vp_textdomain' ),
				'param_name' => 'color',
				'value' => getVcShared( 'colors' ),
				'description' => __( 'Button color.', 'vp_textdomain' ),
				'param_holder_class' => 'vc-colored-dropdown'
			  ),
			  array(
				'type' => 'dropdown',
				'heading' => __( 'Size', 'vp_textdomain' ),
				'param_name' => 'size',
				'value' => getVcShared( 'sizes' ),
				'std' => 'md',
				'description' => __( 'Button size.', 'vp_textdomain' )
			  ),
			  array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'vp_textdomain' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'vp_textdomain' )
			  )
			)
		) );
	}
}

/**
* Big Title
*/
if (!function_exists('ozy_vc_bigtitle')) {
	function ozy_vc_bigtitle( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_bigtitle', $atts);
	    extract(shortcode_atts(array(
			'height' 			=> '400',
			'title' 			=> '',
			'sub_title' 		=> '',
			'title_size' 		=> '30px',
			'sub_title_size' 	=> '15px',
			'font_color' 		=> '#ffffff',
			'link' 				=> '',
			'link_target' 		=> '_self',
			'css_animation' 	=> ''
			), $atts ) 
		);
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}

		$output = '<h1 style="font-size:'. esc_attr($title_size) .';line-height:'. ((int)esc_attr($title_size)+22) .'px;color:'. esc_attr($font_color) .'">'. esc_attr($title) .'</h1><h2 style="font-size:'. esc_attr($sub_title_size) .';line-height:'. ((int)esc_attr($title_size)+12) .'px;color:'. esc_attr($font_color) .'">'. esc_attr($sub_title) .'</h2>';
		
		if($link && $link_target) {
			$output = '<a href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'">'. $output .'</a>';
		}

		return '<div class="ozy-big-title" style="height:'. esc_attr($height) .'px"><div>'. $output .'</div></div>';
	}

	add_shortcode('ozy_vc_bigtitle', 'ozy_vc_bigtitle');

	vc_map( array(
	   "name" => __("Big Title", "vp_textdomain"),
	   "base" => "ozy_vc_bigtitle",
	   "class" => "",
	   "controls" => "full",
	   'category' => 'by OZY',
	   "icon" => "icon-wpb-ozy-el",
	   "params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Height", "vp_textdomain"),
				"param_name" => "height",
				"admin_label" => true,
				"value" => "400",
				"description" => __("Please enter only integer values. Will be processed in pixels.", "vp_textdomain")
			),	   
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "title",
				"admin_label" => true,
				"value" => __("Enter your title here", "vp_textdomain")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Sub Title", "vp_textdomain"),
				"param_name" => "sub_title",
				"admin_label" => true,
				"value" => __("Enter your sub title here", "vp_textdomain")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Title Size", "vp_textdomain"),
				"param_name" => "title_size",
				"admin_label" => true,
				"value" => array("30px","5px","10px","15px","20px","25px","35px","40px","45px","50px","55px","60px","65px","70px","75px","80px","85px","90px","95px","100px","105px","110px","115px","120px","125px","130px","135px","140px","145px","150px","155px","160px","165px","170px","175px","180px","185px","190px","195px","200px")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Sub Title Size", "vp_textdomain"),
				"param_name" => "sub_title_size",
				"admin_label" => true,
				"value" => array("15px","5px","10px","20px","25px","30px","35px","40px","45px","50px","55px","60px","65px","70px","75px","80px","85px","90px","95px","100px","105px","110px","115px","120px","125px","130px","135px","140px","145px","150px","155px","160px","165px","170px","175px","180px","185px","190px","195px","200px")
			),						
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Font Color", "vp_textdomain"),
				"param_name" => "font_color",
				"admin_label" => false,
				"value" => "#ffffff"
			)
			,array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Link", "vp_textdomain"),
				"param_name" => "link",
				"admin_label" => true,
				"value" => ""
			)
			,array(
				"type" => "dropdown",
				"heading" => __("Link Target", "vp_textdomain"),
				"param_name" => "link_target",
				"value" => array("_self", "_blank", "_parent"),
				"admin_label" => false,
				"description" => __("Select link target window.", "vp_textdomain")
		  	),$add_css_animation
		)
	) );
}

/**
* Timeline
*/
if (!function_exists('ozy_vc_timelinewrapper')) {
	function ozy_vc_timelinewrapper( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_timelinewrapper', $atts);
		extract(shortcode_atts(array(
			'title' => '',
			'bg_color' => '#ffffff'
		), $atts));
		
		$element_id = 'ozy-timeline-wrapper_' . rand(100,10000); 
		
		$output = '';
		$output.= ($title ? '<div id="'. $element_id .'" class="ozy-timeline-wrapper"><h4 class="timeline-caption"><span>'. esc_attr($title) .'</span></h4>' : '');
		$output.= '<ul class="timeline">'. do_shortcode($content) .'</ul>';
		$output.= ($title ? '</div>' : '');
		
		if($bg_color) {
			global $ozyHelper;
			$ozyHelper->set_footer_style('#'. $element_id . ' .timeline-panel{background-color:'. esc_attr($bg_color) .';}#'. $element_id . ' .timeline-panel:after{border-left-color:'. esc_attr($bg_color) .';}');
		}
		
		return $output;
	}
	
	add_shortcode('ozy_vc_timelinewrapper', 'ozy_vc_timelinewrapper');
	
	vc_map( array(
		"name" => __("Timeline Wrapper", "vp_textdomain"),
		"base" => "ozy_vc_timelinewrapper",
		"as_parent" => array('only' => 'ozy_vc_timeline'),
		"content_element" => true,
		"show_settings_on_create" => false,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "title",
				"value" => "",
				"decription" => __("Only place holder", "vp_textdomain"),
				"admin_label" => true
		  	),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Item Background / Arrow Color", "vp_textdomain"),
				"param_name" => "bg_color",
				"admin_label" => true,
				"value" => "#ffffff"
			)
	   ),
	   "js_view" => 'VcColumnView'
	) );
}

class WPBakeryShortCode_Ozy_Vc_Timelinewrapper extends WPBakeryShortCodesContainer{}

if (!function_exists('ozy_vc_timeline')) {
	function ozy_vc_timeline( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_timeline', $atts);
		extract(shortcode_atts(array(
			'position' => 'left',
			'title' => '',
			'excerpt' => '',
			'icon' => '',
			'bg_color' => '',
			'text_color' => '',
			'icon_bg_color' => '',
			'icon_color' => '',
			'css_animation' => ''
		), $atts));
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}
		
		$css_text_color = ($text_color ? ' style="color:'. esc_attr($text_color) .'"':'');
		
		$output = '
		 <li class="'. ($position === 'right' ? 'timeline-inverted':'') . $css_animation .'">
          <div class="timeline-badge" style="'. ('color:'. esc_attr($icon_color) . ';background-color:' . esc_attr($icon_bg_color)) .'"><i class="'. esc_attr($icon) .'"></i></div>
          <div class="timeline-panel">
            <div class="timeline-heading">
              <h4 class="timeline-title"'. $css_text_color .'>'. esc_attr($title) .'</h4>
            </div>
            <div class="timeline-body"'. $css_text_color .'>'. do_shortcode($excerpt) .'</div>
          </div>
        </li>';

		return $output;
	}
	
	add_shortcode( 'ozy_vc_timeline', 'ozy_vc_timeline' );
	
	vc_map( array(
		"name" => __("Timeline Item", "vp_textdomain"),
		"base" => "ozy_vc_timeline",
		"content_element" => true,
		"as_child" => array('only' => 'ozy_vc_timelinewrapper'),
		"icon" => "icon-wpb-ozy-el",
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Position", "vp_textdomain"),
				"param_name" => "position",
				"admin_label" => true,
				"value" => array("left", "right")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "title",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "textarea_html",
				"class" => "",
				"heading" => __("Content", "vp_textdomain"),
				"param_name" => "excerpt",
				"admin_label" => false,
				"value" => ""
			),array(
				"type" => "select_an_icon",
				"heading" => __("Icon", "vp_textdomain"),
				"param_name" => "icon",
				"value" => '',
				"admin_label" => false,
				"description" => __("Once you select an Icon, title will not be shown on overlay.", "vp_textdomain")
		  	),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Text Color", "vp_textdomain"),
				"param_name" => "text_color",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Icon Background Color", "vp_textdomain"),
				"param_name" => "icon_bg_color",
				"admin_label" => true,
				"value" => "#222222"
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Icon Color", "vp_textdomain"),
				"param_name" => "icon_color",
				"admin_label" => true,
				"value" => "#ffffff"
			),$add_css_animation
	   )
	) );	
}

class WPBakeryShortCode_Ozy_Vc_Timeline extends WPBakeryShortCode{}

/**
* Contact Form 7
*/
if (!function_exists('ozy_vc_contactform') && is_plugin_active('contact-form-7/wp-contact-form-7.php')) {

	function ozy_vc_contactform( $atts, $content = null ) {	    
		$atts = vc_map_get_attributes('ozy_vc_contactform', $atts);
		extract(shortcode_atts(array(
			'title' => '',
			'id' => '',
			'css_animation' => '',
			'el_class' => ''
			), $atts ) 
		);
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}
		
		return '<div class="wpb_content_element_x ozy-cf7-wrapper '. esc_attr($el_class) .'">'. do_shortcode('[contact-form-7 id="'. esc_attr($id) .'" title="'. esc_attr($title) .'"]') .'</div>';		
	}
	
	add_shortcode('ozy_vc_contactform', 'ozy_vc_contactform');
	
	global $wpdb;
	$cf7 = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'wpcf7_contact_form'");
	$contact_forms = array();
	if ($cf7) {
		foreach ( $cf7 as $cform ) {
			$contact_forms[$cform->post_title] = $cform->ID;
		}
	} else {
		$contact_forms["No contact forms found"] = 0;
	}

	vc_map( array(
	  "base" => "ozy_vc_contactform",
	  "name" => __("Contact Form 7", "vp_textdomain"),
	  "icon" => "icon-wpb-contactform7",
	  'category' => 'by OZY',
	  "description" => __('Place Contact Form7', 'vp_textdomain'),
	  "content_element" => true,
	  "params" => array(
		array(
		  "type" => "textfield",
		  "heading" => __("Form title", "vp_textdomain"),
		  "param_name" => "title",
		  "admin_label" => true,
		  "description" => __("What text use as form title. Leave blank if no title is needed.", "vp_textdomain")
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Select contact form", "vp_textdomain"),
		  "param_name" => "id",
		  "value" => $contact_forms,
		  "description" => __("Choose previously created contact form from the drop down list.", "vp_textdomain")
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "vp_textdomain"),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain"),
		)
	  )
	) );
}


/**
* Mail Chimp
*/
if (!function_exists('ozy_vc_mailchimp') && function_exists('mailchimpSF_signup_form')) {
	function ozy_vc_mailchimp( $atts, $content = null ) {	
		$atts = vc_map_get_attributes('ozy_vc_mailchimp', $atts);    
		extract(shortcode_atts(array(
			'css_animation' => ''
			), $atts ) 
		);
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}
		
		return '<div class="wpb_content_element_x">'. do_shortcode('[mailchimpsf_form]') .'</div>';		
	}
	
	add_shortcode('ozy_vc_mailchimp', 'ozy_vc_mailchimp');
	
	vc_map( array(
		"name" => __("Mail Chimp", "vp_textdomain"),
		"base" => "ozy_vc_mailchimp",
		"content_element" => true,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			$add_css_animation	
	   )
	) );
}

/**
* Anything Wrapper
*/
if (!function_exists('ozy_vc_anywrapper')) {
	function ozy_vc_anywrapper( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_anywrapper', $atts);
		extract(shortcode_atts(array(
			'padding_top' => '30px',
			'padding_right' => '30px',
			'padding_bottom' => '30px',
			'padding_left' => '30px'
		), $atts));
		
		return '<div class="ozy-anything-wrapper" style="display:inline-block;width:100%;padding:'. esc_attr($padding_top) .' '. esc_attr($padding_right) .' '. esc_attr($padding_bottom) .' '. esc_attr($padding_left) .'">'. do_shortcode($content) .'</div>';
	}
	
	add_shortcode('ozy_vc_anywrapper', 'ozy_vc_anywrapper');
	
	vc_map( array(
		"name" => __("Anything Wrapper", "vp_textdomain"),
		"base" => "ozy_vc_anywrapper",
		"as_parent" => array('except' => 'ozy_vc_iabox,ozy_vc_flipbox'),
		"content_element" => true,
		"show_settings_on_create" => false,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Padding Top", "vp_textdomain"),
				"param_name" => "padding_top",
				"admin_label" => true,
				"value" => array("30px","5px","10px","15px","20px","25px","35px","40px","45px","50px","55px","60px","65px","70px","75px","80px","85px","90px","95px","100px","105px","110px","115px","120px","125px","130px","135px","140px","145px","150px","155px","160px","165px","170px","175px","180px","185px","190px","195px","200px")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Padding Right", "vp_textdomain"),
				"param_name" => "padding_right",
				"admin_label" => true,
				"value" => array("30px","5px","10px","15px","20px","25px","35px","40px","45px","50px","55px","60px","65px","70px","75px","80px","85px","90px","95px","100px","105px","110px","115px","120px","125px","130px","135px","140px","145px","150px","155px","160px","165px","170px","175px","180px","185px","190px","195px","200px")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Padding Bottom", "vp_textdomain"),
				"param_name" => "padding_bottom",
				"admin_label" => true,
				"value" => array("30px","5px","10px","15px","20px","25px","35px","40px","45px","50px","55px","60px","65px","70px","75px","80px","85px","90px","95px","100px","105px","110px","115px","120px","125px","130px","135px","140px","145px","150px","155px","160px","165px","170px","175px","180px","185px","190px","195px","200px")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Padding Left", "vp_textdomain"),
				"param_name" => "padding_left",
				"admin_label" => true,
				"value" => array("30px","5px","10px","15px","20px","25px","35px","40px","45px","50px","55px","60px","65px","70px","75px","80px","85px","90px","95px","100px","105px","110px","115px","120px","125px","130px","135px","140px","145px","150px","155px","160px","165px","170px","175px","180px","185px","190px","195px","200px")
			)									
	   ),
	   "js_view" => 'VcColumnView'
	) );
}

class WPBakeryShortCode_Ozy_Vc_Anywrapper extends WPBakeryShortCodesContainer{}

/**
* Styled Heading
*/
if (!function_exists('ozy_vc_sheading')) {
	function ozy_vc_sheading( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_sheading', $atts);
	    extract(shortcode_atts(array(
			'caption' 		=> '',
			'caption_size'	=> 'h1',
			'caption_position'=> 'center',
			'border_style'	=> 'solid',
			'border_size'	=> '1px',
			'accent_color' 	=> '#000',
			'bg_color' 		=> '',
			'padding' 		=> '5px',
			'css_animation' => ''
			), $atts ) 
		);
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}

		return '<div class="wpb_content_element_x" style="text-align:'. esc_attr($caption_position) .';"><'. esc_attr($caption_size) .' style="border:'. esc_attr($border_size) .' '. esc_attr($border_style) .' '. esc_attr($accent_color) . (esc_attr($bg_color) ? ';background-color:' . esc_attr($bg_color) : '') .';color:'. esc_attr($accent_color) .' !important;padding:'. esc_attr($padding) .';display:inline-block;">'. esc_attr($caption) .'</'. esc_attr($caption_size) .'></div>';//line-height:inherit;
	}

	add_shortcode('ozy_vc_sheading', 'ozy_vc_sheading');

	vc_map( array(
	   "name" => __("Styled Heading", "vp_textdomain"),
	   "base" => "ozy_vc_sheading",
	   "class" => "",
	   "controls" => "full",
	   'category' => 'by OZY',
	   "icon" => "icon-wpb-ozy-el",
	   "params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Caption", "vp_textdomain"),
				"param_name" => "caption",
				"admin_label" => true,
				"value" => __("Enter your caption here", "vp_textdomain"),
				"description" => __("Caption of the component.", "vp_textdomain")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Caption Size", "vp_textdomain"),
				"param_name" => "caption_size",
				"admin_label" => true,
				"value" => array("h1", "h2", "h3", "h4", "h5", "h6")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Caption Position", "vp_textdomain"),
				"param_name" => "caption_position",
				"admin_label" => true,
				"value" => array("center", "left", "right")
			),						
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Border Style", "vp_textdomain"),
				"param_name" => "border_style",
				"admin_label" => true,
				"value" => array("solid","dotted","dashed","double")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Border Size", "vp_textdomain"),
				"param_name" => "border_size",
				"admin_label" => true,
				"value" => array("0","1px","2px","3px","4px","5px","6px","7px","8px","9px","10px")
			),			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Accent Color", "vp_textdomain"),
				"param_name" => "accent_color",
				"admin_label" => false,
				"value" => "#000"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Background Color", "vp_textdomain"),
				"param_name" => "bg_color",
				"admin_label" => false,
				"value" => "#fff"
			),			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Padding", "vp_textdomain"),
				"param_name" => "padding",
				"admin_label" => true,
				"value" => array("5px","10px","15px","20px","25px","30px","35px","40px","45px","50px")
			),$add_css_animation
		)
	) );
}

/**
* Flip Box
*/
if (!function_exists('ozy_vc_flipbox')) {
	function ozy_vc_flipbox( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_flipbox', $atts);
		extract(shortcode_atts(array(
			'front_icon' => '',
			'front_title' => '',
			'front_excerpt' => '',
			'front_bg_color' => '',
			'front_fg_color' => '#222222',
			'front_bg_image' => '',
			'back_icon' => '',
			'back_title' => '',
			'back_excerpt' => '',
			'back_bg_color' => '#222222',
			'back_fg_color' => '#ffffff',
			'back_bg_image' => '',
			'direction' => 'horizontal',
			'height' => '427',
			'link' => '',
			'link_target' => '_self'
		), $atts));

		global $ozyHelper;

		$front_bg_image = wp_get_attachment_image_src(esc_attr($front_bg_image), 'full');
		$back_bg_image 	= wp_get_attachment_image_src(esc_attr($back_bg_image), 'full');
		
		$front_bg 	= $ozyHelper->background_style_render(esc_attr($front_bg_color), (isset($front_bg_image[0]) ? $front_bg_image[0]:''), '', '', '', '', '', '');
		$back_bg 	= $ozyHelper->background_style_render(esc_attr($back_bg_color), (isset($back_bg_image[0]) ? $back_bg_image[0]:''), '', '', '', '', '', '');
		
		return '<div class="flip-container '. esc_attr($direction) .' wpb_content_element_x" ontouchstart="this.classList.toggle(\'hover\');" style="height:'. esc_attr($height).'px;">
				<a class="flipper" '. (esc_attr($link) ? 'href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'"' : '') .'>
					<span class="front" style="'. $front_bg .'">
						'. (esc_attr($front_icon) ? '<i style="color:'. esc_attr($front_fg_color) .'" class="'. esc_attr($front_icon) .'"></i>' : '') .'
						'. (esc_attr($front_title) ? '<h3 style="color:'. esc_attr($front_fg_color) .'">'. esc_attr($front_title) .'</h3>' : '') .'
						'. (esc_attr($front_excerpt) ? '<p style="color:'. esc_attr($front_fg_color) .'">'. nl2br(strip_tags($front_excerpt)) .'</p>' : '') .'
					</span>
					<span class="back" style="'. $back_bg .'">
						'. (esc_attr($back_icon) ? '<i style="color:'. esc_attr($back_fg_color) .'" class="'. esc_attr($back_icon) .'"></i>' : '') .'
						'. (esc_attr($back_title) ? '<h3 style="color:'. esc_attr($back_fg_color) .'">'. esc_attr($back_title) .'</h3>' : '') .'
						'. (esc_attr($back_excerpt) ? '<p style="color:'. esc_attr($back_fg_color) .'">'. nl2br(strip_tags($back_excerpt)) .'</p>' : '') .'
					</span>
				</a>
			</div>';		
	}
	
	add_shortcode( 'ozy_vc_flipbox', 'ozy_vc_flipbox' );
	
	vc_map( array(
		"name" => __("Flip Box", "vp_textdomain"),
		"base" => "ozy_vc_flipbox",
		"content_element" => true,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "select_an_icon",
				"heading" => __("Front Icon", "vp_textdomain"),
				"param_name" => "front_icon",
				"value" => '',
				"admin_label" => false
		  	),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Front Title", "vp_textdomain"),
				"param_name" => "front_title",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "textarea",
				"class" => "",
				"heading" => __("Front Excerpt", "vp_textdomain"),
				"param_name" => "front_excerpt",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("Front Background Image", "vp_textdomain"),
				"param_name" => "front_bg_image",
				"admin_label" => false,
				"value" => ""
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Front Background Color", "vp_textdomain"),
				"param_name" => "front_bg_color",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Front Foreground Color", "vp_textdomain"),
				"param_name" => "front_fg_color",
				"admin_label" => true,
				"value" => "#222222"
			),array(
				"type" => "select_an_icon",
				"heading" => __("Back Icon", "vp_textdomain"),
				"param_name" => "back_icon",
				"value" => '',
				"admin_label" => false
		  	),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Back Title", "vp_textdomain"),
				"param_name" => "back_title",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "textarea",
				"class" => "",
				"heading" => __("Back Excerpt", "vp_textdomain"),
				"param_name" => "back_excerpt",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("Back Background Image", "vp_textdomain"),
				"param_name" => "back_bg_image",
				"admin_label" => false,
				"value" => ""
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Back Background Color", "vp_textdomain"),
				"param_name" => "back_bg_color",
				"admin_label" => true,
				"value" => "#222222"
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Back Foreground Color", "vp_textdomain"),
				"param_name" => "back_fg_color",
				"admin_label" => true,
				"value" => "#ffffff"
			),array(
				"type" => "dropdown",
				"heading" => __("Direction", "vp_textdomain"),
				"param_name" => "direction",
				"value" => array("horizontal", "vertical"),
				"admin_label" => true
		  	),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Height", "vp_textdomain"),
				"param_name" => "height",
				"admin_label" => true,
				"value" => "427",
				"description" => __("Please enter only integer values. Will be processed in pixels.", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Link", "vp_textdomain"),
				"param_name" => "link",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "dropdown",
				"heading" => __("Link Target", "vp_textdomain"),
				"param_name" => "link_target",
				"value" => array("_self", "_blank", "_parent"),
				"admin_label" => false,
				"description" => __("Select link target window.", "vp_textdomain")
		  	)
	   )
	) );	
}

/**
* Accordion Menu
*/
if (!function_exists('ozy_vc_accordionmenu')) {
	function ozy_vc_accordionmenu( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_accordionmenu', $atts);
		extract(shortcode_atts(array(
			'title' => '',
			'shadow' => 'off',
			'autoplay' => 'off'
		), $atts));
		
		wp_enqueue_style('accordion-slider');
		wp_enqueue_script('accordion-slider');
		
		$params = array(
			'shadow' 	=> (esc_attr($shadow) === 'on' ? '1' : '0'),
			'autoplay' 	=> (esc_attr($autoplay) === 'on' ? '1' : '0'),
			'width' 	=> '100%',
			'height'	=> 'full'
		);
		wp_localize_script( 'enjooy', 'accordionSliderOptions', $params );		
		
		$GLOBALS["ACCORDION_MENU_ITEM_COUNT"] = 0;

		$output = do_shortcode($content);
		
		$output = '<div id="accordion-carousel" data-autoplay="0" class="accordion-slider as-horizontal overlap as-opened" data-count="'. $GLOBALS["ACCORDION_MENU_ITEM_COUNT"] .'"><div class="as-panels as-grab">'. $output .'</div></div>';
		
		unset($GLOBALS["ACCORDION_MENU_ITEM_COUNT"]);
		
		return $output;
	}
	
	add_shortcode('ozy_vc_accordionmenu', 'ozy_vc_accordionmenu');
	
	vc_map( array(
		"name" => __("Accordion Menu", "vp_textdomain"),
		"base" => "ozy_vc_accordionmenu",
		"as_parent" => array('only' => 'ozy_vc_accordionmenu_item'),
		"content_element" => true,
		"show_settings_on_create" => false,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "width",
				"value" => "Title",
				"decription" => __("Only place holder", "vp_textdomain"),
				"admin_label" => true
		  	),array(
				"type" => "dropdown",
				"heading" => __("Shadow", "vp_textdomain"),
				"param_name" => "shadow",
				"value" => array("off", "on"),
				"description" => __("Eanble / Disable vertical shadow for your slides", "vp_textdomain"),
				"admin_label" => true
			),array(
				"type" => "dropdown",
				"heading" => __("Autoplay", "vp_textdomain"),
				"param_name" => "autoplay",
				"value" => array("off", "on"),
				"description" => __("Enable / Disable autoplay option for your slider", "vp_textdomain"),
				"admin_label" => true
			)	
	   ),
	   "js_view" => 'VcColumnView'
	) );
}

class WPBakeryShortCode_Ozy_Vc_Accordionmenu extends WPBakeryShortCodesContainer{}

if (!function_exists('ozy_vc_accordionmenu_item')) {
	function ozy_vc_accordionmenu_item( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_accordionmenu_item', $atts);
		extract(shortcode_atts(array(
			'bg_color' => '#222222',
			'fg_color' => '#ffffff',
			'bg_image' => '',
			'title' => '',
			'excerpt' => '',
			'link' => '',
			'link_caption' => '',
			'link_target' => '_self'
		), $atts));

		$GLOBALS["ACCORDION_MENU_ITEM_COUNT"]++; 
		
		global $ozyHelper;

		$bg_image = wp_get_attachment_image_src($bg_image, 'full');
		if(!isset($bg_image[0])) {
			$bg_image[0] = OZY_BASE_URL . 'images/blank.gif';
		}
		
		return '
		<div class="as-panel">
			<a href="'. esc_attr($link) .'" style="background-color:'. esc_attr($bg_color) .'">
				<span style="color:'. esc_attr($fg_color) .'"><i class="oic-simple-line-icons-89" style="color:'. esc_attr($fg_color) .'"></i>'. esc_attr($link_caption) .'</span>
			</a>
			<img class="as-background" data-src="'. $bg_image[0] .'"/>
			<div class="as-layer">
				<h1 style="color:'. esc_attr($fg_color) .'">
					'. esc_attr($title) .'
				</h1>						
				<p class="hide-small-screen" >
					<span class="hide-medium-screen" style="color:'. esc_attr($fg_color) .'">'. nl2br($excerpt) .'</span>
				</p>
			</div>
		</div>';		
	}
	
	add_shortcode( 'ozy_vc_accordionmenu_item', 'ozy_vc_accordionmenu_item' );
	
	vc_map( array(
		"name" => __("Accordion Menu Pane", "vp_textdomain"),
		"base" => "ozy_vc_accordionmenu_item",
		"content_element" => true,
		"as_child" => array('only' => 'ozy_vc_accordionmenu'),
		"icon" => "icon-wpb-ozy-el",
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "title",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "textarea",
				"class" => "",
				"heading" => __("Excerpt", "vp_textdomain"),
				"param_name" => "excerpt",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("Background Image", "vp_textdomain"),
				"param_name" => "bg_image",
				"admin_label" => false,
				"value" => ""
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Background Color", "vp_textdomain"),
				"param_name" => "bg_color",
				"admin_label" => true,
				"value" => "#222222"
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Foreground Color", "vp_textdomain"),
				"param_name" => "fg_color",
				"admin_label" => true,
				"value" => "#ffffff"
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Link", "vp_textdomain"),
				"param_name" => "link",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Link Caption", "vp_textdomain"),
				"param_name" => "link_caption",
				"admin_label" => true,
				"value" => __("CLICK FOR MORE", "vp_textdomain")
			),array(
				"type" => "dropdown",
				"heading" => __("Link Target", "vp_textdomain"),
				"param_name" => "link_target",
				"value" => array("_self", "_blank", "_parent"),
				"admin_label" => false,
				"description" => __("Select link target window.", "vp_textdomain")
		  	)
	   )
	) );	
}

class WPBakeryShortCode_Ozy_Vc_Accordionmenu_item extends WPBakeryShortCode{}

/**
* Interactive Horizontal Boxes
*/
if (!function_exists('ozy_vc_iaboxes')) {
	function ozy_vc_iaboxes( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_iaboxes', $atts);
		extract(shortcode_atts(array(
			'title' => ''
		), $atts));
		
		return '<div class="ozy-iabox-wrapper">'. do_shortcode($content) .'</div>';
	}
	
	add_shortcode('ozy_vc_iaboxes', 'ozy_vc_iaboxes');
	
	vc_map( array(
		"name" => __("Interactive Horizontal Boxes", "vp_textdomain"),
		"base" => "ozy_vc_iaboxes",
		"as_parent" => array('only' => 'ozy_vc_iabox,ozy_vc_flipbox'),
		"content_element" => true,
		"show_settings_on_create" => false,	
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "width",
				"value" => "Title",
				"decription" => __("Only place holder", "vp_textdomain"),
				"admin_label" => true
		  	)		
	   ),
	   "js_view" => 'VcColumnView'
	) );
}

class WPBakeryShortCode_Ozy_Vc_Iaboxes extends WPBakeryShortCodesContainer{}

if (!function_exists('ozy_vc_iabox')) {
	function ozy_vc_iabox( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_iabox', $atts);
		extract(shortcode_atts(array(
			'box_size' => 'vc_span6',
			'title_size' => 'h2',
			'bg_color' => '#222222',
			'title_color' => '#ffffff',
			'excerpt_color' => '#ffffff',
			'use_hover' => '0',
			'bg_hover_color' => '',//#222222
			'title_hover_color' => '#ffffff',
			'excerpt_hover_color' => '#ffffff',
			'title_hover' => '',
			'excerpt_hover' => '',			
			'bg_image' => '',
			'title' => '',
			'excerpt' => '',
			'min_height' => '',
			'bg_video' => '0',
			'bg_video_mp4' => '',
			'bg_video_webm' => '',
			'bg_video_ogv' => '',
			'icon' => '',
			'link' => '',
			'link_target' => '_self'
		), $atts));
		$box_size = str_replace('vc_span', 'vc_col-sm-', $box_size);
		$bg_image = wp_get_attachment_image_src($bg_image, 'full');
		$style = ' style="';
		if(isset($bg_image[0])) {
			$style.= 'background-image:url('. $bg_image[0] .')';
		}
		if($bg_color) {
			$style.= ';background-color:'. esc_attr($bg_color);
		}
		if((int)$min_height>0) {
			$style.= ';min-height:'. $min_height .'px;';
		}
		$style.= '"';
		
		$output = '<div class="ozy-iabox '. esc_attr($box_size) .'" '. $style .'>';
		
		if($bg_video == 'on') { 
			$output .= '<video preload="auto" loop="true" autoplay="true" src="'.$bg_video_mp4.'">';
			if($bg_video_ogv) $output .='<source type="video/ogv" src="'. $bg_video_ogv .'">';
			if($bg_video_mp4) $output .='<source type="video/mp4" src="'. $bg_video_mp4 .'">';	
			if($bg_video_webm) $output .='<source type="video/webm" src="'. $bg_video_webm .'">';
			$output .= '</video>';
		}
		
		$title_hover 	= !$title_hover ? $title : $title_hover;
		$excerpt_hover 	= !$excerpt_hover ? $excerpt : $excerpt_hover;		
		
		$output.= esc_attr($title) ? '<'. esc_attr($title_size) .' style="color:'. esc_attr($title_color) .';" class="heading">'. esc_attr($title) .'</'. esc_attr($title_size) .'>' : '';
		$output.= esc_attr($excerpt) ? '<div style="color:'. esc_attr($excerpt_color) .';font-size:120%;line-height:120%">'. nl2br($excerpt) .'</div>' : '';
		$output.= esc_attr($icon) ? '<i class="'. esc_attr($icon) .'" style="color:'. esc_attr($title_color) .';"></i>' : '';
		if(esc_attr($use_hover) === 'on') {
			$output.= '<a href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'" style="background-color:'. esc_attr($bg_hover_color) .'">';
			$output.= esc_attr($title) ? '<'. esc_attr($title_size) .' style="color:'. esc_attr($title_hover_color) .';" class="heading">'. esc_attr($title_hover) .'</'. esc_attr($title_size) .'>' : '';
			$output.= esc_attr($excerpt) ? '<div style="color:'. esc_attr($excerpt_hover_color) .';font-size:120%;line-height:120%">'. nl2br($excerpt_hover) .'</div>' : '';
			$output.= esc_attr($icon) ? '<i class="'. esc_attr($icon) .'" style="color:'. esc_attr($title_hover_color) .';"></i>' : '';
			$output.= '</a>';
		}else{
			$output.= '<a href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'">';
			$output.= '&nbsp;';
			$output.= '</a>';
		}
		$output.= '</div>';
		
		return $output;
	}
	
	add_shortcode( 'ozy_vc_iabox', 'ozy_vc_iabox' );
	
	vc_map( array(
		"name" => __("Interactive Box", "vp_textdomain"),
		"base" => "ozy_vc_iabox",
		"content_element" => true,
		"as_child" => array('only' => 'ozy_vc_iaboxes'),
		"icon" => "icon-wpb-ozy-el",
		"params" => array(
			array(
				"type" => "dropdown",
				"heading" => __("Size", "vp_textdomain"),
				"param_name" => "box_size",
				"value" => array("1/2" => "vc_span6", "2/3" => "vc_span8", "1/3" => "vc_span4", "1/4" => "vc_span3"),
				"admin_label" => true
		  	),array(
				"type" => 'dropdown',
				"heading" => __("Title Size", "vp_textdomain"),
				"param_name" => "title_size",
				"value" => array("h2", "h1", "h3", "h4", "h5", "h6"),
			),array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("Background Image", "vp_textdomain"),
				"param_name" => "bg_image",
				"admin_label" => false,
				"value" => ""
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Background Color", "vp_textdomain"),
				"param_name" => "bg_color",
				"admin_label" => true,
				"value" => "#222222"
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "title",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "textarea",
				"class" => "",
				"heading" => __("Excerpt", "vp_textdomain"),
				"param_name" => "excerpt",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Title Color", "vp_textdomain"),
				"param_name" => "title_color",
				"admin_label" => true,
				"value" => "#ffffff"
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Excerpt Color", "vp_textdomain"),
				"param_name" => "excerpt_color",
				"admin_label" => true,
				"value" => "#ffffff"
			),array(
				"type" => 'dropdown',
				"heading" => __("Hover", "vp_textdomain"),
				"param_name" => "use_hover",
				"description" => __("If selected, you can set background, title and excerpt color for hover mode.", "vp_textdomain"),
				"value" => array("off", "on"),
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "title_hover",
				"admin_label" => false,
				"value" => "",
				"dependency" => Array('element' => "use_hover", 'value' => 'on')
			),array(
				"type" => "textarea",
				"class" => "",
				"heading" => __("Excerpt", "vp_textdomain"),
				"param_name" => "excerpt_hover",
				"admin_label" => false,
				"value" => "",
				"dependency" => Array('element' => "use_hover", 'value' => 'on')
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Hover Background Color", "vp_textdomain"),
				"param_name" => "bg_hover_color",
				"admin_label" => true,
				"value" => "#222222",
				"dependency" => Array('element' => "use_hover", 'value' => 'on')
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Hover Title Color", "vp_textdomain"),
				"param_name" => "title_hover_color",
				"admin_label" => true,
				"value" => "#ffffff",
				"dependency" => Array('element' => "use_hover", 'value' => 'on')
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Hover Excerpt Color", "vp_textdomain"),
				"param_name" => "excerpt_hover_color",
				"admin_label" => true,
				"value" => "#ffffff",
				"dependency" => Array('element' => "use_hover", 'value' => 'on')
			),array(
				"type" => "textfield",
				"heading" => __("Minimum Height", "vp_textdomain"),
				"param_name" => "min_height",
				"description" => __("Set minimum height of your row in pixels. Not required", "vp_textdomain")
			),array(
				"type" => 'dropdown',
				"heading" => __("Video Background", "vp_textdomain"),
				"param_name" => "bg_video",
				"description" => __("If selected, you can set background of your box as video.", "vp_textdomain"),
				"value" => array("off", "on"),
			),array(
				"type" => "textfield",
				"heading" => __("MP4 File", "vp_textdomain"),
				"param_name" => "bg_video_mp4",
				"description" => __("MP4 Video file path", "vp_textdomain"),
				"dependency" => Array('element' => "bg_video", 'value' => 'on')
			),array(
				"type" => "textfield",
				"heading" => __("WEBM File", "vp_textdomain"),
				"param_name" => "bg_video_webm",
				"description" => __("WEBM Video file path", "vp_textdomain"),
				"dependency" => Array('element' => "bg_video", 'value' => 'on')	  
			),array(
				"type" => "textfield",
				"heading" => __("OGV File", "vp_textdomain"),
				"param_name" => "bg_video_ogv",
				"description" => __("OGV Video file path", "vp_textdomain"),
				"dependency" => Array('element' => "bg_video", 'value' => 'on')
			),array(
				"type" => "select_an_icon",
				"heading" => __("Icon", "vp_textdomain"),
				"param_name" => "icon",
				"value" => '',
				"admin_label" => false,
				"description" => __("Once you select an Icon, title will not be shown on overlay.", "vp_textdomain")
		  	),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Link", "vp_textdomain"),
				"param_name" => "link",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "dropdown",
				"heading" => __("Link Target", "vp_textdomain"),
				"param_name" => "link_target",
				"value" => array("_self", "_blank", "_parent"),
				"admin_label" => false,
				"description" => __("Select link target window.", "vp_textdomain")
		  	)
	   )
	) );	
}

class WPBakeryShortCode_Ozy_Vc_Iabox extends WPBakeryShortCode{}


/**
* Textillate
*/
if (!function_exists('ozy_vc_textillate')) {
	function ozy_vc_textillate( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_textillate', $atts);
		extract(shortcode_atts(array(
			'size' 				=> '22px',
			'display_time' 		=> '2000',
			'font_color' 		=> '#000000',
			'font_weight' 		=> '300',
			'in_effect' 		=> 'fadeInLeftBig',
			'in_effect_type'	=> 'sequence',
			'out_effect' 		=> 'hinge',
			'out_effect_type'	=> 'shuffle',
			'loop'				=> 'true',
			'align'				=> ''
	    ), $atts));
		
		switch ($align) {
			case 'right':
				$align = 'width:100%;display:inline-block;text-align:right;';
				break;
			case 'center':
				$align = 'width:100%;display:inline-block;text-align:center;';
				break;
			default:
				$align = '';
		}
		
		$output = '<div class="ozy-tlt" style="'. $align .'color:'. esc_attr($font_color) .';font-weight:'. esc_attr($font_weight) .';font-size:'. esc_attr($size) .'px;line-height:'. ((int)esc_attr($size)+10) .'px" data-display_time="'. esc_attr($display_time) .'" data-in_effect="'. esc_attr($in_effect) .'" data-in_effect_type="'. esc_attr($in_effect_type) .'" data-out_effect="'. esc_attr($out_effect) .'" data-out_effect_type="'. esc_attr($out_effect_type) .'" data-loop="'. esc_attr($loop) .'">';
		$content = explode("<br />", $content);
		if(is_array($content)) {
			$output.= '<ul class="ozy-tlt-texts" style="display: none">';
			foreach($content as $line) {
				$output.= '<li>'. trim($line) .'</li>';
			}
			$output.= '</ul>';
		}
		$output.= '</div>';
		
		return $output;
	}
	
	add_shortcode('ozy_vc_textillate', 'ozy_vc_textillate');

	vc_map( array(
		"name" => __("Textillate", "vp_textdomain"),
		"base" => "ozy_vc_textillate",
		"content_element" => true,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "textarea",
				"class" => "",
				"heading" => __("Content", "vp_textdomain"),
				"param_name" => "content",
				"admin_label" => true,
				"description" => __('Each line will be processed as a slide.', 'vp_textdomain'),
				"value" => ""
			),array(
				"type" => "dropdown",
				"heading" => __("Size", "vp_textdomain"),
				"param_name" => "size",
				"value" => array("12", "14", "16", "18", "20", "22", "24", "26", "28", "30", "32", "34", "36", "38", "40", "42", "44", "46", "48", "50", "52", "54", "56", "58", "60", "62", "64", "66", "68", "70", "72", "74", "76", "78", "80", "90", "92", "94", "96", "98", "100"),
				"admin_label" => true
		  	),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Display Time", "vp_textdomain"),
				"param_name" => "display_time",
				"admin_label" => true,
				"description" => __('Sets the minimum display time for each text before it is replaced.', 'vp_textdomain'),
				"value" => "2000"
			),array(
				"type" => "dropdown",
				"heading" => __("Loop", "vp_textdomain"),
				"param_name" => "loop",
				"value" => array("true", "false"),
				"admin_label" => true
		  	),array(
				"type" => "colorpicker",
				"heading" => __("Color", "vp_textdomain"),
				"param_name" => "font_color",
				"admin_label" => false,
				"value" => "",
				"description" => __("Color of your text.", "vp_textdomain")
			),array(
				"type" => "dropdown",
				"heading" => __("Font Weight", "vp_textdomain"),
				"param_name" => "font_weight",
				"value" => array("300", "100", "200", "400", "500" , "600", "700", "800", "900"),
				"admin_label" => true
		  	),array(
				"type" => "dropdown",
				"heading" => __("In Animation Effect", "vp_textdomain"),
				"param_name" => "in_effect",
				"value" => $animate_css_effects,
				"admin_label" => true
		  	),array(
				"type" => "dropdown",
				"heading" => __("In Animation Type", "vp_textdomain"),
				"param_name" => "in_effect_type",
				"value" => array("sequence", "reverse", "sync", "shuffle"),
				"admin_label" => true
		  	),array(
				"type" => "dropdown",
				"heading" => __("Out Animation Effect", "vp_textdomain"),
				"param_name" => "out_effect",
				"value" => $animate_css_effects,
				"admin_label" => true
		  	),array(
				"type" => "dropdown",
				"heading" => __("Out Animation Type", "vp_textdomain"),
				"param_name" => "out_effect_type",
				"value" => array("sequence", "reverse", "sync", "shuffle"),
				"admin_label" => true
		  	),array(
				"type" => "dropdown",
				"heading" => __("Text Align", "vp_textdomain"),
				"param_name" => "align",
				"value" => array("left", "center", "right"),
				"admin_label" => true
		  	)								
	   )
	) );
}


/**
* Floating Box
*/
if (!function_exists('ozy_vc_floatingbox')) {
	function ozy_vc_floatingbox( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_floatingbox', $atts);
		extract(shortcode_atts(array(
			'height' => '300px',
			'align' => 'left'
		), $atts));
		
		return '<div class="ozy-floating-box" style="height:'. esc_attr($height) .';text-align:'. esc_attr($align) .'"><div>'. do_shortcode($content) .'</div></div>';
	}
	
	add_shortcode('ozy_vc_floatingbox', 'ozy_vc_floatingbox');
	
	vc_map( array(
		"name" => __("Floating Box", "vp_textdomain"),
		"base" => "ozy_vc_floatingbox",
		"as_parent" => array('except ' => ''),
		"content_element" => true,
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => __("Height", "vp_textdomain"),
				"param_name" => "height",
				"value" => "300px",
				"description" => __("Please set same height as your row height as initial value, in order to make it work as expected", "vp_textdomain"),
				"admin_label" => true
		  	),array(
				"type" => "dropdown",
				"heading" => __("Content Align", "vp_textdomain"),
				"param_name" => "align",
				"value" => array("left", "center", "right"),
				"admin_label" => true
		  	)			
	   ),
	   "js_view" => 'VcColumnView'
	) );
}

class WPBakeryShortCode_Ozy_Vc_Floatingbox extends WPBakeryShortCodesContainer{}

/**
* Parallaxbox 3
*/
if (!function_exists('ozy_vc_parallaxbox3')) {
	function ozy_vc_parallaxbox3( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_parallaxbox3', $atts);
		extract(shortcode_atts(array(
			'height'	=> '300',
			'relativeInput' => 'true',
			'clipRelativeInput' => 'true',
			'calibrate_x' => 'true',
			'calibrate_y' => 'true',
			'invert_x' => 'false',
			'invert_y' => 'false',
			'limit_x' => 'false',
			'limit_y' => 'false',
			'scalar_x' => '5',
			'scalar_y' => '5',
			'friction_x' => '0',
			'friction_y' => '0'
	    ), $atts));
		
		$output = '<ul style="height:110%;overflow:hidden" class="parallax-viewport3 scene" 
		data-relativeInput="'. esc_attr($relativeInput) .'"
		data-clipRelativeInput="'. esc_attr($clipRelativeInput) .'"
		data-calibrate-x="'. esc_attr($calibrate_x) .'"
		data-calibrate-y="'. esc_attr($calibrate_y) .'"
		data-invert-x="'. esc_attr($invert_x) .'"
		data-invert-y="'. esc_attr($invert_y) .'"
		data-limit-x="'. esc_attr($limit_x) .'"
		data-limit-y="'. esc_attr($limit_y) .'"
		data-scalar-x="'. esc_attr($scalar_x) .'"
		data-scalar-y="'. esc_attr($scalar_y) .'"
		data-friction-x="'. esc_attr($friction_x) .'"
		data-friction-y="'. esc_attr($friction_y) .'">';
		$output.= do_shortcode($content);
		$output.= '</ul>';
		
		return $output;
	}
	
	add_shortcode('ozy_vc_parallaxbox3', 'ozy_vc_parallaxbox3');
	
	vc_map( array(
		"name" => __("Parallax Box 3", "vp_textdomain"),
		"base" => "ozy_vc_parallaxbox3",
		"as_parent" => array('only' => 'ozy_vc_parallaxbox3_layer'),
		"content_element" => true,
		"show_settings_on_create" => false,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Height", "vp_textdomain"),
				"param_name" => "height",
				"admin_label" => true,
				"description" => __('Height of the box in pixels.', 'vp_textdomain'),
				"value" => "300"
			),array(
				"type" => "dropdown",
				"heading" => __("Relative Input", "vp_textdomain"),
				"param_name" => "relativeInput",
				"value" => array("true", "false"),
				"admin_label" => true,
				"description" => __('Specifies whether or not to use the coordinate system of the element passed to the parallax constructor. Mouse input only.', 'vp_textdomain')
		  	),array(
				"type" => "dropdown",
				"heading" => __("Clip Relative Input", "vp_textdomain"),
				"param_name" => "relativeInput",
				"value" => array("true", "false"),
				"admin_label" => true,
				"description" => __('Specifies whether or not to clip the mouse input to the bounds of the element passed to the parallax constructor. Mouse input only.', 'vp_textdomain')
		  	),array(
				"type" => "dropdown",
				"heading" => __("Calibrate X", "vp_textdomain"),
				"param_name" => "calibrate_x",
				"value" => array("true", "false"),
				"admin_label" => true,
				"description" => __('Specifies whether or not to cache & calculate the motion relative to the initial x axis value on initialisation.', 'vp_textdomain')
		  	),array(
				"type" => "dropdown",
				"heading" => __("Calibrate Y", "vp_textdomain"),
				"param_name" => "calibrate_y",
				"value" => array("true", "false"),
				"admin_label" => true,
				"description" => __('Specifies whether or not to cache & calculate the motion relative to the initial y axis value on initialisation.', 'vp_textdomain')
		  	),array(
				"type" => "dropdown",
				"heading" => __("Invert X", "vp_textdomain"),
				"param_name" => "invert_x",
				"value" => array("true", "false"),
				"admin_label" => true,
				"description" => __('true moves layers in opposition to the device motion, false slides them away.', 'vp_textdomain')
		  	),array(
				"type" => "dropdown",
				"heading" => __("Invert Y", "vp_textdomain"),
				"param_name" => "invert_y",
				"value" => array("true", "false"),
				"admin_label" => true,
				"description" => __('true moves layers in opposition to the device motion, false slides them away.', 'vp_textdomain')
		  	),array(
				"type" => "dropdown",
				"heading" => __("Limit X", "vp_textdomain"),
				"param_name" => "limit_x",
				"value" => array("false", "1"),
				"admin_label" => true,
				"description" => __('A numeric value limits the total range of motion in x, false allows layers to move with complete freedom.', 'vp_textdomain')
		  	),array(
				"type" => "dropdown",
				"heading" => __("Limit Y", "vp_textdomain"),
				"param_name" => "limit_y",
				"value" => array("false", "1"),
				"admin_label" => true,
				"description" => __('A numeric value limits the total range of motion in y, false allows layers to move with complete freedom.', 'vp_textdomain')
		  	),array(
				"type" => "textfield",
				"heading" => __("Scalar X", "vp_textdomain"),
				"param_name" => "scalar_x",
				"value" => '5',
				"admin_label" => true,
				"description" => __('Multiplies the input motion by this value, increasing or decreasing the sensitivity of the layer motion.', 'vp_textdomain')
		  	),array(
				"type" => "textfield",
				"heading" => __("Scalar Y", "vp_textdomain"),
				"param_name" => "scalar_y",
				"value" => '5',
				"admin_label" => true,
				"description" => __('Multiplies the input motion by this value, increasing or decreasing the sensitivity of the layer motion.', 'vp_textdomain')
		  	),array(
				"type" => "dropdown",
				"heading" => __("Friction X", "vp_textdomain"),
				"param_name" => "friction_x",
				"value" => array("0", "1"),
				"admin_label" => true,
				"description" => __('The amount of friction the layers experience. This essentially adds some easing to the layer motion.', 'vp_textdomain')
		  	),array(
				"type" => "dropdown",
				"heading" => __("Friction Y", "vp_textdomain"),
				"param_name" => "friction_y",
				"value" => array("0", "1"),
				"admin_label" => true,
				"description" => __('The amount of friction the layers experience. This essentially adds some easing to the layer motion.', 'vp_textdomain')
		  	)			
	   ),
	   "js_view" => 'VcColumnView'
	) );
}

class WPBakeryShortCode_Ozy_Vc_Parallaxbox3 extends WPBakeryShortCodesContainer{}

if (!function_exists('ozy_vc_parallaxbox3_layer')) {
	function ozy_vc_parallaxbox3_layer( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_parallaxbox3_layer', $atts);
		extract(shortcode_atts(array(
			'src' => '',
			'depth' => '1.0',
			'opacity' => '1'
		), $atts));
		
		$parallax_img = wp_get_attachment_image_src($src, 'full');
		if(isset($parallax_img[0]) && isset($parallax_img[1]) && isset($parallax_img[2])) {
			return '<li class="layer" data-depth="'. esc_attr($depth) .'" '. (esc_attr($opacity)!='1' ? 'style="opacity:'. esc_attr($opacity) .'"':'') .'><img src="'. $parallax_img[0] .'"  width="'. $parallax_img[1] .'" height="'. $parallax_img[2] .'"></li>';
		}
		return '';
	}
	
	add_shortcode( 'ozy_vc_parallaxbox3_layer', 'ozy_vc_parallaxbox3_layer' );
	
	vc_map( array(
		"name" => __("Parallax Box 3 Layer", "vp_textdomain"),
		"base" => "ozy_vc_parallaxbox3_layer",
		"content_element" => true,
		"as_child" => array('only' => 'ozy_vc_parallaxbox3'),
		"icon" => "icon-wpb-ozy-el",
		"params" => array(
			array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("Image", "vp_textdomain"),
				"param_name" => "src",
				"admin_label" => false,
				"value" => "",
				"description" => __("Select images for layer.", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Depth", "vp_textdomain"),
				"param_name" => "depth",
				"admin_label" => true,
				"description" => __('Please enter values like; 1.00, 0.50, 0.80.', 'vp_textdomain'),
				"value" => "1.00"
			),array(
				"type" => "dropdown",
				"heading" => __("Opacity", "vp_textdomain"),
				"param_name" => "opacity",
				"value" => array("1", "0.9", "0.8", "0.7", "0.6", "0.5", "0.4", "0.3", "0.2", "0.1"),
				"admin_label" => true,
				"description" => __('Opacity of the layer.', 'vp_textdomain')
		  	)
	   )
	) );	
}

class WPBakeryShortCode_Ozy_Vc_Parallaxbox3_layer extends WPBakeryShortCode{}

/**
* Parallaxbox 2
*/
if (!function_exists('ozy_vc_parallaxbox2')) {
	function ozy_vc_parallaxbox2( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_parallaxbox2', $atts);
		extract(shortcode_atts(array(
			'height'	=> '300',
			'mouseport' => 'yes'
	    ), $atts));
		
		$output = '<div class="parallax-viewport2" data-mouseport="'. esc_attr($mouseport) .'" style="height:'. esc_attr($height) .'px">';
		$output.= do_shortcode($content);
		$output.= '</div>';
		
		return $output;
	}
	
	add_shortcode('ozy_vc_parallaxbox2', 'ozy_vc_parallaxbox2');
	
	vc_map( array(
		"name" => __("Parallax Box 2", "vp_textdomain"),
		"base" => "ozy_vc_parallaxbox2",
		"as_parent" => array('only' => 'ozy_vc_parallaxbox2_layer'),
		"content_element" => true,
		"show_settings_on_create" => false,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Height", "vp_textdomain"),
				"param_name" => "height",
				"admin_label" => true,
				"description" => __('Height of the box in pixels.', 'vp_textdomain'),
				"value" => "300"
			),array(
				"type" => "dropdown",
				"heading" => __("Mouse Port", "vp_textdomain"),
				"param_name" => "mouseport",
				"value" => array("yes", "no"),
				"admin_label" => true,
				"description" => __('Identifies DOM node to track the mouse in. If yes, parallax only works whenever mouse over this box.', 'vp_textdomain')
		  	)		
	   ),
	   "js_view" => 'VcColumnView'
	) );
}

class WPBakeryShortCode_Ozy_Vc_Parallaxbox2 extends WPBakeryShortCodesContainer{}

if (!function_exists('ozy_vc_parallaxbox2_layer')) {
	function ozy_vc_parallaxbox2_layer( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_parallaxbox2_layer', $atts);
		extract(shortcode_atts(array(
			'src' => '',
			'xparallax' => 'true',
			'yparallax' => 'true',			
			'xorigin' => '0.5',
			'yorigin' => '0.5',
			'decay' => '0.66',
			'frameDuration' => '30'

		), $atts));
		
		$parallax_img = wp_get_attachment_image_src($src, 'full');
		if(isset($parallax_img[0]) && isset($parallax_img[1]) && isset($parallax_img[2])) {
			return '<div class="parallax-layer" data-yparallax="'. esc_attr($yparallax) .'"  data-xparallax="'. esc_attr($xparallax) .'" data-xorigin="'. esc_attr($xorigin) .'" data-yorigin="'. esc_attr($yorigin) .'" data-decay="'. esc_attr($decay) .'" data-frameduration="'. esc_attr($frameDuration) .'" style="width:'. $parallax_img[1] .'px; height:'. $parallax_img[2] .'px;"><img src="'. $parallax_img[0] .'" alt=""/></div>';
		}
		return '';
	}
	
	add_shortcode( 'ozy_vc_parallaxbox2_layer', 'ozy_vc_parallaxbox2_layer' );
	
	vc_map( array(
		"name" => __("Parallax Box 2 Layer", "vp_textdomain"),
		"base" => "ozy_vc_parallaxbox2_layer",
		"content_element" => true,
		"as_child" => array('only' => 'ozy_vc_parallaxbox2'),
		"icon" => "icon-wpb-ozy-el",
		"params" => array(
			array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("Image", "vp_textdomain"),
				"param_name" => "src",
				"admin_label" => false,
				"value" => "",
				"description" => __("Select images for layer.", "vp_textdomain")
			),array(
				"type" => "dropdown",
				"heading" => __("X-Parallax", "vp_textdomain"),
				"param_name" => "xparallax",
				"value" => array("true", "false"),
				"admin_label" => true,
				"description" => __('Set it yes to make your parallax move on X axis.', 'vp_textdomain')
		  	),array(
				"type" => "dropdown",
				"heading" => __("Y-Parallax", "vp_textdomain"),
				"param_name" => "yparallax",
				"value" => array("true", "false"),
				"admin_label" => true,
				"description" => __('Set it yes to make your parallax move on Y axis.', 'vp_textdomain')
		  	),array(
				"type" => "dropdown",
				"heading" => __("X-Origin", "vp_textdomain"),
				"param_name" => "xorigin",
				"value" => array("0.5", "left", "center", "middle", "right"),
				"admin_label" => true
		  	),array(
				"type" => "dropdown",
				"heading" => __("Y-Origin", "vp_textdomain"),
				"param_name" => "yorigin",
				"value" => array("0.5", "top", "center", "middle", "bottom"),
				"admin_label" => true
		  	),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Decay", "vp_textdomain"),
				"param_name" => "decay",
				"admin_label" => true,
				"description" => __("Between 0-1 only. Sets the rate at which the layers 'catch up' with the mouse position. 0 is instantly, 1 is forever.", "vp_textdomain"),
				"value" => "0.66"
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Frame Duration", "vp_textdomain"),
				"param_name" => "frameDuration",
				"admin_label" => true,
				"description" => __("Int milliseconds. Length of time between animation frames. With a lot of big layers, you may want to increase the frame duration to save CPU. About 50 is acceptable (20 frames/second), but I like it zippy. Modern browsers like Google Chrome have really accurate timing, but many older browsers choke below about 15ms.", "vp_textdomain"),
				"value" => "30"
			)
	   )
	) );	
}

class WPBakeryShortCode_Ozy_Vc_Parallaxbox2_layer extends WPBakeryShortCode{}

/**
* Parallaxbox
*/
if (!function_exists('ozy_vc_parallaxbox')) {
	function ozy_vc_parallaxbox( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_parallaxbox', $atts);
		extract(shortcode_atts(array(
			'src'		=> '',
			'height'	=> '300',
			'mouseport' => 'yes',
			'xparallax' => 'true',
			'yparallax' => 'true'
	    ), $atts));
		
		$output = '<div class="parallax-viewport" data-mouseport="'. esc_attr($mouseport) .'" data-yparallax="'. esc_attr($yparallax) .'"  data-xparallax="'. esc_attr($xparallax) .'" style="height:'. esc_attr($height) .'px">';
		$src_arr = explode(',', $src);
		if(is_array($src_arr)) {
			foreach($src_arr as $s) {
				$parallax_img = wp_get_attachment_image_src($s, 'full');
				if(isset($parallax_img[0]) && isset($parallax_img[1]) && isset($parallax_img[2])) {
					$output.='<div class="parallax-layer" style="width:'. $parallax_img[1] .'px; height:'. $parallax_img[2] .'px;"><img src="'. $parallax_img[0] .'" alt=""/></div>';
				}
			}
		}
		$output.= '</div>';
		
		return $output;
	}
	
	add_shortcode('ozy_vc_parallaxbox', 'ozy_vc_parallaxbox');

	vc_map( array(
		"name" => __("Parallax Box", "vp_textdomain"),
		"base" => "ozy_vc_parallaxbox",
		"content_element" => true,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "attach_images",
				"class" => "",
				"heading" => __("Layer Images", "vp_textdomain"),
				"param_name" => "src",
				"admin_label" => true,
				"value" => "",
				"description" => __("Select images for your parallax slider.", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Height", "vp_textdomain"),
				"param_name" => "height",
				"admin_label" => true,
				"description" => __('Height of the box in pixels.', 'vp_textdomain'),
				"value" => "300"
			),array(
				"type" => "dropdown",
				"heading" => __("Mouse Port", "vp_textdomain"),
				"param_name" => "mouseport",
				"value" => array("yes", "no"),
				"admin_label" => true,
				"description" => __('Identifies DOM node to track the mouse in. If yes, parallax only works whenever mouse over this box.', 'vp_textdomain')
		  	),array(
				"type" => "dropdown",
				"heading" => __("X-Parallax", "vp_textdomain"),
				"param_name" => "xparallax",
				"value" => array("true", "false"),
				"admin_label" => true,
				"description" => __('Set it yes to make your parallax move on X axis.', 'vp_textdomain')
		  	),array(
				"type" => "dropdown",
				"heading" => __("Y-Parallax", "vp_textdomain"),
				"param_name" => "yparallax",
				"value" => array("true", "false"),
				"admin_label" => true,
				"description" => __('Set it yes to make your parallax move on Y axis.', 'vp_textdomain')
		  	)
	   )
	) );
}

/**
* Morph Text
*/
if (!function_exists('ozy_vc_morphtext')) {
	function ozy_vc_morphtext( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_morphtext', $atts);
		extract(shortcode_atts(array(
			'text_before'	=> '',
			'text_after' 	=> '',
			'text_rotate'	=> '',
			'size' 			=> 'h1',
			'font_color' 	=> '#000000',
			'rotating_color'=> '#000000',
			'separator' 	=> ',',
			'effect' 		=> 'bounceIn',
			'speed' 		=> '2000'
	    ), $atts));
		
		return '<div><'. esc_attr($size) .' class="ozy-morph-text" style="color:'. esc_attr($font_color) .'" data-separator="'. esc_attr($separator) .'" data-effect="'. esc_attr($effect) .'" data-speed="'. esc_attr($speed) .'"><span class="bt">'. esc_attr($text_before) .'</span> <span class="text-rotate" style="color:'. esc_attr($rotating_color) .'">'. esc_attr($text_rotate) .'</span> '. esc_attr($text_after) .'</'. esc_attr($size) .'"></div>';
	}
	
	add_shortcode('ozy_vc_morphtext', 'ozy_vc_morphtext');

	vc_map( array(
		"name" => __("Morph Text", "vp_textdomain"),
		"base" => "ozy_vc_morphtext",
		"content_element" => true,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Before Rotating Text", "vp_textdomain"),
				"param_name" => "text_before",
				"admin_label" => true,
				"description" => __('This text will be shown before rotating text.', 'vp_textdomain'),
				"value" => ""
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("After Rotating Text", "vp_textdomain"),
				"param_name" => "text_after",
				"admin_label" => true,
				"description" => __('This text will be shown after rotating text.', 'vp_textdomain'),
				"value" => ""
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Rotating Text", "vp_textdomain"),
				"param_name" => "text_rotate",
				"admin_label" => true,
				"description" => __('Use separator between words, default ",". Seperator could be managed by the box below.', 'vp_textdomain'),
				"value" => ""
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Separator", "vp_textdomain"),
				"param_name" => "separator",
				"admin_label" => true,
				"description" => __('If you don\'t want commas to be the separator, you can define a new separator (|, &, * etc.) by yourself using this field.', 'vp_textdomain'),
				"value" => ","
			),array(
				"type" => "dropdown",
				"heading" => __("Size", "vp_textdomain"),
				"param_name" => "size",
				"value" => array("h1", "h2", "h3", "h4", "h5", "h6"),
				"admin_label" => true
		  	),array(
				"type" => "colorpicker",
				"heading" => __("Color", "vp_textdomain"),
				"param_name" => "font_color",
				"admin_label" => false,
				"value" => "",
				"description" => __("Color of your text.", "vp_textdomain")
			),array(
				"type" => "colorpicker",
				"heading" => __("Rotating Text Color", "vp_textdomain"),
				"param_name" => "rotating_color",
				"admin_label" => false,
				"value" => "",
				"description" => __("Color of your rotating text.", "vp_textdomain")
			),array(
				"type" => "dropdown",
				"heading" => __("Effect", "vp_textdomain"),
				"param_name" => "effect",
				"value" => $animate_css_effects,
				"admin_label" => true
		  	),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Speed", "vp_textdomain"),
				"param_name" => "speed",
				"admin_label" => true,
				"description" => __('How many milliseconds until the next word show.', 'vp_textdomain'),
				"value" => "2000"
			)						
	   )
	) );
}

/**
* Spacer
*/
if (!function_exists('ozy_vc_spacer')) {
	function ozy_vc_spacer( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_spacer', $atts);
		extract(shortcode_atts(array(
			'size' 			=> '30px'
	    ), $atts));
		
		return '<div style="height:'. esc_attr($size) .'" class="ozy-spacer"></div>';
	}
	
	add_shortcode('ozy_vc_spacer', 'ozy_vc_spacer');

	vc_map( array(
		"name" => __("Spacer", "vp_textdomain"),
		"base" => "ozy_vc_spacer",
		"content_element" => true,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Size", "vp_textdomain"),
				"param_name" => "size",
				"admin_label" => true,
				"description" => __('Enter size like 10px, 3em. Please don\'t use percentage values.', 'vp_textdomain'),
				"value" => "30px"
			)
	   )
	) );
}

/**
* Royal Slider
*/
if (!function_exists('ozy_vc_slider')) {
	function ozy_vc_slider( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_slider', $atts);
		extract(shortcode_atts(array(
			'size' => 'auto',
			'width' => '100%',
			'height' => '',
			'slider_style' => ''
		), $atts));
		
		wp_enqueue_script('royalslider');
		wp_enqueue_style('royalslider');
		
		if('' == esc_attr($slider_style)) {
			$slider_style = esc_attr($slider_style);
		}else if('vertical' == esc_attr($slider_style)){
			$slider_style = '-' . esc_attr($slider_style);
		}		
		wp_enqueue_style('rs-minimal-white');
		
		$style = '';
		if(trim($width)) {
			$style .= 'width:' . esc_attr($width) . ';';
		}
		if(trim($height)) {
			$style .= 'height:' . esc_attr($height);
		}
		
		$size_arr = array('auto' => 'auto-height-slider', 'fixed' => 'fixed-slider');
		
		if('full' != esc_attr($size)) {
			return '<div class="royalSlider rsMinW '. (strtr(esc_attr($size), $size_arr)) . ' ozy-slider ' . $slider_style .'" style="'. $style .'">' . PHP_EOL . do_shortcode( $content ) . PHP_EOL .'</div>';
		}else{
			return '<div class="royalSlider rsMinW " data-orientation="'. (esc_attr($slider_style)===''?'horizontal':'vertical') .'" id="royal-classic-full">' . PHP_EOL . ozy_fix_unwanted_p(do_shortcode( $content )) . PHP_EOL .'</div>';
		}
	}
	
	add_shortcode('ozy_vc_slider', 'ozy_vc_slider');
	
	vc_map( array(
		"name" => __("Royal Slider", "vp_textdomain"),
		"base" => "ozy_vc_slider",
		"as_parent" => array('only' => 'ozy_vc_slide'),
		"content_element" => true,
		"show_settings_on_create" => false,
		"icon" => "icon-wpb-ozy-el",	
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "dropdown",
				"heading" => __("Size", "vp_textdomain"),
				"param_name" => "size",
				"value" => array("auto", "fixed"),
				"admin_label" => true
		  	),		
			array(
				"type" => "textfield",
				"heading" => __("Width", "vp_textdomain"),
				"param_name" => "width",
				"value" => "100%",
				"admin_label" => true
		  	),		
			array(
				"type" => "textfield",
				"heading" => __("Height", "vp_textdomain"),
				"param_name" => "height",
				"value" => "",
				"admin_label" => true
		  	),
			array(
				"type" => "dropdown",
				"heading" => __("Slider Style", "vp_textdomain"),
				"param_name" => "slider_style",
				"value" => array("horizontal", "vertical"),
				"admin_label" => true
		  	),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", "vp_textdomain"),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
			)			
	   ),
	   "js_view" => 'VcColumnView'
	) );
}

class WPBakeryShortCode_Ozy_Vc_Slider extends WPBakeryShortCodesContainer{}

if (!function_exists('ozy_vc_slide')) {
	function ozy_vc_slide( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_slide', $atts);
		extract(shortcode_atts(array(
			'src' => '',
			'video' => '',
			'caption_align' => 'TopLeft', //TopLeft,TopRight,BottomLeft,BottomRight
			'caption_style' => 'Black' //Black,White

		), $atts));
		
		$thumb = wp_get_attachment_image_src($src, 'full');
		if(isset($thumb[0])) {
			$src = $thumb[0];
		}
		
		$output = '<div class="rsContent" data-rsDelay="6000">';
		if($video) {
			$output.= '<a class="rsImg" data-rsvideo="'. esc_attr($video) .'" href="'. esc_attr($src) .'"></a>';
		}else{
			$output.= '<img class="rsImg" src="'. esc_attr($src) .'"/>';
		}
		if(trim($content)) {
			$output.= '<div class="infoBlock infoBlock'. esc_attr($caption_align) .' infoBlock'. esc_attr($caption_style) .' rsABlock" data-fade-effect="fa;se" data-move-offset="100" data-move-effect="bottom" data-speed="500">';
			$output.= str_replace('<br />', '', do_shortcode($content));
			$output.= '</div>';
		}
		$output.= '</div>';
		
		return $output;
	}
	
	add_shortcode( 'ozy_vc_slide', 'ozy_vc_slide' );
	
	vc_map( array(
		"name" => __("Royal Slider Slide", "vp_textdomain"),
		"base" => "ozy_vc_slide",
		"content_element" => true,
		"as_child" => array('only' => 'ozy_vc_slider'),
		"icon" => "icon-wpb-ozy-el",
		"params" => array(
			array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("Image", "vp_textdomain"),
				"param_name" => "src",
				"admin_label" => false,
				"value" => "",
				"description" => __("Select images for your slider.", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Video Path", "vp_textdomain"),
				"param_name" => "video",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "textarea_html",
				"class" => "",
				"heading" => __("Caption", "vp_textdomain"),
				"param_name" => "content",
				"admin_label" => false,
				"value" => ""
			),array(
				"type" => "dropdown",
				"heading" => __("Caption Align", "vp_textdomain"),
				"param_name" => "caption_align",
				"value" => array("TopLeft", "TopRight", "BottomLeft", "BottomRight"),
				"admin_label" => true
		  	),array(
				"type" => "dropdown",
				"heading" => __("Caption Style", "vp_textdomain"),
				"param_name" => "caption_style",
				"value" => array("Black", "White"),
				"admin_label" => true
		  	)
	   )
	) );	
}

class WPBakeryShortCode_Ozy_Vc_Slide extends WPBakeryShortCode{}

/**
* Owl Carousel Feeder
*/
if (!function_exists('ozy_vc_owlcarousel_feed')) {
	function ozy_vc_owlcarousel_feed( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_owlcarousel_feed', $atts);
		extract(shortcode_atts(array(
			'data_source'	=> 'blog',
			'bg_color'		=> '',
			'link_caption' 	=> 'Find out more →',
			'link_target'	=> '',
			'default_overlay' => 'off',
			'autoplay'		=> '',
			'items'			=> '',
			'singleitem'	=> '',
			'slidespeed'	=> '',
			'autoheight'	=> '',
			'extra_css'		=> '',
			'css_animation' => ''
	    ), $atts));
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}		

		$output = '<div class="ozy-owlcarousel with-feed '. $css_animation .'" data-autoplay="'. esc_attr($autoplay) .'" data-items="'. esc_attr($items) .'" data-singleitem="'. esc_attr($singleitem) .'" data-slidespeed="'. esc_attr($slidespeed) .'" data-autoheight="'. esc_attr($autoheight) .'">' . PHP_EOL;

		$args = array(
			'post_type' 			=> (esc_attr($data_source) == 'portfolio' ? 'ozy_portfolio' : 'post'),
			'posts_per_page'		=> '8',
			'orderby' 				=> 'date',
			'order' 				=> 'DESC',
			'ignore_sticky_posts' 	=> 1,							
			'meta_key' 				=> '_thumbnail_id'
		);

		$the_query = new WP_Query( $args );
			
		while ( $the_query->have_posts() ) {
			$the_query->the_post();

			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'showbiz');
			
			$style = esc_attr($bg_color) ? ' style="background-color:'. esc_attr($bg_color) .';" ' : ''; //height:278px;
			$output .= '<div class="item item-extended" '. $style .'>';
			if(isset($thumb[0])) {
				$output .= '<img class="lazyOwl" data-src="'. $thumb[0] .'" alt="'. get_the_title() .'"/>';
			}else{
				$output .= '<img class="lazyOwl" data-src="'. OZY_BASE_URL .'images/blank-large.gif" alt=""/>';
			}
			$output .= '<a href="'. get_permalink() .'" target="'. esc_attr($link_target) .'">';
			$output .= '<div class="overlay-two">';
			$output .= '<div>';
			$output .= '<h2>'. get_the_title() .'</h2>';
			$output .= '<h5>'. get_the_date() .'</h5>';
			$output .= '</div>';			
			$output .= '</div>';
			$output .= '</a>';
			$output .= '</div>';			
		}
		wp_reset_postdata();		
		
		$output.= do_shortcode( $content );
		$output.= PHP_EOL .'</div>';
		
		return $output;
	}
	
	add_shortcode('ozy_vc_owlcarousel_feed', 'ozy_vc_owlcarousel_feed');
	
	vc_map( array(
		"name" => __("Owl Carousel Feed", "vp_textdomain"),
		"base" => "ozy_vc_owlcarousel_feed",
		"content_element" => true,
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "dropdown",
				"heading" => __("Data Source", "vp_textdomain"),
				"param_name" => "data_source",
				"value" => array("blog", "portfolio"),
				"admin_label" => true,
				"description" => __("Choose source of your feed.", "vp_textdomain")
		  	),
			array(
				"type" => "colorpicker",
				"heading" => __("Carousel Background", "vp_textdomain"),
				"param_name" => "bg_color",
				"admin_label" => false,
				"value" => "",
				"description" => __("Not requrired. Select a background color for your item.", "vp_textdomain")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Default Overlay?", "vp_textdomain"),
				"param_name" => "default_overlay",
				"value" => array("off", "on"),
				"admin_label" => false,
				"description" => __("ON/OFF default overlay on your items.", "vp_textdomain")
		  	),		
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Link Caption", "vp_textdomain"),
				"param_name" => "link_caption",
				"admin_label" => true,
				"value" => __("Find out more →", "vp_textdomain")
			),array(
				"type" => "dropdown",
				"heading" => __("Link Target", "vp_textdomain"),
				"param_name" => "link_target",
				"value" => array("_self", "_blank", "_parent"),
				"admin_label" => false,
				"description" => __("Select link target window.", "vp_textdomain")
		  	),					
			array(
				"type" => "dropdown",
				"heading" => __("Auto Play", "vp_textdomain"),
				"param_name" => "autoplay",
				"value" => array("true", "false", "1000", "2000", "3000", "4000", "5000", "6000", "7000", "8000", "9000", "10000"),
				"admin_label" => true,
				"description" => __("Change to any available integrer for example 3000 to play every 3 seconds. If you set it true default speed will be 5 seconds.", "vp_textdomain")
		  	),		
			array(
				"type" => "dropdown",
				"heading" => __("Item Count", "vp_textdomain"),
				"param_name" => "items",
				"value" => array("3", "1", "2", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16"),
				"admin_label" => true,
				"description" => __("This variable allows you to set the maximum amount of items displayed at a time with the widest browser width.", "vp_textdomain")
		  	),
			array(
				"type" => "dropdown",
				"heading" => __("Show Single Item?", "vp_textdomain"),
				"param_name" => "singleitem",
				"value" => array("false", "true"),
				"admin_label" => true,
				"description" => __("Display only one item. Set Item Count to 1 to make it work as expected.", "vp_textdomain")
		  	),
			array(
				"type" => "dropdown",
				"heading" => __("Slide Speed", "vp_textdomain"),
				"param_name" => "slidespeed",
				"value" => array("200", "100", "300", "400", "500", "600", "700", "800", "900", "1000", "1100", "1200", "1300", "1400", "1500", "1600", "1700", "1800", "1900", "2000"),
				"admin_label" => true,
				"description" => __("Slide speed in milliseconds.", "vp_textdomain")
		  	),
			array(
				"type" => "dropdown",
				"heading" => __("Auto Height", "vp_textdomain"),
				"param_name" => "autoheight",
				"value" => array("false", "true"),
				"admin_label" => true,
				"description" => __("Add height to owl-wrapper-outer so you can use diffrent heights on slides. Use it only for one item per page setting.", "vp_textdomain")
		  	),		
			$add_css_animation,
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", "vp_textdomain"),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
			)			
	   )
	) );
}

/**
* Owl Carousel
*/
if (!function_exists('ozy_vc_owlcarousel_wrapper')) {
	function ozy_vc_owlcarousel_wrapper( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_owlcarousel_wrapper', $atts);
		extract(shortcode_atts(array(
			'autoplay'		=> 'true',
			'items'			=> '4',
			'singleitem'	=> 'false',
			'slidespeed'	=> '200',
			'autoheight'	=> 'false',
			'extra_css'		=> '',
			'css_animation' => '',
			'bullet_nav'	=> 'on'
	    ), $atts));
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}		

		return '<div class="ozy-owlcarousel '. (esc_attr($bullet_nav) != 'on' ? 'navigation-off' : '') .' '. $css_animation .'" data-autoplay="'. esc_attr($autoplay) .'" data-items="'. esc_attr($items) .'" data-singleitem="'. esc_attr($singleitem) .'" data-slidespeed="'. esc_attr($slidespeed) .'" data-autoheight="'. esc_attr($autoheight) .'">' . PHP_EOL . do_shortcode( $content ) . PHP_EOL .'</div>';
	}
	
	add_shortcode('ozy_vc_owlcarousel_wrapper', 'ozy_vc_owlcarousel_wrapper');
	
	vc_map( array(
		"name" => __("Owl Carousel", "vp_textdomain"),
		"base" => "ozy_vc_owlcarousel_wrapper",
		"as_parent" => array('only' => 'ozy_vc_owlcarousel,ozy_vc_owlcarousel2'), //vc_single_image
		"content_element" => true,
		"show_settings_on_create" => false,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "dropdown",
				"heading" => __("Auto Play", "vp_textdomain"),
				"param_name" => "autoplay",
				"value" => array("true", "false", "1000", "2000", "3000", "4000", "5000", "6000", "7000", "8000", "9000", "10000"),
				"admin_label" => true,
				"description" => __("Change to any available integrer for example 3000 to play every 3 seconds. If you set it true default speed will be 5 seconds.", "vp_textdomain")
		  	),		
			array(
				"type" => "dropdown",
				"heading" => __("Item Count", "vp_textdomain"),
				"param_name" => "items",
				"value" => array("4", "1", "2", "3", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16"),
				"admin_label" => true,
				"description" => __("This variable allows you to set the maximum amount of items displayed at a time with the widest browser width.", "vp_textdomain")
		  	),
			array(
				"type" => "dropdown",
				"heading" => __("Show Single Item?", "vp_textdomain"),
				"param_name" => "singleitem",
				"value" => array("false", "true"),
				"admin_label" => true,
				"description" => __("Display only one item. Set Item Count to 1 to make it work as expected.", "vp_textdomain")
		  	),
			array(
				"type" => "dropdown",
				"heading" => __("Slide Speed", "vp_textdomain"),
				"param_name" => "slidespeed",
				"value" => array("200", "100", "300", "400", "500", "600", "700", "800", "900", "1000", "1100", "1200", "1300", "1400", "1500", "1600", "1700", "1800", "1900", "2000"),
				"admin_label" => true,
				"description" => __("Slide speed in milliseconds.", "vp_textdomain")
		  	),
			array(
				"type" => "dropdown",
				"heading" => __("Auto Height", "vp_textdomain"),
				"param_name" => "autoheight",
				"value" => array("false", "true"),
				"admin_label" => true,
				"description" => __("Add height to owl-wrapper-outer so you can use diffrent heights on slides. Use it only for one item per page setting.", "vp_textdomain")
		  	),
			array(
				"type" => "dropdown",
				"heading" => __("Bullet Navigation", "vp_textdomain"),
				"param_name" => "bullet_nav",
				"value" => array("on", "off"),
				"admin_label" => true
		  	),		
			$add_css_animation,
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", "vp_textdomain"),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
			)			
	   ),
	   "js_view" => 'VcColumnView'
	) );
}

if (!function_exists('ozy_vc_owlcarousel')) {
	function ozy_vc_owlcarousel( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_owlcarousel', $atts);
		extract(shortcode_atts(array(
			'src' 			=> '',
			'img_size'		=> 'full',
			'link'			=> '',
			'link_target'	=> ''
	    ), $atts));

		$output = '';

		$img_size = strpos(strtolower(esc_attr($img_size)), "x") > -1 ? explode('x', esc_attr($img_size)) : $img_size;
		$thumb = wp_get_attachment_image_src($src, $img_size);

		if(isset($thumb[0])) {
			if(esc_attr($link)) $output = '<a href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'">';
			$output .= '<div class="item"><img class="lazyOwl" data-src="'. $thumb[0] .'" src="'. OZY_BASE_URL .'images/blank-large.gif" alt="'. esc_attr($img_size) .'"/></div>';
			if(esc_attr($link)) $output .= '</a>';
		}
		
		return $output;
	}
	
	add_shortcode('ozy_vc_owlcarousel', 'ozy_vc_owlcarousel');

	vc_map( array(
		"name" => __("Owl Carousel Item", "vp_textdomain"),
		"base" => "ozy_vc_owlcarousel",
		"content_element" => true,
		"as_child" => array('only' => 'ozy_vc_owlcarousel_wrapper'),
		"icon" => "icon-wpb-ozy-el",
		"params" => array(
			array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("Carousel Image", "vp_textdomain"),
				"param_name" => "src",
				"admin_label" => false,
				"value" => "",
				"description" => __("Select images for your slider.", "vp_textdomain")
			),array(
				"type" => "textfield",
				"heading" => __("Image size", "vp_textdomain"),
				"param_name" => "img_size",
				"value" => "full",
				"description" => __("Enter image size. Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "vp_textdomain")
		    ),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Link", "vp_textdomain"),
				"param_name" => "link",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "dropdown",
				"heading" => __("Link Target", "vp_textdomain"),
				"param_name" => "link_target",
				"value" => array("_self", "_blank", "_parent"),
				"admin_label" => false,
				"description" => __("Select link target window.", "vp_textdomain")
		  	),$add_css_animation
	   )
	) );
}

if (!function_exists('ozy_vc_owlcarousel2')) {
	function ozy_vc_owlcarousel2( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_owlcarousel2', $atts);
		extract(shortcode_atts(array(
			'src' 			=> '',
			'bg_color'		=> '',
			'icon' 			=> '',
			'icon_src'		=> '',
			'title' 		=> '',
			'excerpt' 		=> '',
			'link_caption' 	=> 'Find out more →',
			'link' 			=> '',
			'link_target'	=> '_self',
			'img_size'		=> 'full',
			'default_overlay' => 'off',
			'overlay_bg' 	=> '',
			'title_size'	=> 'h2'
	    ), $atts));

		$output = '';

		$img_size = strpos(strtolower(esc_attr($img_size)), "x") > -1 ? explode('x', esc_attr($img_size)) : $img_size;
		$thumb = wp_get_attachment_image_src($src, $img_size);

		$style = esc_attr($bg_color) ? ' style="background-color:'. esc_attr($bg_color) .';" ' : ''; //height:278px;
		$output = '<div class="item item-extended" '. $style .'>';
		if(isset($thumb[0])) {
			$output .= '<img src="'. $thumb[0] .'" alt=""/>';
		}else{
			$output .= '<img src="'. OZY_BASE_URL .'images/blank-large.gif" alt=""/>';
		}
		$output .= '<a'. ($link ? ' href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'"':'') .'>';
		$output .= '<div class="overlay-one '.(esc_attr($default_overlay) === 'on' ? 'overlay-one-bg' : '').'">';
		if(esc_attr($icon_src)) { // && isset($icon_thumb[0])
			$icon_thumb = wp_get_attachment_image_src($icon_src, 'full');
			$output .= '<span><img src="'. $icon_thumb[0] .'" alt="'. esc_attr($title) .'"/></span>';
		}else{
			if(esc_attr($icon)){
				$output .= '<span class="'. esc_attr($icon) .'"></span>';
			}else{
				$output .= '<'. $title_size .'>'. esc_attr($title) .'</'. $title_size .'>';
			}
		}
		$output .= '</div>';
		$output .= '<div class="overlay-two"'. ($overlay_bg ? ' style="background-color:'. esc_attr($overlay_bg) .'"':'') .'>';
		$output .= '<p>'. esc_attr($excerpt);
		if($link) {
			$output .= '<span>'. esc_attr($link_caption) .'</span>';
		}
		$output .= '</p>';
		$output .= '</div>';
		$output .= '</a>';
		$output .= '</div>';

		
		return $output;
	}
	
	add_shortcode('ozy_vc_owlcarousel2', 'ozy_vc_owlcarousel2');

	vc_map( array(
		"name" => __("Owl Carousel Extended Item", "vp_textdomain"),
		"base" => "ozy_vc_owlcarousel2",
		"content_element" => true,
		"as_child" => array('only' => 'ozy_vc_owlcarousel_wrapper'),
		"icon" => "icon-wpb-ozy-el",
		"params" => array(
			array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("Carousel Image", "vp_textdomain"),
				"param_name" => "src",
				"admin_label" => false,
				"value" => "",
				"description" => __("Select images for your slider.", "vp_textdomain")
			),array(
				"type" => "colorpicker",
				"heading" => __("Carousel Background", "vp_textdomain"),
				"param_name" => "bg_color",
				"admin_label" => false,
				"value" => "",
				"description" => __("Not requrired. Select a background color for your item.", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "title",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "select_an_icon",
				"heading" => __("or Icon", "vp_textdomain"),
				"param_name" => "icon",
				"value" => '',
				"admin_label" => false,
				"description" => __("Once you select an Icon, title will not be shown on overlay.", "vp_textdomain")
		  	),array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("or Image Icon", "vp_textdomain"),
				"param_name" => "icon_src",
				"admin_label" => false,
				"value" => "",
				"description" => __("Once you select an Image Icon, title or Icon will not be shown on overlay.", "vp_textdomain")
			),array(
				"type" => "textfield",
				"heading" => __("Image size", "vp_textdomain"),
				"param_name" => "img_size",
				"value" => "full",
				"description" => __("Enter image size. Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "vp_textdomain")
		    ),array(
				"type" => "dropdown",
				"heading" => __("Default Overlay?", "vp_textdomain"),
				"param_name" => "default_overlay",
				"value" => array("off", "on", "_parent"),
				"admin_label" => false,
				"description" => __("ON/OFF default overlay on your items.", "vp_textdomain")
		  	),array(
				"type" => "colorpicker",
				"heading" => __("Overlay Background Color", "vp_textdomain"),
				"param_name" => "overlay_bg",
				"value" => "",
				"admin_label" => false
		  	),array(
				"type" => "textarea",
				"class" => "",
				"heading" => __("Excerpt", "vp_textdomain"),
				"param_name" => "excerpt",
				"admin_label" => false,
				"value" => ""
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Link Caption", "vp_textdomain"),
				"param_name" => "link_caption",
				"admin_label" => true,
				"value" => __("Find out more →", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Link", "vp_textdomain"),
				"param_name" => "link",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "dropdown",
				"heading" => __("Link Target", "vp_textdomain"),
				"param_name" => "link_target",
				"value" => array("_self", "_blank", "_parent"),
				"admin_label" => false,
				"description" => __("Select link target window.", "vp_textdomain")
		  	)
	   )
	) );
}

class WPBakeryShortCode_Ozy_Vc_Owlcarousel_Wrapper extends WPBakeryShortCodesContainer{}
class WPBakeryShortCode_Ozy_Vc_Owlcarousel extends WPBakeryShortCode{}
class WPBakeryShortCode_Ozy_Vc_Owlcarousel2 extends WPBakeryShortCode{}

/**
* Counter
*/
if (!function_exists('ozy_vc_count_to')) {
	function ozy_vc_count_to( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_count_to', $atts);
		extract(shortcode_atts(array(
			'color' 		=> '#000000',
			'from'			=> 0,
			'to'			=> 100,
			'subtitle' 		=> '',
			'sign'			=> '',
			'signpos'		=> 'right',
			'css_animation' => ''
	    ), $atts));
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}		
		
		return '<div class="ozy-counter wpb_content_element_x '. $css_animation .'" style="color:'. esc_attr($color) .'"><div class="timer" data-sign="'. esc_attr($sign) .'" data-signpos="'. esc_attr($signpos) .'" data-from="'. esc_attr($from) .'" data-to="'. esc_attr($to) .'">'. esc_attr($from) .'</div><div class="hr" style="background-color:'. esc_attr($color) .'"></div>'. (esc_attr($subtitle) ? '<span>'. esc_attr($subtitle) .'</span>' : '') .'</div>';
	}
	
	add_shortcode('ozy_vc_count_to', 'ozy_vc_count_to');
	
	vc_map( array(
		"name" => __("Count To", "vp_textdomain"),
		"base" => "ozy_vc_count_to",
		"icon" => "",
		"class" => '',
		"controls" => "full",
		'category' => 'by OZY',
		"icon" => "icon-wpb-ozy-el",
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Sub Title", "vp_textdomain"),
				"param_name" => "subtitle",
				"admin_label" => true,
				"value" => "",
				"description" => __("Counter title.", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("From", "vp_textdomain"),
				"param_name" => "from",
				"admin_label" => true,
				"value" => "0",
				"description" => __("Counter start from", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("To", "vp_textdomain"),
				"param_name" => "to",
				"admin_label" => true,
				"value" => "100",
				"description" => __("Counter count to", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Sign", "vp_textdomain"),
				"param_name" => "sign",
				"admin_label" => true,
				"value" => "",
				"description" => __("Enter a sign like % or whatever you like", "vp_textdomain")
			),array(
				"type" => "dropdown",
				"heading" => __("Sign Position", "vp_textdomain"),
				"param_name" => "signpos",
				"value" => array('right', 'left'),
				"admin_label" => false,
				"description" => __("Select position of your sign.", "vp_textdomain")
		  	),array(
				"type" => "colorpicker",
				"heading" => __("Forecolor", "vp_textdomain"),
				"param_name" => "color",
				"value" => "#000000",
				"admin_label" => false
		  	),$add_css_animation
	   )
	) );	
}

/**
* Twitter Slider
*/
if (!function_exists('ozy_vc_twitter_ticker')) {
	function ozy_vc_twitter_ticker( $atts, $content = null ) {
	
		$essentials_options = get_option('ozy_enjooy_essentials');
		if( is_array($essentials_options) && 
			isset($essentials_options['twitter_consumer_key']) && 
			isset($essentials_options['twitter_secret_key']) &&
			isset($essentials_options['twitter_token_key']) &&
			isset($essentials_options['twitter_token_secret_key']) ) 
		{
			$atts = vc_map_get_attributes('ozy_vc_twitter_ticker', $atts);
			extract(shortcode_atts(array(
				'count' => '10',
				'screenname' => 'ozythemes',
				'forecolor' => ''
			), $atts));	
		
			wp_enqueue_script('royalslider');
			wp_enqueue_style('royalslider');			
			
			require_once("classes/twitteroauth.php"); //Path to twitteroauth library
			
			if(!function_exists('getConnectionWithAccessToken')) {
				function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
					$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
					return $connection;
				}
			}

			$connection = getConnectionWithAccessToken(
				$essentials_options['twitter_consumer_key'],
				$essentials_options['twitter_secret_key'],
				$essentials_options['twitter_token_key'],
				$essentials_options['twitter_token_secret_key']
			);
			 
			$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=". esc_attr($screenname) ."&count=". esc_attr($count));

			if(!function_exists('makeLinks')) {
				function makeLinks($str) {    
					return preg_replace('/(https?):\/\/([A-Za-z0-9\._\-\/\?=&;%,]+)/i', '<a href="$1://$2" target="_blank">$1://$2</a>', $str);
				}
			}

			$output = '';
			if(is_array($tweets)) {
				foreach($tweets as $tweet) {
					$h_time = sprintf( __('%s ago', 'vp_textdomain'), human_time_diff( date( 'U', strtotime( $tweet->created_at ) )));

					$output .= '<div>';
					$output .= '<div class="testimonial" style="color:'. esc_attr($forecolor) .'">'. makeLinks($tweet->text) .'<br>'. $h_time  .'</div>';
					$output .= '<div class="info">';
					$output .= '<span class="thumb"><span><img src="'. $tweet->user->profile_image_url .'" alt="'. $tweet->user->screen_name .'"/></span></span>';
					$output .= '<span class="username"><a href="http://twitter.com/'. $tweet->user->screen_name .'" style="color:'. esc_attr($forecolor) .'" target="_blank">'. $tweet->user->screen_name .'</a></span>';
					$output .= '</div>';
					$output .= '</div>';
				}
			
				return '<div class="royalSlider contentSlider ozy-testimonials">' . PHP_EOL . $output . PHP_EOL .'</div>';
			}else{
				return 'Possible Twitter data error.';
			}
		}
		
		return '<p>**Required Twitter parameters are not supplied. Please go to your admin panel, Settings > ozy Essentials.**</p>';
	}

	add_shortcode('ozy_vc_twitter_ticker', 'ozy_vc_twitter_ticker');
	
	vc_map( array(
		"name" => __("Twitter Slider", "vp_textdomain"),
		"base" => "ozy_vc_twitter_ticker",
		"content_element" => true,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "colorpicker",
				"heading" => __("ForeColor", "vp_textdomain"),
				"param_name" => "forecolor",
				"value" => "",
				"admin_label" => false,
				"description" => __("Font color for rest of the slider", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Count", "vp_textdomain"),
				"param_name" => "count",
				"admin_label" => true,
				"value" => "10"
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Screenname", "vp_textdomain"),
				"param_name" => "screenname",
				"admin_label" => true,
				"value" => "ozythemes"
			),array(
				"type" => "textfield",
				"heading" => __("Extra class name", "vp_textdomain"),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
			)
		)
	) );	
}

/**
* Testimonials
*/
if (!function_exists('ozy_vc_testimonials')) {
	function ozy_vc_testimonials( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_testimonials', $atts);
		extract(shortcode_atts(array(
			'forecolor' => ''
		), $atts));		
		
		wp_enqueue_script('royalslider');
		wp_enqueue_style('royalslider');
		
		$GLOBALS['OZY_TESTIMONIAL_SLIDER_FORECOLOR'] = esc_attr($forecolor);
		
		return '<div class="royalSlider contentSlider ozy-testimonials wpb_content_element_x">' . PHP_EOL . do_shortcode( $content ) . PHP_EOL .'</div>';
	}

	add_shortcode('ozy_vc_testimonials', 'ozy_vc_testimonials');

	vc_map( array(
		"name" => __("Testimonials Slider", "vp_textdomain"),
		"base" => "ozy_vc_testimonials",
		"as_parent" => array('only' => 'ozy_vc_testimonial'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		"content_element" => true,
		"show_settings_on_create" => false,
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "colorpicker",
				"heading" => __("ForeColor", "vp_textdomain"),
				"param_name" => "forecolor",
				"value" => "",
				"admin_label" => false,
				"description" => __("Font color for rest of the slider", "vp_textdomain")
			),array(
				"type" => "textfield",
				"heading" => __("Extra class name", "vp_textdomain"),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
			)
		),
		"js_view" => 'VcColumnView'
	) );
}

if (!function_exists('ozy_vc_testimonial')) {
	function ozy_vc_testimonial( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_testimonial', $atts);
		extract(shortcode_atts(array(
			'title' => '',
			'subtitle' => '',
			'testimonial_content' => '',
			'image' => ''
		), $atts));
		
		$output  = '<div style="'. ($GLOBALS['OZY_TESTIMONIAL_SLIDER_FORECOLOR'] ? 'color:' . $GLOBALS['OZY_TESTIMONIAL_SLIDER_FORECOLOR'] : '') .'">';
		$output .= '<div class="testimonial">'. do_shortcode( $testimonial_content ) .'</div>';
		$output .= '<div class="info">';		
		$member_image = wp_get_attachment_image_src($image, 'full');
		if(isset($member_image[0])) {
			$output .= '<div class="thumb"><span><img src="'. $member_image[0] .'" alt="' . esc_attr($title) . '"/></span></div>';
		}		
		if(!empty($title)) $output .= '<div class="itext">' . esc_attr($title) . '<br/>';
		if(!empty($subtitle)) $output .= esc_attr($subtitle) . '</div>';
		$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}

	add_shortcode( 'ozy_vc_testimonial', 'ozy_vc_testimonial' );
	
	vc_map( array(
		"name" => __("Testimonial", "vp_textdomain"),
		"base" => "ozy_vc_testimonial",
		"content_element" => true,
		"as_child" => array('only' => 'ozy_vc_testimonials'), // Use only|except attributes to limit parent (separate multiple values with comma)
		"icon" => "icon-wpb-ozy-el",
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "title",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Sub Title", "vp_textdomain"),
				"param_name" => "subtitle",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content", "vp_textdomain"),
				"param_name" => "testimonial_content",
				"description" => __("Testimonial content.", "vp_textdomain")
			),array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("Image", "vp_textdomain"),
				"param_name" => "image",
				"admin_label" => false,
				"value" => "",
				"description" => __("Select an image to show as testimonial visual.", "vp_textdomain")
			),array(
				"type" => "textfield",
				"heading" => __("Extra class name", "vp_textdomain"),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
			)
		)
	) );	
}

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
class WPBakeryShortCode_Ozy_Vc_Testimonials extends WPBakeryShortCodesContainer {
}
class WPBakeryShortCode_Ozy_Vc_Testimonial extends WPBakeryShortCode {
}

/**
* Icon Title with Content
*/
if(!function_exists('ozy_title_with_icon_func')) {
	function ozy_title_with_icon_func( $atts, $content=null ) {
		$atts = vc_map_get_attributes('title_with_icon', $atts);
		extract( shortcode_atts( array(
			  'icon' => '',
			  'icon_size' => 'medium',
			  'icon_position' => 'left',
			  'size' => 'h1',
			  'title' => '',
			  'icon_type' => '',
			  'icon_color' => '',
			  'text_color' => '',
			  'icon_bg_color' => 'transparent',
			  'icon_shadow_color' => '',
			  'go_link' => '',
			  'go_target' => '_self',
			  'connected' => 'no',
			  'dot_bg_color' => 'transparent'
			), $atts ) 
		);

		global $ozyHelper;
		$element_id = 'tile-with-icon_icon' . rand(100,10000);
		$a_begin = $a_end = $add_style = "";
		if(trim($go_link) !== '') {
			$a_begin = '<a href="' . esc_attr($go_link) . '" '. ($go_target=='fancybox' || $go_target=='fancybox-media' ? 'class':'target') .'="' . esc_attr($go_target) . '">';
			$a_end   = '</a>';
		}

		if($icon_type !== 'clear') {
			$ozyHelper->set_footer_style('#'. $element_id .':hover .title-with-icon span{box-shadow:'. $ozyHelper->hex2rgba(esc_attr($icon_bg_color),'.2') .' 0 0 0 10px;}');
		}

		if($icon_type === 'circle') {
			$icon_bg_color = 'transparent';
			$add_style = 'border-color:'. esc_attr($icon_color) .';';
		}
		
		$o_icon = ($icon ? $a_begin . '<span ' . ($icon_color ? ' style="'. $add_style .'color:'. $icon_color .' !important;background-color:'. $icon_bg_color .' !important;"' : '') . ' class="' . $icon . ' ' . esc_attr($icon_type) . ' ' . $icon_size . ' ' . '" '. (esc_attr($icon_shadow_color) ? 'data-color="'. esc_attr($icon_shadow_color) .'"':'') .'></span>' . $a_end : '');
		
		return '<div id="'. $element_id .'" class="title-with-icon-wrapper '. esc_attr($icon_size) .' '. (esc_attr($connected) === 'yes' ? 'connected' : '') .'" data-color="'. esc_attr($dot_bg_color) .'"><div class="wpb_content_element_x title-with-icon clearfix ' . (trim($content) !== '' ? 'margin-bottom-0 ' : '') . ($icon_position === 'top' ? 'top-style' : '') . '">' . $o_icon . '<' . $size . (!$icon ? ' class="no-icon"' : '') . ' style="'. (esc_attr($text_color) ? 'color:' . esc_attr($text_color) : '') .'">' . $title . '</' . $size . '></div>' . (trim($content) !== '' ? '<div class="wpb_content_element_x '. esc_attr($icon_position) .'-cs title-with-icon-content '. esc_attr($icon_size) .' clearfix" style="'. (esc_attr($text_color) ? 'color:' . esc_attr($text_color) : '') .'">' . wpb_js_remove_wpautop(do_shortcode($content)) . '</div>' : '') . '</div>';
	}
	
	add_shortcode( 'title_with_icon', 'ozy_title_with_icon_func' );
	
	vc_map( array(
		"name" => __("Title With Icon", "vp_textdomain"),
		"base" => "title_with_icon",
		"class" => "",
		"controls" => "full",
		'category' => 'by OZY',
		"icon" => "icon-wpb-ozy-el",
	   	"params" => array(
		  array(
			"type" => "select_an_icon",
			"heading" => __("Icon", "vp_textdomain"),
			"param_name" => "icon",
			"value" => '',
			"admin_label" => false,
			"description" => __("Title heading style.", "vp_textdomain")
		  ),array(
			"type" => "dropdown",
			"heading" => __("Icon Size", "vp_textdomain"),
			"param_name" => "icon_size",
			"value" => array(__("medium", "vp_textdomain") => "medium", __("large", "vp_textdomain") => "large", __("xlarge", "vp_textdomain") => "xlarge", __("xxlarge", "vp_textdomain") => "xxlarge", __("xxxlarge", "vp_textdomain") => "xxxlarge"),
			"admin_label" => false,
			"description" => __("Size of the Icon.", "vp_textdomain")
		  ),array(
			"type" => "dropdown",
			"heading" => __("Icon Position", "vp_textdomain"),
			"param_name" => "icon_position",
			"value" => array(__("left", "vp_textdomain") => "left", __("top", "vp_textdomain") => "top"),
			"admin_label" => false,
			"description" => __("Position of the Icon.", "vp_textdomain")
		  ),array(
			"type" => "colorpicker",
			"heading" => __("Icon Alternative Color", "vp_textdomain"),
			"param_name" => "icon_color",
			"value" => "",
			"admin_label" => false,
			"description" => __("This field is not required.", "vp_textdomain")
		  ),array(
			"type" => "dropdown",
			"heading" => __("Icon Background Type", "vp_textdomain"),
			"param_name" => "icon_type",
			"value" => array(__("rectangle", "vp_textdomain") => "rectangle", __("rounded", "vp_textdomain") => "rounded", __("circle", "vp_textdomain") => "circle", __("clear", "vp_textdomain") => "clear"),
			"admin_label" => false,
			"description" => __("Position of the Icon.", "vp_textdomain")
		  ),array(
			"type" => "colorpicker",
			"heading" => __("Icon Background Color", "vp_textdomain"),
			"param_name" => "icon_bg_color",
			"value" => "",
			"admin_label" => false,
			"description" => __("Background color of Icon.", "vp_textdomain")
		  ),array(
			"type" => "colorpicker",
			"heading" => __("Icon Shadow Color", "vp_textdomain"),
			"param_name" => "icon_shadow_color",
			"value" => "",
			"admin_label" => false,
			"description" => __("Shadow color of Icon.", "vp_textdomain")
		  ),array(
			"type" => "dropdown",
			"heading" => __("Heading Style", "vp_textdomain"),
			"param_name" => "size",
			"value" => array("h1", "h2", "h3", "h4", "h5", "h6"),
			"admin_label" => false,
			"description" => __("Title heading style.", "vp_textdomain")
		  ),array(
			 "type" => "textfield",
			 "class" => "",
			 "heading" => __("Link (on icon)", "vp_textdomain"),
			 "param_name" => "go_link",
			 "admin_label" => true,
			 "value" => "",
			 "description" => __("Enter full path.", "vp_textdomain")
		  ),array(
			"type" => "dropdown",
			"heading" => __("Link Target", "vp_textdomain"),
			"param_name" => "go_target",
			"value" => array("_self", "_blank", "_parent", "fancybox", "fancybox-media"),
			"admin_label" => false,
			"description" => __("Select link target window. fancybox will launch an lightbox window for images, and fancybox-media will launch a lightbox window for frames/video.", "vp_textdomain")
		  ),array(
			 "type" => "textfield",
			 "class" => "",
			 "heading" => __("Title", "vp_textdomain"),
			 "param_name" => "title",
			 "admin_label" => true,
			 "value" => __("Enter your title here", "vp_textdomain"),
			 "description" => __("Content of the title.", "vp_textdomain")
		  ),array(
			"type" => "colorpicker",
			"heading" => __("Font Color", "vp_textdomain"),
			"param_name" => "text_color",
			"value" => "",
			"admin_label" => false,
			"description" => __("This option will affect Title and Content color.", "vp_textdomain")
		  ),array(
			"type" => "dropdown",
			"heading" => __("Connected", "vp_textdomain"),
			"param_name" => "connected",
			"value" => array("no", "yes"),
			"admin_label" => false,
			"description" => __("Select yes to connect elements to next one with a dashed border.", "vp_textdomain")
		  ),array(
			"type" => "colorpicker",
			"heading" => __("Border Color", "vp_textdomain"),
			"param_name" => "dot_bg_color",
			"value" => "",
			"admin_label" => false,
			"dependency" => Array('element' => "connected", 'value' => 'yes')
		  ),array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", "vp_textdomain"),
			"param_name" => "content",
			"value" => "",
			"description" => __("Type your content here.", "vp_textdomain")
		  )
	   )
	) );
}
/**
* Before After Image Viewer
*/
if (!function_exists('ozy_vc_before_after')) {
	function ozy_vc_before_after( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_before_after', $atts);
	    extract(shortcode_atts(array(
			'before' => '',
			'after'	=> '',
			'css_animation' => ''
	    ), $atts));
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}
			
		wp_enqueue_style('twentytwenty', OZY_BASE_URL . 'scripts/twentytwenty/css/twentytwenty.css');
		wp_enqueue_script('jquery.event.move', OZY_BASE_URL . 'scripts/twentytwenty/js/jquery.event.move.js', array('jquery'), null, true );	
		wp_enqueue_script('jquery.twentytwenty', OZY_BASE_URL . 'scripts/twentytwenty/js/jquery.twentytwenty.js', array('jquery'), null, true );	

		$before_large_image = wp_get_attachment_image_src($before, 'full');
		$after_large_image = wp_get_attachment_image_src($after, 'full');

		$output  = '<div class="ozy-before_after wpb_content_element_x '. $css_animation .'">';
		if($before_large_image[0] && $after_large_image[0]) {
			$output .= '<img src="'. esc_attr($before_large_image[0]) .'"/>';
			$output .= '<img src="'. esc_attr($after_large_image[0]) .'"/>';
		}else{
			$output .= __('No proper images supplied', 'vp_textdomain');
		}
		$output .= '</div>';
	
		return $output;
	}
	
	add_shortcode('ozy_vc_before_after', 'ozy_vc_before_after');

	vc_map( array(
	   "name" => __("Before / After Viewer", "vp_textdomain"),
	   "base" => "ozy_vc_before_after",
		"icon" => "icon-wpb-ozy-el",
		'category' => 'by OZY',
	   "params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "title",
				"admin_label" => true,
				"value" => "",
				"description" => __("Only place holder.", "vp_textdomain")
			),array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("Before Image", "vp_textdomain"),
				"param_name" => "before",
				"admin_label" => false,
				"value" => "",
				"description" => __("Before image. Please select your images in same dimension for fine results.", "vp_textdomain")
			),array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("After Image", "vp_textdomain"),
				"param_name" => "after",
				"admin_label" => false,
				"value" => "",
				"description" => __("After image. Please select your images in same dimension for fine results.", "vp_textdomain")
			),$add_css_animation
	   )
	) );	
}

/**
* Icon
*/
if (!function_exists('ozy_vc_icon')) {
	function ozy_vc_icon( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_icon', $atts);
	    extract(shortcode_atts(array(
			'icon' => '',
			'size' => 'regular',
			'style' => '',
			'link' => '',
			'target' => '',
			'color' => '',
			'icon_shadow_color' => '',
			'textcolor' => '',
			'align' => 'left',
			'css_animation' => '',
			'el_class' => ''
	    ), $atts));
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}
		
		$element_id = 'ozy_icon_'. rand(100,10000);
				
		$inline_style = 'style="';
		if(esc_attr($color)) {
			global $ozyHelper;
			switch(esc_attr($style)) {
				case 'square':
					$inline_style .= 'background-color:'. esc_attr($color).'!important';
					break;
				case 'circle':
					$inline_style .= 'background-color:'. esc_attr($color);
					break;
				case 'circle2':
					$inline_style .= 'border-color:'. esc_attr($color) .';color:'. esc_attr($color);
					break;
			}
			$ozyHelper->set_footer_style('#'. $element_id .':hover{box-shadow:'. $ozyHelper->hex2rgba(esc_attr($color),'.2') .' 0 0 0 10px;}');				
		}
		
		if(esc_attr($textcolor)) {
			$inline_style .= ';color:'. esc_attr($textcolor);
		}
		
		if(esc_attr($align) === 'left' || esc_attr($align) === 'right') {
			$inline_style .= ';float:'. esc_attr($align);
		}
		
		$inline_style .= '"';
		
		$output = '';		
		if(esc_attr($link)) $output .= '<a href="'. esc_attr($link) .'" target="'. esc_attr($target) .'" class="'. esc_attr($el_class) .' ozy-icon-a">';
		$output .= '<span id="'. $element_id .'" class="ozy-icon '. (!esc_attr($link)? esc_attr($el_class) : '') .' wpb_content_element_x align-'. esc_attr($align) .' ' . esc_attr($size) .' ' . esc_attr($style) . ' icon '. esc_attr($icon) .' '. $css_animation .'" '. $inline_style .' '. (esc_attr($icon_shadow_color) ? 'data-color="'. esc_attr($icon_shadow_color) .'"':'') .'></span>';
		if(esc_attr($link)) $output .= '</a>';
		
		return $output;
	}

	add_shortcode('ozy_vc_icon', 'ozy_vc_icon');
	
	vc_map( array(
	   "name" => __("Icon", "vp_textdomain"),
	   "base" => "ozy_vc_icon",
	   "icon" => "icon-wpb-ozy-el",
	   'category' => 'by OZY',
	   "params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "title",
				"admin_label" => true,
				"value" => "",
				"description" => __("Only place holder.", "vp_textdomain")
			),array(
				"type" => "select_an_icon",
				"class" => "",
				"heading" => __("Icon", "vp_textdomain"),
				"param_name" => "icon",
				"admin_label" => true,
				"value" => "",
				"description" => __("Select a type icon from the opened window.", "vp_textdomain")
			),array(
				"type" => "dropdown",
				"heading" => __("Size", "vp_textdomain"),
				"param_name" => "size",
				"value" => array("regular", "large", "xlarge", "xxlarge", "xxxlarge"),
				"admin_label" => false
			),array(
				"type" => "dropdown",
				"heading" => __("Style", "vp_textdomain"),
				"param_name" => "style",
				"value" => array("clean", "square", "circle", "circle2"),
				"admin_label" => false
			),array(
				"type" => "dropdown",
				"heading" => __("Align", "vp_textdomain"),
				"param_name" => "align",
				"value" => array("left", "center", "right"),
				"admin_label" => false
			),array(
				"type" => "textfield",
				"heading" => __("Link", "vp_textdomain"),
				"param_name" => "link",
				"admin_label" => false
			),array(
				"type" => "dropdown",
				"heading" => __("Target Window", "vp_textdomain"),
				"param_name" => "target",
				"value" => array("_self", "_blank"),
				"admin_label" => false
			),array(
				"type" => "colorpicker",
				"heading" => __("Background Color", "vp_textdomain"),
				"param_name" => "color",
				"admin_label" => false
			),array(
				"type" => "colorpicker",
				"heading" => __("Foreground Color", "vp_textdomain"),
				"param_name" => "textcolor",
				"admin_label" => false
			),array(
				"type" => "colorpicker",
				"heading" => __("Icon Shadow Color", "vp_textdomain"),
				"param_name" => "icon_shadow_color",
				"value" => "",
				"admin_label" => false,
				"description" => __("Shadow color of Icon.", "vp_textdomain")
		  	),$add_css_animation,
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", "vp_textdomain"),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
			)			
	   )
	) );
}

/**
* Custom List
*/
if (!function_exists('ozy_vc_ul')) {
	function ozy_vc_ul( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_ul', $atts);
	    extract(shortcode_atts(array(
			'icon' => '',
			'icon_color' => '',
			'ul_content' => '',
			'css_animation' => ''
	    ), $atts));

		$content = wpb_js_remove_wpautop($ul_content);
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}
		
		$tag = $style = '';		
		if(strtolower(strpos($content, '<ul'))) {
			$tag = 'ul';
		}else if(strtolower(strpos($content, '<ol'))) {
			$tag = 'ol';
		}
		if($icon_color) {
			$style = ' style="color:'. esc_attr($icon_color) .'"';
		}
		$content = ozy_strip_single($tag, $content);
		$content = str_replace('<li>' , '<li><span class="oic '. esc_attr($icon) .'"'. $style .'></span><span>', $content);
		$content = str_replace('</li>' , '</span></li>', $content);
		$content = ozy_strip_single('p', $content);
		if(!$tag) { 
			$tag = 'ul';
		}
		return '<'. $tag .' class="ozy-custom-list wpb_content_element_x '. $css_animation .'">'. $content . '</'. $tag .'>';
	}

	add_shortcode('ozy_vc_ul', 'ozy_vc_ul');
	
	vc_map( array(
		"name" => __("Custom List", "vp_textdomain"),
		"base" => "ozy_vc_ul",
		"icon" => "icon-wpb-ozy-el",
		"class" => '',
		"controls" => "full",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "title",
				"admin_label" => true,
				"value" => "",
				"description" => __("Only place holder.", "vp_textdomain")
			),array(
				"type" => "select_an_icon",
				"class" => "",
				"heading" => __("Icon", "vp_textdomain"),
				"param_name" => "icon",
				"admin_label" => true,
				"value" => "",
				"description" => __("Select a type icon from the opened window.", "vp_textdomain")
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Icon Color", "vp_textdomain"),
				"param_name" => "icon_color"
			),array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content", "vp_textdomain"),
				"param_name" => "ul_content"
			),$add_css_animation
	   )
	) );	
}

function ozy_strip_single($tag,$string){
	$string=preg_replace('/<'.$tag.'[^>]*>/i', '', $string);
	$string=preg_replace('/<\/'.$tag.'>/i', '', $string);
	return $string;
}

/**
* Visible Nearby Slider / Gallery Slider
*/
if (!function_exists('ozy_vc_gallery_slider')) {
	function ozy_vc_gallery_slider( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_gallery_slider', $atts);
		extract(shortcode_atts(array(
			'width' => '100%',
			'height' => '',
			'color' => '',
			'src' => '',
			'caption' => '',
			'css_animation' => ''
	    ), $atts));
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}
		
		$style = $output = '';
		if($width) {
			$style .= 'width:' . esc_attr($width) . ';';
		}
		if($height) {
			$style .= 'height:' . esc_attr($height);
		}
		
		$src_arr = explode(',', $src);
		if(is_array($src_arr)) {
			foreach($src_arr as $s) {
				$attachment = get_post($s);
				if($attachment->guid) {
					$output .= '<a class="rsImg" href="'. $attachment->guid .'">';
					if(esc_attr($caption)) {
						if($attachment->post_excerpt) {
							$output .= '<span>'. $attachment->post_excerpt .'</span>';
						}
						if($attachment->post_title) {
							$output .= '<p'. (esc_attr($color) ? ' style="color:'. esc_attr($color) .';"' : '') .'>'. $attachment->post_title . '</p>';
						}
					}
					$output .= '</a>';
				}
			}
		}
		return '<div class="royalSlider visibleNearby rsMinW '. $css_animation .'" style="'. $style .'">' . $output .'</div>';
	}
	
	add_shortcode('ozy_vc_gallery_slider', 'ozy_vc_gallery_slider');
	
	vc_map( array(
		"name" => __("Visible Nearby Slider", "vp_textdomain"),
		"base" => "ozy_vc_gallery_slider",
		"icon" => "icon-wpb-ozy-el",
		"class" => '',
		"controls" => "full",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "title",
				"admin_label" => true,
				"value" => "",
				"description" => __("Only place holder.", "vp_textdomain")
			),array(
				"type" => "attach_images",
				"class" => "",
				"heading" => __("Slider Images", "vp_textdomain"),
				"param_name" => "src",
				"admin_label" => false,
				"value" => "",
				"description" => __("Select images for your slider.", "vp_textdomain")
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Caption Color", "vp_textdomain"),
				"param_name" => "color"
			),array(
				"type" => "dropdown",
				"heading" => __("Caption", "vp_textdomain"),
				"param_name" => "caption",
				"value" => array("off", "on"),
				"description" => __("Once this option selected, caption will be printed bottom of the images from Image's attributes", "vp_textdomain"),
				"admin_label" => true
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Width", "vp_textdomain"),
				"param_name" => "width",
				"admin_label" => true,
				"value" => "100%",
				"description" => __("Width of your slider", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Height", "vp_textdomain"),
				"param_name" => "height",
				"admin_label" => true,
				"value" => "",
				"description" => __("Height of your slider", "vp_textdomain")
			),$add_css_animation
	   )
	) );	
}

/**
* Post Accordion Slider
*/
if (!function_exists('ozy_vc_post_accordion_slider')) {
	function ozy_vc_post_accordion_slider( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_post_accordion_slider', $atts);
		extract(shortcode_atts(array(
			'data_source'	=> 'blog',
			'width' 	=> '100%',
			'height' 	=> '100%',
			'bgcolor'	=> '#000000',
			'color' 	=> '#ffffff',
			'shadow' 	=> 'off',
			'autoplay' 	=> 'off',
			'css_animation' => ''
	    ), $atts));
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}		
		
		wp_enqueue_style('accordion-slider');
		wp_enqueue_script('accordion-slider');
		
		$params = array(
			'shadow' 	=> (esc_attr($shadow) === 'on' ? '1' : '0'),
			'autoplay' 	=> (esc_attr($autoplay) === 'on' ? '1' : '0'),
			'width' 	=> esc_attr($width),
			'height'	=> esc_attr($height)
		);
		wp_localize_script( 'enjooy', 'accordionSliderOptions', $params );
		
		$output = '';
				
		$args = array(
			'post_type' 			=> (esc_attr($data_source) == 'portfolio' ? 'ozy_portfolio' : 'post'),
			'posts_per_page'		=> '10',
			'orderby' 				=> 'date',
			'order' 				=> 'DESC',
			'ignore_sticky_posts' 	=> 1,							
			'meta_key' 				=> '_thumbnail_id'
		);

		//print_r($args);

		$the_query = new WP_Query( $args );
		$element_count = 0;
		while ( $the_query->have_posts() ) {
			$the_query->the_post();

			$accordion_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
			
			if(isset($accordion_image[0])) {
				$output.= '
				<div class="as-panel">';		
			    $output.= '<a href="'. get_permalink() .'">';
				$output.= '<img class="as-background" data-src="'. $accordion_image[0] .'"/>';
				$output.= '</a>';
				$output.= '
					<div class="as-layer" data-position="bottomLeft" data-horizontal="5%" data-vertical="80" data-width="70%" data-height="28%">						
						<h3 class="as-layer as-opened as-black as-padding" 
							data-show-transition="down" data-hide-transition="up" style="background-color:'. esc_attr($bgcolor) .';color:'. esc_attr($color) .'">
							'. get_the_title() .'
						</h3>						
						'. (get_the_excerpt() ?  '<p class="as-layer as-opened as-white as-padding hide-small-screen" 
							data-vertical="60"
							data-show-transition="up" data-hide-transition="down" style="background-color:'. esc_attr($bgcolor) .';color:'. esc_attr($color) .'">
							<span class="hide-medium-screen">'. get_the_excerpt() .'</span>
						</p>' : '') . '
					</div>
				</div>';
				
				$element_count++;		
			}
		}		
		
		return '
		<div id="accordion-carousel" class="accordion-slider as-horizontal overlap as-opened '. $css_animation .'" data-count="'. $element_count .'">
			<div class="as-panels as-grab">
			'. $output .'
			</div>
		</div>';		
	}
	
	add_shortcode('ozy_vc_post_accordion_slider', 'ozy_vc_post_accordion_slider');
	
	vc_map( array(
		"name" => __("Post Accordion Slider", "vp_textdomain"),
		"base" => "ozy_vc_post_accordion_slider",
		"icon" => "icon-wpb-ozy-el",
		"class" => '',
		"controls" => "full",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "dropdown",
				"heading" => __("Data Source", "vp_textdomain"),
				"param_name" => "data_source",
				"value" => array("blog", "portfolio"),
				"admin_label" => true,
				"description" => __("Choose source of your feed.", "vp_textdomain")
		  	),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Caption Background Color", "vp_textdomain"),
				"param_name" => "bgcolor"
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Caption Foreground Color", "vp_textdomain"),
				"param_name" => "color"
			),array(
				"type" => "dropdown",
				"heading" => __("Shadow", "vp_textdomain"),
				"param_name" => "shadow",
				"value" => array("off", "on"),
				"description" => __("Eanble / Disable vertical shadow for your slides", "vp_textdomain"),
				"admin_label" => true
			),array(
				"type" => "dropdown",
				"heading" => __("Autoplay", "vp_textdomain"),
				"param_name" => "autoplay",
				"value" => array("off", "on"),
				"description" => __("Enable / Disable autoplay option for your slider", "vp_textdomain"),
				"admin_label" => true
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Width", "vp_textdomain"),
				"param_name" => "width",
				"admin_label" => true,
				"value" => "100%",
				"description" => __("Width of your slider", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Height", "vp_textdomain"),
				"param_name" => "height",
				"admin_label" => true,
				"value" => "600px",
				"description" => __("Height of your slider", "vp_textdomain")
			),$add_css_animation
	   )
	) );	
}

/**
* Accordion Slider
*/
if (!function_exists('ozy_vc_accordion_slider')) {
	function ozy_vc_accordion_slider( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_accordion_slider', $atts);
		extract(shortcode_atts(array(
			'width' 	=> '100%',
			'height' 	=> '100%',
			'bgcolor'	=> '#000000',
			'color' 	=> '#ffffff',
			'shadow' 	=> 'off',
			'autoplay' 	=> 'off',
			'src' 		=> '',
			'css_animation' => ''
	    ), $atts));
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}		
		
		wp_enqueue_style('accordion-slider');
		wp_enqueue_script('accordion-slider');
		
		$params = array(
			'shadow' 	=> (esc_attr($shadow) === 'on' ? '1' : '0'),
			'autoplay' 	=> (esc_attr($autoplay) === 'on' ? '1' : '0'),
			'width' 	=> esc_attr($width),
			'height'	=> esc_attr($height)
		);
		wp_localize_script( 'enjooy', 'accordionSliderOptions', $params );
		
		$output = '';
		$src_arr = explode(',', $src);
		if(is_array($src_arr)) {
			foreach($src_arr as $s) {
				$attachment = get_post($s);
				if($attachment->guid) {
					$output.= '
					<div class="as-panel">';		
					$output.= '<a href="'. esc_attr($attachment->guid) .'" rel="gallery" class="fancybox">';
					$output.= '<img class="as-background" data-src="'. esc_attr($attachment->guid) .'"/>';
					$output.= '</a>';					
					$output.= '
						<div class="as-layer" data-position="bottomLeft" data-horizontal="5%" data-vertical="80" data-width="80%" data-height="28%">						
							<h3 class="as-layer as-opened as-black as-padding" 
								data-show-transition="down" data-hide-transition="up" style="background-color:'. esc_attr($bgcolor) .';color:'. esc_attr($color) .'">
								'. $attachment->post_title .'
							</h3>						
							<p class="as-layer as-opened as-white as-padding hide-small-screen" 
								data-vertical="60"
								data-show-transition="up" data-hide-transition="down" style="background-color:'. esc_attr($bgcolor) .';color:'. esc_attr($color) .'">
								<span class="hide-medium-screen">'. $attachment->post_excerpt .'</span>
							</p>
						</div>
					</div>';					
				}
			}
		}
		
		return '
		<div id="accordion-carousel" class="accordion-slider as-horizontal overlap as-opened '. $css_animation .'" data-count="'. count($src_arr) .'">
			<div class="as-panels as-grab">
			'. $output .'
			</div>
		</div>';		
	}
	
	add_shortcode('ozy_vc_accordion_slider', 'ozy_vc_accordion_slider');
	
	vc_map( array(
		"name" => __("Accordion Slider", "vp_textdomain"),
		"base" => "ozy_vc_accordion_slider",
		"icon" => "icon-wpb-ozy-el",
		"class" => '',
		"controls" => "full",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "title",
				"admin_label" => true,
				"value" => "",
				"description" => __("Only place holder.", "vp_textdomain")
			),array(
				"type" => "attach_images",
				"class" => "",
				"heading" => __("Slider Images", "vp_textdomain"),
				"param_name" => "src",
				"admin_label" => false,
				"value" => "",
				"description" => __("Select images for your slider.", "vp_textdomain")
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Caption Background Color", "vp_textdomain"),
				"param_name" => "bgcolor"
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Caption Foreground Color", "vp_textdomain"),
				"param_name" => "color"
			),array(
				"type" => "dropdown",
				"heading" => __("Shadow", "vp_textdomain"),
				"param_name" => "shadow",
				"value" => array("off", "on"),
				"description" => __("Eanble / Disable vertical shadow for your slides", "vp_textdomain"),
				"admin_label" => true
			),array(
				"type" => "dropdown",
				"heading" => __("Autoplay", "vp_textdomain"),
				"param_name" => "autoplay",
				"value" => array("off", "on"),
				"description" => __("Enable / Disable autoplay option for your slider", "vp_textdomain"),
				"admin_label" => true
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Width", "vp_textdomain"),
				"param_name" => "width",
				"admin_label" => true,
				"value" => "100%",
				"description" => __("Width of your slider", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Height", "vp_textdomain"),
				"param_name" => "height",
				"admin_label" => true,
				"value" => "600px",
				"description" => __("Height of your slider", "vp_textdomain")
			),$add_css_animation
	   )
	) );	
}

/**
* Team Member
*/
if (!function_exists('ozy_vc_team_member')) {
	function ozy_vc_team_member( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_team_member', $atts);
		extract(shortcode_atts(array(
			'image' => '',
			'title' => '',
			'sub_title' => '',
			'excerpt' => '',			
			'twitter' => '',
			'facebook' => '',
			'linkedin' => '',
			'pinterest' => '',
			'link' => '#',
			'css_animation' => ''
	    ), $atts));
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}	
		
		$output = PHP_EOL . '<div class="ozy-team_member '. $css_animation .'">' . PHP_EOL;
		$output.= '<figure>';
		$member_image = wp_get_attachment_image_src($image, 'full');
		if(isset($member_image[0])) {
			$output.= 		'<img src="'. $member_image[0] .'" alt="'. esc_attr($title) .'">';
		}
		$output.= '<figcaption>';
		$output.= esc_attr($title) ? '<h3>'. esc_attr($title) .'</h3>' : '';
		$output.= esc_attr($sub_title) ? '<h5 class="content-color-alternate">'. esc_attr($sub_title) .'</h5>' : '';
		$output.= '<p>'. esc_attr($excerpt) .'</p>';

		$output.= '<div>';
		$output.= esc_attr($twitter) ? '<a href="http://www.twitter.com/'. esc_attr($twitter) .'" target="_blank" class="symbol-twitter tooltip" title="twitter"><span class="symbol">twitter'.'</span></a>' : '';
		$output.= esc_attr($facebook) ? '<a href="http://www.facebook.com/'. esc_attr($facebook) .'" target="_blank" class="symbol-facebook tooltip" title="facebook"><span class="symbol">facebook'.'</span></a>' : '';
		$output.= esc_attr($linkedin) ? '<a href="http://www.linkedin.com/'. esc_attr($linkedin) .'" target="_blank" class="symbol-linkedin tooltip" title="linkedin"><span class="symbol">linkedin'.'</span></a>' : '';
		$output.= esc_attr($pinterest) ? '<a href="http://pinterest.com/'. esc_attr($pinterest) .'" target="_blank" class="symbol-pinterest tooltip" title="pinterest"><span class="symbol">pinterest'.'</span></a>' : '';
		$output.= '</div>';
		
		$output.= '</figcaption>';
		$output.= '</figure>';
		$output.= PHP_EOL . '</div>' . PHP_EOL;		
		
		return $output;
	}

	add_shortcode( 'ozy_vc_team_member', 'ozy_vc_team_member' );
	
	vc_map( array(
		"name" => __("Team Member", "vp_textdomain"),
		"base" => "ozy_vc_team_member",
		"icon" => "icon-wpb-ozy-el",
		"class" => '',
		"controls" => "full",
		'category' => 'by OZY',
		"params" => array(
			array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("Member Image", "vp_textdomain"),
				"param_name" => "image",
				"admin_label" => false,
				"value" => "",
				"description" => __("Select image for your team member.", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "vp_textdomain"),
				"param_name" => "title",
				"admin_label" => true,
				"value" => "",
				"description" => __("Title for your Team Member, like a name.", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Sub Title", "vp_textdomain"),
				"param_name" => "sub_title",
				"admin_label" => true,
				"value" => "",
				"description" => __("Sub Title for your Team Member, like work title.", "vp_textdomain")
			),array(
				"type" => "textarea",
				"class" => "",
				"heading" => __("Excerpt", "vp_textdomain"),
				"param_name" => "excerpt",
				"admin_label" => true,
				"value" => ""
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Twitter", "vp_textdomain"),
				"param_name" => "twitter",
				"admin_label" => true,
				"value" => "",
				"description" => __("Enter your Twitter account name", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Facebook", "vp_textdomain"),
				"param_name" => "facebook",
				"admin_label" => true,
				"value" => "",
				"description" => __("Enter your Facebook account name", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("LinkedIn", "vp_textdomain"),
				"param_name" => "linkedin",
				"admin_label" => true,
				"value" => "",
				"description" => __("Enter your LinkedIn account name", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Pinterest", "vp_textdomain"),
				"param_name" => "pinterest",
				"admin_label" => true,
				"value" => "",
				"description" => __("Enter your Pinterest account name", "vp_textdomain")
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Link", "vp_textdomain"),
				"param_name" => "link",
				"admin_label" => false,
				"value" => "",
				"description" => __("Define a path to details page", "vp_textdomain")
			),$add_css_animation
	   )
	) );	
}

/**
* Divider
*/
if (!function_exists('ozy_vc_divider')) {
	function ozy_vc_divider( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_divider', $atts);
	    extract(shortcode_atts(array(
			'caption' 		=> '',
			'caption_align'	=> 'center',
			'caption_position' => '',
			'border_style'	=> 'solid',
			'border_size' => '1',
			'border_color' => '',
			'css_animation' => '',
			'more_custom' => 'off',
			'width' => '',
			'align' => 'center'
			), $atts ) 
		);
		
		if($css_animation) {
			wp_enqueue_script('waypoints');
			$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
		}
		
		$output = $more_custom_html = '';
		if(esc_attr($more_custom) == 'on' && esc_attr($width) && esc_attr($align)) {
			$more_custom_html = ';max-width:'. esc_attr($width) .';';
			switch(esc_attr($align)) {
				case 'center':
					$more_custom_html .= 'margin:0 auto;';
					break;
				case 'left':
					$more_custom_html .= 'float:left;';
					break;
				case 'right':
					$more_custom_html .= 'float:right;';
					break;						
				default:
					$more_custom_html .= 'margin:0 auto;';
			}
		}
		if('top' === esc_attr($caption_position)){
			$output = ( trim( esc_attr( $caption ) ) ? '<h3 class="ozy-divider-cap-' . esc_attr($caption_align) . ' wpb_content_element_x">' . esc_attr( $caption ) . '</h3>' : '' );
			$output.= '<div class="ozy-content-divider '. $css_animation .'" style="border-top-style:'. esc_attr($border_style) . ';border-top-width:' . ('double' == esc_attr($border_style)?'3':esc_attr($border_size)) .'px' . ('' != esc_attr($border_color)?';border-top-color:'. esc_attr($border_color) .'':'') . $more_custom_html .'"></div>';
		}else{
			$output = '<fieldset class="ozy-content-divider '. $css_animation .' wpb_content_element_x" style="border-top-style:'. esc_attr($border_style) . ';border-top-width:' . ('double' == esc_attr($border_style)?'3':esc_attr($border_size)) .'px' . ('' != esc_attr($border_color)?';border-top-color:'. esc_attr($border_color) .'':'') . $more_custom_html .'">' . ( trim( esc_attr( $caption ) ) ? '<legend class="d' . esc_attr($caption_align) . '" align="' . esc_attr($caption_align) . '">' . esc_attr( $caption ) . '</legend>' : '' ) . '</fieldset>';
		}
		return $output;
	}

	add_shortcode('ozy_vc_divider', 'ozy_vc_divider');

	vc_map( array(
	   "name" => __("Separator (Divider) With Caption", "vp_textdomain"),
	   "base" => "ozy_vc_divider",
	   "class" => "",
	   "controls" => "full",
	   'category' => 'by OZY',
	   "icon" => "icon-wpb-ozy-el",
	   "params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Caption", "vp_textdomain"),
				"param_name" => "caption",
				"admin_label" => true,
				"value" => __("Enter your caption here", "vp_textdomain"),
				"description" => __("Caption of the divider.", "vp_textdomain")
			),array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Border Style", "vp_textdomain"),
				"param_name" => "border_style",
				"admin_label" => true,
				"value" => array("solid","dotted","dashed","double")
			),array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Border Size", "vp_textdomain"),
				"param_name" => "border_size",
				"admin_label" => true,
				"value" => array("1","2","3","4","5","6","7","8","9","10")
			),array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Border Color", "vp_textdomain"),
				"param_name" => "border_color",
				"admin_label" => false,
				"value" => ""
			),array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Caption Align", "vp_textdomain"),
				"param_name" => "caption_align",
				"admin_label" => true,
				"value" => array("center", "left", "right"),
				"description" => __("Caption align.", "vp_textdomain")
			),array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Caption Position", "vp_textdomain"),
				"param_name" => "caption_position",
				"admin_label" => true,
				"value" => array("overlay", "top"),
				"description" => __("Caption position.", "vp_textdomain")
			),array(
				"type" => 'dropdown',
				"heading" => __("More Customization", "vp_textdomain"),
				"param_name" => "more_custom",
				"value" => array("off", "on"),
			),array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Width", "vp_textdomain"),
				"param_name" => "width",
				"admin_label" => true,
				"value" => "400px",
				"dependency" => Array('element' => "more_custom", 'value' => 'on')
			),array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Align", "vp_textdomain"),
				"param_name" => "align",
				"admin_label" => true,
				"value" => array("center", "left", "right"),
				"dependency" => Array('element' => "more_custom", 'value' => 'on')
			),$add_css_animation	
		)
	) );
}

/**
* Price Table
*/
if(is_plugin_active("pricetable/pricetable.php")):

	function ozy_price_table_func( $atts ) {
		$atts = vc_map_get_attributes('ozy_price_table', $atts);
		extract( shortcode_atts( array(
			  'price_table_id' => '',
			  'css_animation' => ''
			), $atts ) 
		);
		return '<div class="wpb_content_element_x clearfix ' . $css_animation . '">' . do_shortcode("[price_table id='" . $price_table_id . "']") . '</div>';
	}

	add_shortcode( 'ozy_price_table', 'ozy_price_table_func' );
	
	global $wpdb;
	
	$pricetbl = $wpdb->get_results( "SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'pricetable'");
	$pricetbl_ids = array();
	if ($pricetbl) {
		foreach ( $pricetbl as $pricetbl_table ) {
		  $pricetbl_ids[$pricetbl_table->post_title] = $pricetbl_table->ID;
		}
	}

	vc_map( array(
	   "name" => __("Pricing Table", "vp_textdomain"),
	   "base" => "ozy_price_table",
	   "class" => "",
	   "controls" => "full",
	   'category' => 'by OZY',
	   "icon" => "icon-wpb-ozy-el",
	   "params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Caption", "vp_textdomain"),
				"param_name" => "caption",
				"admin_label" => true,
				"value" => __("Enter your caption here", "vp_textdomain"),
				"description" => __("Not usable at frontend.", "vp_textdomain")
			),array(
				"type" => "dropdown",
				"heading" => __("Select Price Table", "vp_textdomain"),
				"param_name" => "price_table_id",
				"value" => $pricetbl_ids,
				"admin_label" => false,
				"description" => __("Choose previously created Price Table form from the drop down list. To Create/Edit one please <a href='admin.php?page=pricetable' target='_parent'>click here</a>", "vp_textdomain")
			),$add_css_animation
		)
	) );

endif;

/**
* ShowBiz Slider
*/
if(is_plugin_active("showbiz/showbiz.php")):
	function ozy_showbizslider( $atts ) {
		$atts = vc_map_get_attributes('ozy_showbizslider', $atts);
		extract( shortcode_atts( array(
			  'alias_name' => ''
			), $atts ) 
		);
		
		if(function_exists("putShowBiz")) :
			if(trim($alias_name) !== "") :
				return do_shortcode("<div>[showbiz " . $alias_name . "]</div>");
			endif;
		endif;
				
	}
	
	add_shortcode( 'ozy_showbizslider', 'ozy_showbizslider' );

	global $wpdb;
	
	global $table_prefix;
		
	$showbizsldr = $wpdb->get_results( "SELECT ID, title, alias FROM " . $table_prefix . "showbiz_sliders ");
	$showbizsldr_alias = array();
	if ($showbizsldr) {
		foreach ( $showbizsldr as $showbizsldr_slide ) {
		  $showbizsldr_alias[$showbizsldr_slide->title] = $showbizsldr_slide->alias;
		}
	}
	
	vc_map( array(
	   "name" => __("ShowBiz Slider", "vp_textdomain"),
	   "base" => "ozy_showbizslider",
	   "class" => "",
	   "controls" => "full",
	   'category' => 'by OZY',
	   "icon" => "icon-wpb-ozy-el",
	   "params" => array(
			array(
				"type" => "dropdown",
				"heading" => __("Select Slider", "vp_textdomain"),
				"param_name" => "alias_name",
				"value" => $showbizsldr_alias,
				"admin_label" => true,
				"description" => __("Choose previously created ShowBiz Slider form from the drop down list. To Create/Edit one please <a href='admin.php?page=showbiz' target='_parent'>click here</a>", "vp_textdomain")
			)
	   )
	) );
	
endif;

/**
* Horizontal Grid Gallery
*/
if (!function_exists('ozy_vc_hg_gallery')) {
	function ozy_vc_hg_gallery( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_hg_gallery', $atts);
	    extract(shortcode_atts(array(
			'images'	=> array(),
			'thumb_size' => 'random',
			'thumb_number'	=> '32',
			'thumb_space' => '1',
			'scrollbar_type' => 'drag'
			), $atts ) 
		);
		
		$element_id = 'horizontalGridFolioContainer' . rand(0,1000);

		wp_enqueue_script('horizontal-gridfolio');
		wp_enqueue_style('horizontal-gridfolio');
		
		$params = array(
			'nrOfThumbsToShowOnSet'		=> ((int)esc_attr($thumb_number) > 0 ? esc_attr($thumb_number) : 32),
			'scrollBarType' 			=> esc_attr($scrollbar_type),
			'SpaceBetweenThumbnails'	=> ((int)esc_attr($thumb_space) > 0 ? esc_attr($thumb_space) : 1),
			'selectLabel'				=> __('All Categories', 'vp_textdomain'),
			'gridType'					=> 'component',
			'addMouseWheelSupport'		=> 'no',
			'gridId'					=> $element_id
		);
		wp_localize_script( 'horizontal-gridfolio', 'ozyHorizontalGridFolioOptions', $params );		
		
		$output = 
		'<!-- div used as a holder for the grid -->
		<div id="'. $element_id .'" class="horizontal-grid-folio-gallery"></div>	
		<ul id="playlist" style="display: none;">
			<!-- skin -->
			<ul data-skin="">';
		$output .= '
				<li data-preloader-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/rotite-30-29.png"></li>
				<li data-show-more-thumbnails-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/loadmorewhite.png"></li>
				<li data-show-more-thumbnails-button-selectsed-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/loadmoreblack.png"></li>
				<li data-image-icon-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/photoIcon.png"></li>
				<li data-video-icon-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/videoIcon.png"></li>
				<li data-link-icon-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/linkIcon.png"></li>
				<li data-iframe-icon-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/iframeIcon.png"></li>
				<li data-hand-move-icon-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/handnmove.cur"></li>
				<li data-hand-drag-icon-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/handgrab.cur"></li>
				<li data-fullscreen-button-normal-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/fbnn.png"></li>
				<li data-fullscreen-button-normal-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/fbns.png"></li>
				<li data-fullscreen-button-full-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/fbfn.png"></li>
				<li data-fullscreen-button-full-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/fbfs.png"></li>
				<li data-combobox-down-arrow-icon-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/combobox-down-arrow.png"></li>
				<li data-combobox-down-arrow-icon-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/combobox-down-arrow-rollover.png"></li>
				<li data-combobox-up-arrow-icon-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/combobox-up-arrow.png"></li>
				<li data-combobox-up-arrow-icon-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/combobox-up-arrow-rollover.png"></li>
				<li data-scrollbar-track-background-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-track-background.png"></li>
				<li data-scrollbar-handler-background-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-center-background.png"></li>
				<li data-scrollbar-handler-background-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-center-background-rollover.png"></li>
				<li data-scrollbar-handler-left-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-left.png"></li>
				<li data-scrollbar-handler-left-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-left-rollover.png"></li>
				<li data-scrollbar-handler-right-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-right.png"></li>
				<li data-scrollbar-handler-right-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-right-rollover.png"></li>
				<li data-scrollbar-handler-center-icon-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-center-icon.png"></li>
				<li data-scrollbar-handler-center-icon-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-center-icon-rollover.png"></li>
				<li data-lightbox-slideshow-preloader-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/slideShowPreloader.png"></li>
				<li data-lightbox-close-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/galleryCloseButtonNormalState.png"></li>
				<li data-lightbox-close-button-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/galleryCloseButtonSelectedState.png"></li>
				<li data-lightbox-next-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/nextIconNormalState.png"></li>
				<li data-lightbox-next-button-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/nextIconSelectedState.png"></li>
				<li data-lightbox-prev-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/prevIconNormalState.png"></li>
				<li data-lightbox-prev-button-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/prevIconSelectedState.png"></li>
				<li data-lightbox-play-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/playButtonNormalState.png"></li>
				<li data-lightbox-play-button-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/playButtonSelectedState.png"></li>
				<li data-lightbox-pause-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/pauseButtonNormalState.png"></li>
				<li data-lightbox-pause-button-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/pauseButtonSelectedState.png"></li>
				<li data-lightbox-maximize-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/maximizeButtonNormalState.png"></li>
				<li data-lightbox-maximize-button-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/maximizeButtonSelectedState.png"></li>
				<li data-lightbox-minimize-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/minimizeButtonNormalState.png"></li>
				<li data-lightbox-minimize-button-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/minimizeButtonSelectedState.png"></li>
				<li data-lightbox-info-button-open-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/infoButtonOpenNormalState.png"></li>
				<li data-lightbox-info-button-open-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/infoButtonOpenSelectedState.png"></li>
				<li data-lightbox-info-button-close-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/infoButtonCloseNormalPath.png"></li>
				<li data-lightbox-info-button-close-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/infoButtonCloseSelectedPath.png"></li>
			</ul> 
		
			<ul data-cat="gallery">';
		
		if(esc_attr($thumb_size) == 'regular') {
			$thumb_size_arr = array('gridfolio-regular');
		}else if(esc_attr($thumb_size) == 'large') {
			$thumb_size_arr = array('gridfolio-large');
		}else if(esc_attr($thumb_size) == 'tall') {
			$thumb_size_arr = array('gridfolio-tall');
		}else{
			$thumb_size_arr = array('gridfolio-regular', 'gridfolio-large', 'gridfolio-regular', 'gridfolio-tall', 'gridfolio-large', 'gridfolio-tall', 'gridfolio-regular');
		}

		foreach(explode(',', esc_attr($images)) as $attachment_id) {
			$attachment = get_post($attachment_id);
			$thumb_image = wp_get_attachment_image_src( $attachment_id, $thumb_size_arr[rand(0,(count($thumb_size_arr)-1))]);
			if(is_array($thumb_image) && count($thumb_image)>0) {									
				$output .= '
					<ul>
						<li data-type="media" data-url="' . $attachment->guid . '" data-linktogo=""></li>
						<li data-thumbnail-path="' . $thumb_image[0] . '"></li>
						 <li data-thumbnail-text>
							<span class="oic oic-pe-icon-7-stroke-87"></span>
						</li>
						<li data-info="">
							<p class="mediaDescriptionHeader">' . $attachment->post_title . '</p>
							<p class="mediaDescriptionText">' .  $attachment->post_excerpt . '</p>
						</li>
					</ul>';
			}
		}

		$output .= '
			</ul>
		</ul>';
		
		return $output;
	}

	add_shortcode('ozy_vc_hg_gallery', 'ozy_vc_hg_gallery');

	vc_map( array(
	   "name" => __("Horizontal Grid (Gallery)", "vp_textdomain"),
	   "base" => "ozy_vc_hg_gallery",
	   "class" => "",
	   "controls" => "full",
	   'category' => 'by OZY',
	   "icon" => "icon-wpb-ozy-el",
	   "params" => array(
			array(
				"type" => "attach_images",
				"class" => "",
				"heading" => __("Gallery Images", "vp_textdomain"),
				"param_name" => "images",
				"admin_label" => false,
				"value" => "",
				"description" => __("Please choose images that you like to show in your gallery", "vp_textdomain")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Thumbnail Size", "vp_textdomain"),
				"param_name" => "thumb_size",
				"value" => array("random", "regular", "tall", "large"),
				"admin_label" => true,
				"description" => __("Select size of your thumbnail images.", "vp_textdomain")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Type of Scroll", "vp_textdomain"),
				"param_name" => "scrollbar_type",
				"value" => array("drag", "scrollbar"),
				"admin_label" => true
			),
			array(
				"type" => "dropdown",
				"heading" => __("Space Between Thumbnails", "vp_textdomain"),
				"param_name" => "thumb_space",
				"value" => array("0","1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20"),
				"admin_label" => true,
				"description" => __("Vertical and Horizontal space between thumbnail images.", "vp_textdomain")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number of Thumbnails", "vp_textdomain"),
				"param_name" => "thumb_number",
				"admin_label" => true,
				"value" => "32",
				"description" => __("How many thumbnails you want to show on initialization and loading more.", "vp_textdomain")
			),			
		)
	) );
}

/**
* Horizontal Grid Portfolio
*/
if (!function_exists('ozy_vc_hg_portfolio')) {
	function ozy_vc_hg_portfolio( $atts, $content = null ) {
		$atts = vc_map_get_attributes('ozy_vc_hg_portfolio', $atts);
	    extract(shortcode_atts(array(
			'category_filter' => 'off',
			'thumb_number'	=> '32',
			'thumb_space' => '1',
			'scrollbar_type' => 'drag',
			'categories' => '',
			'orderby' => 'date',
			'order' => 'DESC'			
			), $atts ) 
		);
		
		$element_id = 'horizontalGridFolioContainer' . rand(0,1000);
		
		if(esc_attr($category_filter) === 'off') {
			global $ozyHelper;
			$ozyHelper->set_footer_style( '#'. $element_id .' .hgFilterBox { display: none !important; }' . PHP_EOL );
		}		
		
		wp_enqueue_script('horizontal-gridfolio');
		wp_enqueue_style('horizontal-gridfolio');		

		$params = array(
			'nrOfThumbsToShowOnSet'		=> ((int)esc_attr($thumb_number) > 0 ? esc_attr($thumb_number) : 32),
			'scrollBarType' 			=> esc_attr($scrollbar_type),
			'SpaceBetweenThumbnails'	=> ((int)esc_attr($thumb_space) > 0 ? esc_attr($thumb_space) : 1),
			'selectLabel'				=> __('All Categories', 'vp_textdomain'),
			'gridType'					=> 'component',
			'addMouseWheelSupport'		=> 'no',
			'gridId'					=> $element_id
		);

		wp_localize_script( 'horizontal-gridfolio', 'ozyHorizontalGridFolioOptions', $params );

		$output = 
		'<!-- div used as a holder for the grid -->
		<div id="'. $element_id .'" class="horizontal-grid-folio-portfolio"></div>	
		<ul id="playlist" style="display: none;">
			<!-- skin -->
			<ul data-skin="">';
		$output .= '
				<li data-preloader-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/rotite-30-29.png"></li>
				<li data-show-more-thumbnails-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/loadmorewhite.png"></li>
				<li data-show-more-thumbnails-button-selectsed-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/loadmoreblack.png"></li>
				<li data-image-icon-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/photoIcon.png"></li>
				<li data-video-icon-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/videoIcon.png"></li>
				<li data-link-icon-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/linkIcon.png"></li>
				<li data-iframe-icon-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/iframeIcon.png"></li>
				<li data-hand-move-icon-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/handnmove.cur"></li>
				<li data-hand-drag-icon-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/handgrab.cur"></li>
				<li data-fullscreen-button-normal-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/fbnn.png"></li>
				<li data-fullscreen-button-normal-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/fbns.png"></li>
				<li data-fullscreen-button-full-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/fbfn.png"></li>
				<li data-fullscreen-button-full-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/fbfs.png"></li>
				<li data-combobox-down-arrow-icon-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/combobox-down-arrow.png"></li>
				<li data-combobox-down-arrow-icon-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/combobox-down-arrow-rollover.png"></li>
				<li data-combobox-up-arrow-icon-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/combobox-up-arrow.png"></li>
				<li data-combobox-up-arrow-icon-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/combobox-up-arrow-rollover.png"></li>
				<li data-scrollbar-track-background-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-track-background.png"></li>
				<li data-scrollbar-handler-background-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-center-background.png"></li>
				<li data-scrollbar-handler-background-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-center-background-rollover.png"></li>
				<li data-scrollbar-handler-left-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-left.png"></li>
				<li data-scrollbar-handler-left-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-left-rollover.png"></li>
				<li data-scrollbar-handler-right-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-right.png"></li>
				<li data-scrollbar-handler-right-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-right-rollover.png"></li>
				<li data-scrollbar-handler-center-icon-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-center-icon.png"></li>
				<li data-scrollbar-handler-center-icon-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/scrollbar-handler-center-icon-rollover.png"></li>
				<li data-lightbox-slideshow-preloader-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/slideShowPreloader.png"></li>
				<li data-lightbox-close-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/galleryCloseButtonNormalState.png"></li>
				<li data-lightbox-close-button-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/galleryCloseButtonSelectedState.png"></li>
				<li data-lightbox-next-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/nextIconNormalState.png"></li>
				<li data-lightbox-next-button-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/nextIconSelectedState.png"></li>
				<li data-lightbox-prev-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/prevIconNormalState.png"></li>
				<li data-lightbox-prev-button-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/prevIconSelectedState.png"></li>
				<li data-lightbox-play-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/playButtonNormalState.png"></li>
				<li data-lightbox-play-button-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/playButtonSelectedState.png"></li>
				<li data-lightbox-pause-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/pauseButtonNormalState.png"></li>
				<li data-lightbox-pause-button-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/pauseButtonSelectedState.png"></li>
				<li data-lightbox-maximize-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/maximizeButtonNormalState.png"></li>
				<li data-lightbox-maximize-button-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/maximizeButtonSelectedState.png"></li>
				<li data-lightbox-minimize-button-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/minimizeButtonNormalState.png"></li>
				<li data-lightbox-minimize-button-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/minimizeButtonSelectedState.png"></li>
				<li data-lightbox-info-button-open-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/infoButtonOpenNormalState.png"></li>
				<li data-lightbox-info-button-open-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/infoButtonOpenSelectedState.png"></li>
				<li data-lightbox-info-button-close-normal-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/infoButtonCloseNormalPath.png"></li>
				<li data-lightbox-info-button-close-selected-path="'. OZY_BASE_URL .'images/horizontal-gridfolio/infoButtonCloseSelectedPath.png"></li>
			</ul>';
		
		if(esc_attr($categories)==='' || strpos(esc_attr($categories), '-1')>-1) { //if All category option selected
			$include_categories = '';
		}else{
			$include_categories = esc_attr($categories);
		}

		$cat_args = array(
			'taxonomy'=>'portfolio_category', 
			'post_type' => 'ozy_portfolio', 
			'hide_empty' =>1
		);
		
		if('-1' != $include_categories) {
			$cat_args['include'] = $include_categories;
		}
		$portfolio_categories = get_categories($cat_args);

		foreach ($portfolio_categories as $portfolio_category) {
			
			$output .= '<ul data-cat="' . $portfolio_category->name . '">' . PHP_EOL;

			$args = array(
				'post_type' 		=> 'ozy_portfolio',
				'tax_query' => array(
					array(
						'taxonomy' 	=> 'portfolio_category',
						'field' 	=> 'id',
						'terms' 	=> array($portfolio_category->cat_ID),
						'operator' 	=> 'IN'
					),
				),
				'posts_per_page'		=> 10000,
				'orderby' 				=> esc_attr($orderby),
				'order' 				=> esc_attr($order),
				'ignore_sticky_posts' 	=> 1,
				'meta_key' 				=> '_thumbnail_id'
			);

			$hg_query = new WP_Query( $args );
			
			ob_start();
			include(locate_template('include/loop-horizontal_grid_folio.php'));
			$output .= ob_get_clean();
			
			$output .= '</ul>' . PHP_EOL;
		}

		$output .= '
		</ul>';
		
		return $output;
	}

	add_shortcode('ozy_vc_hg_portfolio', 'ozy_vc_hg_portfolio');

	vc_map( array(
	   "name" => __("Horizontal Grid (Portfolio)", "vp_textdomain"),
	   "base" => "ozy_vc_hg_portfolio",
	   "class" => "",
	   "controls" => "full",
	   'category' => 'by OZY',
	   "icon" => "icon-wpb-ozy-el",
	   "params" => array(
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Categories", "vp_textdomain"),
				"param_name" => "categories",
				"admin_label" => true,
				"value" => vp_bind_ozy_enjooy_portfolio_categories_shortcode(),
				"description" => __("Please choose categories you would like to list posts from.", "vp_textdomain")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Category Filter", "vp_textdomain"),
				"param_name" => "category_filter",
				"value" => array("off", "on"),
				"admin_label" => true,
				"description" => __("Display category filter?.", "vp_textdomain")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Type of Scroll", "vp_textdomain"),
				"param_name" => "scrollbar_type",
				"value" => array("drag", "scrollbar"),
				"admin_label" => true
			),
			array(
				"type" => "dropdown",
				"heading" => __("Space Between Thumbnails", "vp_textdomain"),
				"param_name" => "thumb_space",
				"value" => array("0","1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20"),
				"admin_label" => true,
				"description" => __("Vertical and Horizontal space between thumbnail images.", "vp_textdomain")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number of Items", "vp_textdomain"),
				"param_name" => "thumb_number",
				"admin_label" => true,
				"value" => "32",
				"description" => __("How many thumbnails you want to show on initialization and loading more.", "vp_textdomain")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Order By", "vp_textdomain"),
				"param_name" => "orderby",
				"value" => array("date", "menu_order", "tall", "large"),
				"admin_label" => true,
				"description" => __("Please Note: Since items sorted in their belonging categories, sort result will be shown in category based.", "vp_textdomain")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Order", "vp_textdomain"),
				"param_name" => "order",
				"value" => array("DESC", "ASC"),
				"admin_label" => true
			)				
		)
	) );
}
?>