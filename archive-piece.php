<?php
/**
 * The template for displaying archive pages with custom post type 'piece'.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package boomshaka
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'boomshaka' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'boomshaka' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'boomshaka' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'boomshaka' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'boomshaka' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'boomshaka' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'boomshaka' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'boomshaka' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'boomshaka' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'boomshaka' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'boomshaka' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'boomshaka' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'boomshaka' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'boomshaka' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'boomshaka' );

						else :
							_e( 'Pieces', 'boomshaka' );

						endif;
					?>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
        <?php
        // Start the Loop
        while ( have_posts() ) : the_post(); ?>
 
        <article class="entry-content type-piece">
            <?php $attr = array(
                'class' => "archive-image",
                //'alt' => trim( strip_tags( $wp_postmeta->_wp_attachment_image_alt ) ),
            ); ?>
            <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
			
            <a href="<?php echo $url; ?>"><?php the_post_thumbnail( 'thumbnail', $attr ); ?></a>
            <!-- <h2 class="piece-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2> -->
            <section>
              <!--  <?php the_content(); ?> -->
            </section>
        </article>
        
              <?php endwhile; ?>

			<?php boomshaka_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
