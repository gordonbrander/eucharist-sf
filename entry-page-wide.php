<article class="entry entry--page">
    <?php if (has_post_thumbnail()): ?>
    <div class="media">
        <?php the_post_thumbnail('hero-widescreen'); ?>
    </div>
    <?php endif ?>
    <div class="in prefix-1 unit-10">
        <h1 class="title"><?php the_title(); ?></h1>
        <div class="content">
            <?php the_content(); ?>
        </div>
    </div>
</article>