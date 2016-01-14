
			<h2 class="blue">{{ $infoPlan['insurancePlan']['name'] }}</h2>
			<div class="clear margen">&nbsp;</div>
			<div class="hotel-detail ">
				<div class="frame img-insurance">
					<img alt="" src="{{ $STATICS }}images/seguros/TVA.jpg">
				</div>
				<div class="grid_2 push_2">
					<span class="precio">{{ $infoPlan['insuranceTotalPrices']['requestedSellingPrice']['currency'] }} {{ amountFormat($infoPlan['insuranceTotalPrices']['requestedSellingPrice']['afterTax'],0) }}</span><br>
					<small>Precio Total Final</small>
				</div>
			</div>
			<ul>
				<li>{{ sizeof($infoPlan['insurancePassengerPrice']) }} @if (sizeof($infoPlan['insurancePassengerPrice'])>1)Pasajeros @else Pasajero @endif<span>{{ $infoPlan['insuranceTotalPrices']['requestedSellingPrice']['currency'] }} {{ amountFormat($infoPlan['insuranceTotalPrices']['requestedSellingPrice']['beforeTax'],0) }}</span></li>
				<li style="display: @if ($infoPlan['insuranceTotalPrices']['requestedSellingPrice']['taxes'])block @else none @endif"> Impuestos y gastos<span>{{ $infoPlan['insuranceTotalPrices']['requestedSellingPrice']['currency'] }} {{ amountFormat($infoPlan['insuranceTotalPrices']['requestedSellingPrice']['taxes'],0) }}</span></li>
				<li style="display: @if ($intereses)block @else none @endif"> Gastos financieros Garbarino Viajes S.A.<span>{{ $infoPlan['insuranceTotalPrices']['requestedSellingPrice']['currency'] }} {{ amountFormat($intereses,0) }}</span></li>
				<li style="display: @if ($bonificacion)block @else none @endif">Bonificación promoción Garbarino Viajes S.A.<span>{{ $infoPlan['insuranceTotalPrices']['requestedSellingPrice']['currency'] }} -{{ amountFormat($bonificacion,0) }}</span></li>
				<li style="display: @if ($cargosGestion)block @else none @endif">Cargos de gestión<span>{{ $infoPlan['insuranceTotalPrices']['requestedSellingPrice']['currency'] }} {{ amountFormat($cargosGestion,0) }}</span></li>
				<li style="display: @if ($descCargosGestion)block @else none @endif">Descuentos ({{ $coefDescuento }} %)<span>{{ $infoPlan['insuranceTotalPrices']['requestedSellingPrice']['currency'] }} -{{ amountFormat($descCargosGestion,0) }}</span></li>
			</ul>
			<ul class="total">
				<li class="blue">Total<span>{{ $infoPlan['insuranceTotalPrices']['requestedSellingPrice']['currency'] }} {{ amountFormat($infoPlan['insuranceTotalPrices']['requestedSellingPrice']['afterTax'],0) }}</span></li>
			</ul>
