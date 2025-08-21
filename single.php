<?php

/**
 * The template for displaying all single posts
 *
 * @package Reinfeld
 */

get_header();
?>
<!-- single.php -->
<?php
while (have_posts()) :
  the_post();
  get_template_part('template-parts/content', 'single');
endwhile;
?>


<?php
get_footer();
