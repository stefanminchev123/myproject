/*cobweb modifications*/

jQuery(document).ready(function() {

    (function() {
        jQuery( window ).scroll(function() {
            var top = jQuery(window).scrollTop();
            if(top > 0){
                jQuery('.logo_slogan').hide();
                jQuery('.logo_text').css({
                    'color'         : '#333',
                    'padding-top'   : 10
                });
            } else {
                jQuery('.logo_slogan').show();
                jQuery('.logo_text').css({
                    'color'         : 'rgba(255, 255, 255, 0.8)',
                    'padding-top'   : 15
                });

            }
        });
    })();

    //Mobile menu

    jQuery('body').on('click', '#offcanvas-toggler', function(){
        jQuery('.offcanvas-menu').addClass('ltr');

        jQuery('.offcanvas-menu').animate({left: 0}, 400);

        jQuery('body').addClass('offcanvas');
        jQuery(this).removeClass('visible-xs');
        jQuery(this).hide();
    });

    jQuery('body').on('click', '.close-offcanvas', function(){
        jQuery('.offcanvas-menu').removeClass('ltr');

        jQuery('.offcanvas-menu').animate({left: '-300px'}, 400);

        jQuery('body').removeClass('offcanvas');
        jQuery('#offcanvas-toggler').show();
    });

    if(jQuery('.VMmenu li ul').hasClass('menu')){
        jQuery('.VMmenu li ul.menu').parent().addClass('sub-menu');
    }

    if(jQuery('.VMmenu li .menu li ul').hasClass('submenu-level-3')){
        jQuery('.VMmenu li ul.menu .submenu-level-3').parent().addClass('sub-menu-3-link');
    }

    jQuery('body').on('click', '.sub-menu > div', function(){
        jQuery(this).addClass('close-sub-menu');
        jQuery(this).parent().find('.menu').slideDown('fast');
    });

    jQuery('body').on('click', '.close-sub-menu', function(){
        jQuery('.sub-menu').find('.menu').slideUp('fast');
        jQuery(this).removeClass('close-sub-menu');
    });

    jQuery('body').on('click', '.sub-menu-3-link > div', function(){
        jQuery(this).addClass('close-sub-menu-3');
        jQuery(this).parent().find('.submenu-level-3').slideDown('fast');
    });

    jQuery('body').on('click', '.close-sub-menu-3', function(){
        jQuery('.sub-menu-3-link').find('.submenu-level-3').slideUp('fast');
        jQuery(this).removeClass('close-sub-menu-3');
    });

    // Product add to cart button

    jQuery('body').on('mouseover', '#col-grid .vm-product-media-container', function(){
        jQuery(this).find('.addtocart-area-custom').stop().animate({bottom: '6px'}, 200);
    });

    jQuery('body').on('mouseleave', '#col-grid .vm-product-media-container', function(){
        jQuery(this).find('.addtocart-area-custom').stop().animate({bottom: '-44px'}, 200);
    });


    // INVOICE

    jQuery('#wantinvoice_field').parent().parent().addClass('invoice_');
    var invoiceElements = jQuery('.invoice_').nextAll("*:lt(5)").css('display', 'none');

    var company = jQuery('#invoice_company_field').val();
    var address = jQuery('#invoice_address_field').val();
    var mol = jQuery('#invoice_mol_field').val();
    var eik = jQuery('#invoice_eik_field').val();
    var dds = jQuery('#invoice_dds_field').val();


    if(company || address || mol || eik || dds){
        jQuery(invoiceElements).show();
    }else{
        jQuery('#wantinvoice_field').prop('checked', '');
    }

    jQuery('body').on('change', '#wantinvoice_field', function(){

        if(jQuery(this).prop('checked')){
            jQuery(invoiceElements).slideDown();
        }else{
            jQuery(invoiceElements).slideUp();
        }

    });

    // Clear chronoform input's
    jQuery('body').on('click', '.gbs3 .button', function(){
        jQuery('#chronoform-message').html('');
    });

    var productDetailsRightContent = jQuery('#right_content').html();
    jQuery('#right_content').remove();
    if (productDetailsRightContent) {
        jQuery('#set_right_content').html(productDetailsRightContent);
    }
});