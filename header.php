<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fustat:wght@200..800&family=IBM+Plex+Sans+Condensed:ital,wght@0,500;1,500&family=Inter:opsz@14..32&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- Skip Link for Accessibility -->
    <a class="skip-link screen-reader-text" href="#main"><?php _e('Skip to content', 'claire-portfolio'); ?></a>

    <!-- Header Navigation -->
    <header class="header" role="banner">
        <nav class="nav" role="navigation" aria-label="<?php _e('Main navigation', 'claire-portfolio'); ?>">
            <div class="nav-container">
                <!-- Logo/Brand -->
                <div class="brand">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-link" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?> - <?php _e('Home', 'claire-portfolio'); ?>">
                            <h2 class="brand-name"><?php bloginfo('name'); ?></h2>
                            <?php
                            $tagline = get_bloginfo('description');
                            if ($tagline) : ?>
                                <p class="brand-tagline"><?php echo esc_html(strtoupper($tagline)); ?></p>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Mobile Menu Button -->
                <button class="menu-toggle" aria-expanded="false" aria-controls="main-menu" aria-label="<?php _e('Toggle main menu', 'claire-portfolio'); ?>">
                    <span class="menu-toggle-icon"></span>
                    <span class="menu-toggle-icon"></span>
                    <span class="menu-toggle-icon"></span>
                </button>

                <!-- Navigation Menu -->
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id' => 'main-menu',
                    'menu_class' => 'nav-menu',
                    'container' => false,
                    'items_wrap' => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
                    'fallback_cb' => 'claire_portfolio_fallback_menu',
                    'walker' => new Claire_Portfolio_Nav_Walker()
                ));
                ?>
            </div>
        </nav>
    </header>

    <main id="main" class="main" role="main"><?php
                                                /**
                                                 * Fallback menu when no menu is assigned
                                                 */
                                                function claire_portfolio_fallback_menu()
                                                {
                                                    echo '<ul class="nav-menu" id="main-menu" role="menubar">';
                                                    echo '<li role="none"><a href="' . esc_url(home_url('/')) . '" class="nav-link" role="menuitem">' . __('HOME', 'claire-portfolio') . '</a></li>';

                                                    // Check if Teaching page exists
                                                    $teaching_page = get_page_by_path('teaching');
                                                    if ($teaching_page) {
                                                        echo '<li role="none"><a href="' . esc_url(get_permalink($teaching_page)) . '" class="nav-link" role="menuitem">' . __('TEACHING', 'claire-portfolio') . '</a></li>';
                                                    }

                                                    // Check if About page exists
                                                    $about_page = get_page_by_path('about');
                                                    if ($about_page) {
                                                        echo '<li role="none"><a href="' . esc_url(get_permalink($about_page)) . '" class="nav-link" role="menuitem">' . __('ABOUT', 'claire-portfolio') . '</a></li>';
                                                    }

                                                    // Check if Contact page exists
                                                    $contact_page = get_page_by_path('contact');
                                                    if ($contact_page) {
                                                        echo '<li role="none"><a href="' . esc_url(get_permalink($contact_page)) . '" class="nav-link contact-link" role="menuitem"><span>' . __('CONTACT', 'claire-portfolio') . '</span></a></li>';
                                                    }

                                                    echo '</ul>';
                                                }

                                                /**
                                                 * Custom Nav Walker for accessibility
                                                 */
                                                class Claire_Portfolio_Nav_Walker extends Walker_Nav_Menu
                                                {

                                                    // Start the list item
                                                    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
                                                    {
                                                        $indent = ($depth) ? str_repeat("\t", $depth) : '';

                                                        $classes = empty($item->classes) ? array() : (array) $item->classes;
                                                        $classes[] = 'menu-item-' . $item->ID;

                                                        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
                                                        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

                                                        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
                                                        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

                                                        $output .= $indent . '<li' . $id . $class_names . ' role="none">';

                                                        $attributes = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
                                                        $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
                                                        $attributes .= ! empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
                                                        $attributes .= ! empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

                                                        // Add appropriate classes for styling
                                                        $link_classes = 'nav-link';
                                                        if (strpos(strtolower($item->title), 'contact') !== false) {
                                                            $link_classes .= ' contact-link';
                                                        }

                                                        $item_output = isset($args->before) ? $args->before : '';
                                                        $item_output .= '<a class="' . $link_classes . '" role="menuitem"' . $attributes . '>';

                                                        // Wrap contact link text in span for styling
                                                        if (strpos(strtolower($item->title), 'contact') !== false) {
                                                            $item_output .= '<span>' . (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '') . '</span>';
                                                        } else {
                                                            $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
                                                        }

                                                        $item_output .= '</a>';
                                                        $item_output .= isset($args->after) ? $args->after : '';

                                                        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
                                                    }
                                                }
