<?php
/**
 * The template for displaying single posts.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php chagoi_article_schema( 'CreativeWork' ); ?>>
	<div class="inside-article">
		<?php
		/**
		 * chagoi_before_content hook.
		 *
		 *
		 * @hooked chagoi_featured_page_header_inside_single - 10
		 */
		do_action( 'chagoi_before_content' );
		?>

		<header class="entry-header">
			<?php
			/**
			 * chagoi_before_entry_title hook.
			 *
			 */
			do_action( 'chagoi_before_entry_title' );

			if ( chagoi_show_title() ) {
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			}

			/**
			 * chagoi_after_entry_title hook.
			 *
			 *
			 * @hooked chagoi_post_meta - 10
			 */
			do_action( 'chagoi_after_entry_title' );
			?>
		</header><!-- .entry-header -->

		<?php
		/**
		 * chagoi_after_entry_header hook.
		 *
		 *
		 * @hooked chagoi_post_image - 10
		 */
		do_action( 'chagoi_after_entry_header' );
		?>

		<div class="entry-content" itemprop="text">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'chagoi' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<?php
		/**
		 * chagoi_after_entry_content hook.
		 *
		 *
		 * @hooked chagoi_footer_meta - 10
		 */
		do_action( 'chagoi_after_entry_content' );

		/**
		 * chagoi_after_content hook.
		 *
		 */
		do_action( 'chagoi_after_content' );
		?>
	</div><!-- .inside-article -->
</article><!-- #post-## -->
