<?php

/**
 * Reinfeld Theme Customizer
 *
 * @package Reinfeld
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function reinfeld_customize_register($wp_customize)
{
  $wp_customize->get_setting('blogname')->transport         = 'postMessage';
  $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';

  if (isset($wp_customize->selective_refresh)) {
    $wp_customize->selective_refresh->add_partial(
      'blogname',
      array(
        'selector'        => '.site-title a',
        'render_callback' => 'reinfeld_customize_partial_blogname',
      )
    );
    $wp_customize->selective_refresh->add_partial(
      'blogdescription',
      array(
        'selector'        => '.site-description',
        'render_callback' => 'reinfeld_customize_partial_blogdescription',
      )
    );
  }

  // Social Media Section
  $wp_customize->add_section(
    'reinfeld_social_media',
    array(
      'title'    => __('Social Media Links', 'reinfeld'),
      'priority' => 130,
    )
  );

  // GitHub URL
  $wp_customize->add_setting(
    'reinfeld_github_url',
    array(
      'default'           => '',
      'sanitize_callback' => 'esc_url_raw',
    )
  );

  $wp_customize->add_control(
    'reinfeld_github_url',
    array(
      'label'   => __('GitHub URL', 'reinfeld'),
      'section' => 'reinfeld_social_media',
      'type'    => 'url',
    )
  );

  // Bluesky URL
  $wp_customize->add_setting(
    'reinfeld_bluesky_url',
    array(
      'default'           => '',
      'sanitize_callback' => 'esc_url_raw',
    )
  );

  $wp_customize->add_control(
    'reinfeld_bluesky_url',
    array(
      'label'   => __('Bluesky URL', 'reinfeld'),
      'section' => 'reinfeld_social_media',
      'type'    => 'url',
    )
  );

  // Mastodon URL
  $wp_customize->add_setting(
    'reinfeld_mastodon_url',
    array(
      'default'           => '',
      'sanitize_callback' => 'esc_url_raw',
    )
  );

  $wp_customize->add_control(
    'reinfeld_mastodon_url',
    array(
      'label'   => __('Mastodon URL', 'reinfeld'),
      'section' => 'reinfeld_social_media',
      'type'    => 'url',
    )
  );

  // About Section
  $wp_customize->add_section(
    'reinfeld_about_section',
    array(
      'title'    => __('About Section', 'reinfeld'),
      'priority' => 140,
    )
  );

  // About Text
  $wp_customize->add_setting(
    'reinfeld_about_text',
    array(
      'default'           => '',
      'sanitize_callback' => 'wp_kses_post',
    )
  );

  $wp_customize->add_control(
    'reinfeld_about_text',
    array(
      'label'   => __('About Text', 'reinfeld'),
      'section' => 'reinfeld_about_section',
      'type'    => 'textarea',
    )
  );

  // About Page URL
  $wp_customize->add_setting(
    'reinfeld_about_page_url',
    array(
      'default'           => '/about',
      'sanitize_callback' => 'esc_url_raw',
    )
  );

  $wp_customize->add_control(
    'reinfeld_about_page_url',
    array(
      'label'   => __('About Page URL', 'reinfeld'),
      'section' => 'reinfeld_about_section',
      'type'    => 'url',
    )
  );

  // Copyright Section
  $wp_customize->add_section(
    'reinfeld_copyright',
    array(
      'title'    => __('Copyright Settings', 'reinfeld'),
      'priority' => 160,
    )
  );

  // Start Year
  $wp_customize->add_setting(
    'reinfeld_start_year',
    array(
      'default'           => '2024',
      'sanitize_callback' => 'sanitize_text_field',
    )
  );

  $wp_customize->add_control(
    'reinfeld_start_year',
    array(
      'label'   => __('Start Year', 'reinfeld'),
      'section' => 'reinfeld_copyright',
      'type'    => 'text',
    )
  );

  // Custom Copyright Text
  $wp_customize->add_setting(
    'reinfeld_copyright_text',
    array(
      'default'           => '',
      'sanitize_callback' => 'wp_kses_post',
    )
  );

  $wp_customize->add_control(
    'reinfeld_copyright_text',
    array(
      'label'       => __('Custom Copyright Text', 'reinfeld'),
      'description' => __('Leave empty to use automatic copyright text', 'reinfeld'),
      'section'     => 'reinfeld_copyright',
      'type'        => 'textarea',
    )
  );

  // License URL
  $wp_customize->add_setting(
    'reinfeld_license_url',
    array(
      'default'           => '#ccbysa',
      'sanitize_callback' => 'esc_url_raw',
    )
  );

  $wp_customize->add_control(
    'reinfeld_license_url',
    array(
      'label'   => __('License URL', 'reinfeld'),
      'section' => 'reinfeld_copyright',
      'type'    => 'url',
    )
  );

  // License Text
  $wp_customize->add_setting(
    'reinfeld_license_text',
    array(
      'default'           => 'CC-BY-SA',
      'sanitize_callback' => 'sanitize_text_field',
    )
  );

  $wp_customize->add_control(
    'reinfeld_license_text',
    array(
      'label'   => __('License Text', 'reinfeld'),
      'section' => 'reinfeld_copyright',
      'type'    => 'text',
    )
  );
}
add_action('customize_register', 'reinfeld_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function reinfeld_customize_partial_blogname()
{
  bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function reinfeld_customize_partial_blogdescription()
{
  bloginfo('description');
}

/**
 * Sanitize checkbox values.
 */
function reinfeld_sanitize_checkbox($checked)
{
  return ((isset($checked) && true === $checked) ? true : false);
}
