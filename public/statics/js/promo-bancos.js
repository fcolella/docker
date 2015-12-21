jQuery.fn.extend({
    scrollToMe: function () {
        var x = jQuery(this).offset().top - 100;
        jQuery('html,body').animate({scrollTop: x}, 400);
    }
});

$(document).ready(function(){
    if($('.banco_id').length > 0){
        $banco_id_sel = $('.banco_id').val();
        $('.banco-'+$banco_id_sel).first().scrollToMe();
    }
});
