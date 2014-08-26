<?php
/*
*	Template Name: Index Page
*/
get_header();
?>

<div class="front-content-info content">
<?php if ( have_posts() ) : while ( have_posts() ) :the_post();
    the_content();
  endwhile;
  endif;?>
</div>


<?php get_footer(); ?>



