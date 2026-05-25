<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Reinfeld
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo("charset"); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <!-- wp_head -->
  <?php wp_head(); ?>
  <!-- /wp_head -->
</head>

<body <?php body_class(); ?>>

  <div class="page"> <!-- header.php: .page -->
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e("Skip to content", "reinfeld"); ?></a>

    <header>
      <div class="header-container">
        <div class="logo">
          <a href="<?php echo esc_url(home_url("/")); ?>"
             aria-label="<?php echo esc_attr(get_bloginfo("name")); ?> – <?php esc_attr_e("Home", "reinfeld"); ?>">
            <span><?php get_template_part("template-parts/avatar-svg"); ?></span>
            <?php if (is_singular()): ?>
            <span class="logo-text"><?php bloginfo("name"); ?></span>
            <?php else: ?>
            <h1 class="logo-text"><?php bloginfo("name"); ?></h1>
            <?php endif; ?>
          </a>
        </div>

        <?php get_template_part("template-parts/rss-link"); ?>

        <?php get_template_part("template-parts/header-navigation"); ?>
      </div>
    </header>

    <main id="content" class="<?php echo is_single() || is_page() ? "article" : "archive"; ?>"><!-- header.php: main -->
