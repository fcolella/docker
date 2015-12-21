
$(document).ready(function(){

    $('.ofertas_lista li').css('width', '95%');
    $('.PatchCodeNoResults').each(function(){
        alert('notShowingAlert');
    });
    $valor_fecha_desde = $('#hotel-busqueda .fecha_desde').val();
    $valor_fecha_hasta = $('#hotel-busqueda .fecha_hasta').val();


    setDatepickers('#hotel-busqueda');


    $('#hotel-busqueda .fecha_desde').val($valor_fecha_desde);
    $('#hotel-busqueda .fecha_hasta').val($valor_fecha_hasta);

    $url = '/ajax-getclient.php';
    $.post( $url, {}, function(){} );

    $('#hotel-busqueda .habitacion .hidden').hide();

    $( "#hotel-busqueda .fecha_desde" ).change(function(){

        if($('#hotel-busqueda .fecha_desde').val() != "" && $('#hotel-busqueda .fecha_hasta').val() != ""){
            $fechaDesdeString = $('.fecha_desde').val();
            $fechaHastaString = $('.fecha_hasta').val();
            $fechaDesdeSplitted = $fechaDesdeString.split('/');
            $fechaHastaSplitted = $fechaHastaString.split('/');
            $fechaDesde = new Date( $fechaDesdeSplitted[2], $fechaDesdeSplitted[1]-1, $fechaDesdeSplitted[0]  );
            $fechaHasta = new Date( $fechaHastaSplitted[2], $fechaHastaSplitted[1]-1, $fechaHastaSplitted[0]  );
            $one_day=1000*60*60*24;
            $days = Math.ceil( $fechaHasta.getTime() - $fechaDesde.getTime() ) / $one_day;
            if ( $days > 0){
                if ($days < 2){
                    $cantNochesHtml = $days + ' noche';
                }else{
                    $cantNochesHtml = $days + ' noches';
                }
                $('#hotel-busqueda .cant-noches').html($cantNochesHtml);

            }
        }
        else{
            $('#hotel-busqueda .cant-noches').html('');
        }
    });
    $( "#hotel-busqueda .fecha_hasta" ).change(function(){
        if($('#hotel-busqueda .fecha_desde').val() != "" && $('#hotel-busqueda .fecha_hasta').val() != ""){
            $fechaDesdeString = $('.fecha_desde').val();
            $fechaHastaString = $('.fecha_hasta').val();
            $fechaDesdeSplitted = $fechaDesdeString.split('/');
            $fechaHastaSplitted = $fechaHastaString.split('/');
            $fechaDesde = new Date( $fechaDesdeSplitted[2], $fechaDesdeSplitted[1]-1, $fechaDesdeSplitted[0]  );
            $fechaHasta = new Date( $fechaHastaSplitted[2], $fechaHastaSplitted[1]-1, $fechaHastaSplitted[0]  );
            $one_day=1000*60*60*24;
            $days = Math.ceil( $fechaHasta.getTime() - $fechaDesde.getTime() ) / $one_day;
            if ( $days > 0){
                if ($days < 2){
                    $cantNochesHtml = $days + ' noche';
                }else{
                    $cantNochesHtml = $days + ' noches';
                }
                $('#hotel-busqueda .cant-noches').html($cantNochesHtml);

            }
        }
        else{
            $('#hotel-busqueda .cant-noches').html('');
        }

    });
    $('#hotel-busqueda .origen').change(function(){
        $('.origen_value').val( $(this).val() );
    });
    $('#hotel-busqueda .origen').blur(function(){
        if ( $(this).val() == "" ){
            $(this).val( $(this).attr('fefaultValue') );
        }
    });
    $('#hotel-busqueda .origen').click(function(){
//		if ( $(this).val() == $(this).attr('fefaultValue') ){
        $(this).val( "" );
        $('.no_city').hide();
//		}
    });
    $('#hotel-busqueda .fecha_desde,#hotel-busqueda .fecha_hasta').change(function(){
        if ( $(this).val() != "" ){
            $(this).parent().find('.formError').hide();
            $(this).removeClass('errorBorder');
        }
    });
    $('#hotel-busqueda .origen').change(function(){
        if ( $(this).val() != "" && $(this).val() != $(this).attr('notValidValue') ){
            $('#hotel-busqueda .formError.origen').hide();
            $(this).removeClass('errorBorder');
        }
    });
    initBordersActivity();
    $("#hotel-busqueda .origen").autocomplete({
        source: ciudades_mas_buscadas, minLength: 3
    });
    initChildSelectHTL();


    $('.menu_miniaturas li').mouseover(function() {

        $(this).css('color', 'red');

        $(this).animate({
            backgroundColor:'#0793D2'

        }, 250, function() {

        });

     });

    $('.menu_miniaturas li').mouseleave(function(){

        $block =  $(this);


        $(this).animate({
            backgroundColor:'#FFFFFF'
        }, 100, function() {
            $block.css('color', '#0793d2');
        });

    });

    $homeHtl = $('#homeHtl').val();



    $('#banner-slide-hoteles').flexslider({
        animation: "slide",
        start: function(slider){
            $('body').removeClass('loading');
        }
    });

    $('#banner-slide-hoteles .flex-viewport').css('max-height', '356px');
    $('#banner-slide-hoteles').fadeIn();



    $('#noDateCheck').click(function(){
        if($(this).is(':checked')){
            $('.fecha_desde').attr('disabled',true);
            $('.fecha_hasta').attr('disabled',true);
            $('.select_habitaciones').attr('disabled',true);
            $('.habitacion .pasajeros_mayores').attr('disabled',true);
            $('.habitacion .pasajeros_menores').attr('disabled',true);
            $('.habitacion .edad-menor').attr('disabled',true);
        }
        else{
            $('.fecha_desde').removeAttr('disabled');
            $('.fecha_hasta').removeAttr('disabled');
            $('.select_habitaciones').removeAttr('disabled');
            $('.habitacion .pasajeros_mayores').removeAttr('disabled');
            $('.habitacion .pasajeros_menores').removeAttr('disabled');
            $('.habitacion .edad-menor').removeAttr('disabled');
        }
    });

    $(".jRating").jRating({isDisabled: true});

});




//
function initChildSelectHTL(){
    $('#hotel-busqueda .pasajeros_menores').change(function(){




        inicializarHabitaciones();
        $parentDiv = $(this).parents('.habitacion');
        $numeroHabitacion = $parentDiv.find('.roomId').val();
        $nuevaCantidadCHD = $(this).val();



        $viejaCantidadCHD = $parentDiv.find('.menores-edad').size();

        if ( $nuevaCantidadCHD > $viejaCantidadCHD){
            for( $j = $viejaCantidadCHD + 1; $j <= $nuevaCantidadCHD; $j++){
                $child =  $('#hotel-busqueda .NuevoComboEdad').html();
                $parentDiv.find('.container_hijos .clonable').append( $child );
                $ultimoMenor = $parentDiv.find('.container_hijos .clonable .menores-edad:last');
                $ultimoMenor.find('.container_nombre').html('Edad ni&ntilde;o ' + $j + ':' );
                $ultimoMenor.find('select.edad-menor').attr('name','habitaciones[' + $numeroHabitacion + '][menores][]');
                $ultimoMenor.find('select.edad-menor').attr('id','hotelesHabitacion'+$numeroHabitacion+'EdadMenor'+$j);
            }
        }
        else if($viejaCantidadCHD > $nuevaCantidadCHD){
            $j = 1;
            $parentDiv.find('.menores-edad').each(function(){
                if ($j > $nuevaCantidadCHD){
                    $(this).remove();
                }
                $j++;
            });
        }


    });

}

function setNightsNumber(){

    if($('#hotel-busqueda .fecha_desde').val() != "" && $('#hotel-busqueda .fecha_hasta').val() != ""){
        $fechaDesdeString = $('.fecha_desde').val();
        $fechaHastaString = $('.fecha_hasta').val();
        $fechaDesdeSplitted = $fechaDesdeString.split('/');
        $fechaHastaSplitted = $fechaHastaString.split('/');
        $fechaDesde = new Date( $fechaDesdeSplitted[2], $fechaDesdeSplitted[1]-1, $fechaDesdeSplitted[0]  );
        $fechaHasta = new Date( $fechaHastaSplitted[2], $fechaHastaSplitted[1]-1, $fechaHastaSplitted[0]  );
        $one_day=1000*60*60*24;
        $days = Math.ceil( $fechaHasta.getTime() - $fechaDesde.getTime() ) / $one_day;
        if ( $days > 0){
            if ($days < 2){
                $cantNochesHtml = $days + ' noche';
            }else{
                $cantNochesHtml = $days + ' noches';
            }
            $('#hotel-busqueda .cant-noches').html($cantNochesHtml);

        }
    }
    else{
        $('#hotel-busqueda .cant-noches').html('');
    }
};


$('#hotel-busqueda .select_habitaciones').change(function(){

    $nuevaCantidadHTL = $(this).val();
    $viejaCantidadHTL = $('#hotel-busqueda .habitacion').size() -1;
    if ( $nuevaCantidadHTL > $viejaCantidadHTL){

        for( $e = $viejaCantidadHTL + 1; $e <= $nuevaCantidadHTL; $e++){
            $('#hotel-busqueda .habitacion.hidden').clone().insertAfter('#hotel-busqueda .habitacion:last');
            $('#hotel-busqueda .habitacion:last').removeClass('hidden').show();
            $('#hotel-busqueda .habitacion:last .roomNumber').html('Hab. ' + $e + ':');
            $('#hotel-busqueda .habitacion:last .roomId').val($e);
            $('#hotel-busqueda .habitacion:last .menores-edad').hide();
            $('#hotel-busqueda .habitacion:last .pasajeros_mayores').attr('name','habitaciones['+$e+'][adultos]');
            $('#hotel-busqueda .habitacion:last .pasajeros_mayores').attr('id','hotelesHabitacion'+$e+'Adultos');
            $('#hotel-busqueda .habitacion:last .pasajeros_menores').attr('id','hotelesHabitacion'+$e+'Menores');
        }
    }
    else if($viejaCantidadHTL > $nuevaCantidadHTL){
        $e = 0;
        $('#hotel-busqueda .habitacion').each(function(){
            if ($e > $nuevaCantidadHTL){
                $(this).remove();
            }
            $e++;
        });
    }
    initChildSelectHTL();
});



function modifyDate( $dateString, $daysDifference ){
    if ($daysDifference == 0){
        return $dateString;
    }
    $dateSplitted 	= $dateString.split('/');
    $date 			= new Date( $dateSplitted[2], $dateSplitted[1]-1, $dateSplitted[0]  );
    $one_day		= 1000*60*60*24;
    $dateModified   = new Date( $date.getTime() + ($one_day*$daysDifference) );
    $day = $dateModified.getDate();
    if ( $day < 10 )
        $day = '0' + $day;
    $month = $dateModified.getMonth() + 1;
    if ( $month < 10 )
        $month = '0' + $month;
    $year = $dateModified.getFullYear();
    return $day + '/' + $month + '/' + $year;
}

