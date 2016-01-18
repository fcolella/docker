@extends('booking.master')

@section('main')
@if ($testuser == true)
	<input type="button" name="booking_up" 				value="  &uarr;  "				class="btn btn-danger booking_up">
	<input type="button" name="booking_autocompletar" 	value=" Autocompletar "			class="btn btn-danger booking_autocompletar">
	<input type="button" name="booking_down" 			value="  &darr;  "              class="btn btn-danger booking_down">
@endif
	<div class="clear margen">&nbsp;</div>
	<div class="container container_12">
		<div class="grid_8 alpha ui-corner-all blanco formWrapper" role="content">
			<div class="loadingWrapper top-40 grid_8 txt-centrado">
				<img src="{{ $STATICS }}images/loading.gif">
			</div>

			<form      method="post" name="booking"             id="booking"            action="{{ $FormAction }}"  class="booking hidden"  enctype="multipart/form-data">
				<input type="hidden" name="TotalAmount"         id="TotalAmount"        value={{ $totalAmount }}>
				<input type="hidden" name="selectedBank"        id="selectedBank"       value="">
	            <input type="hidden" name="data-pago"           id="data-pago"          value="">
	            <input type="hidden" name="precioFinal"         id="precioFinal"        value="">
	            <input type="hidden" name="intereses"           id="intereses"          value="">
	            <input type="hidden" name="bonificacion"        id="bonificacion"       value="">
	            <input type="hidden" name="maxCargosGestion"    id="maxCargosGestion"   value="">
	            <input type="hidden" name="descCargosGestion"   id="descCargosGestion"  value="">
	            <input type="hidden" name="coefDescuento"       id="coefDescuento"      value="">

				<div id="form-left" class="grid_8 formulario">
					<h1>{{ $title }}</h1>

					@include('booking.steps')
					@include('booking.pagos')
				@foreach($includes['main'] as $include)
					@include($include)
				@endforeach

					<div class='grid_5'>
						<h3>Pagá ahora con tu tarjeta de crédito</h3>
					</div>
					<input class="submit-btn grid_3 submit" type="button" value="Continuar" id="submit_form" />
					<span class="nota"><span class="rojo">*</span> Los campos marcados con un asterisco son obligatorios.</span>
					<div class="clear margen">&nbsp;</div>
				</div>
			</form>
		</div>

		<div class="grid_4 alpha omega right-bar ui-corner-all" role="content">
			<div class=" price-data">
				<div class="int">
				@foreach($includes['sidebar'] as $include)
					@include($include)
				@endforeach
					<div class="clear margen">&nbsp;</div>
				@if (!empty($cambio) && $cambio!=1)
					<span>Importes expresados en Pesos Argentinos (ARS)<br>Tipo de cambio $USD =  {{ $cambio }}</span>
				@endif
				</div>
			</div>
		</div>

		<div class="grid_4 alpha omega op-segura ui-corner-all" role="content">
			<div class="grid_4 int"><img alt="Secure" src="{{ $STATICS }}images/lock.png" align="absmiddle"> Estás operando de manera segura
			<div class="clear margen">&nbsp;</div>
			Tus datos están protegidos <img alt="Secure2" src="{{ $STATICS }}images/security.jpg" align="absmiddle">
			</div>
		</div>

	</div>
	<div class="clear margen">&nbsp;</div>
@stop