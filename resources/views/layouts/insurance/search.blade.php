
	<form name="form-seguros" action="{{ URL::to('/seguros/search') }}" method="post" class="busqueda grid_5 alpha omega">
		<h2 class="row">Busc&aacute; tu Seguro</h2>
		<div class="row">
			<div class="col-md-12">
				<label class="alpha" for="origin">Origen</label>
				<select class="selectOrigen col-md-12" name="origin">
					<option value="BUE">Argentina</option>
				</select>
			</div>

			<div class="col-md-12">
				<label class="alpha" for="destination">Destino</label>
				<select  class="selectDestino col-md-12" name="destination">
					<option value="">Eleg&iacute; tu destino</option>
					@foreach($InsuranceZones as $zone)
						<option value="{{ mb_convert_case($zone,MB_CASE_LOWER,'UTF-8') }}">{{ mb_convert_case($zone,MB_CASE_TITLE,'UTF-8') }}</option>
					@endforeach
				</select>
				<div class="text-danger hidden" for="destination">Campo obligatorio</div>
			</div>

			<div class="col-md-6">
				<label class="alpha">Inicio de la cobertura</label>
				<input type="text" readonly="readonly" name="dateFrom" class="col-md-10 alpha input_fecha fecha_desde calendar" value="" placeholder="Inicio de la cobertura" data-mindate="{{ $InsuranceConfig['mindate'] }}">
				<div class="text-danger hidden" for="dateFrom" value="">Campo obligatorio</div>
			</div>

			<div class="col-md-6">
				<label class="alpha">Fin de la cobertura</label>
				<input type="text" readonly="readonly" name="dateTo" class="fecha_hasta col-md-10 alpha input_fecha calendar" value="" placeholder="Fin de la cobertura" data-mindate="{{ $InsuranceConfig['maxdate'] }}">
				<div class="text-danger hidden" for="dateTo" value="">Campo obligatorio</div>
			</div>

			<div class="row-passengers">
				<div class="col-md-4 paxsQty">
					<label class="alpha" for="passengers">Cantidad de pasajeros</label>
					<select name="passengers" class="col-md-4 qpax" id="Qpax">
						<option value="">Cantidad de pasajeros</option>
						@for($imp=1; $imp<$InsuranceConfig['maxPassengers']+1;$imp++)
						<option value="{{ $imp  }}">{{ $imp }}</option>
						@endfor
					</select>
					<div class="text-danger hidden" for="Qpax">Campo obligatorio</div>
				</div>
				<div class="clearfix">&nbsp;</div>
				<div class="col-md-12">
					@for($imp=1; $imp<$InsuranceConfig['maxPassengers']+1;$imp++)
					<div class="col-md-3 hidden ages-container" id="ages-{{ $imp }}">
						<label class="labelPax">Edad Pax {{ $imp }}</label>
						<select class="selectEdades required" name="ages[{{ $imp }}]">
							<option value="">-</option>
							@for($ima=0; $ima<$InsuranceConfig['maxAge']+1;$ima++)
							<option value="{{ $ima  }}">{{ $ima }}</option>
							@endfor
						</select>
					</div>
					@endfor
					<div class="clearfix">&nbsp;</div>
					<div class="text-danger hidden" for="Qpax">Debe ingresar la edad de todos los pasajeros</div>
				</div>
			</div>
			<div class="col-md-12">
				<button class="btn reservar_btn col-md-6" type="submit">Buscar</button>
			</div>
		</div>
		<div class="clearfix">&nbsp;</div>
	</form>