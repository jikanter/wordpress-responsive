<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package boomshaka
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		
		<div class="site-info">
		<p>Copyright &copy; <?php echo date("Y") ?> <?php bloginfo( 'name' ); ?>. <?php bloginfo( 'description' ); ?>. </p>
			<?php printf( __( 'WordPress x %1$s = %2$s.', 'boomshaka' ), 'boomshaka', '<a href="http://boomshaka.starschreck.com/signup" rel="designer">Boomshakalaka</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
