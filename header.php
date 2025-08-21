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
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <!-- wp_head -->
  <?php wp_head(); ?>
  <!-- /wp_head -->
</head>

<body <?php body_class(); ?>>

  <div class="page"> <!-- header.php: .page -->
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'reinfeld'); ?></a>

    <header>
      <div class="logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <?php get_template_part('template-parts/avatar-svg'); ?>
        </a>
      </div>

      <?php get_template_part('template-parts/theme-toggle'); ?>

      <?php get_template_part('template-parts/rss-link'); ?>
    </header>

    <main id="content" class="<?php echo is_home() || is_archive() ? 'archive' : 'article'; ?>"><!-- header.php: main -->
