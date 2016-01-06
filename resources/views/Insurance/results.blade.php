@extends('layouts.master')

@section('main')

			<h1 class="title">Asistencia al viajero en {{ mb_convert_case($InsuranceSearch['destination'],MB_CASE_TITLE,'UTF-8') }}</h1>
			<div class="row" id="content">
@if (empty($InsuranceErrors))
				@include('layouts.insurance.Loader')
@endif
				<div class="result-title">
					<div class="col-md-9">
						Argentina - {{ mb_convert_case($InsuranceSearch['destination'],MB_CASE_TITLE,'UTF-8') }} | Desde: {{ date('d/m/Y', strtotime($InsuranceSearch['dateFrom'] )) }} | Hasta: {{ date('d/m/Y', strtotime($InsuranceSearch['dateTo'] )) }} | Pasajeros: {{ implode(', años ',$InsuranceSearch['passengers']) }}@if (sizeof($InsuranceSearch['passengers'])==1) años @endif |
						<a class="toggle-search">Cambiá tu búsqueda &gt;&gt;</a>
					</div>
					<div class="col-md-3" id="result-total"></div>
					<div class="clearfix"></div>
				</div>

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

					<div class="row secundary clearfix">
						<div class="col-md-12">
							<h3 class="bordeInf">Otras Regiones</h3>
							<ul class="zonas">
							@foreach($InsuranceZones as $zone)
								<li><a title="Asistencia al viajero en {{ mb_convert_case($zone,MB_CASE_TITLE,'UTF-8') }}" href="{{ url() }}/zona.php?destino={{ mb_convert_case($zone,MB_CASE_TITLE,'UTF-8') }}">{{ mb_convert_case($zone,MB_CASE_TITLE,'UTF-8') }}</a></li>
							@endforeach
							</ul>
							<div class="clearfix"></div>
							<h3 class="bordeInf">Preguntas Frecuentes</h3>
							<ul>
								<li><a href="{{ url() }}/index.php#questionA">¿Por qué contratar un servicio de asistencia al viajero?</a></li>
								<li><a href="{{ url() }}/index.php#questionB">¿Qué es una Asistencia al Viajero?</a></li>
							</ul>
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
			</div>
@stop
