@foreach ($search['passengers'] as $key => $traveler)
	<div class="grid_7 ocupant pasajero ui-corner-all">
		<span class="indicador grid_6 ">Pasajero {{ $key+1 }} ({{ $traveler }} @if ($traveler!=1) años @else año @endif)</span>
		<div class="grid_3 alpha">
			<label>Nombres <span class="rojo">*</span></label>
			<input maxlength='255' name="traveler[{{ $key }}][nombre]" id="nombre_{{ $key }}" type="text" title="Nombre completo como figura en el DNI" class="grid_3 required" placeholder='Nombre completo como figura en el DNI'>
			<span class="formError vacio msje-error rojo grid_3 ">Campo Obligatorio</span>
		</div>

		<div class="grid_3  omega">
			<label>Apellidos <span class="rojo">*</span></label>
			<input maxlength='255' name="traveler[{{ $key }}][apellido]" id="apellido_{{ $key }}" type="text" class="grid_3 required" placeholder='Apellido completo como figura en el DNI'>
			<span class="formError vacio msje-error rojo grid_3">Campo Obligatorio</span>
		</div>
		<div class="clear margen">&nbsp;</div>

		<div class="left alpha rango fechas">
			<input type="hidden" class="returnDate" value="{{ $topYear }}">
			<input type="hidden" class="edadThisPax" value="{{ $traveler }}">
			<label>Nacimiento <span class="rojo">*</span></label>
			<div class="grid_1 alpha select-dia">
				<select class="selectpicker grid_1 requerido dia" name="traveler[{{ $key }}][dia_nac]">
					<option selected="true" value="">Día</option>
					@for ($days=1; $days<=31;$days++)
					<option value="{{ $days }}">{{ $days }}</option>
					@endfor
				</select>
			</div>
			<div class="grid_2 select-mes">
				<select class="selectpicker grid_2 requerido mes" name="traveler[{{ $key }}][mes_nac]">
					<option value="">Mes</option>
					@foreach ($Months as $key_month => $month)
					<option data-dias="{{ $month['dias'] }}" value="{{ $key_month }}">{{ $month['nombre'] }}</option>
					@endforeach
				</select>
			</div>
			<div class="grid_2 select-anio">
				<select class="selectpicker grid_1 requerido anio" name="traveler[{{ $key }}][anio_nac]">
					<option value="">Año</option>
					@for ($years=$currentYear; $years>=($currentYear-$topYear); $years--)
					@if ($years==($currentYear-$traveler)-1)
					<option value="{{ $years }}" selected>{{ $years }}</option>
					@else
					<option value="{{ $years }}">{{ $years }}</option>
					@endif
					@endfor
				</select>
			</div>
		</div>

		<div class="left alpha omega vacio fechaVacio rojo msje-error" style="display:none;">Debe completar día, mes y año de nacimiento</div>
		<div class="left fechaNoValida rojo msje-error" style="display:none;">La fecha ingresada es inexistente</div>
		<div class="fechaFueraDeRango left alpha omega rojo msje-error" style="display:none; ">La fecha no corresponde a la edad de la persona requerida</div>
		<div class="clear margen">&nbsp;</div>

		<div class="grid_2 alpha">
			<label>Tipo de Documento<span class="rojo">*</span></label>
			<select class="selectpicker grid_2 requerido" name="traveler[{{ $key }}][tipoDocumento]">
				<option value="PASSPORT">Pasaporte</option>
				<option value="DNI">DNI</option>
			</select>
		</div>

		<div class="grid_3 alpha">
			<label>Número <span class="rojo">*</span></label>
			<input maxlength='32' type="text" class="grid_3  required" name="traveler[{{ $key }}][numeroDocumento]" placeholder='Número del documento seleccionado'>
			<span class="formError vacio msje-error rojo grid_3">Campo Obligatorio</span>
		</div>
		<div class="clear margen">&nbsp;</div>

	</div>
@endforeach
<div class="clear margen">&nbsp;</div>