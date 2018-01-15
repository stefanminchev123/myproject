<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
?>
<?php get_header(); ?>
<section id="main">
    <div class="container">
        <div class="row">
            <article id="main-content" class="content col-xs-12">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="col-sm-6 col-md-6">
                            <div class="box-404 bg">
                                <h1>404</h1>
                                <h2>The page cannot be found.</h2>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <h3>Whoops, our bad...</h3>
                            <p>The page you requested was not found, and we have a fine guess why.</p>
                            <ul>
                                <li>If you typed the URL directly, please make sure the spelling is correct.</li>
                                <li>If you clicked on a link to get here, the link is outdated.</li>
                            </ul>
                            <b>What can you do?</b>
                            <p>Have no fear, help is near! There are many ways you can get back on track with Store.</p>
                            <ul>
                                <li><a href="#">Go back</a> to the previous page.</li>
                                <li>Use the search bar at the top of the page to search for your products. Follow these links to get you back on track!</li>
                                <li><a href="#">Store Home</a> | <a href="#">My Account</a></li>
                            </ul>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </article>
        </div><!-- END main content -->
    </div>
</section><!-- #main -->
<?php get_footer(); ?>
