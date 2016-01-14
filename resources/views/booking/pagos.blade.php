<h2>Elegí tu medio de pago</h2>
<b>Seleccioná tu banco y la cantidad de cuotas</b>
<div class="clear margen">&nbsp;</div>

@foreach ($InstallmentsWOinterest as $pago)
	<div class="grid_7 omega payment-block fare-block margen ui-corner-all">
		<div class="grid_1 alpha omega">
			<br><b style="font-size: 16px">{{ $pago->cuotas }}</b> @if ($pago->cuotas!=1) cuotas @else cuota @endif <b>Promoción</b>
			<input name="Installment" type="hidden" class="cuotas" value="{{ $pago->cuotas }}">
		</div>
		<div class="grid_6 alpha omega">
			<?php $startHidden=5; ?>
			@foreach ($pago->paymentCombo as $k => $combo)
				@if ($combo['banco']['banco_id'] != $CREDITO_GARBARINO_ID || ($combo['banco']['banco_id'] == $CREDITO_GARBARINO_ID && !$gastos))
					<div class="grid-1 alpha txt-centrado int @if ($k >= $startHidden)hidden hiddenBank @endif">
						<input class="izq bancoSelect radio" id="{{ $pago->cuotas }}-{{ $combo['banco']['nombre'] }}" type="radio" name="banco" sps="{{ $combo['banco']['sps'] }}" value="{{ $combo['banco']['banco_id'] }}">
						<label for="{{ $pago->cuotas }}-{{ $combo['banco']['nombre'] }}"><img width="60px" alt="{{ $combo['banco']['nombre'] }}" title="{{ $combo['banco']['nombre'] }}" src="{{ $STATICS }}images/{{ $combo['banco']['banco_imagen'] }}" align="absmiddle" ></label>
						<select name="card" class="hidden selectCard">
							<option>Seleccioná una tarjeta</option>
							@foreach ($combo['banco']['tarjetas'] as $tarjeta)
								<option @if (!empty($tarjeta['airline'])) airlineCode="{{ $tarjeta['airline'] }}" @endif coef="{{ $tarjeta['coef'] }}" value="{{ $tarjeta['code'] }}">{{ $tarjeta['nombre'] }}</option>
							 @endforeach
						</select>
					</div>
				@else
					<?php $startHidden++; ?>
				@endif
				@if ($k == $startHidden)
					<a class="der view-more"> Ver más bancos >> </a>
					<a class="der view-less hidden"> << Ver menos bancos </a>
				 @endif
			@endforeach
		</div>
		<div class="clear">&nbsp;</div>
		<div class="cardOptions alpha busqueda grid_2  push_1"></div>
		<div class="loader grid_1 push_medio txt-centrado " style="display:none">
			<img src="{{ $STATICS }}images/loading.gif">
		</div>
		<div class="grid_3 push_1 blue payment"></div>
		<span class="grid_6 msje-error rojo push_1 alpha">Seleccioná un medio de pago</span>
		<div class="grid_7 blue intereses_data"></div>
	</div>
	<div class="clear">&nbsp;</div>
@endforeach

@foreach ($InstallmentsWinterest as $pago)
	<div class="grid_7 omega payment-block fare-block margen ui-corner-all">
		<div class="grid_1 alpha omega">
			<br> <b style="font-size: 16px">{{ $pago->cuotas }}</b> @if ($pago->cuotas!=1) cuotas @else cuota @endif <b>Promoción</b>
			<input name="Installment" type="hidden" class="cuotas" value="{{ $pago->cuotas }}">
		</div>
		<div class="grid_6 alpha omega">
			<?php $startHidden=5; ?>
			@foreach ($pago->paymentCombo as $k => $combo)
				@if ($combo['banco']['banco_id'] != $CREDITO_GARBARINO_ID || ($combo['banco']['banco_id'] == $CREDITO_GARBARINO_ID && !$gastos))
					<div class="grid-1 alpha txt-centrado int @if ($k >= $startHidden)hidden hiddenBank @endif">
						<input class="izq bancoSelect radio" id="{{ $pago->cuotas }}-{{ $combo['banco']['nombre'] }}" type="radio" name="banco" sps="{{ $combo['banco']['sps'] }}"  value="{{ $combo['banco']['banco_id'] }}">
						<label for="{{ $pago->cuotas }}-{{ $combo['banco']['nombre'] }}"><img width="60px" alt="{{ $combo['banco']['nombre'] }}" title="{{ $combo['banco']['nombre'] }}" src="{{ $STATICS }}images/{{ $combo['banco']['banco_imagen'] }}" align="absmiddle" ></label>
						<select name="card" class="hidden selectCard">
							<option>Seleccioná una tarjeta</option>
							@foreach ($combo['banco']['tarjetas'] as $tarjeta)
								<option @if (!empty($tarjeta['airline'])) airlineCode="{{ $tarjeta['airline'] }}" @endif coef="{{ $tarjeta['coef'] }}" value="{{ $tarjeta['code'] }}">{{ $tarjeta['nombre'] }}</option>
							@endforeach
						</select>
					</div>
				@else
					<?php $startHidden++; ?>
				@endif
				@if ($k == $startHidden)
					<a class="der view-more"> Ver más bancos >> </a>
					<a class="der view-less hidden"> << Ver menos bancos </a>
				@endif
			@endforeach
		</div>
		<div class="clear">&nbsp;</div>
		<div class="cardOptions alpha busqueda grid_2 push_1"></div>
		<div class="loader grid_1 push_medio txt-centrado " style="display:none">
			<img src="{{ $STATICS }}images/loading.gif">
		</div>
		<div class="grid_3 push_1 blue payment"></div>
		<span class="grid_6 msje-error rojo push_1 alpha">Seleccioná un medio de pago</span>
		<div class="grid_7 blue intereses_data"></div>
	</div>
	<div class="clear">&nbsp;</div>
@endforeach

@foreach ($InstallmentsUatp as $pago)
	<div class="grid_7 omega payment-block fare-block margen ui-corner-all">
		<div class="grid_1 alpha omega">
			<br><b style="font-size: 16px">{$pago->cuotas}</b> @if ($pago->cuotas!=1) cuotas @else cuota @endif <b>Promoción</b>
			<input name="Installment" type="hidden" class="cuotas" value="{{ $pago->cuotas }}">
		</div>
		<div class="grid_6 alpha omega">
			@foreach ($pago->paymentCombo as $k => $combo)
				@if ($combo['banco']['banco_id'] != $CREDITO_GARBARINO_ID || ($combo['banco']['banco_id'] == $CREDITO_GARBARINO_ID && !$gastos))
					<div class="grid-1 alpha txt-centrado int @if ($k >= $startHidden)hidden hiddenBank @endif">
						<input class="izq bancoSelect radio" id="{{ $pago->cuotas }}-{{ $combo['banco']['nombre'] }}" type="radio" name="banco" sps="{{ $combo['banco']['sps'] }}" value="{{ $combo['banco']['banco_id'] }}">
						<label for="{{ $pago->cuotas }}-{{ $combo['banco']['nombre'] }}"><img width="60px" alt="{{ $combo['banco']['nombre'] }}" title="{{ $combo['banco']['nombre'] }}" src="{{ $STATICS }}images/{$combo.banco.banco_imagen}" align="absmiddle" ></label>
						<select name="card" class="hidden selectCard">
							<option>Seleccioná una tarjeta</option>
							@foreach ($combo['banco']['tarjetas'] as $tarjeta)
								<option @if (!empty($tarjeta['airline'])) airlineCode="{{ $tarjeta['airline'] }}" @endif coef="{{ $tarjeta['coef'] }}" value="{{ $tarjeta['code'] }}">{{ $tarjeta['nombre'] }}</option>
							@endforeach
						</select>
					</div>
				@else
					<?php $startHidden++; ?>
				@endif
				@if ($k == $startHidden)
					<a class="der view-more"> Ver más bancos >> </a>
					<a class="der view-less hidden"> << Ver menos bancos </a>
				@endif
			@endforeach
		</div>
		<div class="clear">&nbsp;</div>
		<div class="cardOptions alpha busqueda grid_2  push_1"></div>
		<div class="loader grid_1 push_medio txt-centrado " style="display:none">
			<img src="{{ $STATICS }}images/loading.gif">
		</div>
		<div class="grid_3 push_1 blue payment"></div>
		<span class="grid_6 msje-error rojo push_1 alpha">Seleccioná un medio de pago</span>
		<div class="grid_7 blue intereses_data"></div>
	</div>
	<div class="clear">&nbsp;</div>
@endforeach

@if (!empty($InstallmentsOtherBanks))
{{-- <pre>{{ print_r($InstallmentsOtherBanks) }}</pre> --}}
	<span class="grid_6 msje-error rojo">Seleccioná un medio de pago</span>

	<div class="grid_7 omega payment-block fare-block margen ui-corner-all">
		<div class="grid_1 alpha omega">
			<br>
			<b style="font-size: 16px">
				@foreach ($InstallmentsOtherBanks as $k => $pago)
					{{ $pago->cuotas }}@if ($pago!=end($InstallmentsOtherBanks)), @endif
				@endforeach
			</b>cuotas
		</div>
		<div class="grid_6 alpha omega">
			@foreach ($pago->paymentCombo[0]['banco']['tarjetas'] as $k => $tarjeta)
				@if ($pago->paymentCombo[0]['banco']['banco_id'] != $CREDITO_GARBARINO_ID || ($pago->paymentCombo[0]['banco']['banco_id'] == $CREDITO_GARBARINO_ID && !$gastos))
					<div class="grid-1 alpha txt-centrado int">
                        <input type="radio" id="{{ $pago->paymentCombo[0]['banco']['banco_id'] }}-{{ $tarjeta['code'] }}" name="tarjeta" class="izq tarjeta radio" value="{{ $tarjeta['code'] }}" id="{{ $k }}">
						<input class="bancoSelect hidden" type="radio" name="banco" sps="{{ $pago->paymentCombo[0]['banco']['sps'] }}" value="{{ $pago->paymentCombo[0]['banco']['banco_id'] }}">
						<label for="{{ $pago->paymentCombo[0]['banco']['banco_id'] }}-{{ $tarjeta['code'] }}">
							<img hspace="5px" align="absmiddle" height="32px" alt="{{ $tarjeta['nombre'] }}" title="{{ $tarjeta['nombre'] }}" src="{{ $STATICS }}images/medios-de-pago/{{ $tarjeta['img'] }}">
						</label>
						<input type="hidden" class="tarjetaNombre" value="{{ $tarjeta['nombre'] }}"/>
					</div>
				@endif
			@endforeach
		</div>
		<div class="clear">&nbsp;</div>
		<div class="cardOptions alpha busqueda grid_2 push_1 ">
			<select name="Installment" class="selectCuotas hidden">
				<option value="0">Seleccioná las cuotas</option>
				@foreach ($InstallmentsOtherBanks as $pago)
					<option value="{{ $pago->cuotas }}">{{ $pago->cuotas }} @if ($pago->cuotas!=1) cuotas @else cuota @endif</option>
				@endforeach
			</select>
		</div>
		<div class="loader grid_1 push_medio txt-centrado " style="display:none">
			<img src="{{ $STATICS }}images/loading.gif">
		</div>
		<div class="grid_3 push_1 blue payment"></div>
		<span class="grid_6 msje-error rojo push_1 alpha">Seleccioná un medio de pago</span>
		<div class="grid_7 blue intereses_data"></div>
	</div>
@endif
<div class="clear margen">&nbsp;</div>