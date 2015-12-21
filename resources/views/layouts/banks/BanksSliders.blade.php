<div class="clear margen">&nbsp;</div>
<div class="container container_12">
	<div class="blue grid_12 alpha"><a href="{{ $ROOT }}/">Home</a> &gt; Promociones Bancos</div>
	<h1 class="grid_12 alpha">Promociones de bancos</h1>
</div>

<div class="clear margen">&nbsp;</div>
<input type="hidden" class="banco_id" value="" />
<div class="container container_12 ui-corner-all blanco">
	<div class="clear margen">&nbsp;</div>
	<div class="grid_12 top">
		@foreach ($BanksSliders as $keyBank => $itemBank)
		@if (empty($itemBank['promos'])) @continue; @endif
		@foreach ($itemBank['promos'] as $keypPomo => $itemPomo)
		<div class="grid_12 alpha omega top margen banco-{{ $keyBank }}">
			<div class="grid_12 grilla">
				<div class="grid_3">
					@if ($keypPomo==0)
					<img src="{{ $STATIC }}{{ $itemBank['logo']['src'] }}" alt="{{ $itemBank['logo']['alt'] }}">
					@else
					<div class="grid_3 prefix_3">&nbsp;</div>
					@endif
					<div class="clear margen">&nbsp;</div>
				</div>
				<div class="grid_5 omega">
					{{ $itemPomo['legal']['description'] }}
					<div class="clear margen">&nbsp;</div>
				</div>
				<div class="grid_2 alpha omega">
					@foreach ($itemPomo['cards'] as $keypCard => $itemCard)
					<img src="{{ $STATIC }}{{ $itemCard['logo'] }}" alt="{{ $itemCard['alt'] }}">&nbsp;
					@endforeach
					<div class="clear margen">&nbsp;</div>
				</div>
				<div class="grid_2 alpha omega">
					<img src="{{ $STATIC }}{{ $itemPomo['legal']['src'] }}" alt="{{ $itemPomo['legal']['alt'] }}">
				</div>
			</div>
		</div>
		@endforeach
		@endforeach
	</div>
</div>
