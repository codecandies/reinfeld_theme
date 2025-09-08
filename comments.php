<?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>

<?php
if (post_password_required()) {
  return;
}
?>
<?php if ($comments) : ?>
  <section id="comments" class="article-extension comments-area" aria-labeledby="comments-title">
    <h2 id="comments-title">
      <?php
      $comments_number = get_comments_number();
      if ('1' === $comments_number) {
        /* translators: %s: post title */
        printf(esc_html__('One thought on &ldquo;%s&rdquo;', 'reinfeld'), '<span>' . get_the_title() . '</span>');
      } else {
        printf(
          /* translators: 1: number of comments, 2: post title */
          esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comments_number, 'comments title', 'reinfeld')),
          number_format_i18n($comments_number),
          '<span>' . get_the_title() . '</span>'
        );
      }
      ?>
    </h2>

    <ol class="comment-list">
      <?php
      wp_list_comments(array(
        'style'       => 'ol',
        'short_ping'  => true,
        'avatar_size' => 50,
        'callback'    => 'reinfeld_comment', // Use default callback
      ));
      ?>
    </ol>

    <?php
    the_comments_navigation();

    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open()) :
    ?>
      <p class="no-comments"><?php esc_html_e('Comments are closed.', 'reinfeld'); ?></p>
    <?php
    endif;

    comment_form();
    ?>

  </section>
<?php endif; ?>