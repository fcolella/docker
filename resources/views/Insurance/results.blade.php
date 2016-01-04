@include('layout.header')

			<h1 class="result-title hidden"><span id="result-total"></span>{{$resulttitle}}</h1>

@if (!empty($HotelsErrors))
			<div id="result-error" class="loading-result">
				<h2 class="title primary">Oops !!</h2>
			@foreach($HotelsErrors as $Error)
				<h3 class="title secundary">{{$Error}}</h3>
			@endforeach
				<p>Por favor intentá una nueva busqueda</p>
			</div>
@endif
			@include('Hotels.Search')
@if (empty($HotelsErrors))
			@include('Hotels.Loader')
			@include('Hotels.Errors')

			<section class="hotels-list" data-source="{{$HotelsGridUri}}"></section>

			{{-- Google maps - Ends --}}
			<div id="gmaps-conteiner" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="MapModalLabel">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <h4 class="modal-title" id="MapModalLabel">Ubicación del hotel</h4> </div>
						<div class="modal-body" id="gmaps-body"></div>
					</div>
				</div>
			</div>
{{-- Google maps - Ends --}}
@endif

@include('layout.footer')