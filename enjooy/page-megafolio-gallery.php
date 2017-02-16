<?php
/*
Template Name: Gallery : Megafolio
*/
get_header(); 

// megafolio extended options
$params = array(
	'layoutarray' 			=> ozy_get_option('mefafolio_layout'),
	'filterChangeAnimation' => ozy_get_option('mefafolio_animation_type'),
	'padding' 				=> ozy_get_option('mefafolio_padding')
);
wp_localize_script( 'megafolio-init', 'ozyMegafolioOptions', $params );
?>
<div id="content" class="no-sidebar full-width-portfolio template-clean-page">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
            <article>
                <div class="post-content page-content">

                    <div class="megafolio-container noborder norounded light-bg-entries megafolio-gallery">
                    <?php
                        foreach(ozy_grab_ids_from_gallery() as $attachment_id) {
                            
                            $attachment = get_post($attachment_id);
                            
                            $thumb_image = wp_get_attachment_image_src( $attachment_id, 'blog' );

                            echo '<div class="mega-entry cat-all" id="mega-entry-'. $attachment_id .'" data-src="'. $thumb_image[0] .'" data-width="'. $thumb_image[1] .'" data-height="'. $thumb_image[2] .'"><a href="'. $attachment->guid .'" class="fancybox" rel="gallery"><span class="oic oic-pe-icon-7-stroke-24"></span></a></div>';
                        }
                    ?>
                    </div>
                    
                </div><!--.post-content .page-content -->
            </article>
        </div><!--#post-# .post-->

    <?php endwhile; ?>
</div><!--#content-->
<?php get_footer(); ?>