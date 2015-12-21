function inicializarHabitaciones(){
	$('#form-aereos .pasajeros_menores').change(function(){
		$parentDiv = $(this).parent().parent().parent();
		$numeroHabitacion = $parentDiv.find('.roomId').val();
		$nuevaCantidad = $(this).val();
		$viejaCantidad = $parentDiv.find('.menores-edad').size();
		if ( $nuevaCantidad > $viejaCantidad){
			for( $i = $viejaCantidad + 1; $i <= $nuevaCantidad; $i++){
				$child =  $('#form-aereos .NuevoComboEdad').html();
				$parentDiv.find('.container_hijos .clonable').append( $child );
				$ultimoMenor = $parentDiv.find('.container_hijos .clonable .menores-edad:last');
				$ultimoMenor.find('.container_nombre').html('Edad niño ' + $i + ':' );
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
	$('#form-aereos .select_habitaciones').change(function(){
		$nuevaCantidad = $(this).val();
		$viejaCantidad = $('.habitacion').size() - 1;
		if ( $nuevaCantidad > $viejaCantidad){
			for( $i = $viejaCantidad + 1; $i <= $nuevaCantidad; $i++){
				$('#form-aereos .habitacion.hidden').clone().insertAfter('.habitacion:last');
				$('#form-aereos .habitacion:last').removeClass('hidden').show();
				$('#form-aereos .habitacion:last .roomNumber').html('Hab. ' + $i + ':');
				$('#form-aereos .habitacion:last .roomId').val($i);
				$('#form-aereos .habitacion:last .menores-edad').hide();
				$('#form-aereos .habitacion:last .pasajeros_mayores').attr('name','habitaciones['+$i+'][adultos]');
			}
		}
		else if($viejaCantidad > $nuevaCantidad){
			$i = 0;
			$('#form-aereos .habitacion').each(function(){
				if ($i > $nuevaCantidad){
					$(this).remove();
				}
				$i++;
			});
		}
		inicializarHabitaciones();
	});
}
// Funcion agregar hijos
function agregarHijos(qty){
	$('#form-aereos .menores-edad.hijo').remove();
	$('#form-aereos .container_hijos').show();
	//$('#container_hijos').slideDown();
	
	for(i=0; i< qty; i++){
		$('#form-aereos .menores-clonar li').clone().appendTo('#form-aereos .clonable').addClass('hijo hijo'+i).show();
		$('#form-aereos .hijo'+i+' span').html('Edad niño '+ (i + 1)+' <span class="red">*</span>');
	}
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

	
	
	if($('#form-aereos #fecha_desde').val() != "" && $('#form-aereos .fecha_hasta').val() != ""){
		$fechaDesdeString = $('#form-aereos .fecha_desde').val();
		$fechaHastaString = $('#form-aereos .fecha_hasta').val();
		
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
		$('#form-aereos .cant-noches').html($cantNochesHtml);
	}
	else{
		$('#form-aereos .cant-noches').html('');
	}
}
function checkForm($noDate){
	
	$('#form-aereos .formError').hide();
	$('#form-aereos input').removeClass('errorBorder');
	$sinErrores = true;
	if ( $('#form-aereos .fecha_desde').val() == "" ){
		$sinErrores = false;
		$('#form-aereos .formError.fecha_desde_error').show();
		$('#form-aereos .fecha_desde').addClass('errorBorder');
	}
	if ( $('#form-aereos .fecha_hasta').val() == "" ){
		$sinErrores = false;
		$('#form-aereos .formError.fecha_hasta_error').show();
		$('#form-aereos .fecha_hasta').addClass('errorBorder');
	}
	else{
		if ( $('#fecha_desde').val() != ""){
			$fechaDesde = $('#form-aereos .fecha_desde').val();
			$dateSplitted 	= $fechaDesde.split('/');
			$dateFrom 		= new Date( $dateSplitted[2], $dateSplitted[1]-1, $dateSplitted[0]  );
			
			$fechaHasta = $('#form-aereos .fecha_hasta').val();
			$dateSplitted 	= $fechaHasta.split('/');
			$dateTo 		= new Date( $dateSplitted[2], $dateSplitted[1]-1, $dateSplitted[0]  );
			
			if ($dateFrom >= $dateTo){
				$sinErrores = false;
				$('#form-aereos .formError.fecha_hasta_incongruencia').show();
				$('#form-aereos .fecha_hasta').addClass('errorBorder');				
			}
		}		
	}
	if ( $('#form-aereos .origen').size() > 0 &&  ( $('#form-aereos .origen').val() == "" || $('#form-aereos .origen').val() == $('#form-aereos .origen').attr('notValidValue') ) ){
		$sinErrores = false;
		$('#form-aereos .formError.origen_error').show();
		$('#form-aereos .origen').addClass('errorBorder');
	}
	if ( $('#form-aereos .destino').size() > 0 &&  ( $('#form-aereos .destino').val() == "" || $('#form-aereos .destino').val() == $('#form-aereos .destino').attr('notValidValue') ) ){
		$sinErrores = false;
		$('#form-aereos .formError.destino').show();
		$('#form-aereos #destino').addClass('errorBorder');
	}
	$('#form-aereos .container_hijos select.edad-menor').each(function(){
		if ( $(this).val() == '-'){
			$sinErrores = false;
			$(this).parent().find('.formError').show();
	
		}
	});
	if ($sinErrores){
		$fecha_desde	= $('#form-aereos .fecha_desde').val().replace('/','-').replace('/','-');
		$fecha_hasta	= $('#form-aereos .fecha_hasta').val().replace('/','-').replace('/','-');
		
		$stringOcupantes = "";
		$counter = 0;
		$('#form-aereos .habitacion:visible').each(function(){
			$counter++;
			$stringOcupantes += $(this).find('.pasajeros_mayores').val();
			$(this).find('select.edad-menor').each(function(){
				$stringOcupantes += '-' + $(this).val();
			});
			if ( $('#form-aereos .habitacion:visible').size() != $counter){
				$stringOcupantes += '_';					
			}
		});
		
		if($noDate){
			$ciudad 		= $('#form-aereos .NombreCiudad').val();
			$codigo 		= $('#form-aereos .CodigoCiudad').val();
			$pais 			= $('#form-aereos .NombrePais').val();
			$nombreHotel	= $('#form-aereos .NombreHotel').val();
			$codigoHotel 	= $('#form-aereos .CodigoHotel').val();
			
			$url = '/hotel/' + $codigo.toLowerCase() + '/' + $ciudad + '/' + $pais + '/' + $fecha_desde + '/' + $fecha_hasta + '/' + $stringOcupantes + '/' + $nombreHotel + '/' + $codigoHotel + '/noDate';
		}
		else
		{
			$ciudadTmp 		= $('#form-aereos .origen').val();
			$ciudadTmp  	= $ciudadTmp.split(',');
			$ciudad  		= $ciudadTmp[0].replace(' ','-');
			$ciudadTmp2 	= $ciudadTmp[1].split('(');
			$pais 			= $.trim($ciudadTmp2[0]);
			$pais			= $pais.replace(' ','-');
			$codigo			= $ciudadTmp2[1].substring(0,3);

			$url = '/resultados-hoteles/' + $codigo.toLowerCase() + '/' + $ciudad.toLowerCase() + '/' + $pais + '/' + $fecha_desde + '/' + $fecha_hasta + '/' + $stringOcupantes;
		}
		
		//alert($url);
		window.location = $url;
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
