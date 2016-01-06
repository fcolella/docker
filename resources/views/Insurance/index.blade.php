@extends('layouts.master')

@section('main')
	<div class="widget-slider-wrap">
		<div class="col-md-5 container-widget-busqueda">
			<div class="widget-busqueda-wrap">
				 <div class="tab-content">
					@include('layouts.insurance.search')
				</div>
			</div>
		</div>
	</div>


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