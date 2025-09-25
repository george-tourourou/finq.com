(function ($) {

  var undef;
  if (jQuery.browser == undef) {

        // message = [];
        // message.push("WARNING: you appear to be using a newer version of jquery which does not support the $.browser variable.");
        // message.push("The jQuery iframe auto height plugin relies heavly on the $.browser features.");
        // message.push("Install jquery-browser: https://raw.github.com/jquery/jquery-browser/master/src/jquery.browser.js");
        // alert(message.join("n"));
        // return jQuery;


    jQuery.browser = {};
    (function () {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
            jQuery.browser.msie = true;
            jQuery.browser.version = RegExp.$1;
        }
    })();
  }

  Drupal.behaviors.BioticMenu = {
    attach: function(context, settings) {

    $("nav ul.tb-menu li").each(function() {
        var $this = jQuery(this),
            $win = jQuery(window);

        if ($this.offset().left + 250 > $win.width() + $win.scrollLeft() - $this.width()) {
            $this.addClass("nav-shift");
        }

    });


    if ($.browser.msie && $.browser.version.substr(0,1)<7) {
      $('li').has('ul').mouseover(function(){
          $(this).children('ul').css('visibility','visible');
          }).mouseout(function(){
          $(this).children('ul').css('visibility','hidden');
          })
    }


    }
  };

})(jQuery);