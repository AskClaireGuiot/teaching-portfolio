<?php

/**
 * Case Study Post Template
 *
 * @package Claire_Portfolio
 * @since 1.0.0
 */

get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <!-- Teaching Hero Section -->
    <section class="single-case-study-hero <?php if (has_post_thumbnail()) : ?>thumbnail<?php endif; ?>">

        <div class="single-case-study-hero-container">
            <span class="breadcrumb"><?php
                                        $category = get_the_category();
                                        if (! empty($category)) {
                                            $custom_link = esc_url(get_permalink(236));
                                            $cat_name = esc_html($category[0]->name);
                                            echo '<a href="' . $custom_link . '">' . $cat_name . '</a>';
                                        }
                                        ?>
                </a> > Case Study</span>
            <h1 class="text-heading-1"><?php the_title(); ?></h1>
            <span class="date"><?php the_date(); ?>
            </span>
            <?php if (has_excerpt()) : ?>
                <div class="excerpt"> <?php the_excerpt(); ?></div>
            <?php endif; ?>
        </div>
        <?php if (has_post_thumbnail()) : ?>
            <figure class="single-case-study-thumbnail">
                <div class="aspect-ratio-wrapper">
                    <?php the_post_thumbnail('hero-image'); ?>
                </div>
                <figcaption><?php the_post_thumbnail_caption() ?></figcaption>
            </figure>
        <?php endif; ?>
    </section>

    <!-- Case Study content -->
    <section class="single-case-study-content">
        <div class="single-case-study-content-container">
            <?php the_content(); ?>
        </div>
    </section>
<?php endwhile; ?>
<?php get_footer(); ?>