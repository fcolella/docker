<form id="form-seguros" action="listado.php" method="get" class="busqueda grid_5 alpha omega">

    
    <div class="form_selector grid_5 alpha ">


		<div class="grid_5">
			<label class="alpha">Origen</label>
			<select class="selectOrigen col-md-12" name="origen">
				<option value="BUE">Argentina</option>
			</select>
			
		</div>

        <input type="hidden" class="hiddenPaxs" value="0">

		<div class="clear">&nbsp;</div>
		
		<div class="grid_5 ">
			<label class="alpha">Destino</label>
			<select  class="selectDestino col-md-12" name="destino">
				<option value="null">Eleg&iacute; tu destino</option>
									<option value="Argentina" >Argentina</option>
									<option value="America" >America</option>
									<option value="Europa" >Europa</option>
									<option value="Asia" >Asia</option>
									<option value="Africa" >Africa</option>
									<option value="Oceania" >Oceania</option>
							</select>
      <div class="formError rojo destino_error grid_2 " for="selectDestino" style="display: none;">Campo obligatorio</div>
		</div>
		
		<div class="clear">&nbsp;</div>
	
				<div class="grid_2 ">
					<label class="alpha">Inicio de la cobertura</label>
					<input type="text" readonly="readonly" name="fecha_desde" class="col-md-10 alpha  input_fecha fecha_desde calendar " value="" placeholder="Inicio de la cobertura"/>
					<div class="formError rojo fecha_desde_error grid_2 alpha" for="fecha_desde" style="display: none;">Campo obligatorio</div>
				</div>
													
				<div class="grid_2 omega">
					<label class="alpha">Fin de la cobertura</label>
					<input type="text" readonly="readonly" name="fecha_hasta" class="fecha_hasta col-md-10 alpha input_fecha calendar " value="" placeholder="Fin de la cobertura"/>
					<div class="clear">&nbsp;</div>
					<div class="formError rojo fecha_hasta_error grid_2 alpha" for="fecha_hasta" style="display: none;">Campo obligatorio</div>
				</div>
		<div class="clear ">&nbsp;</div>
		<div class="grid_2 cant-noches"></div>
		<div class="clear ">&nbsp;</div>
		<div class="grid_5 alpha">
			<div class="clear">&nbsp;</div>
			<label class="grid_2">Cantidad de pasajeros</label>
			<div class="clear">&nbsp;</div>
			
			<div class="grid_2 paxsQty">
				<select name="Qpax" class="grid_2 qpax" id="">
                    <option value="0" >Cantidad de pasajeros</option>
                                            <option value="1"  >1</option>
                                            <option value="2"  >2</option>
                                            <option value="3"  >3</option>
                                            <option value="4"  >4</option>
                                            <option value="5"  >5</option>
                                            <option value="6"  >6</option>
                                            <option value="7"  >7</option>
                                            <option value="8"  >8</option>
                                            <option value="9"  >9</option>
                    				</select>
				<div class="formError rojo qpax_error grid_2 alpha" for="Qpax" style="display: none;">Campo obligatorio</div>
				<div class="edades_error rojo grid_2 msje-error alpha" for="Qpax" style="display: none;">Debe ingresar la edad de todos los pasajeros</div>
			</div>
			
			<div class="grid_2 omega packEdades">
				<div class="grid_2 Edades hidden alpha">
                    <label class="grid_1 labelPax"></label>
					<select class="grid_1 selectEdades" id="">
						<option value="-" >-</option>
													<option value="0" >0</option>
													<option value="1" >1</option>
													<option value="2" >2</option>
													<option value="3" >3</option>
													<option value="4" >4</option>
													<option value="5" >5</option>
													<option value="6" >6</option>
													<option value="7" >7</option>
													<option value="8" >8</option>
													<option value="9" >9</option>
													<option value="10" >10</option>
													<option value="11" >11</option>
													<option value="12" >12</option>
													<option value="13" >13</option>
													<option value="14" >14</option>
													<option value="15" >15</option>
													<option value="16" >16</option>
													<option value="17" >17</option>
													<option value="18" >18</option>
													<option value="19" >19</option>
													<option value="20" >20</option>
													<option value="21" >21</option>
													<option value="22" >22</option>
													<option value="23" >23</option>
													<option value="24" >24</option>
													<option value="25" >25</option>
													<option value="26" >26</option>
													<option value="27" >27</option>
													<option value="28" >28</option>
													<option value="29" >29</option>
													<option value="30" >30</option>
													<option value="31" >31</option>
													<option value="32" >32</option>
													<option value="33" >33</option>
													<option value="34" >34</option>
													<option value="35" >35</option>
													<option value="36" >36</option>
													<option value="37" >37</option>
													<option value="38" >38</option>
													<option value="39" >39</option>
													<option value="40" >40</option>
													<option value="41" >41</option>
													<option value="42" >42</option>
													<option value="43" >43</option>
													<option value="44" >44</option>
													<option value="45" >45</option>
													<option value="46" >46</option>
													<option value="47" >47</option>
													<option value="48" >48</option>
													<option value="49" >49</option>
													<option value="50" >50</option>
													<option value="51" >51</option>
													<option value="52" >52</option>
													<option value="53" >53</option>
													<option value="54" >54</option>
													<option value="55" >55</option>
													<option value="56" >56</option>
													<option value="57" >57</option>
													<option value="58" >58</option>
													<option value="59" >59</option>
													<option value="60" >60</option>
													<option value="61" >61</option>
													<option value="62" >62</option>
													<option value="63" >63</option>
													<option value="64" >64</option>
													<option value="65" >65</option>
													<option value="66" >66</option>
													<option value="67" >67</option>
													<option value="68" >68</option>
													<option value="69" >69</option>
													<option value="70" >70</option>
													<option value="71" >71</option>
													<option value="72" >72</option>
													<option value="73" >73</option>
													<option value="74" >74</option>
													<option value="75" >75</option>
													<option value="76" >76</option>
													<option value="77" >77</option>
													<option value="78" >78</option>
													<option value="79" >79</option>
													<option value="80" >80</option>
													<option value="81" >81</option>
													<option value="82" >82</option>
													<option value="83" >83</option>
													<option value="84" >84</option>
													<option value="85" >85</option>
											</select>
				</div>

                
			</div>
		</div>
		<div class="clear margen">&nbsp;</div>
			<input class="reservar_btn grid_2 der" type="button" onclick="checkFormSeguros();" value="Buscar">
		
	</div>
    <div class="clear margen">&nbsp;</div>
</form>