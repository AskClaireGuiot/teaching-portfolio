<?php
/* The header
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <!-- Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Post-secondary Instructor and Designer portfolio showcasing instructional and UX design work.">
    <meta name="author" content="Claire Guiot">
    <meta name="keywords" content="instructor, designer, teaching, portfolio, education">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Claire Guiot - Teaching Portfolio">
    <meta property="og:description" content="Post-secondary Instructor and Designer portfolio showcasing instructional and UX design work.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="/og-image.jpg">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Claire Guiot - Teaching Portfolio">
    <meta name="twitter:description" content="Post-secondary Instructor and Designer portfolio showcasing instructional and UX design work.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300..900;1,14..32,300..900&family=Kalam:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <!-- Header Navigation -->
    <header class="header" role="banner">
        <!-- Skip Link for Screen Readers -->
        <a class="screen-reader-text skip-link" href="#main-content">Skip to content</a>
        <nav class="nav" role="navigation" aria-label="Main navigation">
            <div class="nav-container">
                <!-- Logo/Brand -->
                <div class="brand">
                    <a href="/" class="brand-link" aria-label="Claire Guiot - Home">
                        <h1 class="brand-name"><?= get_bloginfo('name') ?></h1>
                        <p class="brand-tagline"><?= get_bloginfo('description') ?></p>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="menu-toggle" aria-expanded="false" aria-controls="main-menu" aria-label="Toggle main menu">
                    <span class="menu-toggle-icon"></span>
                    <span class="menu-toggle-icon"></span>
                    <span class="menu-toggle-icon"></span>
                </button>

                <!-- Navigation Menu -->
                <!-- <ul class="nav-menu" id="main-menu" role="menubar">
                    <li role="none">
                        <a href="/" class="nav-link" role="menuitem">HOME</a>
                    </li>
                    <li role="none">
                        <a href="/teaching" class="nav-link" role="menuitem">TEACHING</a>
                    </li>
                    <li role="none">
                        <a href="/about" class="nav-link" role="menuitem">ABOUT</a>
                    </li>
                    <li role="none">
                        <a href="/contact" class="nav-link contact-link" role="menuitem"><span>CONTACT</span></a>
                    </li>
                </ul> -->
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'header',
                        'menu_class' => 'nav-menu',
                        'menu_id' => 'main-menu',
                    )
                );
                ?>
            </div>
        </nav>
    </header>