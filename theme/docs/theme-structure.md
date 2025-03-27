# Theme Structure Documentation

This document explains the high-level concepts and folder structure of the WordPress theme with Tailwind CSS and DaisyUI.

## Core Concepts

### 1. Tailwind CSS

This theme uses Tailwind CSS, a utility-first CSS framework. The main benefits include:

- Rapid UI development with utility classes
- Consistent design system
- Highly customizable
- Only includes CSS that's actually used in your project

### 2. DaisyUI

DaisyUI is a component library for Tailwind CSS that provides:

- Ready-to-use UI components like buttons, cards, and modals
- Theme customization
- Semantic class names (like `btn`, `card`) for easier reading

### 3. WordPress Integration

The theme is built to work seamlessly with WordPress, focusing on:

- Dynamic content from WordPress admin
- WooCommerce integration for ecommerce
- Customizer settings for easy theme modifications

## Folder Structure

```
theme/
├── assets/              # Theme assets (images, fonts, etc.)
├── docs/                # Theme documentation
├── inc/                 # PHP includes and functions
│   ├── template-functions.php  # Helper functions for templates
│   ├── template-tags.php       # Template tag functions
│   └── class-wp-tailwind-navwalker.php # Custom navigation walker
├── js/                  # JavaScript files
├── languages/           # Translation files
├── template-parts/      # Reusable template parts
│   ├── content/         # Content template parts
│   └── layout/          # Layout template parts
├── woocommerce/         # WooCommerce template overrides
├── 404.php              # 404 template
├── archive.php          # Archive template
├── footer.php           # Footer template
├── front-page.php       # Homepage template
├── functions.php        # Theme functions
├── header.php           # Header template
├── index.php            # Main template file
├── page.php             # Page template
├── search.php           # Search results template
├── single.php           # Single post template
├── style.css            # Theme style information and compiled CSS
├── style-editor.css     # Editor styles
└── style-editor-extra.css # Additional editor styles
```

## Key Files Explained

### Core Theme Files

- **functions.php**: Main theme functions, hooks, and includes
- **header.php & footer.php**: Main structural templates for the site
- **front-page.php**: Homepage template with ecommerce sections
- **style.css**: Contains theme information and compiled Tailwind CSS

### WooCommerce Integration

- **woocommerce/**: Contains template overrides for WooCommerce
- The theme supports WooCommerce features like product display, cart, and checkout

### Template Parts System

Template parts are reusable components that follow WordPress conventions:

- **template-parts/content/**: Templates for displaying post/page content
- **template-parts/layout/**: Templates for layout elements like headers and footers

## Customization

The theme can be customized in several ways:

1. **WordPress Customizer**: Accessible from WordPress admin under Appearance > Customize
2. **Theme Settings**: Various settings like hero content, featured products, etc.
3. **Tailwind Config**: Edit the tailwind.config.js file to modify the design system
4. **Template Files**: Modify PHP files for structural changes

## Development Workflow

For development work on this theme:

1. Clone the repository
2. Run `npm install` to install dependencies
3. Use `npm run dev` for development builds with file watching
4. Use `npm run build` for production builds 