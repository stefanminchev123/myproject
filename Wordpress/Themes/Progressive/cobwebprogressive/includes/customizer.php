<?php
// Add Logo to theme customizer
function cprogressive_theme_customizer( $wp_customize ) {
    // Create logo section
    $wp_customize->add_section( 'cprogressive_logo_section' , array(
        'title'       => __( 'Logo', 'cprogressive' ),
        'priority'    => 30,
        'description' => 'Upload a logo to replace the default site name and description in the header',
    ) );

    // Create secondary logo section
    $wp_customize->add_section( 'cprogressive_sec_logo_section' , array(
        'title'       => __( 'Secondary Logo', 'cprogressive' ),
        'priority'    => 30,
        'description' => 'Upload a secondary logo.',
    ) );

    // Create footer section
    $wp_customize->add_section( 'cprogressive_footer_section' , array(
        'title'       => __( 'Footer Copyright', 'cprogressive' ),
        'priority'    => 200,
        'description' => '',
    ) );

    // Register logo section in theme customizer
    $wp_customize->add_setting( 'cprogressive_logo' );

    // Register secondary logo section in theme customizer
    $wp_customize->add_setting( 'cprogressive_sec_logo' );

    // Register footer section in theme customizer
    $wp_customize->add_setting( 'cprogressive_footer' );

    // Use an img uploader for logo section
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cprogressive_logo', array(
        'label'    => __( 'Logo', 'cprogressive' ),
        'section'  => 'cprogressive_logo_section',
        'settings' => 'cprogressive_logo',
    ) ) );

    // Use an img uploader for secondary logo section
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cprogressive_sec_logo', array(
        'label'    => __( 'Secondary logo', 'cprogressive' ),
        'section'  => 'cprogressive_sec_logo_section',
        'settings' => 'cprogressive_sec_logo',
    ) ) );

    // Use an img uploader for logo section
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cprogressive_footer', array(
        'label'    => __( 'Footer Copyright Text', 'cprogressive' ),
        'section'  => 'cprogressive_footer_section',
        'settings' => 'cprogressive_footer',
    ) ) );
}
add_action( 'customize_register', 'cprogressive_theme_customizer' );
