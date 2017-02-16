<?php
/*
Template Name: Gallery : Accordion
*/
get_header();

?>
<div id="content" class="no-sidebar template-clean-page">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
            <article>
                <div class="post-content page-content">

					<?php
                        $output 	= '';
                        $item_count = 0;
                        foreach(ozy_grab_ids_from_gallery() as $attachment_id) {
                            
                            $attachment = get_post($attachment_id);

                            $output .= '
                            <div class="as-panel">
                                <a href="'. $attachment->guid .'" rel="gallery" class="fancybox">
                                    <img class="as-background" data-src="'. $attachment->guid .'"/>
                                </a>
                                <div class="as-layer" data-position="bottomLeft" data-horizontal="5%" data-vertical="40" data-width="60%" data-height="28%">						
                                    '.($attachment->post_title ? '<h3 class="as-layer as-opened as-black as-padding" 
                                        data-show-transition="down" data-hide-transition="up">
                                        '. $attachment->post_title .'
                                    </h3>':'').'
                                    '.($attachment->post_excerpt ? '<p class="as-layer as-opened as-white as-padding hide-small-screen" 
                                        data-vertical="60"
                                        data-show-transition="up" data-hide-transition="down">
                                        <span class="hide-medium-screen">'. $attachment->post_excerpt .'</span>
                                    </p>':'').'
                                </div>
                            </div>';
							
                            $item_count++;
                        }
                    ?>
                    
                    <div id="accordion-carousel" class="accordion-slider as-horizontal overlap as-opened" data-count="<?php echo $item_count; ?>">
	                    <div class="as-panels as-grab">
                        <?php echo $output; ?>
                        </div>
                    </div>

                </div><!--.post-content .page-content -->
            </article>
        </div><!--#post-# .post-->

    <?php endwhile; ?>
</div><!--#content-->
<?php get_footer(); ?>