<?php
/**
 * The template for displaying the footer.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

	</div><!-- #content -->
</div><!-- #page -->

<?php
/**
 * chagoi_before_footer hook.
 *
 */
do_action( 'chagoi_before_footer' );
?>

<div <?php chagoi_footer_class(); ?>>
	<?php
	/**
	 * chagoi_before_footer_content hook.
	 *
	 */
	do_action( 'chagoi_before_footer_content' );

	/**
	 * chagoi_footer hook.
	 *
	 *
	 * @hooked chagoi_construct_footer_widgets - 5
	 * @hooked chagoi_construct_footer - 10
	 */
	do_action( 'chagoi_footer' );

	/**
	 * chagoi_after_footer_content hook.
	 *
	 */
	do_action( 'chagoi_after_footer_content' );
	?>
</div><!-- .site-footer -->

<?php
/**
 * chagoi_after_footer hook.
 *
 */
do_action( 'chagoi_after_footer' );

wp_footer();
?>

</body>
</html>
