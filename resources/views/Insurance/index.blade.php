@include('layouts.header')


	<div class="widget-slider-wrap">
		<div class="container">
			<div class="row">
				<div class="col-md-5 container-widget-busqueda">
					<div class="widget-busqueda-wrap">
						<div class="tab-content">
                       		<div role="tabpanel" class="tab-pane fade active in" id="insurance">
                       			@include('layouts.insurance.search')
                       		</div>
                       	</div>
					</div>
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

@include('layouts.footer')