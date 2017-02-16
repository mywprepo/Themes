<?php
/*
Template Name: Gallery : Horizontal Grid Folio
*/
get_header(); 

$params = array(
	'nrOfThumbsToShowOnSet'		=> 32,
	'scrollBarType' 			=> 'drag',
	'SpaceBetweenThumbnails'	=> '1',
	'selectLabel'				=> __('All Categories', 'vp_textdomain'),
	'addMouseWheelSupport'		=> 'yes'
);
wp_localize_script( 'horizontal-gridfolio', 'ozyHorizontalGridFolioOptions', $params );
	
?>
<div id="content" class="no-sidebar full-width-portfolio template-clean-page">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
            <article>
                <div class="post-content page-content">

					<!-- div used as a holder for the grid -->
                    <div id="horizontalGridFolioContainer" class="horizontal-grid-folio-gallery"></div>
                
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
                    
	                    <ul data-cat="gallery">
						<?php
                            $thumb_size_arr = array('gridfolio-regular', 'gridfolio-large', 'gridfolio-regular', 'gridfolio-tall', 'gridfolio-large', 'gridfolio-tall', 'gridfolio-regular');
        
                            foreach(ozy_grab_ids_from_gallery() as $attachment_id) {
								$attachment = get_post($attachment_id);
								$thumb_image = wp_get_attachment_image_src( $attachment_id, $thumb_size_arr[rand(0,4)]);
								if(is_array($thumb_image) && count($thumb_image)>0) {									
									echo '
										<ul>
											<li data-type="media" data-url="' . $attachment->guid . '" data-linktogo=""></li>
											<li data-thumbnail-path="' . $thumb_image[0] . '"></li>
											 <li data-thumbnail-text>
												<span class="oic oic-pe-icon-7-stroke-24"></span>
											</li>
											<li data-info="">
												<p class="mediaDescriptionHeader">' . $attachment->post_title . '</p>
												<p class="mediaDescriptionText">' .  $attachment->post_excerpt . '</p>
											</li>
										</ul>';
								}
                            }
                        ?>
                    	</ul>
                    </ul>
                    
                </div><!--.post-content .page-content -->
            </article>
        </div><!--#post-# .post-->

    <?php endwhile; ?>
</div><!--#content-->
<?php get_footer(); ?>