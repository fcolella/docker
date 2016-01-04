
	@foreach ($response as $key_response => $plan)
		<article class="row product-list">

			<div class="col-md-9">
				<h2 class="top">
					<img width="80px" src="{{ $STATICS}}images/seguros/{{ $plan['insurancePlan']['insuranceProvider'] }}.jpg">
					{{ $plan['insurancePlan']['name'] }}
					@if ($CYBERMONDAY_TIME)
						<span class="tagCybermonday-hrz">CyberMonday</span>
					@endif
				</h2>
				<div class="checklist top">
					<ul>
					@foreach ($plan['coverages'] as $key_plan  => $coverage)
						<li @if ($key_plan > 6) class="notvissible hidden" @endif >
							{{ $coverage['coverage']['name'] }} . {{ $coverage['detail'] }}
						</li>
					@endforeach
					</ul>
					@if (sizeof($plan['coverages']) > 6)
					<a class="grid_2 viewAll top">Ver todas las coberturas</a>
					<a class="grid_2 viewLess top" style="display:none">Ver menos coberturas</a>
					@endif
				</div>
			</div>

			<div class="col-md-3 price">
				@if ($SHOW_TRAVEL_SALE_TAG && $destination=='argentina')
					<img src="/img/travelsale/tagsareos1.png" title="TravelSale" alt="TravelSale" style="position: absolute;z-index:200; right: -40px; top: -26px;"/>
				@endif
				<div class="price-title">Precio Total Final</div>
				<span class="price-currency">{{ $plan['insuranceTotalPrices']['requestedSellingPrice']['currency'] }}</span>
				<span class="price-amount">{{ ceil($plan['insuranceTotalPrices']['requestedSellingPrice']['afterTax']) }}</span>
				<div class="actions">
					<a class="btn btn-block btn-info">Comprar</a>
				</div>
			</div>

		</article>
	@endforeach
