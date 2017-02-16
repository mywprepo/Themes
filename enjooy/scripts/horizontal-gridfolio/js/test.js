/*
wp_enqueue_script('FWDComboBox', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDComboBox.js', array('jquery'), null, true );
wp_enqueue_script('FWDComboBoxButton', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDComboBoxButton.js', array('jquery'), null, true );
wp_enqueue_script('FWDComboBoxSelector', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDComboBoxSelector.js', array('jquery'), null, true );
wp_enqueue_script('FWDComplexButton', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDComplexButton.js', array('jquery'), null, true );
wp_enqueue_script('FWDConsole', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDConsole.js', array('jquery'), null, true );
wp_enqueue_script('FWDContextMenu', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDContextMenu.js', array('jquery'), null, true );
wp_enqueue_script('FWDData', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDData.js', array('jquery'), null, true );
wp_enqueue_script('FWDDisplayObject', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDDisplayObject.js', array('jquery'), null, true );
wp_enqueue_script('FWDEventDispatcher', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDEventDispatcher.js', array('jquery'), null, true );
wp_enqueue_script('FWDFullScreenButton', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDFullScreenButton.js', array('jquery'), null, true );
wp_enqueue_script('FWDGrid', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDGrid.js', array('jquery'), null, true );
wp_enqueue_script('FWDInfo', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDInfo.js', array('jquery'), null, true );
wp_enqueue_script('FWDInfoWindow', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDInfoWindow.js', array('jquery'), null, true );
wp_enqueue_script('FWDIos6Timers', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDIos6Timers.js', array('jquery'), null, true );
wp_enqueue_script('FWDLightBox', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDLightBox.js', array('jquery'), null, true );
wp_enqueue_script('FWDModTweenMax', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDModTweenMax.js', array('jquery'), null, true );
wp_enqueue_script('FWDPreloader', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDPreloader.js', array('jquery'), null, true );
wp_enqueue_script('FWDSimpleButton', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDSimpleButton.js', array('jquery'), null, true );
wp_enqueue_script('FWDSimpleDisplayObject', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDSimpleDisplayObject.js', array('jquery'), null, true );
wp_enqueue_script('FWDSlideShowPreloader', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDSlideShowPreloader.js', array('jquery'), null, true );
wp_enqueue_script('FWDThumb', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDThumb.js', array('jquery'), null, true );
wp_enqueue_script('FWDThumbsManager', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDThumbsManager.js', array('jquery'), null, true );
wp_enqueue_script('FWDTimerManager', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDTimerManager.js', array('jquery'), null, true );
wp_enqueue_script('FWDUtils', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/FWDUtils.js', array('jquery'), null, true );
wp_enqueue_script('FWDTest', OZY_BASE_URL . 'scripts/horizontal-gridfolio/js/test.js', array('jquery'), null, true );
*/
FWDUtils.onReady(function() {
	var header,gridDiv,footer,wpadminbar,wpadminbarHeight;
	header = document.getElementById("header");
	gridDiv = document.getElementById((typeof ozyHorizontalGridFolioOptions.gridId != 'undefined' ? ozyHorizontalGridFolioOptions.gridId : "horizontalGridFolioContainer"));
	footer = document.getElementById("footer");
	wpadminbar = document.getElementById("wpadminbar");

	var gallery = new FWDGrid({		
		//main settings
		divHolderId: (typeof ozyHorizontalGridFolioOptions.gridId != 'undefined' ? ozyHorizontalGridFolioOptions.gridId : "horizontalGridFolioContainer"),
		gridPlayListAndSkinId:"playlist",
		removePlayListFromDOM:"yes",
		displayType:"afterParent",
		scrollBarType: ozyHorizontalGridFolioOptions.scrollBarType,//drag
		autoScale:"yes",
		width:940,
		height:650,
		thumbnailOverlayType:"text", //"icons",
		showContextMenu:"no",
		addMargins:"no", /*yes*/
		addMouseWheelSupport: ozyHorizontalGridFolioOptions.addMouseWheelSupport,//yes
		scrollBarOffset:0,
		backgroundColor:"#111111",
		scrollbarDisabledColor:"#000000",
		//thumbnails settings
		thumbnailBaseWidth:278,
		thumbnailBaseHeight:188,
		nrOfThumbsToShowOnSet: ozyHorizontalGridFolioOptions.nrOfThumbsToShowOnSet,
		horizontalSpaceBetweenThumbnails: parseInt(ozyHorizontalGridFolioOptions.SpaceBetweenThumbnails), /*4*/
		verticalSpaceBetweenThumbnails: parseInt(ozyHorizontalGridFolioOptions.SpaceBetweenThumbnails), /*4*/
		thumbnailBorderSize:0, /*4*/
		thumbnailBorderRadius:0,
		thumbnailOverlayOpacity:.85,
		thumbnailOverlayColor:"#000000",
		thumbnailBackgroundColor:"#333333",
		thumbnailBorderNormalColor:"#FFFFFF",
		thumbnailBorderSelectedColor:"#FFFFFF",
		//combobox settings
		startAtCategory:0,
		selectLabel: ozyHorizontalGridFolioOptions.selectLabel, //"All Categories",
		allCategoriesLabel: ozyHorizontalGridFolioOptions.selectLabel, //"All Categories",
		showAllCategories:"yes",
		comboBoxPosition:"topright",
		selctorBackgroundNormalColor:"#FFFFFF",
		selctorBackgroundSelectedColor:"#000000",
		selctorTextNormalColor:"#000000",
		selctorTextSelectedColor:"#FFFFFF",
		buttonBackgroundNormalColor:"#FFFFFF",
		buttonBackgroundSelectedColor:"#000000",
		buttonTextNormalColor:"#000000",
		buttonTextSelectedColor:"#FFFFFF",
		comboBoxShadowColor:"transparent",
		comboBoxHorizontalMargins:20,
		comboBoxVerticalMargins:20,
		comboBoxCornerRadius:0,
		//fullscreen button settings
		showFullScreenButton:"yes",
		fullScreenButtonPosition:"bottomright",
		fullScreenButtonHorizontalMargins:20,
		fullScreenButtonVerticalMargins:20,
		//ligtbox settings
		addLightBoxKeyboardSupport:"yes",
		showLightBoxNextAndPrevButtons:"yes",
		showLightBoxZoomButton:"yes",
		showLightBoxInfoButton:"yes",
		showLighBoxSlideShowButton:"yes",
		showLightBoxInfoWindowByDefault:(ozyGetOsVersion()>0 ? "no" : "yes"),
		slideShowAutoPlay:"no",
		lightBoxVideoAutoPlay:"yes",
		lighBoxBackgroundColor:"#000000",
		lightBoxInfoWindowBackgroundColor:"#FFFFFF",
		lightBoxItemBorderColor:"#FFFFFF",
		lightBoxItemBackgroundColor:"#222222",
		lightBoxMainBackgroundOpacity:.9, /*.8*/
		lightBoxInfoWindowBackgroundOpacity:.9, /*.9*/
		lightBoxBorderSize:0, /*4*/
		lightBoxBorderRadius:0, /*4*/
		lightBoxSlideShowDelay:4 /*4*/
	});
	
	if(typeof ozyHorizontalGridFolioOptions.gridType != 'undefined' 
	&& typeof ozyHorizontalGridFolioOptions.gridId != 'undefined'
	&& ozyHorizontalGridFolioOptions.gridType === 'component') {
		gridDiv.style.height = jQuery('#' + ozyHorizontalGridFolioOptions.gridId).parents('.wpb_row').css('min-height');
	}else{
		wpadminbarHeight = (wpadminbar!==null ? wpadminbar.offsetHeight : 0);
		
		//gridDiv.style.height = (document.documentElement.clientHeight - (header.offsetHeight + footer.offsetHeight + wpadminbarHeight)) + "px";
		gridDiv.style.height = (document.documentElement.clientHeight - (wpadminbarHeight)) + "px";
		function onResizeHandler()
		{
			//gridDiv.style.height = (document.documentElement.clientHeight - (header.offsetHeight + footer.offsetHeight + wpadminbarHeight)) + "px";
			gridDiv.style.height = (document.documentElement.clientHeight - (wpadminbarHeight)) + "px";
		}
		
		if (window.addEventListener) {
			window.addEventListener("resize", onResizeHandler);
		}
		else if (window.attachEvent) {
			window.attachEvent("onresize", onResizeHandler);
		}
		
	}
});