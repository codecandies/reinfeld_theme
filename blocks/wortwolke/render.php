<?php
/**
 * Frontend-Ausgabe des Wortwolken-Blocks (dynamisch).
 *
 * Begriffe einer Taxonomie werden ab einer Mindesthäufigkeit (Schwellenwert)
 * als zufällig sortierte, größenskalierte Links ausgegeben. Skalierung, Links
 * und barrierearmes Markup übernimmt wp_generate_tag_cloud(); der einzige
 * Mehrwert gegenüber dem Core-Tag-Cloud ist der Schwellenwert-Filter.
 *
 * @var array $attributes Block-Attribute (title, taxonomy, threshold, minFontSize, maxFontSize).
 *
 * @package Reinfeld
 */

if (!defined("ABSPATH")) {
  exit();
}

$allowed_taxonomies = ["post_tag", "persons", "locations", "series"];

$taxonomy = isset($attributes["taxonomy"]) ? $attributes["taxonomy"] : "post_tag";
if (!in_array($taxonomy, $allowed_taxonomies, true) || !taxonomy_exists($taxonomy)) {
  return;
}

$title = isset($attributes["title"]) ? $attributes["title"] : "";
$threshold = isset($attributes["threshold"]) ? max(1, (int) $attributes["threshold"]) : 5;
$min_font = isset($attributes["minFontSize"]) ? (int) $attributes["minFontSize"] : 10;
$max_font = isset($attributes["maxFontSize"]) ? (int) $attributes["maxFontSize"] : 30;

// Vertauschte Grenzen tolerieren, damit die Skalierung sinnvoll bleibt.
if ($min_font > $max_font) {
  $tmp = $min_font;
  $min_font = $max_font;
  $max_font = $tmp;
}

$terms = get_terms([
  "taxonomy" => $taxonomy,
  "hide_empty" => true,
]);

if (is_wp_error($terms) || empty($terms)) {
  return;
}

// Schwellenwert-Filter — der Core-Tag-Cloud kann das nicht.
$terms = array_filter($terms, function ($term) use ($threshold) {
  return $term->count >= $threshold;
});

if (empty($terms)) {
  return;
}

// Link/ID setzen, wie es wp_tag_cloud() vor der Übergabe tut.
foreach ($terms as $term) {
  $link = get_term_link($term, $taxonomy);
  if (is_wp_error($link)) {
    continue;
  }
  $term->link = $link;
  $term->id = $term->term_id;
}

$cloud = wp_generate_tag_cloud($terms, [
  "smallest" => $min_font,
  "largest" => $max_font,
  "unit" => "px",
  "format" => "flat",
  "separator" => " ",
  "orderby" => "count",
  "order" => "RAND",
]);

if ("" === trim($cloud)) {
  return;
}
?>
<nav class="rf-wortwolke">
  <?php if ("" !== trim($title)): ?>
  <h2 class="rf-wortwolke__title"><?php echo esc_html($title); ?></h2>
  <?php endif; ?>
  <div class="rf-wortwolke__tags"><?php echo $cloud; ?></div>
</nav>
