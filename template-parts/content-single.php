<?php

/**
 * Template part for displaying single post content
 *
 * @package Reinfeld
 */

?>
<!-- content-single.php -->
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
    ?>
  </div>
</article>

<?php
get_template_part('template-parts/content', 'prevnext');

get_template_part('template-parts/content', 'related');

// Comments section
if (comments_open() || get_comments_number()) :
  comments_template();
endif;
?>
