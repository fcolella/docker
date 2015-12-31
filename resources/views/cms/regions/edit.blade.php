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
	<div class="cms-content">
		<div class="regions-selected-countries">
			@foreach($countries as $country)
				@if($filtered_country_list->contains($country->code))
					<div id="countrySelected_{{ $country->code }}" class="regions-selected-country btn btn-primary">{{ $country->name }}<span class="glyphicon glyphicon-remove"></span></div>
				@endif
			@endforeach
		</div>
		{!! Form::open(['route' => ['regions.update', $region->id]]) !!}

			<div class="form-group">
				{!! Form::label('name', 'Name') !!}
				{!! Form::text('name', $region->name, array('class' => 'form-control')) !!}
			</div>

			<div class="form-group">
				@foreach($countries as $country)
					<div class="country_item">
						{!! Form::label($country->name, $country->name) !!}
						{!! Form::checkbox('countries[]', $country->code, $filtered_country_list->contains($country->code), ['class' => 'field', 'id' => 'country_'.$country->code]) !!}
					</div>
				@endforeach
			</div>

			{!! Form::submit('Edit', array('class' => 'btn btn-primary')) !!}

		{!! Form::close() !!}

		<script type="text/javascript">
			$(document).ready(function(){
				$('.country_item input').on('click', function(e){
					e.stopPropagation();
					//e.preventDefault();

					var country_code = $(this).prop('id').split('_');
					country_code = country_code[1];

					var country_name = $(this).prev().html();

					if($(this).prop('checked')){
						$('.regions-selected-countries').prepend('<div class="regions-selected-country btn btn-primary" id="countrySelected_'+country_code+'">'+country_name+'<span class="glyphicon glyphicon-remove"></span></div>');
					}else{
						$('.regions-selected-countries #countrySelected_'+country_code).remove();
					}
				});

				$('.country_item').on('click', function(){
					var country_code = $(this).find('input').prop('id').split('_');
					country_code = country_code[1];

					var country_name = $(this).find('label').html();

					if($(this).children(":last").prop('checked')){
						$(this).children(":last").prop('checked', false);
						$('.regions-selected-countries #countrySelected_'+country_code).remove();
					}else{
						$(this).children(":last").prop('checked', true);
						$('.regions-selected-countries').prepend('<div class="regions-selected-country btn btn-primary" id="countrySelected_'+country_code+'">'+country_name+'<span class="glyphicon glyphicon-remove"></span></div>');
					}
				});

				$(document).on('click', '.regions-selected-country', function(){
					var country = $(this).prop('id').split('_');
					country = country[1];
					$('.country_item #country_'+country).prop('checked', false);
					this.remove();
				});
			});
		</script>
	</div>
@include('cms.layouts.footer')