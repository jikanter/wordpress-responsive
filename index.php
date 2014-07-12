<?php /* basic template index.php from http://wordpress.org/themes/blankslate, with a tiny customization */ ?>
<?php get_header(); ?>
<section id="content" role="main" class="boomshaka">
	<?php 
		if ( have_posts() ) : 
			while ( have_posts() ) : 
				the_post(); 
	?>
<?php 		
			endwhile; 
			the_content();
		 else:
			 echo apply_filters('the_content', get_option('404_content'), show_index_page() );
		endif; 
?>
<?php get_template_part( 'nav', 'below' ); ?>
</section>
<div id="sidebar">
</div>
<?php get_footer(); ?>
