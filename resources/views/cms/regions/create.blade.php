@include('cms.layouts.header')
	<div class="cms-title-container">
		<h1>Create Region</h1>
		<div class="btn btn-primary regions-create-submit">Save</div>
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
	<div class="cms-content region-content">
		{!! Form::open(array('action' => 'Database\RegionController@store', 'id' => 'regions-create-form')) !!}

			<div class="form-group">
				{!! Form::text('name', '', array('class' => 'form-control', 'autocomplete' => 'off')) !!}
			</div>

			<div class="regions-selected-countries"></div>

			<div class="form-group">
				@foreach($countries_ordered_list as $letter => $ordered_countries)
				<div class="region-country-group">
					<span><h3>{{ $letter }}</h3></span>
					@foreach($ordered_countries as $country)
						<div class="country_item">
							{!! Form::checkbox('countries[]', $country->code, null, ['class' => 'field', 'id' => 'country_'.$country->code, 'autocomplete' => 'off']) !!}
							{!! Form::label($country->name, $country->name) !!}
						</div>
					@endforeach
				</div>
				@endforeach
			</div>

			{!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}

		{!! Form::close() !!}

		<script type="text/javascript">
			$(document).ready(function(){
				$(window).scroll(function() {
					if($(this).scrollTop() >= 100){
						$('.regions-selected-countries').addClass('regions-selected-countries-fixed');
					}else{
						$('.regions-selected-countries').removeClass('regions-selected-countries-fixed');
					}
				});

				$('.region-form-content [name="name"]').focus();

				$('.regions-create-submit').click(function(){
					var name = $("input[name='name']").val().length;
					var checkbox = $("input[name='countries[]']:checked").length;

					if(!name || !checkbox){
						if(!$('.cms-message-container .bg-danger').length) $('.cms-message-container').append('<div class="bg-danger"><ul></ul></div>');
						$('.error-name, .error-checkbox').remove();

						if(!name){
							var error = $('<li />', { text : 'The name field is required.', "class" : 'error-name' });
							$('.cms-message-container .bg-danger ul').append(error);
						}

						if(!checkbox){
							var error = $('<li />', { text : 'The countries field is required.', "class" : 'error-checkbox' });
							$('.cms-message-container .bg-danger ul').append(error);
						}

						return false;
					}else{
						$('#regions-create-form').submit();
					}
				});

				$('.country_item input').on('click', function(e){
					e.stopPropagation();

					var country_code = $(this).prop('id').split('_');
					country_code = country_code[1];

					var country_name = $(this).next().html();

					if($(this).prop('checked')){
						var newItem = $('<div class="regions-selected-country btn btn-primary regions-selected-country-new" id="countrySelected_'+country_code+'">'+country_name+'<span class="glyphicon glyphicon-remove"></span></div>').hide().fadeIn(500, function(){ $(this).addClass('regions-selected-country-transition').removeClass('regions-selected-country-new'); });
						$('.regions-selected-countries').append(newItem);
						$(this).next().addClass('label-bold');
					}else{
						$('.regions-selected-countries #countrySelected_'+country_code).css({'backgroundColor' : '#c9302c', 'borderColor' : '#ac2925'}).fadeOut(500, function(){
							$(this).remove();
						});
						$('#country_'+country_code).next().removeClass('label-bold');
					}
				});

				$('.country_item').on('click', function(){
					var country_code = $(this).find('input').prop('id').split('_');
					country_code = country_code[1];

					var country_name = $(this).find('label').html();

					if($(this).children(":first").prop('checked')){
						$(this).children(":first").prop('checked', false);
						$('.regions-selected-countries #countrySelected_'+country_code).css({'backgroundColor' : '#c9302c', 'borderColor' : '#ac2925'}).fadeOut(500, function(){
							$(this).remove();
						});
						$('#country_'+country_code).next().removeClass('label-bold');
					}else{
						$(this).children(":first").prop('checked', true);

						var newItem = $('<div class="regions-selected-country btn btn-primary regions-selected-country-new" id="countrySelected_'+country_code+'">'+country_name+'<span class="glyphicon glyphicon-remove"></span></div>').hide().fadeIn(500, function(){ $(this).addClass('regions-selected-country-transition').removeClass('regions-selected-country-new'); });
						$('.regions-selected-countries').append(newItem);
						$('#country_'+country_code).next().addClass('label-bold');
					}
				});

				$(document).on('click', '.regions-selected-country', function(){
					var country_code = $(this).prop('id').split('_');
					country_code = country_code[1];
					$('.country_item #country_'+country_code).prop('checked', false);
					$('#country_'+country_code).next().removeClass('label-bold');
					$(this).css({'backgroundColor' : '#c9302c', 'borderColor' : '#ac2925'}).fadeOut(500, function(){
						$(this).remove();
					});
				});
			});
		</script>
	</div>
@include('cms.layouts.footer')