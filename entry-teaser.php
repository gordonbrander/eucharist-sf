<article class="entry entry--teaser">
    <header class="header">
        <h1 class="title">
            <a href="<?php the_permalink(); ?>" rel="bookmark">
                <?php the_title(); ?>
            </a>
        </h1>
        <?php eusf_posted_on(); ?>
    </header>
    <div class="content">
        <?php the_excerpt(); ?>
    </div>
</article>