/**
 * Created with JetBrains PhpStorm.
 * User: fcolella
 * Date: 5/1/16
 * Time: 9:20 AM
 * To change this template use File | Settings | File Templates.
 */

(function($){
    $.fn.addScrollup = function(options){
        var defaults = {
            scrollClass: 'scrollup',
            scrollImg: ''
        };
        options = $.extend(defaults, options);

        var scroll = '<div class="'+options.scrollClass+'"><img src="'+options.scrollImg+'" /></div>';

        $(window).scroll(function() {
            if($(this).scrollTop() >= 100){
                if(!$("body").find("."+options.scrollClass).length) $("body").append(scroll);
            }else{
                if($("body").find("."+options.scrollClass).length) $("body").find('.'+options.scrollClass).remove();
            }
        });

        $(document).on('click', '.'+options.scrollClass, function(){
            $('html, body').animate({ scrollTop: 0 }, 'slow');
        });
    };
}(jQuery));