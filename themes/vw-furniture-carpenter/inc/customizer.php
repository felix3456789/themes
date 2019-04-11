<?php
/**
 * VW Furniture Carpenter Theme Customizer
 *
 * @package VW Furniture Carpenter
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_furniture_carpenter_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'inc/customize-homepage/class-customize-homepage.php' );

	//add home page setting pannel
	$wp_customize->add_panel( 'vw_furniture_carpenter_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'VW Settings', 'vw-furniture-carpenter' ),
	) );

	// Layout
	$wp_customize->add_section( 'vw_furniture_carpenter_left_right', array(
    	'title'      => __( 'General Settings', 'vw-furniture-carpenter' ),
		'panel' => 'vw_furniture_carpenter_panel_id'
	) );

	$wp_customize->add_setting('vw_furniture_carpenter_theme_options',array(
        'default' => __('Right Sidebar','vw-furniture-carpenter'),
        'sanitize_callback' => 'vw_furniture_carpenter_sanitize_choices'
	));
	$wp_customize->add_control('vw_furniture_carpenter_theme_options',array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-furniture-carpenter'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-furniture-carpenter'),
        'section' => 'vw_furniture_carpenter_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-furniture-carpenter'),
            'Right Sidebar' => __('Right Sidebar','vw-furniture-carpenter'),
            'One Column' => __('One Column','vw-furniture-carpenter'),
            'Three Columns' => __('Three Columns','vw-furniture-carpenter'),
            'Four Columns' => __('Four Columns','vw-furniture-carpenter'),
            'Grid Layout' => __('Grid Layout','vw-furniture-carpenter')
        ),
	) );

	$wp_customize->add_setting('vw_furniture_carpenter_page_layout',array(
        'default' => __('One Column','vw-furniture-carpenter'),
        'sanitize_callback' => 'vw_furniture_carpenter_sanitize_choices'
	));
	$wp_customize->add_control('vw_furniture_carpenter_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-furniture-carpenter'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-furniture-carpenter'),
        'section' => 'vw_furniture_carpenter_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-furniture-carpenter'),
            'Right Sidebar' => __('Right Sidebar','vw-furniture-carpenter'),
            'One Column' => __('One Column','vw-furniture-carpenter')
        ),
	) );
    
	//Slider
	$wp_customize->add_section( 'vw_furniture_carpenter_slidersettings' , array(
    	'title'      => __( 'Slider Section', 'vw-furniture-carpenter' ),
		'panel' => 'vw_furniture_carpenter_panel_id'
	) );

	$wp_customize->add_setting('vw_furniture_carpenter_slider_arrows',array(
       'default' => 'false',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_furniture_carpenter_slider_arrows',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide slider','vw-furniture-carpenter'),
       'section' => 'vw_furniture_carpenter_slidersettings',
    ));

	for ( $count = 1; $count <= 4; $count++ ) {

		$wp_customize->add_setting( 'vw_furniture_carpenter_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_furniture_carpenter_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_furniture_carpenter_slider_page' . $count, array(
			'label'    => __( 'Select Slider Page', 'vw-furniture-carpenter' ),
			'description' => __('Slider image size (1500 x 720)','vw-furniture-carpenter'),
			'section'  => 'vw_furniture_carpenter_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//Contact Section
	$wp_customize->add_section( 'vw_furniture_carpenter_topbar', array(
    	'title'      => __( 'Contact Section', 'vw-furniture-carpenter' ),
		'panel' => 'vw_furniture_carpenter_panel_id'
	) );

	$wp_customize->add_setting('vw_furniture_carpenter_phone_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_furniture_carpenter_phone_text',array(
		'label'	=> __('Add Phone Text','vw-furniture-carpenter'),
		'input_attrs' => array(
            'placeholder' => __( 'PHONE', 'vw-furniture-carpenter' ),
        ),
		'section'=> 'vw_furniture_carpenter_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_furniture_carpenter_phone_number',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_furniture_carpenter_phone_number',array(
		'label'	=> __('Add Phone Number','vw-furniture-carpenter'),
		'input_attrs' => array(
            'placeholder' => __( '+00 987 654 1230', 'vw-furniture-carpenter' ),
        ),
		'section'=> 'vw_furniture_carpenter_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_furniture_carpenter_email_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_furniture_carpenter_email_text',array(
		'label'	=> __('Add Email Text','vw-furniture-carpenter'),
		'input_attrs' => array(
            'placeholder' => __( 'EMAIL', 'vw-furniture-carpenter' ),
        ),
		'section'=> 'vw_furniture_carpenter_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_furniture_carpenter_email_address',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_furniture_carpenter_email_address',array(
		'label'	=> __('Add Email Address','vw-furniture-carpenter'),
		'input_attrs' => array(
            'placeholder' => __( 'example@gmail.com', 'vw-furniture-carpenter' ),
        ),
		'section'=> 'vw_furniture_carpenter_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_furniture_carpenter_contact_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_furniture_carpenter_contact_button_text',array(
		'label'	=> __('Add Button Text','vw-furniture-carpenter'),
		'input_attrs' => array(
            'placeholder' => __( 'GET A QUOTE', 'vw-furniture-carpenter' ),
        ),
		'section'=> 'vw_furniture_carpenter_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_furniture_carpenter_contact_button_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('vw_furniture_carpenter_contact_button_url',array(
		'label'	=> __('Add Button URL','vw-furniture-carpenter'),
		'input_attrs' => array(
            'placeholder' => __( 'www.example.com', 'vw-furniture-carpenter' ),
        ),
		'section'=> 'vw_furniture_carpenter_topbar',
		'type'=> 'url'
	));

	$wp_customize->add_setting('vw_furniture_carpenter_header_search',array(
       'default' => 'false',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_furniture_carpenter_header_search',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Search','vw-furniture-carpenter'),
       'section' => 'vw_furniture_carpenter_topbar',
    ));
    
	//What We Do section
	$wp_customize->add_section( 'vw_furniture_carpenter_services_section' , array(
    	'title'      => __( 'What We Do Section', 'vw-furniture-carpenter' ),
		'priority'   => null,
		'panel' => 'vw_furniture_carpenter_panel_id'
	) );

	$wp_customize->add_setting('vw_furniture_carpenter_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_furniture_carpenter_section_title',array(
		'label'	=> __('Add Section Title','vw-furniture-carpenter'),
		'input_attrs' => array(
            'placeholder' => __( 'WHAT WE DO', 'vw-furniture-carpenter' ),
        ),
		'section'=> 'vw_furniture_carpenter_services_section',
		'type'=> 'text'
	));

	$categories = get_categories();
	$cat_post = array();
	$cat_post[]= 'select';
	$i = 0;	
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_furniture_carpenter_services',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_furniture_carpenter_sanitize_choices',
	));
	$wp_customize->add_control('vw_furniture_carpenter_services',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display post','vw-furniture-carpenter'),
		'description' => __('Image Size (120 x 120)','vw-furniture-carpenter'),
		'section' => 'vw_furniture_carpenter_services_section',
	));

	//Content Craetion
	$wp_customize->add_section( 'vw_furniture_carpenter_content_section' , array(
    	'title' => __( 'Customize Home Page', 'vw-furniture-carpenter' ),
		'priority' => null,
		'panel' => 'vw_furniture_carpenter_panel_id'
	) );

	$wp_customize->add_setting('vw_furniture_carpenter_content_creation_main_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$homepage= get_option( 'page_on_front' );

	$wp_customize->add_control(	new vw_furniture_carpenter_Content_Creation( $wp_customize, 'vw_furniture_carpenter_content_creation_main_control', array(
		'options' => array(
			esc_html__( 'First select static page in homepage setting for front page.Below given edit button is to customize Home Page. Just click on the edit option, add whatever elements you want to include in the homepage, save the changes and you are good to go.','vw-furniture-carpenter' ),
		),
		'section' => 'vw_furniture_carpenter_content_section',
		'button_url'  => admin_url( 'post.php?post='.$homepage.'&action=edit'),
		'button_text' => esc_html__( 'Edit', 'vw-furniture-carpenter' ),
	) ) );

	//Footer Text
	$wp_customize->add_section('vw_furniture_carpenter_footer',array(
		'title'	=> __('Footer','vw-furniture-carpenter'),
		'panel' => 'vw_furniture_carpenter_panel_id',
	));	
	
	$wp_customize->add_setting('vw_furniture_carpenter_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_furniture_carpenter_footer_text',array(
		'label'	=> __('Copyright Text','vw-furniture-carpenter'),
		'input_attrs' => array(
            'placeholder' => __( 'Copyright 2019, .....', 'vw-furniture-carpenter' ),
        ),
		'section'=> 'vw_furniture_carpenter_footer',
		'type'=> 'text'
	));	
}

add_action( 'customize_register', 'vw_furniture_carpenter_customize_register' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Furniture_Carpenter_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Furniture_Carpenter_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new VW_Furniture_Carpenter_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'VW CARPENTER PRO', 'vw-furniture-carpenter' ),
					'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-furniture-carpenter' ),
					'pro_url'  => esc_url('https://www.vwthemes.com/themes/carpenter-wordpress-theme/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-furniture-carpenter-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-furniture-carpenter-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Furniture_Carpenter_Customize::get_instance();