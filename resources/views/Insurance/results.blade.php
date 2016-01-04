@extends('layouts.master')

@section('main')

			<h1 class="result-title hidden"><span id="result-total"></span>{{ $ResultTitle }}</h1>
@if (empty($InsuranceErrors))
				@include('layouts.insurance.Loader')
@endif
			<div class="sidebar col-md-4">
				<div class="widget-slider-wrap">
					<div class="row">
						<div class="container-widget-busqueda hidden">
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

			<div class="content col-md-8">
@if (!empty($InsuranceErrors))
				<div id="result-error" class="loading-result">
					<h2 class="title primary">Oops !!</h2>
				@foreach($InsuranceErrors as $Error)
					<h3 class="title secundary">{{ $Error }}</h3>
				@endforeach
					<p>Por favor intentá una nueva busqueda</p>
				</div>
@else
				@include('layouts.insurance.Errors')

				<section class="result-list" role="product-list" data-source="{{ $InsuranceGridUri }}"></section>
@endif
			</div>
@stop