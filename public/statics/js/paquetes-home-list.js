$(document).ready(function(){


    $.when(

        $.ajax({
            url: '/paquetes/ajax-home-list.php?tag=ofertas-paquetes',
            type: 'GET',
            dataType: 'json',
            success: function($data){

                $('.packages-list').find('.loading').remove();
                $('.packages-list h3').after($data.list);

            }
        }),


        $.ajax({
            url: '/paquetes/ajax-home-list.php?tag=origin-cities-arr',
            type: 'GET',
            dataType: 'json',
            success: function($data){

                $('#form-paquetes #origen').append($data.list)

            }
        }),


        $.ajax({
            url: '/paquetes/ajax-home-list.php?tag=escapadas',
            type: 'GET',
            dataType: 'json',
            success: function($data){

                if($data.resultsQty > 0) {
                    $('.cruises-list').find('.loading').remove();
                    $('.cruises-list h3').html('Escapadas<img align="right" style="margin-top: -4px;" src="img/mundo.png">');
                    $('.cruises-list h3').after($data.list);
                }
                else
                    getCruisesAjax();

            }
        })



    ).then(function(){

    });
});