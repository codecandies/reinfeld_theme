<?php

/**
 * About Section Template Part
 *
 * @package Reinfeld
 */
?>

<!-- about-section.php -->
<aside class="about">
  <?php
  // Get about text from customizer or use default
  $about_text = get_theme_mod('reinfeld_about_text', '');
  $about_page_url = get_theme_mod('reinfeld_about_page_url', '/about');

  if (! $about_text) {
    $about_text = sprintf(
      /* translators: %s: Continue reading link */
      __('Hi, my name is Nico, and I work as a team-leading senior frontend developer for a large publishing house in Hamburg, Germany.&nbsp;%s', 'reinfeld'),
      sprintf(
        '<a class="continue ui-button" href="%s">%s</a>',
        esc_url($about_page_url),
        esc_html__('Continue reading', 'reinfeld')
      )
    );
  }
  ?>
  <p><?php echo wp_kses_post($about_text); ?></p>
</aside>
