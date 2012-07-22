<?php get_header(); ?>
<div class="units units--page clearfix">
<?php
while ( have_posts() ) : the_post();
    get_template_part( 'entry', 'page' );
endwhile;
?>
</div>
<?php get_footer(); ?>