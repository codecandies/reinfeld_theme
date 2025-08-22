<?php

/**
 * Reinfeld Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Reinfeld
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Theme version
 */
define('REINFELD_VERSION', '1.0.0');

/**
 * Sets up theme defaults and registers support for various ClassicPress features.
 */
if (!function_exists('reinfeld_setup')):
  /**
   * Sets up theme defaults and registers support for various ClassicPress features.
   */
  function reinfeld_setup()
  {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let ClassicPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Post thumbnail size
    set_post_thumbnail_size(1200, 9999);

    // Custom image sizes
    add_image_size('reinfeld_list-image', 640, 400);

    // Title tag support
    add_theme_support('title-tag');

    // Add excerpts to pages
    add_post_type_support('page', array('excerpt'));

    // HTML5 semantic markup
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo.
    add_theme_support(
      'custom-logo',
      array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
      )
    );
  }
  add_action('after_setup_theme', 'reinfeld_setup');
endif;
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
if (!function_exists('reinfeld_content_width')):
  function reinfeld_content_width()
  {
    $GLOBALS['content_width'] = apply_filters('reinfeld_content_width', 640);
  }
  add_action('after_setup_theme', 'reinfeld_content_width', 0);
endif;

/**
 * Enqueue scripts and styles.
 */
if (!function_exists('reinfeld_scripts')):
  function reinfeld_scripts()
  {
    // Enqueue fonts first
    wp_enqueue_style('reinfeld-fonts', get_template_directory_uri() . '/assets/css/fonts.css', array(), REINFELD_VERSION);

    // Enqueue main stylesheet (depends on fonts)
    wp_enqueue_style('reinfeld-style', get_stylesheet_uri(), array('reinfeld-fonts'), REINFELD_VERSION);
  }
  add_action('wp_enqueue_scripts', 'reinfeld_scripts');
endif;

/**
 * Load theme textdomain for internationalization.
 */
if (!function_exists('reinfeld_textdomain')):
  function reinfeld_textdomain()
  {
    load_theme_textdomain('reinfeld', get_template_directory() . '/languages');
  }
  add_action('after_setup_theme', 'reinfeld_textdomain');
endif;

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
