@include('cms.layouts.header')
	<div class="row">
		@include('cms.layouts.sidebar')
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1>Edit Region</h1>

			@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif

			{!! Form::open(['route' => ['regions.update', $region->id]]) !!}

				<div class="form-group">
					{!! Form::label('name', 'Name') !!}
					{!! Form::text('name', $region->name, array('class' => 'form-control')) !!}
				</div>

				<div class="form-group">
					@foreach($countries as $country)
					<div class="country_item">
						{!! Form::label('country_'.$country->code, $country->name) !!}
						{!! Form::checkbox('countries[]', $country->code, $filtered_country_list->contains($country->code), ['class' => 'field', 'id' => 'country_'.$country->code]) !!}
					</div>
					@endforeach
				</div>

				{!! Form::submit('Edit', array('class' => 'btn btn-primary')) !!}

			{!! Form::close() !!}
		</div>
    </div>
@include('cms.layouts.footer')