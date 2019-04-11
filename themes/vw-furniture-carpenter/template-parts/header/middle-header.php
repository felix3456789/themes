<?php
/**
 * The template part for header
 *
 * @package VW Furniture Carpenter 
 * @subpackage vw_furniture_carpenter
 * @since VW Furniture Carpenter 1.0
 */
?>

<div class="main-header">
  <div class="container">
    <div class="inner-header">
      <div class="row">
        <div class="col-lg-3 col-md-3">
          <div class="logo">
            <?php if( has_custom_logo() ){ vw_furniture_carpenter_the_custom_logo();
              }else{ ?>
                <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo esc_html($description); ?></p>
            <?php endif; } ?>
          </div>
        </div>
        <div class="col-lg-8 col-md-8">
          <?php get_template_part( 'template-parts/header/navigation' ); ?>
        </div>
        <?php if( get_theme_mod( 'vw_furniture_carpenter_header_search') != '') { ?>
          <div class="col-lg-1 col-md-1">
            <div class="search-box">
              <span><i class="fas fa-search"></i></span>
            </div>
          </div>
        <?php }?>
      </div>
      <div class="serach_outer">
        <div class="closepop"><i class="far fa-window-close"></i></div>
        <div class="serach_inner">
          <?php get_search_form(); ?>
        </div>
      </div>
    </div>
  </div>
</div>