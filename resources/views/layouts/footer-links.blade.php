@section('footer-links')
<footer class="main-footer">
	<div class="container">
		@if (!empty($FooterLinks))
		<div class="row cont-link">
			@if (!empty($FooterLinks['products']))
			<div class="col-sm-2 col-sm-offset-1">
				<h4 class="title-footer">Producto</h4>
				<ul>
				@foreach ($FooterLinks['products'] as $item)
					<li><a href="{{ $item['href'] }}" title="{{ $item['title'] }}">{{ $item['name'] }}</a></li>
				@endforeach
				</ul>
			</div>
			@endif
			@if (!empty($FooterLinks['information']))
			<div class="col-sm-3">
				<h4 class="title-footer">Información</h4>
				<ul>
				@foreach ($FooterLinks['information'] as $item)
					<li><a href="{{ $item['href'] }}" title="{{ $item['title'] }}">{{ $item['name'] }}</a></li>
				@endforeach
				</ul>
			</div>
			@endif
			@if (!empty($FooterLinks['us']))
			<div class="col-sm-2">
				<h4 class="title-footer">Garbarino Viajes</h4>
				<ul>
				@foreach ($FooterLinks['us'] as $item)
					<li><a href="{{ $item['href'] }}" title="{{ $item['title'] }}">{{ $item['name'] }}</a></li>
				@endforeach
				</ul>
			</div>
			@endif
			@if (($FooterLinks['support'] and !empty($headers)) or (!empty($FooterLinks['social'])))
			<div class="col-sm-2 col-sm-offset-1">
				@if ($FooterLinks['support'] and !empty($headers))
				<h4 class="title-footer">Atención al cliente</h4>
				<ul>
				@foreach ($headers as $item)
					@if ($item['class'] == 'dropdown')
					<li role="presentation" class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							{{ $item['text'] }}
						</a>
						<div class="dropdown-menu">
							{!! $item['content'] !!}
						</div>
					</li>
					@endif
				@endforeach
				</ul>
				@endif
				@if (!empty($FooterLinks['social']))
				<h5 class="title-footer-social">Seguinos</h5>
				<ul>
				@foreach ($FooterLinks['social'] as $item)
					<li class="social">{!! $item['anchor'] !!}</li>
				@endforeach
				</ul>
				@endif
			</div>
			@endif
		</div>
		@endif

        <aside class="datos-footer">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="{{ $STATICS }}/images/logos/garbarino-viajes-logo.gif" alt="Garbarino Viajes" class="footer-logo">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 col-sm-offset-1 text-center">
                    <img src="{{ $STATICS }}/images/logos/iata.png" alt="Iata" class="logo-footer">
                    <img src="{{ $STATICS }}/images/logos/aviabue.png" alt="Aviabue" class="logo-footer">
                </div>
                <address class="col-sm-6 text-center">
                    Garbarino Viajes S.A - Leg Nº 12.541 - Categoría: EVT - Cabildo 2025, 1er Piso, C.A.B.A.<br>
                    Consulte el precio de nuestros productos llamando al (011) 4787-7077 o a Mail, (Ley 4435 GCBA).
                </address>
                <div class="col-sm-3 text-center">
                    <a target="_F960AFIPInfo" href="https://servicios1.afip.gov.ar/clavefiscal/qr/mobilePublicInfo.aspx?req=e1ttZXRob2Q9Z2V0UHVibGljSW5mb11bcGVyc29uYT0zMDcwOTE3Nzk2Ml1bdGlwb2RvbWljaWxpbz0wXVtzZWN1ZW5jaWE9MF1bdXJsPWh0dHA6Ly93d3cuZ2FyYmFyaW5vdmlhamVzLmNvbV19">
                        <img src="{{ $STATICS }}/images/logos/afip.png" class="logo-footer afip">
                    </a>
                    <a target="_blank" href="http://www.jus.gov.ar/datos-personales.aspx/">
                        <img src="{{ $STATICS }}/images/logos/pdp.png" class="logo-footer pdp">
                    </a>
                </div>
            </div>
        </aside>
    </div>
</footer>
@endsection
