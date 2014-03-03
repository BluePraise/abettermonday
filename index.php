<?php
/*
*	Template Name: Index Page
*/
get_header();
?>

		<?php if ( have_posts() ) : ?>

			<?php query_posts('cat=-22'); ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
							<div class="entry-date"><?php mayconnect_entry_date();?></div>

							<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
								<div class="entry-thumbnail">
					 				<?php the_post_thumbnail(); ?>
								</div>
							<?php endif; ?>

						</header><!-- .entry-header -->

						<footer class="entry-meta">
							<?php if ( comments_open() && have_comments() && ! is_single() ) : ?>
								<div class="comments-link">
									<?php comments_popup_link( '<span class="leave-reply">' . __( 'Any thoughts about this?', '' ) . '</span>', __( 'One genius comment', '' ), __( 'View all % responses', '' ) ); ?>
								</div><!-- .comments-link -->


							<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
								<?php get_template_part( 'author-bio' ); ?>
							<?php endif; ?>
						</footer><!-- .entry-meta -->

			<?php endwhile; ?>
		</article><!-- #post -->

		<?php endif; ?>
		</div>
		</div> <!-- #content -->
	</div> <!-- #primary -->
<?php get_footer(); ?>

