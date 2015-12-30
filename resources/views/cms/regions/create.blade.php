@include('cms.layouts.header')
	<div class="cms-title-container">
		<h1>Create Region</h1>
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
		{!! Form::open(array('action' => 'Database\RegionController@store')) !!}

		<div class="form-group">
			{!! Form::label('name', 'Name') !!}
			{!! Form::text('name', Input::old('name'), array('class' => 'form-control')) !!}
		</div>

		<div class="form-group">
			@foreach($countries as $country)
			<div class="country_item">
				{!! Form::label('country_'.$country->code, $country->name) !!}
				{!! Form::checkbox('countries[]', $country->code, null, ['class' => 'field', 'id' => 'country_'.$country->code]) !!}
			</div>
			@endforeach
		</div>

		{!! Form::submit('Create', array('class' => 'btn btn-primary')) !!}

		{!! Form::close() !!}
	</div>
@include('cms.layouts.footer')