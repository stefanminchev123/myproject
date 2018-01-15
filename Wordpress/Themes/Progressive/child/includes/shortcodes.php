<?php
/**
 * Shortcodes available for cpchild theme.
 * Note: Rename cpchild to theme namespace.
 * Ex.: ldg_<fn_name>, rntv_<fn_name>, etc. ...
 */

add_action( 'init', 'cpchild_register_shortcodes' );
function cpchild_register_shortcodes(){
   add_shortcode( 'generic_shortcode', 'shortcode_generic_shortcode' );
}

function shortcode_generic_shortcode( $atts, $content = null ) {
    $output;

    $atts = shortcode_atts( array(
        'param_default' => null,
    ), $atts, 'generic_shortcode' );

    ob_start();
    // Expose the global var to generic-shortcode-tpl.php
    set_query_var( 'generic_shortcode_atts', $atts );

    // Load the template
    get_template_part( './partials/generic-shortcode-tpl' );

    // Optionally apply filter after content
    $output = ob_get_clean();

    return $output;
}