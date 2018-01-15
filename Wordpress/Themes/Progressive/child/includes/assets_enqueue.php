<?php
/**
 * Styles and Scripts for cpchild theme.
 * Note: Rename cpchild to theme namespace.
 * Ex.: ldg_<fn_name>, rntv_<fn_name>, etc. ...
 */

// Dequeue unused cobweb theme scripts
function cpchild_remove_unused_scripts_and_styles() {
    wp_dequeue_script( 'cprogressive-price-regulator-jshashtable' );
    wp_dequeue_script( 'cprogressive-price-regulator-numberformatter' );
    wp_dequeue_script( 'cprogressive-price-regulator-tmpl' );
    wp_dequeue_script( 'cprogressive-price-regulator-dependClass' );
    wp_dequeue_script( 'cprogressive-price-regulator-draggable' );
    wp_dequeue_script( 'cprogressive-price-regulator-slider' );

    wp_dequeue_script( 'cprogressive-carouFredSel' );
    wp_dequeue_script( 'cprogressive-touchwipe' );
    wp_dequeue_script( 'cprogressive-elevateZoom' );
    wp_dequeue_script( 'cprogressive-imagesloaded' );
    wp_dequeue_script( 'cprogressive-appear' );
    wp_dequeue_script( 'cprogressive-sparkline' );
    wp_dequeue_script( 'cprogressive-easypiechart' );
    wp_dequeue_script( 'cprogressive-easing' );
    wp_dequeue_script( 'cprogressive-knob' );
    wp_dequeue_script( 'cprogressive-selectBox' );
    wp_dequeue_script( 'cprogressive-royalslider' );
    wp_dequeue_script( 'cprogressive-tubular' );
    wp_dequeue_script( 'cprogressive-SmoothScroll' );
    wp_dequeue_script( 'cprogressive-country' );
    wp_dequeue_script( 'cprogressive-spin' );
    wp_dequeue_script( 'cprogressive-ladda' );
    wp_dequeue_script( 'cprogressive-masonry' );
    wp_dequeue_script( 'cprogressive-morris' );
    wp_dequeue_script( 'cprogressive-video' );
    wp_dequeue_script( 'cprogressive-pixastic' );

    wp_dequeue_script( 'cprogressive-layerslider-greensock' );
    wp_dequeue_script( 'cprogressive-layerslider-transitions' );
    wp_dequeue_script( 'cprogressive-layerslider-kreaturamedia' );

    wp_dequeue_script( 'cprogressive-revolution-tools' );
    wp_dequeue_script( 'cprogressive-revolution-revolution' );

    wp_dequeue_script( 'cprogressive-bootstrapValidator' );
    wp_dequeue_script( 'cprogressive-bootstrap-datepicker' );
    wp_dequeue_script( 'cprogressive-jplayer' );
    wp_dequeue_script( 'cprogressive-jplayer-playlist' );
    wp_dequeue_script( 'cprogressive-scrollbar' );
}
add_action( 'wp_enqueue_scripts', 'cpchild_remove_unused_scripts_and_styles', 100 );

// Load child bundled scripts & stylesheets
function cpchild_assets() {
    // Styles
    wp_enqueue_style( 'cpchild-style', get_stylesheet_uri(), array(), null );
    wp_enqueue_style( 'cpchild-palette', get_stylesheet_directory_uri() . '/css/palette.css', array( 'cpchild-style' ), null );
    wp_enqueue_style( 'cpchild-mega-menu', get_stylesheet_directory_uri() . '/css/mega-menu.css', array( 'cpchild-style' ), null );
    wp_enqueue_style( 'cpchild-responsive', get_stylesheet_directory_uri() . '/css/responsive.css', array( 'cpchild-style' ), null );

    // Scripts
    wp_register_script( 'cpchild-custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cpchild-custom-js' );

    wp_localize_script( 'cpchild-custom-js', 'AjaxModule', array(
        'action'      => 'cpchild_generic_ajax_action',
        'ajaxurl'     => admin_url( 'admin-ajax.php' ),
    ));
}
add_action( 'wp_enqueue_scripts', 'cpchild_assets', 100 );
