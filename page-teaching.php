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

<!-- Table of Contents - Sticky Navigation -->
<nav class="teaching-toc" aria-label="<?php _e('Page contents', 'claire-portfolio'); ?>">
    <div class="teaching-toc-container">
        <div class="teaching-toc-header">
            <h2 class="text-heading-4"><?php _e('Contents', 'claire-portfolio'); ?></h2>
            <button class="mobile-toc-toggle" aria-expanded="false" aria-controls="teaching-toc-list">
                <span class="material-icons">keyboard_arrow_down</span>
            </button>
        </div>
        <ul class="teaching-toc-list" id="teaching-toc-list">

            <li><a href="#introduction" class="teaching-toc-link">Introduction</a></li>
            <li><a href="#teaching-activities" class="teaching-toc-link">Teaching Activities</a></li>
            <li><a href="#teaching-philosophy" class="teaching-toc-link">Teaching Philosophy</a></li>

            <li><a href="#assessment" class="teaching-toc-link"><?php _e('Assessment', 'claire-portfolio'); ?></a></li>
            <li><a href="#community" class="teaching-toc-link"><?php _e('Community Building', 'claire-portfolio'); ?></a></li>
            <li><a href="#innovation" class="teaching-toc-link"><?php _e('Innovation', 'claire-portfolio'); ?></a></li>
            <li><a href="#accessibility" class="teaching-toc-link"><?php _e('Accessibility', 'claire-portfolio'); ?></a></li>
        </ul>
    </div>
</nav>

<!-- Teaching Content -->
<section class="page-teaching-content">
    <div class="page-teaching-content-container">

        <!-- Introduction Section -->
        <section
            id="introduction" class="teaching-toc-section"
            aria-labelledby="introduction-heading">
            <h2 class="section-label">
                Introduction
            </h2>
            <p>
                I'm a full-time, permanent faculty member in the
                <strong>Digital Design + Development (DGL)</strong> program area
                at North Island College (NIC) on Vancouver Island. I teach a
                wide range of graphic design and web development courses, with a
                strong focus on user experience (UX) and digital pedagogy.
            </p>
            <p>
                I acknowledge that this work takes place on the unceded
                traditional territory of the K'ómoks First Nation, the
                traditional keepers of this land. NIC is situated on the
                traditional and unceded territories of the combined 35 First
                Nations of the Nuu-chah-nulth, Kwakwaka'wakw and Coast Salish
                traditions.
            </p>
            <p>
                Our DGL program area offers one-, two-, and three-year
                credentials that prepare students for professional practice in
                design and development, with an emphasis on creative thinking,
                full-stack coding, and multidisciplinary collaboration.
            </p>
            <article class="case-study-link">
                <a href="<?php the_permalink(30); ?>" class="case-study-inner">
                    <div class="case-study-text">
                        <h2 class="section-label">Case Study</h2>
                        <h3><?php echo get_the_title(30); ?></h3>

                        <!-- Mobile image (hidden on desktop) -->
                        <div class="case-study-image mobile-only">
                            <?php echo get_the_post_thumbnail(30, 'thumbnail-medium'); ?>
                        </div>

                        <p><?php echo get_the_excerpt(30); ?></p>
                        <span class="text-link">Read the <strong>Case Study</strong></span>
                    </div>

                    <!-- Desktop image (hidden on mobile) -->
                    <div class="case-study-image desktop-only">
                        <?php echo get_the_post_thumbnail(30, 'thumbnail-medium'); ?>
                    </div>
                </a>
            </article>

        </section>

        <!-- Teaching Activities Section -->
        <section
            id="teaching-activities" class="teaching-toc-section"
            aria-labelledby="activities-heading">
            <h2 class="section-label">
                Teaching Activities
            </h2>
            <h3 class="text-heading-3">From Foundations to Capstone</h3>
            <p>
                I teach across the design-development spectrum:
            </p>

            <ul class="text-list">
                <li><a href="https://calendar.nic.bc.ca/preview_course_nopop.php?catoid=24&coid=58386&_gl=1*1rt1o1t*_gcl_aw*R0NMLjE3NDY0ODUxNDUuQ2owS0NRand3LUhBQmhDR0FSSXNBTExPNlh4YjNYQ0F0X3FmcTZ6TkswYTF2Qk11c1Nkd0ZLdUMzdnJCX3ZoUU1hRWdqYmhIVE5RNk5MUWFBcFVIRUFMd193Y0I.*_gcl_au*MjEwNDQxMzU1OS4xNzQ3MzM1MzY3" target="_blank">DGL102 Graphic Design Foundations</a></li>
                <li><a href="https://calendar.nic.bc.ca/preview_course_nopop.php?catoid=24&coid=58390&_gl=1*1q7s5rf*_gcl_aw*R0NMLjE3NDY0ODUxNDUuQ2owS0NRand3LUhBQmhDR0FSSXNBTExPNlh4YjNYQ0F0X3FmcTZ6TkswYTF2Qk11c1Nkd0ZLdUMzdnJCX3ZoUU1hRWdqYmhIVE5RNk5MUWFBcFVIRUFMd193Y0I.*_gcl_au*MjEwNDQxMzU1OS4xNzQ3MzM1MzY3" target="_blank">DGL112 Typography</a></li>
                <li><a href="https://calendar.nic.bc.ca/preview_course_nopop.php?catoid=24&coid=58387&_gl=1*hmqpg7*_gcl_aw*R0NMLjE3NDY0ODUxNDUuQ2owS0NRand3LUhBQmhDR0FSSXNBTExPNlh4YjNYQ0F0X3FmcTZ6TkswYTF2Qk11c1Nkd0ZLdUMzdnJCX3ZoUU1hRWdqYmhIVE5RNk5MUWFBcFVIRUFMd193Y0I.*_gcl_au*MjEwNDQxMzU1OS4xNzQ3MzM1MzY3" target="_blank">DGL103 HTML/CSS</a></li>
                <li><a href="https://calendar.nic.bc.ca/preview_course_nopop.php?catoid=24&coid=58389&_gl=1*1q7s5rf*_gcl_aw*R0NMLjE3NDY0ODUxNDUuQ2owS0NRand3LUhBQmhDR0FSSXNBTExPNlh4YjNYQ0F0X3FmcTZ6TkswYTF2Qk11c1Nkd0ZLdUMzdnJCX3ZoUU1hRWdqYmhIVE5RNk5MUWFBcFVIRUFMd193Y0I.*_gcl_au*MjEwNDQxMzU1OS4xNzQ3MzM1MzY3" target="_blank">DGL111 UI/UX Design</a></li>
                <li><a href="https://calendar.nic.bc.ca/preview_course_nopop.php?catoid=24&coid=59375&_gl=1*pf1lv2*_gcl_aw*R0NMLjE3NDY0ODUxNDUuQ2owS0NRand3LUhBQmhDR0FSSXNBTExPNlh4YjNYQ0F0X3FmcTZ6TkswYTF2Qk11c1Nkd0ZLdUMzdnJCX3ZoUU1hRWdqYmhIVE5RNk5MUWFBcFVIRUFMd193Y0I.*_gcl_au*MjEwNDQxMzU1OS4xNzQ3MzM1MzY3" target="_blank">DGL233 Advanced WordPress Development</a></li>
                <li><a href="https://calendar.nic.bc.ca/preview_course_nopop.php?catoid=24&coid=58397&_gl=1*pf1lv2*_gcl_aw*R0NMLjE3NDY0ODUxNDUuQ2owS0NRand3LUhBQmhDR0FSSXNBTExPNlh4YjNYQ0F0X3FmcTZ6TkswYTF2Qk11c1Nkd0ZLdUMzdnJCX3ZoUU1hRWdqYmhIVE5RNk5MUWFBcFVIRUFMd193Y0I.*_gcl_au*MjEwNDQxMzU1OS4xNzQ3MzM1MzY3" target="_blank">DGL209 Capstone Project</a></li>
            </ul>


            <p>
                Courses are 13 weeks long and delivered either face-to-face (one
                4-hour class per week) or asynchronously online. I typically
                teach 60 to 80 students per term, in classes of about 20. Students
                vary widely in age, experience, and cultural background, and I
                design my instruction to support this diversity.
            </p>

            <p>
                Learn more about the DGL program area:
                <a
                    href="https://learndigital.dev"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="text-link">learndigital.dev</a>
            </p>
        </section>

        <!-- Teaching Philosophy Section -->
        <section
            id="teaching-philosophy" class="teaching-toc-section"
            aria-labelledby="philosophy-heading">
            <h2 class="section-label">
                Teaching Philosophy
            </h2>

            <h3 class="text-heading-3">From the Ground Up</h3>
            <p>
                I began teaching in 2018 and became full-time faculty in 2019.
                Over the next five years, I completed the Provincial Instructor
                Diploma Program (PIDP), intentionally pacing the coursework to
                apply each concept thoughtfully in the classroom.
            </p>
            <p>
                The PIDP profoundly shaped my teaching. Starting with no
                inherited materials and no textbook gave me the opportunity to
                design every course from the ground up—integrating best
                practices from the start. I incorporated tools like DACUM
                analysis, BOPPPS lesson planning, learning outcomes, rubrics,
                and feedback strategies directly into my curriculum.
            </p>
            <h3 class="text-heading-3">
                Real-world learning, one layer at a time
            </h3>
            <p>
                Each course I design is clear, purposeful, and rooted in
                real-world relevance and evidence-based learning theory. My
                courses prioritize practice over high-stakes assessments.
                Students develop meaningful projects that reflect industry
                workflows and standards—projects they can carry into portfolios
                and professional contexts. Assessment is mostly formative and
                iterative, students receive frequent, specific feedback from
                peers and from myself.
            </p>

            <h4 class="text-heading-4">Scaffolded for skill-building</h4>
            <p>
                Courses build progressively, with each week deepening prior
                learning. This scaffolding supports skill development within
                Vygotsky's Zone of Proximal Development (1978), helping students
                gradually gain confidence and independence. Projects are
                cumulative to support deeper learning and aligns with research
                showing that authentic, progressively structured tasks with
                instructor coaching at critical times, enhances real-world
                transfer (Herrington & Oliver, 2000).
            </p>

            <h4 class="text-heading-4">Varied assessment strategies</h4>
            <p>
                Assessment in my courses is designed to promote continuous
                learning, not just measure it, and combines a mix of:
            </p>
            <ul>
                <li>
                    <strong>Low-stakes formative assessments:</strong> weekly
                    quizzes and in-class exercises
                </li>
                <li>
                    <strong>Medium-stakes summative tasks:</strong> unit exams and
                    authentic projects
                </li>
            </ul>
            <p>
                This approach aligns with Black and Wiliam's (1998) findings
                that regular, varied assessment with feedback improves learning
                outcomes. By diversifying formats and pacing evaluation over
                time, I support accessibility, offering multiple ways for
                students to demonstrate understanding and build confidence.
            </p>
            <p>
                Grades are required, but they're not the driver. Inspired by
                ungrading models, I strive to make evaluation transparent,
                flexible, and rooted in growth and self-reflection. Students
                engage in peer critique, use rubrics for self-assessment, and
                reflect on their learning journey throughout the term.
            </p>



            <h4 class="text-heading-4">Industry-responsive curriculum</h4>
            <p>
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

            <h4 class="text-heading-4">
                Course cadence: Predictable patterns that support learning
            </h4>

            <h5 class="text-heading-4">Weekly Rhythm</h5>
            <p>
                A consistent weekly rhythm supports self-regulation and reduces
                cognitive load, helping students build confidence and
                competence. Research in Universal Design for Learning (UDL) and
                cognitive psychology highlights how predictable structures
                support diverse learning styles, promotes time management, and
                reinforces key concepts (CAST, 2018; Sweller, 1988).
            </p>

            <p>
                A typical structure for an in-person module (2-3 weeks):
            </p>

            <div class="course-structure">
                <div class="structure-item">
                    <h6 class="text-heading-4">Before Class (Flipped Model):</h6>
                    <ul>
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
                    <ul>
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
                    <p>
                        Students finish any outstanding activities and continue
                        working on their unit-long project.
                    </p>
                </div>
            </div>

            <h5 class="text-heading-4">Monthly Milestones</h5>
            <p>
                Courses are typically organized into three or four 4–6-week
                units, each unit corresponding to a different topic or level of
                complexity. Units conclude with:
            </p>
            <ul>
                <li>A project submission</li>
                <li>
                    A self-reflection to foster metacognition and knowledge
                    transfer. This reflection is sometimes combined with the
                    project rubric for self-evaluation and might also include
                    student feedback questions.
                </li>
                <li>A short unit exam</li>
            </ul>
            <p>
                This modular structure promotes focus, autonomy, and skill
                integration over time, encouraging learners to grow with
                confidence.
            </p>
        </section>

        <!-- Teaching Strategies & Excellence Section -->
        <section
            id="teaching-strategies"
            aria-labelledby="strategies-heading">
            <h2 class="text-heading-2">
                Teaching Strategies & Excellence
            </h2>
            <h3 class="text-heading-3">
                Technology-enabled and pedagogy-first
            </h3>
            <p>
                Whether delivered face-to-face or asynchronously online, my
                courses maintain consistent learning outcomes and expectations.
                I tailor activities to each delivery mode to build community and
                ensure equitable access to support, feedback, and peer learning.
            </p>

            <h4 class="text-heading-4">UX-informed environment</h4>
            <p>
                Drawing on my background as a professional UX designer, I apply
                human-centered design principles and usability heuristics
                (Norman, 2013; Nielsen, 1994) to every digital interaction. My
                learning materials are designed to be visually clear,
                cognitively accessible, and aligned with how students actually
                engage with content online.
            </p>
            <p>
                My approach to educational technology is pedagogy-first, not
                tool-first. The digital learning environments I design are
                purpose-built to:
            </p>
            <ul>
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
            <p>
                Although I experiment with interactive content tools like H5P, I
                prioritize agile, update-friendly content that can evolve with
                industry trends and technologies.
            </p>

            <h4 class="text-heading-4">
                Authentic tools, balanced integration
            </h4>
            <p>
                I incorporate professional platforms to introduce students to
                authentic, real-world workflows.
            </p>
            <ul>
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
            <p>
                At the same time, I am mindful of interface overload. There is a
                careful balance to strike between expanding students' digital
                versatility and ensuring they are not overwhelmed by too many
                tools or logins.
            </p>
            <p>
                While I prefer tools hosted in Canada for privacy and security
                reasons, I carefully weigh these considerations against the
                value of teaching industry-standard workflows.
            </p>

            <h4 class="text-heading-4">A creative gap in tech</h4>
            <p>
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
            <p>
                Student Portfolio discussion – issue was raised that
                articulation agreements and transfers via the TCS platform do
                not provide an option for student portfolio reviews
            </p>

            <h4 class="text-heading-4">Networked learning</h4>
            <p>
                Beyond collaborative assignments, I use technology to build
                authentic, connected learning communities, and foster student
                connection and inclusion across modes of delivery:
            </p>
            <ul>
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
            <p>
                These practices are aligned with the Community of Inquiry (CoI)
                framework, which emphasizes the interplay between social,
                cognitive, and teaching presence as central to inclusive,
                high-quality online learning (Garrison, Anderson, & Archer,
                2000).
            </p>

            <h3 class="text-heading-3">Inclusive Education</h3>

            <h4 class="text-heading-4">Designing for all students</h4>
            <p>
                My courses are built around the learner experience. North Island
                College attracts a diverse student population, including many
                international students and learners with varied digital fluency,
                goals, and life responsibilities. In response, I use strategies
                inspired by Universal Design for Learning (UDL) (CAST, 2018):
            </p>
            <ul>
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
            <p>
                Students are encouraged to shape their learning journeys. I
                create room for autonomy while providing structure and ongoing
                support.
            </p>
            Going forward its difficult to upgrade and let students lead their educational journey by deciding to focus on coding one month  but faculty is expected to grade design… how do you lead  when the structure doesn’t promote effective and modern teaching strategies? Difficult because the political and social structures that school sit in can’t change fast.
            Also french multidisciplinary projects…

            <h4 class="text-heading-4">Value-Based Education</h4>
            <p>
                Many of my assignments connect directly to real-world issues. I
                invite students to align their work with the UN Sustainable
                Development Goals, supporting civic engagement and personal
                meaning-making in their projects.
            </p>
            <p>
                I actively work to create inclusive and safe learning
                environments, both in-person and online. My teaching materials
                include diverse perspectives, and students are given voice and
                choice wherever possible.
            </p>

            <h4 class="text-heading-4">Indigenization</h4>
            <p>
                Indigenization is an ongoing responsibility in Canadian
                post-secondary education and I recognize that I have a lot of
                progress to make in this area. I feel that by prioritizing
                respect, self-expression and agency in my classes, I have
                implemented pedagogical approaches that foster a deeper
                understanding and appreciation of different cultures and ways of
                knowing.
            </p>
            <p>
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
        </section>

        <!-- Educational Leadership Section -->
        <section
            id="educational-leadership"
            aria-labelledby="leadership-heading">
            <h2 id="leadership-heading" class="text-heading-2">
                Educational Leadership
            </h2>


            <h3 class="text-heading-3">
                Contributing to educational leadership
            </h3>
            <ul>
                <li>Grad Show, marketing, department website</li>
                <li>French partnership, hiring committees</li>
                <li>NICFA</li>
            </ul>
        </section>

        <!-- Future Growth Section -->
        <section
            id="future-growth"
            aria-labelledby="growth-heading">
            <h2 class="text-heading-2">Future Growth</h2>


            <h3 class="text-heading-3">Next Steps in teaching & learning</h3>

            <h4 class="text-heading-4">
                Iterative and feedback-informed improvements
            </h4>
            <p>
                I approach teaching as a design process: research, prototype,
                test, and iterate. Student feedback is built into my practice at
                multiple levels:
            </p>
            <ul>
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
            <p>
                This iterative approach ensures that my teaching remains
                responsive, inclusive, and aligned with evolving industry
                practice.
            </p>

            <h4 class="text-heading-4">
                Industry work as professional development
            </h4>
            <h4 class="text-heading-4">Further education</h4>
            <h4 class="text-heading-4">Professional areas of interest</h4>

        </section>


        <?php get_footer(); ?>