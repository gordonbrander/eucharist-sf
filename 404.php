<?php get_header(); ?>
<div class="units units--page clearfix">
    <section class="entry entry--page">
        <div class="in unit-8 prefix-2">
            <h1 class="title"><?php _e('Page Not Found', 'eusf'); ?></h1>
            <div class="content">
                <p><?php _e('Sorry, we couldn&rsquo;t find the page you were looking for.') ?></p>
                <p>Would you like to head to the <a href="<?php echo home_url('/'); ?>">home page</a>?</p>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>