<?php

/**
 * Main Navigation Template Part
 *
 * @package Reinfeld
 */
?>

<nav class="mainnav" aria-label="<?php esc_attr_e('Main Navigation', 'reinfeld'); ?>">
  <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Overview', 'reinfeld'); ?></a>

  <?php
  // Check if we have a GitHub URL option in customizer or use fallback
  $github_url = get_theme_mod('reinfeld_github_url', '');
  if ($github_url) :
  ?>
    <a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noopener"><?php esc_html_e('Github', 'reinfeld'); ?></a>
  <?php endif; ?>

  <?php
  // Check if we have a Bluesky URL option in customizer
  $bluesky_url = get_theme_mod('reinfeld_bluesky_url', '');
  if ($bluesky_url) :
  ?>
    <a href="<?php echo esc_url($bluesky_url); ?>" target="_blank" rel="noopener"><?php esc_html_e('Bluesky', 'reinfeld'); ?></a>
  <?php endif; ?>

  <?php
  // Check if we have a Mastodon URL option in customizer
  $mastodon_url = get_theme_mod('reinfeld_mastodon_url', '');
  if ($mastodon_url) :
  ?>
    <a href="<?php echo esc_url($mastodon_url); ?>" target="_blank" rel="noopener" hreflang="de"><?php esc_html_e('Mastodon', 'reinfeld'); ?></a>
  <?php endif; ?>
</nav>
