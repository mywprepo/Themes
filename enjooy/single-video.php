<?php 
get_header(); 

global $ozyHelper, $ozy_data;

// extended options	
$params = array(
	'ozy_current_page' => 'single-video'
);
wp_localize_script( 'enjooy', 'ozyEnjooyJsOptions', $params );

if ( have_posts() ) while ( have_posts() ) : the_post(); 
?>
<div id="content" class="no-sidebar template-clean-page">
	<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
		<article>
			<div class="post-content single-video">
				<div class="single-video-infobar">
                	<h1><?php the_title(); ?></h1>
                    <div>
                        <a href="#" title="<?php _e('Show Meta', 'vp_textdomain') ?>" id="single-video-show-meta"><span class="fa fa-info"></span></a>
                        <a href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>" class="single-video-soc" title="<?php _e('Share on Faceook', 'vp_textdomain') ?>"><span class="fa fa-facebook"></span></a>
                        <a href="https://twitter.com/share?url=<?php the_permalink() ?>" class="single-video-soc" title="<?php _e('Share on Twitter', 'vp_textdomain') ?>"><span class="fa fa-twitter"></span></a>
                        <a href="#" title="<?php _e('Cinema Mode', 'vp_textdomain') ?>" id="single-video-fullscreen"><span class="fa fa-fullscreen"></span></a>
						<?php
						$prev_page_url = isset(get_previous_post(false)->ID) > 0 ?  get_permalink(get_previous_post(false)->ID) : "";
						$next_page_url = isset(get_next_post(false)->ID) ? get_permalink(get_next_post(false)->ID) : "";
                        ?>
		                <?php if($prev_page_url) { ?><a href="<?php echo $prev_page_url ?>" title="<?php _e('Previous Post', 'vp_textdomain') ?>" class="ozy-custom-controls" id="single-video-previous"><?php _e('Previous Post', 'vp_textdomain') ?></a><?php } ?>
                        <?php if($next_page_url) { ?><a href="<?php echo $next_page_url ?>" title="<?php _e('Next Post', 'vp_textdomain') ?>" class="ozy-custom-controls" id="single-video-next"><?php _e('Next Post', 'vp_textdomain') ?></a><?php } ?>
                        <?php if((int)ozy_get_option('page_video_gallery_list_page_id')>0) { ?><a href="<?php echo get_permalink(ozy_get_option('page_video_gallery_list_page_id')) ?>" title="<?php _e('Return to Gallery', 'vp_textdomain') ?>" class="ozy-custom-controls" id="single-video-return"><?php _e('Return to Gallery', 'vp_textdomain') ?></a><?php } ?>
                   	</div>
                </div>
                <div class="single-video-metabar heading-font">
				<?php
					//Meta info boxes
					$meta_info_boxes = vp_metabox('ozy_enjooy_meta_video_gallery.ozy_enjooy_meta_video_gallery_meta_info');
					if(is_array($meta_info_boxes) && count($meta_info_boxes) > 0) {
						foreach($meta_info_boxes as $meta_info) {
							if($meta_info['ozy_enjooy_meta_video_gallery_meta_info_label']) {
								echo '<p><strong>' . $meta_info['ozy_enjooy_meta_video_gallery_meta_info_label'] . ' : </strong> ' . $ozyHelper->convert_to_href( $meta_info['ozy_enjooy_meta_video_gallery_meta_info_value'] ) . '</p>';
							}
						}
					}
					// Post category
					$portfolio_category = 0;
					echo '<p><strong>'. __('Category', 'vp_textdomain') .' : </strong> ';
					foreach (get_the_terms($post->ID, 'video_gallery_category') as $cat) {
						echo $cat->name;
						$portfolio_category = $cat->term_id;
					}
					echo '</p>';
				?>
                </div>
			<?php
			
				$video_path = vp_metabox('ozy_enjooy_meta_video_gallery.ozy_enjooy_meta_video_gallery_custom_thumbnail_video');
			
				if(strpos($video_path, 'vimeo.com')) {
					$video_path = explode('/', $video_path);
					if(is_array($video_path)) { 
						$video_path = end($video_path);
					}					
					echo $ozyHelper->fullscreen_vimeo_video_show('', $video_path);					
				}else if(strpos($video_path, 'youtube')) {
					$video_path = explode('=', $video_path);
					if(isset($video_path[1])) {
						$video_path = $video_path[1];
					}					
					echo $ozyHelper->fullscreen_youtube_video_show('', $video_path);					
				}
				
				$ozyHelper->set_footer_style(
					".page-content,.post-content{padding:0 !important;margin:0 !important;}\r\n
					#main>.container{width:100% !important;padding:0 !important;margin:". ozy_get_option('header_height'). "px 0 ". ozy_get_option('footer_height') ."px 0 !important;background-color:transparent !important;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;}\r\n
					#main>.container>#content.template-clean-page{padding:0 !important;}\r\n
					#main>.container>#content{width:100% !important;}\r\n
					#main>.container>#content>div>article>.page-content{margin:0 !important;}\r\n
					/*#footer-spacer{display:none !important;}\r\n*/
					.no-padding-margin{margin:0 !important;padding:0 !important;}\r\n"
				);				
			?>
			</div><!--.post-content-->

		</article>
	</div><!-- #post-## -->

</div><!--#content-->
<?php endwhile; /* end loop */ 

get_footer(); 
?>