# Claire Guiot Portfolio - WordPress Theme

A modern, accessible WordPress portfolio theme featuring animated hero sections, interactive teaching materials, and responsive design. Built with performance and accessibility in mind.

## Features

- ✨ **Animated Hero Section** with typing animation and handwritten text
- 📱 **Fully Responsive** design that works on all devices
- ♿ **Accessibility Focused** with WCAG 2.1 compliance
- 🎯 **Interactive Teaching Page** with sticky table of contents
- 🎨 **Custom Post Types** for Projects and Teaching Materials
- 🔧 **Theme Customizer** integration for easy content management
- ⚡ **Performance Optimized** with minimal dependencies
- 🌐 **Translation Ready** with .pot file included

## Installation

### Option 1: Upload Theme Files
1. Download the theme files
2. Upload the `wp-theme` folder to `/wp-content/themes/`
3. Rename it to `claire-portfolio`
4. Activate the theme in WordPress Admin

### Option 2: Upload ZIP File
1. Create a ZIP file of the `wp-theme` directory
2. Go to WordPress Admin → Appearance → Themes
3. Click "Add New" → "Upload Theme"
4. Upload the ZIP file and activate

## Setup Requirements

### Required Plugins
- **Advanced Custom Fields (ACF)** - For flexible content management
- **Classic Editor** (optional) - If you prefer the classic editor

### Recommended Plugins
- **Yoast SEO** - For enhanced SEO capabilities
- **W3 Total Cache** - For performance optimization
- **Wordfence Security** - For security enhancement

## Initial Setup

### 1. Configure Menus
1. Go to **Appearance → Menus**
2. Create a "Primary Menu" and assign it to "Primary Menu" location
3. Create a "Footer Menu" for social links and assign it to "Footer Menu" location

### 2. Set Up Pages
Create the following pages for optimal functionality:
- **Home** (set as static front page)
- **Teaching** (will use the special teaching template)
- **About**
- **Contact**

### 3. Configure Reading Settings
1. Go to **Settings → Reading**
2. Set "Your homepage displays" to "A static page"
3. Choose your Home page as the homepage

### 4. Customize Content
1. Go to **Appearance → Customize**
2. Configure the following sections:
   - **Hero Section** - Main title, roles, and background video
   - **Mission Section** - Mission statement and tags
   - **Teaching Section** - Teaching content settings
   - **Call to Action** - CTA text and links
   - **Footer** - Footer text and social media links

## Content Structure

### Custom Post Types

#### Projects
- **Purpose**: Portfolio items and case studies
- **Features**:
  - Featured images
  - Project categories and tags
  - Custom fields for project details
- **Archive**: `/project/` (displays all projects)
- **Single**: Custom template for individual projects

#### Teaching Materials
- **Purpose**: Educational content and resources
- **Features**:
  - Featured materials system
  - Icon selection for materials
  - Integration with teaching page
- **Archive**: `/teaching/` (displays all materials)

### Special Page Templates

#### Teaching Page (`page-teaching.php`)
- **Auto-generated Table of Contents** from page headings
- **Sticky navigation** that follows scroll
- **Mobile-optimized** collapsible TOC
- **Accessibility features** for keyboard navigation

#### Front Page (`front-page.php`)
- **Hero section** with typing animation
- **Mission statement** section
- **Teaching materials** preview
- **Call-to-action** section

## Customization

### Theme Customizer Options

#### Hero Section
- **Hero Title**: Main text for typing animation
- **Hero Roles**: Comma-separated roles for animation cycle
- **Background Video**: URL to MP4 video file

#### Mission Section
- **Mission Title**: Main heading text
- **Mission Text**: Descriptive paragraphs (HTML allowed)
- **Mission Tags**: Comma-separated tags

#### Teaching Section
- **Section Title**: Main heading
- **Introduction**: Descriptive text

#### Call to Action
- **CTA Text**: Main call-to-action heading

#### Footer
- **Footer Text**: Custom footer text (overrides default)
- **Social Media URLs**: LinkedIn, Medium, Dribbble, Twitter, Instagram, GitHub

### CSS Customization

The theme imports the existing `styles.css` file, maintaining all original styling. To customize:

1. **Child Theme** (Recommended): Create a child theme for custom modifications
2. **Additional CSS**: Use Appearance → Customize → Additional CSS
3. **File Editing**: Modify `style.css` or `assets/css/styles.css`

### JavaScript Functionality

All original JavaScript functionality is preserved:
- **Modular architecture** with organized modules
- **Animation system** with device-specific optimizations
- **Accessibility features** with keyboard navigation
- **Performance optimization** with device detection

## Development

### File Structure
```
claire-portfolio/
├── style.css                 # Theme header and imports
├── index.php                 # Main template fallback
├── front-page.php            # Homepage template
├── page.php                  # Default page template
├── page-teaching.php         # Teaching page template
├── header.php                # Header template
├── footer.php                # Footer template
├── functions.php             # Theme functionality
├── assets/                   # Copied from original
│   ├── css/styles.css
│   └── js/modules/
├── public/                   # Media assets
└── README.md                # This file
```

### Custom Functions

#### Navigation
- **Custom Nav Walker**: Maintains accessibility and styling
- **Fallback Menus**: Automatic menu generation when none assigned

#### Content Processing
- **Heading ID Generation**: Automatic IDs for TOC navigation
- **Content Filtering**: Processes content for enhanced functionality

#### Customizer Integration
- **Sanitization**: Proper input sanitization for all options
- **Dynamic Content**: Theme options integrate with templates

## Browser Support

- **Chrome** 80+
- **Firefox** 75+
- **Safari** 13+
- **Edge** 80+
- **Mobile browsers** (iOS Safari, Chrome Mobile)

## Accessibility Features

- **WCAG 2.1 AA** compliance
- **Keyboard navigation** support
- **Screen reader** optimization
- **Focus management** for interactive elements
- **Semantic HTML** structure
- **ARIA labels** and descriptions

## Performance Features

- **Optimized animations** with device detection
- **Lazy loading** compatible
- **Minimal dependencies** (no jQuery required)
- **Efficient asset loading**
- **Caching friendly**

## SEO Features

- **Semantic HTML5** structure
- **Schema markup** ready
- **Open Graph** meta tags
- **Twitter Card** support
- **Sitemap** friendly
- **Fast loading** for better rankings

## Support & Documentation

### Getting Help
1. Check this README for common setup issues
2. Review the WordPress Codex for general WordPress questions
3. Test with default content to isolate theme-specific issues

### Troubleshooting

#### Animations Not Working
- Ensure JavaScript is enabled
- Check for JavaScript errors in browser console
- Verify theme files are properly uploaded

#### Menu Not Showing
- Assign menu to "Primary Menu" location in Appearance → Menus
- Ensure menu items are published and visible

#### Customizer Changes Not Saving
- Check user permissions
- Clear any caching plugins
- Try with other themes to isolate issue

## License

This theme is licensed under the GPL v2 or later.

## Credits

- **Theme Development**: Claire Guiot
- **Icons**: Material Icons by Google
- **Fonts**: Inter and Kalam from Google Fonts

## Changelog

### Version 1.0.0
- Initial WordPress theme conversion
- Full functionality preservation from static site
- Theme customizer integration
- Custom post types implementation
- Accessibility enhancements
- Performance optimizations
