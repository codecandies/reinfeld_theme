<?php

/**
 * Webring Navigation Template Part
 *
 * @package Reinfeld
 */
?>
<!-- webring-navigation.php -->
<nav class="webring" aria-label="<?php esc_attr_e('CSS JOY Webring', 'reinfeld'); ?>">
  <p aria-hidden="true"><?php esc_html_e('CSS JOY Webring:', 'reinfeld'); ?></p>
  <a href="https://webri.ng/webring/cssjoy/previous?via=<?php echo esc_url(home_url('/')); ?>" target="_blank" rel="noopener">
    <?php esc_html_e('Previous', 'reinfeld'); ?>
    <span class="screen-reader-text"><?php esc_html_e('(opens in new tab)', 'reinfeld'); ?></span>
  </a>
  <a href="https://webri.ng/webring/cssjoy/random?via=<?php echo esc_url(home_url('/')); ?>" target="_blank" rel="noopener">
    <?php esc_html_e('Random', 'reinfeld'); ?>
    <span class="screen-reader-text"><?php esc_html_e('(opens in new tab)', 'reinfeld'); ?></span>
  </a>
  <a href="https://webri.ng/webring/cssjoy/next?via=<?php echo esc_url(home_url('/')); ?>" target="_blank" rel="noopener">
    <?php esc_html_e('Next', 'reinfeld'); ?>
    <span class="screen-reader-text"><?php esc_html_e('(opens in new tab)', 'reinfeld'); ?></span>
  </a>
</nav>
