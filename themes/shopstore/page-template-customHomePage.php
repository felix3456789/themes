
<?php
/*Template Name: Custom Home*/
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shopstore
 */
$arg = array( 'section' => 'page-container' );
?>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="boxed">


<section id="header" class="header">
    
	<?php
    /**
    * Hook - shopstore_header_top 		- 10
	* Hook - shopstore_header_middle 	- 20.
	* Hook - shopstore_header_bottom 	- 30.
    *
    * @hooked shopstore_header_container
    */
    do_action( 'shopstore_header_container' );
    ?> 
    
</section>
<div class="row">
<?php echo do_shortcode('[fwrsw_print_responsive_full_width_slider_wp]'); ?>
</div>
<section class="page-container">
<div class="container">
<div class="row">
<div class="col-md-12">
	<div id="primary" class="home-page-content content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- /.row -->
        </div><!-- /.container -->
    </section>
<?php

    /**
    * Hook - shopstore_page_container_wrp_end - 100
	* Hook - shopstore_header_middle 	- 20.
	* Hook - shopstore_header_bottom 	- 30.
    *
    * @hooked shopstore_header
    */
get_footer();?>