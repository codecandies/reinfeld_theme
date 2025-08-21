<?php
// Navigation zwischen Posts
$prev_post = get_previous_post();
$next_post = get_next_post();

if ($prev_post || $next_post) : ?>
  <!-- content-prevnext.php -->
  <section aria-labelledby="prev-next-posts-title">
    <h1 id="prev-next-posts-title"><?php esc_html_e('Next posts', 'reinfeld'); ?></h1>
    <div class="prev-next-posts">
      <?php if ($prev_post) : ?>
        <p>
          <a class="previous" href="<?php echo esc_url(get_permalink($prev_post)); ?>">
            <?php echo esc_html(get_the_title($prev_post)); ?>
          </a>
        </p>
      <?php endif; ?>
      <?php if ($next_post) : ?>
        <p>
          <a class="next" href="<?php echo esc_url(get_permalink($next_post)); ?>">
            <?php echo esc_html(get_the_title($next_post)); ?>
          </a>
        </p>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>
