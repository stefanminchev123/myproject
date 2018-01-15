<?php
/*
 * Partials: Main Content Bottom
 */
?>
<?php if ( is_active_sidebar( 'main-content-bottom' ) ) : ?>
    <div class="main-content-bottom">
        <?php dynamic_sidebar( 'main-content-bottom' ); ?>
    </div><!-- /.main-content-bottom -->
<?php endif; ?>