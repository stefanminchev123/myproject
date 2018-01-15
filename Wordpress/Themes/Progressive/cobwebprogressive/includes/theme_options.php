<?php

/**
 * Theme Option Page Example
 */
function cprogressive_theme_menu() {
  add_theme_page( 'Theme Option', 'Theme Options', 'manage_options', 'cprogressive_theme_options.php', 'cprogressive_theme_page');
}

add_action('admin_menu', 'cprogressive_theme_menu');

/**
 * Callback function to the add_theme_page
 * Will display the theme options page
 */
function cprogressive_theme_page() {
?>
    <div class="wrap">
      <h2>Theme Options</h2>
      <form method="post" enctype="multipart/form-data" action="options.php">
        <?php
            settings_fields('cprogressive_theme_options');

            do_settings_sections('cprogressive_theme_options.php');
        ?>
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>

      </form>

    </div>
<?php
}

/**
 * Register the settings to use on the theme options page
 */
add_action( 'admin_init', 'cprogressive_register_settings' );

/**
 * Function to register the settings
 */
function cprogressive_register_settings() {
    // Register the settings with Validation callback
    register_setting( 'cprogressive_theme_options', 'cprogressive_theme_options', 'cprogressive_validate_settings' );

    // Add settings section
    add_settings_section( 'cprogressive_text_section', 'Google analytics code', 'cprogressive_display_section', 'cprogressive_theme_options.php' );

    // Create textbox field
    $field_args = array(
        'type'      => 'text',
        'id'        => 'cprogressive_googleA',
        'name'      => 'cprogressive_googleA',
        'desc'      => 'Place your google analytics code here',
        'std'       => '',
        'label_for' => 'cprogressive_googleA',
        'class'     => 'css_class'
    );

    add_settings_field( 'cprogressive_googleA', 'GA Code', 'cprogressive_display_setting', 'cprogressive_theme_options.php', 'cprogressive_text_section', $field_args );
}

/**
 * Function to add extra text to display on each section
 */
function cprogressive_display_section($section) {

}

/**
 * Function to display the settings on the page
 * This is setup to be expandable by using a switch on the type variable.
 * In future you can add multiple types to be display from this function,
 * Such as checkboxes, select boxes, file upload boxes etc.
 */
function cprogressive_display_setting($args) {
    extract( $args );

    $option_name = 'cprogressive_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
              echo "<input class='regular-text$class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";

            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
        break;
    }
}

/**
 * Callback function to the register_settings function will pass through an input variable
 * You can then validate the values and the return variable will be the values stored in the database.
 */
function cprogressive_validate_settings($input) {
    foreach($input as $k => $v) {
        $newinput[$k] = trim($v);

        // Check the input is a letter or a number
        if (!preg_match('/^[A-Z0-9 _]*$/i', $v)) {
            $newinput[$k] = '';
        }
    }

    return $input;
}

/**
 * Add google analytics code to footer
 */
add_action('wp_footer', 'add_googleanalytics');
function add_googleanalytics() {
    global $options;
    $options = get_option( 'cprogressive_theme_options' );
    $output = '';

    if ( $options['cprogressive_googleA'] != "" && !empty( $options['cprogressive_googleA'] ) ):
        $output .= '<script type="text/javascript">';
        $output .=     'var _gaq = _gaq || [];';
        $output .=     '_gaq.push(["_setAccount", "' . $options['cprogressive_googleA'] . '"]);';
        $output .=     '_gaq.push(["_trackPageview"]);';
        $output .=     '(function() {';
        $output .=         'var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;';
        $output .=         'ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";';
        $output .=         'var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);';
        $output .=     '})();';
        $output .= '</script>';
    endif;

    echo $output;
}
