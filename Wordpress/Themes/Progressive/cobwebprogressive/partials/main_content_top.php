<?php
/*
 * Partial: Main Content Top
 */
?>
<?php if ( is_active_sidebar( 'main-content-top' ) ) : ?>
    <div class="main-content-top">
        <?php dynamic_sidebar( 'main-content-top' ); ?>
    </div><!-- /.main-content-top -->
<?php endif; ?>