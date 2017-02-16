<?php
/*
Template Name: Blog : Folio Style
*/
get_header();

global $ozyHelper, $ozy_data;

/*megafolio extended options*/
$params = array(
	'layoutarray' 			=> vp_metabox('ozy_enjooy_meta_page_blog.ozy_enjooy_meta_page_blog_grid_layout'),
	'filterChangeAnimation' => vp_metabox('ozy_enjooy_meta_page_blog.ozy_enjooy_meta_page_blog_animation_type'),
	'padding' 				=> vp_metabox('ozy_enjooy_meta_page_blog.ozy_enjooy_meta_page_blog_padding')	
);
wp_localize_script( 'megafolio-init', 'ozyMegafolioOptions', $params );

// meta params & bg slider for page
ozy_page_meta_params();

// meta params for blog
ozy_blog_meta_params();

/* Widgetized LEFT sidebar */
if(function_exists( 'dynamic_sidebar' ) && $ozyHelper->hasIt($ozy_data->_page_content_css_name,'left-sidebar') && $ozy_data->_page_sidebar_name) {
?>
	<div id="sidebar" class="<?php echo $ozy_data->_page_content_css_name; ?>">
		<ul>
        	<?php dynamic_sidebar( $ozy_data->_page_sidebar_name ); ?>
		</ul>
	</div>
	<!--sidebar-->
<?php
}
?>
<div id="content" class="<?php echo $ozy_data->_page_content_css_name; ?> template-clean-page">
    <?php if ( have_posts() && $ozy_data->_page_hide_page_content != '1') while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
            <article>
                
                <?php if($ozy_data->_blog_category_filter == '1') { ?>
                <div class="folio-filter-box main-bg-color">
                    <span id="select-folio-filter"><span class="oic oic-list-1"></span><?php _e('All Categories', 'vp_textdomain') ?></span>
                    <ul id="select-folio-filter-option" class="main-bg-color">
                        <li data-category="cat-all"> - <span><?php _e('All Categories', 'vp_textdomain') ?></span></li>
                        <?php
							$args = array(
								'type'                     => 'post',
								'child_of'                 => 0,
								'parent'                   => '',
								'hide_empty'               => 1,
								'hierarchical'             => 1,
								'exclude'                  => '',
								'include'                  => $ozy_data->_blog_include_categories,
								'number'                   => '',
								'taxonomy'                 => 'category',
								'pad_counts'               => false 
							);
							$categories = get_categories($args); 
							
							foreach ($categories as $category) {
								echo '<li data-category="cat-' . $category->category_nicename . '"> - <span>' . $category->cat_name . '</span></li>' . PHP_EOL;
							}
						?>
                    </ul>
                </div>
                <!--.folio-filter-box-->
                <?php } ?>
	
                <div class="post-content page-content">
                    <?php the_content(); ?>

                    <!--megafolio system-->
                    <div class="megafolio-container noborder norounded light-bg-entries">
					<?php
						$args = array(
							'cat'					=> $ozy_data->_blog_include_categories,
							'post_type' 			=> 'post',
							'posts_per_page'		=> $ozy_data->_blog_post_per_load,
							'orderby' 				=> $ozy_data->_blog_orderby,
							'order' 				=> $ozy_data->_blog_order,
							'ignore_sticky_posts' 	=> 1,
							'meta_key' 				=> '_thumbnail_id',
							'tax_query' 			=> array(
								array(
									'taxonomy' => 'post_format',
									'field' => 'slug',
									'terms' => array( 'post-format-quote', 'post-format-status', 'post-format-link' ),
									'operator' => 'NOT IN'
								)
							)							
						);

						$the_query = new WP_Query( $args );

						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							
							/*get post format*/
							$post_format = get_post_format();
							if ( false === $post_format ) {
								$post_format = 'standard';
							}

						   	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'blog');
						   
						   	$caption_bg 	= vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_caption_background') == '1' ? 'mega-white' : '';
						   	$caption_post 	= vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_caption_position');
						   	$caption_type 	= vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_caption_type');
							$like_count		= (int)get_post_meta(get_the_ID(), "ozy_post_like_count", true);
						   	$caption_type	= $caption_type == '' ? '1' : $caption_type;
							
							$caption_text_color = $caption_bg_color = $caption_bg_color = '';
							if( vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_thumbnail_color') == '1' ) 
							{
								$caption_bg_color 	= vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_thumbnail_color_group.0.ozy_enjooy_meta_post_thumbnail_color_overlay'); 
								$caption_bg_color 	= ' style="background-color:'. $ozyHelper->rgba2rgb($caption_bg_color) . ';background-color:'. $caption_bg_color. ';"';
								$caption_text_color = ' style="color:'. vp_metabox('ozy_enjooy_meta_post.ozy_enjooy_meta_post_thumbnail_color_group.0.ozy_enjooy_meta_post_thumbnail_color_text') .'"';
							}
					?>
                        <div class="mega-entry cat-all <?php foreach(get_the_category() as $category) { echo 'cat-' . $category->slug . ' ';} ?>" id="mega-entry-<?php echo get_the_ID() ?>" data-src="<?php echo $large_image_url[0]; ?>" data-width="<?php echo $large_image_url[1] ?>" data-height="<?php echo $large_image_url[2] ?>">

                            <div<?php echo $caption_bg_color ?> class="mega-covercaption mega-square-<?php echo $caption_post ?> mega-landscape-<?php echo $caption_post ?> mega-portrait-<?php echo $caption_post; echo $caption_bg ?> mega-transparent mega-withsocialbar mega-smallcaptions">
                                <?php
                                    if($caption_type === '1' || $caption_type === '2' || $caption_type === '3' || $caption_type === '4') {
                                        echo '<div class="mega-title"><a href="'. get_permalink() .'"'. $caption_text_color .'>';the_title();echo '</a></div>';
                                    }
                                    if($caption_type === '1' || $caption_type === '3' || $caption_type === '4') {
                                        echo '<div'. $caption_text_color .'>';the_time('F j, Y');echo '</div>';
                                    }
                                    if($caption_type === '3' || $caption_type === '4') {
                                        echo '<p'. $caption_text_color .'>'. get_the_excerpt() .'</p>';
                                        if($caption_type === '4') {
                                            echo '<br/><br/><a href="' . get_permalink() . '"'. $caption_text_color .'>' . __('Read the whole story', 'vp_textdomain') . '</a>';
                                        }
                                    }
                                ?>
                            </div>

                            <div class="mega-socialbar">
                                <span class="mega-leftfloat post-format icon oic-<?php echo $ozyHelper->post_format_icon($post_format)?>"></span>
                                <a href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>" class="mega-leftfloat mega-soc"><i class="icon oic-facebook"></i></a>
                                <a href="https://twitter.com/share?url=<?php the_permalink() ?>" class="mega-leftfloat mega-soc"><i class="icon oic-twitter"></i></a>
                                <a href="<?php the_permalink() ?>" class="mega-show-more icon oic-forward mega-rightfloat"></a>
                                <a href="#" class="mega-rightfloat blog-like-link" data-post_id="<?php the_ID(); ?>"><i class="icon oic-heart-3"></i>&nbsp;<span><?php echo $like_count; ?></span></a>
                                <a href="<?php the_permalink() ?>#comments" class="mega-rightfloat post-comment-count"><i class="icon oic-comment-2"></i>&nbsp;<span><?php echo comments_number('0', '1', '%') ?></span></a>
                            </div>
							<!--.mega-socialbar-->
                            
                        </div>                    
                    <?php
						}
					?>
                    </div>
                    <!--.megafolio-container-->
					
                    <?php if($the_query->found_posts > $ozy_data->_blog_post_per_load) { ?>
                    <span class="load_more_blog" data-layout_type="folio" data-item_count="<?php echo $ozy_data->_blog_post_per_load ?>" data-offset="0" data-found="<?php echo $the_query->found_posts ?>" data-order_by="<?php echo $ozy_data->_blog_orderby ?>" data-order="<?php echo $ozy_data->_blog_order ?>" data-category_name="<?php  echo $ozy_data->_blog_include_categories ?>" data-loadingcaption="<?php _e('LOADING...', 'vp_textdomain') ?>" data-loadmorecaption="<?php _e('LOAD MORE POSTS', 'vp_textdomain') ?>"><?php _e('LOAD MORE POSTS', 'vp_textdomain') ?></span>
                    <!--.load more blog-->
                    <div class="bottom-spacer clear"></div>
                    <?php } ?>

	                <?php edit_post_link('<small>Edit this entry</small>','',''); ?>
                </div><!--.post-content .page-content -->
            </article>
			
        </div><!--#post-# .post-->

    <?php endwhile; ?>
</div><!--#content-->
<?php
/* Widgetized RIGHT sidebar */
if(function_exists( 'dynamic_sidebar' ) && $ozyHelper->hasIt($ozy_data->_page_content_css_name,'right-sidebar') && $ozy_data->_page_sidebar_name) {
?>
	<div id="sidebar" class="<?php echo $ozy_data->_page_content_css_name; ?>">
		<ul>
        	<?php dynamic_sidebar( $ozy_data->_page_sidebar_name ); ?>
		</ul>
	</div>
	<!--sidebar-->
<?php
}
get_footer();
?>
