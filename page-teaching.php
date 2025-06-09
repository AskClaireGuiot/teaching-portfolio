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
<section class="teaching-hero">
    <div class="teaching-hero-container">
        <?php while (have_posts()) : the_post(); ?>

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

        <?php endwhile; ?>
    </div>
</section>

<!-- Table of Contents - Sticky Navigation -->
<nav class="teaching-toc" aria-label="<?php _e('Page contents', 'claire-portfolio'); ?>">
    <div class="teaching-toc-container">
        <div class="teaching-toc-header">
            <h2 class="text-heading-4"><?php _e('Contents', 'claire-portfolio'); ?></h2>
            <button class="mobile-toc-toggle" aria-expanded="false" aria-controls="teaching-toc-list">
                <span><?php _e('Navigate', 'claire-portfolio'); ?></span>
                <span class="material-icons">keyboard_arrow_down</span>
            </button>
        </div>
        <ul class="teaching-toc-list" id="teaching-toc-list">
            <?php
            // Get all heading elements from the content to build TOC
            $content = get_the_content();
            $content = apply_filters('the_content', $content);

            // Parse headings for TOC
            $toc_items = claire_portfolio_extract_headings($content);

            if (!empty($toc_items)) {
                foreach ($toc_items as $item) {
                    printf(
                        '<li><a href="#%s" class="teaching-toc-link">%s</a></li>',
                        esc_attr($item['id']),
                        esc_html($item['title'])
                    );
                }
            } else {
                // Default TOC if no headings found
            ?>
                <li><a href="#introduction" class="teaching-toc-link"><?php _e('Introduction', 'claire-portfolio'); ?></a></li>
                <li><a href="#teaching-activities" class="teaching-toc-link"><?php _e('Teaching Activities', 'claire-portfolio'); ?></a></li>
                <li><a href="#assessment" class="teaching-toc-link"><?php _e('Assessment', 'claire-portfolio'); ?></a></li>
                <li><a href="#community" class="teaching-toc-link"><?php _e('Community Building', 'claire-portfolio'); ?></a></li>
                <li><a href="#innovation" class="teaching-toc-link"><?php _e('Innovation', 'claire-portfolio'); ?></a></li>
                <li><a href="#accessibility" class="teaching-toc-link"><?php _e('Accessibility', 'claire-portfolio'); ?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</nav>

<!-- Teaching Content -->
<section class="teaching-content">
    <div class="teaching-content-container">

        <?php while (have_posts()) : the_post(); ?>

            <div class="entry-content">
                <?php
                // Process content to add section IDs for TOC navigation
                $content = get_the_content();
                $content = apply_filters('the_content', $content);
                $content = claire_portfolio_add_heading_ids($content);
                echo $content;
                ?>
            </div>

            <!-- Introduction Section -->
            <section
                id="introduction"
                class="teaching-section"
                aria-labelledby="introduction-heading">
                <h2 id="introduction-heading" class="text-heading-2">
                    Introduction
                </h2>
                <div class="teaching-text-content">
                    <p class="text-body">
                        I'm a full-time, permanent faculty member in the
                        <strong>Digital Design + Development (DGL)</strong> program area
                        at North Island College (NIC) on Vancouver Island. I teach a
                        wide range of graphic design and web development courses, with a
                        strong focus on user experience (UX) and digital pedagogy.
                    </p>
                    <p class="text-body">
                        I acknowledge that this work takes place on the unceded
                        traditional territory of the K'ómoks First Nation, the
                        traditional keepers of this land. NIC is situated on the
                        traditional and unceded territories of the combined 35 First
                        Nations of the Nuu-chah-nulth, Kwakwaka'wakw and Coast Salish
                        traditions.
                    </p>
                    <p class="text-body">
                        Our DGL program area offers one-, two-, and three-year
                        credentials that prepare students for professional practice in
                        design and development, with an emphasis on creative thinking,
                        full-stack coding, and multidisciplinary collaboration.
                    </p>
                </div>
            </section>

            <!-- Teaching Activities Section -->
            <section
                id="teaching-activities"
                class="teaching-section"
                aria-labelledby="activities-heading">
                <h2 id="activities-heading" class="text-heading-2">
                    Teaching Activities
                </h2>

                <div class="teaching-subsection">
                    <h3 class="text-heading-3">From Foundations to Capstone</h3>
                    <p class="text-body text-secondary">
                        I teach across the design–development spectrum:
                    </p>

                    <div class="course-list">
                        <ul class="text-body">
                            <li>DGL102 Graphic Design Foundations</li>
                            <li>DGL112 Typography</li>
                            <li>DGL103 HTML/CSS</li>
                            <li>DGL111 UI/UX Design</li>
                            <li>DGL233 Advanced WordPress Development</li>
                            <li>DGL209 Capstone Project</li>
                        </ul>
                    </div>

                    <p class="text-body">
                        Courses are 13 weeks long and delivered either face-to-face (one
                        4-hour class per week) or asynchronously online. I typically
                        teach 60–80 students per term, in classes of about 20. Students
                        vary widely in age, experience, and cultural background, and I
                        design my instruction to support this diversity.
                    </p>

                    <p class="text-body">
                        Learn more about the DGL program area:
                        <a
                            href="https://learndigital.dev"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-link">learndigital.dev</a>
                    </p>
                </div>
            </section>

            <!-- Teaching Philosophy Section -->
            <section
                id="teaching-philosophy"
                class="teaching-section"
                aria-labelledby="philosophy-heading">
                <h2 id="philosophy-heading" class="text-heading-2">
                    Teaching Philosophy
                </h2>

                <div class="teaching-subsection">
                    <h3 class="text-heading-3">From the Ground Up</h3>
                    <p class="text-body">
                        I began teaching in 2018 and became full-time faculty in 2019.
                        Over the next five years, I completed the Provincial Instructor
                        Diploma Program (PIDP), intentionally pacing the coursework to
                        apply each concept thoughtfully in the classroom.
                    </p>
                    <p class="text-body">
                        The PIDP profoundly shaped my teaching. Starting with no
                        inherited materials and no textbook gave me the opportunity to
                        design every course from the ground up—integrating best
                        practices from the start. I incorporated tools like DACUM
                        analysis, BOPPPS lesson planning, learning outcomes, rubrics,
                        and feedback strategies directly into my curriculum.
                    </p>
                </div>

                <div class="teaching-subsection">
                    <h4 class="text-heading-4">
                        Real-world learning, one layer at a time
                    </h4>
                    <p class="text-body">
                        Each course I design is clear, purposeful, and rooted in
                        real-world relevance and evidence-based learning theory. My
                        courses prioritize practice over high-stakes assessments.
                        Students develop meaningful projects that reflect industry
                        workflows and standards—projects they can carry into portfolios
                        and professional contexts. Assessment is mostly formative and
                        iterative, students receive frequent, specific feedback from
                        peers and from myself.
                    </p>
                </div>

                <div class="teaching-subsection">
                    <h4 class="text-heading-4">Scaffolded for skill-building</h4>
                    <p class="text-body">
                        Courses build progressively, with each week deepening prior
                        learning. This scaffolding supports skill development within
                        Vygotsky's Zone of Proximal Development (1978), helping students
                        gradually gain confidence and independence. Projects are
                        cumulative to support deeper learning and aligns with research
                        showing that authentic, progressively structured tasks with
                        instructor coaching at critical times, enhances real-world
                        transfer (Herrington & Oliver, 2000).
                    </p>
                </div>

                <div class="teaching-subsection">
                    <h4 class="text-heading-4">Varied assessment strategies</h4>
                    <p class="text-body">
                        Assessment in my courses is designed to promote continuous
                        learning, not just measure it, and combines a mix of:
                    </p>
                    <ul class="text-body">
                        <li>
                            <strong>Low-stakes formative assessments:</strong> weekly
                            quizzes and in-class exercises
                        </li>
                        <li>
                            <strong>Medium-stakes summative tasks:</strong> unit exams and
                            authentic projects
                        </li>
                    </ul>
                    <p class="text-body">
                        This approach aligns with Black and Wiliam's (1998) findings
                        that regular, varied assessment with feedback improves learning
                        outcomes. By diversifying formats and pacing evaluation over
                        time, I support accessibility, offering multiple ways for
                        students to demonstrate understanding and build confidence.
                    </p>
                    <p class="text-body">
                        Grades are required, but they're not the driver. Inspired by
                        ungrading models, I strive to make evaluation transparent,
                        flexible, and rooted in growth and self-reflection. Students
                        engage in peer critique, use rubrics for self-assessment, and
                        reflect on their learning journey throughout the term.
                    </p>
                </div>

                <div class="teaching-subsection">
                    <h4 class="text-heading-4">Industry-responsive curriculum</h4>
                    <p class="text-body">
                        As our programs are geared toward employment, I design
                        curriculum based on industry input from our Advisory Committee,
                        labour data, and my own ongoing work as a contractor. To keep
                        pace with rapidly evolving tools, I create all lesson
                        materials—custom videos, curated readings, and clear assignment
                        instructions—rather than relying on textbooks. Projects are
                        authentic, and guest speakers offer real-world insight, aligning
                        with research that shows professionally grounded, context-rich
                        tasks enhance engagement and promote the transfer of learning to
                        practical settings (Herrington & Oliver, 2000).
                    </p>
                </div>

                <div class="teaching-subsection">
                    <h4 class="text-heading-4">
                        Course cadence: Predictable patterns that support learning
                    </h4>

                    <h5 class="text-heading-4">Weekly Rhythm</h5>
                    <p class="text-body">
                        A consistent weekly rhythm supports self-regulation and reduces
                        cognitive load, helping students build confidence and
                        competence. Research in Universal Design for Learning (UDL) and
                        cognitive psychology highlights how predictable structures
                        support diverse learning styles, promotes time management, and
                        reinforces key concepts (CAST, 2018; Sweller, 1988).
                    </p>

                    <p class="text-body">
                        A typical structure for an in-person module (2-3 weeks):
                    </p>

                    <div class="course-structure">
                        <div class="structure-item">
                            <h6 class="text-heading-4">Before Class (Flipped Model):</h6>
                            <ul class="text-body">
                                <li>Short video lessons (created by me)</li>
                                <li>
                                    Curated readings (often open-access, industry-authored, or
                                    instructor-written)
                                </li>
                            </ul>
                        </div>

                        <div class="structure-item">
                            <h6 class="text-heading-4">
                                In-Class (4 hours, BOPPPS + Team-Based Learning):
                            </h6>
                            <ul class="text-body">
                                <li>
                                    <strong>Bridge-In:</strong> Connection to previous
                                    concepts or lived experience
                                </li>
                                <li>
                                    <strong>Outcomes:</strong> Clear articulation of what
                                    students will learn
                                </li>
                                <li>
                                    <strong>Pre-Assessment:</strong>
                                    <ul>
                                        <li>
                                            Individual Readiness Assurance Test (iRAT) on paper
                                        </li>
                                        <li>
                                            Team Readiness Assurance Test (tRAT) using scratch
                                            cards
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>Participatory Learning:</strong>
                                    <ul>
                                        <li>
                                            Collaborative exercises, discussions, and
                                            problem-solving activities
                                        </li>
                                        <li>
                                            Self-directed work period for project development with
                                            real-time feedback
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>Post-Assessment:</strong>
                                    <ul>
                                        <li>
                                            Presentations, reflections (e.g., "muddiest point"),
                                            or summary discussion
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="structure-item">
                            <h6 class="text-heading-4">After Class:</h6>
                            <p class="text-body">
                                Students finish any outstanding activities and continue
                                working on their unit-long project.
                            </p>
                        </div>
                    </div>

                    <h5 class="text-heading-4">Monthly Milestones</h5>
                    <p class="text-body">
                        Courses are typically organized into three or four 4–6-week
                        units, each unit corresponding to a different topic or level of
                        complexity. Units conclude with:
                    </p>
                    <ul class="text-body">
                        <li>A project submission</li>
                        <li>
                            A self-reflection to foster metacognition and knowledge
                            transfer. This reflection is sometimes combined with the
                            project rubric for self-evaluation and might also include
                            student feedback questions.
                        </li>
                        <li>A short unit exam</li>
                    </ul>
                    <p class="text-body">
                        This modular structure promotes focus, autonomy, and skill
                        integration over time, encouraging learners to grow with
                        confidence.
                    </p>
                </div>
            </section>

            <!-- Teaching Strategies & Excellence Section -->
            <section
                id="teaching-strategies"
                class="teaching-section"
                aria-labelledby="strategies-heading">
                <h2 id="strategies-heading" class="text-heading-2">
                    Teaching Strategies & Excellence
                </h2>

                <div class="teaching-subsection">
                    <h3 class="text-heading-3">
                        Technology-enabled and pedagogy-first
                    </h3>
                    <p class="text-body">
                        Whether delivered face-to-face or asynchronously online, my
                        courses maintain consistent learning outcomes and expectations.
                        I tailor activities to each delivery mode to build community and
                        ensure equitable access to support, feedback, and peer learning.
                    </p>

                    <h4 class="text-heading-4">UX-informed environment</h4>
                    <p class="text-body">
                        Drawing on my background as a professional UX designer, I apply
                        human-centered design principles and usability heuristics
                        (Norman, 2013; Nielsen, 1994) to every digital interaction. My
                        learning materials are designed to be visually clear,
                        cognitively accessible, and aligned with how students actually
                        engage with content online.
                    </p>
                    <p class="text-body">
                        My approach to educational technology is pedagogy-first, not
                        tool-first. The digital learning environments I design are
                        purpose-built to:
                    </p>
                    <ul class="text-body">
                        <li>
                            Reduce cognitive load by clearly documenting all course
                            logistics.
                        </li>
                        <li>
                            Support autonomy through the use of rubrics, pacing guides,
                            and checklists.
                        </li>
                        <li>
                            Provide timely, targeted feedback via tools like quizzes,
                            Kaltura video, and intelligent agents.
                        </li>
                        <li>Surface student engagement trends using LMS analytics.</li>
                    </ul>
                    <p class="text-body">
                        Although I experiment with interactive content tools like H5P, I
                        prioritize agile, update-friendly content that can evolve with
                        industry trends and technologies.
                    </p>

                    <h4 class="text-heading-4">
                        Authentic tools, balanced integration
                    </h4>
                    <p class="text-body">
                        I incorporate professional platforms to introduce students to
                        authentic, real-world workflows.
                    </p>
                    <ul class="text-body">
                        <li>
                            <strong>VS Code, GitHub Classroom and Codepen</strong> – for
                            coding, version control and collaborative code reviews.
                        </li>
                        <li>
                            <strong>Adobe and Figma products</strong> – for design,
                            critiques and real-time collaboration.
                        </li>
                        <li>
                            <strong>Google Suite</strong> - for file sharing and real-time
                            collaboration.
                        </li>
                    </ul>
                    <p class="text-body">
                        At the same time, I am mindful of interface overload. There is a
                        careful balance to strike between expanding students' digital
                        versatility and ensuring they are not overwhelmed by too many
                        tools or logins.
                    </p>
                    <p class="text-body">
                        While I prefer tools hosted in Canada for privacy and security
                        reasons, I carefully weigh these considerations against the
                        value of teaching industry-standard workflows.
                    </p>

                    <h4 class="text-heading-4">A creative gap in tech</h4>
                    <p class="text-body">
                        One ongoing challenge in my practice is the lack of a platform
                        that truly supports asynchronous design critique with the
                        pedagogical depth and administrative functionality required in
                        post-secondary education. While creative collaboration tools
                        like Figma enable iterative feedback, they often lack grading
                        tools and structured evaluation frameworks. I continue to
                        prototype solutions that bridge this gap—balancing dialogic
                        engagement with the logistical needs of educational
                        institutions.
                    </p>
                    <p class="text-body">
                        Student Portfolio discussion – issue was raised that
                        articulation agreements and transfers via the TCS platform do
                        not provide an option for student portfolio reviews
                    </p>

                    <h4 class="text-heading-4">Networked learning</h4>
                    <p class="text-body">
                        Beyond collaborative assignments, I use technology to build
                        authentic, connected learning communities, and foster student
                        connection and inclusion across modes of delivery:
                    </p>
                    <ul class="text-body">
                        <li>
                            <strong>Slack & Mattermost channels</strong> to create
                            informal spaces for peer learning and real-time support (the
                            digital campus hallway).
                        </li>
                        <li>
                            <strong>Persistent Slack channels</strong> to connect alumni
                            and current students, supporting mentorship and continuity.
                        </li>
                        <li>
                            <strong>Social media</strong> to showcase celebrate student
                            work and deepen engagement.
                        </li>
                        <li>
                            <strong>Optional online drop-in sessions</strong> for
                            equitable access to feedback and coaching.
                        </li>
                    </ul>
                    <p class="text-body">
                        These practices are aligned with the Community of Inquiry (CoI)
                        framework, which emphasizes the interplay between social,
                        cognitive, and teaching presence as central to inclusive,
                        high-quality online learning (Garrison, Anderson, & Archer,
                        2000).
                    </p>
                </div>

                <div class="teaching-subsection">
                    <h3 class="text-heading-3">Inclusive Education</h3>

                    <h4 class="text-heading-4">Designing for all students</h4>
                    <p class="text-body">
                        My courses are built around the learner experience. North Island
                        College attracts a diverse student population, including many
                        international students and learners with varied digital fluency,
                        goals, and life responsibilities. In response, I use strategies
                        inspired by Universal Design for Learning (UDL) (CAST, 2018):
                    </p>
                    <ul class="text-body">
                        <li>
                            <strong>Multiple means of representation:</strong> slide
                            decks, captioned videos, written tutorials, and templates.
                        </li>
                        <li>
                            <strong>Multiple means of engagement:</strong> choice in
                            project topics, formats, and tools.
                        </li>
                        <li>
                            <strong>Checkpoints for understanding:</strong> low-stakes
                            quizzes, self-reflections, discussion forums, and peer
                            reviews.
                        </li>
                        <li>
                            <strong>Pacing flexibility:</strong> clear timelines combined
                            with white space for catch-up and self-regulation.
                        </li>
                    </ul>
                    <p class="text-body">
                        Students are encouraged to shape their learning journeys. I
                        create room for autonomy while providing structure and ongoing
                        support.
                    </p>

                    <h4 class="text-heading-4">Value-Based Education</h4>
                    <p class="text-body">
                        Many of my assignments connect directly to real-world issues. I
                        invite students to align their work with the UN Sustainable
                        Development Goals, supporting civic engagement and personal
                        meaning-making in their projects.
                    </p>
                    <p class="text-body">
                        I actively work to create inclusive and safe learning
                        environments, both in-person and online. My teaching materials
                        include diverse perspectives, and students are given voice and
                        choice wherever possible.
                    </p>

                    <h4 class="text-heading-4">Indigenization</h4>
                    <p class="text-body">
                        Indigenization is an ongoing responsibility in Canadian
                        post-secondary education and I recognize that I have a lot of
                        progress to make in this area. I feel that by prioritizing
                        respect, self-expression and agency in my classes, I have
                        implemented pedagogical approaches that foster a deeper
                        understanding and appreciation of different cultures and ways of
                        knowing.
                    </p>
                    <p class="text-body">
                        In courses like Graphic Design Foundations, I embed discussions
                        of visual culture, representation, and decolonizing the design
                        process. In more technical courses like web development or
                        programming I find it a lot harder. I'm exploring how to
                        critically examine the colonial roots of computing and imagine
                        what Indigenized or decolonized tech education might look like.
                        For example, programming languages such as HTML, CSS and PHP
                        reflect Western systems of logic and classification.
                        Indigenization invites us to question these systems, consider
                        what's been excluded, and explore new ways of thinking about
                        knowledge and systems design - this extends to UI design and Ed
                        Tech solutions generally, not just the content and tools of my
                        specific coding courses.
                    </p>
                </div>
            </section>

            <!-- Educational Leadership Section -->
            <section
                id="educational-leadership"
                class="teaching-section"
                aria-labelledby="leadership-heading">
                <h2 id="leadership-heading" class="text-heading-2">
                    Educational Leadership
                </h2>

                <div class="teaching-subsection">
                    <h3 class="text-heading-3">
                        Contributing to educational leadership
                    </h3>
                    <ul class="text-body">
                        <li>Grad Show, marketing, department website</li>
                        <li>French partnership, hiring committees</li>
                        <li>NICFA</li>
                    </ul>
                </div>
            </section>

            <!-- Future Growth Section -->
            <section
                id="future-growth"
                class="teaching-section"
                aria-labelledby="growth-heading">
                <h2 id="growth-heading" class="text-heading-2">Future Growth</h2>

                <div class="teaching-subsection">
                    <h3 class="text-heading-3">Next Steps in teaching & learning</h3>

                    <h4 class="text-heading-4">
                        Iterative and feedback-informed improvements
                    </h4>
                    <p class="text-body">
                        I approach teaching as a design process: research, prototype,
                        test, and iterate. Student feedback is built into my practice at
                        multiple levels:
                    </p>
                    <ul class="text-body">
                        <li>
                            Weekly "Muddiest point" reflections to surface confusion
                            early.
                        </li>
                        <li>
                            End of unit self-reflections and anonymous surveys to identify
                            pain points and opportunities.
                        </li>
                        <li>LMS data analysis to spot engagement patterns.</li>
                        <li>
                            Industry consultation to update course content, tools and
                            learning outcomes.
                        </li>
                        <li>
                            The QAPA Program Review process to evolve program delivery and
                            outcomes.
                        </li>
                    </ul>
                    <p class="text-body">
                        This iterative approach ensures that my teaching remains
                        responsive, inclusive, and aligned with evolving industry
                        practice.
                    </p>

                    <h4 class="text-heading-4">
                        Industry work as professional development
                    </h4>
                    <h4 class="text-heading-4">Further education</h4>
                    <h4 class="text-heading-4">Professional areas of interest</h4>
                </div>
            </section>


        <?php endwhile; ?>

    </div>
</section>

<?php get_footer(); ?>

<?php
/**
 * Extract headings from content for TOC generation
 */
function claire_portfolio_extract_headings($content)
{
    $headings = array();

    // Match h2-h6 headings
    preg_match_all('/<h([2-6])[^>]*>(.*?)<\/h[2-6]>/i', $content, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        $level = $match[1];
        $title = strip_tags($match[2]);
        $id = sanitize_title_with_dashes($title);

        $headings[] = array(
            'level' => $level,
            'title' => $title,
            'id' => $id
        );
    }

    return $headings;
}

/**
 * Add IDs to headings for TOC navigation
 */
function claire_portfolio_add_heading_ids($content)
{
    // Add IDs to h2-h6 headings
    $content = preg_replace_callback(
        '/<h([2-6])([^>]*)>(.*?)<\/h[2-6]>/i',
        function ($matches) {
            $level = $matches[1];
            $attributes = $matches[2];
            $title = $matches[3];

            // Create ID from title if one doesn't exist
            if (strpos($attributes, 'id=') === false) {
                $id = sanitize_title_with_dashes(strip_tags($title));
                $attributes .= ' id="' . $id . '"';
            }

            // Add teaching-section class for JavaScript targeting
            if (strpos($attributes, 'class=') === false) {
                $attributes .= ' class="teaching-section"';
            } else {
                $attributes = str_replace('class="', 'class="teaching-section ', $attributes);
            }

            return "<h{$level}{$attributes}>{$title}</h{$level}>";
        },
        $content
    );

    return $content;
}
