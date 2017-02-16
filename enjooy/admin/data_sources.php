<?php
VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_align_by_menu_type');

function vp_bind_ozy_enjooy_align_by_menu_type($value) {
	$result = array(
		array('value' => 'left', 'label' => __('Left', 'vp_textdomain'))		
	);
	if($value !== 'side-menu') {
		array_push($result, array('value' => 'right', 'label' => __('Right', 'vp_textdomain')));
	}
	if($value !== 'mega' && $value !== 'side-menu') {
		array_push($result, array('value' => 'center', 'label' => __('Center', 'vp_textdomain')));

	}
	return $result;
}

VP_Security::instance()->whitelist_function('vp_dep_ozy_enjooy_portfolio_video');

function vp_dep_ozy_enjooy_portfolio_video($value)
{
	if($value === 'video')
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('vp_dep_ozy_enjooy_portfolio_url');

function vp_dep_ozy_enjooy_portfolio_url($value)
{
	if($value === 'url')
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('vp_dep_ozy_enjooy_portfolio_link');

function vp_dep_ozy_enjooy_portfolio_link($value)
{
	if($value === 'link')
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_content_background');

function vp_bind_ozy_enjooy_content_background($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(255,255,255,1)';
		case 'crimson':
			return 'rgba(255,255,255,1)';
		case 'sunset_orange':
			return 'rgba(255,255,255,1)';
		case 'dark_orchid':
			return 'rgba(255,255,255,1)';
		case 'spring_green':
			return 'rgba(255,255,255,1)';
		case 'hot_pink':
			return 'rgba(255,255,255,1)';
		case 'hot_red':
			return 'rgba(255,255,255,1)';
		case 'lawn_green':
			return 'rgba(255,255,255,1)';
		case 'malachite':
			return 'rgba(255,255,255,1)';
		case 'mikado_yellow':
			return 'rgba(255,255,255,1)';
		case 'medium_turquoise':
			return 'rgba(255,255,255,1)';
		case 'light':
			return 'rgba(255,255,255,1)';																							
		default:
			return 'rgba(255,255,255,1)';
	}

}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_footer_sidebar_background');

function vp_bind_ozy_enjooy_footer_sidebar_background($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(45,49,52,1)';
		case 'crimson':
			return 'rgba(45,49,52,1)';
		case 'sunset_orange':
			return 'rgba(45,49,52,1)';
		case 'dark_orchid':
			return 'rgba(45,49,52,1)';
		case 'spring_green':
			return 'rgba(45,49,52,1)';
		case 'hot_pink':
			return 'rgba(45,49,52,1)';
		case 'hot_red':
			return 'rgba(45,49,52,1)';
		case 'lawn_green':
			return 'rgba(45,49,52,1)';
		case 'malachite':
			return 'rgba(45,49,52,1)';
		case 'mikado_yellow':
			return 'rgba(45,49,52,1)';
		case 'medium_turquoise':
			return 'rgba(45,49,52,1)';
		case 'light':
			return 'rgba(45,49,52,1)';
		default:
			return 'rgba(45,49,52,1)';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_footer_background');

function vp_bind_ozy_enjooy_footer_background($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(34,38,41,1)';
		case 'crimson':
			return 'rgba(34,38,41,1)';
		case 'sunset_orange':
			return 'rgba(34,38,41,1)';
		case 'dark_orchid':
			return 'rgba(34,38,41,1)';
		case 'spring_green':
			return 'rgba(34,38,41,1)';
		case 'hot_pink':
			return 'rgba(34,38,41,1)';
		case 'hot_red':
			return 'rgba(34,38,41,1)';
		case 'lawn_green':
			return 'rgba(34,38,41,1)';
		case 'malachite':
			return 'rgba(34,38,41,1)';
		case 'mikado_yellow':
			return 'rgba(34,38,41,1)';
		case 'medium_turquoise':
			return 'rgba(34,38,41,1)';
		case 'light':
			return 'rgba(34,38,41,1)';
		default:
			return 'rgba(34,38,41,1)';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_content_color');

function vp_bind_ozy_enjooy_content_color($preset)
{
	switch ($preset) {
		case 'blue':
			return '#222222';
		case 'crimson':
			return '#222222';
		case 'sunset_orange':
			return '#222222';
		case 'dark_orchid':
			return '#222222';
		case 'spring_green':
			return '#222222';
		case 'hot_pink':
			return '#222222';
		case 'hot_red':
			return '#222222';
		case 'lawn_green':
			return '#222222';
		case 'malachite':
			return '#222222';
		case 'mikado_yellow':
			return '#222222';
		case 'medium_turquoise':
			return '#222222';
		case 'light':
			return '#222222';
		default:
			return '#222222';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_content_color_alternate');

function vp_bind_ozy_enjooy_content_color_alternate($preset)
{
	switch ($preset) {
		case 'blue':
			return '#1acdfc';
		case 'crimson':
			return '#ed1b24';
		case 'sunset_orange':
			return '#f64b16';
		case 'dark_orchid':
			return '#ab43e0';
		case 'spring_green':
			return '#53d769';
		case 'hot_pink':
			return '#ff2f64';
		case 'hot_red':
			return '#fd2823';
		case 'lawn_green':
			return '#0cc22a';
		case 'malachite':
			return '#2b9573';
		case 'mikado_yellow':
			return '#f6c918';
		case 'medium_turquoise':
			return '#2edec4';
		case 'light':
			return '#52ebca';
		default:
			return '#ed1b24';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_content_color_alternate2');

function vp_bind_ozy_enjooy_content_color_alternate2($preset)
{
	switch ($preset) {
		case 'blue':
			return '#989898';
		case 'crimson':
			return '#989898';
		case 'sunset_orange':
			return '#989898';
		case 'dark_orchid':
			return '#989898';
		case 'spring_green':
			return '#989898';
		case 'hot_pink':
			return '#989898';
		case 'hot_red':
			return '#989898';
		case 'lawn_green':
			return '#989898';
		case 'malachite':
			return '#989898';
		case 'mikado_yellow':
			return '#989898';
		case 'medium_turquoise':
			return '#989898';
		case 'light':
			return '#989898';
		default:
			return '#989898';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_content_color_alternate3');

function vp_bind_ozy_enjooy_content_color_alternate3($preset)
{
	switch ($preset) {
		case 'blue':
			return '#ffffff';
		case 'crimson':
			return '#ffffff';
		case 'sunset_orange':
			return '#ffffff';
		case 'dark_orchid':
			return '#ffffff';
		case 'spring_green':
			return '#ffffff';
		case 'hot_pink':
			return '#ffffff';
		case 'hot_red':
			return '#ffffff';
		case 'lawn_green':
			return '#ffffff';
		case 'malachite':
			return '#ffffff';
		case 'mikado_yellow':
			return '#ffffff';
		case 'medium_turquoise':
			return '#ffffff';
		case 'light':
			return '#ffffff';
		default:
			return '#ffffff';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_content_background_color_alternate');

function vp_bind_ozy_enjooy_content_background_color_alternate($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(240,240,240,1)';
		case 'crimson':
			return 'rgba(240,240,240,1)';
		case 'sunset_orange':
			return 'rgba(240,240,240,1)';
		case 'dark_orchid':
			return 'rgba(240,240,240,1)';
		case 'spring_green':
			return 'rgba(240,240,240,1)';
		case 'hot_pink':
			return 'rgba(240,240,240,1)';
		case 'hot_red':
			return 'rgba(240,240,240,1)';
		case 'lawn_green':
			return 'rgba(240,240,240,1)';
		case 'malachite':
			return 'rgba(240,240,240,1)';
		case 'mikado_yellow':
			return 'rgba(240,240,240,1)';
		case 'medium_turquoise':
			return 'rgba(240,240,240,1)';
		case 'light':
			return 'rgba(240,240,240,1)';
		default:
			return 'rgba(240,240,240,1)';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_seperator_border_color');

function vp_bind_ozy_enjooy_seperator_border_color($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(240,240,240,1)';
		case 'crimson':
			return 'rgba(240,240,240,1)';
		case 'sunset_orange':
			return 'rgba(240,240,240,1)';
		case 'dark_orchid':
			return 'rgba(240,240,240,1)';
		case 'spring_green':
			return 'rgba(240,240,240,1)';
		case 'hot_pink':
			return 'rgba(240,240,240,1)';
		case 'hot_red':
			return 'rgba(240,240,240,1)';
		case 'lawn_green':
			return 'rgba(240,240,240,1)';
		case 'malachite':
			return 'rgba(240,240,240,1)';
		case 'mikado_yellow':
			return 'rgba(240,240,240,1)';
		case 'medium_turquoise':
			return 'rgba(240,240,240,1)';
		case 'light':
			return 'rgba(240,240,240,1)';
		default:
			return 'rgba(240,240,240,1)';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_primary_menu_logo_color');

function vp_bind_ozy_enjooy_primary_menu_logo_color($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(255,255,255,1)';
		case 'crimson':
			return 'rgba(255,255,255,1)';
		case 'sunset_orange':
			return 'rgba(255,255,255,1)';
		case 'dark_orchid':
			return 'rgba(255,255,255,1)';
		case 'spring_green':
			return 'rgba(255,255,255,1)';
		case 'hot_pink':
			return 'rgba(255,255,255,1)';
		case 'hot_red':
			return 'rgba(255,255,255,1)';
		case 'lawn_green':
			return 'rgba(255,255,255,1)';
		case 'malachite':
			return 'rgba(255,255,255,1)';
		case 'mikado_yellow':
			return 'rgba(255,255,255,1)';
		case 'medium_turquoise':
			return 'rgba(255,255,255,1)';
		case 'light':
			return 'rgba(0,0,0,1)';
		default:
			return 'rgba(255,255,255,1)';
	}
}


VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_primary_menu_font_color');

function vp_bind_ozy_enjooy_primary_menu_font_color($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(206,206,206,1)';
		case 'crimson':
			return 'rgba(206,206,206,1)';
		case 'sunset_orange':
			return 'rgba(206,206,206,1)';
		case 'dark_orchid':
			return 'rgba(198,94,251,1)';
		case 'spring_green':
			return 'rgba(206,206,206,1)';
		case 'hot_pink':
			return 'rgba(206,206,206,1)';
		case 'hot_red':
			return 'rgba(255,186,185,1)';
		case 'lawn_green':
			return 'rgba(206,206,206,1)';
		case 'malachite':
			return 'rgba(255,255,255,1)';
		case 'mikado_yellow':
			return 'rgba(206,206,206,1)';
		case 'medium_turquoise':
			return 'rgba(206,206,206,1)';
		case 'light':
			return 'rgba(129,129,129,1)';
		default:
			return 'rgba(206,206,206,1)';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_primary_menu_font_color_hover');

function vp_bind_ozy_enjooy_primary_menu_font_color_hover($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(26,205,252,1)';
		case 'crimson':
			return 'rgba(255,246,0,1)';
		case 'sunset_orange':
			return 'rgba(246,75,22,1)';
		case 'dark_orchid':
			return 'rgba(255,246,0,1)';
		case 'spring_green':
			return 'rgba(83,215,105,1)';
		case 'hot_pink':
			return 'rgba(255,47,100,1)';
		case 'hot_red':
			return 'rgba(255,255,255,1)';
		case 'lawn_green':
			return 'rgba(12,194,42,1)';
		case 'malachite':
			return 'rgba(32,236,170,1)';
		case 'mikado_yellow':
			return 'rgba(206,206,206,1)';
		case 'medium_turquoise':
			return 'rgba(206,206,206,1)';
		case 'light':
			return 'rgba(0,0,0,1)';
		default:
			return 'rgba(255,246,0,1)';
	}
}


VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_primary_menu_background_color');

function vp_bind_ozy_enjooy_primary_menu_background_color($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(34,34,34,1)';
		case 'crimson':
			return 'rgba(34,34,34,1)';
		case 'sunset_orange':
			return 'rgba(34,34,34,1)';
		case 'dark_orchid':
			return 'rgba(134,48,178,1)';
		case 'spring_green':
			return 'rgba(34,34,34,1)';
		case 'hot_pink':
			return 'rgba(34,34,34,1)';
		case 'hot_red':
			return 'rgba(213,8,3,1)';
		case 'lawn_green':
			return 'rgba(34,34,34,1)';
		case 'malachite':
			return 'rgba(43,149,115,1)';
		case 'mikado_yellow':
			return 'rgba(34,34,34,1)';
		case 'medium_turquoise':
			return 'rgba(34,34,34,1)';
		case 'light':
			return 'rgba(249,249,249,1)';
		default:
			return 'rgba(34,34,34,1)';
	}
}


VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_primary_menu_background_color_hover');

function vp_bind_ozy_enjooy_primary_menu_background_color_hover($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(15,15,15,1)';
		case 'crimson':
			return 'rgba(15,15,15,1)';
		case 'sunset_orange':
			return 'rgba(15,15,15,1)';
		case 'dark_orchid':
			return 'rgba(110,35,149,1)';
		case 'spring_green':
			return 'rgba(15,15,15,1)';
		case 'hot_pink':
			return 'rgba(15,15,15,1)';
		case 'hot_red':
			return 'rgba(177,4,0,1)';
		case 'lawn_green':
			return 'rgba(15,15,15,1)';
		case 'malachite':
			return 'rgba(20,108,80,1)';
		case 'mikado_yellow':
			return 'rgba(15,15,15,1)';
		case 'medium_turquoise':
			return 'rgba(15,15,15,1)';
		case 'light':
			return 'rgba(241,241,241,1)';
		default:
			return 'rgba(15,15,15,1)';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_primary_menu_icon_color');

function vp_bind_ozy_enjooy_primary_menu_icon_color($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(67,67,67,1)';
		case 'crimson':
			return 'rgba(67,67,67,1)';
		case 'sunset_orange':
			return 'rgba(67,67,67,1)';
		case 'dark_orchid':
			return 'rgba(198,94,251,1)';
		case 'spring_green':
			return 'rgba(67,67,67,1)';
		case 'hot_pink':
			return 'rgba(67,67,67,1)';
		case 'hot_red':
			return 'rgba(255,255,255,1)';
		case 'lawn_green':
			return 'rgba(67,67,67,1)';
		case 'malachite':
			return 'rgba(32,236,170,1)';
		case 'mikado_yellow':
			return 'rgba(67,67,67,1)';
		case 'medium_turquoise':
			return 'rgba(67,67,67,1)';
		case 'light':
			return 'rgba(129,129,129,1)';
		default:
			return 'rgba(67,67,67,1)';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_primary_menu_separator_color');

function vp_bind_ozy_enjooy_primary_menu_separator_color($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(67,67,67,1)';
		case 'crimson':
			return 'rgba(67,67,67,1)';
		case 'sunset_orange':
			return 'rgba(67,67,67,1)';
		case 'dark_orchid':
			return 'rgba(155,72,198,1)';
		case 'spring_green':
			return 'rgba(67,67,67,1)';
		case 'hot_pink':
			return 'rgba(67,67,67,1)';
		case 'hot_red':
			return 'rgba(255,67,62,1)';
		case 'lawn_green':
			return 'rgba(67,67,67,1)';
		case 'malachite':
			return 'rgba(57,172,135,1)';
		case 'mikado_yellow':
			return 'rgba(67,67,67,1)';
		case 'medium_turquoise':
			return 'rgba(67,67,67,1)';
		case 'light':
			return 'rgba(236,236,236,1)';
		default:
			return 'rgba(67,67,67,1)';
	}
}


VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_body_background_color');

function vp_bind_ozy_enjooy_body_background_color($preset)
{
	switch ($preset) {
		case 'blue':
			return '#333333';
		case 'crimson':
			return '#333333';
		case 'sunset_orange':
			return '#333333';
		case 'dark_orchid':
			return '#333333';
		case 'spring_green':
			return '#333333';
		case 'hot_pink':
			return '#333333';
		case 'hot_red':
			return '#333333';
		case 'lawn_green':
			return '#333333';
		case 'malachite':
			return '#333333';
		case 'mikado_yellow':
			return '#333333';
		case 'medium_turquoise':
			return '#333333';
		case 'light':
			return '#333333';
		default:
			return '#333333';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_form_font_color');

function vp_bind_ozy_enjooy_form_font_color($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(35,35,35,1)';
		case 'crimson':
			return 'rgba(35,35,35,1)';
		case 'sunset_orange':
			return 'rgba(35,35,35,1)';
		case 'dark_orchid':
			return 'rgba(35,35,35,1)';
		case 'spring_green':
			return 'rgba(35,35,35,1)';
		case 'hot_pink':
			return 'rgba(35,35,35,1)';
		case 'hot_red':
			return 'rgba(35,35,35,1)';
		case 'lawn_green':
			return 'rgba(35,35,35,1)';
		case 'malachite':
			return 'rgba(35,35,35,1)';
		case 'mikado_yellow':
			return 'rgba(35,35,35,1)';
		case 'medium_turquoise':
			return 'rgba(35,35,35,1)';
		case 'light':
			return 'rgba(35,35,35,1)';
		default:
			return 'rgba(35,35,35,1)';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_form_background_color');

function vp_bind_ozy_enjooy_form_background_color($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(255,255,255,1)';
		case 'crimson':
			return 'rgba(255,255,255,1)';
		case 'sunset_orange':
			return 'rgba(255,255,255,1)';
		case 'dark_orchid':
			return 'rgba(255,255,255,1)';
		case 'spring_green':
			return 'rgba(255,255,255,1)';
		case 'hot_pink':
			return 'rgba(255,255,255,1)';
		case 'hot_red':
			return 'rgba(255,255,255,1)';
		case 'lawn_green':
			return 'rgba(255,255,255,1)';
		case 'malachite':
			return 'rgba(255,255,255,1)';
		case 'mikado_yellow':
			return 'rgba(255,255,255,1)';
		case 'medium_turquoise':
			return 'rgba(255,255,255,1)';
		case 'light':
			return 'rgba(255,255,255,1)';
		default:
			return 'rgba(255,255,255,1)';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_form_button_font_color');

function vp_bind_ozy_enjooy_form_button_font_color($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(192,242,255,1)';
		case 'crimson':
			return 'rgba(255,255,255,1)';
		case 'sunset_orange':
			return 'rgba(255,199,182,1)';
		case 'dark_orchid':
			return 'rgba(215,154,246,1)';
		case 'spring_green':
			return 'rgba(180,255,192,1)';
		case 'hot_pink':
			return 'rgba(255,182,201,1)';
		case 'hot_red':
			return 'rgba(255,186,185,1)';
		case 'lawn_green':
			return 'rgba(197,255,207,1)';
		case 'malachite':
			return 'rgba(197,251,234,1)';
		case 'mikado_yellow':
			return 'rgba(255,243,197,1)';
		case 'medium_turquoise':
			return 'rgba(192,251,242,1)';
		case 'light':
			return 'rgba(195,255,242,1)';
		default:
			return 'rgba(255,255,255,1)';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_form_button_font_color_hover');

function vp_bind_ozy_enjooy_form_button_font_color_hover($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(255,255,255,1)';
		case 'crimson':
			return 'rgba(228,228,228,1)';
		case 'sunset_orange':
			return 'rgba(255,255,255,1)';
		case 'dark_orchid':
			return 'rgba(255,255,255,1)';
		case 'spring_green':
			return 'rgba(255,255,255,1)';
		case 'hot_pink':
			return 'rgba(255,255,255,1)';
		case 'hot_red':
			return 'rgba(255,255,255,1)';
		case 'lawn_green':
			return 'rgba(15,15,15,1)';
		case 'malachite':
			return 'rgba(255,255,255,1)';
		case 'mikado_yellow':
			return 'rgba(255,255,255,1)';
		case 'medium_turquoise':
			return 'rgba(255,255,255,1)';
		case 'light':
			return 'rgba(255,255,255,1)';
		default:
			return 'rgba(228,228,228,1)';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_form_button_background_color');

function vp_bind_ozy_enjooy_form_button_background_color($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(26,205,252,1)';
		case 'crimson':
			return 'rgba(15,15,15,1)';
		case 'sunset_orange':
			return 'rgba(246,75,22,1)';
		case 'dark_orchid':
			return 'rgba(171,67,224,1)';
		case 'spring_green':
			return 'rgba(83,215,105,1)';
		case 'hot_pink':
			return 'rgba(255,47,100,1)';
		case 'hot_red':
			return 'rgba(253,40,35,1)';
		case 'lawn_green':
			return 'rgba(12,194,42,1)';
		case 'malachite':
			return 'rgba(43,149,115,1)';
		case 'mikado_yellow':
			return 'rgba(246,201,24,1)';
		case 'medium_turquoise':
			return 'rgba(46,222,196,1)';
		case 'light':
			return 'rgba(82,235,202,1)';
		default:
			return 'rgba(15,15,15,1)';
	}
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_form_button_background_color_hover');

function vp_bind_ozy_enjooy_form_button_background_color_hover($preset)
{
	switch ($preset) {
		case 'blue':
			return 'rgba(85,220,255,1)';
		case 'crimson':
			return 'rgba(103,103,103,1)';
		case 'sunset_orange':
			return 'rgba(251,104,59,1)';
		case 'dark_orchid':
			return 'rgba(196,97,246,1)';
		case 'spring_green':
			return 'rgba(112,241,133,1)';
		case 'hot_pink':
			return 'rgba(255,90,132,1)';
		case 'hot_red':
			return 'rgba(251,73,69,1)';
		case 'lawn_green':
			return 'rgba(27,218,59,1)';
		case 'malachite':
			return 'rgba(48,195,148,1)';
		case 'mikado_yellow':
			return 'rgba(255,215,60,1)';
		case 'medium_turquoise':
			return 'rgba(54,241,213,1)';
		case 'light':
			return 'rgba(109,246,217,1)';
		default:
			return 'rgba(103,103,103,1)';
	}
}

VP_Security::instance()->whitelist_function('vp_get_font_weight_list');

function vp_get_font_weight_list()
{
	return array(array('value'=>'100', 'label' => '100'), array('value'=>'200', 'label' => '200'), array('value'=>'300', 'label' => '300'), array('value'=>'400', 'label' => '400'), array('value'=>'500', 'label' => '500'), array('value'=>'600', 'label' => '600'), array('value'=>'700', 'label' => '700'), array('value'=>'800', 'label' => '800'), array('value'=>'900', 'label' => '900'));
}

VP_Security::instance()->whitelist_function('vp_get_font_letter_spacing_list');

function vp_get_font_letter_spacing_list()
{
	return array(array('value'=>'normal', 'label' => 'normal'), array('value'=>'-5', 'label' => '-5'), array('value'=>'-4', 'label' => '-4'), array('value'=>'-3', 'label' => '-3'), array('value'=>'-2', 'label' => '-2'), array('value'=>'-1', 'label' => '-1'), array('value'=>'1', 'label' => '1'), array('value'=>'2', 'label' => '2'), array('value'=>'3', 'label' => '3'), array('value'=>'4', 'label' => '4'), array('value'=>'5', 'label' => '5'));
}


VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_sidebars');

function vp_bind_ozy_enjooy_sidebars() {
	$wp_posts = get_posts(array(
		'posts_per_page' => -1,
		'post_type' => 'ozy_sidebars'
	));

	$result = array();
	foreach ($wp_posts as $post)
	{
		$result[] = array('value' => $post->post_name, 'label' => $post->post_title);
	}
	return $result;
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_pages');

function vp_bind_ozy_enjooy_pages() {
	$wp_pages = get_pages(array(
		'post_type' => 'page',
		'post_status' => 'publish'	
	));

	$result = array();
	foreach ($wp_pages as $page)
	{
		$result[] = array('value' => $page->ID, 'label' => $page->post_title);
	}
	return $result;
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_portfolio_categories_simple');

function vp_bind_ozy_enjooy_portfolio_categories_simple() {

	$arr = get_terms( 'portfolio_category', array('hide_empty' => false ) );
	$result = array();
	foreach ($arr as $item)
	{
		if(isset($item->name) && $item->term_id) $result[] = array('value' => $item->term_id, 'label' => $item->name);
	}
	return $result;
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_portfolio_categories');

function vp_bind_ozy_enjooy_portfolio_categories() {

	$arr = get_terms( 'portfolio_category', array('hide_empty' => false ) );
	$result = array(array('value' => '-1', 'label' => __('All', 'vp_textdomain')));
	foreach ($arr as $item)
	{
		if(isset($item->name) && $item->term_id) $result[] = array('value' => $item->term_id, 'label' => $item->name);
	}
	return $result;
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_portfolio_categories_shortcode');

function vp_bind_ozy_enjooy_portfolio_categories_shortcode() {

	$arr = get_terms( 'portfolio_category', array('hide_empty' => false ) );
	$result = array(__('All', 'vp_textdomain') => '-1');
	foreach ($arr as $item)
	{
		if(isset($item->name) && $item->term_id) $result[$item->name] = $item->term_id;
	}
	return $result;
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_image_gallery_categories');

function vp_bind_ozy_enjooy_image_gallery_categories() {

	$arr = get_terms( 'image_gallery_category', array('hide_empty' => false ) );
	$result = array(array('value' => '-1', 'label' => __('All', 'vp_textdomain')));
	foreach ($arr as $item)
	{
		if(isset($item->name) && $item->term_id) $result[] = array('value' => $item->term_id, 'label' => $item->name);
	}
	return $result;
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_image_gallery_categories_raw');

function vp_bind_ozy_enjooy_image_gallery_categories_raw() {

	$arr = get_terms( 'image_gallery_category', array('hide_empty' => false ) );
	$result = array();
	foreach ($arr as $item)
	{
		if(isset($item->name) && $item->term_id) $result[] = array('value' => $item->term_id, 'label' => $item->name);
	}
	return $result;
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_video_gallery_categories');

function vp_bind_ozy_enjooy_video_gallery_categories() {

	$arr = get_terms( 'video_gallery_category', array('hide_empty' => false ) );
	$result = array(array('value' => '-1', 'label' => __('All', 'vp_textdomain')));
	foreach ($arr as $item)
	{
		if(isset($item->name) && $item->term_id) $result[] = array('value' => $item->term_id, 'label' => $item->name);
	}
	return $result;
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_blog_categories');

function vp_bind_ozy_enjooy_blog_categories() {

	$arr = get_terms( 'category', array('hide_empty' => false ) );
	$result = array(array('value' => '-1', 'label' => __('All', 'vp_textdomain')));
	foreach ($arr as $item)
	{
		$result[] = array('value' => $item->term_id, 'label' => $item->name);
	}
	return $result;
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_revolution_slider');

function vp_bind_ozy_enjooy_revolution_slider() {

	$result = array();
	
	if(is_plugin_active("revslider/revslider.php")) {
		
		$result[] = array('value' => '-1', 'label' => __('-Not in Use-', 'vp_textdomain'));
		
		global $wpdb, $table_prefix;
			
		$revsldr = $wpdb->get_results( "SELECT ID, title, alias FROM " . $table_prefix . "revslider_sliders ");
		$revsldr_alias = array();
		if ($revsldr) {
			foreach ( $revsldr as $revsldr_slide ) {
				$result[] = array('value' => $revsldr_slide->alias, 'label' => $revsldr_slide->title);
			}
		}
		
	} else {
		$result[] = array('value' => '-1', 'label' => __('-Revolution Slider is not activated-', 'vp_textdomain'));
	}

	return $result;
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_master_slider');

function vp_bind_ozy_enjooy_master_slider() {

	$result = array();
	
	if(is_plugin_active("masterslider/masterslider.php")) {
		
		$result[] = array('value' => '-1', 'label' => __('-Not in Use-', 'vp_textdomain'));
		
		global $wpdb, $table_prefix;
			
		$revsldr = $wpdb->get_results( "SELECT ID, title FROM " . $table_prefix . "masterslider_sliders ");
		$revsldr_alias = array();
		if ($revsldr) {
			foreach ( $revsldr as $revsldr_slide ) {
				$result[] = array('value' => $revsldr_slide->ID, 'label' => $revsldr_slide->title);
			}
		}
		
	} else {
		$result[] = array('value' => '-1', 'label' => __('-Master Slider is not activated-', 'vp_textdomain'));
	}

	return $result;
}

VP_Security::instance()->whitelist_function('vp_bind_ozy_enjooy_showbiz_slider');

function vp_bind_ozy_enjooy_showbiz_slider() {

	$result = array();
	
	if(is_plugin_active("showbiz/showbiz.php")) {
		
		$result[] = array('value' => '-1', 'label' => __('-Not in Use-', 'vp_textdomain'));
		
		global $wpdb, $table_prefix;
			
		$showbizsldr = $wpdb->get_results( "SELECT ID, title, alias FROM " . $table_prefix . "showbiz_sliders ");
		$showbizsldr_alias = array();
		if ($showbizsldr) {
			foreach ( $showbizsldr as $showbizsldr_slide ) {
				$result[] = array('value' => $showbizsldr_slide->alias, 'label' => $showbizsldr_slide->title);
			}
		}
		
	} else {
		$result[] = array('value' => '-1', 'label' => __('-Showbiz Slider is not activated-', 'vp_textdomain'));
	}

	return $result;
}

VP_Security::instance()->whitelist_function('vp_font_preview');

function vp_font_preview($face, $style, $weight, $size, $line_height)
{
	$gwf   = new VP_Site_GoogleWebFont();
	$gwf->add($face, $style, $weight);
	$links = $gwf->get_font_links();
	$link  = reset($links);
	$dom   = <<<EOD
<link href='$link' rel='stylesheet' type='text/css'>
<p style="padding: 0 10px 0 10px; font-family: $face; font-style: $style; font-weight: $weight; font-size: {$size}px; line-height: {$line_height}em;">
	Grumpy wizards make toxic brew for the evil Queen and Jack
</p>
EOD;
	return $dom;
}

VP_Security::instance()->whitelist_function('vp_font_preview_simple');

function vp_font_preview_simple($face, $style, $weight)
{
	$gwf   = new VP_Site_GoogleWebFont();
	$gwf->add($face, $style, $weight);
	$links = $gwf->get_font_links();
	$link  = reset($links);
	$dom   = <<<EOD
<link href='$link' rel='stylesheet' type='text/css'>
<p style="padding: 0 10px 0 10px; font-family: $face; font-style: $style; font-weight: $weight; font-size: 26px; line-height: 33px;">
	Grumpy wizards make toxic brew for the evil Queen and Jack
</p>
EOD;
	return $dom;
}