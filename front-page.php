<?php

/**
 * Front Page Template
 *
 * This template is used for the homepage when a static front page is set.
 * It maintains all the animations and interactions from the original design.
 *
 * @package Claire_Portfolio
 * @since 1.0.0
 */

get_header(); ?>

<!-- Hero Section -->
<section class="hero" aria-labelledby="hero-heading">
    <!-- Background Video -->
    <?php
    $hero_video = get_theme_mod('hero_video_url', get_template_directory_uri() . '/public/hero-video.mp4');
    if ($hero_video) :
    ?>
        <video
            class="hero-video"
            autoplay
            muted
            playsinline
            aria-hidden="true"
            preload="metadata">
            <source src="<?php echo esc_url($hero_video); ?>" type="video/mp4">
            <!-- Fallback for browsers that don't support video -->
            <?php _e('Your browser does not support the video tag.', 'claire-portfolio'); ?>
        </video>
    <?php endif; ?>

    <!-- Video Loading Placeholder -->
    <div class="hero-video-placeholder" aria-hidden="true"></div>

    <h1 id="hero-heading" class="hero-text text-heading-1">
        <?php
        $hero_title = get_theme_mod('hero_title', 'Hello, my name is Claire. I am an instructor');
        $hero_roles = get_theme_mod('hero_roles', 'an instructor, a designer, a developer');
        ?>
        <span class="hero-intro"><?php echo esc_html($hero_title); ?></span>
        <span class="hero-cursor" aria-hidden="true">|</span>
    </h1>
    <button class="replay-btn" aria-label="<?php _e('Replay typing animation', 'claire-portfolio'); ?>">
        <span class="material-icons" aria-hidden="true">play_arrow</span> <span><?php _e('REPLAY ANIMATION', 'claire-portfolio'); ?></span>
    </button>
</section>

<!-- Mission Statement Section -->
<section class="mission" aria-labelledby="mission-heading">
    <div class="mission-content">
        <div class="mission-left">
            <h2 id="mission-heading" class="text-heading-2">
                Meaningful, human-centered learning experiences across physical and digital spaces
            </h2>
        </div>
        <div class="mission-right">
            <p class="text-body-large">
                Whether designing a course, a client website or a 3D installation, I focus on creating <strong>purposeful interactions</strong> that connect people to the emotions, knowledge, and frameworks they need.</p>
            <p class="text-body-large">
                As a post-secondary educator, I am inspired by the diverse paths my students take as they unlock their potential. This curiosity fuels my commitment to blending <strong>technology, human connection, and inclusive design</strong> to shape transformative learning experiences.
            </p>
        </div>
    </div>
    <div class="mission-tags">
        <span class="tag">STRATEGY</span>|<span class="tag">CONTENT</span>|<span class="tag">CREATIVITY</span>|<span class="tag">TECHNOLOGY</span>.<span class="tag">PEOPLE-FIRST</span>.
    </div>
</section>

<!-- Teaching Section -->
<section class="teaching" aria-labelledby="teaching-heading">
    <div class="teaching-container">
        <span class="section-label">Teaching</span>
        <h2 class="text-heading-2">
            Set the stage for inspired learning
        </h2>
        <p class="teaching-intro text-body-large">
            As an instructor with one foot in post-secondary, and the other in the tech industry, I approach each learning experience with a design thinking mindset: empathize, define, ideate, prototype, test and iterate.
            I aim to develop effective, student-centered approaches to teaching and learning that bridge traditional and digital environments.
        </p>
        <div class="teaching-grid">
            <div>
                <h3 class="text-heading-3">How I teach:</h3>
                <ul>
                    <li class="teaching-item">
                        <span class="teaching-icon material-symbols-outlined">
                            verified
                        </span>
                        <div>
                            <h4 class="text-heading-4">Evidence-based Strategies</h4>
                            <p>Team-based learning? Formative feedback? Authentic assessments? OER resources? Check. </p>
                        </div>
                    </li>
                    <li class="teaching-item">
                        <span class="teaching-icon material-symbols-outlined">
                            devices
                        </span>
                        <div>
                            <h4 class="text-heading-4">Technology-enabled Environments</h4>
                            <p>I craft empowering and flexible digital spaces where every student can feel grounded and in-control of their learning journey.</p>
                        </div>
                    </li>
                    <li class="teaching-item">
                        <span class="teaching-icon material-symbols-outlined">
                            hub
                        </span>
                        <div>
                            <h4 class="text-heading-4">Supportive Learning Communities</h4>
                            <p>I foster inclusive networks that prioritize honesty, relationship-building, and mutual support so students feel confident to participate actively.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="text-heading-3">What I teach:</h3>
                <ul>
                    <li class="teaching-item">
                        <span class="teaching-icon material-symbols-outlined">
                            preview
                        </span>
                        <div>
                            <h4 class="text-heading-4">Graphic / UX / UI Design</h4>
                            <p>From typography to user research and UI patterns, I demystify aesthetics, content, visual organization and usability for print and screen.</p>
                        </div>
                    </li>
                    <li class="teaching-item">
                        <span class="teaching-icon material-symbols-outlined">
                            code_blocks
                        </span>
                        <div>
                            <h4 class="text-heading-4">Front-end development</h4>
                            <p>I guide students through the art and science of building lean and accessible digital products, emphasizing real-world skills and problem-solving.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="teaching-footer">
            <a href="<?php the_permalink(25); ?>" class="text-link">
                Learn more about my <strong>teaching</strong>
            </a>
        </div>
    </div>
</section>

<?php
// Add hero roles data for JavaScript
$hero_roles_array = array_map('trim', explode(',', get_theme_mod('hero_roles', 'an instructor, a designer, a developer')));
wp_localize_script('claire-portfolio-main', 'heroData', array(
    'roles' => $hero_roles_array
));
?>

<?php get_footer(); ?>

<!-- 
// 'content' => 'Developing comprehensive curricula that engage learners through strategic content organization and progressive skill building.'

// 'title' => 'Community Building',
// 'content' => 'Fostering inclusive learning environments where students feel connected, supported, and empowered to participate actively.'
// ),

// 'title' => 'Digital Integration',
// 'content' => 'Seamlessly blending technology with pedagogy to enhance learning experiences and expand accessibility.'
// ),

// 'title' => 'Inclusive Design',
// 'content' => 'Ensuring learning experiences are accessible and meaningful for students with diverse backgrounds and abilities.' -->