<?php
/*
 * Partials: Main Content Left
 */
$grid = cprogressive_calculate_main_content_grid();

?>
<?php if ( is_active_sidebar( 'main-content-left' ) ) : ?>
    <div id="sidebar-left" class="sidebar <?php echo $grid[ 'sidebar' ]; ?> main-content-left">
        <?php dynamic_sidebar( 'main-content-left' ); ?>
    </div><!-- /.main-content-left -->
<?php endif; ?>