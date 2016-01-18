<div class="emergency">
	<h2>Contacto de emergencia (A quien podemos llamar cuando esés en viaje?)</h2>
	<div class="grid_3 alpha">
		<label>Nombre <span class="rojo">*</span></label>
		<input type="text" name="emergencyContactsInfo[name]" title="Nombre completo como figura en el DNI" class="grid_3 required emergencyName" placeholder="Nombre completo como figura en el DNI">
		<span class="msje-error emergencyNameError rojo grid_3">Campo Obligatorio</span>
	</div>

	<div class="grid_3  omega">
		<label>Apellido <span class="rojo">*</span></label>
		<input type="text" name="emergencyContactsInfo[lastname]" class="grid_3 required emergencyLastName" placeholder="Apellido completo como figura en el DNI">
		<span class="msje-error emergencyLastNameError rojo grid_3">Campo Obligatorio</span>
	</div>

	<label>Teléfono <span class="rojo">*</span></label>
	<input name="emergencyContactsInfo[phone]" type="text" class="grid_6 required emergencyPhone" placeholder="Teléfono de contacto">
	<span class="msje-error emergencyPhoneError rojo grid_6">Campo Obligatorio</span>
	<div class="clear margen">&nbsp;</div>
</div>