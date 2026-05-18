<?php
/**
 * Frontend-Ausgabe des Zitat-Blocks (dynamisch).
 *
 * @var array $attributes Block-Attribute (quote, caption).
 *
 * @package Reinfeld
 */

if (!defined("ABSPATH")) {
  exit();
}

$quote = isset($attributes["quote"]) ? $attributes["quote"] : "";
$caption = isset($attributes["caption"]) ? $attributes["caption"] : "";

// Ohne Zitat-Text wird nichts ausgegeben.
if ("" === trim(wp_strip_all_tags($quote))) {
  return;
}

$allowed_html = wp_kses_allowed_html("post");
$has_caption = "" !== trim(wp_strip_all_tags($caption));
?>
<figure class="rf-quotation">
  <blockquote class="rf-quotation__quote"><?php echo wp_kses($quote, $allowed_html); ?></blockquote>
  <?php if ($has_caption): ?>
  <figcaption class="rf-quotation__caption"><?php echo wp_kses($caption, $allowed_html); ?></figcaption>
  <?php endif; ?>
</figure>
