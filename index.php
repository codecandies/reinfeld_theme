<?php

/**
 * The main template file for archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Reinfeld
 */

get_header();
?>
<!-- index.php -->
<?php if (have_posts()) : ?>

  <?php
  // Group posts by year for archive display
  $posts_by_year = array();
  $current_posts = array();

  // Collect all posts first
  while (have_posts()) :
    the_post();
    $year = get_the_date('Y');
    $posts_by_year[$year][] = get_post();
  endwhile;

  // Reset post data for proper pagination
  wp_reset_postdata();

  // Display grouped posts
  foreach ($posts_by_year as $year => $year_posts) :
  ?>
    <h2><?php echo esc_html($year); ?></h2>

    <?php foreach ($year_posts as $post) :
      setup_postdata($post);
    ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
          <h3 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark">
              <?php the_title(); ?>
            </a>
          </h3>
        </header>
        <?php if (get_comments_number() > 0) : ?>
          <footer class="entry-meta">
            <?php comments_number(__('No comments', 'reinfeld'), __('One comment', 'reinfeld'), __('% comments', 'reinfeld')); ?>
          </footer>
        <?php endif; ?>

        <?php 
          $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_excerpt(), 55, '...');
          if ($excerpt) {
            echo '<p>' . esc_html($excerpt);
            echo '&nbsp;<a class="continue ui-button" href="' . esc_url(get_permalink()) . '" aria-hidden="true" tabindex="-1">' . esc_html__('Continue&nbsp;reading', 'reinfeld') . '</a>';
            echo '</p>';
          }
        ?>
      </article>

  <?php
    endforeach;
    wp_reset_postdata();
  endforeach;
  ?>

  <?php
  // Archive pagination
  $prev_link = get_previous_posts_link(__('Newer', 'reinfeld'));
  $next_link = get_next_posts_link(__('Older', 'reinfeld'));

  if ($prev_link || $next_link) :
  ?>
    <nav class="archive-pagination" aria-label="<?php esc_attr_e('Navigate to newer and older articles', 'reinfeld'); ?>">
      <?php if ($next_link) : ?>
        <?php echo $next_link; // Already escaped by WordPress
        ?>
      <?php endif; ?>
      <?php if ($prev_link) : ?>
        <?php echo $prev_link; // Already escaped by WordPress
        ?>
      <?php endif; ?>
    </nav>
  <?php endif; ?>

<?php else : ?>

  <?php get_template_part('template-parts/content', 'none'); ?>

<?php endif; ?>

<?php get_footer(); ?>
