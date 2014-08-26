<?php
/**
	* Template Name: Regular Page
	* @package WordPress
 	* @subpackage Mayconnect
**/

get_header(); ?>
<!-- MAKE AN ARCHIVE WIDGET HERE -->
<h2 class="invisible"><?php the_title( ); ?></h2>
<div class="content">
<?php if ( have_posts() ) : while ( have_posts() ) :the_post();
    the_content();
  endwhile;
  endif;?>
</div>

<?php get_footer(); ?>
