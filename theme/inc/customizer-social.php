<?php
/**
 * Social Media Links Customizer Settings
 */

function tw_social_customize_register($wp_customize) {
    // Add Social Media Section
    $wp_customize->add_section('tw_social_links', array(
        'title'    => __('Social Media Links', 'tw'),
        'priority' => 120,
    ));

    // Social Media Platforms
    $social_platforms = array(
        'facebook'  => __('Facebook URL', 'tw'),
        'twitter'   => __('Twitter URL', 'tw'),
        'instagram' => __('Instagram URL', 'tw'),
        'linkedin'  => __('LinkedIn URL', 'tw'),
        'youtube'   => __('YouTube URL', 'tw'),
        'tiktok'    => __('TikTok URL', 'tw'),
    );

    foreach ($social_platforms as $platform => $label) {
        $wp_customize->add_setting("tw_social_{$platform}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control("tw_social_{$platform}", array(
            'label'    => $label,
            'section'  => 'tw_social_links',
            'type'     => 'url',
            'priority' => 10,
        ));
    }

    // Social Icons Color
    $wp_customize->add_setting('tw_social_icons_color', array(
        'default'           => 'base-content',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('tw_social_icons_color', array(
        'label'    => __('Icons Color', 'tw'),
        'section'  => 'tw_social_links',
        'type'     => 'select',
        'choices'  => array(
            'base-content' => __('Default', 'tw'),
            'primary'      => __('Primary', 'tw'),
            'secondary'    => __('Secondary', 'tw'),
            'accent'       => __('Accent', 'tw'),
        ),
        'priority' => 5,
    ));
}
add_action('customize_register', 'tw_social_customize_register'); 