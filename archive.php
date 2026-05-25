<?php
/**
 * The template for tag, taxonomy (persons, locations, series, category), date
 * and author archive pages.
 *
 * @package Reinfeld
 */

get_header(); ?>
<!-- archive.php -->

<?php
// ── Archive heading ──────────────────────────────────────────────────────────
// Build a human-readable label + title for the current archive.

$archive_label = "";
$archive_title = "";

if (is_tag()) {
  $archive_label = __("Topic", "reinfeld");
  $archive_title = "#" . single_tag_title("", false);
} elseif (is_tax("persons")) {
  $archive_label = __("Person", "reinfeld");
  $archive_title = single_term_title("", false);
} elseif (is_tax("locations")) {
  $archive_label = __("Location", "reinfeld");
  $archive_title = single_term_title("", false);
} elseif (is_tax("series")) {
  $archive_label = __("Series", "reinfeld");
  $archive_title = single_term_title("", false);
} elseif (is_category()) {
  $archive_label = __("Category", "reinfeld");
  $archive_title = single_cat_title("", false);
} elseif (is_year()) {
  $archive_label = __("Archive", "reinfeld");
  $archive_title = get_the_date(_x("Y", "yearly archives date format", "reinfeld"));
} elseif (is_month()) {
  $archive_label = __("Archive", "reinfeld");
  $archive_title = get_the_date(_x("F Y", "monthly archives date format", "reinfeld"));
} elseif (is_day()) {
  $archive_label = __("Archive", "reinfeld");
  $archive_title = get_the_date(_x("j. F Y", "daily archives date format", "reinfeld"));
} elseif (is_author()) {
  $archive_label = __("Author", "reinfeld");
  $archive_title = get_the_author();
} else {
  $archive_title = get_the_archive_title();
}
?>

<header class="archive-header">
  <?php if ($archive_label): ?>
    <p class="archive-label"><?php echo esc_html($archive_label); ?></p>
  <?php endif; ?>
  <h1 class="archive-title"><?php echo esc_html($archive_title); ?></h1>
  <?php
  // Optional taxonomy description
  $desc = get_the_archive_description();
  if ($desc): ?>
    <div class="archive-description"><?php echo wp_kses_post($desc); ?></div>
  <?php endif;
  ?>
</header>

<?php if (have_posts()): ?>

  <?php
  // Group posts by year for archive display (same logic as index.php)
  $posts_by_year = [];

  while (have_posts()):
    the_post();
    $year = get_the_date("Y");
    $posts_by_year[$year][] = get_post();
  endwhile;

  wp_reset_postdata();

  // Serien-Archive: älteste Beiträge zuerst → Jahre aufsteigend sortieren.
  // Alle anderen Archive zeigen neueste zuerst → Jahre absteigend (krsort).
  is_tax("series") ? ksort($posts_by_year) : krsort($posts_by_year);

  foreach ($posts_by_year as $year => $year_posts): ?>
    <h2><?php echo esc_html($year); ?></h2>

    <?php
    foreach ($year_posts as $post):

      setup_postdata($post);
      $layout_array = get_post_custom_values("layout");
      $layout = is_array($layout_array) ? esc_html($layout_array[0]) : "standard";
      ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
          <h3 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark">
              <?php the_title(); ?>
            </a>
          </h3>
        </header>

        <?php if (get_comments_number() > 0): ?>
          <footer class="entry-meta">
            <?php comments_number(
              __("No comments", "reinfeld"),
              __("One comment", "reinfeld"),
              __("% comments", "reinfeld"),
            ); ?>
          </footer>
        <?php endif; ?>

        <?php if (has_post_thumbnail()):
          $_thumb_id = get_post_thumbnail_id();
          $_thumb_alt = trim(get_post_meta($_thumb_id, "_wp_attachment_image_alt", true)) ?: get_the_title();
          $classes = ["entry-image teaser-image"];
          if ($layout !== "fullwidth") {
            $classes[] = "small-image";
          }
          the_post_thumbnail("large", [
            "class" => implode(" ", $classes),
            "alt" => $_thumb_alt,
          ]);
        endif; ?>

        <?php
        $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_excerpt(), 55, "...");
        if ($excerpt) {
          echo "<p>" . esc_html($excerpt);
          echo '&nbsp;<a class="continue ui-button" href="' .
            esc_url(get_permalink()) .
            '" aria-hidden="true" tabindex="-1">' .
            esc_html__("Continue&nbsp;reading", "reinfeld") .
            "</a>";
          echo "</p>";
        }
        ?>
      </article>

    <?php
    endforeach;
    wp_reset_postdata();
    endforeach;
  ?>

  <?php get_template_part("template-parts/pagination"); ?>

<?php else: ?>

  <?php get_template_part("template-parts/content", "none"); ?>

<?php endif; ?>

<?php get_footer(); ?>
