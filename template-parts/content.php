<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Garola_Real_Estate
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if (is_singular()) :
			the_title('<h1 class="entry-title">', '</h1>');
		else :
			the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		endif;

		if ('post' === get_post_type()) :
		?>
			<div class="entry-meta">
				<?php
				garola_real_estate_posted_on();
				garola_real_estate_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php garola_real_estate_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		if (is_singular()) {
			the_content(
				wp_sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'garola-real-estate'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				)
			);
		} else {
			if (has_excerpt()) {
				esc_html(the_excerpt());
			}

			$content = get_the_content(
				wp_sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'garola-real-estate'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				)
			);

			$read_more_text = wp_sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('... <a href="%s">Read more</a>', 'garola-real-estate'),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				),
				wp_kses_post(get_the_permalink())
			);

			echo wp_trim_words(
				$content,
				25,
				$read_more_text
			);
		}

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'garola-real-estate'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<!-- <footer class="entry-footer">
		<?php garola_real_estate_entry_footer(); ?>
	</footer> -->
	<!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->