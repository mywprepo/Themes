jQuery(document).ready(function($) {	
	var icons = [], myIconPicker = jQuery('input.select_an_icon_field,input[name="ozy_enjooy_meta_post[ozy_enjooy_meta_post_thumbnail_color_group][0][ozy_enjooy_meta_post_thumbnail_icon]"]').fontIconPicker({iconsPerPage:2000});
	
	$('div[id*="ozy_enjooy_meta_post"]').css('overflow', 'inherit');
	
	jQuery.ajax({
		url:         ozyAdminParams.ozy_theme_path + 'font/ozy/config.json',
		dataType:    'JSON'
	}).done(function (r) {
		jQuery.each(r.glyphs, function (i,v) {
			icons.push(r.css_prefix_text + v.css);
		});
		myIconPicker.setIcons(icons);
	});	
	

	var ozy_current_target_icon_box = null;
	$(document).on('click', '.edit-menu-item-classes', function() {		
		ozy_current_target_icon_box = $(this);
		tb_show('Menu Options', '#TB_inline?height=815&max-height=815&width=640&inlineId=ozyIconSelectorWindow', false);
		$('#TB_ajaxContent').css('height', '90%');
	});

	$(document).on('click', '#ozy-form-iconselect-icons i', function() {
		if(ozy_current_target_icon_box != null) {
			ozy_current_target_icon_box.val($(this).attr('class').replace('icon ', ''));
			ozy_current_target_icon_box = null;
			tb_remove();
		}
	});


	/****************************/

	function fixHelpIFrame() {
		if(jQuery("#ozy-help-iframe").length > 0) {
			var helpFrame = jQuery("#ozy-help-iframe");
			var innerDoc = (helpFrame.get(0).contentDocument) 
			? helpFrame.get(0).contentDocument 
			: helpFrame.get(0).contentWindow.document;
			helpFrame.height(innerDoc.body.scrollHeight + 35);
		}
	}

	jQuery(function(){
		fixHelpIFrame();
	});
	
	jQuery(window).resize(function(){
		fixHelpIFrame();
	});
	
	/**
	* Custom Menu Styling
	*/
	var ozy_current_target_menu_style_box = null;
	$(document).on('click', '.edit-menu-item-edit-style', function() {		
		ozy_current_target_menu_style_box = $(this);
		
		//load settings
		var get_params = jQuery.parseJSON( ozy_current_target_menu_style_box.siblings('textarea').val() );
		
		//set loaded values
		if (get_params !== undefined && get_params !== null) {
			if(get_params.bg_color !== undefined) { $('#custom-menu-bg-color').val(get_params.bg_color).minicolors('destroy').minicolors({defaultValue:get_params.bg_color}); }
			if(get_params.fn_color !== undefined) { $('#custom-menu-fn-color').val(get_params.fn_color).minicolors('destroy').minicolors({defaultValue:get_params.fn_color}); }
			if(get_params.bg_image !== undefined) { $('#custom-menu-bg-image').val(get_params.bg_image);$('#custom-menu-bg-image-preview>img').attr('src', get_params.bg_image); }
			if(get_params.bg_repeat !== undefined) { $('#custom-menu-bg-repeat').val(get_params.bg_repeat); }
			if(get_params.bg_size !== undefined) { $('#custom-menu-bg-size').val(get_params.bg_size); }
			if(get_params.bg_pos_x !== undefined) { $('#custom-menu-bg-position-x').val(get_params.bg_pos_x); }
			if(get_params.bg_pos_y !== undefined) { $('#custom-menu-bg-position-y').val(get_params.bg_pos_y); }
			if(get_params.menu_dropdown_width !== undefined) { $('#custom-menu-dropdown-width').val(get_params.menu_dropdown_width); }
			if(get_params.menu_dropdown_padding_top !== undefined) { $('#custom-menu-dropdown-padding-top').val(get_params.menu_dropdown_padding_top); }
			if(get_params.menu_dropdown_padding_right !== undefined) { $('#custom-menu-dropdown-padding-right').val(get_params.menu_dropdown_padding_right); }
			if(get_params.menu_dropdown_padding_bottom !== undefined) { $('#custom-menu-dropdown-padding-bottom').val(get_params.menu_dropdown_padding_bottom); }
			if(get_params.menu_dropdown_padding_left !== undefined) { $('#custom-menu-dropdown-padding-left').val(get_params.menu_dropdown_padding_left); }
		}else{
			$('#custom-menu-bg-color,#custom-menu-fn-color').val('').minicolors('destroy').minicolors();			
			$('#custom-menu-bg-image').val('');$('#custom-menu-bg-repeat').val('no-repeat');$('#custom-menu-bg-size').val('auto');$('#custom-menu-bg-position-x').val('right');$('#custom-menu-bg-position-y').val('bottom');$('#custom-menu-dropdown-width').val('auto');$('#custom-menu-bg-image-preview>img').attr('src', '');
			$('#custom-menu-dropdown-padding-top').val('0px');$('#custom-menu-dropdown-padding-right').val('0px');$('#custom-menu-dropdown-padding-bottom').val('0px');$('#custom-menu-dropdown-padding-left').val('0px');			
		}
		
		tb_show('Mega Menu Style', '#TB_inline?height=815&max-height=815&width=640&inlineId=ozyMegaMenuStyleWindow', false);
		$('#TB_ajaxContent').css('height', '90%');
	});
	
	/*media window*/
    var custom_uploader;
 
    $(document).on('click', '.upload-image-button', function(e) {
		$this = $(this);
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
			$this.parent().find('input[type="text"]').val( attachment.url ).change();
			$this.parent().find('a>img').attr('src', attachment.url );
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });	
	/*end media window*/
	
	$(document).on('click', '#custom-menu-bg-apply', function(){
		if(ozy_current_target_menu_style_box != null) {
			var pass_params =  '{';
			pass_params += '"bg_color":"'+ $('#custom-menu-bg-color').val() +'",';
			pass_params += '"fn_color":"'+ $('#custom-menu-fn-color').val() +'",';
			pass_params += '"bg_image":"'+ $('#custom-menu-bg-image').val() +'",';
			pass_params += '"bg_repeat":"'+ $('#custom-menu-bg-repeat').val() +'",';
			pass_params += '"bg_size":"'+ $('#custom-menu-bg-size').val() +'",';
			pass_params += '"bg_pos_x":"'+ $('#custom-menu-bg-position-x').val() +'",';
			pass_params += '"bg_pos_y":"'+ $('#custom-menu-bg-position-y').val() +'",';
			pass_params += '"menu_dropdown_width":"'+ $('#custom-menu-dropdown-width').val() +'",';
			pass_params += '"menu_dropdown_padding_top":"'+ $('#custom-menu-dropdown-padding-top').val() + '",';
			pass_params += '"menu_dropdown_padding_right":"'+ $('#custom-menu-dropdown-padding-right').val() + '",';
			pass_params += '"menu_dropdown_padding_bottom":"'+ $('#custom-menu-dropdown-padding-bottom').val() + '",';
			pass_params += '"menu_dropdown_padding_left":"'+ $('#custom-menu-dropdown-padding-left').val() + '"';
			pass_params += '}';
			ozy_current_target_menu_style_box.siblings('textarea').val( pass_params );//.css('display','block');
			ozy_current_target_menu_style_box = null;
			tb_remove();
		}
	});
});

/* jQuery fontIconPicker - v1.0.0 - Made by Alessandro Benoit  - http://codeb.it/fontIconPicker - Under MIT License */
;(function(a){function d(b,c){this.element=a(b);this.settings=a.extend({},e,c);this.settings.emptyIcon&&this.settings.iconsPerPage--;this.iconPicker=a("<div/>",{"class":"icons-selector",style:"position: relative",html:'<div class="selector"><span class="selected-icon"><i class="fip-icon-block"></i></span><span class="selector-button"><i class="fip-icon-down-dir"></i></span></div><div class="selector-popup" style="display: none;">'+(this.settings.hasSearch?'<div class="selector-search"><input type="text" name="" value="" placeholder="Search icon" class="icons-search-input"/><i class="fip-icon-search"></i></div>': "")+'<div class="fip-icons-container"></div><div class="selector-footer" style="display:none;"><span class="selector-pages">1/2</span><span class="selector-arrows"><span class="selector-arrow-left" style="display:none;"><i class="fip-icon-left-dir"></i></span><span class="selector-arrow-right"><i class="fip-icon-right-dir"></i></span></span></div></div>'});this.iconContainer=this.iconPicker.find(".fip-icons-container");this.searchIcon=this.iconPicker.find(".selector-search i");this.iconsSearched= [];this.isSearch=!1;this.currentPage=this.totalPage=1;this.currentIcon=!1;this.iconsCount=0;this.open=!1;this.init()}var e={source:!1,emptyIcon:!0,iconsPerPage:20,hasSearch:!0};d.prototype={init:function(){this.element.hide();this.element.before(this.iconPicker);!this.settings.source&&this.element.is("select")&&(this.settings.source=[],this.element.find("option").each(a.proxy(function(b,c){a(c).val()&&this.settings.source.push(a(c).val())},this)));this.loadIcons();this.iconPicker.find(".selector-button").click(a.proxy(function(){this.toggleIconSelector()}, this));this.iconPicker.find(".selector-arrow-right").click(a.proxy(function(b){this.currentPage<this.totalPage&&(this.iconPicker.find(".selector-arrow-left").show(),this.currentPage+=1,this.renderIconContainer());this.currentPage===this.totalPage&&a(b.currentTarget).hide()},this));this.iconPicker.find(".selector-arrow-left").click(a.proxy(function(b){1<this.currentPage&&(this.iconPicker.find(".selector-arrow-right").show(),this.currentPage-=1,this.renderIconContainer());1===this.currentPage&&a(b.currentTarget).hide()}, this));this.iconPicker.find(".icons-search-input").keyup(a.proxy(function(b){var c=a(b.currentTarget).val();""===c?this.resetSearch():(this.searchIcon.removeClass("fip-icon-search"),this.searchIcon.addClass("fip-icon-cancel"),this.isSearch=!0,this.currentPage=1,this.iconsSearched=a.grep(this.settings.source,function(a){if(0<=a.search(c.toLowerCase()))return a}),this.renderIconContainer())},this));this.iconPicker.find(".selector-search").on("click",".fip-icon-cancel",a.proxy(function(){this.iconPicker.find(".icons-search-input").focus(); this.resetSearch()},this));this.iconContainer.on("click",".fip-box",a.proxy(function(b){this.setSelectedIcon(a(b.currentTarget).find("i").attr("class"));this.toggleIconSelector()},this));this.iconPicker.click(function(a){a.stopPropagation();return!1});a("html").click(a.proxy(function(){this.open&&this.toggleIconSelector()},this))},loadIcons:function(){this.iconContainer.html('<i class="fip-icon-spin3 animate-spin loading"></i>');this.settings.source instanceof Array&&this.renderIconContainer()},renderIconContainer:function(){var b, c=[],c=this.isSearch?this.iconsSearched:this.settings.source;this.iconsCount=c.length;this.totalPage=Math.ceil(this.iconsCount/this.settings.iconsPerPage);1<this.totalPage?this.iconPicker.find(".selector-footer").show():this.iconPicker.find(".selector-footer").hide();this.iconPicker.find(".selector-pages").text(this.currentPage+"/"+this.totalPage);b=(this.currentPage-1)*this.settings.iconsPerPage;if(this.settings.emptyIcon)this.iconContainer.html('<span class="fip-box"><i class="fip-icon-block"></i></span>'); else{if(1>c.length){this.iconContainer.html('<span class="icons-picker-error"><i class="fip-icon-block"></i></span>');return}this.iconContainer.html("")}c=c.slice(b,b+this.settings.iconsPerPage);b=0;for(var d;d=c[b++];)a("<span/>",{html:'<i class="'+d+'"></i>',"class":"fip-box"}).appendTo(this.iconContainer);this.settings.emptyIcon||this.element.val()&&-1!==a.inArray(this.element.val(),this.settings.source)?-1===a.inArray(this.element.val(),this.settings.source)?this.setSelectedIcon():this.setSelectedIcon(this.element.val()): this.setSelectedIcon(c[0])},setHighlightedIcon:function(){this.iconContainer.find(".current-icon").removeClass("current-icon");this.currentIcon&&this.iconContainer.find("."+this.currentIcon).parent("span").addClass("current-icon")},setSelectedIcon:function(a){"fip-icon-block"===a&&(a="");this.iconPicker.find(".selected-icon").html('<i class="'+(a||"fip-icon-block")+'"></i>');this.element.val(a).triggerHandler("change");this.currentIcon=a;this.setHighlightedIcon()},toggleIconSelector:function(){this.open= this.open?0:1;this.iconPicker.find(".selector-popup").slideToggle(300);this.iconPicker.find(".selector-button i").toggleClass("fip-icon-down-dir");this.iconPicker.find(".selector-button i").toggleClass("fip-icon-up-dir");this.open&&this.iconPicker.find(".icons-search-input").focus().select()},resetSearch:function(){this.iconPicker.find(".icons-search-input").val("");this.searchIcon.removeClass("fip-icon-cancel");this.searchIcon.addClass("fip-icon-search");this.iconPicker.find(".selector-arrow-left").hide(); this.currentPage=1;this.isSearch=!1;this.renderIconContainer();1<this.totalPage&&this.iconPicker.find(".selector-arrow-right").show()}};a.fn.fontIconPicker=function(b){this.each(function(){a.data(this,"fontIconPicker")||a.data(this,"fontIconPicker",new d(this,b))});this.setIcons=a.proxy(function(b){this.each(function(){a.data(this,"fontIconPicker").settings.source=b;a.data(this,"fontIconPicker").resetSearch();a.data(this,"fontIconPicker").loadIcons()})},this);return this}})(jQuery);