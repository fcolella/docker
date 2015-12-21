	<div id="main-slider" class="owl-carousel" style="display:block;">
		@foreach ($HomeSearchSliders as $item)
		@if (empty($item['src'])) @continue; @endif
		<div class="item item-group">
			@if (empty($item['link']))<a href="{{ $item['link'] }}" title="{{ $item['title'] }}">@endif
			<img src="{{ $item['src'] }}" alt="{{ $item['title'] }}">
			@if (empty($item['link']))</a>@endif
		</div>
		@endforeach
	</div>