<?php
/*
 * Partials: Slider
 */
?>
<?php if ( is_active_sidebar( 'slider-position' ) ) : ?>
    <div class="slider-position">
        <?php dynamic_sidebar( 'slider-position' ); ?>
    </div><!-- /.slider-position -->
<?php endif; ?>