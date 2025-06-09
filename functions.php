<?php

add_action('after_setup_theme', 'teaching_portfolio_setup');
function teaching_portfolio_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(
        array(
            'header' => __('Display this menu in the header', 'teaching-portfolio'),
            'footer' => __('Display this menu in the footer', 'teaching-portfolio'),
        )
    );
}


add_action('wp_enqueue_scripts', 'teaching_portfolio_scripts');
function teaching_portfolio_scripts()
{
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
}
