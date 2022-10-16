<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Garola_Real_Estate
 */

?>

<footer id="colophon" class="site-footer py-5">
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="footer-widget">
						<h4>About us</h4>
						<div class="footer-title-line"></div>
						<!-- footer logo here -->
						<p>Lorem ipsum dolor cum necessitatibus su quisquam molestias. Vel unde, blanditiis.</p>
						<div class="footer-address">
							<li><i class="fas fa-map-marker-alt"></i> Address</li>
							<li><i class="far fa-envelope"></i> email@yourcompany.com</li>
							<li><i class="fas fa-phone-alt"> </i> +1 908 967 5906</li>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="footer-widget">
						<h4>Quick links</h4>
						<div class="footer-title-line"></div>
						<div class="footer-menu">
							<?php wp_nav_menu(); ?>
						</div>
					</div>
				</div>
				<!-- <div class="col-md-3 col-sm-6">
					<div class="footer-widget">
						<h4>Latest News</h4>
						<div class="footer-title-line"></div>
						<div class="footer-blog">
						</div>
					</div>
				</div> -->
				<div class="col-md-6 col-sm-6">
					<div class="footer-widget newsletter">
						<h4>Stay in touch</h4>
						<div class="footer-title-line"></div>
						<p>Lorem ipsum dolor sit amet, nulla suscipit similique quisquam molestias. Vel unde, blanditiis.</p>

						<form class="pb-3">
							<div class="input-group">
								<input type="text" placeholder="E-mail ... ">
								<span>
									<button type="button"><i class="far fa-paper-plane"></i></button>
								</span>
							</div>
							<!-- /input-group -->
						</form>

						<div class="footer-social float-sm-start float-md-end">
							<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
						</div>
					</div>
				</div>

			</div>
			<div class="row mt-3">
				<div class="site-info">
					<a href="<?php echo esc_url(__('https://wordpress.org/', 'garola-real-estate')); ?>">
						<?php
						/* translators: %s: CMS name, i.e. WordPress. */
						printf(esc_html__('Proudly powered by %s', 'garola-real-estate'), 'WordPress');
						?>
					</a>
					<span class="sep"> | </span>
					<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf(esc_html__('Theme: %1$s by %2$s.', 'garola-real-estate'), 'garola-real-estate', '<a href="https://thongtruong.com">Thong Truong</a>');
					?>
				</div><!-- .site-info -->
			</div>
			<p class="mt-3" style="font-style: italic;">Disclaimer: All names, properties, addresses, locations, images and information in this website are for visual presentation purpose only. Any similarity is purely coincidental.</p>
			<p class="mt-3" style="font-style: italic;">Photos: <a href="https://unsplash.com/">Unsplash.com</a> and <a href="pexels.com">Pexels.com</a></p>
		</div>
	</div>

</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>