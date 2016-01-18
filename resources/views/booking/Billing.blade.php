	<br>
	<h2>Datos de facturaci&oacute;n</h2>
	<div class="grid_3 alpha">
		<label>Provincia <span @if (!$datosVendedor)class="rojo" @endif >*</span></label>
		<select class="selectpicker grid_3 @if (!$datosVendedor) requerido @endif provincia" name="provincia" @if (!$datosVendedor) id="provincia" @endif>
			<option value="-">Seleccion&aacute; tu provincia</option>
			@foreach ($States as $State)
			<option value="{{ $State->code }}">{{ $State->name }}</option>
			@endforeach
		</select>
		<span class="msje-error rojo grid_6">Campo Obligatorio</span>
		<input type="hidden" name="stateName" value=""/>
	</div>

<div class="billing">
	<div class="grid_3">
		<label>Localidad <span @if (!$datosVendedor) class="rojo" @endif >*</span></label>
		<div class="grid_3 select-autocomplete-wrap">
			<input type="text" placeholder='Seleccioná tu localidad...' id="localidad" name="localidad" class="grid_3 alpha select-autocomplete disabled @if (!$datosVendedor) required @endif localidad" disabled="disabled" data-source="{{ $CitiesAutocomplete }}">
			<span class="msje-error rojo grid_6 alpha">Campo Obligatorio</span>
			<a class="suggest-icons reserva {$osName}"></a>
			<input type="hidden" class="successResult matchedCity" name="matchedCity" value="0"/>
			<input type="hidden" name="localityCode" value=""/>
			<input type="hidden" name="subdivision" value=""/>
			<input type="hidden" name="zipCode" value=""/>
		</div>
	</div>
	<div class="clear margen"> </div>
	<div class="grid_3 top">
		<label class="alpha">Domicilio <span @if (!$datosVendedor) class="rojo" @endif >*</span></label>
		<input type="text" class="col-md-12 @if (!$datosVendedor) required @endif domicilio" name="domicilio" @if (!$datosVendedor) id="domicilio" @endif placeholder='Domicilio de facturación'>
		<span class="msje-error rojo grid_2 alpha">Campo Obligatorio</span>
	</div>

	<div class="grid_1 top">
		<label class="alpha">Altura <span @if (!$datosVendedor) class="rojo" @endif >*</span></label>
		<input type="text" class="col-md-12 @if (!$datosVendedor) required @endif altura" name="altura" @if (!$datosVendedor) id="altura" @endif placeholder='Altura'>
		<span class="msje-error rojo grid_2 alpha">Campo Obligatorio</span>
	</div>

	<div class="grid_1 top">
		<label class="alpha">Piso</label>
		<input type="text" class="col-md-12 piso" name="piso" @if (!$datosVendedor) id="piso" @endif placeholder='Opcional'>
	</div>

	<div class="grid_1 top">
		<label class="alpha">Depto</label>
		<input type="text" class="col-md-12 depto" name="depto" @if (!$datosVendedor) id="depto" @endif placeholder='Opcional'>
	</div>
	<div class="clear margen">&nbsp;</div>

	<div class="grid_2 alpha">
		<label>Clave de identificación<span class="rojo">*</span></label>
			<select class="selectpicker grid_2" name="clave">
			<option value="CUIL">CUIL</option>
			<option value="CUIT">CUIT</option>
		</select>
		<div class="msje-error grid_2" style="display:none">Campo obligatorio</div>
	</div>

	<div class="grid_3">
		<label>Número <span @if (!$datosVendedor) class="rojo" @endif>*</span></label>
		<input placeholder='Número de CUIT/CUIL sin guiones' maxlength="11" class="grid_4 cuil @if (!$datosVendedor) required @endif" type="text" name="cuil" @if (!$datosVendedor)id="cuil" @endif value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
		<div class="msje-error rojo grid_6" style="display:none">Campo obligatorio</div>
		<div class="formError formato grid_3 hidden rojo msje-error">Ingrese un CUIL/CUIL v&aacute;lido</div>
	</div>
	<div class="clear margen">&nbsp;</div>
</div>