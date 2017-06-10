<?php 
	$logo = ot_get_option('logo', THB_THEME_ROOT. '/assets/img/logo.png');
	$logo_light = ot_get_option('logo_light', THB_THEME_ROOT. '/assets/img/logo-light.png');
	$menu_style = ot_get_option('menu_style', 'menu_style1');
	
	$portfolio_main_theme = ot_get_option('portfolio_main');
	$portfolio_header_animation = ot_get_option('portfolio_header_animation', 'on');
	$blog_header_animation = ot_get_option('blog_header_animation', 'on');
	$portfolio_main = get_post_meta(get_the_ID(), 'portfolio_main', TRUE);
	$portfolio_link = $portfolio_main ? get_permalink($portfolio_main) : ( $portfolio_main_theme ? get_permalink($portfolio_main_theme) : get_home_url());
	
	$header_case = (is_singular('portfolio') && $portfolio_header_animation === 'on') || (is_singular('post') && $blog_header_animation === 'on');
?>
<!-- Start Header -->
<header class="header style1 <?php echo esc_attr($menu_style); ?>">
	<div class="row expanded align-middle">
		<div class="small-12 columns regular-header">
			<div class="logo-holder">
				<a href="<?php echo esc_url(home_url()); ?>" class="logolink" title="<?php bloginfo('name'); ?>">
					<img src="<?php echo esc_url($logo); ?>" class="logoimg logo-dark" alt="<?php bloginfo('name'); ?>"/>
					<img src="<?php echo esc_url($logo_light); ?>" class="logoimg logo-light" alt="<?php bloginfo('name'); ?>"/>
				</a>
			</div>
			<div>
				<?php if ($menu_style == 'menu_style2') { get_template_part( 'inc/templates/header/full-menu' ); } ?> 
				<?php do_action( 'thb_quick_cart' ); ?>
				<?php do_action( 'thb_quick_search' ); ?>
				<a href="#" class="mobile-toggle">
					<span></span><span></span><span></span>
				</a>
			</div>
		</div>
		<?php if ($header_case) { ?>
			<div class="small-12 columns portfolio-header">
				<div class="thb-breadcrumb-holder">
					<a href="<?php echo esc_attr($portfolio_link); ?>" title="<?php esc_attr_e('Back', 'werkstatt'); ?>" class="home"><?php get_template_part( 'assets/img/portfolio-prev-arrow.svg' ); ?></a>
					<?php if (is_singular('portfolio')) { ?>
						<a href="<?php echo esc_attr($portfolio_link); ?>" title="<?php bloginfo('name'); ?>"><?php esc_html_e('Projects', 'werkstatt'); ?></a>
					<?php } else { ?>
						<a href="<?php echo esc_url(get_permalink( get_option( 'page_for_posts' ) )); ?>" title="<?php bloginfo('name'); ?>"><?php esc_html_e('Blog', 'werkstatt'); ?></a>
					<?php } ?>
					<span><div><em>-</em> <?php echo get_the_title(get_queried_object_id()); ?></div></span>
				</div>
				<?php do_action( 'thb_portfolio_share'); ?>
				<a href="#" class="mobile-toggle">
					<span></span><span></span><span></span>
				</a>
			</div>
		<?php } ?>
	</div>
</header>
<!-- End Header -->