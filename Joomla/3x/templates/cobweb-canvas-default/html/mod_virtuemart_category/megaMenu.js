jQuery( document).ready(function(){
    var windowWidth = jQuery(window).width();

    jQuery(this).find('#submenu-block-top').hide();

    if(windowWidth > 1024){

        jQuery('body').on('mouseover', '#main-menu-drop-top .VMmenu li', function(){
            jQuery(this).addClass('active');

            var subMenu = jQuery(this).find('#submenu-block-top ul').hasClass('menu-top');
            if(subMenu){
                jQuery(this).find('.menu-icon').addClass('icon-down');
                jQuery(this).find('.menu-top').show();
                jQuery(this).find('#submenu-block-top').stop().slideDown('fast');
            }
        });

        jQuery('body').on('mouseleave', '#main-menu-drop-top .VMmenu li', function(){
            jQuery(this).find('#submenu-block-top').stop().slideUp('fast');
            jQuery(this).removeClass('active');
        });

    }


    jQuery('.menu-top li').on('mouseover', function(){
        jQuery('.image-show-hide').hide();
    });

    jQuery('.menu-top li').on('mouseleave', function(){
        jQuery('.image-show-hide').show();
    });
});