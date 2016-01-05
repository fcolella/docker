@include('cms.layouts.header')
	<div class="cms-title-container">
		<h1>Edit Region</h1>
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
	<div class="cms-content region-form-content">
		{!! Form::open(['route' => ['regions.update', $region->id]]) !!}

			<div class="form-group">
				{!! Form::text('name', $region->name, array('class' => 'form-control')) !!}
			</div>

			<div class="regions-selected-countries">
				@foreach($countries as $country)
					@if($filtered_country_list->contains($country->code))
						<div id="countrySelected_{{ $country->code }}" class="regions-selected-country btn btn-primary">{{ $country->name }}<span class="glyphicon glyphicon-remove"></span></div>
					@endif
				@endforeach
			</div>

			<div class="form-group">
				@foreach($countries_ordered_list as $letter => $ordered_countries)
					<div class="region-country-group">
						<span><h3>{{ $letter }}</h3></span>
						@foreach($ordered_countries as $country)
							<div class="country_item">
								{!! Form::checkbox('countries[]', $country->code, $filtered_country_list->contains($country->code), ['class' => 'field', 'id' => 'country_'.$country->code]) !!}
								@if($filtered_country_list->contains($country->code))
									{!! Form::label($country->name, $country->name, array('class' => 'label-bold')) !!}
								@else
									{!! Form::label($country->name, $country->name) !!}
								@endif
							</div>
						@endforeach
					</div>
				@endforeach
			</div>

			{!! Form::submit('Edit', array('class' => 'btn btn-primary')) !!}

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
					var country = $(this).prop('id').split('_');
					country = country[1];
					$('.country_item #country_'+country).prop('checked', false);
					$(this).css({'backgroundColor' : '#c9302c', 'borderColor' : '#ac2925'}).fadeOut(500, function(){
						$(this).remove();
					});
				});
			});
		</script>
	</div>
@include('cms.layouts.footer')