jQuery( document).ready(function(){
    jQuery( document).on('mouseover', '.cobweb-login', function(){
        jQuery('.login-form-box').stop().slideDown(200);
    });

    jQuery( document).on('mouseleave', '.cobweb-login', function(){
        jQuery('.login-form-box').stop().slideUp(200);
    })
});