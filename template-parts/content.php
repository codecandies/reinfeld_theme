<?php

/**
 * Template part for displaying posts in archive context
 *
 * @package Reinfeld
 */

?>

<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
<p>
  <?php
  $excerpt = get_the_excerpt();
  if ($excerpt) {
    echo esc_html($excerpt);
    echo '&nbsp;<a class="continue ui-button" href="' . esc_url(get_permalink()) . '" aria-hidden="true" tabindex="-1">' . esc_html__('Continue reading', 'reinfeld') . '</a>';
  }
  ?>
</p>
</div>

<?php if (is_singular() && (get_edit_post_link())) : ?>
  <footer class="entry-footer">
    <?php
    edit_post_link(
      sprintf(
        wp_kses(
          /* translators: %s: Post title */
          __('Edit<span class="screen-reader-text"> "%s"</span>', 'reinfeld'),
          array(
            'span' => array(
              'class' => array(),
            ),
          )
        ),
        wp_kses_post(get_the_title())
      ),
      '<span class="edit-link">',
      '</span>'
    );
    ?>
  </footer>
<?php endif; ?>
</article>
