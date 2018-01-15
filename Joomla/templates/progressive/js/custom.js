/*cobweb modifications*/
jQuery(document).ready(function($) {
      
    var parent, child, scrollWidth, bodyWidth;
  
    //Animations Progressive
    function animations() {
      $('[data-appear-animation]').each(function() {
            var $this = $( this );
            if(!$('body').hasClass('no-csstransitions') && ($('body').width() + scrollWidth) > 767) {
                $this.appear(function() {
                    var delay = ($this.data('appearAnimationDelay') ? $this.data('appearAnimationDelay') : 1);

                    if(delay > 1) $this.css('animation-delay', delay + 'ms');

                    $this.addClass('animated').addClass($this.data('appearAnimation'));
                });
            }
        });
    }


});


