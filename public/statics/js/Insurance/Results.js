var jqXHR,GridUri,map;

$(document).ready(function() {
	GridUri=$('.result-list').data('source');
	if ($('#result-error').length>0) {
		$('.container-widget-busqueda').toggleClass('hidden').delay(500).queue(function(){});
	}
	InsiranceGrid();
});

//	Sends ajax call to fetch availability and returns array with results
function InsiranceGrid(uri) {
	//	Es la primera carga o estamos filtrando ?
	var filters=false,timeStart=0;
	if('undefined'===typeof(uri)){
		timeStart=new Date();
		filters=true;
		uri=GridUri;}
	if('undefined'==typeof(uri)){return}
	if('undefined'!==typeof(jqXHR)){jqXHR.abort()}
	jqXHR=$.ajax({
		cache: true,
		async: true,
		timeout: 60000,
		method: 'POST',
		url: uri+'&filters='+filters,
		beforeSend: function(){

		},
		success: function(data){
			if ('undefined'==typeof(data)||true==data.error) {
				$('#grid-error').toggleClass('hidden')
			} else {
				if(data.grid){
					$('.result-list').html(data.grid).css('visibility','visible').hide();
					$('#result-total').html(data.total).parent().toggleClass('hidden');
					Grid_Success();
					$('.result-list').fadeIn(1200)
				}
			}
		},
		complete: function(data,status,error){
			filters=false;
			$('.container-widget-busqueda').toggleClass('hidden');
			$('#grid-loader').toggleClass('hidden');
			if('error'==status){
				$('#grid-error').toggleClass('hidden')
			}
		}
	});
}

function Grid_Success() {
/**
	// zonas
	$.each($('select[name="destination"] option:not(selected)'),function(){
		var value = $(this).val().trim();
		if (""!=value) {
			var $htmlzonas = '<li><a href="zona.php?destino=' + capitalize($data.zonas[i]) + '" title="Asistencia al viajero en ' + capitalize($data.zonas[i]) + '">' + capitalize($data.zonas[i]) + '</a></li>';
			$('.zonas').append($htmlzonas);
		}
	});
**/
	//
	$('a.viewAll').on('click',function(e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).parent().find('li.notvissible:hidden').removeClass('hidden');
		$(this).parent().find('.viewLess').show();
		$(this).hide();
		$('html,body').animate({scrollTop: $(this).parent().offset().top});
		return false;
	});
	//
	$('a.viewLess').on('click',function(e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).parent().find('li.notvissible:not(hidden)').addClass('hidden');
		$(this).parent().find('.viewAll').show();
		$(this).hide();
		$('html,body').animate({scrollTop: $(this).parent().offset().top});
		return false;
	});
}