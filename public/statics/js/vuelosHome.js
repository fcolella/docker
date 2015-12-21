$(document).ready(function(){
//	$url = 'ajax-getclient.php';
//	$.post( $url, {}, function(){} );



    $homeVuelos = $('#homeVuelos').val();

    if($homeVuelos == 1){

        $miancho = $( window ).width();

        if($miancho <= 1024){

            $('.img-paquete img').css('height', '258px');
            $('.img-paquete img').css('max-width', '460px');


        }


        $('#vuelosDestino').click(function(){

            $(this).val('');

        })
      


        $('#banner-slide-vuelos').flexslider({
            animation: "slide",
            start: function(slider){
                $('body').removeClass('loading');
            }
        });

        $('#banner-slide-vuelos .flex-viewport').css('max-height', '387px');


        $('#bancos-slide').bjqs({
            animtype      : 'slide',
            height        : 88,
            width         : 350,
            responsive    : true,
            randomstart   : true,
            showmarkers     : false,
            centermarkers   : false,
            showcontrols    : false,  // enable/disable next + previous UI elements
            animspeed       : 4500

        });

        $muestra3 = $('.muestra3').width();

        $('#paquetes-slider').bjqs({
            animtype      : 'fade',
            height        : 140,
            width         : $muestra3,
            responsive    : true,
            randomstart   : true,
            showmarkers     : false,
            centermarkers   : true,
            centercontrols  : true,
            showcontrols    : true,  // enable/disable next + previous UI elements
            animspeed       : 6000,

        });

        $('.img-paquete img').css('width', '569px');

        $(".suscripcion").click(function(){
            $val=$("#mail_newsletter").val();
            $url="/newsletter-mensajes.php?accion=suscribir&email="+$val;
            $.colorbox({href:$url,iframe:true,width:"368px",height:"250px"})
        });

        $(".unsuscripcion").colorbox({iframe:true,width:"368px",height:"250px"});


        $('.hidden').fadeIn();

    }


    setDatepickers('#form-aereos');


	$( "#form-aereos input.fecha_desde" ).change(function(){
		$fechaDesdeMasUno = modifyDate( $('#form-aereos input.fecha_desde').val(), 0 );
		$( "#form-aereos input.fecha_hasta" ).datepicker( "option", "minDate", $fechaDesdeMasUno);
		setNightsNumber();
		if ( $(this).val() != "" ){
			$(this).parent().find('.formError').hide();
			$(this).removeClass('errorBorder');
		}
	});	
	$( "#form-aereos input.fecha_hasta" ).change(function(){
		
		setNightsNumber();
		if ( $(this).val() != "" ){
			$(this).parent().find('.formError').hide();
			$(this).removeClass('errorBorder');
		}
	});	
	
	$('#form-aereos .origen').blur(function(){
		if ( $(this).val() == "" ){
			$(this).val( $(this).attr('fefaultValue') );
		}
	});
	$('#form-aereos .origen').click(function(){
		
		if ( $(this).val() == $(this).attr('fefaultValue') || $(this).val() == 'Buenos Aires, Argentina (BUE)' ){
			$(this).val( "" );

		}
	});
	$('#form-aereos .destino').blur(function(){
		if ( $(this).val() == "" ){
			$(this).val( $(this).attr('fefaultValue') );
		}
	});
	$('#form-aereos .destino').click(function(){
		if ( $(this).val() == $(this).attr('fefaultValue') ){
			$(this).val( "" );
		}
	});
	
	$('#form-aereos .origen').change(function(){
		if ( $(this).val() != "" && $(this).val() != $(this).attr('notValidValue') ){
			$('.formError.origen').hide();
			$(this).removeClass('errorBorder');
		}
	});
	$('#form-aereos .destino').change(function(){
		if ( $(this).val() != "" && $(this).val() != $(this).attr('notValidValue') ){
			$('.formError.destino').hide();
			$(this).removeClass('errorBorder');
		}
	});	

	$('#form-aereos .selectAdultos').change(function(){
		if ( allAgeRangesSelected() ){
			noMoreBabiesThanAdults();
		}
		adaptChildrenQty();
	});
	initBordersActivity();
	initEdadesCombos();
	$(" #form-aereos input.destino, #form-aereos input.origen").autocomplete({
		source: ciudades_mas_buscadas
	});

    $('input[name="oneway"]').click(function(){
        if($(this).val() == 0){
            $('.returnDate').show();
        }
        else{
            $('.returnDate').hide();
        }
    });


});

function checkFormAereos(){
    $('.formError').hide();
    $('input, select').removeClass('errorBorder');
    $sinErrores = true;
    if ( $('#form-aereos input.fecha_desde').val() == "" ){
        $sinErrores = false;
        $('#form-aereos .formError.fecha_desde_error').show();
        $('#form-aereos input.fecha_desde').addClass('errorBorder');
    }
    if ( $('#form-aereos input.fecha_hasta').val() == "" && $('input[name="oneway"]:checked').val() == 0 ){
        $sinErrores = false;
        $('#form-aereos .formError.fecha_hasta_error').show();
        $('#form-aereos input.fecha_hasta').addClass('errorBorder');
    }
    if ( $('#form-aereos .origen').size() > 0 &&  ( $('#form-aereos .origen').val().length < 3 || $('#form-aereos .origen').val() == $('#form-aereos .origen').attr('notValidValue') ) ){
        $sinErrores = false;
        $('#form-aereos .formError.origen').show();
        $('#form-aereos input.origen').addClass('errorBorder');
    }
    if ( $('#form-aereos .destino').size() > 0 &&  ( $('#form-aereos .destino').val().length < 3 || $('#form-aereos .destino').val() == $('#form-aereos .destino').attr('notValidValue') ) ){
        $sinErrores = false;
        $('#form-aereos .formError.destino').show();
        $('#form-aereos input.destino').addClass('errorBorder');
    }
    if ( !allAgeRangesSelected() ){
        $sinErrores = false;
    }else{
        if  ( !noMoreBabiesThanAdults() ){
            $sinErrores = false;
        }
    }
    if ($sinErrores){
        validateCities();
    }
}

function armaFechaNacimiento(iteracion,tipoPax){
    var fecha = $('#'+tipoPax+'_dia_'+iteracion).val()+'/'+$('#'+tipoPax+'_mes_'+iteracion).val()+'/'+$('#'+tipoPax+'_ano_'+iteracion).val();
    $('#'+tipoPax+'_fechanacimiento_'+iteracion).val(fecha);
}
function armaFechaCaducidad(iteracion,tipoPax){
    var fecha = $('#'+tipoPax+'_caducidaddia_'+iteracion).val()+'/'+$('#'+tipoPax+'_caducidadmes_'+iteracion).val()+'/'+$('#'+tipoPax+'_caducidadano_'+iteracion).val();
    $('#'+tipoPax+'_caducidad_'+iteracion).val(fecha);
}

function crearPax(){
    $adultosQ = $('#form-aereos .selectAdultos').val();
    $menoresArrayQ = new Array();;
    $mquant=0;
    $('.selectEdades').each(function(index){

        $menoresArrayQ[$mquant]= $(this).val();
        $mquant = $mquant+1;
    });


    $menoresQ = "";

    var length = $menoresArrayQ.length,
        element = null;

    $chd="";
    $inf="";
    $yadt="";
    for (var i = 0; i < length; i++) {
        if($menoresArrayQ[i] >= 2 && $menoresArrayQ[i] <= 12){
            $chd += '-'+$menoresArrayQ[i];
        }

    }

    for (var i = 0; i < length; i++) {
        if($menoresArrayQ[i] <= 1 ){
            $inf += '-'+$menoresArrayQ[i];
        }

    }

    for (var i = 0; i < length; i++) {
        if($menoresArrayQ[i] >= 13 ){
            $yadt += '-'+$menoresArrayQ[i];
        }

    }

    $menoresQ = $chd + $inf + $yadt;

//	alert($adultosQ + $menoresQ );

    $('.paxTotal').val($adultosQ + $menoresQ);

}


function calculaEdad(mostrarMensaje){
    var INF = $('#cantidad_inf').val();
    var CNN = $('#cantidad_cnn').val();
    var CAD	 = $('#cantidad_cad').val();
    var codigo_html = '';
    if($('#form-aereos .selectMenores').val() > 0){
        //$('#edades_conf').removeClass('hidden');
        if(mostrarMensaje){
            if($('#form-aereos input.fecha_hasta').val()=='dd/mm/aaaa'){
                var mensaje = 'Edad al finalizar el viaje';
            }else{
                var mensaje = 'Edad al '+$('#form-aereos input.fecha_hasta').val();
            }
        }else{
            var mensaje = 'Edad de los menores';
        }
        var menores = $('#form-aereos .selectMenores').val();


        $cantidadActual = $('#form-aereos .selectEdades').size();



        $cantidadFutura = $('#form-aereos .selectMenores').val();



        if ($cantidadActual == 0){
            codigo_html = '<li><label>'+mensaje+'</label></li>';
        }
        if ($cantidadActual < $cantidadFutura){
            $cantidadNuevos = $cantidadFutura - $cantidadActual;

            for(i=0;i<($cantidadNuevos);i++){
                var bandera = 0;

                codigo_html +=' <li style="padding:0 0 5px 0;" class="grid_3" id="">';
                codigo_html +=' <select  class="grid_1 alpha selectEdades" id="vuelosEdadMenor'+(i+1+$cantidadActual)+'">';
                codigo_html +=' <option value="-">Edad</option>';

                for (e=0; e<=11; e++){
                    codigo_html +=' <option value="'+e+'">'+e+'</option>';
                }


                codigo_html +=' </select>';
                codigo_html +=' <span style="width:auto; float:left; font-size:11px; margin:0 0 0 5px;"></span>';
                codigo_html +='</li>';
            }
            $('#form-aereos .edades_conf').append(codigo_html);


        }else{
            $cantidadEliminar = $cantidadActual - $cantidadFutura;
            for(i=0;i<($cantidadEliminar);i++){
                $('#form-aereos .selectEdades:last').each(function(){
                    $(this).parent().remove();
                });
            }
        }

    }else{
        $('#form-aereos .edades_conf').html('');
    }
    $.fn.colorbox.resize();
    initEdadesCombos();
}

function initEdadesCombos(){
    $('#form-aereos .selectEdades').click(function(){
        $rango = $(this).val();
        switch( $rango ){
            case 'ADT': tipoTarifa = '<span style="color: red">Tarifa adulto</span>'; break;
            case 'CAD': tipoTarifa = '<span style="color: red">Tarifa adulto</span>'; break;
            case 'CNN': tipoTarifa = 'Tarifa ni&ntilde;o'; break;
            case 'INF': tipoTarifa = 'Tarifa beb&eacute;'; $('#bebesCant').val($("#form-aereos .selectEdades[value=inf]:visible").length); break;
        }
        $(this).parent().find('span').html(tipoTarifa);
    });
    $('#form-aereos .selectEdades').each(function(){
        $rango = $(this).val();
        tipoTarifa='';
        switch( $rango ){
            case 'ADT': tipoTarifa = '<span style="color: red">Tarifa adulto</span>'; break;
            case 'CAD': tipoTarifa = '<span style="color: red">Tarifa adulto</span>'; break;
            case 'CNN': tipoTarifa = 'Tarifa ni&ntilde;o'; break;
            case 'INF': tipoTarifa = 'Tarifa beb&eacute;'; $('#bebesCant').val($(".selectEdades[value=inf]:visible").length); break;
        }
        $(this).parent().find('span').html(tipoTarifa);
    });
    $('#form-aereos .selectEdades').change(function(){
        if ( allAgeRangesSelected() ){
            noMoreBabiesThanAdults();
        }
    });
}


function allAgeRangesSelected(){
    $allSelected = true;
    $('#form-aereos .selectEdades').each(function(){
        if ($(this).val() == '-'){
            $('.formError.ageRanges').show();
            $allSelected = false;
            $(this).addClass('errorBorder');
        }
        else{
            $(this).removeClass('errorBorder');
        }
    });
    if ($allSelected){
        $('.formError.ageRanges').hide();
    }
    return $allSelected;
}
function noMoreBabiesThanAdults(){
    $return = true;
    $adultsQty = $('#form-aereos .selectAdultos').val();
    $babiesQty = 0;
    $('#form-aereos .selectEdades').each(function(){
        if ( $(this).val() < 2 ){
            $babiesQty++;
        }
    });
    $('.formError.babiesQty').hide();
    if ($adultsQty < $babiesQty){
        $('.formError.babiesQty').show();
        $return = false;
    }
    return $return;
}
function adaptChildrenQty(){
    $adultsQty 		= $('#form-aereos .selectAdultos').val();
    $childrenQty 	= $('#form-aereos .selectMenores').val();
    $newQtyForChd 	= 9 - $adultsQty;
    if ( $newQtyForChd > 8){
        $newQtyForChd = 8;
    }
    if ( $childrenQty > $newQtyForChd ){
        $childrenQty = $newQtyForChd;
    }
    $('#form-aereos .selectMenores').html('<option value="0">0</option>');
    for ($i=0;$i<$newQtyForChd;$i++){
        $selected = "";
        $value = $i+1;
        if ($value == $childrenQty){
            $selected = 'selected="selected" ';
        }
        $('#form-aereos .selectMenores').append('<option ' + $selected + 'value="' + $value + '">' + $value + '</option>');
    }
    $('#form-aereos .selectMenores').change();
}

function search_cities($punto,$fecha_desde,$fecha_hasta,$ciudadTmp,$destination_city){
    $ajax_url = '/vuelos/get-cities.php';
    $.ajax({
        url: $ajax_url,
        data: {fecha_desde:$fecha_desde,fecha_hasta:$fecha_hasta,searchable_string:$ciudadTmp,punto:$punto},
        type: 'POST',
        dataType: 'json',
        async: false,
        success: function( $data ){
            $('#modal_ciudades li.city').remove();
            if ($data.ciudades.length > 1){
                for($i=0;$i<$data.ciudades.length;$i++){
                    $ciudadTmp 		= $data.ciudades[$i].split(',');
                    $ciudad  		= replaceAll($ciudadTmp[0],' ','+');
                    $ciudadTmp2 	= $ciudadTmp[1].split('(');
                    $pais 			= $.trim($ciudadTmp2[0]);
                    $pais			= replaceAll($pais,' ','+');
                    $codigo			= $ciudadTmp2[1].substring(0,3);

                    $('#modal_ciudades h3').html('Elija la ciudad de ' + $punto);
                    $('#modal_ciudades li.initial').clone().appendTo('#modal_ciudades ul');
                    $('#modal_ciudades li:last a').html($data.ciudades[$i]);
                    $('#modal_ciudades li:last a').removeAttr('href');
                    $('#modal_ciudades li:last').removeClass('initial').addClass('city').show();
                }
                $('#modal_ciudades li.city').click(function(){
                    $('#form-aereos .'+$punto).val( $(this).find('a').html() );
                    //$.colorbox.close();
                    validateCities();
                });
                $.colorbox({href:"#modal_ciudades", inline:true, scrolling:false});
            }
            else{
                if ($data.ciudades.length == 1){
                    $('#form-aereos .'+$punto).val( $chosen_city = $data.ciudades[0]);
                    validateCities();
                }
                else{
                    $('input.'+$punto).css('border','1px solid red');
                    $('.formError.'+$punto+'.no_city').show();
                }
            }
        }
    });
}
function validateCities(){
    $('input').css('border', '1px solid #B9B8BB');
    $fecha_desde = $('#form-aereos input.fecha_desde').val();
    $fecha_hasta = $('#form-aereos input.fecha_hasta').val();

    $origin_city = $('#form-aereos .origen').val();
    $destination_city = $('#form-aereos .destino').val();


    if ($origin_city.indexOf('(') == -1) {
        search_cities('origen', $fecha_desde, $fecha_hasta, $origin_city);
    }
    else {
        if ($destination_city.indexOf('(') == -1) {
            search_cities('destino', $fecha_desde, $fecha_hasta, $destination_city);
        }
        else {
            crearPax();
            $('#form-aereos').submit();
        }
    }


}


function showExtraOffersAirs($section ,$show){
    if($show){
        $('.extra-'+$section).slideDown('fast',function(){
            $(this).parents('.ofertas_lista').find('.view-more').hide();
            $(this).parents('.ofertas_lista').find('.view-minus').show();
        });
    }
    else{
        $('.extra-'+$section).slideUp('fast',function(){
            $(this).parents('.ofertas_lista').find('.view-more').show();
            $(this).parents('.ofertas_lista').find('.view-minus').hide();
        });
    }
}