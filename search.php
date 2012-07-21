<?php
// The main template file.
// 
// This is the most generic template file in a WordPress theme
// and one of the two required files for a theme (the other being style.css).
// It is used to display a page when nothing more specific matches a query.
// E.g., it puts together the home page when no home.php file exists.
// Learn more: http://codex.wordpress.org/Template_Hierarchy
get_header(); ?>
<section class="units units--page clearfix">
    <div class="in unit-8 prefix-2">
    <?php if ( have_posts() ) : ?>
        <header class="header--page">
            <h1 class="title title--page">
                <?php
                printf(
                    __( 'Search Results for &ldquo;%s&rdquo;', 'eusf' ),
                    '<span>' . esc_html(get_search_query()) . '</span>'
                );
                ?>
            </h1>
        </header>
        <?php
        while ( have_posts() ) : the_post();
            // Include the Post-Format-specific template for the content.
            // If you want to overload this in a child theme then include a file
            // called content-___.php (where ___ is the Post Format name) and that
            // will be used instead.
            get_template_part( 'entry-teaser', get_post_format() );
        endwhile;
        eusf_content_nav();
        ?>
    <?php else : ?>
        <?php get_template_part( 'no-results', 'search' ); ?>
    <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>