
var form;
$(document).ready(function() {
	if ($('input[name="booking_autocompletar"]').length>0){
		form = $('form[name="booking"]');
		//	Evento autocomplete del booking
		$('input[name="booking_autocompletar"]').on('click',function(){ autocomplete_init() });$('input[name="booking_up"]').on('click',function(){ $('header').scrollToMe() });$('input[name="booking_down"]').on('click',function(){ $('#submit_form').scrollToMe() });
	}

});

function autocomplete_init() {
	fillPayment();
	fillPax();
	fillEmergency();
	fillBilling();
	fillContact();
	$('input[name="condiciones"]').prop('checked',true);
}

function fillPayment() {
	if ($('.payment-block').length<1){return}
	$('.payment-block:first').scrollToMe()
	$('input[name="banco"]:first',form).prop('checked',true).trigger('change');
	$('select[name="card"]:visible option:eq(2)',form).prop('selected',true).trigger('change');
}

function fillPax(){
	if ($('.pasajero').length<1){return}
	$('.pasajero').each(function(index,element) {
		$(this).scrollToMe()
	//	console.log(index); console.log(element)
		$( 'input[name="traveler['+index+'][nombre]"]').val('Test '+(index+1))
		$( 'input[name="traveler['+index+'][apellido]"').val('Pasajero '+(index+1))
		$('select[name="traveler['+index+'][dia_nac]"] option:eq('+(index+1)+')').prop('selected',true).trigger('change');
		$('select[name="traveler['+index+'][mes_nac]"] option:eq('+(index+1)+')').prop('selected',true).trigger('change');
		$('select[name="traveler['+index+'][dia_nac]"] option:eq('+(index+1)+')').prop('selected',true).trigger('change');
		$('select[name="traveler['+index+'][tipoDocumento]"] option:eq(1)').prop('selected',true).trigger('change');
		$( 'input[name="traveler['+index+'][numeroDocumento]"]').val('123456789'+(index+1));
	});
}

function fillEmergency() {
	if ($('.emergency').length<1){return}
	$('.emergency').scrollToMe()
	$('input[name="emergencyContactsInfo[name]"]').val('Test');
	$('input[name="emergencyContactsInfo[lastname]"]').val('Emergencia');
	$('input[name="emergencyContactsInfo[phone]"]').val('4787-7077');
}

function fillBilling() {
	if ($('.billing').length<1){return}
	$('.billing').scrollToMe()
//	<option value="C">Ciudad de Buenos Aires</option>
	$('select[name="provincia"] option[value="C"]').prop('selected',true).trigger('change');
	$( 'input[name="localidad"]').val('Ciudad de Buenos Aires').trigger('change');
	$( 'input[name="domicilio"]').val('Av. Cabildo');
	$( 'input[name="altura"]').val('2025');
	$( 'input[name="piso"]').val('1');
	$( 'input[name="depto"]').val('Al fondo');
	$('select[name="clave"] option:eq(0)').prop('selected',true).trigger('change');
	$( 'input[name="cuil"]').val('23123456789');
}

function fillContact() {
	if ($('.contact').length<1){return}
	$('.contact').scrollToMe()
	$( 'input[name="email"]').val('it@garbarinoviajes.com.ar');
	$( 'input[name="telefono"]').val('4787-7077');
	$( 'textarea[name="comentarios"]').val('PRUEBA DESDE DESARROLLO');
}