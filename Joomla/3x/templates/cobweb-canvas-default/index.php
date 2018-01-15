<?php
defined('_JEXEC') or die( 'Restricted access' );

$this->setGenerator('');
$jinput = JFactory::getApplication()->input;

$option = $jinput->get('option', '', 'filter');
$view   = $jinput->get('view', '', 'filter');
$itemId = $jinput->get('Itemid', '', 'filter');

$item = $jinput->get('id', '', 'filter');

jimport('joomla.language.helper');
$languages   = JLanguageHelper::getLanguages('lang_code');
$lang_code   = JFactory::getLanguage()->getTag();
$sef         = $languages[$lang_code]->sef;
$color       = $this->params->get('templatecolor', 'red');
$headerImage = $this->params->get('headerImage');
$logo        = $this->params->get('logo');
$logowidth   = $this->params->get('width');
$logoheight  = $this->params->get('height');
$bgcolor     = $this->params->get('backgroundcolor');
$bgImage     = $this->params->get('backgroundImage');

$doc = JFactory::getDocument();
$page_title = $doc->getTitle();

$isHomePage = false;
$siteLoc = 'innerPage';
$app = JFactory::getApplication();
$menu = $app->getMenu();
if ( $menu->getActive() == $menu->getDefault() ) {
    $isHomePage = true;
    $siteLoc = 'homePage';
}

$productDetailsClass = '';

if($view == 'productdetails' && $option == 'com_virtuemart'){
    $productDetailsClass = 'productdetails-page';
}

// if image set
if ($bgImage)
{
    $this->addStyleDeclaration("
    body {
        background: url('" . $this->baseurl . "/" . htmlspecialchars($bgImage) . "');
    }");
}


require_once JPATH_BASE . '/templates/' . $this->template . '/assets/unset-styles/unset_styles.php';

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
<head>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/noConflict.js"></script>
    <!-- js -->
    <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/customizeHeader.js"></script>

    <jdoc:include type="head"/>

    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/font-awesome/css/font-awesome.min.css" type="text/css"/>

    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Damion" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:300" rel="stylesheet">

    <!-- Include Canvas Styles -->
    <?php require_once JPATH_BASE . '/templates/' . $this->template . '/assets/canvas/include_styles.php'; ?>


    <link rel="stylesheet"
          href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/metronic/corporate/css/style-shop.css"
          type="text/css"/>

    <link rel="stylesheet"
          href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/color.css"
          type="text/css"/>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/responsive.css"
          type="text/css"/>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/pink.css"
          type="text/css"/>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/style.css"
          type="text/css"/>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css"
          type="text/css"/>
     <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/category_blog.css"
          type="text/css"/>

         
    <!-- Include Highslide-->
    <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/highslide/highslide-full.js"></script>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/highslide/highslide.css" />
    <script type="text/javascript">
        hs.graphicsDir = '<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/highslide/graphics/';
        hs.showCredits = false;
        hs.addSlideshow({
            interval: 5000,
            repeat: false,
            useControls: true,
            fixedControls: true,
            overlayOptions: {
                opacity: .6,
                position: 'top center',
                hideOnMouseOut: true
            }
        });
        // Optional: a crossfade transition looks good with the slideshow
        hs.transitions = ['expand', 'crossfade'];


    </script>

</head>

<?php
$app       = JFactory::getApplication();
$menu      = $app->getMenu()->getActive();
$pageclass = '';
if (is_object($menu)) {
    $pageclass = $menu->params->get('pageclass_sfx');
}

?>

<body class="<?php echo $pageclass ? htmlspecialchars($pageclass) : 'default'; ?> <?php echo $siteLoc; ?> <?php echo $productDetailsClass; ?> item-<?= $itemId; ?> stretched no-transition">

<?php if ($this->countModules('offcanvas_menu')): ?>
    <div class="offcanvas-menu">
        <a href="#" class="close-offcanvas"><i class="fa fa-remove"></i></a>
        <div class="offcanvas-inner">
            <jdoc:include type="modules" name="offcanvas_menu" style="Styleh4" />
        </div>
    </div>
<?php endif; ?>


<div id="wrapper" class="clearfix">

    <?php if ($this->countModules('pre_header_right') || $this->countModules('pre_header_left')): ?>
        <div id="top-bar">
            <div class="container clearfix">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 pre_header_left">
                        <jdoc:include type="modules" name="pre_header_left" style="Styleh4"/>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 pre_header_right">
                        <jdoc:include type="modules" name="pre_header_right" style="Styleh4"/>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <header id="header" class="transparent-header page-section dark">
        <div id="header-wrap">
            <div class="container">
            <div class="row">
                <?php if ($this->countModules('header_top_left or header_top_right')): ?>
                    <?php if ($this->countModules('header_top_left')): ?>
                        <div class="col-md-3 col-sm-4 col-xs-6 header_top_left">
                            <jdoc:include type="modules" name="header_top_left" style="Styleh4"/>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->countModules('header_top_right')): ?>
                        <div class="col-md-9 col-sm-8 col-xs-6 header_top_right">

                            <div id="mobileMenu">
                                <a id="offcanvas-toggler" href="#">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </div>

                            <jdoc:include type="modules" name="header_top_right" style="Styleh4"/>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
             </div>
        </div>

        <?php if ($this->countModules('header_bottom')) : ?>
        <div class="header_bottom">
            <div class="row">
                <div class="container">
                    <?php if ($this->countModules('header_bottom')) : ?>
                            <jdoc:include type="modules" name="header_bottom" style="Styleh4"/>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </header>
    <!-- /end-header-->

    <!-- Slider -->
    <?php if ($this->countModules('slider')){ ?>
        <section id="slider" class="slider-parallax force-full-screen full-screen slider-parallax-visible">
            <jdoc:include type="modules" name="slider"/>
        </section>
        <?php }else{ ?>

        <section id="slider">
            <jdoc:include type="modules" name="inner_slider"/>
        </section>

    <?php } ?>
    <!-- end slider -->
    <?php if(!$isHomePage && $this->countModules('breadcrumb')): ?>
        <section id="page-title" class="page-title-mini">
            <div class="container clearfix">
                 <jdoc:include type="modules" name="breadcrumb" style="Styleh4"/>
            </div>
        </section>
    <?php endif; ?>

    <section id="content" class="mainbody-wrapper">
        <?php if ($this->countModules('slider-bottom')): ?>
            <div class="container">
                <div class="col-md-12">
                    <div data-appear-animation="fadeIn" class="slider-bottom row">
                        <jdoc:include type="modules" name="slider-bottom" style="Styleh4"/>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php
            $content_top_left   = "col-md-4";
            $content_top_center = "col-md-4";
            $content_top_right  = "col-md-4";
            if ($this->countModules('content_top_left') && !$this->countModules('content_top_right')) {
                $content_top_left   = "col-md-3";
                $content_top_center = "col-md-9";
            } else if (!$this->countModules('content_top_left') && $this->countModules('content_top_right')) {
                $content_top_center = "col-md-9";
                $content_top_right  = "col-md-3";
            } else if (!$this->countModules('content_top_left') && !$this->countModules('content_top_right')) {
                $content_top_center = "col-md-12";
            }
        ?>
        <?php if ($this->countModules('content_top_left or content_top_right or content_top_center')): ?>
            <div class="content_top">
                <div class="container">
                    <div class="row content_top_inner">
                        <?php if ($this->countModules('content_top_left')): ?>
                            <div data-appear-animation="fadeInLeft"
                                 class="<?php echo $content_top_left ?> content_top_left">
                                <jdoc:include type="modules" name="content_top_left" style="Styleh4"/>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->countModules('content_top_center')): ?>
                            <div data-appear-animation="fadeInUp"
                                 class="<?php echo $content_top_center ?> content_top_center">
                                <jdoc:include type="modules" name="content_top_center" style="Styleh4"/>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->countModules('content_top_right')): ?>
                            <div data-appear-animation="fadeInRight"
                                 class="<?php echo $content_top_right ?> content_top_right">
                                <jdoc:include type="modules" name="content_top_right" style="Styleh4"/>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="clearfix"></div>

        <div class="main_content container content-wrap">
            <?php
                $main_content_left   = "col-lg-2 col-md-3 col-sm-3";
                $main_content_center = "col-lg-7 col-md-6 col-sm-9";
                $main_content_right  = "col-md-3";

                if ($this->countModules('main_content_left') && !$this->countModules('main_content_right')) {
                    $main_content_left   = "col-md-3";
                    $main_content_center = "col-md-9";
                } else if (!$this->countModules('main_content_left') && $this->countModules('main_content_right')) {
                    $main_content_center = "col-md-9";
                    $main_content_right  = "col-md-3";
                } else if (!$this->countModules('main_content_left') && !$this->countModules('main_content_right')) {
                    $main_content_center = "col-md-12";
                }
            ?>
           
            <div class="row main_content_inner noMargin">
   
                <?php if ($this->countModules('main_content_left')): ?>
                    <div class="sidebar nobottommargin clearfix">
                        <div class="sidebar-widgets-wrap">
                        <jdoc:include type="modules" name="main_content_left" style="SidebarModules"/>
                    </div>
                    </div>
                <?php endif; ?>
                <div class="<?php echo $main_content_center ?> wrap_center">
                    <?php if ($this->countModules('main_content_top')): ?>
                        <div class="main_content_top">
                            <jdoc:include type="modules" name="main_content_top" style="SidebarModules"/>
                        </div>
                    <?php endif; ?>

                    <div class="main_content_center">
                        <jdoc:include type="message"/>
                        <jdoc:include type="component"/>
                        <?php if ($this->countModules('main_content_center')): ?>
                            <jdoc:include type="modules" name="main_content_center" style="SidebarModules"/>
                        <?php endif; ?>


                        <?php

                        $content_module_left  = "col-md-6";
                        $content_module_right = "col-md-6";

                        if ($this->countModules('content_module_left') || $this->countModules('content_module_right')): ?>

                            <div class="<?php echo $content_module_left; ?> content_module_left">
                                <jdoc:include type="modules" name="content_module_left" style="Styleh4"/>
                            </div>
                            <div class="<?php echo $content_module_right; ?> content_module_right">
                                <jdoc:include type="modules" name="content_module_right" style="Styleh4"/>
                            </div>

                        <?php endif; ?>

                    </div>
                    <?php if ($this->countModules('main_content_bottom')): ?>
                        <div class="main_content_bottom">
                            <jdoc:include type="modules" name="main_content_bottom" style="SidebarModules"/>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ($this->countModules('main_content_right')): ?>
                    <div class="<?php echo $main_content_right ?> main_content_right sidebar-widgets-wrap">
                        <jdoc:include type="modules" name="main_content_right" style="SidebarModules"/>
                    </div>
                <?php endif; ?>
            </div>
  
        </div>
    

        <?php
            $content_bottom_left   = "col-md-4";
            $content_bottom_center = "col-md-4";
            $content_bottom_right  = "col-md-4";
            if ($this->countModules('content_bottom_left') && !$this->countModules('content_bottom_right')) {
                $content_bottom_left   = "col-md-3";
                $content_bottom_center = "col-md-9";
            } else if (!$this->countModules('content_bottom_left') && $this->countModules('content_bottom_right')) {
                $content_bottom_center = "col-md-9";
                $content_bottom_right  = "col-md-3";
            } else if (!$this->countModules('content_bottom_left') && !$this->countModules('content_bottom_right')) {
                $content_bottom_center = "col-md-12";
            } else if ($this->countModules('content_bottom_left') && $this->countModules('content_bottom_right')) {
                $content_bottom_left  = "col-md-6";
                $content_bottom_right = "col-md-6";
            } else if ($this->countModules('content_bottom_left') && $this->countModules('content_bottom_center')) {
                $content_bottom_left   = "col-md-6";
                $content_bottom_center = "col-md-6";
            }
            if ($this->countModules('content_bottom_left') && $this->countModules('content_bottom_right') && $this->countModules('content_bottom_center')) {
                $content_bottom_left   = "col-md-4";
                $content_bottom_center = "col-md-4";
                $content_bottom_right  = "col-md-4";
            }
            if (!$this->countModules('content_bottom_left') && $this->countModules('content_bottom_right') && !$this->countModules('content_bottom_center')) {
                $content_bottom_right = "col-md-12";
            }
            if ($this->countModules('content_bottom_left') && !$this->countModules('content_bottom_right') && !$this->countModules('content_bottom_center')) {
                $content_bottom_left = "col-md-12";
            }
            if (!$this->countModules('content_bottom_left') && !$this->countModules('content_bottom_right') && $this->countModules('content_bottom_center')) {
                $content_bottom_center = "col-md-12";
            }
            if ($this->countModules('content_bottom_left') && $this->countModules('content_bottom_center')) {
                $content_bottom_left   = "col-md-6";
                $content_bottom_center = "col-md-6";
            }
            if ($this->countModules('content_bottom_right') && $this->countModules('content_bottom_center')) {
                $content_bottom_right  = "col-md-6";
                $content_bottom_center = "col-md-6";
            }

            if ($this->countModules('content_bottom_left') && $this->countModules('content_bottom_center') && $this->countModules('content_bottom_right')) {
                $content_bottom_left   = "col-md-4 ";
                $content_bottom_center = "col-md-4 ";
                $content_bottom_right  = "col-md-4 ";
            }
        ?>

        <?php if ($this->countModules('content_bottom_left or content_bottom_center or content_bottom_right')): ?>
            <div class="steps-block">
                <div class="content_bottom">
                    <div class="row content_bottom_inner">
                        <?php if ($this->countModules('content_bottom_left')): ?>
                            <div class="<?php echo $content_bottom_left ?> content_bottom_left  steps-block-col">
                                <div class="text-center">
                                    <jdoc:include type="modules" name="content_bottom_left" style="Styleh4"/>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->countModules('content_bottom_center')): ?>
                            <div class="<?php echo $content_bottom_center ?> content_bottom_center  steps-block-col ">
                                <div class="text-center">
                                    <jdoc:include type="modules" name="content_bottom_center" style="Styleh4"/>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->countModules('content_bottom_right')): ?>
                            <div class="<?php echo $content_bottom_right ?> content_bottom_right  steps-block-col">
                                <div class="text-center">
                                    <jdoc:include type="modules" name="content_bottom_right" style="Styleh4"/>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="clr"></div>
        <?php endif; ?>

        <?php
            $footer_top_1 = "col-md-3";
            $footer_top_2 = "col-md-3";
            $footer_top_3 = "col-md-3";
            $footer_top_4 = "col-md-3";
            if ($this->countModules('footer_top_1') && !$this->countModules('footer_top_2') && !$this->countModules('footer_top_3') && !$this->countModules('footer_top_4')) {
                $footer_top_1 = "col-md-12";
                $footer_top_2 = "";
                $footer_top_3 = "";
                $footer_top_4 = "";
            } else if ($this->countModules('footer_top_1') && $this->countModules('footer_top_2') && !$this->countModules('footer_top_3') && !$this->countModules('footer_top_4')) {
                $footer_top_1 = "col-md-6";
                $footer_top_2 = "col-md-6";
                $footer_top_3 = "";
                $footer_top_4 = "";
            } else if (!$this->countModules('footer_top_1') && !$this->countModules('footer_top_2') && $this->countModules('footer_top_3') && $this->countModules('footer_top_4')) {
                $footer_top_1 = "";
                $footer_top_2 = "";
                $footer_top_3 = "col-md-6";
                $footer_top_4 = "col-md-6";
            } else if (!$this->countModules('footer_top_1') && $this->countModules('footer_top_2') && $this->countModules('footer_top_3') && !$this->countModules('footer_top_4')) {
                $footer_top_1 = "";
                $footer_top_2 = "col-md-6";
                $footer_top_3 = "col-md-6";
                $footer_top_4 = "";
            } else if ($this->countModules('footer_top_1') && $this->countModules('footer_top_2') && $this->countModules('footer_top_3') && !$this->countModules('footer_top_4')) {
                $footer_top_1 = "col-md-4";
                $footer_top_2 = "col-md-4";
                $footer_top_3 = "col-md-4";
                $footer_top_4 = "";
            }
        ?>
        <div class="clr"></div>
        <?php if ($this->countModules('footer_top_bar')): ?>
            <div class="footer_top_bar">
                    <jdoc:include type="modules" name="footer_top_bar" style="Styleh4"/>
            </div>
        <?php endif; ?>

    </section>


    <?php if ($this->countModules('footer_top_1') || $this->countModules('footer_top_2') ||
                $this->countModules('footer_top_3') || $this->countModules('footer_top_4') ||
                    $this->countModules('footer_bottom_left') || $this->countModules('footer_bottom_right')): ?>
        <footer id="footer" class="dark">
            <div class="container">
                    <?php if ($this->countModules('footer_top_1 or footer_top_2 or footer_top_3 or footer_top_4')): ?>
                        <div class="row">
                            <div class="pre-footer clearfix">
                                <?php if ($this->countModules('footer_top_1')): ?>
                                    <div class="<?php echo $footer_top_1 ?> footer_top_1 pre-footer-col">
                                        <jdoc:include type="modules" name="footer_top_1" style="FooterModules"/>
                                    </div>
                                <?php endif; ?>

                                <?php if ($this->countModules('footer_top_2')): ?>
                                    <div class="<?php echo $footer_top_2 ?> footer_top_2 pre-footer-col">
                                        <jdoc:include type="modules" name="footer_top_2" style="FooterModules"/>
                                    </div>
                                <?php endif; ?>

                                <?php if ($this->countModules('footer_top_3')): ?>
                                    <div class="<?php echo $footer_top_3 ?> footer_top_3 pre-footer-col ">
                                        <jdoc:include type="modules" name="footer_top_3" style="FooterModules"/>
                                    </div>
                                <?php endif; ?>

                                <?php if ($this->countModules('footer_top_4')): ?>
                                    <div class="<?php echo $footer_top_4 ?> footer_top_4 pre-footer-col ">
                                        <jdoc:include type="modules" name="footer_top_4" style="FooterModules"/>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->countModules('footer_middle_1 or footer_middle_2')): ?>
                        <hr>
                        <div class="footer_middle">
                            <div class="row">

                                <?php if ($this->countModules('footer_middle_1')): ?>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <jdoc:include type="modules" name="footer_middle_1" style="FooterModules"/>
                                    </div>
                                <?php endif; ?>

                                <?php if ($this->countModules('footer_middle_2')): ?>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <jdoc:include type="modules" name="footer_middle_2" style="FooterModules"/>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endif; ?>
            </div>

            <?php if ($this->countModules('footer_bottom_right') || $this->countModules('footer_bottom_left')): ?>

                <?php
                $footer_bottom_left  = "col-xs-12 col-sm-8 col-md-8";
                $footer_bottom_right = "col-xs-12 col-sm-4 col-md-4";

                if ($this->countModules('footer_bottom_left') && !$this->countModules('footer_bottom_right')) {
                    $footer_bottom_left  = "col-md-12";
                    $footer_bottom_right = "";
                } else if (!$this->countModules('footer_bottom_left') && $this->countModules('footer_bottom_right')) {
                    $footer_bottom_left  = "";
                    $footer_bottom_right = "col-md-12";
                }
                ?>

                <?php if ($this->countModules('footer_bottom_right') || $this->countModules('footer_bottom_left')): ?>
                <div class="footer">
                    <div class="container">
                        <div class="row">
                            <?php if ($this->countModules('footer_bottom_left')): ?>
                                <div class="<?php echo $footer_bottom_left ?> footer_bottom_left footerVerticalCenter">
                                    <jdoc:include type="modules" name="footer_bottom_left" style="Styleh4"/>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->countModules('footer_bottom_right')): ?>
                                <div class="<?php echo $footer_bottom_right ?> footer_bottom_right text-right footerVerticalCenter">

                                    <jdoc:include type="modules" name="footer_bottom_right" style="Styleh4"/>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php endif; ?>

        </footer>

    <?php endif; ?>
</div>

<?php if ($this->countModules('static-position')): ?>
    <div class="static-position">
        <div class="text-center">
            <jdoc:include type="modules" name="static-position" style="Styleh4"/>
        </div>
    </div>
<?php endif; ?>


<input type="hidden" name="SERVERURI" id="SERVERURI" value="<?php echo JURI::root(); ?>"/>
<input type="hidden" name="ITEM" id="ITEM" value="<?php echo $item; ?>"/>
<input type="hidden" name="SITELANG" id="SITELANG" value="<?php echo $sef; ?>"/>
<!-- Include Canvas Scripts -->
<?php require_once JPATH_BASE . '/templates/' . $this->template . '/assets/canvas/include_scripts.php'; ?>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/custom.js"></script>
<!--END BASE SCRIPT-->


</body>
</html>