<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php chagoi_content_class(); ?>>
		<main id="main" <?php chagoi_main_class(); ?>>
			<?php
			/**
			 * chagoi_before_main_content hook.
			 *
			 */
			do_action( 'chagoi_before_main_content' );
			?>

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
					<h1 class="entry-title" itemprop="headline"><?php echo apply_filters( 'chagoi_404_title', __( 'Oops! That page can&rsquo;t be found.', 'chagoi' ) ); // WPCS: XSS OK. ?></h1>
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
					echo '<p>' . apply_filters( 'chagoi_404_text', __( 'It looks like nothing was found at this location. Maybe try searching?', 'chagoi' ) ) . '</p>'; // WPCS: XSS OK.

					get_search_form();
					?>
				</div><!-- .entry-content -->

				<?php
				/**
				 * chagoi_after_content hook.
				 *
				 */
				do_action( 'chagoi_after_content' );
				?>

			</div><!-- .inside-article -->

			<?php
			/**
			 * chagoi_after_main_content hook.
			 *
			 */
			do_action( 'chagoi_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * chagoi_after_primary_content_area hook.
	 *
	 */
	 do_action( 'chagoi_after_primary_content_area' );

	 chagoi_construct_sidebars();

get_footer();
