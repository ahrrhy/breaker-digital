<?php
/**
 * control Theme Customizer
 *
 * @package control
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function control_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'control_customize_register' );


function control_custom_header_settings ($wp_customize){
    /**
     * Adding custom Logo
     */
    $wp_customize->add_section('control_custom_header_settings_section', array(
        'title' => 'Header Settings'
    ));
    $wp_customize->add_setting('control-logo');

    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'control-logo-control', array(
        'label' => 'Logo',
        'section' => 'control_custom_header_settings_section',
        'settings' => 'control-logo',
        'width' => 75,
        'height' => 50
    )));
    $wp_customize->add_setting('control-header-background');

    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'control-header-background-control', array(
        'label' => 'Background',
        'section' => 'control_custom_header_settings_section',
        'settings' => 'control-header-background',
        'width' => 1500,
        'height' => 856
    )));

    //link color
    $wp_customize->add_setting('control_link_color', array(
        'default' => '#ffffff',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'control_link_color_control', array(
        'label' => __('Link Color', 'Control'),
        'section' => 'control_custom_header_settings_section',
        'settings' => 'control_link_color',
    ) ) );

    //border color
    $wp_customize->add_setting('control_border_color', array(
        'default' => '#d90c00',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'control_border_color_control', array(
        'label' => __('Border and Hover Color', 'Control'),
        'section' => 'control_custom_header_settings_section',
        'settings' => 'control_border_color',
    ) ) );
}
add_action( 'customize_register', 'control_custom_header_settings' );


/**
 * Control Main Content
 */
function control_custom_main_settings ($wp_customize){

    $wp_customize->add_section('control_custom_main_settings_section', array(
        'title' => 'Main Content Settings'
    ));

    //text color
    $wp_customize->add_setting('control_main_text_color', array(
        'default' => '#b5cbd1',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'control_main_text_color', array(
        'label' => __('Main Text Color', 'Control'),
        'section' => 'control_custom_main_settings_section',
        'settings' => 'control_main_text_color',
    ) ) );

    //gallery background
    $wp_customize->add_setting('control_gallery_background_color', array(
        'default' => '#000000',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'control_gallery_background_color', array(
        'label' => __('Gallery Background Color', 'Control'),
        'section' => 'control_custom_main_settings_section',
        'settings' => 'control_gallery_background_color',
    ) ) );
}
add_action( 'customize_register', 'control_custom_main_settings' );


/**
 * Adding customizer for contacts
 */

function contact_customizer_sections( $wp_customize ){

    // section
    $wp_customize->add_section('contacts_location_info', array(
        'title' => __('Contacts Info'),
        'description' => __('Add the contact info'),
    ));
    // setting
    $wp_customize->add_setting( 'street', array(
            'default' => 'Example street'));
    // control
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'street', array(
        'label'    => 'Street',
        'section'  => 'contacts_location_info',
        'settings' => 'street',
        'type' => 'text'
    )));
    // setting
    $wp_customize->add_setting( 'street', array(
        'default' => 'Example Street'));
    // control
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'street', array(
        'label'    => 'Street',
        'section'  => 'contacts_location_info',
        'settings' => 'street',
        'type' => 'text'
    )));
    // setting
    $wp_customize->add_setting( 'city', array(
        'default' => 'Example City'));
    // control
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'city', array(
        'label'    => 'City',
        'section'  => 'contacts_location_info',
        'settings' => 'city',
        'type' => 'text'
    )));
    // setting
    $wp_customize->add_setting( 'phone_number', array(
        'default' => 'Example Phone'));
    // control
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'phone_number', array(
        'label'    => 'Phone',
        'section'  => 'contacts_location_info',
        'settings' => 'phone_number',
        'type' => 'text'
    )));
    // setting
    $wp_customize->add_setting( 'fax', array(
        'default' => 'Example Fax'));
    // control
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'fax', array(
        'label'    => 'Fax',
        'section'  => 'contacts_location_info',
        'settings' => 'fax',
        'type' => 'text'
    )));
    // setting
    $wp_customize->add_setting( 'email', array(
        'default' => 'Example Email'));
    // control
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'email', array(
        'label'    => 'Email',
        'section'  => 'contacts_location_info',
        'settings' => 'email',
        'type' => 'text'
    )));

}
add_action( 'customize_register', 'contact_customizer_sections' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function control_customize_preview_js() {
	wp_enqueue_script( 'control_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'control_customize_preview_js' );

function control_customize_css() { ?>

    <style type="text/css">
        .site-header{
            background: url("<?php echo wp_get_attachment_url(get_theme_mod('control-header-background')); ?>") center/cover no-repeat;
        }
        .site-header a{
            color: <?php echo get_theme_mod('control_link_color'); ?>;
        }
        .site-header, .entry-header, .director-list-item, .directors-title, .contact-executive-item{
            border-color: <?php echo get_theme_mod('control_border_color'); ?>;
        }
        .directors-title, .work-list a{
            color: <?php echo get_theme_mod('control_border_color'); ?>;
        }
        .site-header li:hover{
            background: <?php echo get_theme_mod('control_border_color'); ?>;
        }
        .site-main, .directors-bio-link{
            color: <?php echo get_theme_mod('control_main_text_color'); ?>;
        }
        .border{
            border-color: <?php echo get_theme_mod('control_main_text_color'); ?>;
        }
        .gallery, .director-list-item .video-thumbnail{
            background: <?php echo get_theme_mod('control_gallery_background_color'); ?>;
            color: <?php echo get_theme_mod('control_main_text_color'); ?>;
        }
    </style>

<?php }

add_action('wp_head', 'control_customize_css');
