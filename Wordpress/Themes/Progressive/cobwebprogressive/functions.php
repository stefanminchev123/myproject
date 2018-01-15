<?php
/**
 * Cobweb Progressive functions and definitions
 */

require_once('includes/sidebars.php');
require_once('includes/customizer.php');
require_once('includes/assets_enqueue.php');
require_once('includes/theme_options.php');

function cprogressive_get_site_favicon() {
    $favicon = '';

    // Use favicon from child theme and fallback to favicon in parent
    file_exists( get_stylesheet_directory() . '/favicon.ico' )
        ? $favicon = '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri() .'/favicon.ico">'
        : $favicon = '<link rel="shortcut icon" href="' . get_template_directory_uri() .'/favicon.ico">';

    return $favicon;
}

// Register primary and sidebar menus
function cprogressive_after_setup_theme() {
    register_nav_menus( array(
        'primary' => 'Primary Menu',
    ) );
}
add_action( 'after_setup_theme', 'cprogressive_after_setup_theme' );

// Add theme support for excerpts in pages
add_post_type_support( 'page', 'excerpt' );

// Add theme support for featured images in pages
add_theme_support( 'post-thumbnails' );

// Add shortcode support to widgets
add_filter( 'widget_text', 'do_shortcode' );

// Modify theme menus to match progressive theme naming
function cprogressive_add_menu_parent_class( $items, $args ) {
    $parents = array();
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }

    foreach ( $items as $i => $item ) {

        if ( in_array( $item->ID, $parents ) ) {

            // Add sub menu toggler on all menus that are not the primary
            if ( $args->theme_location != 'primary' ) {
                $item->title = '<span class="open-sub"></span>' . $item->title;
            }
            array_push( $items[ $i ]->classes, 'parent' );
        }
    }

    return $items;
}
add_filter( 'wp_nav_menu_objects', 'cprogressive_add_menu_parent_class', 10, 2 );

// Modify class names of all sub-menus
function cprogressive_change_primary_menu_classes( $menu ) {
    $menu = preg_replace( '/class="sub-menu"/', '/class="sub"/', $menu );

    return $menu;
}
add_filter( 'wp_nav_menu', 'cprogressive_change_primary_menu_classes' );

// Add bootstrap classes to footer-top sidebar
function cprogressive_bs_sidebar_params( $params ) {
    $sidebar_id = $params[0]['id'];

    if ( $sidebar_id == 'footer-top' ) {

        $total_widgets = wp_get_sidebars_widgets();
        $sidebar_widgets = count( $total_widgets[$sidebar_id] );

        $params[0]['before_widget'] = str_replace( 'class="', 'class="col-xs-12 col-sm-6 col-md-' . floor( 12 / $sidebar_widgets ) . ' ', $params[0]['before_widget'] );
    }

    return $params;
}
add_filter( 'dynamic_sidebar_params', 'cprogressive_bs_sidebar_params' );

/**
 * Calculates main content column width based on active sidebars.
 * @return Array
 *
 * $grid['article'] keeps the grid classes for the main content
 * $grid['sidebar'] keeps the grid classes for the active sidebars
 */
function cprogressive_calculate_main_content_grid() {
    $grid = array();
    $article_class[] = 'col-xs-12';
    $sidebar_class[] = 'col-xs-12';

    if ( is_active_sidebar( 'main-content-left' ) && is_active_sidebar( 'main-content-right' ) ) {
        $article_class[] = 'col-md-6';
        $sidebar_class[] = 'col-md-3';
    } else if ( is_active_sidebar( 'main-content-left' ) && !is_active_sidebar( 'main-content-right' ) ) {
        $article_class[] = 'col-md-8';
        $sidebar_class[] = 'col-md-4';
    } else if ( is_active_sidebar( 'main-content-right' ) && !is_active_sidebar( 'main-content-left' ) ) {
        $article_class[] = 'col-md-8';
        $sidebar_class[] = 'col-md-4';
    } else {
        $article_class[] = 'col-md-12';
    }

    $article_class = implode( ' ', $article_class );
    $sidebar_class = implode( ' ', $sidebar_class );

    $grid['article'] = $article_class;
    $grid['sidebar'] = $sidebar_class;

    return $grid;
}

/**
* Get children by parent slug
* @param  String      $page_path Parent page slug (path)
* @return Object|bool $post      WP_Post Object ready for the loop
*/
function cprogressive_get_page_children_by_path( $page_path = null ) {
    if ( !$page_path ) {
        return null;
    }

    // Set up the objects needed
    $page_query = new WP_Query();
    $all_pages = $page_query->query( array(
        'post_type' => 'page',
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'nopaging' => true
    ) );

    // Get the page as an Object
    $parent_page = get_page_by_path( $page_path );

    // Filter through all pages and return the children
    return get_page_children( $parent_page->ID, $all_pages );
}

/**
* Format phone number for tel: param in href attr,
* removing the following chars: '+', '(', ')', ' '.
* @param  String      $phone_number Parent page slug (path)
* @return String|bool               Formatted phone number
*/
function cprogressive_format_phone_number( $phone_number = null ) {
    if ( !$phone_number ) {
        return null;
    }

    $esc_chars = array( '+', '(', ')', ' ' );
    $formatted_phone_number = str_replace( $esc_chars, '', $phone_number );

    return $formatted_phone_number;
}

// Bugfix[05.06.2015]: Disable emoji scripts until Wordpress update
function cprogressive_disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'cprogressive_disable_emojicons_tinymce' );
}
add_action( 'init', 'cprogressive_disable_wp_emojicons' );

function cprogressive_disable_emojicons_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

function cprogressive_get_total_results() {
    global $wp_query;

    return $wp_query->found_posts;
}

function cprogressive_has_more_posts( $query_params = array() ) {
    $next_query = new WP_Query( array(
        'paged'         => isset( $query_params[ 'paged' ] ) ? $query_params[ 'paged' ] : '2',
        'post_type'     => isset( $query_params[ 'post_type' ] ) ? $query_params[ 'post_type' ] : 'article',
        's'             => isset( $query_params[ 's' ] ) ? $query_params[ 's' ] : '',
        'author'        => isset( $query_params[ 'author' ] ) ? $query_params[ 'author' ] : '',
        'category_name' => isset( $query_params[ 'category_name' ] ) ? $query_params[ 'category_name' ] : '',
    ) );

    return $next_query->have_posts();
}

function cprogressive_get_post_img_src( $post_id = null, $size = 'full' ) {
    global $post;

    if ( !$post_id ) {
        $post_id = $post->ID;
    }
    $attachment = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );

    return ( $attachment ) ? array_shift( $attachment ) : get_default_post_thumbnail_src( $size );
}

function cprogressive_get_default_post_thumbnail_src( $prefered = null ) {
    $src = '';
    $default_img_name = 'no_preview.jpg';

    $default_thumbs = [ 'author-thumb' => 'no_author.jpg', 'area-thumb' => 'no_area.jpg', ];
    if ( array_key_exists( $prefered, $default_thumbs ) ) {
        $default_img_name = $default_thumbs[ $prefered ];
    }

    // Use default img from child theme and fallback to default img in parent
    ( file_exists( get_stylesheet_directory() . '/images/' . $default_img_name ) )
        ? $src = get_stylesheet_directory_uri() .'/images/' . $default_img_name
        : $src = get_template_directory_uri() .'/img/' . $default_img_name;

    return $src;
}

function cprogressive_get_default_post_thumbnail() {
    $img = '<img width="280" height="160" src="' . get_default_post_thumbnail_src() . '" alt="No preview available" itemprop="image">';

    return $img;
}

function cprogressive_get_article_tag_names() {
    global $post;
    $output = array();

    $tags = get_the_tags( $post->ID );

    if ( is_array( $tags ) ) {
        $output = array_map( function( $tag ) {
            return $tag->name;
        }, $tags );
    }

    return $output;
}

function cprogressive_get_article_tag_list() {
    $output = '';

    $tags = get_the_tags( $post->ID );

    if ( is_array( $tags ) ) {
        $output = implode( ', ', $tags );
    }

    return $output;
}

function cprogressive_get_related_articles( $article = null ) {
    global $post;
    $related_articles = null;

    if ( !$article ) {
        $article = $post;
    }

    // Get post tags
    $tags = get_the_tags( $article->ID );

    // Bail out if there are no tags
    if ( !$tags ) {
        return null;
    }

    // Gather the tag IDs in an array
    $tag_ids = array_map( function( $tag ) {
        return $tag->term_id;
    }, $tags );

    $query = new WP_Query( array(
        'post_type' => 'article',
        'tag__in' => $tag_ids,
        'post__not_in' => array( $article->ID ),
        'posts_per_page' => 3,
    ) );

    $related_articles = $query->posts;

    return $related_articles;
}

/**
 * Get the article author corresponding to news-author custom post type
 * @param  Integer $user_ID WP User ID
 * @return Array|bool          Null when WP User was not passed or
 *                             there is no custom post type with this author.
 */
function cprogressive_get_news_author( $user_ID = null ) {
    global $post;

    // If it's a single.php and user id is not passed, try to get the author by the post
    if ( is_single() && !$user_ID ) {
       $user_ID = $post->post_author;
    }

    // Cannot find the news author if there is no WP User. Bailing out with 'falsy' value.
    if ( !$user_ID ) {
        return null;
    }

    $query = new WP_Query( array(
        'post_type'      => 'cp-author',
        'author'         => $user_ID,
        'posts_per_page' => 1,
    ) );

    // Add fields only if we found the News Author
    if ( $query->have_posts() ) {
        $news_author                 = array_shift( $query->posts );
        $news_author->post_thumbnail = get_post_img_src( $news_author->ID, 'author-thumb' );
        $news_author->email          = types_render_field( 'cp-email', array( 'output' => 'raw', 'post_id' => $news_author->ID ) );
        $news_author->phone          = types_render_field( 'cp-phone', array( 'output' => 'raw', 'post_id' => $news_author->ID ) );
        $news_author->job_position   = types_render_field( 'cp-job-position', array( 'output' => 'raw', 'post_id' => $news_author->ID ) );
    }

    $author = array(
        'user_ID'      => $user_ID,
        'permalink'    => get_author_posts_url( $user_ID ),

        'author_ID'    => isset( $news_author->ID ) ? $news_author->ID : get_the_author_meta( 'display_name', $user_ID ),
        'name'         => isset( $news_author->post_title ) ? $news_author->post_title : get_the_author_meta( 'display_name', $user_ID ),
        'bio'          => isset( $news_author->post_content ) ? $news_author->post_content : get_the_author_meta( 'description', $user_ID ),
        'photo'        => isset( $news_author->post_thumbnail ) ? $news_author->post_thumbnail : get_default_post_thumbnail_src(),

        'email'        => isset( $news_author->email ) ? $news_author->email : get_the_author_meta( 'email', $user_ID ),
        'phone'        => isset( $news_author->phone ) ? $news_author->phone : null,
        'job_position' => isset( $news_author->job_position ) ? $news_author->job_position : null,
    );

    return $author;
}

/**
 * Get news written by WP User. Returned object is a normal ready-to-use WP_Query
 * @param  Array  $author Array with WP user_ID
 * @return Object         WP_Query object
 */
function cprogressive_get_news_author_articles( $author = array() ) {
    $user_ID = isset( $author[ 'user_ID' ] ) ? $author[ 'user_ID' ] : '';

    return new WP_Query( array(
        'post_type' => 'article',
        'author' => $user_ID,
    ) );
}

function cprogressive_get_team_member( $team_member = null ) {
    global $post;

    if ( !$team_member ) {
        $team_member_slug = get_query_var( 'team_member' );

        // Can't get which team member to show. Bailing out
        if ( !strlen( $team_member_slug ) ) {
            return null;
        }

        $args = array(
            'post_type' => 'cp-team-member',
            'posts_per_page' => '1',
            'name' => $team_member_slug,
        );

        $query = new WP_Query( $args );
        $posts = $query->posts;
        $team_member = array_shift( $posts );
    }

    $email = types_render_field( 'cp-email', array( 'output' => 'raw', 'post_id' => $team_member->ID ) );
    $phone = types_render_field( 'cp-phone', array( 'output' => 'raw', 'post_id' => $team_member->ID ) );
    $job_position = types_render_field( 'cp-job-position', array( 'output' => 'raw', 'post_id' => $team_member->ID ) );

    $team_member->phone = isset( $phone ) ? $phone : null;
    $team_member->email = isset( $email ) ? $email : null;
    $team_member->job_position = isset( $job_position ) ? $job_position : null;

    return $team_member;
}

/**
 * Get all tags from provided posts
 * @param  Array      $posts Array of WP_Post objects
 * @return Array|Bool        Array of WP_Tag objects
 */
function cprogressive_get_post_terms( $posts = null ) {
    if ( !$posts ) {
        return null;
    }

    $post_ids = array_map( function( $post ) {
        return $post->ID;
    }, $posts );

    return wp_get_object_terms( $post_ids, 'post_tag' );
}

function cprogressive_get_isotope_filter_classes( $post_id ) {
    global $post;

    if ( !$post_id ) {
        $post_id = $post->ID;
    }

     $team_department  =  types_render_field( 'team-department', array( 'post_id' => $post_id ) );
     if( $team_department == '' ) $team_department = 'commercial';

    return $team_department ;
}

function cprogressive_obfuscate( $str = '' ) {
    if ( strlen( $str ) && function_exists( 'eae_encode_str' ) ) {
        return eae_encode_str( $str );
    }
}

function cprogressive_get_page_by_slug( $slug = '' ) {
    global $wpdb;

    if ( strlen( $slug ) == 0 ) {
        return null;
    }

    $page = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type = %s AND post_status = 'publish'", $slug, 'page' ) );

    return ( $page ) ? get_post( $page ) : null;
}