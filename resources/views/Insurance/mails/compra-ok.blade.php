<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>CONFIRMACIÓN DE COMPRA</title>
</head>

<body>
	<div style="font-family:Arial, Helvetica, sans-serif; width:900px; color:#333">
	<table>	
		<tr>
			<td width="700" align="center">
				<span style="color:#00B0F0; font-size:18px; font-weight:bold;">CONFIRMACIÓN DE COMPRA</span>
			</td>
			<td>
				<img src="{{ $STATICS }}images/garbarino-viajes-logo.png">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div style="padding-bottom:30px;">
					<span style="color:#00B0F0; font-size:18px; font-weight:bold;">Asistencia al Viajero con destino {{ mb_convert_case($search['destination'],MB_CASE_TITLE,'UTF-8') }}</span>
				</div>	
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<span style="font-weight:bold;">Estimado/a {{ $paxLead }}:</span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div style="padding-bottom:15px; padding-top:15px; border-bottom: 1px solid #444;">
					<table style="margin-bottom: 30px">
					
						<tr>
							<td>
								<img width="11" height="12" src="{{ $STATICS }}images/check-05.png">
							</td>
							<td>
								Tu Asistencia se ha confirmado y el código de referencia es <b>{{ $product['bookingId'] }}</b>. Puedes usarlo para cualquier consulta que quieras realizar.
							</td>
						</tr>
						<tr>
							<td>
								<img width="11" height="12" src="{{ $STATICS }}images/check-05.png">
							</td>
							<td>
								Es posible que para <b>autorizar tu compra</b> el banco o la tarjeta de crédito soliciten información adicional para protegerte de fraudes. En ese caso uno de nuestros acesores se comunicará al mail o teléfono que nos proporcionaste.
							</td>
						</tr>
						<tr>
							<td>
								<img width="11" height="12" src="{{ $STATICS }}images/check-05.png">
							</td>
							<td>
								Una vez procesado tu pago recibirás un e-mail con el voucher del servicio contratado.
							</td>
						</tr>
						<tr>
							<td>
								<img width="11" height="12" src="{{ $STATICS }}images/check-05.png">
							</td>
							<td>
								En caso de necesitar mayor información, podás comunicarte de 9 a 21 hs, al (011) 4787-7093 con tu código de referencia.
							</td>
						</tr>
                        <tr>
                            <td>
                                <img width="11" height="12" src="{{ $STATICS }}images/check-05.png">
                            </td>
                            <td>
                                Los vouchers serán enviados a tu correo electrónico dentro de las 48hs de confirmada la compra.
                            </td>
                        </tr>
					</table>
				</div>	
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div style="padding-top:15px;">
					<span style="font-weight:bold; text-decoration:underline;">Datos de los pasajeros</span>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div style="padding-bottom:15px; border-bottom: 1px solid #444;">
					<table>
					@foreach($form['traveler'] as $key => $pax)
                        <tr>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
						<tr>
							<td width="200">
								<b>Nombre y Apellido:</b>
							</td>
							<td>
								{{ $pax['nombre'] }} {{ $pax['apellido'] }}
							</td>
						</tr>
						<tr>
							<td>
								<b>Fecha de nacimiento:</b>
							</td>
							<td>
								{{ $pax['dia_nac'] }}/{{ $pax['mes_nac'] }}/{{ $pax['anio_nac'] }}
							</td>
						</tr>
						<tr>
							<td>
								<b>Documento {{ $pax['tipoDocumento'] }}:</b>
							</td>
							<td>
								{{ $pax['numeroDocumento'] }}
							</td>
						</tr>
					@endforeach
					</table>
				</div>
			</td>
		</tr>
			<tr>
                <td colspan="2">
                    <div style="padding-top:15px;">
                        <span style="font-weight:bold; text-decoration:underline;">Contacto de emergencia</span>
                    </div>
                </td>
			</tr>
			<tr>
				<td colspan="2">
					<div style="padding-top:15px; padding-bottom:15px; border-bottom: 1px solid #444;">
						<table>
							<tr>
								<td width="200">
									<b>Nombre:</b>
								</td>
								<td>
									{{ $form['emergencyContactsInfo']['name'] }} {{ $form['emergencyContactsInfo']['lastname'] }}
								</td>
							</tr>
							<tr>
								<td>
									<b>Teléfono:</b>
								</td>
								<td>
									{{ $form['emergencyContactsInfo']['phone'] }}
								</td>
							</tr>
						</table>
					</div>
				</td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="padding-top:15px;">
                        <span style="font-weight:bold; text-decoration:underline;">Datos de facturación</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="padding-top:15px; padding-bottom:15px; border-bottom: 1px solid #444;">
                        <table>
                            <tr>
                                <td width="200">
                                    <b>Provincia:</b>
                                </td>
                                <td>
                                    {{ $form['stateName'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Localidad:</b>
                                </td>
                                <td>
                                    {{ $form['localidad'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Domicilio:</b>
                                </td>
                                <td>
                                    {{ $form['domicilio'] }} {{ $form['altura'] }} {{ $form['piso'] }} {{ $form['depto'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>{{ $form['clave'] }}:</b>
                                </td>
                                <td>
                                    {{ $form['cuil'] }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="padding-top:15px;">
                        <span style="font-weight:bold; text-decoration:underline;">Datos de contacto</span>
                    </div>
                </td>
            </tr>
			<tr>
                <td colspan="2">
                    <div style="padding-bottom:15px; padding-top:15px; border-bottom: 1px solid #444;">
                        <table>
                            <tr>
                                <td width="200">
                                    <b>E-mail:</b>
                                </td>
                                <td>
                                    {{ $form['email'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Teléfono:</b>
                                </td>
                                <td>
                                    {{ $form['telefono'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Comentarios:</b>
                                </td>
                                <td>
                                    @if (strlen($form['comentarios'])>0){{ $form['comentarios'] }} @else - @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="padding-top:15px;">
                        <span style="font-weight:bold; text-decoration:underline;">Detalle de la compra</span>
                    </div>
                </td>
            </tr>
<?php
$taxesMail  = $product['purchasedPlans'][0]['insuranceTotalPrices']['requestedSellingPrice']['afterTax'] - $product['purchasedPlans'][0]['insuranceTotalPrices']['requestedSellingPrice']['beforeTax'];
$currency   = $product['purchasedPlans'][0]['insuranceTotalPrices']['requestedPromotionalPrice']['currency'];
?>
            <tr>
                <td colspan="2">
                    <div style="padding-bottom:15px; padding-top:15px;">
                        <table id="planDetail">
                            <tr>
                                <td>
                                    <b>Nombre del Plan:</b> {{ $product['purchasedPlans'][0]['insurancePlan']['name'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td width="200">
                                    {{ $product['coveredTravelersCount'] }} @if($product['coveredTravelersCount']>1)pasajeros @else pasajero @endif
                                </td>
                                <td>
                                    <b>{{ $currency }} {{ amountFormat($product['purchasedPlans'][0]['insuranceTotalPrices']['requestedSellingPrice']['beforeTax'],0) }}</b>
                                </td>
                            </tr>
                            @if ($taxesMail !=0)
                            <tr>
                                <td>
                                    Impuestos y gastos
                                </td>
                                <td>
                                    <b>{{ $currency }} {{ amountFormat($taxesMail,0) }}</b>
                                </td>
                            </tr>
                            @endif
                            @if ($form['intereses'] !=0)
                            <tr id="gastosRow">
                                <td width="350">
                                    Gastos financieros Garbarino Viajes S.A.
                                </td>
                                <td id="gastosTD">
                                    <b>{{ $currency }} {{ amountFormat($form['intereses'],0) }}</b>
                                </td>
                            </tr>
                            @endif
                            @if ($form['bonificacion'] !=0)
                            <tr id="bonifRow">
                                <td width="350">
                                    Bonificación promoción Garbarino Viajes S.A.
                                </td>
                                <td id="bonifTD">
                                    <b>{{ $currency }} -{{ amountFormat($form['bonificacion'],0) }}</b>
                                </td>
                            </tr>
                            @endif
                            @if ($form['maxCargosGestion'] !=0)
                            <tr id="maxCGRow">
                                <td>
                                    Cargos de Gestión
                                </td>
                                <td id="maxCGTD">
                                    <b>{{ $currency }} {{ amountFormat($form['maxCargosGestion'],0) }}</b>
                                </td>
                            </tr>
                            @endif
                            @if ($form['descCargosGestion'] !=0)
                            <tr id="descCGRow">
                                <td id="descCoefTD">
                                    Descuentos ({{ amountFormat($form['coefDescuento']*100,2) }} %)
                                </td>
                                <td id="descCGTD">
                                    <b>{{ $currency }} -{{ amountFormat($form['descCargosGestion'],0) }}</b>
                                </td>
                            </tr>
                            @endif
                            <tr id="totalRow">
                                <td>
                                    <b>Total</b>
                                </td>
                                <td id="totalTD">
                                    <b>{{ $currency }} {{ amountFormat($totalAmount,0) }}</b>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            @if ("" != $creditCardName)
            <tr>
                <td colspan="2">
                    <b>Medio de pago</b><br>
                    <img id="creditCardImg" hspace="0" align="absmiddle" height="25" width="40" alt="{{ $creditCardName }}" title="{{ $creditCardName }}" src="{{ $STATICS }}images/medios-de-pago/{{ $creditCardImage }}">
                    <span id="creditCardText">&nbsp;Tarjeta de crédito {{ $creditCardName }}, {{ $form['data-pago']['cuotas'] }} @if ($form['data-pago']['cuotas'] > 1) cuotas @else cuota @endif</span><br><br>
                </td>
            </tr>
            @endif
            <tr>
                <td colspan="2" style="border-bottom: 1px solid #444;">
                    <b>Inicio de la cobertura:</b><br>{{ dateFormat($search['dateFrom'],'d/m/Y') }}<br><br>
                    <b>Fin de la cobertura:</b><br>{{ dateFormat($search['dateTo'],'d/m/Y') }}<br><br>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 10px;">
                    <span style="font-weight:bold; color:#00B0F0;font-family:Arial, Helvetica, sans-serif;font-size:13px">Gracias por viajar con nosotros!</span>
                </td>
            </tr>
		</table>
	</div>
	<br><br><br>
	@include('mails/firma-mails-compra')
	[RefID: {{ $product['bookingId'] }}]<br>
</body>
</html>