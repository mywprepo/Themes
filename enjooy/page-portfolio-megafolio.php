<?php
/*
Template Name: Portfolio : Vertical
*/
get_header(); 

global $ozyHelper, $ozy_data;

/*megafolio extended options*/
$params = array(
	'layoutarray' 			=> vp_metabox('ozy_enjooy_meta_page_portfolio.ozy_enjooy_meta_page_portfolio_grid_layout'),
	'filterChangeAnimation' => vp_metabox('ozy_enjooy_meta_page_portfolio.ozy_enjooy_meta_page_portfolio_animation_type'),
	'padding' 				=> vp_metabox('ozy_enjooy_meta_page_portfolio.ozy_enjooy_meta_page_portfolio_padding')
);
wp_localize_script( 'megafolio-init', 'ozyMegafolioOptions', $params );

// meta params & bg slider for page
ozy_page_meta_params();

// meta params for portfolio
ozy_portfolio_meta_params();
?>
<div id="content" class="no-sidebar no-padding-margin template-clean-page">
    <?php if ( have_posts() && $ozy_data->_page_hide_page_content != '1') while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
            <article>
                <?php if($ozy_data->_portfolio_category_filter == '1') { ?>
                <div class="folio-filter-box main-bg-color">
                    <span id="select-folio-filter"><span class="oic oic-list-1"></span><?php _e('All Categories', 'vp_textdomain') ?></span>
                    <ul id="select-folio-filter-option" class="main-bg-color">
                        <li data-category="cat-all">- <span><?php _e('All Categories', 'vp_textdomain') ?></span></li>
                        <?php
							ozy_print_vertical_portfolio_filter($ozy_data->_portfolio_portfolio_categories_tree, $ozy_data->_portfolio_category_filter_parent, 0, $ozy_data->_portfolio_category_search_type);
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
							'post_type' 			=> 'ozy_portfolio',
							'posts_per_page'		=> $ozy_data->_portfolio_post_per_load,
							'orderby' 				=> $ozy_data->_portfolio_orderby,
							'order' 				=> $ozy_data->_portfolio_order,
							'ignore_sticky_posts' 	=> 1,							
							'meta_key' 				=> '_thumbnail_id'
						);

						if($ozy_data->_portfolio_include_categories) {
							$args['tax_query'] = array(
								array(
									'taxonomy' 	=> 'portfolio_category',
									'field' 	=> 'id',
									'terms' 	=> $ozy_data->_portfolio_include_categories,
									'operator' 	=> 'IN'
								)
							);							
						}

						$meta_opt_path 	= 'ozy_enjooy_meta_portfolio.ozy_enjooy_meta_portfolio_custom_thumbnail_group.0.ozy_enjooy_meta_portfolio_custom_thumbnail_';													

						$the_query = new WP_Query( $args );

						while ( $the_query->have_posts() ) {
							$the_query->the_post();

						   	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'blog');
							$full_image_url  = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
							
							$data_url = $full_image_url[0];
							$thumb_type = vp_metabox($meta_opt_path . 'type');
							if('video' == $thumb_type) {
								$data_url 	= vp_metabox($meta_opt_path . 'video');
							}							
							
							$post_categories 	= get_the_terms(get_the_ID(), 'portfolio_category');
							$category_arr		= array();
							foreach ($post_categories as $cat) { $category_arr[$cat->slug] = $cat->name; }
					?>
						<div class="mega-entry cat-all cat-<?php echo join(array_keys($category_arr), ' cat-'); ?>" data-src="<?php echo $large_image_url[0]; ?>" data-width="<?php echo $large_image_url[1] ?>" data-height="<?php echo $large_image_url[2] ?>">
							<div class="mega-hover">
								<div class="mega-hovertitle heading-font"><?php the_title(); ?><div class="mega-hoversubtitle"><?php echo join(array_values($category_arr), ', '); ?></div></div>
								<a href="<?php the_permalink(); ?>"><div class="mega-hoverlink"></div></a>
								<a class="fancybox" rel="group" href="<?php echo $full_image_url[0]; ?>" title="<?php the_title(); ?>"><div class="mega-hoverview"></div></a>
							</div>
						</div>                    

                    <?php
						}
					?>
                    </div>
                    <!--.megafolio-container-->
					
                    <?php if($the_query->found_posts > $ozy_data->_portfolio_post_per_load) { ?>
                    <span class="load_more_blog" data-layout_type="megafolio" data-item_count="<?php echo $ozy_data->_portfolio_post_per_load ?>" data-offset="0" data-found="<?php echo $the_query->found_posts ?>" data-order_by="<?php echo $ozy_data->_portfolio_orderby ?>" data-order="<?php echo $ozy_data->_portfolio_order ?>" data-category_name="<?php  echo join($ozy_data->_portfolio_include_categories,',') ?>" data-loadingcaption="<?php _e('LOADING...', 'vp_textdomain') ?>" data-loadmorecaption="<?php _e('LOAD MORE POSTS', 'vp_textdomain') ?>"><?php _e('LOAD MORE POSTS', 'vp_textdomain') ?></span>
					<!--.load more portfolio-->
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
