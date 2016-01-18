<div class="contact">
	<br>
	<h2>Datos de Contacto</h2>
	<input type="hidden" class="vendedor" value="@if (!$datosVendedor) 1 @else 0 @endif">
	<label>Email <span @if (!$datosVendedor) class="rojo" @endif>*</span></label>
	<input type="text" placeholder="Correo electrónico donde te enviaremos el voucher" name="email" class="grid_6 mailContacto @if (!$datosVendedor) required @endif email" @if (!$datosVendedor) id="email" @endif value="" />
	<div class="msje-error email_vacio rojo grid_6" style="display:none;">Campo obligatorio</div>
	<div class="formError email formato rojo grid_6" style="display:none;">Formato no válido</div>
	<div class="clear margen">&nbsp;</div>

	<label>Teléfono <span @if (!$datosVendedor) class="rojo" @endif>*</span></label>
	<input placeholder='Teléfono de contacto' type="text" class="@if (!$datosVendedor) required @endif telContacto grid_6" name="telefono" id="telefono" value="" />
	<div class="msje-error telContactoError rojo grid_6" style="display:none">Campo obligatorio</div>
	<div class="clear margen">&nbsp;</div>

	<label>Comentarios <span class="rojo">*</span></label>
	<textarea name="comentarios" class="grid_6 " rows="5" cols="5" style="width:74.5% !important"></textarea>
	<span class="msje-error rojo grid_6">Campo Obligatorio</span>
	<div class="clear margen">&nbsp;</div>

	<div class="grid_6 terms">
		<input type="checkbox" id="terms" name="condiciones" class="required">
		He leido y acepto las <a href="http://www.garbarinoviajes.com.ar/hoteles-box/condiciones-hoteles.php" target="_blank">condiciones de reserva <span class="rojo">*</span></a><br>
		<span class="formError vacio msje-error rojo grid_6" >Debe aceptar los términos y condiciones para continuar</span>
	</div>
	<div class="clear margen">&nbsp;</div>
</div>