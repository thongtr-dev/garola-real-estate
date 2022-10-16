<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Garola_Real_Estate
 */

get_header();
?>

<div class="container mb-5">
    <div class="row">
        <div class="col-md-8">
            <main id="primary" class="site-main">

                <?php if (have_posts()) : ?>
                    <header class="page-header">
                        <h1 class="page-title"><?php echo post_type_archive_title('All ', true); ?></h1>
                        <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
                    </header><!-- .page-header -->

                    <?php
                    $property_types = get_terms(array(
                        'taxonomy' => 'property_type',
                        'hide_empty' => true
                    )); ?>

                    <div id="property-filter-expand-btn">
                        <a class="btn btn-primary mb-3" data-bs-toggle="collapse" href="#propertyFilter" role="button" aria-expanded="false" aria-controls="propertyFilter">
                            Property Type <i class="fas fa-filter"></i>
                        </a>
                    </div>

                    <ul class="shuffle-filter collapse" id="propertyFilter">
                        <li class='selected' data-target='all'>All</li>
                        <?php
                        foreach ($property_types as $property_type) { ?>
                            <li data-target='<?php echo $property_type->slug; ?>'><?php echo $property_type->name; ?></li>
                        <?php }
                        ?>
                    </ul>
                    <div class="garola-loop ">
                        <div class="row shuffle-container">
                            <?php
                            /* Start the Loop */

                            while (have_posts()) :
                                the_post();
                                /*
            * Include the Post-Type-specific template for the content.
            * If you want to override this in a child theme, then include a file
            * called content-___.php (where ___ is the Post Type name) and that will be used instead.
            */
                            ?>
                                <!-- <div class="col-sm-6 col-md-4 p-0 mb-4"> -->
                                <?php $types = get_the_terms(get_the_ID(), 'property_type'); ?>
                                <div class="property-shuffle-item col-sm-5 col-md-4 p-0 mb-4" data-groups='["all"<?php foreach ($types as $type) {
                                                                                                                        echo ',"' . $type->slug . '"';
                                                                                                                    } ?>]'>
                                    <div class="property-item-thumbnail">
                                        <a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_post_thumbnail('propertySquare')); ?></a>
                                    </div>
                                    <div class="property-item-content overflow-auto">
                                        <h5><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h5>
                                        <div class="dot-hr"></div>
                                        <span class="float-start"><b>Area :</b> <?php esc_html(the_field('property_area')); ?><b class="property-info-unit">m<sup>2</sup></b></span>
                                        <span class="property-price float-end">$<?php esc_html(the_field('property_price'));
                                                                                if (get_field('rent_sale') == 'For Rent') {
                                                                                    echo ' / Month';
                                                                                }
                                                                                ?></span>
                                    </div>
                                </div>
                                <!-- </div> -->
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php
                    // the_posts_navigation();
                    echo paginate_links();

                else :

                    get_template_part('template-parts/content', 'none');

                endif;
                ?>

            </main><!-- #main -->
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();
