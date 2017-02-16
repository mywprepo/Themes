/*jslint browser: true*/
/*jslint white: true */
/*global $,jQuery,headerType,Parallax,alert,$WP_AJAX_URL,accordionSliderOptions,$WP_IS_HOME,$WP_HOME_URL,addthis*/

/* Enjooy WordPress Theme Main JS File */

/**
* Call Close Fancybox
*/
function close_fancybox(){
	"use strict";
	jQuery.fancybox.close();
}

/**
* Read cookie
*
* @key - Cookie key
*/
function getCookieValue(key) {
	"use strict";
    var currentcookie = document.cookie, firstidx, lastidx;
    if (currentcookie.length > 0)
    {
        firstidx = currentcookie.indexOf(key + "=");
        if (firstidx !== -1)
        {
            firstidx = firstidx + key.length + 1;
            lastidx = currentcookie.indexOf(";", firstidx);
            if (lastidx === -1)
            {
                lastidx = currentcookie.length;
            }
            return decodeURIComponent(currentcookie.substring(firstidx, lastidx));
        }
    }
    return "";
}

/**
* Cookie checker for like system
*
* @post_id - WordPress post ID
*/
function check_favorite_like_cookie(post_id) {
	"use strict";	
	var str = getCookieValue( "post_id" );
	if(str.indexOf("[" + post_id + "]") > -1) {
		return true;
	}
	
	return false;
}

/**
* Cokie writer for like system
*
* @post_id - WordPress post ID
*/
function write_favorite_like_cookie(post_id) {
	"use strict";	
	var now = new Date();
	now.setMonth( now.getYear() + 1 ); 
	post_id = "[" + post_id + "]," + getCookieValue("post_id");
	document.cookie="post_id=" + post_id + "; expires=" + now.toGMTString() + "; path=/; ";
}

/**
* Like buttons handler
*
* @post_id - WordPress post ID
* @p_post_type
* @p_vote_type
* @$obj
*/
function ajax_favorite_like(post_id, p_post_type, p_vote_type, $obj) {
	"use strict";	
	if( !check_favorite_like_cookie( post_id ) ) { //check, if there is no id in cookie
		jQuery.ajax({
			url: $WP_AJAX_URL,
			data: { action: 'ozy_ajax_like', vote_post_id: post_id, vote_post_type: p_post_type, vote_type: p_vote_type },
			cache: false,
			success: function(data) {
				//not integer returned, so error message
				if( parseInt(data,0) > 0 ){
					write_favorite_like_cookie(post_id);
					jQuery('span', $obj).text(data);
				} else {
					alert(data);
				}
			},
			error: function(MLHttpRequest, textStatus, errorThrown){  
				alert("MLHttpRequest: " + MLHttpRequest + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown); 
			}  
		});
	}
}

/**
* Popup window launcher
*
* @url - Url address for the popup window
* @title - Popup window title
* @w - Width of the window
* @h - Height of the window
*/
function ozyPopupWindow(url, title, w, h) {
	"use strict";
	var left = (screen.width/2)-(w/2), top = (screen.height/2)-(h/2);
	return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

/**
* To check iOS devices and versions
*/
function ozyGetOsVersion() {
	"use strict";
    var agent = window.navigator.userAgent.toLowerCase(),
        start = agent.indexOf( 'os ' );

    if ( /iphone|ipod|ipad/.test( agent ) && start > -1 ) {
        return window.Number( agent.substr( start + 3, 3 ).replace( '_', '.' ) );
    }
   
	return 0;
}

/**
* ozyReplaceAll
*
* To replace all matching string
*
* @findstr String - What to find
* @replacestr String - What to replace with found
* @str String - String will be searched
*/
function ozyReplaceAll(findstr, replacestr, str) { 
	"use strict";
	var re = new RegExp(findstr, 'g'); 
	str = str.replace(re, replacestr); 
	return str; 
}

/**
* ozy_full_row_fix
* 
* Set sections to document height which matches with selector
*/
function ozy_full_row_fix() {
	"use strict";
	jQuery('.ozy-custom-fullheight-row').each(function() {
		jQuery(this).css('min-height', jQuery(window).innerHeight() - ((jQuery(this).outerHeight() - jQuery(this).height())) + 'px' );
    });
}

/**
* ozy_floating_box_init
*
* Floating box compnent fix
*/
function ozy_floating_box_init() {
	"use strict";
	jQuery('.ozy-floating-box').each(function() {
		var h = jQuery(this).parents('.wpb_row').css('min-height') !== '0px'? jQuery(this).parents('.wpb_row').css('min-height') : jQuery(this).parents('.wpb_row').height()+'px';
        jQuery(this).css('height', h);
    });
}

function ozy_fix_row_video(){
	"use strict";
	if(parseInt(ozyGetOsVersion()) <= 0) {
		jQuery('.wpb_row>video').each( function() {
			var videoAspectRatio,viewportWidth,viewportHeight,viewportAspectRatio;
			videoAspectRatio = jQuery(this).outerWidth() / jQuery(this).outerHeight();
			viewportWidth = jQuery(this).parent('div.wpb_row').outerWidth();
			viewportHeight = jQuery(this).parent('div.wpb_row').outerHeight();
			viewportAspectRatio = viewportWidth / viewportHeight;
			if (viewportAspectRatio > videoAspectRatio) {
				// Very-wide viewport, so use the width
				jQuery(this).css({width: viewportWidth + 'px', height: 'auto'});
			}else {
				// Very-tall viewport, so use the height
				jQuery(this).css({width: 'auto', height: viewportHeight + 'px'});
			}			
		});
	}
}

function ozy_share_button() {
	"use strict";
	jQuery(document).on('click', '.post-submeta>div>div.button>a', function(e) {
		e.preventDefault();
		ozyPopupWindow(jQuery(this).attr('href'), 'Share', 640, 440);		
	});	
}

/**
* ozy_hash_scroll_fix
*
* Check if there is a hash and scrolls to there, onload
*/
function ozy_hash_scroll_fix() {
	"use strict";
	setTimeout(function(){
	if(window.location.hash) {
		var hash = window.location.hash;
		if(jQuery(hash).length && !jQuery(hash).hasClass('real3dflipbook')) {
			jQuery('html,body').animate({scrollTop: jQuery(hash).offset().top}, 1600, 'easeInOutExpo');
		}
	}}, 200);	
}
/* Resets windows scroll position if there is a hash to make it work smooth scroll*/
if (window.location.hash) {
	window.scrollTo(0, 0);
	setTimeout(function() {
		"use strict";
		window.scrollTo(0, 0);
	}, 1);
}

jQuery(window).resize(function() {
	"use strict";

	ozy_full_row_fix();
	ozy_floating_box_init();	
	ozy_fix_row_video();
});


jQuery(document).resize(function() {
	"use strict";
	if('classic' === headerType.menu_type) { // superfish
		jQuery('ul.sf-menu').supersubs({minWidth:8,maxWidth:16,extraWidth:1}).superfish({
			delay:       200,
			animation:   {height:'show'},
			speed:       125,
			autoArrows:  true
		});
	}
});

jQuery(document).ready(function($) {
	"use strict";

	var ozyClickDrag, ozyIosVersion;
	ozyIosVersion = parseInt(ozyGetOsVersion());	

	ozy_share_button();

	ozy_hash_scroll_fix();
	
	ozy_floating_box_init();

	/**
	* Primary navigation menu init
	*/
	if('classic' === headerType.menu_type) { // superfish
		jQuery('ul.sf-menu').supersubs({minWidth:8,maxWidth:16,extraWidth:1}).superfish({
			delay:       200,
			animation:   {height:'show'},
			speed:       125,
			autoArrows:  true
		});
	} else if('mega' === headerType.menu_type) { // dc mega menu
		jQuery('.mega-menu').dcMegaMenu({
			rowItems: '5',
			speed: 'fast',
			effect: 'fade',
		});
	}
	
	// Search Button & Stuff
	$(document).on('touchstart, click', '#ozy-close-search,.menu-item-search>a', function(e) {
		if($('#top-search').hasClass('open')){
			$('#top-search').animate({height:'0px', opacity:0}, 200, 'easeInOutExpo',function(){$('#top-search>form>input').focus();$('#top-search').removeClass('open');});
		}else{
			$('#top-search').animate({height:'50px', opacity:1}, 200, 'easeInOutExpo',function(){$('#top-search>form>input').focus();$('#top-search').addClass('open');});
		}
		e.preventDefault();
	});
	
	/* Sticky Menu, only works on desktop devices */
	if('classic' === headerType.menu_type || 'mega' === headerType.menu_type) {
		if(parseInt(ozyIosVersion)<=0) {
			var headerMenuFixed = false, textLogoSize = $('#header-logo h1').css('font-size'), textLogoLineHeight = $('#header-logo h1').css('line-height'), imgLogoSize = $('#header-logo img').height();	
			$(window).scroll(function() {
				if(parseInt(imgLogoSize)<=1) { imgLogoSize = $('#header-logo img').height(); }
				if($(this).scrollTop() >= 200) {
					if(!headerMenuFixed) {
						$('#main').css('margin-top', $('#header').height()+'px');
						$('#header-logo h1').css({'font-size':(textLogoSize*0.75)+'px','line-height':(textLogoLineHeight*0.75)+'px'});
						$('#header-logo img').css({height:(imgLogoSize*0.75)+'px'});
						$('#header').addClass('shadow').css({'position':'fixed','top':'-100%'}).animate({'top':'0','opacity':1}, 200, 'easeInOutExpo', function(){ headerMenuFixed = true; });				
					}
				} else {
					$('#main').css('margin-top', '0px');
					$('#header-logo h1').css({'font-size':textLogoSize+'px','line-height':textLogoLineHeight+'px'});
					$('#header-logo img').css({height:imgLogoSize+'px'});			
					$('#header').removeClass('shadow').css('position','relative');
					headerMenuFixed = false;
				}
			});	
		}
	}
	
	jQuery('#sidr-menu').sidr( { 
		side: 'right',
		name: 'sidr',
		speed: 400,
		onOpen: function() {
			if (jQuery().royalSlider) {
				$('#sidr .ozy-testimonials:not(.fixed)').each(function() {
					var slider = $(this).data('royalSlider');
					slider.updateSliderSize(true);
					$(this).addClass('fixed');
				});
			}
		}
	} );

	$(window).resize(function() {
		$.sidr('close', 'sidr'); // Close
    });
	
	$(document).on("click", function(e) {
		if(parseInt(ozyIosVersion) === 0 || 
		parseInt(ozyIosVersion) >= 7 ) {
			var sidr_div = $("#sidr");
			if (!sidr_div.is(e.target) && !sidr_div.has(e.target).length) {
				$.sidr('close', 'sidr'); // Close
			}
		}
	});
	
	/* on mobile devices */
	$(document).on("touchstart", function(e) {
		var sidr_div = $("#sidr");
		if (!sidr_div.is(e.target) && !sidr_div.has(e.target).length) {
			$.sidr('close', 'sidr'); // Close
		}		
	});

	/* this block help to sidr work as expected on iOS devices. */
    if (parseInt(ozyIosVersion) > 0) {
		jQuery('#sidr-menu').click(function(e){
			if($(this).data('opened') == '1') {
				if(parseInt(ozyIosVersion) < 7) { //ios 6 need special process, since header and footer position as fixed
					$('#header,#footer').css('left', '0px');
				}
				$.sidr('close', 'sidr'); // Close
				$(this).data('opened', '0');
			}else{
				if(parseInt(ozyIosVersion) < 7) { //ios 6 need special process, since header and footer position as fixed
					$('#header,#footer').css('left', '-260px');
				}
				$.sidr('open', 'sidr'); // Open
				$(this).data('opened', '1');
			}
			e.preventDefault();
		});
	}	
	
	/**
	* Sidr (side menu) 'Custom Menu' widget handler, turns it into an accordion menu
	*/
	$('#sidr .menu li a').click(function (e) {
		if($(this).parent('li').hasClass('menu-item-has-children')) {
			e.preventDefault();
		}
		var ullist = $(this).parent().children('ul:first');
		ullist.slideToggle();
	}).click();	
	
	function ozy_visual_stuff() {
		/* copies Email Address label of Mail Chimp form into Subscribe field as a placeholder */
		if($('#mc_signup_form').length>0) {
			$('#mc_mv_EMAIL').attr('placeholder', $('.mc_header_email').text() );
		}
	
		/* row scrolling effect */
		$('.wpb_row[data-bgscroll]').each(function() {
			var params = $(this).data('bgscroll').split(',');
			$(this).ozyBgScroller({direction:params[0], step:params[1]});
		});
	
		/* flipbox requires to parent has overflow hidden on chrome to work as expected */
		$('.flip-container').each(function() {
			$(this).parents('.wpb_row').css('overflow', 'hidden');
		});
	
		/* title with icon connected border color fix */
		var inline_style = '';
		$('.title-with-icon-wrapper.connected').each(function() {
			inline_style += '#' + $(this).attr('id') + ':before{border-color:'+ $(this).data('color') +';}';
		});
		if(inline_style) { $('head').append('<style>'+ inline_style +'</style>'); }
		
		if(ozyIosVersion <= 0) {
			$('.wpb_row.ozy-custom-row.parallax').each( function() { //,.wide-row-inner.parallax
				$(this).rParallax("center", 0.3, true);
			});
			/* bouncing arrow row bottom button */
			$('.row-botton-button').addClass('animation animated bounce');
		}else{
			$('.wpb_row.ozy-custom-row.parallax').each( function() {
				$(this).css('background-repeat','repeat');
			});
		}
		
		/* Blog Share Button*/
		$(document).on('click', '.post-submeta>a.post-share', function(e) {
			if($(this).data('open') !== '1') {
				$(this).data('open', '1').next('div').stop().animate({'margin-left': '0', opacity: 'show'}, 300, 'easeInOutExpo');
			}else{
				$(this).data('open', '0').next('div').stop().animate({'margin-left': '30px', opacity: 'hide'}, 300, 'easeInOutExpo');
			}
			e.preventDefault();
		});
		$(document).on("click", function(e) {
			var post_share_button = $(".post-submeta>a.post-share");
			if (!post_share_button.is(e.target) && !post_share_button.has(e.target).length) {
				post_share_button.data('open', '0').next('div').stop().animate({'margin-left': '30px', opacity: 'hide'}, 300, 'easeInOutExpo');
			}
		});
		
		/* Tooltip plugin init */	
		$(function(){
			$('.tooltip').tooltipsy();
		});
	
		/* Inline royal slider init */	
		if (jQuery().royalSlider) {
			$('.postGallerySlider').royalSlider({
				transitionSpeed: 800,
				slidesSpacing: 0,
				autoHeight: true,
				autoScaleSlider: false,
				arrowsNav: true,
				arrowsNavAutoHide: false,
				fadeinLoadedSlide: false,
				controlNavigationSpacing: 0,
				imageScaleMode: 'fill',
				imageAlignCenter: true,
				blockLoop: true,
				loop: false,
				numImagesToPreload: 2,
				keyboardNavEnabled: true,
				block: {
					delay: 400
				},
				autoPlay: {
					enabled: true,
					pauseOnHover: true,
					delay: 3300
				}
			});
		}
		
		/* Search page */
		if (jQuery().masonry) {
			if(('body.search-results').length) {
				$('body.search-results .post-content>div').imagesLoaded( function(){				
					$('body.search-results .post-content>div').masonry({
						itemSelector : 'article.result',
						gutter : 20
					});
				});
			}
		}
		
		/* Accordion Carousel */
		if(jQuery('#accordion-carousel').length>0) {
			jQuery('#accordion-carousel').imagesLoaded(function() {
				jQuery('#accordion-carousel').accordionSlider({
					width: ('undefined' !== typeof accordionSliderOptions ? (accordionSliderOptions.width !== '100%' ? accordionSliderOptions.width : '100%' ) : '100%'),
					height: ('undefined' !== typeof accordionSliderOptions ? (accordionSliderOptions.height === 'full' ? window.innerHeight : accordionSliderOptions.height) : window.innerHeight),
					responsiveMode: 'custom',
					openedPanelSize: 'max',
					maxOpenedPanelSize: '50%',
					visiblePanels: (parseInt(jQuery('#accordion-carousel').data('count')) < 5 ? jQuery('#accordion-carousel').data('count') : 5),
					closePanelsOnMouseOut: true,
					shadow: ('undefined' != typeof accordionSliderOptions ? (accordionSliderOptions.shadow == 1 ? true : false) : false),
					autoplay: ('undefined' != typeof accordionSliderOptions ? (accordionSliderOptions.autoplay == 1 ? true : false) : true),
					mouseWheel: true,
					panelOverlap: true,
					pageScrollEasing: 'easeOutQuint',
					openPanelDuration: 300,
					closePanelDuration: 300,
					pageScrollDuration: 600,
					breakpoints: {
						767: {
							height: '100%',
							maxOpenedPanelSize: '80%',
							visiblePanels: 4,
							orientation: 'vertical'},
						640: {
							height: '100%',
							maxOpenedPanelSize: '90%', 
							visiblePanels: 2, 
							orientation: 'vertical'
						}					
					}
				});
			});
		}
		if($('body.page-template-page-accordion-gallery-php #accordion-carousel').length>0 || 
		$('body.page-template-page-accordion-menu-php #accordion-carousel').length>0 ||
		$('.full-portfolio-accordion-slider').length>0) {
			jQuery(window).resize(function() {
				jQuery('#main>.container,.post-content,.page-template-page-accordion-menu-php .wpb_wrapper').height(window.innerHeight);
			});
		}else{		
			jQuery(window).resize(function() {
				jQuery('.wpb_wrapper>#accordion-carousel').each(function() {               
					var current_row_height = jQuery(this).parents('.wpb_row').innerHeight();
					jQuery(this).parent('.wpb_wrapper').height(current_row_height);
					jQuery('#accordion-carousel').accordionSlider({height: current_row_height});
				});
			});
		}
		jQuery(window).trigger('resize');
		
		/*google maps scroll fix*/
		$('.wpb_map_wraper').each(function() {
			$(this).append(
				$('<div class="gmaps-cover"></div>').click(function(){ $(this).remove(); })
			);
        });
	}
	
	ozy_visual_stuff();
	
	function ozy_vc_components() {
		/* Textilate */
		$('.ozy-tlt').each(function() {        
			$(this).textillate({
				minDisplayTime: $(this).data('display_time'), 
				selector: '.ozy-tlt-texts', 
				loop: true, 
				in: { 
					effect: $(this).data('in_effect'),
					sync: ($(this).data('in_effect_type') == 'sync' ? true:false), 
					shuffle: ($(this).data('in_effect_type') == 'shuffle' ? true:false), 
					'reverse': ($(this).data('in_effect_type') == 'reverse' ? true:false), 
					sequence: ($(this).data('in_effect_type') == 'sequence' ? true:false)
				},
				out: { 
					effect: $(this).data('out_effect'),
					sync: ($(this).data('out_effect_type') == 'sync' ? true:false), 
					shuffle: ($(this).data('out_effect_type') == 'shuffle' ? true:false), 
					'reverse': ($(this).data('out_effect_type') == 'reverse' ? true:false), 
					sequence: ($(this).data('out_effect_type') == 'sequence' ? true:false)
				} 			
			});
		});
		
		/* Mouse jParallax */
		$('.parallax-viewport').each(function() {
			if($(this).data('mouseport') === 'yes') {
				$(this).find('.parallax-layer').jparallax({'mouseport': $(this), 'xparallax': $(this).data('xparallax'), 'yparallax': $(this).data('yparallax')});
			}else{
				$(this).find('.parallax-layer').jparallax({'xparallax': $(this).data('xparallax'), 'yparallax': $(this).data('yparallax')});
			}
			$(this).siblings('.wpb_content_element').css({'position':'relative','z-index':1});
		});
		
		/* Mouse jParallax Extended */
		$('.parallax-viewport2').each(function() {
			var mouseport;
			mouseport = ($(this).data('mouseport') === 'yes' ? $(this) : $(document));
			$('.parallax-layer', this).each(function() {
				$(this).jparallax({
					'mouseport': mouseport, 
					'xparallax': $(this).data('xparallax'), 
					'yparallax': $(this).data('yparallax'), 
					'xorigin': $(this).data('xorigin'), 
					'yorigin': $(this).data('yorigin'), 
					'decay': $(this).data('decay'), 
					'frameduration': $(this).data('frameduration')
				});
			});
			$(this).siblings('.wpb_content_element').css({'position':'relative','z-index':1});
		});
		
		/* Zepto Parallax */	
		$('.parallax-viewport3').each(function() {
			$(this).parallax();
		});
		
		/* Icon Shadow */
		$('.title-with-icon-wrapper>div>span[data-color],.ozy-icon[data-color]').flatshadow({angle: "SE", fade: false, boxShadow: false });
		
		/* Morph Text */
		$('.ozy-morph-text').each(function() {
			$(this).find(".text-rotate").Morphext({
				animation: $(this).data('effect'),
				separator: $(this).data('separator'),
				speed: $(this).data('speed')
			});	
		});		
		
		/* Owl Carousel */
		$('.ozy-owlcarousel').each(function() {
			$(this).owlCarousel({
				lazyLoad : true,
				autoPlay: $(this).data('autoplay'),
				items : $(this).data('items'),
				singleItem : $(this).data('singleitem'),
				slideSpeed : $(this).data('slidespeed'),
				autoHeight : $(this).data('autoheight'),
				itemsDesktop : [1199,3],
				itemsDesktopSmall : [979,3]
			});	
		});
	
		/* Counter */
		if ('undefined' !== typeof jQuery.fn.waypoint) {
			jQuery('.ozy-counter>.timer').waypoint(function() {
				if(!$(this).hasClass('ran')) {
					$(this).addClass('ran').countTo({
						from: $(this).data('from'),
						to: $(this).data('to'),
						speed: 5000,
						refreshInterval: 25,
						sign: $(this).data('sign'),
						signpos: $(this).data('signpos')
					});
				}
			},{ 
				offset: '85%'
			});
		}

		/* Before / After */
		jQuery('.ozy-before_after').imagesLoaded(function() {
			if (jQuery().twentytwenty) { jQuery(".ozy-before_after").twentytwenty().css('visibility','visible').hide().fadeIn('slow'); }
		});
		
		/* Royal Slider */	
		if (jQuery().royalSlider) {
			
			$('.visibleNearby').royalSlider({
				slidesSpacing: 0, addActiveClass: true, arrowsNav: false,	controlNavigation: 'none', autoScaleSlider: false, loop: true, fadeinLoadedSlide: true, globalCaption: true, keyboardNavEnabled: true, globalCaptionInside: false,
				visibleNearby: {
					enabled: true, centerArea: 0.5,	center: true, breakpoint: 650, breakpointCenterArea: 0.64, navigateByCenterClick: true
				},
				autoPlay: {
					enabled: true, pauseOnHover: true, delay: 1300
				}
			}).data('royalSlider');	
			
			$('.ozy-testimonials').royalSlider({
				slidesSpacing: 0, autoScaleSlider:false, autoHeight: true, imageScaleMode: 'none', arrowsNav: false, fadeinLoadedSlide: false, controlNavigationSpacing: 0, controlNavigation: 'bullets', imageAlignCenter:false, loop: false, loopRewind: true, numImagesToPreload: 2, keyboardNavEnabled: false, usePreloader: false
				,autoPlay: {
					enabled: true, pauseOnHover: true, delay: 3300
				}
			});		
			
			$('.ozy-slider.auto-height-slider').royalSlider({
				slidesSpacing: 0, transitionSpeed: 800, autoHeight: true,	autoScaleSlider:false, arrowsNav: true, arrowsNavAutoHide: false, fadeinLoadedSlide: false,	controlNavigationSpacing: 0, controlNavigation: 'bullets', imageScaleMode: 'fill', imageAlignCenter:false, blockLoop: true, loop: false, numImagesToPreload: 2, keyboardNavEnabled: true,
				block: {
					delay: 400
				},
				autoPlay: {
					enabled: true, pauseOnHover: true, delay: 1300
				}
			});
			
			$('.ozy-slider.auto-height-slider-vertical').royalSlider({
				slidesSpacing: 0, arrowsNav: true, arrowsNavAutoHide: false, fadeinLoadedSlide: true, controlNavigation: 'none', imageScaleMode: 'fill', imageAlignCenter:true, loop: false, loopRewind: true, numImagesToPreload: 4, slidesOrientation: 'vertical', keyboardNavEnabled: true, 
				video: {
					autoHideArrows:true, autoHideControlNav:true
				},
				autoScaleSlider: true
			});		
			
			$('.ozy-slider.fixed-slider').royalSlider({
				slidesSpacing: 0, transitionSpeed: 800, autoHeight: false, autoScaleSlider:false, arrowsNav: true, arrowsNavAutoHide: false, fadeinLoadedSlide: false, controlNavigationSpacing: 0, controlNavigation: 'bullets', imageScaleMode: 'fill', imageAlignCenter:false, blockLoop: true, loop: false, numImagesToPreload: 2, keyboardNavEnabled: true, 
				block: {
					delay: 400
				},
				autoPlay: {
					enabled: true, pauseOnHover: true, delay: 1300
				}
			});		
		}		
	}
	
	ozy_vc_components();
	
	/* Check if section ID and menu target is match */
	$('.wpb_row').bind('inview', function (event, visible) {
		//console.log(event);
		var $elm = $('#side-nav-bar a[href*="#'+ jQuery(this).attr('id') +'"]:not([href="#"])').parent();
		if (visible == true) {
			$elm.addClass('current_page_item');
		}else{
			$elm.removeClass('current_page_item');
		}
	});
	
	/* Fix Element min-height */
	$('.ozy-custom-fullheight-row').each(function() {
		$(this).css('min-height', $(window).innerHeight() - (($(this).outerHeight() - $(this).height())) + 'px' );
    });

	function ozy_click_hash_check($this) {
		if (location.pathname.replace(/^\//,'') == $this.pathname.replace(/^\//,'') 
			|| location.hostname == $this.hostname) {
	
			var target = $($this.hash);
			target = target.length ? target : $('[name=' + $this.hash.slice(1) +']');
		   	if (target.length) {
				$('html,body').animate({
					 scrollTop: target.offset().top
				}, 1600, 'easeInOutExpo');
				return false;
			}
		}
	}
	
	/* Drag scroll to section whenever an anchor clicked with mathcing section ID */
	$('#content a.row-botton-button[href*="#"]:not([href="#"])').click(function(e) {
		e.preventDefault();
		ozy_click_hash_check(this);
	});	

	/* Menu Link */	
	$('#side-nav-bar a[href*="#"]:not([href="#"])').click(function(e) {
		e.preventDefault();
		if($WP_IS_HOME) {
			ozy_click_hash_check(this);
		}else{
			window.location = $WP_HOME_URL + $(this).attr('href');
		}
	});	
	
	/* Menu scrollbar init*/
	$("#side-nav-bar").perfectScrollbar({suppressScrollX:true});
	
	/* Menu accordion */
	$('#side-nav-bar .side-menu li>a').click(function(e) {
		var $this,$that;
		$this = $(this);
		$that = $('#side-nav-bar .side-menu>li.open.dropdown');
		if($this.parents('.side-menu>li.open.dropdown').length>0){$that = $('.emptier.div-class');}
		if($this.parent('li').hasClass('dropdown')) {			
			if(!$this.parent('li').hasClass('open')) {				
				if($that.length>0) {
					$that.find('.dropdown-menu').first().slideToggle(500, 'easeInOutExpo', function(){ 
						$that.toggleClass('open');
						$this.parent('li').find('.dropdown-menu').first().slideToggle(500, 'easeInOutExpo', function(){ 
							$this.parent('li').toggleClass('open');
							$("#side-nav-bar").perfectScrollbar('update'); 
						});			
					});
					$("#side-nav-bar").perfectScrollbar('update'); 
				}else{				
					$this.parent('li').find('.dropdown-menu').first().slideToggle(500, 'easeInOutExpo', function(){ 
						$this.parent('li').toggleClass('open');
						$("#side-nav-bar").perfectScrollbar('update'); 
					});
				}
			}
			e.preventDefault();
		}
    });	
	
	$('#side-nav-bar .side-menu ul li.current_page_item').parents('ul.dropdown-menu').slideToggle('fast', 'easeInOutExpo', function(){ $(this).parent('li').toggleClass('open');$("#side-nav-bar").perfectScrollbar('update'); });
	
	/* Side navigation menu */
	var SideNav = (function() {
		var tmr = 0, sideNav, navItems;
		function collapse() {
			clearTimeout(tmr);
			$('body').removeClass('nav-opened').addClass('nav-collapsed');
			tmr = setTimeout(function(){
				$('#side-nav-bar .side-menu li.open.dropdown').each(function(index, element) {
					$(this).removeClass('open').addClass('open-ex');$(this).find('.dropdown-menu').first().stop().slideToggle(500, 'easeInOutExpo');
				});
				/*close WPML language switcher if available and open*/
				$('#ozy-language-selector.open').stop().slideToggle(500, 'easeInOutExpo',function(){$(this).stop().toggleClass('open');});
				$('#side-nav-bar #cover').show();
			}, 200);
			$("#side-nav-bar").perfectScrollbar('update');
		}
	  
		function expand() {
			clearTimeout(tmr);
			$('body').removeClass('nav-collapsed').addClass('nav-opened');
			tmr = setTimeout(function(){
				$('#side-nav-bar .side-menu li.open-ex.dropdown').each(function() {
					$(this).removeClass('open-ex').addClass('open');$(this).find('.dropdown-menu').first().stop().slideToggle(500, 'easeInOutExpo');
				});
				$('#side-nav-bar #cover').hide();
			}, 200);
			$("#side-nav-bar").perfectScrollbar('update');
		}
		
		function init() {
			/*wait untill page has loaded*/
			$(function() { setTimeout(function(){ collapse();ozy_fix_row_video(); }, 1200); });
			sideNav.mouseenter(expand).mouseleave(collapse);
			navItems.on('mouseenter', expand);
		}		
		
		if($('body.page-template-page-accordion-menu-php').length <= 0 && $('body.page-template-page-masterslider-full-php').length <= 0) {
			sideNav = $('#side-nav-bar');
			navItems = $("li a", sideNav);
		
			init();
	
			$(document).on("touchstart", function(e) {
				if ($('body').hasClass('nav-opened') && !sideNav.is(e.target) && !sideNav.has(e.target).length) { collapse(); }
			});		
	
			sideNav.on("touchstart", function() {
				if ($('body').hasClass('nav-collapsed')) { expand(); }
			});
		}
			
	})();
	
	/* Waypoint animations */
	if ('undefined' !== typeof jQuery.fn.waypoint) {
	    jQuery('.ozy-waypoint-animate').waypoint(function() {
			jQuery(this).addClass('ozy-start-animation');
		},{ 
			offset: '85%'
		});
	}
	
	/* Blog post like function */
	$(document).on('click', '.blog-like-link', function(e) {
		ajax_favorite_like($(this).data('post_id'), 'like', 'blog', this);
		e.preventDefault();
    });
	
	/* Prevent fancybox launch on drag-drop event (accordion scroll) */
	ozyClickDrag = null;
	jQuery(".as-panel a.fancybox").mousedown(function(e) {
		$(this).addClass("hovered").data('lastClick', e.timeStamp);
		ozyClickDrag = $(this);
		ozyClickDrag.mousemove(function(e) {
			if ($(this).data('lastClick') + 100 < e.timeStamp) {
				$(this).removeClass("hovered");
			}
		});
	});

	/* FancyBox initialization */
	$('.woocommerce-page a.zoom').each(function() { $(this).attr('rel', 'product-gallery'); }); //WooCommerce Version 2.1.6 fancybox fix
	$(".wp-caption>p").click(  function(){ jQuery(this).prev('a').attr('title', jQuery(this).text()).click(); } ); //WordPress captioned image fix
	$(".fancybox, .wp-caption>a, .woocommerce-page .zoom").fancybox({
		beforeLoad: function() {
			if (ozyClickDrag!==null && !($(ozyClickDrag).hasClass("hovered") ) ) {
				$.fancybox.cancel();
				return;
			}
		},
		padding : 0,
		helpers		: {
			title	: { type : 'inside' },
			buttons	: {}
		}
	});
	$('.fancybox-media').fancybox({openEffect  : 'none',closeEffect : 'none',helpers : {title	: { type : 'inside' }, media : {}}});
	
	/* page-gallery-megafolio.php fancybox */	
	$(".fancybox-gallery-megafolio").each(function(){
		$(this)
			.attr('rel', 'gallery')
			.fancybox({
			title: '<h3 class="heading-font">' + this.title + '</h3>' + ($(this).data('description') !== 'undefined' ? '<p>' + $(this).data('description') + '</p>': ''),
			beforeShow: function () {
				if (this.title) {
					var title_clean = ozyReplaceAll('<h3 class="heading-font">', '', this.title), add_this_str;
					title_clean = ozyReplaceAll('</h3>', '', title_clean);
					title_clean = ozyReplaceAll('<p>', '\n', title_clean);
					title_clean = ozyReplaceAll('</p>', '', title_clean);
					add_this_str = '<div class="addthis_toolbox addthis_default_style" style="float:right;" addthis:url="'+ this.href +'" addthis:title="'+ title_clean +'">';
					add_this_str += '<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>';
					add_this_str += '<a class="addthis_button_tweet"></a>';
					add_this_str += '<a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal"></a>';
					add_this_str += '<a class="addthis_button_compact"></a>';
					add_this_str += '<a class="addthis_counter addthis_pill_style"></a>';
					add_this_str += '</div>';
					
					this.title = add_this_str + this.title;
				}
			},
			afterShow: function () {
				addthis.toolbox('.addthis_toolbox'); //render addthis buttons
			},
			padding : 0,
			helpers: {
				title: {
					type: 'inside'
				},
				buttons: {}
			}
		});
	});

	/* Back to top button */
	$(window).scroll(function() {
		if($(this).scrollTop() >= 100) {
			$('#to-top-button').stop().animate({bottom:'32px', opacity: 1}, 200, 'easeInOutExpo');
		} else {
			$('#to-top-button').stop().animate({bottom:'-32px', opacity: 0}, 200, 'easeInOutExpo');
		}
	});

	$('#to-top-button').click(function(e) {
		e.preventDefault();
		$('body,html').animate({scrollTop:0},800);
	});

	/* Menu WPML language switcher */
	jQuery('#ozy-language-selector-title').click(function(e) {
		e.preventDefault();
		jQuery('#ozy-language-selector').slideToggle(500, 'easeInOutExpo',function(){
			jQuery(this).toggleClass('open');
		});		
	});

});

/**
* http://decodize.com/css/site-preloading-methods/
*/
if(jQuery('#loaderMask').length>0){
jQuery(document).ready(function(h){if(!Array.prototype.indexOf){Array.prototype.indexOf=function(j){var i=this.length>>>0;var k=Number(arguments[1])||0;k=(k<0)?Math.ceil(k):Math.floor(k);if(k<0){k+=i}for(;k<i;k++){if(k in this&&this[k]===j){return k}}return -1}}var d=[],c=[],f=0,b=0;h("*").filter(function(){var j=h(this).css("background-image").replace(/url\(/g,"").replace(/\)/,"").replace(/"/g,"");var i=h(this).not("script").attr("src");if(j!=="none"&&!/linear-gradient/g.test(j)&&d.indexOf(j)===-1){d.push(j)}if(i!==undefined&&c.indexOf(i)===-1){c.push(i)}});var g=d.concat(c);h.each(g,function(j,k){h("<img />").attr("src",k).bind("load",function(){e()});h("<img />").attr("src",k).bind("error",function(){e()})});function e(){f++;b=Math.floor(f/g.length*100);h("#loaderMask").html("<span>"+b+'%</span><div style="width:'+b+'%"></div>');if(b===100){h("#loaderMask").html("<span>100%</span>");h("#loaderMask").fadeOut(function(){h("#frame").animate({opacity:1},300,"easeInOutExpo");/*h("#loaderMask").remove()*/})}}function a(i){h("#loaderMask").html("<span>100%</span>").delay(3000).fadeOut(1000,function(){h("#frame").animate({opacity:1},300,"easeInOutExpo");/*h("#loaderMask").remove()*/})}});
}