<?php
// Output option-based style
if( !function_exists( 'ozy_enjooy_style') ) :
	function ozy_enjooy_style() {
		global $ozyHelper, $ozy_data;
	
		// is page based styling enabled?
		$body_style = $content_background_color = $footer_background_color = $transparent_content_background = '';
		if(vp_metabox('ozy_enjooy_meta_page.ozy_enjooy_meta_page_use_custom_style') == '1') {
			$content_background_color 		= vp_metabox('ozy_enjooy_meta_page.ozy_enjooy_meta_page_layout_group.0.ozy_enjooy_meta_page_layout_ascend_background');
			$transparent_content_background = vp_metabox('ozy_enjooy_meta_page.ozy_enjooy_meta_page_layout_group.0.ozy_enjooy_meta_page_layout_transparent_background');
		}else{
			$content_background_color 		= ozy_get_option('content_background_color');
		}
		$footer_background_color 			= ozy_get_option('footer_background_color');
		
		if(vp_metabox('ozy_enjooy_meta_page.ozy_enjooy_meta_page_use_custom_background') == '1' && !is_search()) {
			$body_style = $ozyHelper->background_style_render(
				ozy_get_metabox('background_group.0.ozy_enjooy_meta_page_background_color'),
				ozy_get_metabox('background_group.0.ozy_enjooy_meta_page_background_image'),
				ozy_get_metabox('background_group.0.ozy_enjooy_meta_page_background_image_size'),
				ozy_get_metabox('background_group.0.ozy_enjooy_meta_page_background_image_repeat'),
				ozy_get_metabox('background_group.0.ozy_enjooy_meta_page_background_image_attachment')
			);
		}else{
			$body_style = $ozyHelper->background_style_render(
				ozy_get_option('body_background_color'), 
				ozy_get_option('body_background_image'), 
				ozy_get_option('body_background_image_size'), 
				ozy_get_option('body_background_image_repeat'), 
				ozy_get_option('body_background_image_attachment')
			);
		}
	
	?>
		<style type="text/css">
			@media only screen and (min-width: 1212px) {
				.container{padding:0;width:<?php echo $ozy_data->container_width; ?>px;}
				#content{width:<?php echo $ozy_data->content_width; ?>px;}
				#sidebar{width:<?php echo $ozy_data->sidebar_width; ?>px;}
			}
	
			/* Body Background Styling
			/*-----------------------------------------------------------------------------------*/
			body{<?php echo $body_style; ?>}
		
			/* Layout and Layout Styling
			/*-----------------------------------------------------------------------------------*/
			#main,.main-bg-color{background-color:<?php echo $content_background_color ?>;}
	
			#main.header-slider-active>.container,#main.footer-slider-active>.container{margin-top:0px;}
			#footer .container>div,#footer .container,#footer{height:<?php echo ozy_get_option('footer_height')?>px;min-height:<?php echo ozy_get_option('footer_height')?>px;}
			#footer,#footer>footer .container{background-color:<?php echo $footer_background_color ?>;line-height:<?php echo ozy_get_option('footer_height')?>px;}
			#revo-offset-container{height:<?php echo ((int)ozy_get_option('header_height')+(int)ozy_get_option('footer_height')) ?>px;}
			.ozy-header-slider{margin-top:<?php echo ozy_get_option('header_height')?>px;}
			
			#footer-widget-bar,#footer-widget-bar>.container{background-color:<?php echo ozy_get_option('footer_sidebar_background_color') ?>;}
			#footer-widget-bar .widget-area li, #footer-widget-bar .widget-area ul{border-color:<?php echo ozy_get_option('content_color_alternate2') ?>;}
			#footer-widget-bar>.container>section div,#footer-widget-bar>.container>section p, #footer-widget-bar>.container>section h4,#footer-widget-bar>.container>section,#footer *{color:<?php echo ozy_get_option('content_color_alternate2') ?>;}
			#footer-widget-bar>.container>section a,#footer-widget-bar>.container>section a>span>*,#footer a{color:<?php echo ozy_get_option('content_color_alternate3') ?>  !important;}
			#footer-widget-bar>.container>section a:hover,#footer-widget-bar>.container>section a:hover>span>*,#footer a:hover{color:<?php echo ozy_get_option('content_color_alternate') ?>  !important;}		
			
		<?php echo $transparent_content_background == '1' ? '	#main>.container{background-color:transparent !important;-webkit-box-shadow:none !important;-moz-box-shadow:none !important;box-shadow:none !important;}' . PHP_EOL : '' ?>
			@media only screen and (max-width: 479px) {
				#footer{height:<?php echo (int)ozy_get_option('footer_height')*2;?>px;}			
				/*#footer-spacer{height:<?php echo ozy_get_option('footer_height')*2;?>px;}*/
				#main>.container{margin-top:<?php echo ozy_get_option('header_height');?>px;}
			}
			@media only screen and (max-width: 1024px) and (min-width: 480px) {
				/*#footer-spacer{height:<?php echo ozy_get_option('footer_height');?>px;}*/
				#header #title{padding-right:<?php echo (int)(ozy_get_option('header_height')+20);?>px;}
				#header #title>a{line-height:<?php echo ozy_get_option('header_height');?>px;}
				#main>.container{margin-top:<?php echo ozy_get_option('header_height');?>px;}
				#footer{height:<?php echo ozy_get_option('footer_height');?>px;}
			}	
			
		<?php if(ozy_check_is_woocommerce_page()) { ?>
			/* WooCommerce
			/*-----------------------------------------------------------------------------------*/
			.ozy-product-overlay .button:hover{background-color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('primary_menu_background_color'))?> !important;color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('primary_menu_font_color_hover'))?> !important;border:1px solid <?php echo ozy_get_option('primary_menu_background_color')?> !important;}			
			.woocommerce div.product .woocommerce-tabs ul.tabs li.active,.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active,.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active{background-color:<?php echo ozy_get_option('content_color_alternate') ?> !important;border-color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('content_color_alternate')) ?> !important;border-color:<?php echo ozy_get_option('content_color_alternate') ?> !important;}
			.woocommerce div.product .woocommerce-tabs ul.tabs li,.woocommerce-page div.product .woocommerce-tabs ul.tabs li,.woocommerce #content div.product .woocommerce-tabs ul.tabs li,.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li{border-color:<?php echo ozy_get_option('primary_menu_separator_color') ?>;}
			.woocommerce div.product .woocommerce-tabs ul.tabs li a,.woocommerce-page div.product .woocommerce-tabs ul.tabs li a,.woocommerce #content div.product .woocommerce-tabs ul.tabs li a,.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a{color:<?php echo ozy_get_option('content_color');?> !important;}
			.woocommerce-pagination>ul>li>a,.woocommerce-pagination>ul>li>span{color:<?php echo ozy_get_option('content_color');?> !important;}
		<?php } ?>
		
			/* Primary Menu Styling
			/*-----------------------------------------------------------------------------------*/
<?php
			if('mega' === $ozy_data->menu_type || 'classic' === $ozy_data->menu_type) {
				$menu_logo_height = ozy_get_option('primary_menu_height', '60') . 'px';
			?>
			.sf-menu>li>a,#nav-primary,#nav-primary>nav>div>ul>li, #nav-primary>nav>div>ul>li>a,#nav-primary>nav>div>ul>li:before{line-height:<?php echo $menu_logo_height ?>;height:<?php echo $menu_logo_height ?>;}
			#sidr-menu{color:<?php echo ozy_get_option('primary_menu_font_color')?>;}
			#slide-menu,#slide-menu>a>span{line-height:<?php echo ozy_get_option('header_height') ?>px;height:<?php echo ozy_get_option('header_height') ?>px;width:<?php echo ozy_get_option('header_height') ?>px;}
			#slide-menu>a>span{color:<?php echo ozy_get_option('primary_menu_font_color_hover') ?>;}			
			.mega-menu .sub-container,#slide-menu,#header,#sidr{background-color:<?php echo ozy_get_option('primary_menu_background_color') ?>;}
			.sf-menu ul li:hover, .sf-menu ul li.sfHover, #header #slide-menu:hover{background-color:<?php echo ozy_get_option('primary_menu_background_color_hover') ?>;}
			.sf-menu .sf-mega, .sf-menu ul li, .sf-menu ul ul li, .sf-menu .sub-menu li:hover, .sf-menu .sub-menu li.sfHover, #header #slide-menu, .sf-menu .sub-menu .current-menu-parent{background-color:<?php echo ozy_get_option('primary_menu_background_color') ?>;}
			#nav-primary .sf-menu>li::after{background-color:<?php echo ozy_get_option('primary_menu_background_color') ?>;}
			#header-information-bar,.sf-menu a,.sf-menu>li:before, #sidr, #sidr li, #sidr li:before, #sidr a,#sidr input{<?php echo $ozyHelper->font_style_render(ozy_get_option('primary_menu_typography_font_face'), ozy_get_option('primary_menu_typography_font_weight'), ozy_get_option('primary_menu_typography_font_style'), ozy_get_option('primary_menu_typography_font_size') . 'px', ozy_get_option('primary_menu_typography_line_height') . 'em', ozy_get_option('primary_menu_font_color'));?>}
			
			#header-information-bar a,
			.sf-menu ul li:hover>a, 
			nav>div>ul>li.current-menu-item:before, 
			.sf-menu>li.current-menu-ancestor:before, 
			.sf-menu>li:hover:before,
			.sub-menu .current-menu-parent>a,
			#sidr a:hover{color:<?php echo ozy_get_option('primary_menu_font_color_hover') ?>;}
			
			.sf-arrows .sf-with-ul:after,.sf-arrows>li:hover>.sf-with-ul:after{border-top-color: <?php echo ozy_get_option('primary_menu_font_color') ?>;}
			.header-logo>h1>a{color:<?php echo ozy_get_option('primary_menu_logo_color')?> !important;}
			
			#header-information-bar{text-align:<?php echo ozy_get_option('primary_menu_infobar_align')?>;}
			<?php
				if(ozy_get_option('primary_menu_align') === 'right') {
					echo '#nav-primary>nav>div>ul{text-align:right;}';
				}else if(ozy_get_option('primary_menu_align') === 'left') {
					echo '#nav-primary>nav>div>ul{text-align:left;}';
					echo '#header-logo{right:36px;}';
				}if(ozy_get_option('primary_menu_align') === 'center') {
					echo '#nav-primary>nav>div>ul{text-align:center;float:none;}';
				}
			}

			if('side-menu' === $ozy_data->menu_type) {
			?>
			#side-nav-bar{background-color:<?php echo ozy_get_option('primary_menu_background_color') ?>;}
			#side-nav-bar .side-menu li a,#side-nav-bar>div a,#side-nav-bar h3,#side-nav-bar #side_menu_search>form>input[type=text]{color:<?php echo ozy_get_option('primary_menu_font_color') ?> !important;}
			#side-nav-bar .side-menu li:hover>a>span,#side-nav-bar .side-menu li:hover>a>.oic,#side-nav-bar .side-menu .dropdown-menu .current-menu-parent>a>span, #side-nav-bar .side-menu ul li.current_page_item>a,#side-nav-bar li.current-menu-item>a>span{color:<?php echo ozy_get_option('primary_menu_font_color_hover') ?>;}
			#side-nav-bar .oic,#side-nav-bar>div a,#side-nav-bar .side-menu li.dropdown>a:after{color:<?php echo ozy_get_option('primary_menu_icon_color') ?>;}
			#side-nav-bar h3,#side-nav-bar .side-menu>li>form,#side-nav-bar .side-menu li a,#side-nav-bar .side-menu>li:last-child>a,#side-nav-bar .side-menu>li.dropdown.open>a,#side-nav-bar ul li .dropdown-menu.depth_0{border-color:<?php echo ozy_get_option('primary_menu_separator_color_2') ?> !important;}
			#side-nav-bar .side-menu>li.active>a,
			#side-nav-bar .side-menu>li.current_page_item>a,
			#side-nav-bar .side-menu>li.current_page_parent>a,
			#side-nav-bar .side-menu>li>a:hover{background-color:<?php echo ozy_get_option('primary_menu_background_color_hover')?>;}
			#side-nav-bar .side-nav-bar-logo i,#side-nav-bar .side-nav-bar-logo h1>a{color:<?php echo ozy_get_option('primary_menu_logo_color')?> !important;}
			<?php
			} else if('mega' === $ozy_data->menu_type) {
			?>
			/*mega*/
			/*.mega-menu .sub-container,#slide-menu{background-color:<?php echo ozy_get_option('primary_menu_background_color') ?>;}*/
			#nav-primary>nav>div>ul h4{<?php echo $ozyHelper->font_style_render(ozy_get_option('typography_heading_font_face'), '', '', '', '', ''); ?>;}
			#nav-primary>nav>div>ul>li:before,.sub-menu li>h4{color:<?php echo ozy_get_option('primary_menu_font_color') ?>;}
			.mega-menu li>a{<?php echo $ozyHelper->font_style_render(ozy_get_option('primary_menu_typography_font_face'), 
			ozy_get_option('primary_menu_typography_font_weight'), 
			ozy_get_option('primary_menu_typography_font_style'), 
			ozy_get_option('primary_menu_typography_font_size') . 'px', 
			ozy_get_option('primary_menu_typography_line_height') . 'em', 
			ozy_get_option('primary_menu_font_color'));?>}
			.mega-menu li:hover>a,.mega-menu li:hover:before,.mega-menu li.current-menu-item>a,.mega-menu li.current-menu-item:before,.mega-menu li.current-menu-ancestor>a,.mega-menu li.current-menu-ancestor:before,#nav-primary>nav>div>ul ul>li.current_page_item>a{color:<?php echo ozy_get_option('primary_menu_font_color_hover')?> !important;}
			#nav-primary>nav>div>ul .row>li{border-color:<?php echo $ozyHelper->change_opacity(ozy_get_option('primary_menu_font_color'), '.25') ?>; }					
			<?php
			} else if('classic' === $ozy_data->menu_type) {
			?>
			/*classic*/
			.sf-menu ul li:hover, .sf-menu ul li.sfHover, #header #slide-menu:hover,#nav-primary>nav>div>ul ul>li.current_page_item>a{background-color:<?php echo ozy_get_option('primary_menu_background_color_hover') ?>;}
			.sf-menu .sf-mega, .sf-menu ul li, .sf-menu ul ul li, .sub-menu li:hover, .sub-menu li.sfHover, #header #slide-menu, .sub-menu .current-menu-parent{background-color:<?php echo ozy_get_option('primary_menu_background_color') ?>;}
			#nav-primary .sf-menu>li::after{background-color:<?php echo ozy_get_option('primary_menu_background_color') ?>;}
			.sf-menu a{<?php echo $ozyHelper->font_style_render(ozy_get_option('primary_menu_typography_font_face'), 
			ozy_get_option('primary_menu_typography_font_weight'), 
			ozy_get_option('primary_menu_typography_font_style'), 
			ozy_get_option('primary_menu_typography_font_size') . 'px', 
			ozy_get_option('primary_menu_typography_line_height') . 'em', 
			ozy_get_option('primary_menu_font_color'));?>}
			/*.sf-menu ul li>a, */
			.sf-menu>li:hover>a,.sf-menu ul li:hover>a,.current-menu-parent>a,.current-menu-ancestor>a,.current_page_item>a {color:<?php echo ozy_get_option('primary_menu_font_color_hover') ?>;}
			.sf-arrows .sf-with-ul:after,.sf-arrows>li:hover>.sf-with-ul:after{border-top-color: <?php echo ozy_get_option('primary_menu_font_color') ?>;}			
			<?php
			}
			?>

			/* ShowBiz
			/*-----------------------------------------------------------------------------------*/		
			.showbiz-title, .showbiz-title a, .showbiz-title a:visited, .showbiz-title a:hover{<?php echo $ozyHelper->font_style_render(ozy_get_option('typography_heading_font_face'), '', '', '', '', '', ' !important');?>}	
			.showbiz p{<?php echo $ozyHelper->font_style_render(ozy_get_option('typography_font_face'), 
			ozy_get_option('typography_font_weight'), 
			ozy_get_option('typography_font_style'), 
			ozy_get_option('typography_font_size') . 'px', 
			ozy_get_option('typography_font_line_height') . 'em', 
			'', ' !important');?>}
			
			/* Widgets
			/*-----------------------------------------------------------------------------------*/
			.widget li>a{color:<?php echo ozy_get_option('content_color'); ?> !important;}
			.widget li>a:hover{color:<?php echo ozy_get_option('content_color_alternate'); ?> !important;}
			.ozy-latest-posts>a>span{background-color:<?php echo $ozyHelper->hex2rgba(ozy_get_option('content_color_alternate'),'.8') ?>;color:<?php echo ozy_get_option('content_background_color') ?>;}
	
			<?php
			if(ozy_get_metabox('show_loader') == '1') {
			?>
			/* Loader
			/*-----------------------------------------------------------------------------------*/
			#loaderMask{text-align:center;padding-top:20%;font-weight:300 !important;}
			#loaderMask span{font-size: 5em;}
			#loaderMask>div{background:red;height:1px;background-color:<?php echo ozy_get_option('content_color_alternate'); ?> !important;}
			#frame{opacity: 0;-webkit-opacity:0;-moz-opacity:0;}
			<?php
			}
			?>
			
			/* Page Styling and Typography
			/*-----------------------------------------------------------------------------------*/
			.content-color-alternate{color:<?php echo ozy_get_option('content_color_alternate'); ?> !important;}
			.content-color{color:<?php echo ozy_get_option('content_color'); ?> !important;}
			.ozy-footer-slider,.ozy-header-slider,#content,#footer-widget-bar,#sidebar,#footer,input,select,textarea,.mediaDescriptionText,.hgFilterBox,.tooltipsy{<?php echo $ozyHelper->font_style_render(ozy_get_option('typography_font_face'), 
			ozy_get_option('typography_font_weight'), 
			ozy_get_option('typography_font_style'), 
			ozy_get_option('typography_font_size') . 'px', 
			ozy_get_option('typography_font_line_height') . 'em', 
			ozy_get_option('content_color'));?>}
			#content a:not(.ms-btn),#sidebar a,#footer a,.alternate-text-color,#footer-widget-bar>.container>.widget-area a:hover{color:<?php echo ozy_get_option('content_color_alternate');?>;}
			#footer #social-icons a,#ozy-share-div>a>span,.post-meta p>a,.a-page-title,.page-pagination>a{color:<?php echo ozy_get_option('content_color');?> !important;}
			.page-pagination>a.current{background-color:<?php echo ozy_get_option('primary_menu_separator_color') ?>;}
			.a-page-title:hover{border-color:<?php echo ozy_get_option('content_color');?> !important;}
			#header-logo h1,.nav-box a,#page-title-wrapper h1,#page-title-wrapper h3,#side-nav-bar a,#side-nav-bar h3,#content h1,#footer-widget-bar h1,#footer-widget-bar h2,#footer-widget-bar h3,#footer-widget-bar h4,#footer-widget-bar h5,#footer-widget-bar h6,#sidebar h1,#footer h1,#content h2,#sidebar h2,#footer h2,#content h3,#sidebar h3,#footer h3,#content h4,#sidebar h4,#footer h4,#content h5,#sidebar h5,#footer h5,#content h6,#sidebar h6,#footer h6,.heading-font,.mediaDescriptionHeader,#logo,#tagline,.ozy-ajax-shoping-cart,.page-template-page-accordion-menu-php *{<?php echo $ozyHelper->font_style_render(ozy_get_option('typography_heading_font_face'), '', '', '', '', ozy_get_option('content_color'));?>}
			#page-title-wrapper h1,#content h1,#footer-widget-bar h1,#sidebar h1,#footer h1,#header-logo h1{<?php echo $ozyHelper->font_style_render('', 
			ozy_get_option('typography_heading_font_weight_h1'), 
			ozy_get_option('typography_heading_font_style'), 
			ozy_get_option('typography_heading_h1_font_size') . 'px', 
			((int)ozy_get_option('typography_heading_h1_font_size') + 20) . 'px', '', '', 
			ozy_get_option('typography_heading_font_ls_h1')
			);?>}
			#footer-widget-bar .widget-area h4,#sidebar .widget>h4 {<?php echo $ozyHelper->font_style_render('', 
			ozy_get_option('typography_heading_font_weight_h4'), 
			ozy_get_option('typography_heading_font_style'), 
			ozy_get_option('typography_heading_h4_font_size') . 'px', 
			((int)ozy_get_option('typography_heading_h4_font_size') + 50) . 'px', '', '',
			ozy_get_option('typography_heading_font_ls_h4'));?>}
			#content h2,#footer-widget-bar h2,#sidebar h2,#footer h2{<?php echo $ozyHelper->font_style_render('', 
			ozy_get_option('typography_heading_font_weight_h2'), 
			ozy_get_option('typography_heading_font_style'), 
			ozy_get_option('typography_heading_h2_font_size') . 'px', 
			((int)ozy_get_option('typography_heading_h2_font_size') + 10) . 'px', '', '',
			ozy_get_option('typography_heading_font_ls_h2'));?>;}		
			#page-title-wrapper h3,#content h3,#footer-widget-bar h3,#sidebar h3,#footer h3{<?php echo $ozyHelper->font_style_render('', 
			ozy_get_option('typography_heading_font_weight_h3'), 
			ozy_get_option('typography_heading_font_style'), 
			ozy_get_option('typography_heading_h3_font_size') . 'px', 
			((int)ozy_get_option('typography_heading_h3_font_size') + 10) . 'px', '', '',
			ozy_get_option('typography_heading_font_ls_h3'));?>;}		
			#content h4,#footer-widget-bar h4,#sidebar h4,#footer h4{<?php echo $ozyHelper->font_style_render('', 
			ozy_get_option('typography_heading_font_weight_h4'), 
			ozy_get_option('typography_heading_font_style'), 
			ozy_get_option('typography_heading_h4_font_size') . 'px', 
			((int)ozy_get_option('typography_heading_h4_font_size') + 10) . 'px', '', '',
			ozy_get_option('typography_heading_font_ls_h4'));?>;}		
			#content h5,#footer-widget-bar h5,#sidebar h5,#footer h5{<?php echo $ozyHelper->font_style_render('', 
			ozy_get_option('typography_heading_font_weight_h5'), 
			ozy_get_option('typography_heading_font_style'), 
			ozy_get_option('typography_heading_h5_font_size') . 'px', 
			((int)ozy_get_option('typography_heading_h5_font_size') + 10) . 'px', '', '',
			ozy_get_option('typography_heading_font_ls_h5'));?>;}		
			#content h6,#footer-widget-bar h6,#sidebar h6,#footer h6{<?php echo $ozyHelper->font_style_render('', 
			ozy_get_option('typography_heading_font_weight_h6'), 
			ozy_get_option('typography_heading_font_style'), 
			ozy_get_option('typography_heading_h6_font_size') . 'px', 
			((int)ozy_get_option('typography_heading_h6_font_size') + 10) . 'px', '', '',
			ozy_get_option('typography_heading_font_ls_h6'));?>;}
			#footer-widget-bar .widget a:hover,#sidebar .widget a:hover{color:<?php echo ozy_get_option('content_color');?>;}
			
			/* Forms
			/*-----------------------------------------------------------------------------------*/
			input:not([type=submit]):not([type=file]),textarea{background-color:<?php echo ozy_get_option('form_background_color')?>;}
			input:not([type=submit]):not([type=file]):hover,textarea:hover,
			input:not([type=submit]):not([type=file]):focus,textarea:focus{border-color:<?php echo ozy_get_option('content_color_alternate')?>;}
			.rsMinW .rsBullet span{background-color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('form_font_color'))?>;}
			.woocommerce-page .button,.showbiz-button,.rsMinW .rsArrowIcn,#to-top-button,.load_more_blog,input[type=button],input[type=submit],button[type=submit],.comment-body .reply>a,.tagcloud>a{color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('form_button_font_color'))?> !important;background-color:<?php echo ozy_get_option('form_button_background_color')?> !important;border:1px solid <?php echo ozy_get_option('form_button_background_color')?>;}
			.woocommerce-page .button:hover,.showbiz-button:hover,.rsMinW .rsArrowIcn:hover,#to-top-button:hover,.load_more_blog:hover,input[type=button]:hover,input[type=submit]:hover,button[type=submit]:hover,.comment-body .reply>a:hover,.tagcloud>a:hover{background-color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('form_button_background_color_hover'))?> !important;color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('form_button_font_color_hover'))?> !important;border:1px solid <?php echo ozy_get_option('form_button_background_color_hover')?>;}
			
			/* Blog Comments & Blog Stuff
			/*-----------------------------------------------------------------------------------*/
			.comment-body,#ozy-share-div>a{background-color:<?php echo ozy_get_option('content_background_color_alternate') ?>;}
			.post-submeta>div>div.button{background-color:<?php echo ozy_get_option('content_color') ?>;}
			.post-submeta>div>div.arrow{border-color: transparent <?php echo ozy_get_option('content_color') ?> transparent transparent;}
			.mega-entry-innerwrap .post-format,.post-title>span,.post-submeta>a>span,.simple-post-format>div>span{background-color:<?php echo ozy_get_option('content_color_alternate') ?> !important;}
			.featured-thumbnail>a,.ozy-related-posts .related-post-item>a{background-color:<?php echo $ozyHelper->hex2rgba(ozy_get_option('content_color_alternate'),'.8') ?>;}
			.post-submeta>div>div.button>a>span{color:<?php echo ozy_get_option('content_background_color_alternate') ?>;}
			.post-meta p.g{color:<?php echo ozy_get_option('content_color_alternate2')?>;}	
			.post-submeta>a.content-color:hover{background-color:<?php echo ozy_get_option('content_color_alternate2')?>;}
			
			#single-blog-tags>a,.ozy-related-posts .caption,.ozy-related-posts .caption>h4>a{color:<?php echo ozy_get_option('content_background_color') ?> !important;background-color:<?php echo ozy_get_option('content_color') ?>;}
			#single-blog-tags>a:hover{color:<?php echo ozy_get_option('content_background_color') ?>;background-color:<?php echo ozy_get_option('content_color_alternate') ?>;}
	
			/*post formats*/
			.simple-post-format.post-excerpt-aside>div{background-color:<?php echo $ozyHelper->hex2rgba(ozy_get_option('content_color'),'.8')?>;}
			.simple-post-format>div{background-color:<?php echo ozy_get_option('content_color')?>;}
			.simple-post-format>div>span,.simple-post-format>div>h2,.simple-post-format>div>p,.simple-post-format>div>p>a,.simple-post-format>div>blockquote,.post-excerpt-audio>div>div{color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('content_background_color'))?> !important;}
			
			/* Shortcodes
			/*-----------------------------------------------------------------------------------*/
			.ozy-accordion>h6.ui-accordion-header>span,.ozy-tabs .ozy-nav .ui-tabs-selected a,.ozy-tabs .ozy-nav .ui-tabs-active a,.ozy-toggle span.ui-icon{background-color:<?php echo ozy_get_option('content_color_alternate') ?>;}
			.ozy-tabs .ozy-nav .ui-tabs-selected a,.ozy-tabs .ozy-nav .ui-tabs-active a{border-color:<?php echo ozy_get_option('content_color_alternate') ?> !important;}	
			.ozy-tabs .ozy-nav li a{color:<?php echo ozy_get_option('content_color');?> !important;}		
			
			/*owl carousel*/
			.ozy-owlcarousel .item.item-extended>a .overlay-one *,.ozy-owlcarousel .item.item-extended>a .overlay-two *{color:<?php echo ozy_get_option('content_color_alternate3') ?> !important;}
			.ozy-owlcarousel .item.item-extended>a .overlay-one-bg{background-color:<?php echo ozy_get_option('content_color_alternate') ?>;background-color:<?php echo $ozyHelper->hex2rgba(ozy_get_option('content_color_alternate'),.50) ?>;}
			.ozy-owlcarousel .item.item-extended>a .overlay-two{background-color:<?php echo ozy_get_option('content_color_alternate') ?>;background-color:<?php echo $ozyHelper->hex2rgba(ozy_get_option('content_color_alternate'),.85) ?>;}
			.owl-theme .owl-controls .owl-page.active span{background-color:<?php echo ozy_get_option('content_color_alternate') ?>;}
			
			.ozy-button.auto,.wpb_button.wpb_ozy_auto{background-color:<?php echo ozy_get_option('form_button_background_color') ?>;color:<?php echo ozy_get_option('form_button_font_color')?>; }
			.ozy-button.auto:hover,.wpb_button.wpb_ozy_auto:hover{border-color:<?php echo ozy_get_option('form_button_background_color_hover') ?>;color:<?php echo ozy_get_option('form_button_font_color_hover') ?> !important;background-color:<?php echo ozy_get_option('form_button_background_color_hover')?>; }		
			
			.dropcap-square,.dropcap-circle,.ozy-icon.square,.ozy-icon.circle{background-color:<?php echo ozy_get_option('content_color') ?>;}
			.dropcap-clean,.dropcap-circle2,.ozy-icon.circle2{color:<?php echo ozy_get_option('content_color') ?>;border-color:<?php echo ozy_get_option('content_color') ?>;}
			a:hover>.ozy-icon.square,a:hover>.ozy-icon.circle{background-color:transparent !important;color:<?php echo ozy_get_option('content_color') ?>;}
			a:hover>.ozy-icon.circle2{color:<?php echo ozy_get_option('content_color') ?>;border-color:transparent !important;}
	
			.wpb_content_element .wpb_tabs_nav li.ui-tabs-active{background-color:<?php echo ozy_get_option('content_color_alternate') ?> !important;border-color:<?php echo ozy_get_option('content_color_alternate') ?> !important;}
			.wpb_content_element .wpb_tabs_nav li,.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header{border-color:<?php echo ozy_get_option('primary_menu_separator_color') ?> !important;}
			.wpb_content_element .wpb_tabs_nav li.ui-tabs-active>a{color:<?php echo ozy_get_option('content_background_color');?> !important;}
			.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a,.wpb_content_element .wpb_accordion_header a{color:<?php echo ozy_get_option('content_color');?> !important;}
			.wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header{font-size:<?php echo ozy_get_option('typography_font_size') ?>px !important;line-height:<?php echo ozy_get_option('typography_font_line_height') ?>em !important}
			
			.pricing-table .pricing-table-column+.pricetable-featured .pricing-price{color:<?php echo ozy_get_option('content_color_alternate')?> !important;}
			.pricing-table li,.pricing-table .pricing-table-column:first-child, .pricing-table .pricing-table-column{border-color:<?php echo ozy_get_option('primary_menu_separator_color') ?> !important;}
			.pricing-table .pricing-table-column+.pricetable-featured, .pricing-table .pricing-table-column.pricetable-featured:first-child{ border:4px solid <?php echo ozy_get_option('content_color_alternate') ?> !important; }
			
			/* Shared Border Color
			/*-----------------------------------------------------------------------------------*/
			#ozy-share-div.ozy-share-div-blog,.portfolio-details-part-two,.page-content table td,#content table tr,.post-content table td,.ozy-toggle .ozy-toggle-title,.ozy-toggle-inner,.ozy-tabs .ozy-nav li a,.ozy-accordion>h6.ui-accordion-header,.ozy-accordion>div.ui-accordion-content,input:not([type=submit]):not([type=file]),textarea,.chat-row .chat-text,#sidebar .widget li,.ozy-content-divider,#post-author,.single-post .post-submeta,.widget ul ul,blockquote,.page-pagination>a,.woocommerce-pagination>ul>li>*,select,body.search article.result,div.rssSummary,#sidr input{border-color:<?php echo ozy_get_option('primary_menu_separator_color') ?>;}
		
			/* Specific heading styling
			/*-----------------------------------------------------------------------------------*/	
		<?php
		
			if(!is_search()) {
				$post_id = ozy_get_woocommerce_page_id();		
				if($post_id > 0) {
					echo '.woocommerce-page article .page-title{display:none !important}';
				}			
				if(ozy_get_metabox('use_custom_title', 0, $post_id) == '1') {
					$h_height 	= ozy_get_metabox('use_custom_title_group.0.ozy_enjooy_meta_page_custom_title_height', '240', $post_id);
					$h_bgcolor 	= ozy_get_metabox('use_custom_title_group.0.ozy_enjooy_meta_page_custom_title_bgcolor', '', $post_id);
					$h_bgimage 	= ozy_get_metabox('use_custom_title_group.0.ozy_enjooy_meta_page_custom_title_bg', '', $post_id);
					$h_bg_xpos	= ozy_get_metabox('use_custom_title_group.0.ozy_enjooy_meta_page_custom_title_bg_x_position', '', $post_id);
					$h_bg_ypos	= ozy_get_metabox('use_custom_title_group.0.ozy_enjooy_meta_page_custom_title_bg_y_position', '', $post_id);
					
					$h_css = (int)$h_height > 0 ? 'height:'. $h_height .'px;' : '';
					$h_css.= (int)$h_height > 0 ? $ozyHelper->background_style_render($h_bgcolor, $h_bgimage, 'cover', 'repeat', 'inherit', true, $h_bg_xpos, $h_bg_ypos) : '';
					echo '#page-title-wrapper{'. $h_css .'}';
					
					$h_title_color = ozy_get_metabox('use_custom_title_group.0.ozy_enjooy_meta_page_custom_title_color', 0, $post_id);
					if($h_title_color) {
						echo '#page-title-wrapper>div>h1{color:'. $h_title_color .';}';
					}
					$h_sub_title_color = ozy_get_metabox('use_custom_title_group.0.ozy_enjooy_meta_page_custom_sub_title_color', 0, $post_id);
					if($h_sub_title_color) {
						echo '#page-title-wrapper>div>h3{color:'. $h_sub_title_color .';}';
					}
					
					$h_title_position = ozy_get_metabox('use_custom_title_group.0.ozy_enjooy_meta_page_custom_title_position', 0, $post_id);
					if($h_title_position) {
						echo '#page-title-wrapper>div>h1,#page-title-wrapper>div>h3{text-align:'. $h_title_position .';}';
					}
				}else{
					echo '#page-title-wrapper{height:100px}';
				}
			}else{
				echo '#page-title-wrapper{height:100px}';
			}
		?>		
			
			/* Conditional Page Template Styles
			/*-----------------------------------------------------------------------------------*/
			<?php
			if(is_page_template('page-metro-blog.php') || 
			is_page_template('page-megafolio.php') || 
			is_page_template('page-real3d.php') ||
			is_page_template('page-accordion-gallery.php') || 
			is_page_template('page-accordion-menu.php') || 
			is_page_template('page-classic-gallery.php') || 
			is_page_template('page-gallery-megafolio.php') || 
			is_page_template('page-horizontal-gallery.php') || 
			is_page_template('page-megafolio-gallery.php') || 
			is_page_template('page-thumbnail-gallery.php') || 
			is_page_template('page-nearby-gallery.php') || 
			is_page_template('page-portfolio.php') || 
			is_page_template('page-portfolio-megafolio.php') || 
			is_page_template('page-revo-full.php')) {
			?>
			#main>.container.no-vc,#content,#content.no-vc{max-width:100% !important;width:100% !important;padding-left:0 !important;padding-right:0 !important;padding-top:0 !important;padding-bottom:0 !important;}
			.page-template-page-accordion-menu-php .vc_col-sm-12.wpb_column.vc_column_container{padding-left:0 !important;padding-right:0 !important;}
			.page-template-page-accordion-menu-php .wpb_row.vc_row-fluid{width:100% !important;}
			<?php
			}
			$ozyHelper->render_custom_fonts();
			?>		
		</style>
		<?php
		$ozyHelper->render_google_fonts();
	}
	
	add_action( 'wp_head', 'ozy_enjooy_style', 99 );
endif;
?>