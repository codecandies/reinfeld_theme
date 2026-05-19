</main> <!-- footer.php: /main -->
<footer>
  <div class="footer">
    <div class="footer-widgets">
      <div class="footer-col">
        <?php dynamic_sidebar("footer-1"); ?>
      </div>
      <div class="footer-col">
        <?php dynamic_sidebar("footer-2"); ?>
      </div>
      <div class="footer-col">
        <?php dynamic_sidebar("footer-3"); ?>
      </div>
    </div>

    <div class="footer-secondary">
      <div class="footer-secondary-left">
        <?php get_template_part("template-parts/webring-navigation"); ?>
      </div>
      <div class="footer-secondary-right">
        <?php get_template_part("template-parts/theme-toggle"); ?>
      </div>
    </div>

    <div class="footer-colophon">
      <?php get_template_part("template-parts/colophon"); ?>
    </div>
  </div>
</footer>
</div><!-- footer.php: /.page -->

<!-- wp_footer -->
<?php wp_footer(); ?>
<!-- /wp_footer -->

</body>

</html>
