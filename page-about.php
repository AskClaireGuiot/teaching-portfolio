<?php

/**
 *  About Page Template
 *
 * @package Claire_Portfolio
 * @since 1.0.0
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="about-hero-container">
            <h1 class="text-heading-1">
                About me
            </h1>
        </div>
        <div class="about-hero-video-container">
            <video muted playsinline preload="metadata">
                <source src="<?php echo get_template_directory_uri() . '/public/forest-walk.mp4' ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <p class="video-caption">Hover to join me for a quiet forest walk (Don't worry, I'd never ship hover-only video on a client site 😉)</p>
    </section>

    <section class="page-content">

        <div class="page-content-container">



            <?php the_content(); ?>

        </div>
    </section>

<?php endwhile; ?>
<script>
    const video = document.querySelector("video"); // Get the video element

    // Start playing the video from the beginning at half speed, muted
    function startPreview() {
        video.classList.remove("fade-out");
        video.classList.add("fade-in");
        video.muted = true;
        video.playbackRate = 0.8;
        video.currentTime = 0;
        video.play();
    }

    // When the mouse enters the video area, start preview
    video.addEventListener("mouseenter", () => {
        // Only restart if video is not already playing
        if (video.paused || video.ended) {
            startPreview();
        }
    });

    // Mouse leave does nothing—video keeps playing
    video.addEventListener("mouseleave", () => {
        // Do nothing; video should continue playing through
    });

    // When the video ends, fade it out, reset, and fade it back in
    video.addEventListener("ended", () => {
        video.classList.remove("fade-in");
        video.classList.add("fade-out");

        setTimeout(() => {
            video.currentTime = 0;
            video.playbackRate = 1;
            video.pause();
            video.classList.remove("fade-out");
            video.classList.add("fade-in");
        }, 500); // Wait for fade-out to finish (match CSS transition time)
    });
</script>

<?php get_footer(); ?>