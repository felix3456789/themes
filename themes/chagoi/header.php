<?php
/**
 * The template for displaying the header.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php chagoi_body_schema();?> <?php body_class(); ?>>
	<?php
	/**
	 * chagoi_before_header hook.
	 *
	 *
	 * @hooked chagoi_do_skip_to_content_link - 2
	 * @hooked chagoi_top_bar - 5
	 * @hooked chagoi_add_navigation_before_header - 5
	 */
	do_action( 'chagoi_before_header' );

	/**
	 * chagoi_header hook.
	 *
	 *
	 * @hooked chagoi_construct_header - 10
	 */
	do_action( 'chagoi_header' );

	/**
	 * chagoi_after_header hook.
	 *
	 *
	 * @hooked chagoi_featured_page_header - 10
	 */
	do_action( 'chagoi_after_header' );
	?>

	<div id="page" class="hfeed site grid-container container grid-parent">
		<div id="content" class="site-content">
			<?php
			/**
			 * chagoi_inside_container hook.
			 *
			 */
			do_action( 'chagoi_inside_container' );
