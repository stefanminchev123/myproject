<?php
/*
 * Partials: Main Content Right
 */
$grid = cprogressive_calculate_main_content_grid();
?>
<?php if ( is_active_sidebar( 'main-content-right' ) ) : ?>
    <div id="sidebar-right" class="sidebar <?php echo $grid[ 'sidebar' ]; ?> main-content-right">
        <?php dynamic_sidebar( 'main-content-right' ); ?>
    </div><!-- /.main-content-right -->
<?php endif; ?>