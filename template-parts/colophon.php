<?php

/**
 * Colophon Template Part
 *
 * @package Reinfeld
 */
?>
<!-- colophon.php -->
<div class="colophon">
  <?php
  // Get copyright information from customizer or use defaults
  $copyright_text = get_theme_mod('reinfeld_copyright_text', '');
  $license_url = get_theme_mod('reinfeld_license_url', 'https://creativecommons.org/licenses/by-sa/4.0/');
  $license_text = get_theme_mod('reinfeld_license_text', 'CC-BY-SA');

  if (! $copyright_text) {
    $current_year = date('Y');
    $start_year = get_theme_mod('reinfeld_start_year', '2024');

    $year_display = ($start_year === $current_year) ? $current_year : $start_year . ' - ' . $current_year;

    $copyright_text = sprintf(
      /* translators: %1$s: Year range, %2$s: Site name/author, %3$s: License link */
      __('© %1$s %2$s, all texts under %3$s', 'reinfeld'),
      $year_display,
      get_bloginfo('name'),
      sprintf(
        '<a href="%s">%s</a>',
        esc_url($license_url),
        esc_html($license_text)
      )
    );
  }
  ?>
  <?php echo wp_kses_post($copyright_text); ?>
</div>
