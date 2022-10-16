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

<div class="container mb-5">
    <div class="row">
        <div class="col-md-8">
            <main id="primary" class="site-main">
                <?php
                while (have_posts()) {
                    the_post();
                ?>
                    <property id="property-<?php esc_attr(the_ID()); ?>" <?php esc_attr(post_class()); ?>>
                        <div class="content-area single-property">
                            <div class="single-property-content">
                                <!-- Single property image slider -->
                                <div id="singlePropertyCarouselSlides" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">

                                        <!-- Property feature image -->
                                        <div class="carousel-item active">
                                            <?php esc_html(the_post_thumbnail('propertyLandscapeMedium')); ?>
                                        </div>
                                        <!-- End property feature image -->

                                        <!-- Property image gallery -->
                                        <?php
                                        $property_gallery = acf_photo_gallery('property_gallery', get_the_ID());

                                        if (count($property_gallery)) {
                                            for ($i = 0; $i < count($property_gallery); $i++) {
                                                $image = $property_gallery[$i];
                                                $full_image_url = $image['full_image_url'];
                                                $full_image_url = acf_photo_gallery_resize_image($full_image_url, 800, 500);
                                        ?>
                                                <div class="carousel-item">
                                                    <img src="<?php echo esc_url($full_image_url); ?>" class="d-block w-100" alt="...">
                                                </div>
                                            <?php }
                                            ?>
                                    </div>
                                    <ul class="carousel-indicators">
                                        <li data-bs-target="#singlePropertyCarouselSlides" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"><img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" class="d-block w-100" alt="..."></li>
                                        <?php
                                            for ($i = 0; $i < count($property_gallery); $i++) {
                                                $image = $property_gallery[$i];
                                                $full_image_url = $image['full_image_url'];
                                        ?>
                                            <li data-bs-target="#singlePropertyCarouselSlides" data-bs-slide-to="<?php echo esc_attr($i + 1); ?>" aria-label="Slide <?php echo esc_attr($i + 2); ?>"><img src="<?php echo esc_url($full_image_url); ?>" class="d-block w-100" alt="..."></li>
                                        <?php }
                                        ?>
                                    </ul>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#singlePropertyCarouselSlides" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#singlePropertyCarouselSlides" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                <?php }
                                ?>
                                </div>

                                <!-- End single property image slider -->

                                <div class="single-property-wrapper">
                                    <div class="single-property-header">
                                        <h1 class="property-title float-start"><?php esc_html(the_title()); ?></h1>
                                        <span class="property-price float-end">$<?php
                                                                                esc_html(the_field('property_price'));
                                                                                if (get_field('rent_sale') == 'For Rent') {
                                                                                    echo ' / Month';
                                                                                }
                                                                                ?>
                                        </span>
                                    </div>

                                    <div class="property-meta entry-meta">
                                        <div class="row gy-3">
                                            <div class="col-6 col-md-3">
                                                <span class="property-info-icon icon-tag">
                                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/for-rent.png" width="50px">
                                                </span>
                                                <span class="property-info-entry">
                                                    <span class="property-info-label">Status</span>
                                                    <span class="property-info-value"><?php esc_html(the_field('rent_sale'));
                                                                                        ?></span>
                                                </span>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <span class="property-info icon-area">
                                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/area.png" width="50px">
                                                </span>
                                                <span class="property-info-entry">
                                                    <span class="property-info-label">Area</span>
                                                    <span class="property-info-value"><?php esc_html(the_field('property_area')); ?><b class="property-info-unit">m<sup>2</sup></b></span>
                                                </span>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <span class="property-info-icon icon-bed">
                                                    <i class="fas fa-bed fa-3x" style="color: #0BD99E"></i>
                                                </span>
                                                <span class="property-info-entry">
                                                    <span class="property-info-label">Bedrooms</span>
                                                    <span class="property-info-value"><?php esc_html(the_field('bed_num')); ?></span>
                                                </span>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <span class="property-info-icon icon-bath">
                                                    <i class="fas fa-bath fa-3x" style="color: #0BD99E"></i>
                                                </span>
                                                <span class="property-info-entry">
                                                    <span class="property-info-label">Bathrooms</span>
                                                    <span class="property-info-value"><?php esc_html(the_field('bath_num')); ?></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .property-meta -->

                                    <div class="section py-3">
                                        <h2 class="s-property-title">Description</h2>
                                        <div class="s-property-content entry-content">
                                            <?php esc_html(the_content()); ?>
                                        </div>
                                    </div>
                                    <!-- End description area  -->

                                    <?php
                                    $additonal_details_table = get_field('additional_details');
                                    if (!empty($additonal_details_table)) {
                                    ?>
                                        <div class="section additional-details py-3">
                                            <h2 class="s-property-title">Additional Details</h2>
                                            <ul class="additional-details-list clearfix">
                                                <?php foreach ($additonal_details_table['body'] as $tr) { ?>
                                                    <li class="row my-1">
                                                        <span class="col-6 col-sm-4 col-md-4 add-d-title"><?php echo esc_html($tr[0]['c']); ?></span>
                                                        <span class="col-6 col-sm-8 col-md-8 add-d-entry"><?php echo esc_html($tr[1]['c']); ?></span>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php }
                                        ?>
                                        </div>
                                        <!-- End additional-details area  -->

                                        <?php
                                        $property_features = get_the_terms(get_the_ID(), 'property_feature');

                                        if (!empty($property_features)) { ?>
                                            <div class="section property-features py-3">
                                                <h2 class="s-property-title">Features</h2>
                                                <ul>
                                                    <?php
                                                    foreach ($property_features as $feature) { ?>
                                                        <li><a href="<?php echo esc_url(get_term_link($feature, 'property_feature')); ?>"><?php echo esc_html($feature->name); ?></a></li>
                                                    <?php }
                                                    ?>
                                                </ul>
                                            </div>
                                        <?php }
                                        ?>
                                        <!-- End features area  -->

                                        <?php
                                        $video = get_field('property_video');
                                        if ($video) { ?>
                                            <div class="section property-video py-3">
                                                <h2 class="s-property-title">Property Video</h2>
                                                <div class="embed-container">
                                                    <?php echo $video; ?>
                                                </div>
                                            </div>
                                        <?php }
                                        ?>
                                        <!-- End video area  -->

                                        <?php
                                        $location = get_field('property_location');
                                        if ($location) { ?>
                                            <div class="property-location py-3">
                                                <h2 class="s-property-title">Location</h2>
                                                <div id="acf-map" style="height: 400px;" data-zoom='16'>
                                                    <div class="marker-details" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>" data-address="<?php echo $location['address']; ?>"></div>
                                                </div>
                                            </div>
                                        <?php }
                                        ?>
                                        <!-- End property location -->

                                        <?php
                                        // Similar properties under same property types
                                        $property_types = get_the_terms(get_the_ID(), 'property_type');

                                        if ($property_types) {
                                            $property_type_slugs = array();

                                            foreach ($property_types as $type) {
                                                array_push($property_type_slugs, $type->slug);
                                            }
                                        }

                                        $similar_properties = new WP_Query(array(
                                            'post_type' => 'property',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'property_type',
                                                    'field' => 'slug',
                                                    'terms' => $property_type_slugs
                                                )
                                            ),
                                            'meta_query' => array(
                                                array(
                                                    'key' => 'rent_sale',
                                                    'value' => get_field('rent_sale'),
                                                    'compare' => '='
                                                )
                                            ),
                                            'posts_per_page' => '9',
                                            'nopaging' => true,
                                            'post__not_in' => array(get_the_ID())
                                        ));

                                        if ($similar_properties->have_posts()) { ?>
                                            <div class="section owl-properties py-3">
                                                <h2 class="s-property-title">Similar Properties</h2>
                                                <div class="garola-loop owl-carousel owl-theme">
                                                    <?php
                                                    while ($similar_properties->have_posts()) {
                                                        $similar_properties->the_post();
                                                        get_template_part('template-parts/content', get_post_type());
                                                    }
                                                    wp_reset_postdata();
                                                    ?>
                                                </div>
                                            </div>
                                        <?php }

                                        // Properties with similar features
                                        $property_features = get_the_terms(get_the_ID(), 'property_feature');

                                        if ($property_features) {
                                            $property_feature_slugs = array();

                                            foreach ($property_features as $feature) {
                                                array_push($property_feature_slugs, $feature->slug);
                                            }
                                        }

                                        $similar_features = new WP_Query(array(
                                            'post_type' => 'property',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'property_feature',
                                                    'field' => 'slug',
                                                    'terms' => $property_feature_slugs,
                                                    'operator' => 'AND'
                                                )
                                            ),
                                            'meta_query' => array(
                                                array(
                                                    'key' => 'rent_sale',
                                                    'value' => get_field('rent_sale'),
                                                    'compare' => '='
                                                )
                                            ),
                                            'posts_per_page' => '9',
                                            'nopaging' => true,
                                            'post__not_in' => array(get_the_ID())
                                        ));

                                        if ($similar_features->have_posts()) { ?>
                                            <div class="section owl-properties py-3">
                                                <h2 class="s-property-title">Properties with Similar Features</h2>
                                                <div class="garola-loop owl-carousel owl-theme">
                                                    <?php
                                                    while ($similar_features->have_posts()) {
                                                        $similar_features->the_post();
                                                        get_template_part('template-parts/content', get_post_type());
                                                    }
                                                    wp_reset_postdata();
                                                    ?>
                                                </div>
                                            </div>
                                        <?php }
                                        ?>
                                        <!-- End similar properties -->

                                </div>
                                <!-- End main single property content -->
                            </div>
                    </property>
                <?php
                }
                ?>
            </main>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();
