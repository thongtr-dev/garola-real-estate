<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Garola_Real_Estate
 */

get_header();
?>

<div class="container">
    <main id="primary" class="site-main">
        <?php
        while (have_posts()) {
            the_post();
        ?>
            <div class="row mb-3">
                <div class="single-agent-content">
                    <?php get_template_part('template-parts/content', get_post_type()); ?>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-8">
                    <?php
                    $related_properties = new WP_Query(array(
                        'post_type' => 'property',
                        'meta_key' => 'related_agent',
                        'meta_query' => array(
                            array(
                                'key' => 'related_agent',
                                'compare' => 'LIKE',
                                'value' => '"' . get_the_ID() . '"'

                            )
                        )
                    ));
                    if ($related_properties->have_posts()) { ?>
                        <div class="owl-properties py-3">
                            <h2 class="s-property-title">Active Listings</h2>
                            <div class="garola-loop owl-carousel owl-theme">
                                <?php
                                while ($related_properties->have_posts()) {
                                    $related_properties->the_post();
                                    get_template_part('template-parts/content', get_post_type());
                                }
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>

                        <div class="agent-map py-3">
                            <h2 class="s-property-title">Where <?php echo esc_html(the_title()); ?> Operates</h2>
                            <div id="acf-map" style="height: 400px;" data-zoom='16'>
                                <?php
                                while ($related_properties->have_posts()) {
                                    $related_properties->the_post();
                                    $location = get_field('property_location');
                                ?>
                                    <div class="marker-details" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>" data-address="<?php echo esc_attr($location['address']); ?>" data-title="<?php esc_attr(the_title()); ?>" data-price="<?php the_field('property_price'); ?>" data-link="<?php esc_url(the_permalink()); ?>" data-rent_sale="<?php the_field('rent_sale'); ?>" data-bedroom="<?php the_field('bed_num'); ?>"></div>
                                <?php }
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    <?php }
                    $agent_content = get_the_content();
                    if (!empty($agent_content)) { ?>
                        <div class="agent-about py-3">
                            <h2 class="s-property-title">About <?php echo esc_html(the_title()); ?></h2>
                            <div class="entry-content">
                                <?php echo esc_html(the_content()); ?>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
                <?php get_sidebar(); ?>
            </div>
        <?php }
        ?>
    </main>
</div>

<?php
get_footer();
