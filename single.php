<?php

/**
 * The template for displaying all single posts
 *
 * @package Reinfeld
 */

get_header();
?>

<div class="page">
  <?php
  while (have_posts()) :
    the_post();
    get_template_part('template-parts/content', 'single');
  endwhile;
  ?>
</div>

<?php
get_footer();
