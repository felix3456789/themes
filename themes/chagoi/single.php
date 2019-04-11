<?php
/**
 * The Template for displaying all single posts.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php chagoi_content_class();?>>
		<main id="main" <?php chagoi_main_class(); ?>>
			<?php
			/**
			 * chagoi_before_main_content hook.
			 *
			 */
			do_action( 'chagoi_before_main_content' );

			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'single' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || '0' != get_comments_number() ) :
					/**
					 * chagoi_before_comments_container hook.
					 *
					 */
					do_action( 'chagoi_before_comments_container' );
					?>

					<div class="comments-area">
						<?php comments_template(); ?>
					</div>

					<?php
				endif;

			endwhile;

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
