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
		<p>Copyright&nbsp;&copy;&nbsp;<?php echo date("Y") ?>&nbsp;<?php bloginfo( 'name' ); ?>. <?php bloginfo( 'description' ); ?>.</p>
		Artist Websites by <a href="http://boomshaka.starschreck.com/signup">Boomshaka</a>. Show&nbsp;your&nbsp;work&nbsp;to&nbsp;the&nbsp;world.
		
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
