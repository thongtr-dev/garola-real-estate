<?php

/**
 * The template for displaying front page and property search result page.
 *
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Garola_Real_Estate
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php if (count($_GET)) {
        $min_price = $_GET['min_price'];
        $max_price = $_GET['max_price'];
        $status = $_GET['status'];
        $bed = $_GET['bed'];
        $bath = $_GET['bath'];
        $features = $_GET['feature'];

        $search_results = new WP_Query(array(
            'post_type' => 'property',
            'posts_per_page' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'property_price',
                    'value' => $min_price,
                    'compare' => '>=',
                    'type' => 'NUMERIC',
                ),
                array(
                    'key' => 'property_price',
                    'value' => $max_price,
                    'compare' => '<=',
                    'type' => 'NUMERIC',
                ),
                array(
                    'key' => 'rent_sale',
                    'value' => $status,
                    'compare' => 'LIKE',
                ),
                array(
                    'key' => 'bed_num',
                    'value' => $bed,
                    'compare' => '>='
                ),
                array(
                    'key' => 'bath_num',
                    'value' => $bath,
                    'compare' => '>=',
                )
            ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'property_feature',
                    'field' => 'slug',
                    'terms' => $features
                )
            )
        ));

        if ($search_results->have_posts()) { ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <header class="entry-header">
                            <h1 class="entry-title">Search Results</h1>
                        </header><!-- .entry-header -->
                        <div class="garola-loop mb-5">
                            <div class="row">
                                <?php while ($search_results->have_posts()) {
                                    $search_results->the_post(); ?>
                                    <div class="col-sm-6 col-md-4 p-0 mb-4">
                                        <?php get_template_part('template-parts/content', 'property'); ?>
                                    </div>
                                <?php }
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php get_sidebar(); ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <header class="entry-header">
                            <h1 class="entry-title">We couldn't find anything. Please try again.</h1>
                        </header><!-- .entry-header -->
                        <?php get_template_part('template-parts/content', 'property-search'); ?>
                    </div>
                </div>
            </div>
        <?php }
    } else { ?>
        <div class="container">
            <div class="row">

                <div class="text-center page-title">
                    <h1 class="fw-bold">Find Your <span style="color: #0bd99e;">Perfect</span> Home</h1>
                </div>
                <div class="col-md-6 offset-md-3">
                    <?php get_template_part('template-parts/content', 'property-search'); ?>
                </div>

                <div class="garola-loop">

                </div>
            </div>
        <?php } ?>

</main><!-- #main -->

<?php
get_footer();
