<?php

/**
 * Reinfeld Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Reinfeld
 */

if (!defined("ABSPATH")) {
  exit();
}

/**
 * Theme version
 */
define("REINFELD_VERSION", "1.0.0");

/**
 * Sets up theme defaults and registers support for various ClassicPress features.
 */
if (!function_exists("reinfeld_setup")):
  /**
   * Sets up theme defaults and registers support for various ClassicPress features.
   */
  function reinfeld_setup()
  {
    // Add default posts and comments RSS feed links to head.
    add_theme_support("automatic-feed-links");

    // Let ClassicPress manage the document title.
    add_theme_support("title-tag");

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support("post-thumbnails");

    // Post thumbnail size
    set_post_thumbnail_size(1200, 9999);

    // Custom image sizes
    add_image_size("reinfeld_list-image", 640, 400);

    // Title tag support
    add_theme_support("title-tag");

    // Add excerpts to pages
    add_post_type_support("page", ["excerpt"]);

    // HTML5 semantic markup
    add_theme_support("html5", ["search-form", "comment-form", "comment-list", "gallery", "caption"]);

    // Add theme support for selective refresh for widgets.
    add_theme_support("customize-selective-refresh-widgets");

    // Add support for core custom logo.
    add_theme_support("custom-logo", [
      "height" => 250,
      "width" => 250,
      "flex-width" => true,
      "flex-height" => true,
    ]);

    // Post formats
    add_theme_support("post-formats", ["image", "aside"]);

    // Navigation menu locations
    register_nav_menus([
      "footer-links" => __("Navigation (Footer)", "reinfeld"),
    ]);
  }
  add_action("after_setup_theme", "reinfeld_setup");
endif;

/**
 * Flat nav walker — renders menu items as plain <a> tags without <ul>/<li>
 * wrappers, so they blend seamlessly with the surrounding hardcoded links
 * in .mainnav.
 */
if (!class_exists("Reinfeld_Flat_Nav_Walker")):
  class Reinfeld_Flat_Nav_Walker extends Walker_Nav_Menu
  {
    // Suppress sub-menu levels entirely
    public function start_lvl(&$output, $depth = 0, $args = null) {}
    public function end_lvl(&$output, $depth = 0, $args = null) {}

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
      $target = !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : "";
      $rel = !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : "";
      $output .= '<a href="' . esc_url($item->url) . '"' . $target . $rel . ">" . esc_html($item->title) . "</a>";
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {}
  }
endif;
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
if (!function_exists("reinfeld_content_width")):
  function reinfeld_content_width()
  {
    $GLOBALS["content_width"] = apply_filters("reinfeld_content_width", 640);
  }
  add_action("after_setup_theme", "reinfeld_content_width", 0);
endif;

/**
 * Enqueue scripts and styles.
 */
if (!function_exists("reinfeld_scripts")):
  function reinfeld_scripts()
  {
    // Enqueue fonts first
    wp_enqueue_style("reinfeld-fonts", get_template_directory_uri() . "/assets/css/fonts.css", [], REINFELD_VERSION);

    // Enqueue main stylesheet (depends on fonts)
    wp_enqueue_style("reinfeld-style", get_stylesheet_uri(), ["reinfeld-fonts"], REINFELD_VERSION);

    // Accessible hamburger navigation toggle
    wp_enqueue_script(
      "reinfeld-navigation",
      get_template_directory_uri() . "/assets/js/navigation.js",
      [],
      REINFELD_VERSION,
      true,
    );
  }
  add_action("wp_enqueue_scripts", "reinfeld_scripts");
endif;

/**
 * Register footer widget areas.
 */
if (!function_exists("reinfeld_widgets_init")):
  function reinfeld_widgets_init()
  {
    for ($i = 1; $i <= 3; $i++) {
      register_sidebar([
        "name" => sprintf(
          /* translators: %d: Footer widget area number */
          __("Footer %d", "reinfeld"),
          $i,
        ),
        "id" => "footer-$i",
        "before_widget" => '<section id="%1$s" class="widget %2$s">',
        "after_widget" => "</section>",
        "before_title" => '<h2 class="widget-title">',
        "after_title" => "</h2>",
      ]);
    }
  }
  add_action("widgets_init", "reinfeld_widgets_init");
endif;

/**
 * Register theme-provided editor blocks.
 */
if (!function_exists("reinfeld_register_blocks")):
  function reinfeld_register_blocks()
  {
    register_block_type(get_template_directory() . "/blocks/quotation");
  }
  add_action("init", "reinfeld_register_blocks");
endif;

/**
 * Load theme textdomain for internationalization.
 */
if (!function_exists("reinfeld_textdomain")):
  function reinfeld_textdomain()
  {
    load_theme_textdomain("reinfeld", get_template_directory() . "/languages");
  }
  add_action("after_setup_theme", "reinfeld_textdomain");
endif;

/**
 * Customizer additions.
 */
require get_template_directory() . "/inc/customizer.php";

if (!function_exists("reinfeld_comment")):
  function reinfeld_comment($comment, $args, $depth)
  {
    switch ($comment->comment_type):
      case "pingback":
      case "trackback":
      case "ping":
      case "like":
      case "repost":
        global $post; ?>

        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
          <article <?php comment_class("comment"); ?>>
            <div class="comment-short">
              <?php echo ucfirst($comment->comment_type) .
                " " .
                __("from", "reinfeld") .
                " " .
                get_comment_author_link(); ?>
            </div>
          </article>
        <?php break;

      default:
        global $post; ?>
        <li id="li-comment-<?php comment_ID(); ?>">

          <article id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
            <header class="comment-meta">
              <span class="comment-number">#</span>
              <cite><?php echo get_comment_author_link(); ?></cite>
              <?php if ($comment->user_id === $post->post_author) {
                echo " (" . __("Author", "reinfeld") . ")";
              } ?>
              — <a class="comment-date-link" href="<?php echo esc_url(
                get_comment_link($comment->comment_ID),
              ); ?>" title="<?php echo get_comment_date() .
  " " .
  __("at", "reinfeld") .
  " " .
  get_comment_time(); ?>"><?php echo get_comment_date(get_option("date_format")); ?></a>
            </header>

            <div class="comment-content entry-content">
              <?php comment_text(); ?>
            </div><!-- .comment-content -->

            <footer class="comment-footer">
              <?php comment_reply_link([
                "after" => "</span>",
                "before" => '<span class="comment-reply">',
                "depth" => $depth,
                "max_depth" => $args["max_depth"],
                "reply_text" => __("Reply", "reinfeld"),
              ]); ?>
              <?php if ("0" == $comment->comment_approved): ?>
                <span class="comment-awaiting-moderation"><?php _e(
                  "Your comment is awaiting moderation.",
                  "reinfeld",
                ); ?></span>
                <?php endif; ?>
            </footer>
          </article><!-- .comment -->

  <?php break;
    endswitch;
  }
endif; // End if().

/**
 * Wechselt den Gesichtsausdruck des Header-Avatars pro Seitenaufruf.
 *
 * Der Ausdruck wird deterministisch aus Datum + URL-Hash gewählt:
 * - ändert sich nicht bei jedem Klick auf F5 (gleiche Seite → gleicher Ausdruck)
 * - variiert zwischen verschiedenen Seiten und von Tag zu Tag
 *
 * Mögliche Zustände:
 *   "avatar"           → lächelnd (Standard)
 *   "avatar screaming" → schreiend
 *   "avatar disbelief" → ungläubig
 */
/**
 * Serien-Archiv: älteste Beiträge zuerst anzeigen.
 *
 * Auf den Übersichtsseiten der Taxonomie "series" wird die Sortierung
 * auf aufsteigend (ASC) gesetzt, damit Leser die Serie von vorne lesen können.
 */
add_action("pre_get_posts", function (WP_Query $query) {
  if (!is_admin() && $query->is_main_query() && $query->is_tax("series")) {
    $query->set("order", "ASC");
    $query->set("orderby", "date");
  }
});

add_filter("reinfeld_avatar_class", function ($default) {
  $states = ["avatar", "avatar screaming", "avatar disbelief"];

  // Seed aus aktuellem Datum + URL → stabiler Ausdruck pro Seite/Tag,
  // aber abwechslungsreich über das gesamte Archiv.
  $seed = crc32(date("Y-m-d") . $_SERVER["REQUEST_URI"]);

  return $states[abs($seed) % count($states)];
});
