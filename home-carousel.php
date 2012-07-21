<?php
// Template Name: Home Carousel
// 
// Displays a carousel of images and content, created from the contents of the
// page's gallery. Does not include content for the page.
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <div id="carousel" class="carousel slide">
        <ul class="carousel--slides carousel-inner">
            <?php eusf_carousel(get_the_ID()); ?>
        </ul>
        <a href="#carousel" class="left carousel-control ir ir--button-prev" data-slide="prev">&larr; Previous</a>
        <a href="#carousel" class="left carousel-control ir ir--button-next" data-slide="next">Next &rarr; </a>
    </div>
<?php endwhile; // end of the loop. ?>
<div class="units clearfix">

</div>
<?php get_footer(); ?>