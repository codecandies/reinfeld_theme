<?php
// Navigation zwischen Posts
$prev_post = get_previous_post();
$next_post = get_next_post();

if ($prev_post || $next_post) : ?>
  <!-- content-prevnext.php -->
  <section aria-labelledby="prev-next-posts-title" class="article-extension">
    <h1 id="prev-next-posts-title"><?php esc_html_e('Next posts', 'reinfeld'); ?></h1>
    <div class="prev-next-posts">
      <?php if ($prev_post) : ?>
        <div class="prev">
          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 12">
            <path fill-rule="evenodd" d="M4.06 4.94h10.425v2.12H4.061L7.5 10.5 6 12 .75 6.75 0 6l6-6 1.5 1.5z" />
          </svg>
          <a href="<?php echo esc_url(get_permalink($prev_post)); ?>">
            <?php echo esc_html(get_the_title($prev_post)); ?>
          </a>
        </div>
      <?php endif; ?>
      <?php if ($next_post) : ?>
        <div class="next">
          <a href="<?php echo esc_url(get_permalink($next_post)); ?>">
            <?php echo esc_html(get_the_title($next_post)); ?>
          </a>
          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 12">
            <path fill-rule="evenodd" d="M10.425 7.06H0V4.94h10.425L6.985 1.5l1.5-1.5 5.25 5.25.75.75-6 6-1.5-1.5z" />
          </svg>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>
