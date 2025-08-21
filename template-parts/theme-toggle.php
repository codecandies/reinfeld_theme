<?php

/**
 * Theme Toggle Template Part
 *
 * @package Reinfeld
 */
?>

<!-- theme-toggle.php -->
<div class="theme">
  <div class="toggle-container">
    <fieldset class="toggle-fieldset" id="mode-switcher">
      <legend class="toggle-legend"><?php esc_html_e('Choose color theme:', 'reinfeld'); ?></legend>
      <div class="toggle-switch" role="radiogroup" aria-labelledby="mode-switcher">
        <input type="radio" id="light" name="mode" value="light" class="toggle-input" aria-describedby="light-desc" />
        <label for="light" class="toggle-label"><?php esc_html_e('Light', 'reinfeld'); ?></label>

        <input type="radio" id="auto" name="mode" value="auto" class="toggle-input" checked aria-describedby="auto-desc" />
        <label for="auto" class="toggle-label"><?php esc_html_e('Auto', 'reinfeld'); ?></label>

        <input type="radio" id="dark" name="mode" value="dark" class="toggle-input" aria-describedby="dark-desc" />
        <label for="dark" class="toggle-label"><?php esc_html_e('Dark', 'reinfeld'); ?></label>

        <div class="toggle-handle" aria-hidden="true">
          <!-- Sonne Icon für Light Mode -->
          <svg class="icon icon-sun" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="4" fill="currentColor" />
            <path d="M12 2V4M12 20V22M4 12H2M6.31412 6.31412L4.8999 4.8999M17.6859 6.31412L19.1001 4.8999M6.31412 17.69L4.8999 19.1042M17.6859 17.69L19.1001 19.1042M22 12H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
          </svg>

          <!-- Computer Icon für Auto Mode -->
          <svg class="icon icon-computer" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="2" y="3" width="20" height="14" rx="2" ry="2" stroke="currentColor" stroke-width="2" />
            <line x1="8" y1="21" x2="16" y2="21" stroke="currentColor" stroke-width="2" />
            <line x1="12" y1="17" x2="12" y2="21" stroke="currentColor" stroke-width="2" />
          </svg>

          <!-- Mond Icon für Dark Mode -->
          <svg class="icon icon-moon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" fill="currentColor" />
          </svg>
        </div>
      </div>
    </fieldset>
  </div>

  <!-- Versteckte Beschreibungen für Screen Reader -->
  <div style="position: absolute; left: -10000px; width: 1px; height: 1px; overflow: hidden;">
    <div id="light-desc"><?php esc_html_e('Helles Design aktivieren', 'reinfeld'); ?></div>
    <div id="auto-desc"><?php esc_html_e('Automatisches Design basierend auf Systemeinstellungen', 'reinfeld'); ?></div>
    <div id="dark-desc"><?php esc_html_e('Dunkles Design aktivieren', 'reinfeld'); ?></div>
  </div>
</div>
