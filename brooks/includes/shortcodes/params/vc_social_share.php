<?php

WpbakeryShortcodeParams::addField( 'brooks_social_share', 'brooks_social_share_settings', BROOKS_SCRIPTS . '/admin/vc_params/brooks_social_share.js' );
function brooks_social_share_settings( $settings, $value ) {

    // Convert JSON string to Array
    $networks = json_decode($value, true);

    $return = '<div class="brooks-layout-repater">';

    if(empty($networks)){

        $return .= '<div class="brooks-repeater-item" >';
        $return .= '<select class="brooks-repeater-selecter" data-selected="facebook">';
        $return .= '  <option value="facebook">facebook</option>';
        $return .= '  <option value="instagram">instagram</option>';
        $return .= '  <option value="flickr">flickr</option>';
        $return .= '  <option value="twitter">twitter</option>';
        $return .= '  <option value="vimeo">vimeo</option>';
        $return .= '  <option value="behance">behance</option>';
        $return .= '  <option value="baidu">baidu</option>';
        $return .= '  <option value="discuss">discuss</option>';
        $return .= '  <option value="dribble">dribble</option>';
        $return .= '  <option value="googleplus">googleplus</option>';
        $return .= '  <option value="vimineo">in</option>';
        $return .= '  <option value="pinterest">pinterest</option>';
        $return .= '  <option value="qzone">qzone</option>';
        $return .= '  <option value="reddit">reddit</option>';
        $return .= '  <option value="soundcloud">soundcloud</option>';
        $return .= '  <option value="tumblr">tumblr</option>';
        $return .= '  <option value="weibo">weibo</option>';
        $return .= '  <option value="youtube">youtube</option>';
        $return .= ' </select>';
        $return .= ' <input class="brooks-layout-ffield active" type="url" placeholder="https://www.facebook.com" >  <button class="button">Ok</button>';
        $return .= ' <div class="brooks-repeater-controls">';
        $return .= ' <span class="brooks-layout-minus">-</span>';
        $return .= ' <span class="brooks-layout-add">+</span>';
        $return .= '</div></div>';

    }
    foreach( $networks as $network  ):

            $return .= '<div class="brooks-repeater-item" >';
            $return .= '<select class="brooks-repeater-selecter" data-selected="'. $network["type"] .'">';
            $return .= '  <option value="facebook">facebook</option>';
            $return .= '  <option value="instagram">instagram</option>';
            $return .= '  <option value="flickr">flickr</option>';
            $return .= '  <option value="twitter">twitter</option>';
            $return .= '  <option value="vimeo">vimeo</option>';
            $return .= '  <option value="behance">behance</option>';
            $return .= '  <option value="baidu">baidu</option>';
            $return .= '  <option value="discuss">discuss</option>';
            $return .= '  <option value="dribble">dribble</option>';
            $return .= '  <option value="googleplus">googleplus</option>';
            $return .= '  <option value="vimineo">in</option>';
            $return .= '  <option value="pinterest">pinterest</option>';
            $return .= '  <option value="qzone">qzone</option>';
            $return .= '  <option value="reddit">reddit</option>';
            $return .= '  <option value="soundcloud">soundcloud</option>';
            $return .= '  <option value="tumblr">tumblr</option>';
            $return .= '  <option value="weibo">weibo</option>';
            $return .= '  <option value="youtube">youtube</option>';
            $return .= ' </select>';
            $return .= ' <input class="brooks-layout-ffield active" type="url" placeholder="https://www.facebook.com" value="'. $network["network"] .'" >     <button class="button">Ok</button>';
            $return .= ' <div class="brooks-repeater-controls">';
            $return .= ' <span class="brooks-layout-minus">-</span>';
            $return .= ' <span class="brooks-layout-add">+</span>';
            $return .= '</div></div>';

    endforeach;

    

    $return .= '</div>';

    $return .= '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value ' . esc_attr( $settings['param_name'] ) . ' ' . esc_attr( $settings['type'] ) . '_field hidden" type="text" value=\'' . $value . '\' />';

    return $return;
}