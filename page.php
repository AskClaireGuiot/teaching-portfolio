<?php
/**
 * Page Template
 *
 * This template is used for static pages.
 *
 * @package Claire_Portfolio
 * @since 1.0.0
 */

get_header(); ?>

<div class="content-area">
    <div class="site-main">

        <?php while (have_posts()) : the_post(); ?>

            <article id="page-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>

                <header class="entry-header">
                    <h1 class="entry-title text-heading-1">
                        <?php the_title(); ?>
                    </h1>

                    <?php if (has_excerpt()) : ?>
                        <div class="entry-excerpt text-body-large">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="entry-featured-image">
                        <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Pages:', 'claire-portfolio'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    edit_post_link(
                        sprintf(
                            wp_kses(
                                __('Edit <span class="screen-reader-text">%s</span>', 'claire-portfolio'),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            get_the_title()
                        ),
                        '<span class="edit-link">',
                        '</span>'
                    );
                    ?>
                </footer>

            </article>

        <?php endwhile; ?>

    </div>
</div>

<?php get_footer(); ?>
