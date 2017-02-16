<?php
/*
Template Name: Real 3D Flipbook Full
*/

get_header(); 
?>
<div id="content" class="full-slider template-clean-page">
    <?php 
	if ( have_posts() ) while ( have_posts() ) : the_post();
		the_content();		
	endwhile;
	?>
</div><!--#content-->
<?php
get_footer();
?>