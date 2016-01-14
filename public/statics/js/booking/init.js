/**
 *
**/

var form;
$(document).ready(function(){
	form=$('form[name="booking"]');
	form.css('visibility','visible').toggleClass('hidden').hide();

	//	Triggers
	$('input[name="banco"]').prop('checked', false);
	$('input[name="tarjeta"]').prop('checked', false);

	ViewMoreLess();
	BanckActions();
	CardActions();

	InstallmentActions();
	$('.selectpicker').selectpicker({'selectedText':'cat'});
	window.setTimeout(function(){
		$('.loadingWrapper').remove();
		$('header').scrollToMe();
		form.fadeIn(1200);
	},800)
});

jQuery.fn.extend({
	scrollToMe: function() { var x = jQuery(this).offset().top - 100; jQuery('html,body').animate({scrollTop: x}, 400); }
});

function validateEmail($email) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if (!emailReg.test($email)) {
		return false;
	} else {
		return true;
	}
}

function validarThisForm($form) {
	$sinErrores = true;
	$('.msje-error').hide();
	//
	$("input.requerido").each(function() {
		$contenido = $(this).val();
		if ($contenido == '') {
			$(this).addClass('error');
			$(this).next('.msje-error').show();
			$sinErrores = false;
		}
	});
	//
	$("input.required").each(function() {
		$contenido = $(this).val();
		if ($contenido == '') {
			$(this).addClass('error');
			$(this).next('.msje-error').show();
			$sinErrores = false;
		}
	});
	//
	$terms = $('#terms').is(':checked');
	if ($terms == false) {
		$('#terms').addClass('error');
		$('.terms .msje-error' ).show();
		$sinErrores = false;
	}
	//
	$email = $('.email').val();
	if ( $email == ""){
		$sinErrores = false;
	} else {
		$validMail = validateEmail($email);
		if ($validMail == false) {
			$sinErrores = false;
			$('.formato').show();
		}
	}
	//
	$modo = $('#pago').val();
	if ($modo != 0) {
		$datapago = $('#data-pago').val();
		if ($datapago == '') {
			$sinErrores = false;
		}
	}
	//
	if ($('.cuil').length > 0) {
		if ($('.cuil').val() != '') {
			if ($('.cuil').val().length < 11) {
				$('.cuil').addClass('error');
				$('.cuil').siblings('.formError.formato').show();
				$sinErrores = false;
			} else {
				$('.cuil').removeClass('error');
				$('.cuil').siblings('.formError.formato').hide();
			}
		}
	}
	return $sinErrores;
}

function ViewMoreLess() {
	$('.view-more').on('click',function(e){
		e.preventDefault();e.preventDefault();
		var container=$(this).closest('.payment-block');$('.hiddenBank',container).show().removeClass('hidden');$('.view-less',container).show().removeClass('hidden');$('.view-more',container).hide().addClass('hidden');
		return false;
	});
	$('.view-less').on('click',function(e){
		e.preventDefault();e.preventDefault();
		var container=$(this).closest('.payment-block');$('.hiddenBank',container).hide().addClass('hidden');$('.view-less',container).hide().addClass('hidden');$('.view-more',container).show().removeClass('hidden');
		return false;
	});
}

function getSelectedBanck() {
	var $Input=$('input[name="banco"]:radio:checked');
	var ret = ($Input.length) ? $Input : '*****';
//	console.log(ret)
	return ret;
}

function getSelectedCard() {
	var $SelecCard =$('select[name="card"]:visible option:selected');
//	console.log($SelecCar)
	var $InputCard=$('input[name="tarjeta"]:radio:checked:visible');
//	console.log($InputCard)
	var ret = ($InputCard.length) ? $InputCard : $SelecCard;
//	console.log(ret)
	return ret;
}

function getSelectedInstallment() {
	var $Card=getSelectedCard();
//	console.log($Card)
	var $paymentblock = $Card.closest('.payment-block');
//	console.log($paymentblock)
	var $SelecInstallment =$('select[name="Installment"]:visible',$paymentblock);
//	console.log($SelecInstallment)
	var $InputInstallment=$('input[name="Installment"]',$paymentblock);
//	console.log($InputInstallment)
	var ret = ($InputInstallment.length) ? $InputInstallment : $SelecInstallment;
//	console.log(ret)
	return ret;
}

function BanckActions(){
	$('.selectCard').hide().removeClass('hidden');
	$('.selectCuotas').hide().removeClass('hidden');

	$('.bancoSelect').on('change',function(e){
		e.preventDefault();e.stopPropagation();
		//$('.hiddenBank').hide();
		//$('.view-less').hide();
		//$('.view-more').show();
		//$hiddenBank = $(this).parent().find('.hiddenBank');
		//$($hiddenBank).toggle();
		//$(this).parent().find('.view-less').show();
		$('.fare-block .msje-error').hide();
		$('#data-pago').val('');
		$('.payment').html('');
		$('.tarjeta').attr('checked', false);
		$('.selectCuotas').hide();
		$firstData		 = $('.data-payment-first').val();
		$bankIdSelected  = $(this).val();
		$bankSpsSelected = $(this).attr('sps');
		$cuotasSel       = $(this).parent().parent().find('.cuotas').val();
		$cardSel     	 = $(this).parent().find('.selectCard');
		$('.payment-block-selected').removeClass('payment-block-selected');
		$(this).parent().parent().parent().addClass('payment-block-selected');
		$('.selectCard').hide();

		$newCard =  $($cardSel).clone();
		var $cardOptions = $(this).closest('.payment-block').find('.cardOptions');
			$cardOptions.find('.selectCard').remove();
			$cardOptions.append($newCard);
			$cardOptions.find('.selectCard').show();
		var $selectedCard = $cardOptions.find('.selectCard');
//	console.log( $selectedCard )

		$selectedCard.off('change').on('change',function(e){
			e.preventDefault();e.stopPropagation();

			$airlineCode =$('option:selected', this).attr('airlinecode');
//	console.log($airlineCode);
			$cardSelected = $(this).val();
			if ($cardSelected != 'Selecciona una tarjeta') {
				$addData = $('.data-payment-first').val($firstData+$cardSelected+'-');
				$cuotasSelected = 0;
//				var $installment = getSelectedInstallment();
//	console.log( $installment.val() )
				$cuotasSel = $(this).closest('.payment-block').find('input[name="Installment"]').val();
				//    15(tarjeta)-00110412(sps)-1(cuotas)-6(BancoId)—
				if ($airlineCode != undefined) {
					$newDataPago = $cardSelected+'-'+$bankSpsSelected+'-'+$cuotasSel+'-'+$bankIdSelected+'-'+$airlineCode+'-'+$airlineCode+'-'+'-';
				} else {
					$newDataPago = $cardSelected+'-'+$bankSpsSelected+'-'+$cuotasSel+'-'+$bankIdSelected+'-';
				}
//	console.log($newDataPago)
				$('#data-pago').val($newDataPago);
				$payment = $(this).parent().parent().find('.payment');
				$loader  = $(this).parent().parent().find('.loader');
				$newMsje = getCuotas($payment, $loader);
				$banco   = $('.bancoSelect:checked').siblings('label').find('img').attr('title');
				$tarjeta = $(this).find('option:selected').text();
				$cuotas  = $(this).parent().parent().find('.cuotas').val();
				$combo   = $banco+'-'+$tarjeta;
				$pushed  = false;
				$('#precioFinal').off('change').on('change',function(e){
					e.preventDefault();e.stopPropagation();
					if ($(this).val() == 'NaN') {
						$addCuotas = '-'+$cuotas;
						if ($combo.indexOf($addCuotas) == -1) {
							$combo += $addCuotas;
							if (!$pushed) {
								$pushed = true;
//								pushDataLayer($combo);
							}
						}
					} else {
						if (!$pushed) {
							$pushed = true;
//							pushDataLayer($combo);
						}
					}
				});
			} else {
				$('.payment').html('');
				$('#data-pago').val('');
			}
		});
		if ($('option', $selectedCard).length == 2) {
			$('option:eq(1)', $selectedCard).prop('selected', true).trigger('change');
		}
	});
}

function CardActions() {
	$('.tarjeta').off('change').on('change',function(e){
		e.preventDefault();e.stopPropagation();
		//$('.hiddenBank').hide();
		//$('.view-less').hide();
		//$('.view-more').show();
		//$hiddenBank = $(this).parent().find('.hiddenBank');
		//$($hiddenBank).toggle();
		//$(this).parent().find('.view-less').show();
		$('.fare-block .msje-error').hide();
		$('#data-pago').val('');
		$('.payment').html('');
		$('.selectCard').hide();
		$('.bancoSelect').attr('checked', false);
		$(this).next('.bancoSelect').prop('checked', true);
		$('.payment-block-selected').removeClass('payment-block-selected');
		$(this).parent().parent().parent().addClass('payment-block-selected');
		$(".selectCuotas option").removeAttr('selected');
		$(".selectCuotas option:first").attr('selected', 'selected');
		$hideGarbaLabel = true;
		$('.selectCuotas').show();
		$cardSelectedAll = $(this).val();
		$banco   = $(this).siblings('img').attr('title');
		$tarjeta = $(this).siblings('.tarjetaNombre').val();
		$combo   = $banco+'-'+$tarjeta;
		$('.selectCuotas').off('change').on('change',function(e){
			e.preventDefault();e.stopPropagation();
//	var $installment = getSelectedInstallment();
//	console.log( $installment.val() )
			$cuotasSelAll = $('.selectCuotas').val();
			if ($cuotasSelAll != 0) {
			//	$newDataPago = $cardSelected+'-'+$bankSpsSelected+'-'+$cuotasSel+'-'+$bankIdSelected+'-';
				$newDataPago = $cardSelectedAll+'-00060212-'+$cuotasSelAll+'-15--';
//	console.log($newDataPago)
				$('#data-pago').val($newDataPago);
				$payment =  $(this).parent().parent().find('.payment');
				$loader  =  $(this).parent().parent().find('.loader');
				$newMsje =  getCuotas($payment, $loader, $hideGarbaLabel);
				$pushed  = false;
				$('#precioFinal').off('change').on('change',function(e){
					e.preventDefault();e.stopPropagation();
					if ($(this).val() == 'NaN') {
						$addCuotas = '-'+$cuotasSelAll;
						if ($combo.indexOf($addCuotas) == -1) {
							$combo += $addCuotas;
							if (!$pushed) {
								$pushed = true;
//								pushDataLayer($combo);
							}
						}
					} else {
						if (!$pushed) {
							$pushed = true;
//							pushDataLayer($combo);
						}
					}
				});
			} else {
				$($payment).html('');
				$('#data-pago').val('');
			}
		})
	})
}

function InstallmentActions() {
	$('.cuotas').off('change').on('change',function(e){
		e.preventDefault();e.stopPropagation();
		$('.intereses_data').html('');
		$newDataPago = $(this).find(':selected')[0].value;
console.log($newDataPago)
		('#data-pago').val($newDataPago);
		if ($newDataPago != '') {
			getCuotas();
		} else {
			$('.payment').html('');
		}
	})
}

function getCuotas($payment, $loader, hideGarbaLabel) {
	var $bank		= getSelectedBanck();
//	console.log('sps', $bank.attr('sps') );
	var $card = getSelectedCard();
//	console.log('card', $card.val() );
	var $installment = getSelectedInstallment();
//	console.log('installment', $installment.val() );

	//	$cardSelected+'-'+$bankSpsSelected+'-'+$cuotasSel+'-'+$bankIdSelected+'-'+$airlineCode+'-'+$airlineCode+'-'+'-';
	var tarjeta		= $card.val()||0;					//ex 0
	var banco		= $bank.attr('sps')||"";			//ex 1
	var cuotas		= $installment.val()||0;			//ex 2
	var banco_id	= $bank.val()||0;					//ex 3
	var uatp		= ($card.attr('airlinecode')||0) ? true : false;		//ex 4
	var aerolinea	= $card.attr('airlinecode')||0;		//ex 5
	//
	$loader.show();
	//
	$.getJSON(
		'/compra/calculations',
		{
			'banco':banco,
			'banco_id':banco_id,
			'tarjeta':tarjeta,
			'cuotas':cuotas,
			'uatp':uatp,
			'aerolinea':aerolinea
		},
		function(data) {
//	console.log(data)
			//
			$('.loader').hide();
			var message					= (hideGarbaLabel) ? '' : 'Garbarino Viajes S.A.';
			var garbaLabel				= "";
			var precio					= 0;
			var coeficiente				= 0;
			var coeficienteBonificacion	= 0;
			var coeficienteDescuento	= 0;
			var precioMaxCargosGestion	= 0;
			var precioDescuento			= 0;
			//
			if ('' != aerolinea) {
				precio 					= $('#vipPrice').val();
				coeficiente				= data.coeficiente;
				$('#uatp').val('1');
			} else {
				precio					= $('#TotalAmount').val();
				coeficiente				= data.coeficiente;
				coeficienteBonificacion	= data.bonificacion;
				$('#uatp').val('0');
			}
			//
			var precioParcial			= parseFloat(precio) + parseFloat(precioMaxCargosGestion) - parseFloat(precioDescuento);
			var intereses				= Math.ceil(precioParcial * coeficiente);
			var interesesExacto			= parseFloat(precioParcial * coeficiente);
			var bonificacion			= Math.ceil(intereses * coeficienteBonificacion);
			var precioFinal				= parseFloat(precioParcial) + parseFloat(intereses) - parseFloat(bonificacion);
			var precioFinalRedondeado	= Math.ceil(precioFinal);
			var precioCuota				= (precioFinal / cuotas).toFixed(2);

			if (true==uatp) {
				var pagoInit = parseFloat(precioCuota) + parseFloat($('#gvPrice').val());
				if ($('#insurancePrice').length > 0) {
					pagoInit += parseFloat($('#insurancePrice').val());
				}
				//
				var alerta = (0!=coeficiente) ? 'sin inter&eacute;s ' : '';
				if (cuotas > 1) {
					message = 'Un pago inicial de <b>ARS '+ pagoInit.toFixed(2) +'</b> +<br> ' + (cuotas - 1) +' cuotas '+alerta+' de <b>ARS '+precioCuota+'</b> ';
				} else {
					message = '1 pago '+alerta+' de <b>ARS '+$('#TotalAmount').val()+'</b> ';
				}
			} else {
				message = cuotas+((cuotas != 1) ? ' cuotas ' : ' cuota ')+' de <b>ARS '+precioCuota+'</b> ';
			}
			$('#precioFinal').val(precioFinalRedondeado).trigger('change');
			$('#intereses').val(intereses);
			$('#interesesExacto').val(interesesExacto);
			$('#bonificacion').val(bonificacion);
			$('#maxCargosGestion').val(precioMaxCargosGestion);
			$('#descCargosGestion').val(precioDescuento);
			$('#coefDescuento').val(coeficienteDescuento);
			$payment.html(message);
			$('.tarjetas-vacio').hide();
			var $detalleGastos = $('.total').prev('ul');
			$('.intereses').remove();
			$('.intereses_data').html('');
			$('.cargosGestion').remove();
			$('.descuento').remove();
			$('.bonificacion').remove();
			//
			if (0!=intereses) {
				var html = '<li class="intereses">Gastos financieros '+garbaLabel+'<span>ARS '+number_format(intereses)+'</span></li>';
				if ($('.asistencia').length > 0) {
					$('.asistencia').after(html);
				} else {
					$detalleGastos.append(html);
				}
			}
			if (precioMaxCargosGestion > 0) {
				$detalleGastos.append('<li class="cargosGestion">Cargos de gestión '+garbaLabel+'<span>ARS '+number_format(precioMaxCargosGestion)+'</span></li>');
				if (coeficienteDescuento > 0) {
					$detalleGastos.append('<li class="descuento">Descuento ('+((coeficienteDescuento * 100).toFixed(2))+' %)<span>- ARS '+number_format(precioDescuento)+'</span></li>');
				}
			}
			if (bonificacion > 0) {
				$detalleGastos.append('<li class="bonificacion">Bonificación promoción '+garbaLabel+'<span>ARS -'+number_format(bonificacion)+'</span></li>');
			}
			if (true==uatp) {
				$totalUATP = parseFloat($('#TotalAmount').val()) + parseFloat(intereses);
				$('.total li span').html('ARS '+number_format($totalUATP));
			} else {
				$('.total li span').html('ARS '+number_format(precioFinalRedondeado));
			}
		}
	);
}

/* http://krijnhoetmer.nl/stuff/javascript/number-format/script.js
 *	a = importe
 *	b = cantidad de decimales
 *	c = separador de decimales
 *	d = separador de miles
 */
function number_format(a, b, c, d) {
	var b = (b) ? b : 2;
	var c = (c) ? c : '.';
	var d = (d) ? d : ',';
	var a = Math.round(a * Math.pow(10, b)) / Math.pow(10, b);
	var e = a + '';
	var f = e.split('.');
	if (!f[0]) {
		f[0] = '0';
	}
	if (!f[1]) {
		f[1] = '';
	}
	if (f[1].length < b) {
		g = f[1];
		for (i=f[1].length + 1; i <= b; i++)
		{
			g += '0';
		}
		f[1] = g;
	}
	if (d != '' && f[0].length > 3) {
		h = f[0];
		f[0] = '';
		for(j = 3; j < h.length; j+=3) {
			i = h.slice(h.length - j, h.length - j + 3);
			f[0] = d + i +  f[0] + '';
		}
		j = h.substr(0, (h.length % 3 == 0) ? 3 : (h.length % 3));
		f[0] = j + f[0];
	}
	c = (b <= 0) ? '' : c;
	return f[0] + c + f[1];
}