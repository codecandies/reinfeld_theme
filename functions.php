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


if (! function_exists('reinfeld_comment')) :
  function reinfeld_comment($comment, $args, $depth)
  {

    switch ($comment->comment_type):
      case 'pingback':
      case 'trackback':
      case 'ping':
      case 'like':
      case 'repost':
        global $post;
?>

        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
          <?php echo get_avatar($comment, 50, 'robohash'); ?>
          <?php echo ucfirst($comment->comment_type) . ' ' . __('from', 'reinfeld') . ' ' . get_comment_author_link(); ?>

        <?php

        break;

      default:
        global $post;
        ?>
        <li id="li-comment-<?php comment_ID(); ?>">

          <article id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
            <header class="comment-meta">
              <div class="comment-avatar">
                <?php echo get_avatar($comment, 50, 'robohash'); ?>
              </div>

              <div class="comment-author">
                <cite><?php echo get_comment_author_link(); ?></cite>
                <?php if ($comment->user_id === $post->post_author) {
                  echo ' (' . __('Author', 'reinfeld') . ')';
                } ?>
              </div>

              <div class="comment-metadata">
                <span class="comment-date">
                  <a class="comment-date-link" href="<?php echo esc_url(get_comment_link($comment->comment_ID)) ?>" title="<?php echo get_comment_date() . ' ' . __('at', 'reinfeld') . ' ' . get_comment_time(); ?>"><?php echo get_comment_date(get_option('date_format')); ?></a>
                </span>
              </div>
            </header>

            <div class="comment-content entry-content">
              <?php comment_text(); ?>
            </div><!-- .comment-content -->

            <footer class="comment-footer">
              <?php
              comment_reply_link(array(
                'after'      => '</span>',
                'before'    => '<span class="comment-reply">',
                'depth'      => $depth,
                'max_depth'   => $args['max_depth'],
                'reply_text'   => __('Reply', 'reinfeld'),
              ));
              ?>
              <?php if ('0' == $comment->comment_approved) : ?>
                <span class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'reinfeld'); ?></p>
                <?php endif; ?>
            </footer>
          </article><!-- .comment -->

  <?php
        break;
    endswitch;
  }
endif; // End if().
