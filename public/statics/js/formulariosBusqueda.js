$(document).ready(function(){


    $('.reservar_btn').click(function(){

        $noDateLanding  = parseInt($(this).siblings('.noDateMode').val());
        $isListadoBox   = $('.hotelesListadoBox').length > 0;

        $checkAll   = false;
        if(($('#hotel-busqueda #noDateCheck').length > 0 && !$('#hotel-busqueda #noDateCheck').is(':checked'))||($('#hotel-busqueda #noDateCheck').length == 0))
            $checkAll = true;


        $url            = checkFormHoteles($checkAll, $noDateLanding);

        if($url)
            window.location = $url;

    });
});

function inicializarHabitaciones(){
	$('#hotel-busqueda .pasajeros_menores').change(function(){
		$parentDiv = $(this).parent().parent().parent();
		$numeroHabitacion = $parentDiv.find('.roomId').val();
		$nuevaCantidad = $(this).val();
		$viejaCantidad = $parentDiv.find('.menores-edad').size();

		if ( $nuevaCantidad > $viejaCantidad){
			for( $i = $viejaCantidad + 1; $i <= $nuevaCantidad; $i++){
				$child =  $('#hotel-busqueda .NuevoComboEdad').html();
				$parentDiv.find('.container_hijos .clonable').append( $child );
				$ultimoMenor = $parentDiv.find('.container_hijos .clonable .menores-edad:last');
				$ultimoMenor.find('.container_nombre').html('Edad niï¿½o ' + $i + ':' );
				$ultimoMenor.find('select.edad-menor').attr('name','habitaciones[' + $numeroHabitacion + '][menores][]');
			}
		}
		else if($viejaCantidad > $nuevaCantidad){
			$i = 1;
			$parentDiv.find('.menores-edad').each(function(){
				if ($i > $nuevaCantidad){
					$(this).remove();
				}
				$i++;
			});
		}
	});
}

function modifyDate( $dateString, $daysDifference ){
	if ($daysDifference == 0){
		return $dateString;
	}
	$dateSplitted 	= $dateString.split('/');
	$date 			= new Date( $dateSplitted[2], $dateSplitted[1]-1, $dateSplitted[0]  );
	$one_day=1000*60*60*24;
	$dateModified   = new Date( $date.getTime() + ($one_day*$daysDifference) );
	$day = $dateModified.getDate()
	if ( $day < 10 )
		$day = '0' + $day;
	$month = $dateModified.getMonth() + 1;
	if ( $month < 10 )
		$month = '0' + $month;
	$year = $dateModified.getFullYear();

	return $day + '/' + $month + '/' + $year;
}
function setNightsNumber(){



	if($(' #fecha_desde').val() != "" && $('#hotel-busqueda .fecha_hasta').val() != ""){
		$fechaDesdeString = $('#hotel-busqueda .fecha_desde').val();
		$fechaHastaString = $('#hotel-busqueda .fecha_hasta').val();

		$fechaDesdeSplitted = $fechaDesdeString.split('/');
		$fechaHastaSplitted = $fechaHastaString.split('/');
		$fechaDesde = new Date( $fechaDesdeSplitted[2], $fechaDesdeSplitted[1]-1, $fechaDesdeSplitted[0]  );
		$fechaHasta = new Date( $fechaHastaSplitted[2], $fechaHastaSplitted[1]-1, $fechaHastaSplitted[0]  );
		$one_day=1000*60*60*24;
		$days = Math.ceil( $fechaHasta.getTime() - $fechaDesde.getTime() ) / $one_day;
		if ($days < 2)
			$cantNochesHtml = $days + ' noche';
		else
			$cantNochesHtml = $days + ' noches';

		//alert($cantNochesHtml);

		$('#hotel-busqueda .cant-noches').html($cantNochesHtml);
	}
	else{
		$('#hotel-busqueda .cant-noches').html('');
	}
}
function checkFormHoteles($checkAll, $noDateLanding){

	$('#hotel-busqueda .formError').hide();
	$('#hotel-busqueda input').removeClass('errorBorder');


    $sinErrores = true;



    if($checkAll) {


        // from

        if ($('#hotel-busqueda .fecha_desde').val() == "") {
            $sinErrores = false;
            $('#hotel-busqueda .formError.fecha_desde_error').show();
            $('#hotel-busqueda .fecha_desde').addClass('errorBorder');
        }
        else
            $fecha_desde = $('#hotel-busqueda .fecha_desde').val().replace('/','-').replace('/','-');


        // to

        if ($('#hotel-busqueda .fecha_hasta').val() == "") {
            $sinErrores = false;
            $('#hotel-busqueda .formError.fecha_hasta_error').show();
            $('#hotel-busqueda .fecha_hasta').addClass('errorBorder');
        }
        else
            $fecha_hasta = $('#hotel-busqueda .fecha_hasta').val().replace('/','-').replace('/','-');



        // string paxs

        $stringOcupantes = "";
        $counter = 0;
        $('#hotel-busqueda .habitacion:visible').each(function(){
            $counter++;
            $stringOcupantes += $(this).find('.pasajeros_mayores').val();
            $(this).find('select.edad-menor').each(function(){
                $stringOcupantes += '-' + $(this).val();
            });
            if ( $('#hotel-busqueda .habitacion:visible').size() != $counter){
                $stringOcupantes += '_';
            }
        });



        // pax

        $('#hotel-busqueda .container_hijos select.edad-menor').each(function () {
            if ($(this).val() == '-') {
                $sinErrores = false;
                $(this).addClass('errorBorder');
                $(this).parent().find('.formError').show();

            }
        });
    }



    // destination

    if ($('#hotel-busqueda .origen').size() > 0 && ( $('#hotel-busqueda .origen').val() == "" || $('#hotel-busqueda .origen').val() == $('#hotel-busqueda .origen').attr('notValidValue') )) {
        $sinErrores = false;
        $('#hotel-busqueda .formError.origen_error').show();
        $('#hotel-busqueda .origen').addClass('errorBorder');
    }



    if ( $('#hotel-busqueda .destino').size() > 0 &&  ( $('#hotel-busqueda .destino').val() == "" || $('#hotel-busqueda .destino').val() == $('#hotel-busqueda .destino').attr('notValidValue') ) ){
        $sinErrores = false;
        $('#hotel-busqueda .formError.destino').show();
        $('#hotel-busqueda #destino').addClass('errorBorder');
    }






	if ($sinErrores){

        $url = "";

        if($checkAll) {

            if ($noDateLanding) {
                // no date detail landing form
                $codigo = $('#form-hoteles .CodigoCiudad').val();
                $urlDescriptiva = $('#form-hoteles .UrlDescriptiva').val();
                $codigoHotel = $('#form-hoteles .CodigoHotel').val();
                $codigoBroker = $('#form-hoteles .CodigoBroker').val();

                $url = '/hotel/' + $codigo + '/' + $fecha_desde + '/' + $fecha_hasta + '/' + $stringOcupantes + '/' + $codigoBroker + '/' + $codigoHotel + '/' + $urlDescriptiva + '/noDate';

            }
            else {
                $chosen_city = "";
                $ciudadTmp = $('#hotel-busqueda .origen').val();
                if ($ciudadTmp.indexOf('(') > -1) {

                    $chosen_city = $ciudadTmp;

                }
                else {
                    $ajax_url = '/hoteles-box/get-cities.php';
                    $.ajax({
                        url: $ajax_url,
                        data: {fecha_desde: $fecha_desde, fecha_hasta: $fecha_hasta, searchable_string: $ciudadTmp},
                        type: 'POST',
                        dataType: 'json',
                        async: false,
                        success: function ($data) {
                            $('#modal_ciudades li.city').remove();

                            if ($data.ciudades.length > 1) {
                                for ($i = 0; $i < $data.ciudades.length; $i++) {

                                    $ciudadTmp = $data.ciudades[$i].split(',');
                                    $ciudad = replaceAll($ciudadTmp[0], ' ', '+');
                                    $ciudadTmp2 = $ciudadTmp[1].split('(');
                                    $pais = $.trim($ciudadTmp2[0]);
                                    $pais = replaceAll($pais, ' ', '+');
                                    $codigo = $ciudadTmp2[1].substring(0, 3);


                                    $current_url = '/hoteles/busqueda/' + $codigo.toLowerCase() + '/' + $fecha_desde + '/' + $fecha_hasta + '/' + $stringOcupantes + '/' + 'hoteles-en-' + $ciudad + '-' + $pais;


                                    $('#modal_ciudades li.initial').clone().appendTo('#modal_ciudades ul');
                                    $('#modal_ciudades li:last a').html($data.ciudades[$i]);
                                    $('#modal_ciudades li:last a').attr('href', $current_url);
                                    $('#modal_ciudades li:last').removeClass('initial').addClass('city').show();
                                }
                                $.colorbox({href: "#modal_ciudades", inline: true, scrolling: false});

                            }
                            else {
                                if ($data.ciudades.length == 1) {
                                    $chosen_city = $data.ciudades[0];

                                }
                                else {
                                    $('input.origen').addClass('errorBorder');
                                    $('.no_city').show();
                                }
                            }
                        }
                    });
                }

                if ($chosen_city != "") {
                    $ciudadTmp = $chosen_city.split(',');
                    $ciudad = replaceAll($ciudadTmp[0], ' ', '+');
                    $ciudadTmp2 = $ciudadTmp[1].split('(');
                    $pais = $.trim($ciudadTmp2[0]);
                    $pais = replaceAll($pais, ' ', '+');
                    $codigo = $ciudadTmp2[1].substring(0, 3);

                    $url = '/hoteles/busqueda/' + $codigo.toLowerCase() + '/' + $fecha_desde + '/' + $fecha_hasta + '/' + $stringOcupantes + '/' + 'hoteles-en-' + $ciudad + '-' + $pais;

                }

            }

        }
        else{

            // redirect to noDate avail
            $destination        = $('#hotel-busqueda .origen').val();
            $destinationTmp     = $destination.split(',');
            $city               = replaceAll($destinationTmp[0], ' ', '+');
            $destinationTmp2    = $destinationTmp[1].split('(');
            $country            = $.trim($destinationTmp2[0]);
            $country            = replaceAll($country, ' ', '+');
            $destinationCode    = $destinationTmp2[1].substring(0,3);

            $url = '/hoteles/resultados/'+$destinationCode.toLowerCase()+'/hoteles-en-'+$city+'-'+$country;

        }


        if ($url != "")
            return $url;

	}
}


function initBordersActivity(){
	$('input').focus(function(){
		$(this).addClass('focusBorder');
	});
	$('input').blur(function(){
		$(this).removeClass('focusBorder');
	});
}


function setCeoInfo($oldValue, $newValue){

    var reg = new RegExp($oldValue,"gi");

    var title = $('title').text();
    var metas = $('meta[name="description"]').attr('content');
    var keyws = $('meta[name="keywords"]').attr('content');

    var nTitle = title.replace(reg, $newValue);
    var nMetas = metas.replace(reg, $newValue);
    var nKeyws = keyws.replace(reg, $newValue);

    $('title').text(nTitle);
    $('meta[name="description"]').attr('content', nMetas);
    $('meta[name="keywords"]').attr('content', nKeyws);
}
