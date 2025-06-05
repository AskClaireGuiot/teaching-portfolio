# WordPress Block Theme Conversion Guide

## Overview
This guide explains how to convert our vanilla HTML/CSS/JS portfolio into a modern WordPress Block Theme (Full Site Editing).

## WordPress Block Theme Structure

```
wp-content/themes/claire-portfolio/
├── style.css                     # Main theme stylesheet
├── functions.php                 # Theme functions and enqueues
├── theme.json                    # Design system configuration
├── index.php                     # Fallback template
├── templates/
│   ├── index.html               # Homepage template
│   ├── single.html              # Single post template
│   ├── page.html                # Page template
│   └── archive.html             # Archive template
├── parts/
│   ├── header.html              # Header template part
│   ├── footer.html              # Footer template part
│   └── navigation.html          # Navigation template part
├── patterns/
│   ├── hero-section.php         # Hero section pattern
│   └── navigation-header.php    # Header navigation pattern
└── assets/
    ├── css/
    │   └── theme.css           # Additional theme styles
    └── js/
        └── theme.js            # Theme JavaScript
```

## Conversion Steps

### 1. Theme.json Configuration
Convert our CSS custom properties to WordPress design tokens:

```json
{
  "version": 2,
  "settings": {
    "color": {
      "palette": [
        {
          "color": "#fbfbfb",
          "name": "Background",
          "slug": "background"
        },
        {
          "color": "#1d1d1d",
          "name": "Text Primary",
          "slug": "text-primary"
        },
        {
          "color": "#72b4b2",
          "name": "Accent",
          "slug": "accent"
        },
        {
          "color": "#7c7c7c",
          "name": "Text Secondary",
          "slug": "text-secondary"
        }
      ]
    },
    "typography": {
      "fontFamilies": [
        {
          "fontFamily": "'Inter', sans-serif",
          "name": "Inter",
          "slug": "inter"
        }
      ],
      "fontSizes": [
        {
          "size": "0.875rem",
          "slug": "small"
        },
        {
          "size": "1rem",
          "slug": "medium"
        },
        {
          "size": "1.25rem",
          "slug": "large"
        },
        {
          "size": "2.25rem",
          "slug": "x-large"
        }
      ]
    },
    "spacing": {
      "units": ["px", "em", "rem", "vh", "vw", "%"],
      "spacingSizes": [
        {
          "size": "0.5rem",
          "slug": "small"
        },
        {
          "size": "1rem",
          "slug": "medium"
        },
        {
          "size": "2rem",
          "slug": "large"
        },
        {
          "size": "4rem",
          "slug": "x-large"
        }
      ]
    }
  }
}
```

### 2. Template Conversion

#### templates/index.html
```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"80px"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:80px">

    <!-- wp:pattern {"slug":"claire-portfolio/hero-section"} /-->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

#### parts/header.html
```html
<!-- wp:group {"style":{"position":{"type":"fixed"},"spacing":{"padding":{"top":"0","bottom":"0"}}},"backgroundColor":"background","className":"site-header","layout":{"type":"flex","justifyContent":"space-between"}} -->
<div class="wp-block-group site-header has-background-background-color has-background">

    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
    <div class="wp-block-group">
        <!-- wp:site-title {"level":1,"fontSize":"large","style":{"color":{"text":"var:preset|color|text-primary"}}} /-->
        <!-- wp:paragraph {"fontSize":"small","style":{"color":{"text":"var:preset|color|accent"},"typography":{"textTransform":"uppercase","letterSpacing":"0.1em"}}} -->
        <p class="has-small-font-size" style="color:var(--wp--preset--color--accent);text-transform:uppercase;letter-spacing:0.1em">INSTRUCTOR / DESIGNER</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->

    <!-- wp:navigation {"ref":123,"layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"right"}} /-->

</div>
<!-- /wp:group -->
```

### 3. Block Patterns

#### patterns/hero-section.php
```php
<?php
/**
 * Title: Hero Section
 * Slug: claire-portfolio/hero-section
 * Categories: header
 * Description: Main hero section with typing animation
 */
?>

<!-- wp:group {"style":{"spacing":{"padding":{"top":"6rem","bottom":"6rem"},"margin":{"top":"0","bottom":"0"}},"minHeight":"calc(100vh - 80px)"},"layout":{"type":"constrained","justifyContent":"center","contentSize":"800px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:6rem;padding-bottom:6rem;min-height:calc(100vh - 80px)">

    <!-- wp:heading {"textAlign":"center","level":2,"fontSize":"x-large","style":{"typography":{"fontWeight":"300","lineHeight":"1.75"},"color":{"text":"var:preset|color|text-primary"}}} -->
    <h2 class="wp-block-heading has-text-align-center has-text-primary-color has-text-color has-x-large-font-size" style="font-weight:300;line-height:1.75">
        <span class="hero-intro">Hello, my name is Claire. I am an instructor</span>
        <span class="hero-cursor" aria-hidden="true">|</span>
    </h2>
    <!-- /wp:heading -->

</div>
<!-- /wp:group -->
```

### 4. Functions.php Setup

```php
<?php
/**
 * Claire Portfolio Theme Functions
 */

// Enqueue theme styles and scripts
function claire_portfolio_enqueue_assets() {
    // Enqueue Google Fonts
    wp_enqueue_style(
        'claire-portfolio-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300..900;1,14..32,300..900&display=swap',
        array(),
        null
    );

    // Enqueue theme styles
    wp_enqueue_style(
        'claire-portfolio-style',
        get_stylesheet_uri(),
        array('claire-portfolio-fonts'),
        wp_get_theme()->get('Version')
    );

    // Enqueue theme JavaScript
    wp_enqueue_script(
        'claire-portfolio-script',
        get_template_directory_uri() . '/assets/js/theme.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'claire_portfolio_enqueue_assets');

// Add theme support
function claire_portfolio_setup() {
    // Add support for block styles
    add_theme_support('wp-block-styles');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for wide and full alignment
    add_theme_support('align-wide');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-width'  => true,
        'flex-height' => true,
    ));
}
add_action('after_setup_theme', 'claire_portfolio_setup');

// Register block patterns
function claire_portfolio_register_patterns() {
    register_block_pattern_category(
        'claire-portfolio',
        array('label' => __('Claire Portfolio', 'claire-portfolio'))
    );
}
add_action('init', 'claire_portfolio_register_patterns');
```

### 5. Style.css Header

```css
/*
Theme Name: Claire Portfolio
Description: A clean, accessible portfolio theme for instructors and designers
Version: 1.0.0
Author: Your Name
Text Domain: claire-portfolio
Requires at least: 6.0
Tested up to: 6.4
Requires PHP: 8.0
License: GPL v2 or later
*/

/* Import our main styles */
@import url('./assets/css/theme.css');
```

### 6. JavaScript Integration

The JavaScript from `src/script.js` will be moved to `assets/js/theme.js` with WordPress-specific enhancements:

```javascript
// Add WordPress-specific event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Initialize only after WordPress admin bar is loaded
    if (document.querySelector('#wpadminbar')) {
        // Adjust header offset for admin bar
        document.documentElement.style.setProperty('--wp-admin-bar-height', '32px');
    }

    // Initialize our portfolio app
    const app = new PortfolioApp();
});
```

## Migration Checklist

- [ ] Create theme.json with design tokens
- [ ] Convert HTML structure to block templates
- [ ] Create template parts (header, footer, navigation)
- [ ] Set up block patterns for reusable sections
- [ ] Configure functions.php with proper enqueues
- [ ] Test with WordPress 6.4+
- [ ] Validate accessibility with WordPress guidelines
- [ ] Test with various block editor features
- [ ] Optimize for WordPress performance
- [ ] Create child theme for customizations

## Benefits of This Approach

1. **Clean Separation**: Vanilla code provides clear structure
2. **Performance**: No framework bloat, optimized for WordPress
3. **Accessibility**: WCAG 2.1 AA compliance maintained
4. **Maintainability**: Easy to debug and modify
5. **Future-Proof**: Aligns with WordPress FSE direction
6. **Flexibility**: Easy to create variations and child themes

## Next Steps

1. Test current vanilla implementation thoroughly
2. Create WordPress development environment
3. Begin systematic conversion following this guide
4. Test each component in WordPress context
5. Optimize for WordPress-specific features
