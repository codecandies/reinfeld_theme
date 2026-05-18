<?php

/**
 * Template part for displaying single post content
 *
 * @package Reinfeld
 */

$layout_array = get_post_custom_values("layout");
$layout = is_array($layout_array) ? esc_html($layout_array[0]) : "standard";
?>
<!-- content-single.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class($layout); ?>>
  <?php if (has_post_thumbnail()) {
    $image = get_the_post_thumbnail(null, "large", [
      "class" => "entry-image article-image",
    ]);
  } ?>
  <?php if (isset($image)): ?>
    <figure class="entry-image-wrapper">
      <?php echo $image; ?>
    </figure>
  <?php endif; ?>
  <header>
    <h1><?php the_title(); ?></h1>
    <div class="meta">
      <time datetime="<?php echo esc_attr(get_the_date("c")); ?>">
        <?php echo esc_html(get_the_date()); ?>
      </time>
      <?php if (has_category()): ?>
        <span class="categories">
          <?php the_category(", "); ?>
        </span>
      <?php endif; ?>
    </div>
  </header>

  <div class="entry-content">
    <?php the_content(); ?>
  </div>

  <?php
  // Collect terms from post tags, persons and locations and display them
  // with a # prefix at the end of the article body.
  $entry_terms = [];
  foreach (["post_tag", "persons", "locations"] as $tax) {
    $terms = get_the_terms(get_the_ID(), $tax);
    if ($terms && !is_wp_error($terms)) {
      $entry_terms = array_merge($entry_terms, $terms);
    }
  }
  if ($entry_terms): ?>
  <footer class="entry-terms">
    <?php foreach ($entry_terms as $term): ?>
      <a href="<?php echo esc_url(get_term_link($term)); ?>" class="entry-term" rel="tag">#<?php echo esc_html(
  $term->name,
); ?></a>
    <?php endforeach; ?>
  </footer>
  <?php endif;
  ?>
</article>

<?php
get_template_part("template-parts/content", "prevnext");

// Comments section
if (comments_open() || get_comments_number()):
  comments_template();
endif;

get_template_part("template-parts/content", "related");


?>
