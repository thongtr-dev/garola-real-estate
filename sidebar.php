<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Garola_Real_Estate
 */

if (!is_active_sidebar('primary-sidebar') && is_singular('property')) { ?>
	<aside id="secondary" class="widget-area col-md-4">
		<?php
		global $post;
		$related_agent = get_field('related_agent');
		if ($related_agent) {
			foreach ($related_agent as $agent) {
				$post = $agent;
				setup_postdata($post);
		?>
				<div class="agent-widget">
					<?php get_template_part('template-parts/content', 'agent'); ?>
				</div>
		<?php
			}
			wp_reset_postdata();
		}

		get_template_part('template-parts/content', 'property-search');
		?>
	</aside><!-- #secondary -->
<?php return;
}
if (!is_active_sidebar('primary-sidebar')) { ?>
	<aside id="secondary" class="widget-area col-md-4">
		<?php get_template_part('template-parts/content', 'property-search'); ?>
	</aside>
<?php }
?>

<aside id="secondary" class="widget-area col-md-4">
	<?php dynamic_sidebar('primary-sidebar'); ?>
</aside><!-- #secondary -->