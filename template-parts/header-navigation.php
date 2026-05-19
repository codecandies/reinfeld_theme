<?php
/**
 * Header Navigation Template Part
 *
 * Without JS this button is a same-page anchor to the always-visible
 * navigation in the footer (#site-footer-nav). navigation.js upgrades it
 * to a disclosure that clones the footer menu into a slide-in drawer.
 *
 * @package Reinfeld
 */
?>
<!-- header-navigation.php -->
<div class="header-nav">
  <a class="menu-button" href="#site-footer-nav"
     aria-label="<?php esc_attr_e("Menu", "reinfeld"); ?>"
     aria-controls="menu-drawer" aria-expanded="false">
    <span class="menu-bars" aria-hidden="true">
      <span></span><span></span><span></span>
    </span>
  </a>

  <div class="menu-backdrop" hidden></div>
  <div id="menu-drawer" class="menu-drawer" hidden></div>
</div>
