</main><!-- Close main element opened in header.php -->

<!-- Footer -->
<!-- CTA Section -->
<section class="cta" aria-labelledby="cta-heading">
    <div class="cta-container">
        <h2 class="text-heading-3">
            Have a course or a project? Need expertise? Let's chat.
        </h2>
        <a href="mailto:hello@claireguiot.com?subject=Let's get in contact" class="button">
            <span>Contact</span>
        </a>
    </div>
</section>
<footer class="footer" role="contentinfo">
    <div class="footer-container">
        <div class="footer-content">
            <p>
                <?php
                printf(
                    __('Copyright © %s %s', 'claire-portfolio'),
                    date('Y'),
                    get_bloginfo('name')
                );
                ?>
            </p>

            <p class="footer-disclaimer">
                Unless otherwise noted, contents on this website are released with a Creative Commons Attribution license meaning you are free to copy and reuse providing you credit me as the source of the content. I would also appreciate you reaching out to ask my permission.
            </p>
            <p>About the making of this website:</p>
            <p class="footer-disclaimer">
                <strong>The content</strong> for this website is 88% original with 12% Microsoft Copilot for editing suggestions only.
                <strong>The design</strong> was created manually using Figma (no AI).
                <strong>The coding</strong> of this website is an experiment, it was 60% vibe-coded using same.new, with significant manual clean up and adaptations for WP integration.
            </p>

        </div>

        <div class="footer-social">
            <?php
            // Check if we have a footer menu with social links
            if (has_nav_menu('footer')) {
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class' => 'footer-social-menu',
                    'container' => false,
                    'depth' => 1,
                    'items_wrap' => '%3$s', // Remove ul wrapper
                    'walker' => new Claire_Portfolio_Social_Nav_Walker()
                ));
            } else {
                // Fallback social links from customizer
                claire_portfolio_social_links();
            }
            ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>

<?php
/**
 * Display social links from customizer
 */
function claire_portfolio_social_links()
{
    $social_links = array(
        'linkedin' => get_theme_mod('linkedin_url', ''),
        'medium' => get_theme_mod('medium_url', ''),
        'dribbble' => get_theme_mod('dribbble_url', ''),
        'twitter' => get_theme_mod('twitter_url', ''),
        'instagram' => get_theme_mod('instagram_url', ''),
        'github' => get_theme_mod('github_url', '')
    );

    foreach ($social_links as $platform => $url) {
        if (!empty($url)) {
            $platform_name = ucfirst($platform);
            printf(
                '<a href="%s" class="social-link" aria-label="%s on %s" target="_blank" rel="noopener noreferrer">%s</a>',
                esc_url($url),
                esc_attr(get_bloginfo('name')),
                esc_attr($platform_name),
                esc_html(strtoupper($platform_name))
            );
        }
    }
}

/**
 * Custom Social Nav Walker
 */
class Claire_Portfolio_Social_Nav_Walker extends Walker_Nav_Menu
{

    // Start the list item
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $attributes = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        // Add external link attributes if URL is external
        if (!empty($item->url) && !str_starts_with($item->url, home_url())) {
            $attributes .= ' target="_blank" rel="noopener noreferrer"';
        }

        $item_output = '<a class="social-link"' . $attributes . '>';
        $item_output .= strtoupper(apply_filters('the_title', $item->title, $item->ID));
        $item_output .= '</a>';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    // Don't output list items
    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        // Do nothing - we don't want closing li tags
    }
}
