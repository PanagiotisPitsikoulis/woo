<?php
/**
 * Theme Customizer
 *
 * @package _tw
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tw_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'tw_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'tw_customize_partial_blogdescription',
            )
        );
    }

    // Add Theme Style Section
    $wp_customize->add_section('tw_theme_style', array(
        'title'    => __('Theme Style', 'tw'),
        'priority' => 30,
    ));

    // Theme Style Setting
    $wp_customize->add_setting('tw_theme_style', array(
        'default'           => 'winter',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('tw_theme_style', array(
        'label'    => __('Color Theme', 'tw'),
        'section'  => 'tw_theme_style',
        'type'     => 'select',
        'choices'  => array(
            'light' => 'Light',
            'dark' => 'Dark',
            'cupcake' => 'Cupcake',
            'bumblebee' => 'Bumblebee',
            'emerald' => 'Emerald',
            'corporate' => 'Corporate',
            'synthwave' => 'Synthwave',
            'retro' => 'Retro',
            'cyberpunk' => 'Cyberpunk',
            'valentine' => 'Valentine',
            'halloween' => 'Halloween',
            'garden' => 'Garden',
            'forest' => 'Forest',
            'aqua' => 'Aqua',
            'lofi' => 'Lo-Fi',
            'pastel' => 'Pastel',
            'fantasy' => 'Fantasy',
            'wireframe' => 'Wireframe',
            'black' => 'Black',
            'luxury' => 'Luxury',
            'dracula' => 'Dracula',
            'cmyk' => 'CMYK',
            'autumn' => 'Autumn',
            'business' => 'Business',
            'acid' => 'Acid',
            'lemonade' => 'Lemonade',
            'night' => 'Night',
            'coffee' => 'Coffee',
            'winter' => 'Winter',
            'dim' => 'Dim',
            'nord' => 'Nord',
            'sunset' => 'Sunset',
            'caramellatte' => 'Caramel Latte',
            'abyss' => 'Abyss',
            'silk' => 'Silk'
        ),
    ));

    // Hero Section
    $wp_customize->add_section('tw_hero_section', array(
        'title'    => __('Hero Section', 'tw'),
        'priority' => 120,
    ));

    // Hero Title
    $wp_customize->add_setting('tw_hero_title', array(
        'default'           => get_bloginfo('name'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('tw_hero_title', array(
        'label'    => __('Hero Title', 'tw'),
        'section'  => 'tw_hero_section',
        'type'     => 'text',
    ));

    // Hero Description
    $wp_customize->add_setting('tw_hero_description', array(
        'default'           => get_bloginfo('description'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('tw_hero_description', array(
        'label'    => __('Hero Description', 'tw'),
        'section'  => 'tw_hero_section',
        'type'     => 'textarea',
    ));

    // Hero Button Text
    $wp_customize->add_setting('tw_hero_button_text', array(
        'default'           => __('Shop Now', 'tw'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('tw_hero_button_text', array(
        'label'    => __('Button Text', 'tw'),
        'section'  => 'tw_hero_section',
        'type'     => 'text',
    ));

    // Hero Button URL
    $wp_customize->add_setting('tw_hero_button_url', array(
        'default'           => home_url('/shop/'),
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('tw_hero_button_url', array(
        'label'    => __('Button URL', 'tw'),
        'section'  => 'tw_hero_section',
        'type'     => 'url',
    ));

    // Hero Background Image
    $wp_customize->add_setting('tw_hero_image', array(
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'tw_hero_image', array(
        'label'    => __('Hero Background Image', 'tw'),
        'section'  => 'tw_hero_section',
    )));

    // Featured Categories Section
    $wp_customize->add_section('tw_featured_categories', array(
        'title'    => __('Featured Categories', 'tw'),
        'priority' => 130,
    ));

    // Section Title
    $wp_customize->add_setting('tw_featured_categories_title', array(
        'default'           => __('Featured Categories', 'tw'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('tw_featured_categories_title', array(
        'label'    => __('Section Title', 'tw'),
        'section'  => 'tw_featured_categories',
        'type'     => 'text',
    ));

    // Featured Products Section
    $wp_customize->add_section('tw_featured_products', array(
        'title'    => __('Featured Products', 'tw'),
        'priority' => 140,
    ));

    // Section Title
    $wp_customize->add_setting('tw_featured_products_title', array(
        'default'           => __('Featured Products', 'tw'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('tw_featured_products_title', array(
        'label'    => __('Section Title', 'tw'),
        'section'  => 'tw_featured_products',
        'type'     => 'text',
    ));

    // Products Count
    $wp_customize->add_setting('tw_featured_products_count', array(
        'default'           => 4,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('tw_featured_products_count', array(
        'label'    => __('Number of Products', 'tw'),
        'section'  => 'tw_featured_products',
        'type'     => 'number',
    ));

    // Products Columns
    $wp_customize->add_setting('tw_featured_products_columns', array(
        'default'           => 4,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('tw_featured_products_columns', array(
        'label'    => __('Number of Columns', 'tw'),
        'section'  => 'tw_featured_products',
        'type'     => 'number',
    ));

    // Products Order By
    $wp_customize->add_setting('tw_featured_products_orderby', array(
        'default'           => 'date',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('tw_featured_products_orderby', array(
        'label'    => __('Order By', 'tw'),
        'section'  => 'tw_featured_products',
        'type'     => 'select',
        'choices'  => array(
            'date'       => __('Date', 'tw'),
            'popularity' => __('Popularity', 'tw'),
            'rating'     => __('Rating', 'tw'),
            'price'      => __('Price', 'tw'),
        ),
    ));

    // View All Products Text
    $wp_customize->add_setting('tw_view_all_products_text', array(
        'default'           => __('View All Products', 'tw'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('tw_view_all_products_text', array(
        'label'    => __('View All Button Text', 'tw'),
        'section'  => 'tw_featured_products',
        'type'     => 'text',
    ));

    // Header Settings
    $wp_customize->add_section(
        'tw_header_section',
        array(
            'title'      => __('Header Settings', 'tw'),
            'priority'   => 20,
        )
    );

    $wp_customize->add_setting(
        'tw_show_search',
        array(
            'default'           => true,
            'sanitize_callback' => 'tw_sanitize_checkbox',
            'transport'         => 'refresh',
        )
    );
    
    $wp_customize->add_control(
        'tw_show_search',
        array(
            'label'    => __('Show Search Icon', 'tw'),
            'section'  => 'tw_header_section',
            'type'     => 'checkbox',
        )
    );
}
add_action('customize_register', 'tw_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function tw_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function tw_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Sanitize checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool
 */
function tw_sanitize_checkbox($checked) {
    return (bool) $checked;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function tw_customize_preview_js() {
    wp_enqueue_script('tw-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), TW_VERSION, true);
}
add_action('customize_preview_init', 'tw_customize_preview_js'); 