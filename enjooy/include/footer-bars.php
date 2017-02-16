            <?php if(!$ozy_data->hide_everything_but_content) { ?>
            
            <?php if(ozy_get_metabox('hide_footer_widget_bar') !== '1') { ?>
            <div id="footer-widget-bar" class="widget">
                <div class="container">
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("ozy-footer-widget-bar" . $ozy_data->wpml_current_language_) ) : ?><?php endif; ?>
                </div><!--.container-->
            </div><!--#footer-widget-bar-->
            <?php } ?>
            
            <div id="footer" class="widget"><footer>
                <div class="container">
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("ozy-footer-bar" . $ozy_data->wpml_current_language_) ) : ?><?php endif; ?>
                </div><!--.container-->
            </footer></div><!--#footer-->
            <?php } ?>
