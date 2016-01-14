@extends('layouts.master')

@section('main')
	<div class="widget-slider-wrap">
		<div class="container">
			<div class="row">
				<div class="col-md-5 container-widget-busqueda">
					<div class="widget-busqueda-wrap" @if (empty($HomeSearchSliders))style="position:relative" @endif>
						 <div class="tab-content">
						    <div id="paquetes" class="tab-pane fade active in" role="tabpanel">
							@include('layouts.insurance.search')
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	@if (!empty($HomeSearchSliders))
		@include('layouts.widgets.SearchSliders')
	@endif
	</div>

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
