<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $source
 * @var $text
 * @var $link
 * @var $google_fonts
 * @var $font_container
 * @var $el_class
 * @var $css
 * @var $font_container_data - returned from $this->getAttributes
 * @var $google_fonts_data - returned from $this->getAttributes
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */
$source = $text = $link = $google_fonts = $font_container = $el_class = $css = $font_container_data = $google_fonts_data = $use_theme_fonts = '';
$brooks_font_weight = $brooks_css_animation = $decor = $decor_use = $decor_color = $decor_align = '';

// This is needed to extract $font_container_data and $google_fonts_data
extract( $this->getAttributes( $atts ) );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );

$settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $settings ) && ! empty( $settings ) ) {
    $subsets = '&subset=' . implode( ',', $settings );
} else {
    $subsets = '';
}

if ( isset( $google_fonts_data['values']['font_family'] ) ) {
    wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}

if(!empty($font_size))
    $styles[] = 'font-size:'.$font_size.'px';

if ( ! empty( $styles ) ) {
    $style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
} else {
    $style = '';
}

if ( 'post_title' === $source ) {
    $text = get_the_title( get_the_ID() );
}

if ( ! empty( $link ) ) {
    $link = vc_build_link( $link );
    $text = '<a href="' . esc_attr( $link['url'] ) . '"'
        . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
        . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
        . '>' . $text . '</a>';
}

$css_class .= (( !empty($brooks_font_weight) &&  $use_theme_fonts == 'yes')?' text-'.$brooks_font_weight:'');

if( !empty($brooks_css_animation) && $brooks_css_animation !== 'typed'){
    $css_class .= ' theme__animation -'.$brooks_css_animation;
    brooks_enqueue_custom('css-animation');
}
if( $brooks_css_animation == 'typed' ){
    $css_class .= ' theme__animation-'.$brooks_css_animation;

    brooks_enqueue_custom('typed');
    $text = '<div class="typed-strings"><p>'
            .  $text
            . '</p></div>'
            . '<span class="typed"></span>';
}
$decor_map  = array(
    'a' => BROOKS_IMAGES . '/decor/1.svg',
    'b' => BROOKS_IMAGES . '/decor/2.svg',
    'c' => BROOKS_IMAGES . '/decor/3.svg',
    'd' => BROOKS_IMAGES . '/decor/4.svg',
    'e' => BROOKS_IMAGES . '/decor/5.svg',
    'f' => BROOKS_IMAGES . '/decor/6.svg',
    'g' => BROOKS_IMAGES . '/decor/7.svg',
    'h' => BROOKS_IMAGES . '/decor/8.svg',
    'i' => BROOKS_IMAGES . '/decor/9.svg',
    'j' => BROOKS_IMAGES . '/decor/10.svg',
    'k' => BROOKS_IMAGES . '/decor/11.svg',
    'l' => BROOKS_IMAGES . '/decor/12.svg',
    'm' => BROOKS_IMAGES . '/decor/13.svg',
    'o' => BROOKS_IMAGES . '/decor/14.svg',
    'p' => BROOKS_IMAGES . '/decor/15.svg',
    'q' => BROOKS_IMAGES . '/decor/16.svg',
    'r' => BROOKS_IMAGES . '/decor/17.svg',
    's' => BROOKS_IMAGES . '/decor/18.svg',
    't' => BROOKS_IMAGES . '/decor/19.svg'
);
$uid = 'decor__'.brooks_get_unique_id();
$output = '';
if( $decor_use ){
    $output .= "<style> 
                #$uid{
                    height: 30px;
                    width: 100%;
                    position: relative;
                    overflow: hidden;
                    margin-top: 15px;
                }
                #$uid svg{
                    height: 100%;
                    width: 100%;
                }
                #$uid use{
                      fill: $decor_color;
                      stroke: $decor_color;
                }  
          
                </style>";
    brooks_enqueue_custom('align-svg');
}
if ( apply_filters( 'vc_custom_heading_template_use_wrapper', false ) ) {
    $output .= '<div  class="' . esc_attr( $css_class ) . '" >';
    $output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' >';
    $output .= $text;
    if( $decor_use ) {
        $output .= '<div id="' . $uid . '"><svg preserveAspectRatio="xMinYMin meet" xmlns="http://www.w3.org/2000/svg" width="150px">
                      <use data-alignment="' . $decor_align . '" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' . $decor_map[$decor] . '#' . $decor . '"></use>
                </svg></div>';
    }
    $output .= '</' . $font_container_data['values']['tag'] . '>';
    $output .= '</div>';
} else {
    $output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' class="' . esc_attr( $css_class ) . '" >';
    $output .= $text;
    if( $decor_use ) {
        $output .= '<div id="' . $uid . '"><svg preserveAspectRatio="xMinYMin meet" xmlns="http://www.w3.org/2000/svg" width="150px">
                      <use data-alignment="' . $decor_align . '" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' . $decor_map[$decor] . '#' . $decor . '"></use>
                </svg></div>';
    }
    $output .= '</' . $font_container_data['values']['tag'] . '>';
}

echo $output;
