	<form id="form-cruceros"  method="get" class="busqueda grid_5 alpha omega" >

        
        <div class="form_selector grid_5 alpha">

            <div class="grid_5">
                <label for="origen" class="encontrar_origen grid_4 alpha">
                    Destino:
                </label>
                 <select class="grid_ selectdestino" name="destino" id="crucerosDestino">
                    <option selected="selected" value="0">Elegir destino...</option>
                                            <option value="3" >Europa (Norte)</option>
                                            <option value="4" >America del Sur</option>
                                            <option value="6" >Mediterraneo</option>
                                            <option value="11" >Transatlánticos</option>
                                    </select>
                <span class="formError rojo origen error rojo grid_4 alpha" for="origen" style="display:none">Campo obligatorio</span>

			</div>

            <div class="grid_5">
                <label for="periodo" class="grid_4 alpha">
                    Per&iacute;odo:
                </label>

				<select class="grid_5  selectPeriodo" name="periodo" id="crucerosPeriodo">
					<option value="0" selected="true">Todos</option>
											<option value="12_2015" >Diciembre 2015</option>
											<option value="1_2016" >Enero 2016</option>
											<option value="2_2016" >Febrero 2016</option>
											<option value="3_2016" >Marzo 2016</option>
											<option value="4_2016" >Abril 2016</option>
											<option value="5_2016" >Mayo 2016</option>
											<option value="6_2016" >Junio 2016</option>
											<option value="7_2016" >Julio 2016</option>
											<option value="8_2016" >Agosto 2016</option>
											<option value="9_2016" >Septiembre 2016</option>
											<option value="10_2016" >Octubre 2016</option>
											<option value="11_2016" >Noviembre 2016</option>
											<option value="12_2016" >Diciembre 2016</option>
									</select>
                <span class="formError rojo fecha_desde error rojo grid_4 alpha" for="fecha_desde" style="display:none">Campo obligatorio</span>

			</div>

            <div class="grid_5">
                <label for="compania" class="grid_4 alpha">
                    Compa&ntilde;ia
                </label>

				<select class="grid_5 selectCompania" name="compania" id="crucerosCompania">
					<option selected="selected" value="0">Todas</option>
				</select>
                <span class="formError rojo fecha_desde error rojo grid_4 alpha" for="fecha_desde" style="display:none">Campo obligatorio</span>

			</div>

            <div class="clear">&nbsp;</div>


            <div class="grid_5">
				<div class="form_selector grid_5 alpha">
                    <div class="grid_1 alpha">
                        <label class="grid_1 alpha">Adultos</label>
                        <select class="grid_1 alpha selectAdultos" name="adultos" id="crucerosCantidadAdultos">
                                                            <option value="1" >1</option>
                                                            <option value="2" selected="true">2</option>
                                                            <option value="3" >3</option>
                                                            <option value="4" >4</option>
                            
                        </select>
                    </div>
                    <div class="grid_1 alpha">
                        <label class="grid_1 alpha">Ni&ntilde;os</label>
                        <select class="grid_1 alpha selectMenores" name="ninos" id="crucerosCantidadMenores">
                                                            <option value="0" selected="true">0</option>
                                                            <option value="1" >1</option>
                                                            <option value="2" >2</option>
                                                            <option value="3" >3</option>
                                                            <option value="4" >4</option>
                            
                        </select>
                    </div>
                </div>



			





                <div class="NuevoComboEdad" style="display:none;">
                    <div class="grid_4 alpha menores-edad">
                        <label class="grid_2 alpha container_nombre">Edad ni&ntilde;o <span class="childLabelNumber">1</span><span class="rojo">*</span></label>
                        <div class="clear">&nbsp;</div>
                        <select class="grid_1  edad-menor">
                            <option value="-">-</option>
                                                          <option value="0">0</option>
                                                          <option value="1">1</option>
                                                          <option value="2">2</option>
                                                          <option value="3">3</option>
                                                          <option value="4">4</option>
                                                          <option value="5">5</option>
                                                          <option value="6">6</option>
                                                          <option value="7">7</option>
                                                          <option value="8">8</option>
                                                          <option value="9">9</option>
                                                          <option value="10">10</option>
                                                          <option value="11">11</option>
                                                          <option value="12">12</option>
                                                          <option value="13">13</option>
                                                          <option value="14">14</option>
                                                          <option value="15">15</option>
                                                          <option value="16">16</option>
                                                          <option value="17">17</option>
                                                    </select>
                        <div style="clear:both"></div>
                        <div class="formError rojo edad-menor" style="display:none;">Campo obligatorio</div>
                    </div>
                </div>
			</div>
		
		
		<div class="container_hijos grid_2">
			<dl class="grid_4 alpha">
											</dl>
		</div>
            <div class="clear margen">&nbsp;</div>
           <input type="button" class="submitButton reservar_btn grid_2 der" value="Buscar">
		
		</div>


        <div class="clear margen">&nbsp;</div>
</form>