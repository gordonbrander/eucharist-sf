<?php
// Template Name: Wide
// A page template with an extra-wide content area. Great for large videos,
// calendars, etc.
get_header(); ?>
<div class="units units--page clearfix">
<?php
while ( have_posts() ) : the_post();
    get_template_part( 'entry', 'page-wide' );
endwhile;
?>
</div>
<?php get_footer(); ?>