<?php
/**
 * Template tags for cpchild theme.
 * Note: Use ONLY for small dynamic html content.
 *       For large structures use partials through get_template_part()
 *
 * Note: Rename cpchild to theme namespace.
 * Ex.: ldg_<fn_name>, rntv_<fn_name>, etc. ...
 *
 * @see: https://codex.wordpress.org/Template_Tags
 */

function cpchild_get_news_entry_date( $article = null ) {
    global $post;

    if ( !$article ) {
        $article = $post;
    }

    ob_start();
    ?>
    <span class="post-date">
        <time datetime="<?php echo get_the_date( 'Y-m-d', $article->ID ); ?>" itemprop="dateCreated datePublished">
            <?php echo get_the_date( 'j F, Y', $article->ID ); ?>
        </time>
    </span>
    <?php
    $output = ob_get_clean();

    return $output;
}

function cpchild_get_at_social_icons( $current_post = null, $check_meta = true ) {
    global $post;

    if ( !$current_post ) {
        $current_post = $post;
    }

    if ( $check_meta ) {
        $has_social_media = get_metadata( 'post', $current_post->ID, '_at_widget', true );

        if ( !$has_social_media ) {
            return null;
        }
    }

    ob_start();
    ?>
    <div class="addthis_toolbox addthis_default_style addthis_20x20_style" addthis:url="<?php echo get_permalink( $current_post->ID ); ?>" addthis:title="<?php echo $current_post->post_title; ?>">
        <a class="addthis_button_facebook at300b" title="Facebook" href="#"><span class="at4-icon-left at4-icon aticon-facebook" style="background-color: rgb(48, 88, 145);"><span class="at_a11y">Share on facebook</span></span></a>
        <a class="addthis_button_twitter at300b" title="Tweet" href="#"><span class="at4-icon-left at4-icon aticon-twitter" style="background-color: rgb(44, 168, 210);"><span class="at_a11y">Share on twitter</span></span></a>
        <a class="addthis_button_google_plusone_share at300b" target="_blank" title="Google+" href="#"><span class="at4-icon-left at4-icon aticon-google_plusone_share" style="background-color: rgb(220, 78, 65);"><span class="at_a11y">Share on google_plusone_share</span></span></a>
        <a class="addthis_button_linkedin at300b" target="_blank" title="LinkedIn" href="#"><span class="at4-icon-left at4-icon aticon-linkedin" style="background-color: rgb(0, 119, 181);"><span class="at_a11y">Share on linkedin</span></span></a>
        <a class="addthis_button_pinterest_share at300b" target="_blank" title="Pinterest" href="#"><span class="at4-icon-left at4-icon aticon-pinterest_share" style="background-color: rgb(200, 40, 40);"><span class="at_a11y">Share on pinterest_share</span></span></a>
        <div class="atclear"></div>
    </div>
    <?php
    $output = ob_get_clean();

    return $output;
}
