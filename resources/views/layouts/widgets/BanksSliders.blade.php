
<div class="widget-slider-wrap slider-bancos">
	<div class="container">
		<div class="row formas-de-pago-wrap">
			<div class="col-md-3">
				<span class="condicion-cuotas">!Hasta <strong>12 cuotas en pesos!</strong></span>
			</div>
			<div class="col-md-7 top">
				<div class="owl-carousel slider-medios-pago">
				@foreach ($BanksSliders as $item)
					<div class="item">
						<a href="{{ $ROOT }}{{ $item['href'] }}" title="{{ $item['title'] }}" target="{ $item['target'] }}"><img src="{{ $STATICS }}{{ $item['logo']['src'] }}" alt="{{ $item['logo']['alt'] }}" width="{{ $item['logo']['width'] }}" height="{{ $item['logo']['height'] }}" class="{{ $item['logo']['class'] }}" /></a>
					</div>
				@endforeach
				</div>
			</div>
			<div class="col-md-2 mas-medios-link">
				<a href="promo-bancos" target="_blank">Más medios de pago</a>
			</div>
		</div>
	</div>
</div>
