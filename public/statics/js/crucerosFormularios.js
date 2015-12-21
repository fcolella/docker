$(document).ready(function(){
	inicializarPasajeros();
	$('#form-cruceros .submitButton').click(function(){
		checkFormCruceros();
	});
	
	//validacion
	$('#form-cruceros .selectdestino').change(function(){
		if ( $('#form-cruceros .selectdestino').val() != 0){
			$('#form-cruceros .formError.origen').hide();
			$('#form-cruceros .selectdestino').removeClass('errorBorder');
		}		
	});
});	

function checkFormCruceros(){

	$sinErrores = true;
	$('#form-cruceros .formError').hide();

	if ( $('#form-cruceros .selectdestino').val() == 0){
		$sinErrores = false;
		$('#form-cruceros .formError.origen').show();
		$('#form-cruceros .selectdestino').addClass('errorBorder');
	}
	$i = 0;
	$('#form-cruceros .container_hijos select.edad-menor').each(function(){
		if ( $(this).val() == '-'){
			$sinErrores = false;
            $(this).addClass('errorBorder');
			$(this).parent().find('.formError').show();
	
		}
	});

	if ($sinErrores){
	
		// id's
	
		$regionId			= $('#form-cruceros .selectdestino').val();
		$periodoId  		= $('#form-cruceros .selectPeriodo').val();
		$companiaId			= $('#form-cruceros .selectCompania').val();
		$cantidadAdultos 	= $('#form-cruceros .selectAdultos').val();
		$cantidadMenores 	= $('#form-cruceros .selectMenores').val();		
		
		// nombres
		
		$regionTmp 			= $('#form-cruceros .selectdestino option:selected').html();
		$regionTmp 			= $regionTmp.split('(');
		$regionName 		= $regionTmp[0];
		$regionName 		= $regionName.toLowerCase();
		$regionName			= $regionName.trim();
		$regionName			= replaceAll($regionName,' ','+');
		
		$periodoTmp			= $('#form-cruceros .selectPeriodo option:selected').html();
		$periodoName		= replaceAll($periodoTmp,' ','+');
		$periodoName		= $periodoName.toLowerCase();
		
		$url = '/cruceros/resultados'; 
		
		$description = '/cruceros-por-' + $regionName;
				
		if ($periodoId != 0){
			$url += '/periodo/' + $periodoId;
			$description += '-para-' + $periodoName;
		}
				
		if ($companiaId != 0){
			$url += '/compania/' + $companiaId;
			$description += '-de-' + $companiaId;
		}
				
		$edadesMenores = '';
		$('.container_hijos select.edad-menor').each(function(){
 			$edadesMenores += '-' + $(this).val();
		});
		
		$url += '/region/' + $regionId + '/ocupantes/' + $cantidadAdultos + $edadesMenores + $description;
		
		
		window.location = $url;		
	}
	
}
function inicializarPasajeros(){
	$('#form-cruceros .selectMenores').change(function(){
		$nuevaCantidad = $(this).val();
		$viejaCantidad = $('#form-cruceros .container_hijos .menores-edad').size();
		
		if ( $nuevaCantidad > $viejaCantidad){
			for( $i = $viejaCantidad + 1; $i <= $nuevaCantidad; $i++){
				$child =  $('#form-cruceros .NuevoComboEdad').html();
				$('#form-cruceros .container_hijos dl').append( $child );
                $ultimoMenor = $('#form-cruceros .container_hijos select.edad-menor:last');
                $ultimoMenor.attr('id','crucerosEdadMenor'+$i);
			}
		}
		else if($viejaCantidad > $nuevaCantidad){
			$i = 1;
			$('#form-cruceros .container_hijos .menores-edad ').each(function(){
				if ($i > $nuevaCantidad){
					$(this).remove();
				}
				$i++;
			});
		}
		$counter = 0;
		$('#form-cruceros .childLabelNumber').each(function(){
			$(this).html($counter);
			$counter++;
		});
		$.colorbox.resize();
		inicializarValidacionPasajeros();
	});
}
// Funcion agregar hijos
function agregarHijos(qty){
	$('#form-cruceros .menores-edad.hijo').remove();
	$('#form-cruceros .container_hijos').show();
	//$('#container_hijos').slideDown();
	
	for(i=0; i< qty; i++){
		$('#form-cruceros .menores-clonar li').clone().appendTo('#form-cruceros .clonable').addClass('hijo hijo'+i).show();
		$('.hijo'+i+' span').html('Edad ni&ntilde;o '+ (i + 1)+' <span class="red">*</span>');
	}
}

function inicializarValidacionPasajeros(){
	$('#form-cruceros .container_hijos select.edad-menor').change(function(){
		if ( $(this).val() != 0){
			$(this).parent().find('.formError').hide();
		}
	});
}

