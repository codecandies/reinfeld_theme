<?php
/**
 * Header Navigation Template Part
 *
 * Accessible hamburger disclosure. The panel stays visible without JS;
 * navigation.js collapses it and wires the aria-expanded button.
 *
 * @package Reinfeld
 */
?>
<!-- header-navigation.php -->
<div class="header-nav">
  <button type="button" class="menu-button" aria-expanded="false" aria-controls="primary-menu">
    <svg class="menu-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false" fill="none" xmlns="http://www.w3.org/2000/svg">
      <line x1="3" y1="6" x2="21" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
      <line x1="3" y1="12" x2="21" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
      <line x1="3" y1="18" x2="21" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
    </svg>
    <span class="menu-button-text"><?php esc_html_e("Menu", "reinfeld"); ?></span>
  </button>

  <div id="primary-menu" class="menu-panel">
    <?php get_template_part("template-parts/main-navigation"); ?>
  </div>
</div>
