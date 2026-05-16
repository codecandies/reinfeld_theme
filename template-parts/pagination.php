<?php
/**
 * Numbered posts pagination
 *
 * Used on index.php and archive.php.
 * Relies on WordPress core the_posts_pagination().
 *
 * @package Reinfeld
 */

the_posts_pagination([
  "mid_size" => 2,
  "prev_text" => "&laquo; " . esc_html__("Newer", "reinfeld"),
  "next_text" => esc_html__("Older", "reinfeld") . " &raquo;",
  "screen_reader_text" => esc_html__("Navigate to newer and older articles", "reinfeld"),
  "aria_label" => esc_html__("Navigate to newer and older articles", "reinfeld"),
  "class" => "pagination",
]);
