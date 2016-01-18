@extends('layouts.master')

@section('main')
		<div class="container container_12">
			<h1 class="title">Asistencia al viajero en {{ $zoneData['title'] }}</h1>
			<div class="row" id="content">
				<div class="sidebar col-md-4" style="display:block">
                    <div class="widget-slider-wrap">
                        <div class="row">
                            <div class="container-widget-busqueda">
                                <div class="widget-busqueda-wrap">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="insurance">
                                            @include('Insurance.search')
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
                                <li><a title="Asistencia al viajero en {{ mb_convert_case($zone,MB_CASE_TITLE,'UTF-8') }}" href="{{ url('seguros') }}/zonas?destino={{ mb_convert_case($zone,MB_CASE_TITLE,'UTF-8') }}">{{ mb_convert_case($zone,MB_CASE_TITLE,'UTF-8') }}</a></li>
                            @endforeach
                            </ul>
                            <div class="clearfix"></div>
                            <h3 class="bordeInf">Preguntas Frecuentes</h3>
                            <ul>
                                <li><a href="{{ url('seguros') }}#questionA">¿Por qué contratar un servicio de asistencia al viajero?</a></li>
                                <li><a href="{{ url('seguros') }}#questionB">¿Qué es una Asistencia al Viajero?</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="content col-md-8 grilla-producto insurance alpha" role='product-list'>
                    <img src="{{ $STATICS }}images/{{ $zoneData['image'] }}" title="Asistencia al viajero en {{ $zoneData['title'] }}" class="img-responsive" />
                    <div class="clear margen ">&nbsp;</div>
                    <span class="grid_9 top margen" style="line-height: 20px;">{{ $zoneData['text'] }}</span>
                    <div class="clear margen ">&nbsp;</div>
					<?php $offset = 5 - (sizeof($Plans['insurancePlan'])); ?>
					@foreach ($Plans['insurancePlan'] as $key => $item)
                    <div class="col-md-3 @if(0==$key) col-md-offset-{{$offset}}@endif mini-blok">
						<div class="int ui-corner-all">
                    	    <span class="blue"><b>Plan</b></span>
                    		<h3 class="blue">{{ $item['name'] }}</h3>
                    		<span class="precio der">{{ $item['currency'] }} {{ amountFormat($item['afterTax']) }}</span>
                    		<span class="blue izq">Precio Total por {{ $item['duration'] }} días de cobertura</span>
                    		<div class="clear ">&nbsp;</div>
                    		<span class="reservar_btn grid_1 omega der calcular" title="Cotizá el seguro para tu viaje!">Cotizar</span>
                    		<div class="clear">&nbsp;</div>
                    	</div>
                    </div>
                    @endforeach
                    <div class="clear margen">&nbsp;</div>

					<div class="innerBar ui-corner-all grid_9 top margen">
						<b>PRESTACIONES</b>
					</div>
					<div class="resultsTable">
						<table cellpadding="5" cellspacing="10" style="width:100%">
						<?php $counter=0; ?>
						@foreach ($Plans['coverages'] as $code => $coverage)
							<tr>
                        		<td @if ($counter % 2 == 0) style="background-color:rgb(215, 217, 221)" @endif>{{ $coverage[0]['name']}}</td>
                        		<td @if ($counter % 2 == 0 && !empty($coverage[0]['detail'])) style="background-color:rgb(215, 217, 221)" @endif>{{ $coverage[0]['detail']}}</td>
                        		<td @if ($counter % 2 == 0 && !empty($coverage[1]['detail'])) style="background-color:rgb(215, 217, 221)" @endif>@if (!empty($coverage[1]['detail'])){{ $coverage[1]['detail'] }}@else &nbsp; @endif</td>
                        		<td @if ($counter % 2 == 0 && !empty($coverage[2]['detail'])) style="background-color:rgb(215, 217, 221)" @endif>@if (!empty($coverage[2]['detail'])){{ $coverage[2]['detail'] }}@else &nbsp; @endif</td>
                        		<td @if ($counter % 2 == 0 && !empty($coverage[3]['detail'])) style="background-color:rgb(215, 217, 221)" @endif>@if (!empty($coverage[3]['detail'])){{ $coverage[3]['detail'] }}@else &nbsp; @endif</td>
							</tr>
							<?php $counter++; ?>
						@endforeach
						</table>
					</div>

                </div>
				<div class="clear margen">&nbsp;</div>
			</div>
		</div>
@stop
