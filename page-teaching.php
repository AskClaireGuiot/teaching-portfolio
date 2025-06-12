<?php

/**
 * Teaching Page Template
 *
 * This template is used specifically for the teaching page and maintains
 * all the interactive TOC functionality from the original design.
 *
 * @package Claire_Portfolio
 * @since 1.0.0
 */

get_header(); ?>

<!-- Teaching Hero Section -->
<section class="page-hero">
    <div class="page-hero-container">
        <?php while (have_posts()) : the_post(); ?>
            <h1 class="text-heading-1">
                <?php the_title(); ?>
            </h1>
            <?php if (has_excerpt()) : ?>
                <?php the_excerpt(); ?>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
</section>

<!-- Desktop Layout Container -->
<div class="teaching-layout-container">
    <!-- Table of Contents - Sticky Navigation -->>">
    <nav class="teaching-toc" aria-label="On this page">
        <div class="teaching-toc-container">
            <div class="teaching-toc-header">
                <h2 class="text-heading-4">On this page:</h2>
                <button class="mobile-toc-toggle" aria-expanded="false" aria-controls="teaching-toc-list">
                    <span class="material-icons">keyboard_arrow_down</span>
                </button>
            </div>
            <ul class="teaching-toc-list" id="teaching-toc-list">

                <li><a href="#introduction" class="teaching-toc-link">Introduction</a></li>
                <li><a href="#teaching-activities" class="teaching-toc-link">Teaching Activities</a></li>
                <li>
                    <ul>
                        <li><a href="#teaching-philosophy" class="teaching-toc-link">Teaching Philosophy</a></li>

                        <li><a href="#evidence-based-strategies" class="teaching-toc-link">Evidence-Based Strategies</a></li>
                        <li><a href="#ed-tech" class="teaching-toc-link">Technology-Enabled Communities</a></li>
                        <li><a href="#inclusive" class="teaching-toc-link">Inclusive Learning Environments</a></li>
                    </ul>
                </li>
                <li><a href="#leadership" class="teaching-toc-link">Educational Leadership</a></li>
                <li><a href="#next-steps" class="teaching-toc-link">Next Steps</a></li>
            </ul>
        </div>
    </nav>

    <!-- Teaching content -->
    <section class="page-teaching-content">
        <div class="page-teaching-content-container">
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>
    </section>
</div>


<?php get_footer(); ?>