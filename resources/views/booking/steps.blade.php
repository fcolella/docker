
<div class="checkout ui-corner-all">

	<div class="grid_3 ui-corner-left omega alpha  step {{ $time1 }}">
		<div class="arrow">&nbsp;</div>
		<span>1.</span> INGRES&Aacute; TUS DATOS
		@if ($time1 == 'past')<div class="check">&nbsp;</div>@endif
		@if ($time1 == 'origin')<div class="check">&nbsp;</div>@endif
	</div>

	<div class="grid_2 alpha omega  step {{ $time2 }}">
		<div class="arrow">&nbsp;</div>
		<span>2.</span> REALIZ&Aacute; EL PAGO
		@if ($time2 == 'past')<div class="check">&nbsp;</div>@endif
		@if ($time2 == 'origin')<div class="check">&nbsp;</div>@endif
	</div>

	<div class="grid_2 alpha omega ui-corner-right  step {{ $time3 }}">
		@if ($time3 == 'past')<div class="check">&nbsp;</div>@endif
		<span>3.</span> VALIDAR IDENTIDAD
	</div>

</div>
<div class="clear margen">&nbsp;</div>