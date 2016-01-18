<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>CONFIRMACIÓN DE COMPRA</title>
</head>

<body>
	<div class="grid_8 alpha ui-corner-all blanco formulario">

	    <div class="clear margen">&nbsp;</div>
	    <div class="clear margen">&nbsp;</div>

	    <div class="grid_8 txt-centrado">
	        <h1 class="margin_30"><img hspace="5px" align="absmiddle" src="{{ $STATICS }}images/ok_grande.png" alt="ok">
	            Tu @if ($form['ownCredit']) reserva @else compra @endif ha sido realizada con éxito</h1>
	    </div>

	    <div class="clear margen">&nbsp;</div>
	    <div class="clear margen">&nbsp;</div>

	    <ul id="checklist" class="grid_6 push_medio">
		@if ($form['ownCredit'])
	        <li>Tu reserva ha sido realizada con éxito! Uno de nuestros asesores se pondrá en contacto contigo para gestionar el cobro de la misma.</li>
	        <li>El voucher será enviado a tu correo electrónico dentro de las 48hs de confirmada la compra.</li>
	        <li>La reserva está sujeta a vencimiento, cambios y/o modificaciones hasta que se realice el pago y emisión del voucher.</li>
	        <li>Por cualquier duda podes comunicarte con nosotros al (011) 4787-7093 de 9 a 21hs, indicando el código de confirmación: <b>{{ $product['bookingId'] }}</b>.</li>
		@else
	        <li>Tu Asistencia se ha confirmado y el código de referencia es el: <b>{{ $product['bookingId'] }}</b>. Puedes usarlo para cualquier consulta que quieras realizar.</li>
	        <li>Es posible que para <b>autorizar tu compra</b> el banco o la tarjeta de crédito soliciten información adicional para protegerte de fraudes. En ese caso uno de nuestros acesores se comunicará al mail o teléfono que nos proporcionaste.</li>
	        <li>Una vez procesado tu pago recibirás un e-mail con el voucher del servicio contratado.</li>
	        <li>En caso de necesitar mayor información, podás comunicarte de 9 a 21 hs, al (011) 4787-7093 con tu código de referencia.</li>
		@endif
	    </ul>

	    <div class="clear margen">&nbsp;</div>
	    <div class="clear margen">&nbsp;</div>

	    <div class="grid_7">

	        @if ($product['coveredTravelersCount'] > 1)
	            <h2>Datos de los pasajeros</h2>
	        @else
	            <h2>Datos del pasajero</h2>
	        @endif

			@foreach($form['traveler'] as $key => $pax)
	            <span class="grid_8 blue top"><b>Pasajero {{ $key }}</b></span>
	            <div class="pasajero ui-corner-all grid_6">
	                <ul>
	                    <li>Nombre y Apellido: <span class="blue">{{ $pax['nombre'] }} {{ $pax['apellido'] }}</span></li>
	                    <li>Fecha de nacimiento: <span class="blue">{{ $pax['dia_nac'] }}/{{ $pax['mes_nac'] }}/{{ $pax['anio_nac'] }}</span></li>
	                    <li>Tipo y número de Documento: <span class="blue">{{ $pax['tipoDocumento'] }} {{ $pax['numeroDocumento'] }}</span></li>
	                </ul>
	            </div>
	        @endforeach
	    </div>

	    <div class="clear margen">&nbsp;</div>
	    <div class="clear margen">&nbsp;</div>

	    <div class="grid_8 contactData">
	        <h2>Contacto de emergencia</h2>

	        <ul class="grid_7">
	            <li>Nombre: <span class="blue">{{ $form['emergencyContactsInfo']['name'] }} {{ $form['emergencyContactsInfo']['lastname'] }}</span></li>
	            <li>Tel&eacute;fono: <span class="blue">{{ $form['emergencyContactsInfo']['phone'] }}</span></li>
	        </ul>
	    </div>

	    <div class="clear margen">&nbsp;</div>
	    <div class="clear margen">&nbsp;</div>

	    <div class="grid_8 top contactData">
	        <h2>Datos de facturación</h2>

	        <ul class="grid_7">
	            <li>Domicilio: <span class="blue">{{ $form['domicilio'] }} {{ $form['altura'] }} {{ $form['piso'] }} {{ $form['depto'] }}</span></li>
	            <li>Localidad: <span class="blue">{{ $form['localidad'] }}</span></li>
	            <li>{{ $form['clave'] }}: <span class="blue">{{ $form['cuil'] }}</span></li>
	        </ul>
	    </div>

	    <div class="clear margen">&nbsp;</div>
	    <div class="clear margen">&nbsp;</div>

	    <div class="grid_8 top contactData">
	        <h2>Datos de contacto</h2>

	        <ul class="grid_7">
	            <li>E-mail: {{ $form['email'] }} <span class="blue">(La confirmación de reserva se enviará a este e-mail)</span></li>
	            <li>Teléfono: <span class="blue">{{ $form['telefono'] }}</span></li>
	        </ul>
	    </div>

	    <div class="clear margen">&nbsp;</div>
	    <div class="clear margen">&nbsp;</div>

	    @if (strlen($form['comentarios'])>0)
	    <div class="grid_8 top">
	        <h2>Comentarios</h2>
	        <p class="grid_7">{{ $form['comentarios'] }}</p>
	    </div>
	    @endif

	    <div class="clear margen">&nbsp;</div>
	    <div class="clear margen">&nbsp;</div>

	</div>
</body>
</html>