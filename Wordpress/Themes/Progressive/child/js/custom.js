var CobwebModule = function( $, window, document, undefined ) {
    'use strict';

    /**
     * Global private vars
     */
    var _post_type = 'article',
        _animation = 'fadeInUp';

    /**
     * Initialize Twitter Bootstrap Dropdowns
     *
     * @docs http://getbootstrap.com/javascript/#dropdowns
     */
    function initDropdowns() {
        $( '.dropdown-toggle' ).dropdown();
    };

    /**
     * Initialize Fancybox Modals
     *
     * @docs http://fancybox.net/api
     */
    function initFancyboxElements() {
        if ( $.fn.fancybox ) {
            $( '.fancybox' ).fancybox({
                nextEffect: 'fade',
                prevEffect: 'fade',
                openEffect: 'fade',
                closeEffect: 'fade'
            });
        };
    };

    function helperFn( params ) {
        console.log( params );
    };

    return {
        // Public method for theme init
        init: function() {
            initDropdowns();
            initFancyboxElements();
        },

        // Expose public helper methods
        helperFn: helperFn
    }
}( jQuery, window, document );

