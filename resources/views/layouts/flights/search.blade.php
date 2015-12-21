<form id="form-aereos" action="/vuelos-box/vuelos-listado.php" method="get" class="busqueda grid_5 alpha omega">
    
    <div class="clear margen">&nbsp;</div>
    <div class="grid_2 top">
        <div class="grid_1 alpha">
            <input type="radio" name="oneway" id="oneway-0" value="0" class="izq" checked="checked"/><label for="oneway-0" class="izq">Ida y vuelta</label>
        </div>
        <div class="grid_1 alpha">
            <input type="radio" name="oneway" id="oneway-1" value="1" class="izq" /><label for="oneway-1" class="izq">S&oacute;lo ida</label>
        </div>
    </div>


    <div class="grid_5">
        <label class="col-md-11 alpha">Origen</label>
        <input type="text" class="col-md-9 omega origen origenI" name="origen" value="Buenos Aires, Argentina (BUE)" placeholder="Ingres&aacute; tu ciudad..." id="vuelosOrigen"/>
        <div style="display:none" class="formError rojo origen col-md-11" for="origen">Campo obligatorio</div>
        <div style="display:none" class="formError rojo origen no_city col-md-11" for="origen">Ciudad inexistente</div>
    </div>


    <div class="grid_5">
        <label class="col-md-11 alpha">Destino</label>
        <input type="text"  class="col-md-9 origenI omega destino" name="destino" value="" placeholder='Ingres&aacute; tu destino...' id="vuelosDestino"/>
        <div style="display:none" class="formError rojo col-md-11" for="destino">Campo obligatorio</div>
        <div style="display:none" class="formError destino rojo col-md-11 no_city" for="destino">Ciudad inexistente</div>
    </div>


    <div class="grid_2">
        <label class="grid_2 alpha ">Salida</label>
        <input type="text" readonly="readonly" name="fecha_ida" class="col-md-12 fecha_desde calendar alpha input_fecha" value="" placeholder="Desde"/>
        <span class="formError rojo grid_2 alpha fecha_desde_error" for="fecha_desde" style="display: none;">Campo obligatorio</span>
    </div>


    <div class="grid_2 omega returnDate ">
        <label class="grid_2 alpha ">Regreso</label>
        <input type="text" readonly="readonly" name="fecha_vuelta" class="col-md-12 alpha input_fecha fecha_hasta calendar" value="" placeholder="Hasta"/>
        <span class="formError rojo grid_2 alpha fecha_hasta_error" for="fecha_hasta" style="display: none;">Campo obligatorio</span>
    </div>



    <div class="grid_5 alpha">
      <div class="form_selector grid_5">
        <div class="grid_1 alpha">
            <label class="grid_1 alpha">Adultos</label>
            <select  class="selectAdultos grid_1 alpha">
                <option  value="1">1</option>
                <option  value="2">2</option>
                <option  value="3">3</option>
                <option  value="4">4</option>
                <option  value="5">5</option>
                <option  value="6">6</option>
                <option  value="7">7</option>
                <option  value="8">8</option>
                <option  value="9">9</option>
            </select>
        </div>
                                    <div class="grid_1 alpha">
            <label class="grid_1 alpha">Ni&ntilde;os</label>
            <select class="selectMenores grid_1 alpha" onchange="calculaEdad();">
                <option value="0" selected="">0</option>
                                                        <option  value="1">1</option>
                                                        <option  value="2">2</option>
                                                        <option  value="3">3</option>
                                                        <option  value="4">4</option>
                                                        <option  value="5">5</option>
                                                        <option  value="6">6</option>
                                                        <option  value="7">7</option>
                                                        <option  value="8">8</option>
                            </select>
        </div>

        <input type="hidden" name="pax" class="paxTotal">

          						<span class="grid_2 alpha edades_conf">
					<ul class="grid_2 alpha omega">
                        <!--		aca	-->
                                                <!--	hasta aca		-->
                    </ul>
		        </span>

        <span class="grid_3 alpha formError rojo ageRanges der" style="display:none;">Debe ingresar la edad de todos los ni&ntilde;os</span>
        <span class="grid_3 alpha formError rojo babiesQty der" style="display:none;">La cantidad de beb&eacute;s no puede ser mayor a la cantidad de adultos</span>

        </div>
    </div>

    <div class="clear margen">&nbsp;</div>
    <span id="span_submit"><input class="reservar_btn grid_2 der" type="button" value="Buscar" onclick="checkFormAereos();" style="margin-top:0"></span>

    <div class="clear margen">&nbsp;</div>

</form>