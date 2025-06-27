<?php

/**
 *  default Page Template
 *
 * @package Claire_Portfolio
 * @since 1.0.0
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <!-- Hero Section -->
    <section class="page-hero">
        <div class="page-hero-container">
            <h1 class="text-heading-1">
                Design Work
            </h1>
        </div>
    </section>

    <section class="page-content">

        <div class="page-content-container">



            <?php the_content(); ?>

        </div>
    </section>

<?php endwhile; ?>

<?php get_footer(); ?>