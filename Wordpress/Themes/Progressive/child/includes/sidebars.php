<?php
/**
 * Sidebar position registration for cpchild theme.
 * Note: Rename cpchild to theme namespace.
 * Ex.: ldg_<fn_name>, rntv_<fn_name>, etc. ...
 */

function cpchild_sidebar_init() {
    // Optionally register new sidebars
    // register_sidebar( array(
    //     'name' => 'Footer Top Right',
    //     'description' => 'Footer top right widgets go here',
    //     'id' => 'footer-top-right',
    //     'before_widget' => '',
    //     'after_widget'  => '',
    //     'before_title'  => '',
    //     'after_title'   => '',
    // ) );

    // Optionally remove unused positions
    // unregister_sidebar( 'header-top-right' );
}
add_action( 'widgets_init', 'cpchild_sidebar_init', 11 );