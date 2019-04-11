<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<?php do_action( 'vw_furniture_carpenter_before_slider' ); ?>

<?php if( get_theme_mod( 'vw_furniture_carpenter_slider_arrows') != '') { ?>

<section id="slider">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
    <?php $pages = array();
      for ( $count = 1; $count <= 4; $count++ ) {
        $mod = intval( get_theme_mod( 'vw_furniture_carpenter_slider_page' . $count ));
        if ( 'page-none-selected' != $mod ) {
          $pages[] = $mod;
        }
      }
      if( !empty($pages) ) :
        $args = array(
          'post_type' => 'page',
          'post__in' => $pages,
          'orderby' => 'post__in'
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          $i = 1;
    ?>     
    <div class="carousel-inner" role="listbox">
      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
          <img src="<?php the_post_thumbnail_url('full'); ?>"/>
          <div class="carousel-caption">
            <div class="inner_carousel">
              <h2><?php the_title(); ?></h2>
              <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_furniture_carpenter_string_limit_words( $excerpt,25 ) ); ?></p>
              <div class="more-btn">
                <a class="view-more" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e( 'READ MORE', 'vw-furniture-carpenter' ); ?><i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      <?php $i++; endwhile; 
      wp_reset_postdata();?>
    </div>
    <?php else : ?>
        <div class="no-postfound"></div>
    <?php endif;
    endif;?>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
    </a>
  </div>
  <div class="clearfix"></div>
</section>

<?php } ?>

<?php do_action( 'vw_furniture_carpenter_after_slider' ); ?>

<section id="contact-sec">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3">
        <?php if( get_theme_mod( 'vw_furniture_carpenter_phone_text') != ''| get_theme_mod( 'vw_furniture_carpenter_phone_number') != ''){ ?>
          <div class="styling-box">
            <div class="row m-0">
              <div class="col-lg-3 col-md-3 col-3">
                <i class="fas fa-phone"></i>
              </div>
              <div class="col-lg-9 col-md-9 col-9">
                <h6><?php echo esc_html(get_theme_mod('vw_furniture_carpenter_phone_text',''));?></h6>
                <p><?php echo esc_html(get_theme_mod('vw_furniture_carpenter_phone_number',''));?></p>
              </div>
            </div>
          </div>
        <?php }?>
      </div>
      <div class="col-lg-4 col-md-4">
        <?php if( get_theme_mod( 'vw_furniture_carpenter_email_text') != ''| get_theme_mod( 'vw_furniture_carpenter_email_address') != ''){ ?>
          <div class="styling-box">
            <div class="row m-0">
              <div class="col-lg-2 col-md-2 col-3">
                <i class="far fa-envelope"></i>
              </div>
              <div class="col-lg-10 col-md-10 col-9">
                <h6><?php echo esc_html(get_theme_mod('vw_furniture_carpenter_email_text',''));?></h6>
                <p><?php echo esc_html(get_theme_mod('vw_furniture_carpenter_email_address',''));?></p>
              </div>
            </div>
          </div>
        <?php }?>
      </div>
      <div class="col-lg-2 col-md-2 col-4">
        <div class="cart-box">
          <?php if(class_exists('woocommerce')){ ?>
            <span class="cart_no">
              <a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_html_e( 'shopping cart','vw-furniture-carpenter' ); ?>"><i class="fas fa-shopping-basket"></i></a>
              <span class="cart-value"> <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
            </span>
          <?php } ?>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-8">
        <?php if( get_theme_mod( 'vw_furniture_carpenter_contact_button_url') != ''| get_theme_mod( 'vw_furniture_carpenter_contact_button_text') != ''){ ?>
          <div class="contact-butn">
            <a href="<?php echo esc_html(get_theme_mod('vw_furniture_carpenter_contact_button_url',''));?>"><?php echo esc_html(get_theme_mod('vw_furniture_carpenter_contact_button_text',''));?></a>
          </div>
        <?php }?>
      </div>
    </div>
  </div>  
</section>

<?php do_action( 'vw_furniture_carpenter_after_contact' ); ?>

<section id="serv-section">
  <div class="container">
    <?php if( get_theme_mod( 'vw_furniture_carpenter_section_title') != '') { ?>
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/icon.png'); ?>" class="border-image">
      <h3><?php echo esc_html(get_theme_mod('vw_furniture_carpenter_section_title',''));?></h3>
      <hr>
    <?php }?>
    <div class="row">
      <?php
        $catData =  get_theme_mod('vw_furniture_carpenter_services','');
        if($catData){
        $page_query = new WP_Query(array( 'category_name' => esc_html($catData,'vw-furniture-carpenter'))); ?>
        <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
        <div class="col-lg-3 col-md-4">
          <div class="serv-box">
            <?php the_post_thumbnail(); ?>
            <div class="service-inner">
              <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
              <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_furniture_carpenter_string_limit_words( $excerpt,10 ) ); ?></p>
            </div>
          </div>
        </div>
        <?php endwhile;
        wp_reset_postdata();
      } ?>
    </div>
  </div>
</section>

<?php do_action( 'vw_furniture_carpenter_after_services' ); ?>

<div id="content-vw">
  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
  </div>
</div>

<?php get_footer(); ?>