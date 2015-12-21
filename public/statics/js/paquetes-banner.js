$(document).ready(function(){

    var fromURL = document.URL;

    $url = '/paquetes/ajax-banner.php';

    $isLarge = (fromURL.indexOf('/paquetes/') == -1) ? 0 : 1;

    $maxWidth = (fromURL.indexOf('/paquetes/') == -1) ? 580 : 680;

    $.ajax({
        url: $url,
        data: 'isLarge='+$isLarge,
        type: 'GET',
        dataType: 'json',
        success: function($data){

            $('.loaderPkg').find('img').parent().remove();
            $('.loaderPkg').html($data.banner);

            $('#paquetes-slider').bjqs({
                animtype      : 'fade',
                height        : 140,
                width         : $maxWidth,
                responsive    : true,
                randomstart   : true,
                showmarkers     : false,
                centermarkers   : true,
                centercontrols  : true,
                showcontrols    : true,  // enable/disable next + previous UI elements
                animspeed       : 6000

            });
        }
    });



});
