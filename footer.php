<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 */
?>

		</div><!-- #page -->

		<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="footer-info">
					<span>Copyright &copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?> Alle rechten voorbehouden.</span>
					<span>Deze site is gebouwd door <a href="http://mayconnect.org" alt="Magalie Linda Website">Magalie Linda</a></span>
			</div> <!--end footerinfo -->

		</footer><!-- #colophon -->

	<?php wp_footer(); ?>
</body>
</html>
