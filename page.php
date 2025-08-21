<?php

/**
 * The template for displaying all pages
 *
 * @package Reinfeld
 */

get_header();
?>

<?php
while (have_posts()) :
  the_post();
?>
  <!-- page.php -->
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1><?php the_title(); ?></h1>

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
  // If comments are open or we have at least one comment, load up the comment template.
  if (comments_open() || get_comments_number()) :
    comments_template();
  endif;
  ?>
<?php
endwhile; // End of the loop.
?>


<?php
get_footer();
