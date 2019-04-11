<?php
/**
 * Sets all of our theme defaults.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'chagoi_get_defaults' ) ) {
	/**
	 * Set default options
	 *
	 */
	function chagoi_get_defaults() {
		$chagoi_defaults = array(
			'hide_title' => '',
			'hide_tagline' => true,
			'top_bar_width' => 'full',
			'top_bar_inner_width' => 'contained',
			'top_bar_alignment' => 'left',
			'container_width' => '1170',
			'header_layout_setting' => 'fluid-header',
			'header_inner_width' => 'contained',
			'nav_alignment_setting' => 'right',
			'header_alignment_setting' => 'left',
			'nav_layout_setting' => 'fluid-nav',
			'nav_inner_width' => 'contained',
			'nav_position_setting' => 'nav-float-right',
			'nav_dropdown_type' => 'hover',
			'nav_search' => 'enable',
			'content_layout_setting' => 'separate-containers',
			'layout_setting' => 'no-sidebar',
			'blog_layout_setting' => 'right-sidebar',
			'single_layout_setting' => 'right-sidebar',
			'blog_header_image' => '',
			'blog_header_title' => '',
			'blog_header_text' => '',
			'post_content' => 'excerpt',
			'footer_layout_setting' => 'fluid-footer',
			'footer_inner_width' => 'contained',
			'footer_widget_setting' => '3',
			'footer_copyright' => __( '&copy; 2018 All rights reserved.', 'chagoi' ),
			'footer_bar_alignment' => 'right',
			'back_to_top' => 'enable',
			'text_color' => '#222222',
			'link_color' => '#1e1e5b',
			'link_color_hover' => '#73abce',
			'link_color_visited' => '',
			'font_awesome_essentials' => true,
		);

		return apply_filters( 'chagoi_option_defaults', $chagoi_defaults );
	}
}

if ( ! function_exists( 'chagoi_get_color_defaults' ) ) {
	/**
	 * Set default options
	 */
	function chagoi_get_color_defaults() {
		$chagoi_color_defaults = array(
			'top_bar_background_color' => '#73abce',
			'top_bar_text_color' => '#ffffff',
			'top_bar_link_color' => '#ffffff',
			'top_bar_link_color_hover' => '#dddddd',
			'header_background_color' => '#ffffff',
			'header_text_color' => '#222222',
			'header_link_color' => '#1e1e5b',
			'header_link_hover_color' => '#73abce',
			'site_title_color' => '#222222',
			'site_tagline_color' => '#555555',
			'navigation_background_color' => '#ffffff',
			'navigation_text_color' => '#1e1e5b',
			'navigation_background_hover_color' => '',
			'navigation_text_hover_color' => '#73abce',
			'navigation_background_current_color' => '',
			'navigation_text_current_color' => '#73abce',
			'subnavigation_background_color' => '#222222',
			'subnavigation_text_color' => '#ffffff',
			'subnavigation_background_hover_color' => '#333333',
			'subnavigation_text_hover_color' => '#ffffff',
			'subnavigation_background_current_color' => '',
			'subnavigation_text_current_color' => '#ffffff',
			'content_background_color' => '',
			'content_text_color' => '',
			'content_link_color' => '',
			'content_link_hover_color' => '',
			'content_title_color' => '',
			'blog_post_title_color' => '',
			'blog_post_title_hover_color' => '',
			'entry_meta_text_color' => '',
			'entry_meta_link_color' => '',
			'entry_meta_link_color_hover' => '',
			'h1_color' => '',
			'h2_color' => '',
			'h3_color' => '',
			'h4_color' => '',
			'h5_color' => '',
			'h6_color' => '',
			'sidebar_widget_background_color' => '#ffffff',
			'sidebar_widget_text_color' => '',
			'sidebar_widget_link_color' => '',
			'sidebar_widget_link_hover_color' => '',
			'sidebar_widget_title_color' => '#1e1e5b',
			'footer_widget_background_color' => '#edc39b',
			'footer_widget_text_color' => '#222222',
			'footer_widget_link_color' => '#333333',
			'footer_widget_link_hover_color' => '#222222',
			'footer_widget_title_color' => '#1e1e5b',
			'footer_background_color' => '#1e1e5b',
			'footer_text_color' => '#ffffff',
			'footer_link_color' => '#ffffff',
			'footer_link_hover_color' => '#73abce',
			'form_background_color' => '#fafafa',
			'form_text_color' => '#555555',
			'form_background_color_focus' => '#ffffff',
			'form_text_color_focus' => '#555555',
			'form_border_color' => '#cccccc',
			'form_border_color_focus' => '#bfbfbf',
			'form_button_background_color' => '#1e1e5b',
			'form_button_background_color_hover' => '#73abce',
			'form_button_text_color' => '#ffffff',
			'form_button_text_color_hover' => '#ffffff',
			'back_to_top_background_color' => 'rgba(30,30,91,0.7)',
			'back_to_top_background_color_hover' => '#1e1e5b',
			'back_to_top_text_color' => '#ffffff',
			'back_to_top_text_color_hover' => '#ffffff',
		);

		return apply_filters( 'chagoi_color_option_defaults', $chagoi_color_defaults );
	}
}

if ( ! function_exists( 'chagoi_get_default_fonts' ) ) {
	/**
	 * Set default options.
	 *
	 *
	 * @param bool $filter Whether to return the filtered values or original values.
	 * @return array Option defaults.
	 */
	function chagoi_get_default_fonts( $filter = true ) {
		$chagoi_font_defaults = array(
			'font_body' => 'Open Sans Condensed',
			'font_body_category' => 'serif',
			'font_body_variants' => '300,300italic,700',
			'body_font_weight' => '700',
			'body_font_transform' => 'none',
			'body_font_size' => '18',
			'body_line_height' => '1.5', // no unit
			'paragraph_margin' => '1.5', // em
			'font_top_bar' => 'Dosis',
			'font_top_bar_category' => 'serif',
			'font_top_bar_variants' => '200,300,regular,500,600,700,800',
			'top_bar_font_weight' => 'normal',
			'top_bar_font_transform' => 'none',
			'top_bar_font_size' => '14',
			'font_site_title' => 'Dosis',
			'font_site_title_category' => 'serif',
			'font_site_title_variants' => '200,300,regular,500,600,700,800',
			'site_title_font_weight' => '700',
			'site_title_font_transform' => 'uppercase',
			'site_title_font_size' => '33',
			'mobile_site_title_font_size' => '25',
			'font_site_tagline' => 'inherit',
			'font_site_tagline_category' => '',
			'font_site_tagline_variants' => '',
			'site_tagline_font_weight' => 'normal',
			'site_tagline_font_transform' => 'none',
			'site_tagline_font_size' => '15',
			'font_navigation' => 'Dosis',
			'font_navigation_category' => 'serif',
			'font_navigation_variants' => '200,300,regular,500,600,700,800',
			'navigation_font_weight' => '500',
			'navigation_font_transform' => 'uppercase',
			'navigation_font_size' => '18',
			'font_widget_title' => 'Abril Fatface',
			'font_widget_title_category' => 'serif',
			'font_widget_title_variants' => 'regular',
			'widget_title_font_weight' => 'bold',
			'widget_title_font_transform' => 'none',
			'widget_title_font_size' => '20',
			'widget_title_separator' => '18',
			'widget_content_font_size' => '18',
			'font_buttons' => 'Dosis',
			'font_buttons_category' => 'serif',
			'font_buttons_variants' => '200,300,regular,500,600,700,800',
			'buttons_font_weight' => '700',
			'buttons_font_transform' => 'uppercase',
			'buttons_font_size' => '16',
			'font_heading_1' => 'Abril Fatface',
			'font_heading_1_category' => 'serif',
			'font_heading_1_variants' => 'regular',
			'heading_1_weight' => 'normal',
			'heading_1_transform' => 'none',
			'heading_1_font_size' => '80',
			'heading_1_line_height' => '1.2', // em
			'mobile_heading_1_font_size' => '30',
			'font_heading_2' => 'Abril Fatface',
			'font_heading_2_category' => 'serif',
			'font_heading_2_variants' => 'regular',
			'heading_2_weight' => 'normal',
			'heading_2_transform' => 'none',
			'heading_2_font_size' => '42',
			'heading_2_line_height' => '1.2', // em
			'mobile_heading_2_font_size' => '25',
			'font_heading_3' => 'Abril Fatface',
			'font_heading_3_category' => 'serif',
			'font_heading_3_variants' => 'regular',
			'heading_3_weight' => 'normal',
			'heading_3_transform' => 'none',
			'heading_3_font_size' => '30',
			'heading_3_line_height' => '1.2', // em
			'font_heading_4' => 'inherit',
			'font_heading_4_category' => '',
			'font_heading_4_variants' => '',
			'heading_4_weight' => 'normal',
			'heading_4_transform' => 'none',
			'heading_4_font_size' => '',
			'heading_4_line_height' => '', // em
			'font_heading_5' => 'inherit',
			'font_heading_5_category' => '',
			'font_heading_5_variants' => '',
			'heading_5_weight' => 'normal',
			'heading_5_transform' => 'none',
			'heading_5_font_size' => '',
			'heading_5_line_height' => '', // em
			'font_heading_6' => 'inherit',
			'font_heading_6_category' => '',
			'font_heading_6_variants' => '',
			'heading_6_weight' => 'normal',
			'heading_6_transform' => 'none',
			'heading_6_font_size' => '',
			'heading_6_line_height' => '', // em
			'font_footer' => 'Dosis',
			'font_footer_category' => 'serif',
			'font_footer_variants' => '200,300,regular,500,600,700,800',
			'footer_weight' => 'normal',
			'footer_transform' => 'none',
			'footer_font_size' => '14',
		);

		if ( $filter ) {
			return apply_filters( 'chagoi_font_option_defaults', $chagoi_font_defaults );
		}

		return $chagoi_font_defaults;
	}
}

if ( ! function_exists( 'chagoi_spacing_get_defaults' ) ) {
	/**
	 * Set the default options.
	 *
	 *
	 * @param bool $filter Whether to return the filtered values or original values.
	 * @return array Option defaults.
	 */
	function chagoi_spacing_get_defaults( $filter = true ) {
		$chagoi_spacing_defaults = array(
			'top_bar_top' => '5',
			'top_bar_right' => '10',
			'top_bar_bottom' => '5',
			'top_bar_left' => '10',
			'header_top' => '20',
			'header_right' => '0',
			'header_bottom' => '20',
			'header_left' => '0',
			'menu_item' => '8',
			'menu_item_height' => '45',
			'sub_menu_item_height' => '10',
			'content_top' => '15',
			'content_right' => '15',
			'content_bottom' => '15',
			'content_left' => '15',
			'mobile_content_top' => '15',
			'mobile_content_right' => '15',
			'mobile_content_bottom' => '15',
			'mobile_content_left' => '15',
			'separator' => '15',
			'left_sidebar_width' => '25',
			'right_sidebar_width' => '25',
			'widget_top' => '30',
			'widget_right' => '10',
			'widget_bottom' => '10',
			'widget_left' => '10',
			'footer_widget_container_top' => '80',
			'footer_widget_container_right' => '15',
			'footer_widget_container_bottom' => '50',
			'footer_widget_container_left' => '15',
			'footer_widget_separator' => '30',
			'footer_top' => '20',
			'footer_right' => '20',
			'footer_bottom' => '20',
			'footer_left' => '20',
		);

		if ( $filter ) {
			return apply_filters( 'chagoi_spacing_option_defaults', $chagoi_spacing_defaults );
		}

		return $chagoi_spacing_defaults;
	}
}

if ( ! function_exists( 'chagoi_typography_default_fonts' ) ) {
	/**
	 * Set the default system fonts.
	 *
	 */
	function chagoi_typography_default_fonts() {
		$fonts = array(
			'inherit',
			'System Stack',
			'Arial, Helvetica, sans-serif',
			'Courier New',
			'Georgia, Times New Roman, Times, serif',
			'Trebuchet MS, Helvetica, sans-serif',
			'Verdana, Geneva, sans-serif',
			'Dosis',
			'Abril Fatface',
			'Open Sans Condensed'
		);

		return apply_filters( 'chagoi_typography_default_fonts', $fonts );
	}
}
