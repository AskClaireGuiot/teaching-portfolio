<?php

/**
 * Claire Guiot Portfolio Theme Functions
 *
 * @package Claire_Portfolio
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function claire_portfolio_setup()
{
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style'
    ));
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'claire-portfolio'),
        'footer' => __('Footer Menu', 'claire-portfolio')
    ));

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true
    ));
}
add_action('after_setup_theme', 'claire_portfolio_setup');

/**
 * Enqueue Scripts and Styles
 */
function claire_portfolio_scripts()
{
    $theme_version = wp_get_theme()->get('Version');

    // Enqueue Google Fonts
    wp_enqueue_style(
        'claire-portfolio-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300..900;1,14..32,300..900&family=Kalam:wght@300;400;700&display=swap',
        array(),
        null
    );

    // Enqueue Material Icons
    wp_enqueue_style(
        'claire-portfolio-material-icons',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined',
        array(),
        null
    );

    // Enqueue main stylesheet
    wp_enqueue_style(
        'claire-portfolio-style',
        get_template_directory_uri() . '/assets/css/styles.css',
        array('claire-portfolio-fonts', 'claire-portfolio-material-icons'),
        $theme_version
    );

    // Enqueue main JavaScript modules
    wp_enqueue_script(
        'claire-portfolio-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        $theme_version,
        true
    );

    // Localize script for AJAX
    wp_localize_script('claire-portfolio-main', 'clairePortfolio', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('claire_portfolio_nonce'),
        'themeUrl' => get_template_directory_uri()
    ));
}
add_action('wp_enqueue_scripts', 'claire_portfolio_scripts');

/**
 * Add module type to main script for ES6 imports
 */
function claire_portfolio_add_module_type($tag, $handle)
{
    if ('claire-portfolio-main' === $handle) {
        return str_replace('<script ', '<script type="module" ', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'claire_portfolio_add_module_type', 10, 2);

/**
 * Add Custom Image Sizes
 */
function claire_portfolio_image_sizes()
{
    add_image_size('hero-image', 1200, 800, true);
    add_image_size('featured-large', 900, 450, true);
    add_image_size('thumbnail-medium', 400, 300, true);
}
add_action('after_setup_theme', 'claire_portfolio_image_sizes');

// hide admin bar wehne logged in
function remove_admin_bar()
{
    return false;
}
add_filter('show_admin_bar', 'remove_admin_bar');

/**
 * Add Theme Customizer Options
 */
function claire_portfolio_customize_register($wp_customize)
{
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title' => __('Hero Section', 'claire-portfolio'),
        'priority' => 30
    ));

    // Hero Title
    $wp_customize->add_setting('hero_title', array(
        'default' => 'Hello, my name is Claire. I am an instructor',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('hero_title', array(
        'label' => __('Hero Title', 'claire-portfolio'),
        'section' => 'hero_section',
        'type' => 'text'
    ));

    // Hero Roles (comma-separated)
    $wp_customize->add_setting('hero_roles', array(
        'default' => 'an instructor, a designer, a developer',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('hero_roles', array(
        'label' => __('Hero Roles (comma-separated)', 'claire-portfolio'),
        'section' => 'hero_section',
        'type' => 'text'
    ));

    // Hero Video URL
    $wp_customize->add_setting('hero_video_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('hero_video_url', array(
        'label' => __('Hero Background Video URL', 'claire-portfolio'),
        'section' => 'hero_section',
        'type' => 'url'
    ));

    // Mission Section
    $wp_customize->add_section('mission_section', array(
        'title' => __('Mission Section', 'claire-portfolio'),
        'priority' => 31
    ));

    // Mission Title
    $wp_customize->add_setting('mission_title', array(
        'default' => 'Meaningful, human-centered learning experiences across physical and digital spaces',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('mission_title', array(
        'label' => __('Mission Title', 'claire-portfolio'),
        'section' => 'mission_section',
        'type' => 'textarea'
    ));

    // Mission Text
    $wp_customize->add_setting('mission_text', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('mission_text', array(
        'label' => __('Mission Text (leave empty for default)', 'claire-portfolio'),
        'section' => 'mission_section',
        'type' => 'textarea'
    ));

    // Mission Tags
    $wp_customize->add_setting('mission_tags', array(
        'default' => 'STRATEGY,CONTENT,CREATIVITY,TECHNOLOGY',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('mission_tags', array(
        'label' => __('Mission Tags (comma-separated)', 'claire-portfolio'),
        'section' => 'mission_section',
        'type' => 'text'
    ));

    // Teaching Section
    $wp_customize->add_section('teaching_section', array(
        'title' => __('Teaching Section', 'claire-portfolio'),
        'priority' => 32
    ));

    // Teaching Section Title
    $wp_customize->add_setting('teaching_section_title', array(
        'default' => 'Creating connected learning communities',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('teaching_section_title', array(
        'label' => __('Teaching Section Title', 'claire-portfolio'),
        'section' => 'teaching_section',
        'type' => 'text'
    ));

    // Teaching Intro
    $wp_customize->add_setting('teaching_intro', array(
        'default' => 'I collaborate with educational institutions to develop strategic, human-centered approaches to teaching and learning that bridge traditional and digital environments.',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('teaching_intro', array(
        'label' => __('Teaching Introduction', 'claire-portfolio'),
        'section' => 'teaching_section',
        'type' => 'textarea'
    ));

    // CTA Section
    $wp_customize->add_section('cta_section', array(
        'title' => __('Call to Action', 'claire-portfolio'),
        'priority' => 33
    ));

    // CTA Text
    $wp_customize->add_setting('cta_text', array(
        'default' => 'Ready to collaborate?',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('cta_text', array(
        'label' => __('CTA Text', 'claire-portfolio'),
        'section' => 'cta_section',
        'type' => 'text'
    ));

    // Footer Section
    $wp_customize->add_section('footer_section', array(
        'title' => __('Footer', 'claire-portfolio'),
        'priority' => 34
    ));

    // Footer Text
    $wp_customize->add_setting('footer_text', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('footer_text', array(
        'label' => __('Footer Text (leave empty for default)', 'claire-portfolio'),
        'section' => 'footer_section',
        'type' => 'textarea'
    ));

    // Social Links
    $social_platforms = array('linkedin', 'medium', 'dribbble', 'twitter', 'instagram', 'github');

    foreach ($social_platforms as $platform) {
        $wp_customize->add_setting($platform . '_url', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        ));

        $wp_customize->add_control($platform . '_url', array(
            'label' => sprintf(__('%s URL', 'claire-portfolio'), ucfirst($platform)),
            'section' => 'footer_section',
            'type' => 'url'
        ));
    }
}
add_action('customize_register', 'claire_portfolio_customize_register');


function my_html_shortcode($atts)
{
    // Define default attributes and merge with user-defined attributes
    $atts = shortcode_atts(
        array(
            'file' => 'canada-pse-crisis.html', // Default HTML file
            'path' => get_stylesheet_directory() . '/', // Default path
        ),
        $atts,
        'my_html'
    );

    $file_path = $atts['path'] . $atts['file'];

    // Check if the file exists and is readable
    if (file_exists($file_path) && is_readable($file_path)) {
        ob_start(); // Start output buffering
        include $file_path; // Include the HTML file
        return ob_get_clean(); // Return the buffered content
    } else {
        return '<!-- HTML file not found or not readable: ' . esc_html($file_path) . ' -->';
    }
}
add_shortcode('my_html', 'my_html_shortcode');


/**
 * Body Classes
 */
function claire_portfolio_body_classes($classes)
{
    // Add class for JavaScript support
    $classes[] = 'js-enabled';

    // Add class for touch devices
    if (wp_is_mobile()) {
        $classes[] = 'touch-device';
    }

    return $classes;
}
add_filter('body_class', 'claire_portfolio_body_classes');

/**
 * Admin Enqueue Scripts
 */
function claire_portfolio_admin_scripts()
{
    // Add any admin-specific scripts here
}
add_action('admin_enqueue_scripts', 'claire_portfolio_admin_scripts');

/**
 * Security enhancements
 */
function claire_portfolio_security()
{
    // Remove WordPress version from head
    remove_action('wp_head', 'wp_generator');

    // Remove WLW manifest link
    remove_action('wp_head', 'wlwmanifest_link');

    // Remove RSD link
    remove_action('wp_head', 'rsd_link');
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'claire_portfolio_security');
