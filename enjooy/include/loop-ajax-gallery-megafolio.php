<?php
	while ( $the_query->have_posts() ) {
		$the_query->the_post();

		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'blog');
		$attachment = get_post(get_post_thumbnail_id(get_the_ID()));
		
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