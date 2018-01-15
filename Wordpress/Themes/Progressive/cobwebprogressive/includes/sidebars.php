<?php
/**
 * Sidebar position registration for Cobweb theme
 */

// Register theme sidebars
function cprogressive_sidebar_init() {
    register_sidebar( array(
        'name' => 'Header Top Left',
        'description' => 'Header left widgets go here',
        'id' => 'header-top-left',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );

    register_sidebar( array(
        'name' => 'Header Top Right',
        'description' => 'Header right widgets go here',
        'id' => 'header-top-right',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );

    register_sidebar( array(
        'name' => 'Banner/Slider',
        'description' => 'Banner/Slider goes here',
        'id' => 'slider-position',
        'before_widget' => '<div class="">',
        'after_widget'  => '</div>',
    ) );

    register_sidebar( array(
        'name' => 'Main Content Top',
        'description' => 'Main content top widgets go here',
        'id' => 'main-content-top',
        'before_widget' => '<div class="widgets">',
        'after_widget'  => '</div>',
    ) );

    register_sidebar( array(
        'name' => 'Main Content Right',
        'description' => 'Main content right widgets go here',
        'id' => 'main-content-right',
        'before_widget' => '<div class="widgets">',
        'after_widget'  => '</div>',
        'before_title'  => '<header><h2 class="title">',
        'after_title'   => '</h2></header>',
    ) );

    register_sidebar( array(
        'name' => 'Main Content Left',
        'description' => 'Main content left widgets go here',
        'id' => 'main-content-left',
        'before_widget' => '<aside class="widget">',
        'after_widget'  => '</aside>',
        'before_title'  => '<header><h2 class="title">',
        'after_title'   => '</h2></header>',
    ) );

    register_sidebar( array(
        'name' => 'Main Content Bottom',
        'description' => 'Main content botom widgets go here',
        'id' => 'main-content-bottom',
        'before_widget' => '<div class="">',
        'after_widget'  => '</div>',
    ) );

    register_sidebar( array(
        'name' => 'Footer Top',
        'description' => 'Footer top widgets go here',
        'id' => 'footer-top',
        'before_widget' => '<aside class="widget">',
        'after_widget'  => '</aside>',
        'before_title'  => '<div class="title-block"><h3 class="title">',
        'after_title'   => '</h3></div>',
    ) );

    register_sidebar( array(
        'name' => 'Footer Bottom',
        'description' => 'Footer Bottom links go here',
        'id' => 'footer-bottom',
        'before_widget' => '<aside class="widget">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'cprogressive_sidebar_init' );
