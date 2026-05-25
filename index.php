<?php

/**
 * The main template file for archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Reinfeld
 */

get_header(); ?>
<!-- index.php -->
<?php if (have_posts()): ?>

  <?php
  // Group posts by year for archive display
  $posts_by_year = [];
  $current_posts = [];

  // Collect all posts first
  while (have_posts()):
    the_post();
    $year = get_the_date("Y");
    $posts_by_year[$year][] = get_post();
  endwhile;

  // Reset post data for proper pagination
  wp_reset_postdata();

  // Display grouped posts
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

        <?php if (has_post_thumbnail()) {
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
        } ?>

        <?php
        // Bild- und Kurzmitteilungs-Posts werden auf Übersichtsseiten
        // vollständig ausgegeben, ohne Auszug oder Weiterlesen-Button.
        if (in_array(get_post_format(), ["image", "aside"], true)): ?>
          <div class="entry-content">
            <?php the_content(); ?>
          </div>
        <?php else:
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
        endif; ?>
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
