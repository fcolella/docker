jQuery(document).ready(function($) {



$('.selectpicker').hide();

$home = $('.home').val();

if($home == 'true'){
$(".suscripcion").click(function(){$val=$("#mail_newsletter").val();$url="newsletter-mensajes.php?accion=suscribir&email="+$val;$.colorbox({href:$url,iframe:true,width:"368px",height:"250px"})});
$(".unsuscripcion").colorbox({iframe:true,width:"368px",height:"250px"});
}

$(".rg").click(function(){
	if($(this).parent().find('.hidden').css('display') == 'block'){
		
		$(this).parent().find('.hidden').slideToggle( "slow");
	
	}else{
	
	$('.hidden').each(function() {
		 if($( this ).css('display') == 'block'){
		$( this ).slideToggle( "slow");
		}
			 
	});
	
	$(this).parent().find('.hidden').fadeToggle( "slow", "linear" );
	}
	
})

//$('img.lazy').lazyload();



$(window).scroll(function() {
	if(typeof pageYOffset!= 'undefined'){
	    //most browsers except IE before #9



		$version = $('#version').val();
		
	   
	   
	   if(pageYOffset >=86){

			$('.price-data').css('position', 'fixed');
			$('.price-data').css('top', '40px');
			$('.price-data').css('float', '');
            $('.price-data').css('z-index', '1');
            $('.price-data').css('background-color', '#ededed');
            $('.price-data').css('border', '1px solid #e5e5e5');
            $('.price-data').addClass('grid_4');
            $('.price-data').addClass('alpha');
            $('.price-data').addClass('ui-corner-all');
			if($version == 'v1'){
				//$('.price-data').css('margin-left', '-28.9%');
			}else{
				//$('.price-data').css('margin-left', '-28.9%');
			}

           $bloqHeight  = $('.bloq-info').height();
           $priceHeight = $('.price-data').height();

           $totalHeight = $bloqHeight + $priceHeight +150;

           if($bloqHeight && $priceHeight)
                $('.right-bar').css('min-height', $totalHeight+'px');

           $('.bloq-info').css('position', 'relative');
           $('.bloq-info').css('top', '350px');

		}else{
				$('.price-data').css('position', '');
				$('.price-data').css('top','');
                $('.price-data').css('background-color', '');
                $('.price-data').css('border', '');
				$('.price-data').removeClass('grid_4');
                $('.price-data').removeClass('alpha');
                $('.price-data').removeClass('ui-corner-all');
				$('.price-data').css('margin-left', '');
                $('.price-data').css('z-index', '');
           $('.bloq-info').css('position', '');
           $('.bloq-info').css('top', '');

		}


	   
	}});

function assignStyle($screenWidth){
	
	
	
	if ($screenWidth >=960){
		
		$('#version').val('v2');
	}else{
		$('#version').val('v1');
	}

}


$('.call-us').click(function(){

    $('.call-us-modal').fadeIn();
})

    $('.call-us-modal .close').click(function(){

        $('.call-us-modal').fadeOut();
    });


    $.ajax({
        url: '/paquetes/ajax-home-list.php?tag=paquetes-turisticos',
        type: 'GET',
        dataType: 'json',
        success: function($data){

            $('div[role="footer"] .packages ul .loading').remove();
            $('div[role="footer"] .packages ul').append($data.list);

        }
    });


    $(".suscripcion").click(function(ev){
        ev.preventDefault();
        $val=$("#mail_newsletter").val();
        $url="/newsletter-mensajes.php?accion=suscribir&email="+$val;
        $.colorbox({href:$url,iframe:true,width:"368px",height:"250px"})
    });

    $(".unsuscripcion").colorbox({iframe:true,width:"368px",height:"250px"});


    //$('.dropdown-toggle').dropdown();

		
});

function replaceAll( text, busca, reemplaza ){
	while (text.toString().indexOf(busca) != -1){
		text = text.toString().replace(busca,reemplaza);
	}
	return text;
}

function eBlur(a){if(a.value==""){a.value=a.defaultValue}};
function eFocus(a){if(a.value==a.defaultValue){a.value=""}};

function mostrarOpciones(a){document.getElementById(a).style.display="block";document.getElementById(a+"_mostrar").style.display="none";document.getElementById(a+"_ocultar").style.display="block"}
function ocultarOpciones(a){document.getElementById(a).style.display="none";document.getElementById(a+"_mostrar").style.display="block";document.getElementById(a+"_ocultar").style.display="none"}


function tamdivAereos(){
	var a=$('.aereos_content').height();
	var b=$("#a2col-right").height();
	
	if(a>b){
		$("#filtro").css('min-height', a+"px");
	
		}};


function tamdivPaquetes(){
	var body    =$('.grilla-paquetes').height();
	var callForm=$('.callForm').height();
    var form    = $('.form-grilla').height();
	
	if(callForm + form < body){
        var diff = body - callForm - form;
        $(".filtrosPaquetes").css('min-height', diff+"px");
		
	}
};


function initDesactivable(){

    $(".desactivable").click(function()
    {if($(this).attr("href")!=undefined){$href=$(this).attr("href");$(".desactivable").removeAttr("href");$(this).after('<div class="btn_procesando grid_2 txt-centrado blue top alpha margen"><img align="absmiddle" src="/img/loading.gif"><b>Procesando...</b></div>');$(this).remove();window.location.href=$href}})}

String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g,"");
}
String.prototype.ltrim = function() {
    return this.replace(/^\s+/,"");
}
String.prototype.rtrim = function() {
    return this.replace(/\s+$/,"");
}

function tamdiv(){


    var cuerpo_tam = document.getElementById('a2col').offsetHeight;
    var filtro_alt = document.getElementById('a2col-right').offsetHeight;



    var col_izq = document.getElementById('a2col-right');



    if (cuerpo_tam > filtro_alt){
        $("#a2col-right").css('min-height', cuerpo_tam+"px");
    }};


function Newtamdiv(){

        $("#a2col-right").css('min-height', 20+"px");
        var cuerpo_tam   = document.getElementById('a2col').offsetHeight;
        var filtro_alt 	 = document.getElementById('col_der').offsetHeight;
        var tarjetas_alt = document.getElementById('boxTarjetas').offsetHeight;

        var col_izq = document.getElementById('a2col-right');

        var nva_alt = cuerpo_tam - tarjetas_alt ;

        if (cuerpo_tam > filtro_alt){
            $("#a2col-right").css('min-height', nva_alt+"px");
        }






    };

