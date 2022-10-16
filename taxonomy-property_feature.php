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
                        <?php
                        the_archive_title('<h1 class="page-title">', '</h1>');
                        the_archive_description('<div class="archive-description">', '</div>');
                        ?>
                    </header><!-- .page-header -->

                    <div class="garola-loop">
                        <div class="row">
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
                                <div class="col-sm-6 col-md-4 p-0 mb-4">
                                    <?php get_template_part('template-parts/content', get_post_type()); ?>
                                </div>
                            <?php
                            // get_template_part('template-parts/content', get_post_type());

                            endwhile; ?>
                        </div>
                    </div>
                <?php
                    the_posts_navigation();

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
