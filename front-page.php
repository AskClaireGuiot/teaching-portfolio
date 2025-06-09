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
                <?php
                $mission_title = get_theme_mod('mission_title', 'Meaningful, human-centered learning experiences across physical and digital spaces');
                echo wp_kses_post($mission_title);
                ?>
            </h2>
        </div>
        <div class="mission-right">
            <?php
            $mission_text = get_theme_mod('mission_text', '');
            if ($mission_text) {
                echo wp_kses_post($mission_text);
            } else {
                // Default mission text
            ?>
                <p class="mission-text text-body-large">
                    <?php _e('Whether designing a course, a client website or a 3D installation, I focus on creating <strong>purposeful interactions</strong> that connect people to the emotions, knowledge, and frameworks they need.', 'claire-portfolio'); ?>
                </p>
                <p class="mission-text text-body-large">
                    <?php _e('As a post-secondary educator, I am inspired by the diverse paths my students take as they unlock their potential. This curiosity fuels my commitment to blending <strong>technology, human connection, and inclusive design</strong> to shape transformative learning experiences.', 'claire-portfolio'); ?>
                </p>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="mission-tags">
        <span class="tag">STRATEGY</span>|<span class="tag">CONTENT</span>|<span class="tag">CREATIVITY</span>|<span class="tag">TECHNOLOGY</span>.<span class="tag">PEOPLE-FIRST</span>.
    </div>
</section>

<!-- Teaching Section -->
<section class="teaching" aria-labelledby="teaching-heading">
    <div class="teaching-container">
        <div class="teaching-header">
            <span class="section-label"><?php _e('TEACHING', 'claire-portfolio'); ?></span>
            <h2 id="teaching-heading" class="text-heading-2">
                <?php
                $teaching_title = get_theme_mod('teaching_section_title', 'Creating connected learning communities');
                echo wp_kses_post($teaching_title);
                ?>
            </h2>
            <div class="teaching-intro">
                <p class="text-body-large">
                    <?php
                    $teaching_intro = get_theme_mod('teaching_intro', 'I collaborate with educational institutions to develop strategic, human-centered approaches to teaching and learning that bridge traditional and digital environments.');
                    echo wp_kses_post($teaching_intro);
                    ?>
                </p>
            </div>
        </div>

        <div class="teaching-grid">
            <?php
            // Use default teaching content
            claire_portfolio_default_teaching_content();
            ?>
        </div>

        <div class="teaching-footer">
            <?php
            $teaching_page = get_page_by_path('teaching');
            if ($teaching_page) :
            ?>
                <a href="<?php echo esc_url(get_permalink($teaching_page)); ?>" class="teaching-link">
                    <span><?php _e('VIEW ALL TEACHING MATERIALS', 'claire-portfolio'); ?></span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta" aria-labelledby="cta-heading">
    <div class="cta-container">
        <h2 id="cta-heading" class="cta-text text-heading-2">
            <?php
            $cta_text = get_theme_mod('cta_text', 'Ready to collaborate?');
            echo wp_kses_post($cta_text);
            ?>
        </h2>
        <?php
        $contact_page = get_page_by_path('contact');
        if ($contact_page) :
        ?>
            <a href="<?php echo esc_url(get_permalink($contact_page)); ?>" class="button">
                <span><?php _e('GET IN TOUCH', 'claire-portfolio'); ?></span>
            </a>
        <?php endif; ?>
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

<?php
/**
 * Default teaching content when no teaching materials exist
 */
function claire_portfolio_default_teaching_content()
{
    $default_items = array(
        array(
            'icon' => 'school',
            'title' => 'Course Design',
            'content' => 'Developing comprehensive curricula that engage learners through strategic content organization and progressive skill building.'
        ),
        array(
            'icon' => 'group',
            'title' => 'Community Building',
            'content' => 'Fostering inclusive learning environments where students feel connected, supported, and empowered to participate actively.'
        ),
        array(
            'icon' => 'devices',
            'title' => 'Digital Integration',
            'content' => 'Seamlessly blending technology with pedagogy to enhance learning experiences and expand accessibility.'
        ),
        array(
            'icon' => 'assessment',
            'title' => 'Assessment Strategy',
            'content' => 'Creating meaningful evaluation methods that provide valuable feedback and support continuous improvement.'
        ),
        array(
            'icon' => 'lightbulb',
            'title' => 'Innovation Labs',
            'content' => 'Designing experimental learning spaces where students can explore, create, and push creative boundaries.'
        ),
        array(
            'icon' => 'accessibility',
            'title' => 'Inclusive Design',
            'content' => 'Ensuring learning experiences are accessible and meaningful for students with diverse backgrounds and abilities.'
        )
    );

    $column_count = 0;
    foreach ($default_items as $item) {
        if ($column_count % 3 === 0) echo '<div class="teaching-column">';
?>
        <div class="teaching-item">
            <span class="teaching-icon material-icons" aria-hidden="true"><?php echo esc_html($item['icon']); ?></span>
            <div class="teaching-content">
                <h3 class="item-title text-heading-4"><?php echo esc_html($item['title']); ?></h3>
                <p class="text-body"><?php echo esc_html($item['content']); ?></p>
            </div>
        </div>
<?php
        $column_count++;
        if ($column_count % 3 === 0) echo '</div>';
    }
    if ($column_count % 3 !== 0) echo '</div>';
}
