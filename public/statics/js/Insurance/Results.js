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
		url: uri, //+'&filters='+filters,
		beforeSend: function(){

		},
		success: function(data){
			if ('undefined'==typeof(data)||true==data.error) {
				$('#grid-error').toggleClass('hidden')
			} else {
				if(data.grid){
					$('.result-list').html(data.grid).css('visibility','visible').hide();
					$('#result-total').html(data.total+' resultados').parent().toggleClass('hidden');
					Grid_Success();
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

var Insuranceform,InsuranceRow;
function Grid_Success() {

	Insuranceform = $('form[name="form-seguros"]');
		Insuranceform.find('h2.row:first').append('<span class="SlideArrowUp pull-right">▲</span>').append('<span class="SlideArrowDown pull-right hidden" style="display: inline;"> ▼</span>');
	InsuranceRow = Insuranceform.find('div.row:first');
	InsuranceRow.addClass('hidden');
	$('.SlideArrowUp, .SlideArrowDown, .toggle-search, h2.row:first').on('click',function(e){
		e.stopPropagation();e.preventDefault();
		InsuranceRow.toggleClass('hidden');
		$('.SlideArrowUp, .SlideArrowDown').toggleClass('hidden');
		tamDiv();
	});

	//
	$('a.viewAll').on('click',function(e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).parent().find('li.notvissible:hidden').removeClass('hidden');
		$(this).parent().find('.viewLess').show();
		$(this).hide();
		$('html,body').animate({scrollTop: $(this).parent().offset().top});
		tamDiv();
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
		tamDiv();
		return false;
	});
	//
	tamDiv();
	$('.result-title').removeClass('hidden');
	$('.result-list').fadeIn(1200)
}

function tamDiv(){
	$body       = $('.result-list').height();
	$callForm   = $('.widget-busqueda-wrap').height();

	if($callForm < $body){
		$diff = $body - $callForm;
		$('.secundary').css('min-height', $diff);
	}

}