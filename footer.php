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
		Artist Websites by <a href="http://boomshaka.starschreck.com/signup">Boomshaka</a>. Show your work to the world.
		
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
