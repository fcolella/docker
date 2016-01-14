$(document).ready(function(){
	var agregarBuscarMas = function () {
		return '';
	};
	var buscarMas = function () {
		return '';
	};
	//
    $('.select-autocomplete').autocomplete({
		minLength: 3,
		select: function () {
			var value = $(this).val();
			$('.select-autocomplete').val(value);
			$('.select-autocomplete').removeClass('error');
			$(this).siblings('.msje-error').hide();
			$('.successResult').val(1);
			$stateCode = $('.provincia').find('option:selected').val();
			var url = $('.select-autocomplete').data('source');
			$.getJSON(url+'?stateCode=' + $stateCode + '&cityName=' + value, function (city) {
				$('input[name="localityCode"]').val(city.id);
				$('input[name="subdivision"]').val(city.subdivision);
				$('input[name="zipCode"]').val(city.zipCode);
			});
		},
		open: function(){
			$('ul.ui-autocomplete li a').unbind('click');
			$('ul.ui-autocomplete li a').click(function () {
				$('.select-autocomplete').val($(this).text());
				$(this).parents('table').hide();
				$('.select-autocomplete-wrap table').hide();
				$('.select-autocomplete-wrap table td').removeClass('selected');
				$('.successResult').val(1);
				$('.select-autocomplete').autocomplete('option', 'select').call($('.select-autocomplete'));
			});
			$('ul.ui-autocomplete li a').hover(
				function(){
					$('.select-autocomplete').val($(this).text());
					$(this).addClass('selected');
				},
				function(){
					$(this).removeClass('selected');
				}
			);
		},
		change:function( event, ui ) {
			var data = $.data(this);
			if (data.autocomplete.selectedItem == undefined) {
				$('.successResult').val(0);
			} else {
				$('.successResult').val(1);
			}
		}
	});
	//
	$('.select-autocomplete').data('autocomplete')._agregaBuscarMas = agregarBuscarMas;
	$('.select-autocomplete').data('autocomplete').buscarMas = buscarMas;
	$('.provincia').change(function(){
		$(this).siblings('.msje-error').hide();
		$stateCode = $(this).find('option:selected').val();
		$stateName = $(this).find('option:selected').text();
		$('input[name="stateName"]').val($stateName);
		getCitiesByStateCode($stateCode);
	});
	//
	$('.select-autocomplete').focusout(function(){
		if($(this).val() == '') {
			$('.successResult').val(0);
		}
	});
	//
	$('.submit-btn').click(function(){
		if($('.select-autocomplete').val() == '') {
			$('.successResult').val(0);
		}
	});
});


//
function getCitiesByStateCode($stateCode) {
	$('.successResult').val(0);
	var url = $('.select-autocomplete').data('source');
	$.getJSON(url+'?stateCode=' + $stateCode, function (res) {
		var cities = new Array();
		$htmlTable = '<table class="grid_4 alpha" style="display: none; position: absolute;top: 35px;">';
		$.each(res, function (index, city) {
			cities.push(city.name);
			$htmlTable += '<tr><td value="' + city.id + '">' + city.name + '</td></tr>';
		});
		$htmlTable += '</table>';
		$('.select-autocomplete').autocomplete('option', 'source', cities);
		$('.select-autocomplete').removeAttr('disabled');
		$('.select-autocomplete').removeClass('disabled');
		$('.select-autocomplete').val('');
		$('.select-autocomplete-wrap').find('table').remove();
		$('.select-autocomplete-wrap').append($htmlTable);
		$('.suggest-icons').unbind('click');
		$('.suggest-icons').click(function (ev) {
			ev.preventDefault();
			ev.stopPropagation();
			if(!$('ul.ui-autocomplete').is(':visible')) {
				var table = $(this).siblings('table');
				if ($(table).is(':visible')) {
					$(table).hide();
					$(table).find('td').removeClass('selected');
				} else {
					$(table).show();
				}
			}
		});
		//
		$('.select-autocomplete-wrap table td').hover(
			function(){
				$(this).addClass('selected');
			},
			function(){
				$(this).removeClass('selected');
			}
		);
		//
		$('body').click(function (ev) {
			var target = $(ev.target);
			if (!target.is('.suggest-icons') && !target.is('.select-autocomplete-wrap table')) {
				$('.select-autocomplete-wrap table').hide();
			}
		});
		//
		$('body').keypress(function(ev){
			if (ev.keyCode == 13) {
				// enter
				var target = $(ev.target);
				if (target.is('.select-autocomplete')) {
					ev.preventDefault();
					$('.select-autocomplete-wrap table').hide();
					$('.select-autocomplete-wrap table td').removeClass('selected');
					$('.successResult').val(1);
					$('.select-autocomplete').autocomplete('option', 'select').call($('.select-autocomplete'));
				}
			}
		});
		//
		$('.select-autocomplete-wrap table td').click(function(){
			$('.select-autocomplete').val($(this).text());
			$(this).parents('table').hide();
			$('.select-autocomplete-wrap table').hide();
			$('.select-autocomplete-wrap table td').removeClass('selected');
			$('.successResult').val(1);
			$('.select-autocomplete').autocomplete('option', 'select').call($('.select-autocomplete'));
		});
	});
}
