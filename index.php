<?php /* basic template index.php from http://wordpress.org/themes/blankslate, with a tiny customization */ ?>
<?php get_header(); ?>
<section id="content" role="main" class="boomshaka">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php comments_template(); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'nav', 'below' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
