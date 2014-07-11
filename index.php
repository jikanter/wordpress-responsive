<<<<<<< HEAD
<?php get_header(); ?>
<section id="content" role="main">
=======
<?php /**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */
/* basic template index.php from http://wordpress.org/themes/blankslate, with a tiny customization */ ?>
<?php get_header(); ?>
<section id="content" role="main" class="boomshaka">
>>>>>>> 71fd968cd56e115081d887e419fdf0e470712306
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php comments_template(); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'nav', 'below' ); ?>
</section>
<?php get_sidebar(); ?>
<<<<<<< HEAD
<?php get_footer(); ?>
=======
<?php get_footer(); ?>
>>>>>>> 71fd968cd56e115081d887e419fdf0e470712306
