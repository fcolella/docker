@extends('layouts.master')

@section('main')
@if (!empty($SearchBoxes))
	<div class="widget-slider-wrap">
		<div class="container">
			<div class="row">
				<div class="col-md-5 container-widget-busqueda">
					<div class="widget-busqueda-wrap">
						<ul class="nav nav-tabs" role="tablist" id="widget-busqueda">
<?php /**
							@foreach ($SearchBoxes as $item)
							@if (empty($item['html'])) @continue; @endif
							<li role="presentation" @if ($item == head($SearchBoxes)) class="active" @endif><a href="#{{ $item['name'] }}" title="{{ $item['title'] }}" aria-controls="{{ $item['name'] }}" role="tab" data-toggle="tab" aria-expanded="@if ($item == head($SearchBoxes)) true @else false @endif">{{ $item['name'] }}</a></li>
							@endforeach
						</ul>
						<div class="tab-content">
							@foreach ($SearchBoxes as $item)
							@if (empty($item['html'])) @continue; @endif
                       		<div role="tabpanel" class="tab-pane fade @if ($item == head($SearchBoxes)) active in @endif" id="{{ $item['name'] }}">
                       			@include($item['html'])
                       		</div>
                       		@endforeach
                       	</div>
**/ ?>
					</div>
				</div>
			</div>
		</div>
	</div>
@endif

@if (!empty($HomeSearchSliders))
	@include('layouts.widgets.SearchSliders')
@endif

@if (!empty($BanksSliders))
	@include('layouts.widgets.BanksSliders')
@endif

<div class="main-content">
	<div class="container">
		<span class="clear margen">&nbsp;</span>
		@if (!empty($DestinationsSliders))
			@include('layouts.widgets.DestinationsSliders')
		@endif
	</div>
</div>

@stop