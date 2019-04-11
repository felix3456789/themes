<?php
/**
 * Builds our admin page.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'chagoi_create_menu' ) ) {
	add_action( 'admin_menu', 'chagoi_create_menu' );
	/**
	 * Adds our "Chagoi" dashboard menu item
	 *
	 */
	function chagoi_create_menu() {
		$chagoi_page = add_theme_page( 'Chagoi', 'Chagoi', apply_filters( 'chagoi_dashboard_page_capability', 'edit_theme_options' ), 'chagoi-options', 'chagoi_settings_page' );
		add_action( "admin_print_styles-$chagoi_page", 'chagoi_options_styles' );
	}
}

if ( ! function_exists( 'chagoi_options_styles' ) ) {
	/**
	 * Adds any necessary scripts to the Chagoi dashboard page
	 *
	 */
	function chagoi_options_styles() {
		wp_enqueue_style( 'chagoi-options', get_template_directory_uri() . '/css/admin/style.css', array(), CHAGOI_VERSION );
	}
}

if ( ! function_exists( 'chagoi_settings_page' ) ) {
	/**
	 * Builds the content of our Chagoi dashboard page
	 *
	 */
	function chagoi_settings_page() {
		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="chagoi-masthead clearfix">
					<div class="chagoi-container">
						<div class="chagoi-title">
							<a href="<?php echo esc_url(CHAGOI_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Chagoi', 'chagoi' ); ?></a> <span class="chagoi-version"><?php echo CHAGOI_VERSION; ?></span>
						</div>
						<div class="chagoi-masthead-links">
							<?php if ( ! defined( 'CHAGOI_PREMIUM_VERSION' ) ) : ?>
								<a class="chagoi-masthead-links-bold" href="<?php echo esc_url(CHAGOI_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Premium', 'chagoi' );?></a>
							<?php endif; ?>
							<a href="<?php echo esc_url(CHAGOI_WPKOI_AUTHOR_URL); ?>" target="_blank"><?php esc_html_e( 'WPKoi', 'chagoi' ); ?></a>
                            <a href="<?php echo esc_url(CHAGOI_DOCUMENTATION); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'chagoi' ); ?></a>
						</div>
					</div>
				</div>

				<?php
				/**
				 * chagoi_dashboard_after_header hook.
				 *
				 */
				 do_action( 'chagoi_dashboard_after_header' );
				 ?>

				<div class="chagoi-container">
					<div class="postbox-container clearfix" style="float: none;">
						<div class="grid-container grid-parent">

							<?php
							/**
							 * chagoi_dashboard_inside_container hook.
							 *
							 */
							 do_action( 'chagoi_dashboard_inside_container' );
							 ?>

							<div class="form-metabox grid-70" style="padding-left: 0;">
								<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
								<form method="post" action="options.php">
									<?php settings_fields( 'chagoi-settings-group' ); ?>
									<?php do_settings_sections( 'chagoi-settings-group' ); ?>
									<div class="customize-button hide-on-desktop">
										<?php
										printf( '<a id="chagoi_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
											esc_url( admin_url( 'customize.php' ) ),
											esc_html__( 'Customize', 'chagoi' )
										);
										?>
									</div>

									<?php
									/**
									 * chagoi_inside_options_form hook.
									 *
									 */
									 do_action( 'chagoi_inside_options_form' );
									 ?>
								</form>

								<?php
								$modules = array(
									'Backgrounds' => array(
											'url' => CHAGOI_THEME_URL,
									),
									'Blog' => array(
											'url' => CHAGOI_THEME_URL,
									),
									'Colors' => array(
											'url' => CHAGOI_THEME_URL,
									),
									'Disable Elements' => array(
											'url' => CHAGOI_THEME_URL,
									),
									'Demo Import' => array(
											'url' => CHAGOI_THEME_URL,
									),
									'Hooks' => array(
											'url' => CHAGOI_THEME_URL,
									),
									'Import / Export' => array(
											'url' => CHAGOI_THEME_URL,
									),
									'Menu Plus' => array(
											'url' => CHAGOI_THEME_URL,
									),
									'Page Header' => array(
											'url' => CHAGOI_THEME_URL,
									),
									'Secondary Nav' => array(
											'url' => CHAGOI_THEME_URL,
									),
									'Sections' => array(
											'url' => CHAGOI_THEME_URL,
									),
									'Spacing' => array(
											'url' => CHAGOI_THEME_URL,
									),
									'Typography' => array(
											'url' => CHAGOI_THEME_URL,
									),
									'Elementor Addon' => array(
											'url' => CHAGOI_THEME_URL,
									)
								);

								if ( ! defined( 'CHAGOI_PREMIUM_VERSION' ) ) : ?>
									<div class="postbox chagoi-metabox">
										<h3 class="hndle"><?php esc_html_e( 'Premium Modules', 'chagoi' ); ?></h3>
										<div class="inside" style="margin:0;padding:0;">
											<div class="premium-addons">
												<?php foreach( $modules as $module => $info ) { ?>
												<div class="add-on activated chagoi-clear addon-container grid-parent">
													<div class="addon-name column-addon-name" style="">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php echo esc_html( $module ); ?></a>
													</div>
													<div class="addon-action addon-addon-action" style="text-align:right;">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php esc_html_e( 'Learn more', 'chagoi' ); ?></a>
													</div>
												</div>
												<div class="chagoi-clear"></div>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php
								endif;

								/**
								 * chagoi_options_items hook.
								 *
								 */
								do_action( 'chagoi_options_items' );
								?>
							</div>

							<div class="chagoi-right-sidebar grid-30" style="padding-right: 0;">
								<div class="customize-button hide-on-mobile">
									<?php
									printf( '<a id="chagoi_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
										esc_url( admin_url( 'customize.php' ) ),
										esc_html__( 'Customize', 'chagoi' )
									);
									?>
								</div>

								<?php
								/**
								 * chagoi_admin_right_panel hook.
								 *
								 */
								 do_action( 'chagoi_admin_right_panel' );

								  ?>
                                
                                <div class="wpkoi-doc">
                                	<h3><?php esc_html_e( 'Chagoi documentation', 'chagoi' ); ?></h3>
                                	<p><?php esc_html_e( 'If You`ve stuck, the documentation may help on WPKoi.com', 'chagoi' ); ?></p>
                                    <a href="<?php echo esc_url(CHAGOI_DOCUMENTATION); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Chagoi documentation', 'chagoi' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-social">
                                	<h3><?php esc_html_e( 'WPKoi on Facebook', 'chagoi' ); ?></h3>
                                	<p><?php esc_html_e( 'If You want to get useful info about WordPress and the theme, follow WPKoi on Facebook.', 'chagoi' ); ?></p>
                                    <a href="<?php echo esc_url(CHAGOI_WPKOI_SOCIAL_URL); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Go to Facebook', 'chagoi' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-review">
                                	<h3><?php esc_html_e( 'Help with You review', 'chagoi' ); ?></h3>
                                	<p><?php esc_html_e( 'If You like Chagoi theme, show it to the world with Your review. Your feedback helps a lot.', 'chagoi' ); ?></p>
                                    <a href="<?php echo esc_url(CHAGOI_WORDPRESS_REVIEW); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Add my review', 'chagoi' ); ?></a>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'chagoi_admin_errors' ) ) {
	add_action( 'admin_notices', 'chagoi_admin_errors' );
	/**
	 * Add our admin notices
	 *
	 */
	function chagoi_admin_errors() {
		$screen = get_current_screen();

		if ( 'appearance_page_chagoi-options' !== $screen->base ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
			 add_settings_error( 'chagoi-notices', 'true', esc_html__( 'Settings saved.', 'chagoi' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'imported' == $_GET['status'] ) {
			 add_settings_error( 'chagoi-notices', 'imported', esc_html__( 'Import successful.', 'chagoi' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'reset' == $_GET['status'] ) {
			 add_settings_error( 'chagoi-notices', 'reset', esc_html__( 'Settings removed.', 'chagoi' ), 'updated' );
		}

		settings_errors( 'chagoi-notices' );
	}
}
