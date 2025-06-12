<?php

/**
 * Case Study Post Template
 *
 * @package Claire_Portfolio
 * @since 1.0.0
 */

get_header(); ?>

<!-- Teaching Hero Section -->
<section class="single-case-study-hero">
    <?php while (have_posts()) : the_post(); ?>
        <div class="single-case-study-hero-container">
            <span class="breadcrumb"><a href="<?php the_permalink(25); ?>">Teaching</a> > Case Study</span>
            <h1 class="text-heading-1"><?php the_title(); ?></h1>
            <span class="date"><?php the_date(); ?>
            </span>
            <?php if (has_excerpt()) : ?>
                <div class="excerpt"> <?php the_excerpt(); ?></div>
            <?php endif; ?>
        </div>

        <figure class="single-case-study-thumbnail">
            <div class="aspect-ratio-wrapper">
                <?php the_post_thumbnail('hero-image'); ?>
            </div>
            <figcaption>The exhibition in Raven Hall, Com Valley Campus.</figcaption>
        </figure>
    <?php endwhile; ?>
</section>


<section class="single-case-study-content">
    <div class="single-case-study-content-container">

        <!-- Introduction Section -->
        <section
            id="introduction" class="teaching-toc-section"
            aria-labelledby="introduction-heading">
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>

        </section>
    </div>
</section>

<?php get_footer(); ?>