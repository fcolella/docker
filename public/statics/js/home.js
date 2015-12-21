$(function() {
$( "#tabs" ).tabs();
});


$('.id_banco').change(function(){

    $val=$(".id_banco").val();


        $.colorbox({href:"/promo-bancos.php?id_banco="+$val+"&modal=1",iframe:true,innerWidth:960,innerHeight:280})

    $( '.bancosSel' ).fadeOut( "fast", function() {
        $('.bancos-slide').fadeIn();
    });

});


$('.bancos-slide').click(function(){


    $( this ).fadeOut( "fast", function() {
        $('.bancosSel').fadeIn();
    });


})



jQuery(document).ready(function($) {


    $('.loading-form').hide();
    $('.form-busquedas').fadeIn("fast", function(){
        $('#2ndRow').slideDown();
        $('#banner-slide img').fadeIn();
        $('.loaderPkg').show();
        $('.bloque_home').fadeIn("fast");
    });

    
  });

	$(document).ready(function() {


        $miancho = $( window ).width();

        if($miancho <= 1024){

            $('.img-paquete img').css('height', '258px');
            $('.img-paquete img').css('max-width', '460px');

            $('.ui-tabs .ui-tabs-nav').css('padding-top',0);


            $('.ui-tabs .ui-tabs-nav li a').css('padding-bottom', '0.3em');
        }


        $( '#bancos-slide .bjqs-wrapper').css('position', 'absolute');
        $( '#bancos-slide .bjqs').css('margin-top', '30px');

		$( "#form-vuelos .origen" ).autocomplete({			
				source: ciudades_mas_buscadas
				
		});
		$( "#form-vuelos .destino" ).autocomplete({			
			source: ciudades_mas_buscadas,
			autoFocus: true
	});	
		$( "#form-hoteles .destino" ).autocomplete({
				source: ciudades_mas_buscadas,
				autoFocus: true
		});

	$(".seleccionable").focus(function(){
			$(this).addClass('sombra-azul');

		});
	$(".seleccionable").focusout(function(){
		$(this).removeClass('sombra-azul');

	});




	});



		
		$(function() {
			$( "#fecha_salida, #fecha_desde, #fecha_hasta").datepicker({
				showOn: 'both',
				numberOfMonths: 2,
				buttonImage: "/img/calendario.png",
				buttonImageOnly: true,
				minDate: new Date()
			});
		});
		$('#mes-nac').change(function(){
			$dias = $(this).find('option:selected').attr('dias');
			$anio = $('#anio-nac' ).val();
			if ( $anio % 4  == 0){
				if ($dias == 28){
					$dias = 29;
				}
			}
			$htmlOptions = '<option value="">Dï¿½a</option>';
			for ($i = 0; $i < $dias; $i++){
				$diaActual = $i + 1;
				$htmlOptions += '<option value="' + $diaActual  + '" >' + $diaActual + '</option>';
			}
			$('#dia-nac').html( $htmlOptions );
		});
		$('#anio-nac').change(function(){
			$('#mes-nac').change();
		});
