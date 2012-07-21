    <footer id="footer" class="units clearfix">
        <div class="unit-4">
            <?php dynamic_sidebar('footer-1'); ?>
        </div>
        <div class="unit-4">
            <?php dynamic_sidebar('footer-2'); ?>
        </div>
        <div class="unit-4">
            <?php dynamic_sidebar('footer-3'); ?>
        </div>
        <p class="unit-12 legal">&copy; <?php the_time('Y'); ?> <?php bloginfo(); ?></p>
    </footer>
</div><!--/container -->
<?php wp_footer(); ?>
</body>
</html>