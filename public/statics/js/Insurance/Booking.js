
$(document).ready(function() {
	$('#submit_form').on('click',function(e){
		return checkForm();
	});
});

function checkForm(){
	//
//	var form = $('form[name="booking"]');
	$sinErrores = validarThisForm( form );
	//
	$('.required',form).each(function() {
		if ("" == $(this).val()) {
			$sinErrores = false;
			$(this).addClass('error');
		}
	});
	//
	var $provincia=$('input[name="provincia"]');
	if ('-' == $provincia.val()) {
		$provincia.siblings('.msje-error').show();
		$sinErrores = false;
	}
	//
	$('.fechas').each(function(index,element) {
		var $day=$('select[name="traveler['+index+'][dia_nac]"]',element);
		var $month=$('select[name="traveler['+index+'][mes_nac]"]',element);
		var $year=$('select[name="traveler['+index+'][anio_nac]"]',element);
		if ("" == $day.val() || "" == $month.val() || "" == $year.val()) {
			$sinErrores = false;
			$(element).parent().find('.fechaVacio').show();
		} else {
			var maxday = $(':selected',$month).data('dias');
			if ($day.val() > maxday){
				$sinErrores = false;
				$(element).parent().find('.fechaNoValida').show();
			}
		}
	});
	//
	if ($sinErrores){
		$('.errorAdvice').hide();
		$('.error').hide();
		$('#submit_consulta').after('<div class="blue grid_3 txt-centrado"><img align="absmiddle" src="/img/loading.gif"><b>Procesando</b></div>');
		$('#submit_consulta').parent().removeClass("reservar_btn");
		$('#submit_consulta').remove();
		form.submit();
	} else {
		$ancla = $('.error',form).first();
		if ($('#data-pago').val() == '') {
			if ($('.selectCard:visible').length > 0 || $('.selectCuotas:visible').length > 0) {
				$fareBlockSelected = ($('.selectCard:visible').length > 0) ? $('.selectCard:visible').parents('.fare-block') : $('.selectCuotas:visible').parents('.fare-block');
				$ancla = $fareBlockSelected;
				$('.fare-block').css('border','none');
				$('.fare-block').find('.msje-error').hide();
				$('.fare-block').siblings('.msje-error').hide();
				$fareBlockSelected.css('border','1px solid red');
				$fareBlockSelected.find('.msje-error').show();
			} else {
				$firstFareBlock = $('.fare-block').first();
				$ancla = $firstFareBlock;
				$('.fare-block').css('border','1px solid red');
				$('.fare-block').siblings('.msje-error').show();
			}
		}  else {
			$('.fare-block').css('border','none');
		}
		//
		$($ancla).scrollToMe();
		$('.errorAdvice').show();
	}
}
