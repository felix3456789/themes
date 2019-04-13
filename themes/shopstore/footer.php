<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shopstore
 */

?>

		<?php if ( is_active_sidebar( 'footer' ) ) { ?>
		<footer>
			<div class="container">
            	<?php if ( is_active_sidebar( 'footer' ) ) { ?>
                    <div class="row">
                        <?php dynamic_sidebar( 'footer' ); ?>
                    </div>
                <?php }?>
			</div><!-- /.container -->
		</footer><!-- /footer -->
 		<?php }?>
		<section class="footer-bottom">
		<div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="flat-support">
                    	<?php if ( get_theme_mod('location') != "" ) : ?>
                        <li><i class="fa fa-map-marker"></i><?php echo esc_html( get_theme_mod('location') );?></li>
                        <?php endif;?>
                        <?php if ( get_theme_mod('email') != "" ) : ?>
                        <li><i class="fa fa-envelope"></i><?php echo esc_html( get_theme_mod('email') );?> </li>
                        <?php endif;?>
                        <?php if ( get_theme_mod('phone') != "" ) : ?>
                        <li><i class="fa fa-phone"></i><?php echo esc_html( get_theme_mod('phone') );?> </li>
                        <?php endif;?>
                    </ul><!-- /.flat-support -->
                </div>
                <div class="col-md-6">
                   
					<?php
                        wp_nav_menu( array(
                            'theme_location'    => 'top_bar_navigation',
                            'depth'             => 2,
                            'menu_class'  		=> 'flat-unstyled',
                            'container'			=>'ul',
                            'fallback_cb'    => false,
                        ) );
                    ?>	
                   
                </div><!-- /.col-md-4 -->
                <div class="clearfix"></div>
            </div><!-- /.row -->
        </div><!-- /.container -->
		</section><!-- /.footer-bottom -->
</div><!-- /.boxed -->

<a href="javascript:void(0)" id="backToTop" class="ui-to-top"><?php echo esc_html__( 'BACK TO TOP', 'shopstore' );?><i class="fa fa-long-arrow-up"></i></a>

<?php wp_footer(); ?>
</body>
</html>
