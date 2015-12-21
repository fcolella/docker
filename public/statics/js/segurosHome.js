
$(document).ready(function(){
	

	$('tr:even').css('background-color', '#D7D9DD');
	
	 
	 $('#form-seguros .required').change(function(){
		 $(this).removeClass('error');
		 $(this).parent().find('.msje-error').hide();
		 
	 })
	
	$valor_fecha_desde = $('#form-seguros .fecha_desde').val();
	$valor_fecha_hasta = $('#form-seguros .fecha_hasta').val();


    setDatepickers('#form-seguros');

	
	$('#form-seguros .fecha_desde').val($valor_fecha_desde);
	$('#form-seguros .fecha_hasta').val($valor_fecha_hasta);
	
	$( "#form-seguros .fecha_desde" ).change(function(){
        if($(this).val() != '')
            $( "#form-seguros .fecha_hasta" ).datepicker( "option", "minDate", $(this).val());



		if($('#form-seguros .fecha_desde').val() != "" && $('#form-seguros .fecha_hasta').val() != ""){
			$fechaDesdeString = $('#form-seguros .fecha_desde').val();
			$fechaHastaString = $('#form-seguros .fecha_hasta').val();
			$fechaDesdeSplitted = $fechaDesdeString.split('/');
			$fechaHastaSplitted = $fechaHastaString.split('/');
			$fechaDesde = new Date( $fechaDesdeSplitted[2], $fechaDesdeSplitted[1], $fechaDesdeSplitted[0]  );
			$fechaHasta = new Date( $fechaHastaSplitted[2], $fechaHastaSplitted[1], $fechaHastaSplitted[0]  );
			$one_day=1000*60*60*24;
			$days = Math.ceil( $fechaHasta.getTime() - $fechaDesde.getTime() ) / $one_day;
			$days = $days + 1;
			if ( $days > 0){
				if ($days < 2){
					$cantNochesHtml = $days + ' d&iacute;a';
				}else{
					$cantNochesHtml = $days + ' d&iacute;as';
				}
				$('#form-seguros .cant-noches').html($cantNochesHtml);
				
			}
		}
		else{
			$('#form-seguros .cant-noches').html('');
		}
	});	
	$( "#form-seguros .fecha_hasta" ).change(function(){
		if($('#form-seguros .fecha_desde').val() != "" && $('#form-seguros .fecha_hasta').val() != ""){
			$fechaDesdeString = $('#form-seguros .fecha_desde').val();
			$fechaHastaString = $('#form-seguros .fecha_hasta').val();
			$fechaDesdeSplitted = $fechaDesdeString.split('/');
			$fechaHastaSplitted = $fechaHastaString.split('/');
			$fechaDesde = new Date( $fechaDesdeSplitted[2], $fechaDesdeSplitted[1], $fechaDesdeSplitted[0]  );
			$fechaHasta = new Date( $fechaHastaSplitted[2], $fechaHastaSplitted[1], $fechaHastaSplitted[0]  );
			$one_day=1000*60*60*24;
			$days = Math.ceil( $fechaHasta.getTime() - $fechaDesde.getTime() ) / $one_day;
			$days = $days + 1;
			if ( $days > 0){
				if ($days < 2){
					$cantNochesHtml = $days + ' d&iacute;a';
				}else{
					$cantNochesHtml = $days + ' d&iacute;as';
				}
				$('#form-seguros .cant-noches').html($cantNochesHtml);
			
			}
		}
		else{
			$('#form-seguros .cant-noches').html('');
		}
		
	});

    initDesactivable();
	
});


$('#form-seguros .selectDestino').change(function(){
	
	$(this).removeClass('errorBorder');
	$('#form-seguros .destino_error').hide();
	
});

$('#form-seguros .fecha_desde').change(function(){
	
	$(this).removeClass('errorBorder');
	$('#form-seguros .fecha_desde_error').hide();
	
});

$('#form-seguros .fecha_hasta').change(function(){
	
	$(this).removeClass('errorBorder');
	$('#form-seguros .fecha_hasta_error').hide();
	
});



$('#form-seguros .qpax').change(function(){
	$(this).removeClass('error');
	$('#form-seguros .qpax_error').hide();
	$('#form-seguros .edades_error').hide();
	
	$nuevaCantidad = $(this).val();
	$viejaCantidad = $('#form-seguros .selectEdades').size() - 1;
	
	
	if ( $nuevaCantidad > $viejaCantidad){
		for( $i = $viejaCantidad + 1; $i <= $nuevaCantidad; $i++){
			$('#form-seguros .Edades.hidden').clone().insertAfter('#form-seguros .Edades:last');
			$('#form-seguros .Edades:last').removeClass('hidden').show();
			$('#form-seguros .Edades:last').addClass('margen');
			$('#form-seguros .Edades:last .selectEdades').addClass('real');
			$('#form-seguros .Edades:last .selectEdades').attr('name', 'pax['+$i+']');
            $('#form-seguros .Edades:last .selectEdades').attr('id', 'segurosEdadPax'+$i);
			$('#form-seguros .Edades:last .labelPax').text('Edad Pax '+$i);
			
		}
	}
	else 
		if($viejaCantidad > $nuevaCantidad){
			$i = 0;
			$('#form-seguros .selectEdades').each(function(){
				if ($i > $nuevaCantidad){
					$(this).parent().remove();
				}
				$i++;
			});
		}
});

function checkFormSeguros(){
	
	$sinError = true;
	$('#form-seguros .formError').hide();
	
	$destino 	 = $('#form-seguros .selectDestino').val();
	if($destino == 'null'){
		$sinError = false;
		$('#form-seguros .destino_error').show();
		$('#form-seguros .selectDestino').addClass('errorBorder');
	}
	
	$fecha_desde = $('#form-seguros .fecha_desde').val();
	if($fecha_desde == ''){
		$sinError = false;
		$('#form-seguros .fecha_desde_error').show();
		$('#form-seguros .fecha_desde').addClass('errorBorder');
	}
			
	$fecha_hasta = $('#form-seguros .fecha_hasta').val();
	if($fecha_hasta == ''){
		$sinError = false;
		$('#form-seguros .fecha_hasta_error').show();
		$('#form-seguros .fecha_hasta').addClass('errorBorder');
	}
	
	$qPax 		 = $('#form-seguros .qpax').val();
	if($qPax  <= 0){
		$sinError = false;
		$('#form-seguros .qpax_error').show();
		$('#form-seguros .qpax').addClass('errorBorder');
	}else{
		$('#form-seguros .selectEdades.real').each(function(){
			$i = 0;
			if($(this).val() == '-'){
				$sinError = false;
				$(this).addClass('errorBorder');
				$('#form-seguros .edades_error').show();
				$i++;
			}else{
				$(this).removeClass('errorBorder');
				$i--;
			}
			if($i <= 0){
				
				$('#form-seguros .edades_error').hide();
			}
			
			
		});
		
	}	
	
	if($sinError == true){
		$ages_string = '';
		$i=1;
		$('#form-seguros .Edades').each(function(){
			if(!$(this).hasClass('hidden')){
				$age = $(this).find('.selectEdades').val();
				$ages_string += '&pax['+$i+']='+$age;
				$i++;
			}
		});
		
		$url = '/seguros/listado.php?origen=BUE&destino='+$destino+'&fecha_desde='+$fecha_desde+'&fecha_hasta='+$fecha_hasta+'&Qpax='+$qPax+$ages_string;
		window.location=$url;
	}
}
