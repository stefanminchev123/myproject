<div class="header-wrapper" id="primary-menu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 right-box">
                <div class="right-box-wrapper">
                    <div class="primary">
                        <div class="navbar navbar-default">
                            <button type="button" class="navbar-toggle btn-navbar collapsed" data-toggle="collapse" data-target=".primary .navbar-collapse">
                                <span class="text"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <nav class="collapse collapsing navbar-collapse">
                                <?php
                                    // Primary navigation menu.
                                    wp_nav_menu( array(
                                        'theme_location'  => 'primary',
                                        'container'       => false,
                                        'menu_class'      => 'nav navbar-nav navbar-center',
                                    ) );
                                ?>
                            </nav>
                        </div><!-- /.navbar -->
                    </div>
                </div><!-- /.right-box-wrapper -->
            </div>
        </div>
    </div>
</div><!-- /.header-wrapper -->