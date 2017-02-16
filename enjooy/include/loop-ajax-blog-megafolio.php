<?php
	while ( $the_query->have_posts() ) {
		$the_query->the_post();

		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'blog');
		$full_image_url  = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');

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