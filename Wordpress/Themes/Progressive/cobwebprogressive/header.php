<?php
/**
 * The template for displaying the header
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <title><?php wp_title(); ?></title>

    <!-- Favicon -->
    <?php echo cprogressive_get_site_favicon(); ?>

    <?php wp_head(); ?>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <link rel='stylesheet' href="<?php echo get_template_directory_uri(); ?>/css/ie/ie8.css">
    <![endif]-->
</head>

<body class="apply-sticky-header fixed-header <?php echo join( ' ', get_body_class() ); ?>">
<div class="page-box">
    <div class="page-box-content">
        <header class="header">
            <div class="header-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-9 col-md-6 logo-box">
                            <?php if ( get_theme_mod( 'cprogressive_logo' ) ) : ?>
                                <div class="logo">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                                        <img src="<?php echo esc_url( get_theme_mod( 'cprogressive_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                                    </a>
                                </div>
                            <?php else : ?>
                                <h2 class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                </h2>
                            <?php endif; ?>
                        </div>
                        <?php if ( is_active_sidebar( 'header-top-right' ) ) : ?>
                            <div class="col-xs-3 col-md-6 right-box">
                                <div class="right-box-wrapper text-right">
                                    <?php dynamic_sidebar( 'header-top-right' ); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php get_template_part( 'partials/primary-menu' ); ?>
        </header>
