<?php
/**
 * shopstore Layout Hook
 *
 * @link https://developer.wordpress.org/themes/functionality/
 *
 * @package shopstore
 */

if( !function_exists('shopstore_header_container_top') ):
function shopstore_header_container_top(){
?>
<style>
.header-top{
    background: #00ccff;
}
.centerTitle{
    text-align: center;
}
.rd-navbar-inner{
    background-color:white;
}
.rd-navbar-outer {
    background:white;
}
.rd-navbar-static .rd-navbar-nav > li.active > a, .rd-navbar-static .rd-navbar-nav > li.opened > a, .rd-navbar-static .rd-navbar-nav > li.focus > a, .rd-navbar-static .rd-navbar-nav > li > a:hover {
    color: white;
    background: #00ccff;
}
.rd-navbar-static .rd-navbar-nav > li > a {
    color:#000;
}
.footer-bottom{
    border-top:5px solid; 
    border-top-color:#00ccff;
}
</style>
<div class="header-top">
       
    </div><!-- /.header-top -->

<?php	
}
endif;
add_action( 'shopstore_header_container', 'shopstore_header_container_top',10 );




if( !function_exists('shopstore_header_container_middle') ):
function shopstore_header_container_middle(){
?>

<div class="header-middle">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="logo" class="centerTitle logo">
			<?php
            if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
            the_custom_logo();
            }else{
            ?>	
                <h1 class="logo site-title"><a href="<?php echo esc_url( home_url( '' ) ); ?>" rel="home" class="site-title"><?php bloginfo( 'name' ); ?></a></h1>
                <?php $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                    <div class="site-description"><?php echo esc_html($description); ?></div>
                <?php endif; ?>
            <?php }?>  

            </div><!-- /#logo -->
        </div><!-- /.col-md-3 -->
		<?php
        /**
        * Hook - shopstore_top_product_search 		- 10
        * @hooked shopstore_top_product_search
        */
        do_action( 'shopstore_top_product_search' );
        ?> 

    </div><!-- /.row -->
</div><!-- /.container -->
</div><!-- /.header-middle -->

<?php	

}
endif;
add_action( 'shopstore_header_container', 'shopstore_header_container_middle',20 );


if( !function_exists('shopstore_header_container_bottom') ):
function shopstore_header_container_bottom(){
?>

<!-- RD Navbar -->
<div class="rd-navbar-wrap">
    <nav class="rd-navbar rd-navbar-transparent" >
        <div class="rd-navbar-inner">
            <!-- RD Navbar Panel -->
            <div class="rd-navbar-panel">
                <div class="rd-navbar-panel-canvas"></div>
                <!-- RD Navbar Toggle -->
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span>
                </button>
            </div>
            <!-- END RD Navbar Panel -->
        </div>
        <div class="rd-navbar-outer">
            <div class="rd-navbar-inner">
				

                <div class="rd-navbar-subpanel">
                    <div class="rd-navbar-nav-wrap">
                        <!-- RD Navbar Nav -->
						<?php
                        wp_nav_menu( array(
                            'theme_location'    => 'primary',
                            'depth'             => 3,
                            'menu_class'  		=> 'menu rd-navbar-nav',
                            'container'			=>'ul',
                            'walker' => new shopstore_Navwalker(),
							'fallback_cb'       => 'shopstore_Navwalker::fallback',
                        ) );
                        ?>
                        <!-- END RD Navbar Nav -->
                    </div>

                </div>
            </div>
        </div>
    </nav>
</div>

<?php	
}
endif;
add_action( 'shopstore_header_container', 'shopstore_header_container_bottom',30 );


if ( ! function_exists( 'shopstore_banner_heading' ) ) :

	/**
	 * Add Banner Title.
	 *
	 * @since 1.0.0
	 */
	function shopstore_banner_heading() {
		 echo '<div class="site-header-text-wrap">';
		
			if ( is_home() ) {
					echo '<h1 class="page-title-text">';
					echo bloginfo( 'name' );
					echo '</h1>';
					echo '<p class="subtitle">';
					echo esc_html(get_bloginfo( 'description', 'display' ));
					echo '</p>';
			}else if ( function_exists('is_shop') && is_shop() ){
				if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					echo '<h1 class="page-title-text">';
					echo esc_html( woocommerce_page_title() );
					echo '</h1>';
				}
			}else if( function_exists('is_product_category') && is_product_category() ){
				echo '<h1 class="page-title-text">';
				echo esc_html( woocommerce_page_title() );
				echo '</h1>';
				echo '<p class="subtitle">';
				do_action( 'woocommerce_archive_description' );
				echo '</p>';
				
			}elseif ( is_singular() ) {
				echo '<h1 class="page-title-text">';
					echo single_post_title( '', false );
				echo '</h1>';
			} elseif ( is_archive() ) {
				the_archive_title( '<h1 class="page-title-text">', '</h1>' );
			} elseif ( is_search() ) {
				echo '<h1 class="title">';
					printf( /* translators:straing */ esc_html__( 'Search Results for: %s', 'shopstore' ),  get_search_query() );
				echo '</h1>';
			} elseif ( is_404() ) {
				echo '<h1 class="display-1">';
					esc_html_e( 'Oops! That page can&rsquo;t be found.', 'shopstore' );
				echo '</h1>';
			}
		
		echo '</div>';
	}

endif;

if ( ! function_exists( 'shopstore_static_banner_container' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function shopstore_static_banner_container() {
		
		$header_image = get_header_image();
		echo '<div class="site-header">';
		
			if( function_exists('shopstore_banner_heading') ){ shopstore_banner_heading(); }
			
			if( $header_image !="" ){ 
				echo '<div class="site-header-bg-wrap">
					<div class="site-header-bg background-effect" style="background-image: url('.esc_url( $header_image ).'); opacity: 0.6; background-attachment: scroll;"></div>
				</div>
				';
			}	
			
		echo '</div>';
	}

endif;

add_action( 'shopstore_banner_container', 'shopstore_static_banner_container',40 );

/*-----------------------------------------
* PAGE CONTAINER 
*----------------------------------------*/
if( !function_exists('shopstore_page_container_wrp_start') ):
	function shopstore_page_container_wrp_start( $arg = 'gsdf' ) {
		if( !is_array( $arg ) ){ $arg = array(); }
		
		$arg['section'] = ( empty( $arg['section'] ) ) ? 'main-blog': $arg['section'];
		$arg['container'] = ( empty( $arg['container'] ) ) ? 'container': $arg['container'];
		
		?>
        <section class="<?php echo esc_attr( $arg['section'] );?>">
        <div class="<?php echo esc_attr( $arg['container'] );?>">
            <div class="row">
        <?php
	}
endif;	
add_action( 'shopstore_page_container_start', 'shopstore_page_container_wrp_start',10 );



if( !function_exists('shopstore_page_container_column') ):
	function shopstore_page_container_column( $arg = array() ) {
		if( !is_array( $arg ) ){ $arg = array(); } 	
		$arg['column'] = ( !isset( $arg['column'] ) ) ? 'col-md-8' : $arg['column'] ;
		?>
        <div class="<?php echo esc_attr( $arg['column'] );?>">
        <?php
	}
endif;	
add_action( 'shopstore_page_container_start', 'shopstore_page_container_column',20 );



/*-----------------------------------------
* PAGE CONTAINER  END
*----------------------------------------*/
if( !function_exists('shopstore_page_container_column_end') ):
	function shopstore_page_container_column_end() {
		?>
         </div>
        <?php
	}
endif;	
add_action( 'shopstore_page_container_end', 'shopstore_page_container_column_end',10 );



if( !function_exists('shopstore_page_container_sidebar') ):
	function shopstore_page_container_sidebar( $arg = array() ) {
		if( !is_array( $arg ) ){ $arg = array(); }
		$arg['sidebar'] = ( isset( $arg['sidebar'] ) && $arg['sidebar'] == 'inactive' ) ? 'inactive' : '' ;
		$arg['sidebar_column'] = ( !isset( $arg['sidebar_column'] ) ) ? 'col-md-4' : $arg['sidebar_column'] ;
		
		if( $arg['sidebar'] != 'inactive' ):
		?> 
        <div class="<?php echo esc_attr( $arg['sidebar_column'] );?>">
            <div class="sidebar">
                <?php get_sidebar();?>
            </div>
        </div>
        <?php
		endif;
		
	}
endif;	
add_action( 'shopstore_page_container_end', 'shopstore_page_container_sidebar',20 );



if( !function_exists('shopstore_page_container_wrp_end') ):
	function shopstore_page_container_wrp_end( $arg = array() ) {
		?>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>
        <?php
	}
endif;	
add_action( 'shopstore_page_container_end', 'shopstore_page_container_wrp_end',100 );




