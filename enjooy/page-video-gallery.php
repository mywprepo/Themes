<?php
/*
Template Name: Video : Horizontal Gallery
*/
get_header();

ozy_video_gallery_meta_params();

global $ozy_data;
// horizontal grid folio extended options	
$params = array(
	'nrOfThumbsToShowOnSet'		=> ($ozy_data->_video_gallery_post_per_load <= 0 ? 32 : $ozy_data->_video_gallery_post_per_load),
	'scrollBarType' 			=> vp_metabox('ozy_enjooy_meta_page_video_gallery.ozy_enjooy_meta_page_video_gallery_scroll_type'),
	'SpaceBetweenThumbnails'	=> vp_metabox('ozy_enjooy_meta_page_video_gallery.ozy_enjooy_meta_page_video_gallery_padding'),
	'selectLabel'				=> __('All Categories', 'vp_textdomain')
);
wp_localize_script( 'horizontal-gridfolio', 'ozyHorizontalGridFolioOptions', $params );

?>
<div id="content" class="no-sidebar full-width-portfolio template-clean-page">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
            <article>
                <div class="post-content page-content">

					<!-- div used as a holder for the grid -->
                    <div id="horizontalGridFolioContainer" class="horizontal-grid-folio-portfolio"></div>
                
                    <ul id="playlist" style="display: none;">
                        <!-- skin -->
                        <ul data-skin="">
                            <li data-preloader-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/rotite-30-29.png"></li>
                            <li data-show-more-thumbnails-button-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/loadmorewhite.png"></li>
                            <li data-show-more-thumbnails-button-selectsed-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/loadmoreblack.png"></li>
                            <li data-image-icon-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/photoIcon.png"></li>
                            <li data-video-icon-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/videoIcon.png"></li>
                            <li data-link-icon-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/linkIcon.png"></li>
                            <li data-iframe-icon-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/iframeIcon.png"></li>
                            <li data-hand-move-icon-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/handnmove.cur"></li>
                            <li data-hand-drag-icon-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/handgrab.cur"></li>
                            <li data-fullscreen-button-normal-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/fbnn.png"></li>
                            <li data-fullscreen-button-normal-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/fbns.png"></li>
                            <li data-fullscreen-button-full-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/fbfn.png"></li>
                            <li data-fullscreen-button-full-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/fbfs.png"></li>
                            <li data-combobox-down-arrow-icon-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/combobox-down-arrow.png"></li>
                            <li data-combobox-down-arrow-icon-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/combobox-down-arrow-rollover.png"></li>
                            <li data-combobox-up-arrow-icon-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/combobox-up-arrow.png"></li>
                            <li data-combobox-up-arrow-icon-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/combobox-up-arrow-rollover.png"></li>
                            <li data-scrollbar-track-background-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/scrollbar-track-background.png"></li>
                            <li data-scrollbar-handler-background-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/scrollbar-handler-center-background.png"></li>
                            <li data-scrollbar-handler-background-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/scrollbar-handler-center-background-rollover.png"></li>
                            <li data-scrollbar-handler-left-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/scrollbar-handler-left.png"></li>
                            <li data-scrollbar-handler-left-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/scrollbar-handler-left-rollover.png"></li>
                            <li data-scrollbar-handler-right-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/scrollbar-handler-right.png"></li>
                            <li data-scrollbar-handler-right-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/scrollbar-handler-right-rollover.png"></li>
                            <li data-scrollbar-handler-center-icon-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/scrollbar-handler-center-icon.png"></li>
                            <li data-scrollbar-handler-center-icon-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/scrollbar-handler-center-icon-rollover.png"></li>
                            <li data-lightbox-slideshow-preloader-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/slideShowPreloader.png"></li>
                            <li data-lightbox-close-button-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/galleryCloseButtonNormalState.png"></li>
                            <li data-lightbox-close-button-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/galleryCloseButtonSelectedState.png"></li>
                            <li data-lightbox-next-button-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/nextIconNormalState.png"></li>
                            <li data-lightbox-next-button-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/nextIconSelectedState.png"></li>
                            <li data-lightbox-prev-button-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/prevIconNormalState.png"></li>
                            <li data-lightbox-prev-button-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/prevIconSelectedState.png"></li>
                            <li data-lightbox-play-button-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/playButtonNormalState.png"></li>
                            <li data-lightbox-play-button-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/playButtonSelectedState.png"></li>
                            <li data-lightbox-pause-button-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/pauseButtonNormalState.png"></li>
                            <li data-lightbox-pause-button-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/pauseButtonSelectedState.png"></li>
                            <li data-lightbox-maximize-button-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/maximizeButtonNormalState.png"></li>
                            <li data-lightbox-maximize-button-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/maximizeButtonSelectedState.png"></li>
                            <li data-lightbox-minimize-button-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/minimizeButtonNormalState.png"></li>
                            <li data-lightbox-minimize-button-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/minimizeButtonSelectedState.png"></li>
                            <li data-lightbox-info-button-open-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/infoButtonOpenNormalState.png"></li>
                            <li data-lightbox-info-button-open-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/infoButtonOpenSelectedState.png"></li>
                            <li data-lightbox-info-button-close-normal-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/infoButtonCloseNormalPath.png"></li>
                            <li data-lightbox-info-button-close-selected-path="<?php echo OZY_BASE_URL ?>images/horizontal-gridfolio/infoButtonCloseSelectedPath.png"></li>
                        </ul> 
                    
                    <?php
						
						foreach ($ozy_data->_video_gallery_video_gallery_categories as $video_gallery_category) {
							
							echo '<ul data-cat="' . $video_gallery_category->name . '">' . PHP_EOL;

							$args = array(
								'post_type' 			=> 'ozy_video',
								'tax_query' => array(
									array(
										'taxonomy' 	=> 'video_gallery_category',
										'field' 	=> 'id',
										'terms' 	=> array($video_gallery_category->cat_ID),
										'operator' 	=> 'IN'
									),
								),
								'posts_per_page'		=> 10000,
								'orderby' 				=> $ozy_data->_video_gallery_orderby,
								'order' 				=> $ozy_data->_video_gallery_order,
								'ignore_sticky_posts' 	=> 1,
								'meta_key' 				=> '_thumbnail_id'
							);

							$hg_query = new WP_Query( $args );

							include(locate_template('include/loop-horizontal_video_gallery.php'));
							
							echo '</ul>' . PHP_EOL;
						}

					?>
                    </ul>
                    
                </div><!--.post-content .page-content -->
            </article>
        </div><!--#post-# .post-->

    <?php endwhile; ?>
</div><!--#content-->
<?php get_footer(); ?>
