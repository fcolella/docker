@extends('../layouts.master')

{{-- Avoid display navigation bar --}}
@section('navbar')@stop

{{-- Change footer links --}}
@section('footer-links')
<div class="container container_12 ui-corner-top ui-corner-bottom blanco " role="footer">
	<div class="grid_3 omega"><img alt="IATA" src="{{ $STATICS }}images/iata.png"></div>
	<div class="gv-footer alpha omega grid_7 txt-centrado">
	Garbarino Viajes S.A - Leg Nº 12.541 - Categoría: EVT - Cabildo 2025, 1er Piso, C.A.B.A
	</div>
	<div class="grid_2 alpha"><img align="right" alt="IATA" src="{{ $STATICS }}images/aviabue.png"></div>
</div>
<div class="clear margen">&nbsp;</div>
@stop