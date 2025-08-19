<?php

/**
 * Template part for displaying single post content
 *
 * @package Reinfeld
 */

?>

<main class="article">
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1><?php the_title(); ?></h1>

    <div class="meta">
      <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
        <?php echo esc_html(get_the_date()); ?>
      </time>
      <?php if (has_category()) : ?>
        <span class="categories">
          <?php the_category(', '); ?>
        </span>
      <?php endif; ?>
    </div>

    <div class="entry-content">
      <?php
      the_content();

      wp_link_pages(array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'reinfeld'),
        'after'  => '</div>',
      ));
      ?>
    </div>

    <?php if (get_edit_post_link()) : ?>
      <footer class="entry-footer">
        <?php
        edit_post_link(
          sprintf(
            wp_kses(
              /* translators: %s: Name of current post. Only visible to screen readers */
              __('Edit <span class="screen-reader-text">%s</span>', 'reinfeld'),
              array(
                'span' => array(
                  'class' => array(),
                ),
              )
            ),
            get_the_title()
          ),
          '<span class="edit-link">',
          '</span>'
        );
        ?>
      </footer>
    <?php endif; ?>
  </article>

  <?php
  // Navigation zwischen Posts
  $prev_post = get_previous_post();
  $next_post = get_next_post();

  if ($prev_post || $next_post) : ?>
    <nav class="post-navigation" aria-label="<?php esc_attr_e('Navigate between posts', 'reinfeld'); ?>">
      <?php if ($prev_post) : ?>
        <a class="previous" href="<?php echo esc_url(get_permalink($prev_post)); ?>">
          <?php echo esc_html(get_the_title($prev_post)); ?>
        </a>
      <?php endif; ?>

      <?php if ($next_post) : ?>
        <a class="next" href="<?php echo esc_url(get_permalink($next_post)); ?>">
          <?php echo esc_html(get_the_title($next_post)); ?>
        </a>
      <?php endif; ?>
    </nav>
  <?php endif; ?>

  <?php
  // Related Posts Sektion (vereinfacht)
  $related_posts = get_posts(array(
    'numberposts' => 3,
    'post__not_in' => array(get_the_ID()),
    'category__in' => wp_get_post_categories(get_the_ID()),
  ));

  if ($related_posts) : ?>
    <section class="related-posts">
      <h2><?php esc_html_e('Related Posts', 'reinfeld'); ?></h2>
      <ul>
        <?php foreach ($related_posts as $related_post) : ?>
          <li>
            <a href="<?php echo esc_url(get_permalink($related_post)); ?>">
              <?php echo esc_html(get_the_title($related_post)); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
  <?php endif; ?>

  <?php
  // Comments section
  if (comments_open() || get_comments_number()) :
    comments_template();
  endif;
  ?>
</main>
