<?php
/* The main template file */
get_header() ?>

<!-- Main Content -->

<main id="main-content" class="main" role="main">
    <?php
    if (have_posts()) :

        if (is_front_page()) :
    ?>
            <!-- Hero Section -->
            <section class="hero" aria-labelledby="hero-heading">
                <!-- Background Video -->
                <video
                    class="hero-video"
                    autoplay
                    muted
                    playsinline
                    aria-hidden="true"
                    preload="metadata">
                    <source src="/hero-video.mp4" type="video/mp4">
                    <!-- Fallback for browsers that don't support video -->
                    Your browser does not support the video tag.
                </video>
                <!-- Video Loading Placeholder -->
                <div class="hero-video-placeholder" aria-hidden="true"></div>

                <h2 id="hero-heading" class="hero-text text-heading-1">
                    <span class="hero-intro">Hello, my name is Claire. I am an instructor</span>
                    <span class="hero-cursor" aria-hidden="true">|</span>
                </h2>
                <button class="replay-btn" aria-label="Replay typing animation">
                    <span>REPLAY ANIMATION</span>
                </button>
            </section>

            <!-- Mission Statement Section -->
            <section class="mission" aria-labelledby="mission-heading">
                <div class="mission-container">
                    <div class="mission-content">
                        <div class="mission-left">
                            <h2 id="mission-heading" class="text-heading-2">
                                Meaningful, human-centered learning experiences across physical and digital spaces
                            </h2>
                        </div>
                        <div class="mission-right">
                            <p class="mission-text text-body-large">
                                Whether designing a course, a client website or a 3D installation, I focus on creating
                                <strong>purposeful interactions</strong> that connect people to the emotions, knowledge, and
                                frameworks they need.
                            </p>
                            <p class="mission-text text-body-large">
                                As a post-secondary educator, I am inspired by the diverse paths my students take as they
                                unlock their potential. This curiosity fuels my commitment to blending <strong>technology,
                                    human connection, and inclusive design</strong> to shape transformative learning experiences.
                            </p>
                        </div>
                    </div>
                    <div class="mission-tags">
                        <span class="tag">STRATEGY</span>
                        <span class="tag">CONTENT</span>
                        <span class="tag">CREATIVITY</span>
                        <span class="tag">TECHNOLOGY</span>
                        <span class="tag">PEOPLE-FIRST</span>
                    </div>
                </div>
            </section>

            <!-- Teaching Section -->
            <section class="teaching" aria-labelledby="teaching-heading">
                <div class="teaching-container">
                    <div class="teaching-header">
                        <span class="section-label">TEACHING</span>
                        <h2 id="teaching-heading" class="text-heading-2">
                            Set the stage for inspired learning
                        </h2>
                        <p class="teaching-intro text-body-large text-secondary">
                            As an instructor with one foot in post-secondary, and the other in the tech industry,
                            I try to approach each learning experience with a design thinking mindset: empathize,
                            define, ideate, prototype, test and iterate.
                        </p>
                    </div>

                    <div class="teaching-grid">
                        <div class="teaching-column">
                            <h3 class="text-heading-3">How I teach:</h3>

                            <div class="teaching-item">
                                <span class="material-icons teaching-icon" aria-hidden="true">groups</span>
                                <div class="teaching-content">
                                    <h4 class="item-title text-heading-4">Inclusive learning community</h4>
                                    <p class="text-body text-secondary">
                                        I create spaces that prioritize honesty, relationship-building, and mutual support so
                                        students can share their unique voices.
                                    </p>
                                </div>
                            </div>

                            <div class="teaching-item">
                                <span class="material-icons teaching-icon" aria-hidden="true">devices</span>
                                <div class="teaching-content">
                                    <h4 class="item-title text-heading-4">Technology-enabled</h4>
                                    <p class="text-body text-secondary">
                                        I craft empowering and flexible digital spaces where every student can feel grounded
                                        in and in control of their learning journey.
                                    </p>
                                </div>
                            </div>

                            <div class="teaching-item">
                                <span class="material-icons teaching-icon" aria-hidden="true">science</span>
                                <div class="teaching-content">
                                    <h4 class="item-title text-heading-4">Evidence-based strategies</h4>
                                    <p class="text-body text-secondary">
                                        Team-based learning? Flipped classrooms? Authentic assessments? OER resources? Check.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="teaching-column">
                            <h3 class="text-heading-3">What I teach:</h3>

                            <div class="teaching-item">
                                <span class="material-icons teaching-icon" aria-hidden="true">palette</span>
                                <div class="teaching-content">
                                    <h4 class="item-title text-heading-4">Graphic / UX / UI Design</h4>
                                    <p class="text-body text-secondary">
                                        From typography to user research and UI patterns, I demystify complex topics for
                                        print and screen.
                                    </p>
                                </div>
                            </div>

                            <div class="teaching-item">
                                <span class="material-icons teaching-icon" aria-hidden="true">code</span>
                                <div class="teaching-content">
                                    <h4 class="item-title text-heading-4">Front-end development</h4>
                                    <p class="text-body text-secondary">
                                        I guide students through the art and science of building lean and accessible
                                        digital products, emphasizing real-world skills and problem-solving.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="teaching-footer">
                        <p>Learn more about my <a href="/teaching" class="teaching-link"><span>teaching</span></a></p>
                    </div>
                </div>
            </section>



            <!-- CTA Section -->
            <section class="cta" aria-labelledby="cta-heading">
                <div class="cta-container">
                    <h2 id="cta-heading" class="cta-text text-body-large">
                        Have a course or a project? Need expertise? Let's chat.
                    </h2>
                    <a href="/contact" class="cta-button" aria-label="Contact Claire about a project or course">
                        <span>CONTACT</span>
                    </a>
                </div>
            </section>
    <?php
        endif;

    endif;
    ?>

</main>

<!-- Footer Template Part -->
<?php get_footer() ?>