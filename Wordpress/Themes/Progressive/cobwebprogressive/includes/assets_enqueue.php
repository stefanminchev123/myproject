<?php
/**
 * Cobweb Progressive Styles and Scripts
 */

// Enqueue styles.
function cprogressive_styles() {
    // Load Progressive Fonts
    wp_enqueue_style( 'cprogressive-fonts', 'http://fonts.googleapis.com/css?family=Arimo:400,700,400italic,700italic', array(), null );

    // Load Progressive theme components and plugin CSS
    wp_enqueue_style( 'cprogressive-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), null );
    wp_enqueue_style( 'cprogressive-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css', array(), null );
    wp_enqueue_style( 'cprogressive-animate', get_template_directory_uri() . '/css/animate.css', array(), null );

    // Load Progressive theme CSS
    wp_enqueue_style( 'cprogressive-theme', get_template_directory_uri() . '/css/style.css', array(), null );

    // Load Progressive Page template custom CSS
    wp_enqueue_style( 'cprogressive-pages', get_template_directory_uri() . '/css/customizer/pages.css', array(), null );
    wp_enqueue_style( 'cprogressive-pages-customizer', get_template_directory_uri() . '/css/customizer/pages-pages-customizer.css', array(), null );

    // Load Cobweb Progressive styles
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array(), null );

    // Load Progressive IE Styles
    wp_enqueue_style( 'cprogressive-ie', get_template_directory_uri() . '/css/ie/ie.css', array(), null );
}
add_action( 'wp_enqueue_scripts', 'cprogressive_styles' );

// Enqueue scripts.
function cprogressive_scripts() {
    wp_enqueue_script( 'cprogressive-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), null, true );

    wp_enqueue_script( 'cprogressive-price-regulator-jshashtable', get_template_directory_uri() . '/js/price-regulator/jshashtable-2.1_src.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-price-regulator-numberformatter', get_template_directory_uri() . '/js/price-regulator/jquery.numberformatter-1.2.3.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-price-regulator-tmpl', get_template_directory_uri() . '/js/price-regulator/tmpl.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-price-regulator-dependClass', get_template_directory_uri() . '/js/price-regulator/jquery.dependClass-0.1.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-price-regulator-draggable', get_template_directory_uri() . '/js/price-regulator/draggable-0.1.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-price-regulator-slider', get_template_directory_uri() . '/js/price-regulator/jquery.slider.js', array( 'jquery' ), null, true );

    wp_enqueue_script( 'cprogressive-carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-touchwipe', get_template_directory_uri() . '/js/jquery.touchwipe.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-elevateZoom', get_template_directory_uri() . '/js/jquery.elevateZoom-3.0.8.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-imagesloaded', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-appear', get_template_directory_uri() . '/js/jquery.appear.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-sparkline', get_template_directory_uri() . '/js/jquery.sparkline.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-easypiechart', get_template_directory_uri() . '/js/jquery.easypiechart.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-fancybox', get_template_directory_uri() . '/js/jquery.fancybox.pack.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-knob', get_template_directory_uri() . '/js/jquery.knob.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-selectBox', get_template_directory_uri() . '/js/jquery.selectBox.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-royalslider', get_template_directory_uri() . '/js/jquery.royalslider.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-tubular', get_template_directory_uri() . '/js/jquery.tubular.1.0.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-SmoothScroll', get_template_directory_uri() . '/js/SmoothScroll.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-country', get_template_directory_uri() . '/js/country.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-spin', get_template_directory_uri() . '/js/spin.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-ladda', get_template_directory_uri() . '/js/ladda.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-morris', get_template_directory_uri() . '/js/morris.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-raphael', get_template_directory_uri() . '/js/raphael.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-video', get_template_directory_uri() . '/js/video.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-pixastic', get_template_directory_uri() . '/js/pixastic.custom.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-livicons', get_template_directory_uri() . '/js/livicons-1.4.min.js', array( 'jquery' ), null, true );

    wp_enqueue_script( 'cprogressive-layerslider-greensock', get_template_directory_uri() . '/js/layerslider/greensock.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-layerslider-transitions', get_template_directory_uri() . '/js/layerslider/layerslider.transitions.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-layerslider-kreaturamedia', get_template_directory_uri() . '/js/layerslider/layerslider.kreaturamedia.jquery.js', array( 'jquery' ), null, true );

    wp_enqueue_script( 'cprogressive-revolution-tools', get_template_directory_uri() . '/js/revolution/jquery.themepunch.tools.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-revolution-revolution', get_template_directory_uri() . '/js/revolution/jquery.themepunch.revolution.min.js', array( 'jquery' ), null, true );

    wp_enqueue_script( 'cprogressive-bootstrapValidator', get_template_directory_uri() . '/js/bootstrapValidator.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-bootstrap-datepicker', get_template_directory_uri() . '/js/bootstrap-datepicker.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-jplayer', get_template_directory_uri() . '/js/jplayer/jquery.jplayer.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-jplayer-playlist', get_template_directory_uri() . '/js/jplayer/jplayer.playlist.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'cprogressive-scrollbar', get_template_directory_uri() . '/js/jquery.scrollbar.min.js', array( 'jquery' ), null, true );

    wp_enqueue_script( 'cprogressive-jquery-tinypubsub', get_template_directory_uri() . '/js/jquery.ba-tinypubsub.min.js', array( 'jquery' ), null, true );

    wp_enqueue_script( 'cprogressive-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), null, true );
}
add_action( 'wp_enqueue_scripts', 'cprogressive_scripts' );
?>