<?php
/**
 * Cloned from first boomshaka theme
 *
 * code copied from adjacent_image_link() in wp-include/media.php
 * Clicking attachment image proceeds to next image
 * http://pixert.com/blog/wordpress-click-an-attachment-image-to-view-next-image-in-order/
 */
$attachments = array_values(get_children( array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') ));
foreach ( $attachments as $k => $attachment )
  if ( $attachment->ID == $post->ID )
    break;

$next_url =  isset($attachments[$k+1]) ? get_permalink($attachments[$k+1]->ID) : get_permalink($attachments[0]->ID);
?>
<?php
/**

 */
?>
<?php get_header(); ?>
<?php global $post; ?>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<header class="header">
</header>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="header">
</header>
<section class="entry-content">
<div class="entry-attachment">
<?php if ( wp_attachment_is_image( $post->ID ) ) : $att_image = wp_get_attachment_image_src( $post->ID, "full-size" ); ?>
<p class="attachment"><a href="<?php echo $next_url; ?>"><?php echo wp_get_attachment_image( $post->ID, $size='fullsize' ); ?></a></p>
<?php else : ?>
<?php endif; ?>
</div>
<div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>
<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
</section>
</article>
<?php comments_template(); ?>
<?php endwhile; endif; ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>