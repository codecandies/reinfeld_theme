<?php

/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Reinfeld
 */
?>

<section class="no-results not-found">
  <header class="page-header">
    <h1 class="page-title"><?php esc_html_e('Nothing here', 'reinfeld'); ?></h1>
  </header>

  <div class="page-content">
    <?php if (is_home() && current_user_can('publish_posts')) : ?>

      <p>
        <?php
        printf(
          wp_kses(
            /* translators: %s: Link to create a new post */
            __('Ready to publish your first post? <a href="%s">Get started here</a>.', 'reinfeld'),
            array(
              'a' => array(
                'href' => array(),
              ),
            )
          ),
          esc_url(admin_url('post-new.php'))
        );
        ?>
      </p>

    <?php elseif (is_search()) : ?>

      <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'reinfeld'); ?></p>
      <?php get_search_form(); ?>

    <?php else : ?>

      <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'reinfeld'); ?></p>
      <?php get_search_form(); ?>

    <?php endif; ?>
  </div>
</section>
