		<?php 
		if(!$ozy_data->hide_everything_but_content) { 
		
			if($ozy_data->menu_type === 'side-menu'):
		?>
            <div id="side-nav-bar">
                <?php if($ozy_data->device_type != 'computer') { echo '<div id="cover"></div>'; } ?>
                <div class="side-nav-bar-logo">
                    <?php
                        $custom_logo_collapsed = '<i class="oic oic-list-1"></i>';
                        if(ozy_get_option('use_custom_logo') == '1') {
                            echo '<span><img src="'. ozy_get_option('custom_logo') .'" '. (ozy_get_option('custom_logo_retina') ? 'data-at2x="'. ozy_get_option('custom_logo_retina') .'"' : '') .' alt="logo"/></span>'; //place holder to keep image ratio
                            echo '<a href="'. get_home_url() .'" id="logo"><img src="'. ozy_get_option('custom_logo') .'" '. (ozy_get_option('custom_logo_retina') ? 'data-at2x="'. ozy_get_option('custom_logo_retina') .'"' : '') .' alt="logo"/></a>';
                            
                            if(ozy_get_option('custom_logo_collapsed')){
                                $custom_logo_collapsed = '<img src="'. ozy_get_option('custom_logo_collapsed') .'" '. (ozy_get_option('custom_logo_retina') ? 'data-at2x="'. ozy_get_option('custom_logo_retina_collapsed') .'"' : '') .' alt="logo"/>' . PHP_EOL;
                            }
                        }else{
                            echo '<h1 id="logo"><a href="'. home_url() .'/" title="'. get_bloginfo('description') .'">'. get_bloginfo('name') .'</a></h1>';
                        }
                    ?>
                    <a href="<?php echo home_url() ?>" id="logo-collapsed"><?php echo $custom_logo_collapsed ?></a>                
                </div>
    
                <div id="logo-spacer" class="clear <?php echo ozy_get_option('use_custom_logo') !== '1' ? 'text-logo':'' ?>"></div>
               
                <?php
                    $args = array( 'menu_class' => 'side-menu', 'theme_location' => (is_user_logged_in() ? 'logged-in-menu' : 'header-menu'), 'walker' => new BootstrapNavMenuWalker('1') );
                    wp_nav_menu( $args );	
                ?>
                            
                <div id="bottom-elements">
                    <?php
                    if(function_exists("icl_get_languages") && defined("ICL_LANGUAGE_CODE") && defined("ICL_LANGUAGE_NAME")){
                    ?>                
                    <h3 id="ozy-language-selector-title"><i class="oic oic-simple-line-icons-135">&nbsp;</i><?php echo ICL_LANGUAGE_NAME ?></h3>
                    <div id="ozy-language-selector-wrapper">
                    <?php
                        $languages = icl_get_languages('skip_missing=0&orderby=code');
                        if(!empty($languages)){
                            echo '<ul id="ozy-language-selector">' . PHP_EOL;
                            foreach($languages as $l){
                                echo '<li>';
                                echo '<a href="' . $l['url'] . '">';
                                if($l['country_flag_url']){
                                    echo '<img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" />';
                                }
                                echo icl_disp_language($l['native_name'], '');
                                echo '</a>';
                                echo '</li>';
                            }
                            echo '</ul>' . PHP_EOL;
                        }
                    ?> 
                    </div>
                    <!--#wpml language swticher-->                
                    <?php
                    }
                    ?>
                    <h3 class="social-icons"><i class="oic oic-simple-line-icons-148">&nbsp;</i><?php _e('Stay Connected', 'vp_textdomain') ?></h3>
                    <div class="ozy-auto-div social-icons">
                        <?php
                        $ozyHelper->social_icons();
                        ?>
                    </div>
                    <!--#social icons-->
                </div>
                <!--#bottom elements-->
                
            </div>
            <!--#side-nav-bar-->
        <?php 
			else:
		?>
            <div id="header" class="header-v1">
                <div id="top-search" class="clearfix">
                    <div class="container">
                        <form action="<?php echo home_url(); ?>/" method="get" class="wp-search-form">
                            <i class="oic-zoom"></i>
                            <input type="text" name="s" id="search" autocomplete="off" placeholder="<?php echo get_search_query() == '' ? __('Type and hit Enter', 'vp_textdomain') : get_search_query() ?>" />
                            <i class="oic-simple-line-icons-129" id="ozy-close-search"></i>
                        </form>
                    </div>
                </div><!--#top-search-->
                <?php //if(ozy_get_metabox('hide_footer_widget_bar') !== '1') { ?>
                <div id="header-information-bar" class="container widget">
                    <!--<div class="container">-->
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("ozy-header-information" . $ozy_data->wpml_current_language_) ) : ?><?php endif; ?>
                    <!--</div><!--.container-->
                </div><!--#footer-widget-bar-->
                <div id="header-logo" class="container">
                    <div class="header-logo">


                    <?php
                        $custom_logo_collapsed = '<i class="oic oic-list-1"></i>';
                        if(ozy_get_option('use_custom_logo') == '1') {
                            echo '<a href="'. get_home_url() .'" id="logo"><img src="'. ozy_get_option('custom_logo') .'" '. (ozy_get_option('custom_logo_retina') ? 'data-at2x="'. ozy_get_option('custom_logo_retina') .'"' : '') .' alt="logo"/></a>';
                        }else{
                            echo '<h1><a href="'. home_url() .'/" title="'. get_bloginfo('description') .'">'. get_bloginfo('name') .'</a></h1>';
                        }
                    ?>


                    </div>
                    <a id="sidr-menu" href="javascript:void(0);"><i class="oic-list-1"></i></a>
                </div><!--#header-logo.container-->
                <?php //} ?>        
                <header>
                    <div class="container">
                        <div id="nav-primary" class="nav black"><nav>
                        <?php
                            //$ozy_data->menu_type = 'classic';
                            //$ozy_data->menu_type = 'mega';
                            $args = array( 'menu_class' => ( $ozy_data->menu_type === 'mega' ? 'mega-menu' : 'sf-menu' ), 'theme_location' => (is_user_logged_in() ? 'logged-in-menu' : 'header-menu') );
                            if( $ozy_data->menu_type === 'mega' ) {
                                $args['walker'] = new ozyMegaMenuWalker;
                            }
                            wp_nav_menu( $args );
                        ?>
                        </nav></div><!--#nav-primary-->            
                        <div class="clear"></div>
                    </div><!--.container-->
                </header>        
    
            </div><!--#header-->
                    
        <?php
			endif;
		} 
		?>