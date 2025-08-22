<?php

if (get_theme_mod('reinfeld_hide_related_posts', false)) return;

$related_post_ids = array();

// Exclude sticky posts and the current post
$exclude = get_option('sticky_posts');
$exclude[] = $post->ID;

// Arguments used by all the queries below
$base_args = array(
  'orderby'       => 'rand',
  'post__not_in'     => $exclude,
  'post_status'     => 'publish',
  'posts_per_page'   => 4,
);

// Check categories first
$categories = wp_get_post_categories($post->ID);

if ($categories) {

  $categories_args = $base_args;
  $categories_args['category__in'] = $categories;

  $categories_posts = get_posts($categories_args);

  foreach ($categories_posts as $categories_post) {
    $related_post_ids[] = $categories_post->ID;
  }
}

// If we don't get four posts from that, fill up with posts selected at random
if (count($related_post_ids) < 4) {

  // Only with as many as we need though
  $random_post_args = $base_args;
  $random_post_args['posts_per_page'] = 4 - count($related_post_ids);

  $random_posts = get_posts($random_post_args);

  foreach ($random_posts as $random_post) {
    $related_post_ids[] = $random_post->ID;
  }
}

// Get the posts we've scrambled together
$related_posts_args = $base_args;
$related_posts_args['include'] = $related_post_ids;

$related_posts = get_posts($related_posts_args);

if ($related_posts):
  global $post;
?>
  <section aria-labeledby="related-posts-title" class="article-extension">
    <h1 id="related-posts-title"><?php esc_html_e('Related Posts', 'reinfeld'); ?></h1>
    <div class="related-posts">
      <?php foreach ($related_posts as $post):
        setup_postdata($post);
        if (has_post_thumbnail()):
          $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'reinfeld_list-image');
          $image = $image[0];
        endif;
      ?>
        <article>
          <div>
            <?php if (isset($image)): ?>
              <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title($post)); ?>">
            <?php else: ?>
              <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/no-image.png'); ?>" alt="<?php echo esc_attr(get_the_title($post)); ?>">
            <?php endif; ?>
          </div>
          <h2>
            <a href="<?php echo esc_url(get_permalink($post)); ?>">
              <?php echo esc_html(get_the_title($post)); ?>
            </a>
          </h2>
        </article>
      <?php endforeach;
      wp_reset_postdata(); ?>
    </div>
  </section>
<?php
endif;
