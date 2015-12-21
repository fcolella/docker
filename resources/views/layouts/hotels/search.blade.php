	<form id="hotel-busqueda" action="hoteles-listado.php" method="get" class="busqueda grid_5 alpha omega home">

            
            			                <div class="grid_5">
                    <label class="grid_2 alpha">Destino</label>
                    <input type="text" value="" placeholder='Ingres&aacute; la ciudad...'   name="origen" class="col-md-12 origen origenI">
                </div>

				<div style="display:none;" class="formError rojo origen_error grid_5 " for="origen">Campo obligatorio</div>
				<div style="display:none;" class="rojo origen_error no_city  grid_5 " for="origen">Ciudad inexistente</div>
	
				<div class="grid_2">
					<label class="grid_2 alpha entrada">Entrada</label>
					<input type="text" readonly="readonly" name="fecha_desde" class="col-md-10 alpha input_fecha fecha_desde calendar " value="" placeholder="Entrada al hotel"/>
					<div class="formError rojo fecha_desde_error grid_2 alpha " for="fecha_desde" style="display: none;">Campo obligatorio</div>
				</div>
													
				<div class="grid_2">
                    <label  class="col-md-3 alpha salida">Salida</label>
                    <label class="cant-noches col-md-5 txt-der"></label>
                    <div class="clear">&nbsp;</div>
					<input type="text" readonly="readonly" name="fecha_hasta" class="fecha_hasta col-md-10 alpha input_fecha calendar " value="" placeholder="Salida del hotel"/>
                    <div class="clear">&nbsp;</div>
                    <div class="formError rojo fecha_hasta_error grid_2 alpha" for="fecha_hasta" style="display: none;">Campo obligatorio</div>
				</div>
				
				
			<div class="clear margen">&nbsp;</div>
													
			
                            <div class="grid_2">
                    <input type="checkbox" name="noDate" value="1" id="noDateCheck"/>
                    <label for="noDateCheck" class="horiz-align inline">Todavía no he decidido la fecha</label>
                </div>
            
            <div class="clear margen">&nbsp;</div>
			
			<div class="grid_1 rooms">
			
				<div class="habitaciones-combo">
					<label  class="grid_1 alpha">Habitaciones</label>
					<div class="clear">&nbsp;</div>
					<select class=" required grid_1  select_habitaciones">
																		<option value="1">1</option>
																		<option value="2">2</option>
																		<option value="3">3</option>
																		<option value="4">4</option>
																		<option value="5">5</option>
											</select>
				</div>
			</div>


		
			
			<div class="NuevoComboEdad" style="display:none;">
					<li class="menores-edad"><label class="container_nombre col-md-12 alpha">Edad niño 1 <span class="rojo">*</span></label>
						<select class="edad-menor  grid_1 " >
							<option value="-" selected="selected">-</option>
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
                        <div class="clear">&nbsp;</div>
						<div class="formError rojo edad-menor grid_2 alpha" style="display: none;">Campo obligatorio</div>
					</li>	
			</div>




				<!-- -->
			<div class="habitacion grid_5 alpha omega hidden">

                    <div class="grid_1">&nbsp;</div>

					<label class="roomNumber grid_1 alpha"></label>

					<input type="hidden" class="roomId" value="1">
										<dl class="grid_1 alpha">
						<dt><label class="der">Adultos</label></dt>
						<dd><select class="pasajeros_mayores  required grid_1 " >
							<option value="1" >1</option>
							<option value="2"  selected="selected" >2</option>
							<option value="3" >3</option>
							<option value="4" >4</option>
							<option value="5" >5</option>
						</select></dd>
					</dl>
					<dl class="grid_1 alpha">
						<dt><label class="der">Niños</label></dt>
						<dd><select class="pasajeros_menores  grid_1 one">
							<option value="0" selected="selected">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
						</select></dd>
					</dl>
			
					
					<div class="container_hijos grid_1 ">
						<ul class="clonable ">
						</ul>
					</div>
			</div>
				<!-- -->
				
						

                <div class="habitacion first grid_4 alpha omega">
                    <label class="roomNumber grid_1 alpha omega">Hab. 1:</label>
                    <input type="hidden" class="roomId" value="1">
                    <dl class="grid_1 ">
                        <label class="grid_1 alpha omega">Adultos</label>
                        <select class=" pasajeros_mayores grid_1 required"   name="habitaciones[1][adultos]">
                            <option value="1" >1</option>
                            <option value="2"  selected="selected" >2</option>
                            <option value="3" >3</option>
                            <option value="4" >4</option>
                            <option value="5" >5</option>
                        </select>
                    </dl> 
                    <dl class="grid_1 alpha">
                        <label class="grid_1 alpha omega">Niños</label>
                        <select class="pasajeros_menores grid_1 alpha "  >
                            <option value="0" selected="selected" >0</option>
                            <option value="1" >1</option>
                            <option value="2" >2</option>
                            <option value="3" >3</option>
                            <option value="4" >4</option>
                            <option value="5" >5</option>
                            <option value="6" >6</option>
                        </select>
                    </dl>
                    <div class="container_hijos grid_1 ">
                        <ul class="clonable" class="cantidad_hijos margen">
                        </ul>
                    </div>
                </div>


            
<div class="clear margen">&nbsp;</div>
		        <div class="grid_5 alpha">
            <input type="hidden" class="noDateMode" value="0">
			<input class="reservar_btn grid_2 alpha der" type="button" value="Buscar">
        </div>
        
		<div class="clear margen">&nbsp;</div>
							<!-- fin hoteles -->	
		</form>