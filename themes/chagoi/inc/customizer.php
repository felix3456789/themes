<?php
/**
 * Builds our Customizer controls.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'customize_register', 'chagoi_set_customizer_helpers', 1 );
/**
 * Set up helpers early so they're always available.
 * Other modules might need access to them at some point.
 *
 */
function chagoi_set_customizer_helpers( $wp_customize ) {
	// Load helpers
	require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';
}

if ( ! function_exists( 'chagoi_customize_register' ) ) {
	add_action( 'customize_register', 'chagoi_customize_register' );
	/**
	 * Add our base options to the Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function chagoi_customize_register( $wp_customize ) {
		// Get our default values
		$defaults = chagoi_get_defaults();

		// Load helpers
		require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';

		if ( $wp_customize->get_control( 'blogdescription' ) ) {
			$wp_customize->get_control('blogdescription')->priority = 3;
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		}

		if ( $wp_customize->get_control( 'blogname' ) ) {
			$wp_customize->get_control('blogname')->priority = 1;
			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		}

		if ( $wp_customize->get_control( 'custom_logo' ) ) {
			$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';
		}

		// Add control types so controls can be built using JS
		if ( method_exists( $wp_customize, 'register_control_type' ) ) {
			$wp_customize->register_control_type( 'Chagoi_Customize_Misc_Control' );
			$wp_customize->register_control_type( 'Chagoi_Range_Slider_Control' );
		}

		// Add upsell section type
		if ( method_exists( $wp_customize, 'register_section_type' ) ) {
			$wp_customize->register_section_type( 'Chagoi_Upsell_Section' );
		}

		// Add selective refresh to site title and description
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector' => '.main-title a',
				'render_callback' => 'chagoi_customize_partial_blogname',
			) );

			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector' => '.site-description',
				'render_callback' => 'chagoi_customize_partial_blogdescription',
			) );
		}

		// Remove title
		$wp_customize->add_setting(
			'chagoi_settings[hide_title]',
			array(
				'default' => $defaults['hide_title'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'chagoi_settings[hide_title]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Hide site title', 'chagoi' ),
				'section' => 'title_tagline',
				'priority' => 2
			)
		);

		// Remove tagline
		$wp_customize->add_setting(
			'chagoi_settings[hide_tagline]',
			array(
				'default' => $defaults['hide_tagline'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'chagoi_settings[hide_tagline]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Hide site tagline', 'chagoi' ),
				'section' => 'title_tagline',
				'priority' => 4
			)
		);

		$wp_customize->add_setting(
			'chagoi_settings[retina_logo]',
			array(
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'chagoi_settings[retina_logo]',
				array(
					'label' => __( 'Retina Logo', 'chagoi' ),
					'section' => 'title_tagline',
					'settings' => 'chagoi_settings[retina_logo]',
					'active_callback' => 'chagoi_has_custom_logo_callback'
				)
			)
		);

		$wp_customize->add_setting(
			'chagoi_settings[text_color]', array(
				'default' => $defaults['text_color'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'chagoi_settings[text_color]',
				array(
					'label' => __( 'Text Color', 'chagoi' ),
					'section' => 'colors',
					'settings' => 'chagoi_settings[text_color]'
				)
			)
		);

		$wp_customize->add_setting(
			'chagoi_settings[link_color]', array(
				'default' => $defaults['link_color'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'chagoi_settings[link_color]',
				array(
					'label' => __( 'Link Color', 'chagoi' ),
					'section' => 'colors',
					'settings' => 'chagoi_settings[link_color]'
				)
			)
		);

		$wp_customize->add_setting(
			'chagoi_settings[link_color_hover]', array(
				'default' => $defaults['link_color_hover'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'chagoi_settings[link_color_hover]',
				array(
					'label' => __( 'Link Color Hover', 'chagoi' ),
					'section' => 'colors',
					'settings' => 'chagoi_settings[link_color_hover]'
				)
			)
		);

		$wp_customize->add_setting(
			'chagoi_settings[link_color_visited]', array(
				'default' => $defaults['link_color_visited'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_hex_color',
				'transport' => 'refresh',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'chagoi_settings[link_color_visited]',
				array(
					'label' => __( 'Link Color Visited', 'chagoi' ),
					'section' => 'colors',
					'settings' => 'chagoi_settings[link_color_visited]'
				)
			)
		);

		if ( ! function_exists( 'chagoi_colors_customize_register' ) && ! defined( 'CHAGOI_PREMIUM_VERSION' ) ) {
			$wp_customize->add_control(
				new Chagoi_Customize_Misc_Control(
					$wp_customize,
					'colors_get_addon_desc',
					array(
						'section' => 'colors',
						'type' => 'addon',
						'label' => __( 'More info', 'chagoi' ),
						'description' => __( 'More colors are available in Chagoi premium version. Visit wpkoi.com for more info.', 'chagoi' ),
						'url' => esc_url( CHAGOI_THEME_URL ),
						'priority' => 30,
						'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
					)
				)
			);
		}

		if ( class_exists( 'WP_Customize_Panel' ) ) {
			if ( ! $wp_customize->get_panel( 'chagoi_layout_panel' ) ) {
				$wp_customize->add_panel( 'chagoi_layout_panel', array(
					'priority' => 25,
					'title' => __( 'Layout', 'chagoi' ),
				) );
			}
		}

		// Add Layout section
		$wp_customize->add_section(
			'chagoi_layout_container',
			array(
				'title' => __( 'Container', 'chagoi' ),
				'priority' => 10,
				'panel' => 'chagoi_layout_panel'
			)
		);

		// Container width
		$wp_customize->add_setting(
			'chagoi_settings[container_width]',
			array(
				'default' => $defaults['container_width'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_integer',
				'transport' => 'postMessage'
			)
		);

		$wp_customize->add_control(
			new Chagoi_Range_Slider_Control(
				$wp_customize,
				'chagoi_settings[container_width]',
				array(
					'type' => 'chagoi-range-slider',
					'label' => __( 'Container Width', 'chagoi' ),
					'section' => 'chagoi_layout_container',
					'settings' => array(
						'desktop' => 'chagoi_settings[container_width]',
					),
					'choices' => array(
						'desktop' => array(
							'min' => 700,
							'max' => 2000,
							'step' => 5,
							'edit' => true,
							'unit' => 'px',
						),
					),
					'priority' => 0,
				)
			)
		);

		// Add Top Bar section
		$wp_customize->add_section(
			'chagoi_top_bar',
			array(
				'title' => __( 'Top Bar', 'chagoi' ),
				'priority' => 15,
				'panel' => 'chagoi_layout_panel',
			)
		);

		// Add Top Bar width
		$wp_customize->add_setting(
			'chagoi_settings[top_bar_width]',
			array(
				'default' => $defaults['top_bar_width'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Top Bar width control
		$wp_customize->add_control(
			'chagoi_settings[top_bar_width]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Width', 'chagoi' ),
				'section' => 'chagoi_top_bar',
				'choices' => array(
					'full' => __( 'Full', 'chagoi' ),
					'contained' => __( 'Contained', 'chagoi' )
				),
				'settings' => 'chagoi_settings[top_bar_width]',
				'priority' => 5,
				'active_callback' => 'chagoi_is_top_bar_active',
			)
		);

		// Add Top Bar inner width
		$wp_customize->add_setting(
			'chagoi_settings[top_bar_inner_width]',
			array(
				'default' => $defaults['top_bar_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Top Bar width control
		$wp_customize->add_control(
			'chagoi_settings[top_bar_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Inner Width', 'chagoi' ),
				'section' => 'chagoi_top_bar',
				'choices' => array(
					'full' => __( 'Full', 'chagoi' ),
					'contained' => __( 'Contained', 'chagoi' )
				),
				'settings' => 'chagoi_settings[top_bar_inner_width]',
				'priority' => 10,
				'active_callback' => 'chagoi_is_top_bar_active',
			)
		);

		// Add top bar alignment
		$wp_customize->add_setting(
			'chagoi_settings[top_bar_alignment]',
			array(
				'default' => $defaults['top_bar_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'chagoi_settings[top_bar_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Alignment', 'chagoi' ),
				'section' => 'chagoi_top_bar',
				'choices' => array(
					'left' => __( 'Left', 'chagoi' ),
					'center' => __( 'Center', 'chagoi' ),
					'right' => __( 'Right', 'chagoi' )
				),
				'settings' => 'chagoi_settings[top_bar_alignment]',
				'priority' => 15,
				'active_callback' => 'chagoi_is_top_bar_active',
			)
		);

		// Add Header section
		$wp_customize->add_section(
			'chagoi_layout_header',
			array(
				'title' => __( 'Header', 'chagoi' ),
				'priority' => 20,
				'panel' => 'chagoi_layout_panel'
			)
		);

		// Add Header Layout setting
		$wp_customize->add_setting(
			'chagoi_settings[header_layout_setting]',
			array(
				'default' => $defaults['header_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Header Layout control
		$wp_customize->add_control(
			'chagoi_settings[header_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Header Width', 'chagoi' ),
				'section' => 'chagoi_layout_header',
				'choices' => array(
					'fluid-header' => __( 'Full', 'chagoi' ),
					'contained-header' => __( 'Contained', 'chagoi' )
				),
				'settings' => 'chagoi_settings[header_layout_setting]',
				'priority' => 5
			)
		);

		// Add Inside Header Layout setting
		$wp_customize->add_setting(
			'chagoi_settings[header_inner_width]',
			array(
				'default' => $defaults['header_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Header Layout control
		$wp_customize->add_control(
			'chagoi_settings[header_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Header Width', 'chagoi' ),
				'section' => 'chagoi_layout_header',
				'choices' => array(
					'contained' => __( 'Contained', 'chagoi' ),
					'full-width' => __( 'Full', 'chagoi' )
				),
				'settings' => 'chagoi_settings[header_inner_width]',
				'priority' => 6
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'chagoi_settings[header_alignment_setting]',
			array(
				'default' => $defaults['header_alignment_setting'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'chagoi_settings[header_alignment_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Header Alignment', 'chagoi' ),
				'section' => 'chagoi_layout_header',
				'choices' => array(
					'left' => __( 'Left', 'chagoi' ),
					'center' => __( 'Center', 'chagoi' ),
					'right' => __( 'Right', 'chagoi' )
				),
				'settings' => 'chagoi_settings[header_alignment_setting]',
				'priority' => 10
			)
		);

		$wp_customize->add_section(
			'chagoi_layout_navigation',
			array(
				'title' => __( 'Primary Navigation', 'chagoi' ),
				'priority' => 30,
				'panel' => 'chagoi_layout_panel'
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'chagoi_settings[nav_layout_setting]',
			array(
				'default' => $defaults['nav_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'chagoi_settings[nav_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Width', 'chagoi' ),
				'section' => 'chagoi_layout_navigation',
				'choices' => array(
					'fluid-nav' => __( 'Full', 'chagoi' ),
					'contained-nav' => __( 'Contained', 'chagoi' )
				),
				'settings' => 'chagoi_settings[nav_layout_setting]',
				'priority' => 15
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'chagoi_settings[nav_inner_width]',
			array(
				'default' => $defaults['nav_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'chagoi_settings[nav_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Navigation Width', 'chagoi' ),
				'section' => 'chagoi_layout_navigation',
				'choices' => array(
					'contained' => __( 'Contained', 'chagoi' ),
					'full-width' => __( 'Full', 'chagoi' )
				),
				'settings' => 'chagoi_settings[nav_inner_width]',
				'priority' => 16
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'chagoi_settings[nav_alignment_setting]',
			array(
				'default' => $defaults['nav_alignment_setting'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'chagoi_settings[nav_alignment_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Alignment', 'chagoi' ),
				'section' => 'chagoi_layout_navigation',
				'choices' => array(
					'left' => __( 'Left', 'chagoi' ),
					'center' => __( 'Center', 'chagoi' ),
					'right' => __( 'Right', 'chagoi' )
				),
				'settings' => 'chagoi_settings[nav_alignment_setting]',
				'priority' => 20
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'chagoi_settings[nav_position_setting]',
			array(
				'default' => $defaults['nav_position_setting'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => ( '' !== chagoi_get_setting( 'nav_position_setting' ) ) ? 'postMessage' : 'refresh'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'chagoi_settings[nav_position_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Location', 'chagoi' ),
				'section' => 'chagoi_layout_navigation',
				'choices' => array(
					'nav-below-header' => __( 'Below Header', 'chagoi' ),
					'nav-above-header' => __( 'Above Header', 'chagoi' ),
					'nav-float-right' => __( 'Float Right', 'chagoi' ),
					'nav-float-left' => __( 'Float Left', 'chagoi' ),
					'nav-left-sidebar' => __( 'Left Sidebar', 'chagoi' ),
					'nav-right-sidebar' => __( 'Right Sidebar', 'chagoi' ),
					'' => __( 'No Navigation', 'chagoi' )
				),
				'settings' => 'chagoi_settings[nav_position_setting]',
				'priority' => 22
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'chagoi_settings[nav_dropdown_type]',
			array(
				'default' => $defaults['nav_dropdown_type'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'chagoi_settings[nav_dropdown_type]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Dropdown', 'chagoi' ),
				'section' => 'chagoi_layout_navigation',
				'choices' => array(
					'hover' => __( 'Hover', 'chagoi' ),
					'click' => __( 'Click - Menu Item', 'chagoi' ),
					'click-arrow' => __( 'Click - Arrow', 'chagoi' )
				),
				'settings' => 'chagoi_settings[nav_dropdown_type]',
				'priority' => 22
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'chagoi_settings[nav_search]',
			array(
				'default' => $defaults['nav_search'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'chagoi_settings[nav_search]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Search', 'chagoi' ),
				'section' => 'chagoi_layout_navigation',
				'choices' => array(
					'enable' => __( 'Enable', 'chagoi' ),
					'disable' => __( 'Disable', 'chagoi' )
				),
				'settings' => 'chagoi_settings[nav_search]',
				'priority' => 23
			)
		);

		// Add content setting
		$wp_customize->add_setting(
			'chagoi_settings[content_layout_setting]',
			array(
				'default' => $defaults['content_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'chagoi_settings[content_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Content Layout', 'chagoi' ),
				'section' => 'chagoi_layout_container',
				'choices' => array(
					'separate-containers' => __( 'Separate Containers', 'chagoi' ),
					'one-container' => __( 'One Container', 'chagoi' )
				),
				'settings' => 'chagoi_settings[content_layout_setting]',
				'priority' => 25
			)
		);

		$wp_customize->add_section(
			'chagoi_layout_sidebars',
			array(
				'title' => __( 'Sidebars', 'chagoi' ),
				'priority' => 40,
				'panel' => 'chagoi_layout_panel'
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'chagoi_settings[layout_setting]',
			array(
				'default' => $defaults['layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'chagoi_settings[layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Sidebar Layout', 'chagoi' ),
				'section' => 'chagoi_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'chagoi' ),
					'right-sidebar' => __( 'Content / Sidebar', 'chagoi' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'chagoi' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'chagoi' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'chagoi' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'chagoi' )
				),
				'settings' => 'chagoi_settings[layout_setting]',
				'priority' => 30
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'chagoi_settings[blog_layout_setting]',
			array(
				'default' => $defaults['blog_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'chagoi_settings[blog_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Blog Sidebar Layout', 'chagoi' ),
				'section' => 'chagoi_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'chagoi' ),
					'right-sidebar' => __( 'Content / Sidebar', 'chagoi' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'chagoi' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'chagoi' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'chagoi' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'chagoi' )
				),
				'settings' => 'chagoi_settings[blog_layout_setting]',
				'priority' => 35
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'chagoi_settings[single_layout_setting]',
			array(
				'default' => $defaults['single_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'chagoi_settings[single_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Single Post Sidebar Layout', 'chagoi' ),
				'section' => 'chagoi_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'chagoi' ),
					'right-sidebar' => __( 'Content / Sidebar', 'chagoi' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'chagoi' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'chagoi' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'chagoi' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'chagoi' )
				),
				'settings' => 'chagoi_settings[single_layout_setting]',
				'priority' => 36
			)
		);

		$wp_customize->add_section(
			'chagoi_layout_footer',
			array(
				'title' => __( 'Footer', 'chagoi' ),
				'priority' => 50,
				'panel' => 'chagoi_layout_panel'
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'chagoi_settings[footer_layout_setting]',
			array(
				'default' => $defaults['footer_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'chagoi_settings[footer_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Width', 'chagoi' ),
				'section' => 'chagoi_layout_footer',
				'choices' => array(
					'fluid-footer' => __( 'Full', 'chagoi' ),
					'contained-footer' => __( 'Contained', 'chagoi' )
				),
				'settings' => 'chagoi_settings[footer_layout_setting]',
				'priority' => 40
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'chagoi_settings[footer_inner_width]',
			array(
				'default' => $defaults['footer_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'chagoi_settings[footer_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Footer Width', 'chagoi' ),
				'section' => 'chagoi_layout_footer',
				'choices' => array(
					'contained' => __( 'Contained', 'chagoi' ),
					'full-width' => __( 'Full', 'chagoi' )
				),
				'settings' => 'chagoi_settings[footer_inner_width]',
				'priority' => 41
			)
		);

		// Add footer widget setting
		$wp_customize->add_setting(
			'chagoi_settings[footer_widget_setting]',
			array(
				'default' => $defaults['footer_widget_setting'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add footer widget control
		$wp_customize->add_control(
			'chagoi_settings[footer_widget_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Widgets', 'chagoi' ),
				'section' => 'chagoi_layout_footer',
				'choices' => array(
					'0' => '0',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5'
				),
				'settings' => 'chagoi_settings[footer_widget_setting]',
				'priority' => 45
			)
		);

		// Copyright
		$wp_customize->add_setting(
			'chagoi_settings[footer_copyright]',
			array(
				'default' => $defaults['footer_copyright'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'chagoi_settings[footer_copyright]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Copyright', 'chagoi' ),
				'section'    => 'chagoi_layout_footer',
				'settings'   => 'chagoi_settings[footer_copyright]',
				'priority' => 50,
			)
		);

		// Add footer widget setting
		$wp_customize->add_setting(
			'chagoi_settings[footer_bar_alignment]',
			array(
				'default' => $defaults['footer_bar_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add footer widget control
		$wp_customize->add_control(
			'chagoi_settings[footer_bar_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Bar Alignment', 'chagoi' ),
				'section' => 'chagoi_layout_footer',
				'choices' => array(
					'left' => __( 'Left','chagoi' ),
					'center' => __( 'Center','chagoi' ),
					'right' => __( 'Right','chagoi' )
				),
				'settings' => 'chagoi_settings[footer_bar_alignment]',
				'priority' => 47,
				'active_callback' => 'chagoi_is_footer_bar_active'
			)
		);

		// Add back to top setting
		$wp_customize->add_setting(
			'chagoi_settings[back_to_top]',
			array(
				'default' => $defaults['back_to_top'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_choices'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'chagoi_settings[back_to_top]',
			array(
				'type' => 'select',
				'label' => __( 'Back to Top Button', 'chagoi' ),
				'section' => 'chagoi_layout_footer',
				'choices' => array(
					'enable' => __( 'Enable', 'chagoi' ),
					'' => __( 'Disable', 'chagoi' )
				),
				'settings' => 'chagoi_settings[back_to_top]',
				'priority' => 50
			)
		);

		// Add Layout section
		$wp_customize->add_section(
			'chagoi_blog_section',
			array(
				'title' => __( 'Blog', 'chagoi' ),
				'priority' => 55,
				'panel' => 'chagoi_layout_panel'
			)
		);

		$wp_customize->add_setting(
			'chagoi_settings[blog_header_image]',
			array(
				'default' => $defaults['blog_header_image'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'chagoi_settings[blog_header_image]',
				array(
					'label' => __( 'Blog Header image', 'chagoi' ),
					'section' => 'chagoi_blog_section',
					'settings' => 'chagoi_settings[blog_header_image]',
				)
			)
		);

		// Blog header texts
		$wp_customize->add_setting(
			'chagoi_settings[blog_header_title]',
			array(
				'default' => $defaults['blog_header_title'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'chagoi_settings[blog_header_title]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Blog Header title', 'chagoi' ),
				'section'    => 'chagoi_blog_section',
				'settings'   => 'chagoi_settings[blog_header_title]',
				'description' => __( 'Use &lt;span&gt;content&lt;/span&gt; HTML for white text.', 'chagoi' ),
			)
		);
		
		$wp_customize->add_setting(
			'chagoi_settings[blog_header_text]',
			array(
				'default' => $defaults['blog_header_text'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'chagoi_settings[blog_header_text]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Blog Header text', 'chagoi' ),
				'section'    => 'chagoi_blog_section',
				'settings'   => 'chagoi_settings[blog_header_text]',
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'chagoi_settings[post_content]',
			array(
				'default' => $defaults['post_content'],
				'type' => 'option',
				'sanitize_callback' => 'chagoi_sanitize_blog_excerpt'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'blog_content_control',
			array(
				'type' => 'select',
				'label' => __( 'Content Type', 'chagoi' ),
				'section' => 'chagoi_blog_section',
				'choices' => array(
					'full' => __( 'Full', 'chagoi' ),
					'excerpt' => __( 'Excerpt', 'chagoi' )
				),
				'settings' => 'chagoi_settings[post_content]',
				'priority' => 10
			)
		);

		if ( ! function_exists( 'chagoi_blog_customize_register' ) && ! defined( 'CHAGOI_PREMIUM_VERSION' ) ) {
			$wp_customize->add_control(
				new Chagoi_Customize_Misc_Control(
					$wp_customize,
					'blog_get_addon_desc',
					array(
						'section' => 'chagoi_blog_section',
						'type' => 'addon',
						'label' => __( 'Learn more', 'chagoi' ),
						'description' => __( 'More options are available for this section in our premium version.', 'chagoi' ),
						'url' => esc_url( CHAGOI_THEME_URL ),
						'priority' => 30,
						'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
					)
				)
			);
		}

		// Add Performance section
		$wp_customize->add_section(
			'chagoi_general_section',
			array(
				'title' => __( 'General', 'chagoi' ),
				'priority' => 99
			)
		);

		if ( ! apply_filters( 'chagoi_fontawesome_essentials', false ) ) {
			$wp_customize->add_setting(
				'chagoi_settings[font_awesome_essentials]',
				array(
					'default' => $defaults['font_awesome_essentials'],
					'type' => 'option',
					'sanitize_callback' => 'chagoi_sanitize_checkbox'
				)
			);

			$wp_customize->add_control(
				'chagoi_settings[font_awesome_essentials]',
				array(
					'type' => 'checkbox',
					'label' => __( 'Load essential icons only', 'chagoi' ),
					'description' => __( 'Load essential Font Awesome icons instead of the full library.', 'chagoi' ),
					'section' => 'chagoi_general_section',
					'settings' => 'chagoi_settings[font_awesome_essentials]',
				)
			);
		}

		// Add Chagoi Premium section
		if ( ! defined( 'CHAGOI_PREMIUM_VERSION' ) ) {
			$wp_customize->add_section(
				new Chagoi_Upsell_Section( $wp_customize, 'chagoi_upsell_section',
					array(
						'pro_text' => __( 'Get Premium for more!', 'chagoi' ),
						'pro_url' => esc_url( CHAGOI_THEME_URL ),
						'capability' => 'edit_theme_options',
						'priority' => 555,
						'type' => 'chagoi-upsell-section',
					)
				)
			);
		}
	}
}

if ( ! function_exists( 'chagoi_customizer_live_preview' ) ) {
	add_action( 'customize_preview_init', 'chagoi_customizer_live_preview', 100 );
	/**
	 * Add our live preview scripts
	 *
	 */
	function chagoi_customizer_live_preview() {
		wp_enqueue_script( 'chagoi-themecustomizer', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/controls/js/customizer-live-preview.js', array( 'customize-preview' ), CHAGOI_VERSION, true );
	}
}
