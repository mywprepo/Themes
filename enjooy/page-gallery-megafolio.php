<?php
/*
Template Name: Image Gallery : Categorized Gallery
*/
get_header(); 

global $ozyHelper, $ozy_data;

/*megafolio extended options*/
$params = array(
	'layoutarray' 			=> vp_metabox('ozy_enjooy_meta_page_image_gallery.ozy_enjooy_meta_page_image_gallery_grid_layout'),
	'filterChangeAnimation' => vp_metabox('ozy_enjooy_meta_page_image_gallery.ozy_enjooy_meta_page_image_gallery_animation_type'),
	'padding' 				=> vp_metabox('ozy_enjooy_meta_page_image_gallery.ozy_enjooy_meta_page_image_gallery_padding')
);
wp_localize_script( 'megafolio-init', 'ozyMegafolioOptions', $params );

// meta params & bg slider for page
ozy_page_meta_params();

// meta params for image_gallery
ozy_image_gallery_meta_params();
?>
<div id="content" class="no-sidebar no-padding-margin template-clean-page">
    <?php if ( have_posts() && $ozy_data->_page_hide_page_content != '1') while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
            <article>
                <?php if($ozy_data->_image_gallery_category_filter == '1') { ?>
                <div class="folio-filter-box main-bg-color">
                    <span id="select-folio-filter"><span class="oic oic-list-1"></span><?php echo $ozy_data->_image_gallery_default_category_name; ?></span>
                    <ul id="select-folio-filter-option" class="main-bg-color">
	                    <li data-category="cat-all"> - <span><?php _e('All Categories', 'vp_textdomain') ?></span></li>
                        <li data-category="cat-<?php echo $ozy_data->_image_gallery_default_category_slug ?>"> - <span><?php echo $ozy_data->_image_gallery_default_category_name ?></span></li>
                        <?php
							$args = array(
								'hide_empty'    => 1,
								'hierarchical'  => 1,
								'include'       => $ozy_data->_image_gallery_include_categories,
								'pad_counts'    => false,
								'exclude'		=> array($ozy_data->_image_gallery_default_category_id)
							);
							
							$categories = get_terms('image_gallery_category', $args); 
							foreach ($categories as $category) {
								echo '<li data-category="cat-' . $category->slug . '"> - <span>' . $category->name . '</span></li>' . PHP_EOL;
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
							'cat'					=> $ozy_data->_image_gallery_include_categories,
							'post_type' 			=> 'ozy_gallery',
							'posts_per_page'		=> $ozy_data->_image_gallery_post_per_load,
							'orderby' 				=> $ozy_data->_image_gallery_orderby,
							'order' 				=> $ozy_data->_image_gallery_order,
							'ignore_sticky_posts' 	=> 1,							
							'meta_key' 				=> '_thumbnail_id'
						);

						$the_query = new WP_Query( $args );

						while ( $the_query->have_posts() ) {
							$the_query->the_post();

						   	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'blog');
							$attachment = get_post(get_post_thumbnail_id($post->ID));
							//$full_image_url  = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
							
							$post_categories 	= get_the_terms(get_the_ID(), 'image_gallery_category');
							$category_arr		= array();
							foreach ($post_categories as $cat) { $category_arr[$cat->slug] = $cat->name; }

					?>
						<div class="mega-entry cat-all cat-<?php echo join(array_keys($category_arr), ' cat-'); ?>" data-src="<?php echo $large_image_url[0]; ?>" data-width="<?php echo $large_image_url[1] ?>" data-height="<?php echo $large_image_url[2] ?>">
							<div class="mega-hover alone">
								<div class="mega-hovertitle heading-font"><?php echo $attachment->post_title ?><div class="mega-hoversubtitle"><?php echo join(array_values($category_arr), ', '); ?></div></div>
								<a class="fancybox-gallery-megafolio" rel="group" href="<?php echo $attachment->guid; ?>" title="<?php echo $attachment->post_title ?>" data-description="<?php echo $attachment->post_excerpt ?>"><div class="mega-hoverview"></div></a>
							</div>
						</div>                    

                    <?php
						}
					?>
                    </div>
                    <!--.megafolio-container-->
					
                    <?php if($the_query->found_posts > $ozy_data->_image_gallery_post_per_load) { ?>
                    <span class="load_more_blog" data-layout_type="image_gallery" data-item_count="<?php echo $ozy_data->_image_gallery_post_per_load ?>" data-offset="0" data-found="<?php echo $the_query->found_posts ?>" data-order_by="<?php echo $ozy_data->_image_gallery_orderby ?>" data-order="<?php echo $ozy_data->_image_gallery_order ?>" data-category_name="<?php  echo $ozy_data->_image_gallery_include_categories ?>" data-loadingcaption="<?php _e('LOADING...', 'vp_textdomain') ?>" data-loadmorecaption="<?php _e('LOAD MORE POSTS', 'vp_textdomain') ?>"><?php _e('LOAD MORE POSTS', 'vp_textdomain') ?></span>
					<!--.load more image_gallery-->
                    <div class="bottom-spacer clear"></div>
                    <?php } ?>
                </div><!--.post-content .page-content -->
            </article>
			
        </div><!--#post-# .post-->

    <?php endwhile; ?>
</div><!--#content-->
<?php
get_footer();
?>
