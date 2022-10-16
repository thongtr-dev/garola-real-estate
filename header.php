<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Garola_Real_Estate
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'garola-real-estate'); ?></a>

		<header id="masthead" class="site-header">

			<div class="top-bar bg-light">
				<div class="container">
					<div class="row">
						<div class="col-md-5 col-sm-8 col-xs-12 mx-xs-auto">
							<div class="top-bar-call">
								<span><i class="fas fa-phone-alt"></i> +12345677890</span>
								<span><i class="far fa-envelope"></i> your@company.com</span>
								<!-- <span><i class="fas fa-phone-alt"></i> +1 234 567 7890</span>
									<span><i class="far fa-envelope"></i> your@company.com</span> -->
							</div>
						</div>

						<div class="col-md-2 offset-md-5 col-sm-3 offset-sm-1 col-xs-12 mx-xs-auto">
							<div class="top-bar-social">
								<a href="#"><i class="fab fa-facebook-f"></i></a>
								<a href="#"><i class="fab fa-twitter"></i></a>
								<a href="#"><i class="fab fa-linkedin"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End top bar -->

			<nav class="navbar navbar-expand-md navbar-light bg-white">
				<div class="container">
					<div class="site-branding navbar-brand">
						<?php
						the_custom_logo();
						if (is_front_page() && is_home()) :
						?>
							<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
						<?php
						else :
						?>
							<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
						<?php
						endif;
						$garola_real_estate_description = get_bloginfo('description', 'display');
						if ($garola_real_estate_description || is_customize_preview()) :
						?>
							<p class="site-description"><?php echo $garola_real_estate_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
														?></p>
						<?php endif; ?>
					</div><!-- .site-branding -->

					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
						<div class="navbar-nav ms-auto">
							<?php wp_nav_menu(); ?>
							<!-- <a class="menu-item nav-link" href="<?php echo esc_url(home_url('/')); ?>">Home</a>
							<a class="menu-item nav-link" href="<?php echo get_post_type_archive_link('property'); ?>">Properties</a>
							<a class="menu-item nav-link" href="<?php echo get_post_type_archive_link('agent'); ?>">Agents</a>
							<a class="menu-item nav-link" href="<?php echo esc_url(site_url('/blog')); ?>">News</a>
							<a class="menu-item nav-link" href="<?php echo esc_url(site_url('/contact')); ?>">Contact</a> -->
						</div>
					</div>
				</div>
			</nav> <!-- End site navigation -->

		</header><!-- #masthead -->