
<div class="row slider-destinos">
	<div id="slider-buttons">
		<div class="col-sm-12 top margen">
			<input type="hidden" class="itemsQty" value="4"/>
			<div class="owl-carousel slider-buttons ">
				@foreach ($DestinationsSliders as $item)
				@if (empty($item['buttons'])) @continue; @endif
				<div class="region-link-wrap">
					<a class="region-link {{ $item['class'] }}" href="{{ $ROOT }}{{ $item['href'] }}" title="{{ $item['title'] }}">
						<img class="region-img {{ $item['class'] }}" src="{{ $STATICS }}{{ $item['buttons'] }}" alt="{{ $item['title'] }}" width="200" />
					</a>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
  