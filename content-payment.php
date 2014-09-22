<?php
/**
 * The payment template
 *
 * @package boomshaka
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class() ?>>
  <header class="entry-header">
    <h1 class="entry-title">Checkout: Boomshaka payment</h1>
  </head><!-- .entry-header -->
  
  <div class="entry-content">
    <?php the_content() ?>
    <?php
    wp_link_pages(array(
      'before' => '<div class="page-links">' . __( 'Pages:', 'boomshaka' ),
      'after'  => '</div>',
      ) );
    ?>
  </div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'boomshaka' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article>