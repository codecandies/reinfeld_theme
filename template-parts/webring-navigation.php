<?php

/**
 * Webring Navigation Template Part
 *
 * @package Reinfeld
 */
?>
<!-- webring-navigation.php -->
<nav class="webring" aria-labelledby="webring">
  <p id="webring"><?php esc_html_e('CSS JOY Webring:', 'reinfeld'); ?></p>
  <a href="https://webri.ng/webring/cssjoy/previous?via=<?php echo esc_url(home_url('/')); ?>" target="_blank" rel="noopener">
    <?php esc_html_e('Previous', 'reinfeld'); ?>
  </a>
  <a href="https://webri.ng/webring/cssjoy/random?via=<?php echo esc_url(home_url('/')); ?>" target="_blank" rel="noopener">
    <?php esc_html_e('Random', 'reinfeld'); ?>
  </a>
  <a href="https://webri.ng/webring/cssjoy/next?via=<?php echo esc_url(home_url('/')); ?>" target="_blank" rel="noopener">
    <?php esc_html_e('Next', 'reinfeld'); ?>
  </a>
</nav>
