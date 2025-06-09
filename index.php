<?php
/**
 * Main Template File
 *
 * This is the main template file, used when no more specific template can be found.
 * It can be used for blog posts, archives, or as a fallback for the front page.
 *
 * @package Claire_Portfolio
 * @since 1.0.0
 */

get_header(); ?>

<div class="content-area">
    <div class="site-main">

        <?php if (is_home() && !is_front_page()) : ?>
            <!-- Blog Page Header -->
            <header class="page-header">
                <h1 class="page-title text-heading-1">
                    <?php _e('Latest Posts', 'claire-portfolio'); ?>
                </h1>
            </header>
        <?php endif; ?>

        <?php if (have_posts()) : ?>

            <div class="posts-container">
                <?php while (have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-preview'); ?>>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                    <?php the_post_thumbnail('medium_large', array('alt' => get_the_title())); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="post-content">
                            <header class="entry-header">
                                <h2 class="entry-title text-heading-3">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <div class="entry-meta text-caption">
                                    <time class="published" datetime="<?php echo get_the_date('c'); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>

                                    <?php if (get_the_category()) : ?>
                                        <span class="categories-links">
                                            <?php _e('in', 'claire-portfolio'); ?>
                                            <?php the_category(', '); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </header>

                            <div class="entry-summary text-body">
                                <?php the_excerpt(); ?>
                            </div>

                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="read-more-link">
                                    <span><?php _e('READ MORE', 'claire-portfolio'); ?></span>
                                </a>
                            </footer>
                        </div>
                    </article>

                <?php endwhile; ?>
            </div>

            <?php
            // Pagination
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('Previous', 'claire-portfolio'),
                'next_text' => __('Next', 'claire-portfolio'),
                'screen_reader_text' => __('Posts navigation', 'claire-portfolio')
            ));
            ?>

        <?php else : ?>

            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title text-heading-2">
                        <?php _e('Nothing here', 'claire-portfolio'); ?>
                    </h1>
                </header>

                <div class="page-content">
                    <?php if (is_home() && current_user_can('publish_posts')) : ?>

                        <p class="text-body">
                            <?php
                            printf(
                                wp_kses(
                                    __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'claire-portfolio'),
                                    array(
                                        'a' => array(
                                            'href' => array(),
                                        ),
                                    )
                                ),
                                esc_url(admin_url('post-new.php'))
                            );
                            ?>
                        </p>

                    <?php elseif (is_search()) : ?>

                        <p class="text-body">
                            <?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'claire-portfolio'); ?>
                        </p>

                        <?php get_search_form(); ?>

                    <?php else : ?>

                        <p class="text-body">
                            <?php _e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'claire-portfolio'); ?>
                        </p>

                        <?php get_search_form(); ?>

                    <?php endif; ?>
                </div>
            </section>

        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
