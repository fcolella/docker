@include('cms.layouts.header')

<script src="{{ asset('statics/cms/js/plugins/typeahead.bundle.min.js') }}"></script>

<div class="cms-title-container">
	<h1>Create Tag</h1>
	<div class="btn btn-success cms-btn-submit">Save</div>
</div>
<div class="cms-message-container">
	@if(count($errors) > 0)
		<div class="bg-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
</div>
<div class="cms-content tag-content">
	{!! Form::open(array('action' => 'Database\TagController@store', 'id' => 'tags-create-form')) !!}

		<div class="form-group">
			{!! Form::text('name', '', array('class' => 'form-control', 'autocomplete' => 'off')) !!}
		</div>

		<div class="tag-table-container">
			<a class="btn btn-small btn-info add-item-row">Add Item</a>
			<table class="table table-bordered" id="tags-list">
				<thead>
					<tr>
						<td>Tipo de Item</td>
						<td>Item</td>
						<td>Orden</td>
						<td>Eliminar</td>
					</tr>
				</thead>
				<tbody>
					<tr class="tag-item-row">
						<td>
							<select name="item_type[]" class="select-product-type" autocomplete="off">
								<option value="0">Seleccione un tipo de item</option>
								<option value="region">Región</option>
								<option value="destination_country">Destino (País)</option>
								<option value="destination_city">Destino (Ciudad)</option>
								<option value="offers_air">Aéreos en oferta</option>
							</select>
						</td>
						<td>
							<select name="region[]" class="tag-item-select select-region">
								@if($regions != "")
									@foreach($regions as $region)
										<option value="{{ $region->id }}">{{ $region->name }}</option>
									@endforeach
								@else
									<option value="0">Sin resultados</option>
								@endif
							</select>

							<select name="countries[]" class="tag-item-select select-country">
								@if($countries != "")
									@foreach($countries as $country)
										<option value="{{ $country->code }}">{{ $country->name }}</option>
									@endforeach
								@else
									<option value="0">Sin resultados</option>
								@endif
							</select>

							<input type="text" name="cities[]" class="tag-item-select select-city typeahead tt-input" />

							<select name="offers_air[]" class="tag-item-select select-offers-air">
								@if($offers_air != "")
									@foreach($offers_air as $offer_air)
										<option value="{{ $offer_air->offerId }}">{{ $offer_air->selectDescription() }}</option>
									@endforeach
								@else
									<option value="0">Sin resultados</option>
								@endif
							</select>
						</td>
						<td>
							<input class="tag-item-order" type="number" name="order_number[]" min="0" max="99" value="0" />
						</td>
						<td>
							<a class="btn btn-small btn-danger delete-item-row">Delete</a>
						</td>
					</tr>
				</tbody>
			</table>
			<a class="btn btn-small btn-info add-item-row">Add Item</a>
		</div>

		<div class="btn btn-success cms-btn-submit">Save</div>

	{!! Form::close() !!}

	<script type="text/javascript">
		$(document).ready(function(){
			var row = $('#tags-list .tag-item-row').first().clone();

			$('.tag-content [name="name"]').focus();

			$('.add-item-row').click(function(){
				var rowClone = row.clone();
				$('#tags-list').append(rowClone);

				rowClone.find('.typeahead').typeahead({
					highlight: true,
					order: 'asc'
				},{
					minLength: 3,
					limit: 10,
					display: 'value',
					name: 'cities',
					source: cities
				});
			});

			$(document).on('click', '.delete-item-row', function(){
				$(this).parent().parent().remove();
			});

			$('.cms-btn-submit').click(function(){
				var name = $("input[name='name']").val().length;

				if(!name){
					if(!$('.cms-message-container .bg-danger').length) $('.cms-message-container').append('<div class="bg-danger"><ul></ul></div>');

					var error = $('<li />', { text : 'The name field is required.', "class" : 'error-name' });
					$('.cms-message-container .bg-danger ul').append(error);

					$('html, body').animate({ scrollTop: 0 }, 'slow');

					return false;
				}else{
					//$('#tags-create-form').submit();
				}
			});

			$(document).on('change', '.select-product-type', function(){
				var item_type = $(this).val();
				var searchSelect = $(this).parent().next();

				if(item_type != 0){
					var selectClass = "";

					switch(item_type){
						case 'region':
							selectClass = 'select-region';
							break;
						case 'destination_country':
							selectClass = 'select-country';
							break;
						case 'destination_city':
							selectClass = 'select-city';
							break;
						case 'offers_air':
							selectClass = 'select-offers-air';
							break;
					}

					searchSelect.find('.'+selectClass).css('display', 'inline-block');
					searchSelect.find('.tag-item-select').not('.'+selectClass).css('display', 'none');
				}else{
					searchSelect.find('.tag-item-select').css('display', 'none');
				}
			});

			var cities = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				remote: {
					url: '/cms/cities/query/%QUERY',
					wildcard: '%QUERY'
				}
			});

			$('.typeahead').typeahead({
				highlight: true,
				order: 'asc',
				minLength: 3
			},{
				limit: 10,
				display: 'value',
				name: 'cities',
				source: cities
			});

		});
	</script>
</div>
@include('cms.layouts.footer')