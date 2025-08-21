<?php

/**
 * RSS Link Template Part
 *
 * @package Reinfeld
 */
?>

<!-- rss-link.php -->
<div class="rsslink">
  <a href="<?php echo esc_url(get_feed_link()); ?>">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" role="img">
      <title><?php esc_html_e('Link to RSS feed', 'reinfeld'); ?></title>
      <circle fill="currentColor" class="symbol" cx="2" cy="6" r="1" />
      <path fill="currentColor" class="symbol" d="M1 4a3 3 0 0 1 3 3h1a4 4 0 0 0-4-4z" />
      <path fill="currentColor" class="symbol" d="M1 2a5 5 0 0 1 5 5h1a6 6 0 0 0-6-6z" />
    </svg>
  </a>
</div>
