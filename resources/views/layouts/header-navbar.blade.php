<header class="main-header">
	<div class="container">
		<div class="row header-logo-contacto">
			<div class="col-sm-5">
				<a href="/" title="Garbarino Viajes &rsaquo; Home"><img src="{{ $STATICS }}images/logos/garbarino-viajes-logo.gif" alt="Garbarino Viajes" class="logo"></a>
			</div>
			<div class="col-sm-7 phonesHeader">
				<ul class="nav nav-pills header-contacto-list">
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
					@else
					<li @if ($item == last($headers)) class="last" @endif ><a href="{{ $item['href'] }}">{{ $item['text'] }}</a></li>
					@endif
				@endforeach
				</ul>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-default navbar-garbarino" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-garbarino" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="navbar-collapse-garbarino">
				@if (!empty($NavbarProducts))
				<ul class="nav navbar-nav nav-ppal">
					@foreach ($NavbarProducts as $item)
					<li><a href="{{ $item['href'] }}" title="{{ $item['title'] }}">{{ $item['name'] }}</a></li>
					@endforeach
				</ul>
				@endif
				@if (!empty($NavbarExtra))
				<ul class="nav navbar-nav navbar-right nav-especiales">
				@foreach ($NavbarExtra as $item)
					<li><a href="{{ $item['href'] }}" title="{{ $item['title'] }}">{{ $item['text'] }}</a></li>
				@endforeach
				</ul>
				@endif
			</div>
		</div>
		@if (!empty($DestinationsSelected))
		<img src="{{ $STATICS }}{{ $DestinationsSelected['headers'] }}" style="width:100%;"/>
		@endif
	</nav>
</header>