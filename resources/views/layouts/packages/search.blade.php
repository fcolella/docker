		<form action="" method="post" autocomplete="off" class="busqueda grid_5 alpha omega" id="form-paquetes">
            
			<div class="form_selector grid_5 alpha">

                <input type="hidden" class="isListado" value="0"/>

                <div class="grid_5">
                    <label for="origen" class="encontrar_origen col-md-10 alpha">Origen:</label>
                    <select name="origen" id="origen" class="col-md-10 origen" >
                        <option value="">Seleccione ciudad de origen</option>
                                            </select>
                    <span class="error rojo col-md-12 alpha" id="error_origen" style="display:none">Campo obligatorio</span>
                    <input type="hidden" id="origenCodSel" value=""/>
                </div>

				
				<div class="grid_5 destinoWrap">
					<label for="destino" class="encontrar_destino col-md-10 alpha">Destino:</label>
                    <input type="text" value="" placeholder='Ingres&aacute; tu destino...' id="destino" name="destino" class="destino col-md-9 " disabled="disabled" style="color: black;">
                    <a class="suggest-icons  Unknown"></a>
                    <span class="error rojo grid_4 alpha msje-error" id="error_destino" style="display:none">Campo obligatorio</span>
                    <input type="hidden" id="destinoCodSel" value=""/>
                    <input type="hidden" id="destinoSel" value=",  ()"/>
				</div>


				<div class="grid_4">
				
						<div class="grid_2 alpha">
							
							<label for="fechaSalida" class="encontrar_fechaSalida col-md-12 alpha">
								Per&iacute;odo de viaje:
							</label>
							
							<select name="periodoViaje" class="col-md-12 alpha " id="periodoViaje" disabled="disabled">
                                                                <option value="">-</option>
                                							</select>

                            <input type="hidden" id="periodoViajeSel" value=""/>

							<span class="error grid_2 rojo alpha msje-error" id="error_periodoViaje" style="display:none">Campo obligatorio</span>
						
						</div>

				</div>
				<div class="clear">&nbsp;</div>
				
				<div class="grid_5">
					
					
					<div class="grid_1 alpha">
						<label for="habitaciones" class="grid_1 alpha">
                            Habitaciones
						</label>
					
						<select name="select_habitaciones" class="grid_1 alpha" id="select_habitaciones" >
							<option value="1" >1</option>
							<option value="2" >2</option>
							<option value="3" >3</option>
							<option value="4" >4</option>
							<option value="5" >5</option>
						</select>
					</div>




                    

                    <div class="grid_3 habitacion alpha  first">

                        <div class="grid_1 alpha">
                            <div class="clear margen">&nbsp;</div>
                            <div class="clear margen">&nbsp;</div>
                            <div class="clear margen">&nbsp;</div>
                            <label class="grid_1 alpha txt-der title">Hab. 1:</label>
                        </div>

                        <div class="grid_1">
                            <label for="adultos" class="encontrar_adultos grid_1 alpha">
                                Adultos
                            </label>

                            <select name="habitaciones[0][adultos]" class="grid_1 alpha adultos" >
                                <option value="1">1</option>
                                <option value="2" selected="selected">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="grid_1 omega ">
                            <label for="menores" class="encontrar_menores grid_1 alpha">
                                Ni&ntilde;os
                            </label>
                            <select class="grid_1 alpha select_menores" id="select_menores_0" >
                                <option value="0" selected="selected">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="encontrar_edadNinos grid_3 alpha">
                            <div class="grid_3"></div>
                            <label class="error rojo error_edadmenores no-margin txt-der" style="display:none;">Campo obligatorio</label>
                        </div>



                    </div>




                    

					
				</div>
				
				<div class="clear margen">&nbsp;</div>
				<div class="grid_5 alpha">
				<input type="button" class="boton calcular reservar_btn grid_2 der alpha" id="btn_buscar" value="Buscar" />
				</div>
			</div>
			<div class="clear margen">&nbsp;</div>
		</form>