</main> <!-- footer.php: /main -->
<footer>
  <div class="footer">
    <div class="footer-widgets">
      <div class="footer-col">
        <?php dynamic_sidebar("footer-1"); ?>
        <div id="site-footer-nav" class="footer-nav">
          <?php get_template_part("template-parts/main-navigation"); ?>
        </div>
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
        <?php get_template_part("template-parts/colophon"); ?>
      </div>
      <div class="footer-secondary-right">
        <?php get_template_part("template-parts/theme-toggle"); ?>
      </div>
    </div>
  </div>
</footer>
</div><!-- footer.php: /.page -->

<!-- wp_footer -->
<?php wp_footer(); ?>
<!-- /wp_footer -->

</body>

</html>
