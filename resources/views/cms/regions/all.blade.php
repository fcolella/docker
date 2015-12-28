@include('cms.layouts.header')
			<h1>Regions</h1>
			<table>
				<thead>
				<tr>
					<td>ID</td>
					<td>Name</td>
					<td>Countries</td>
					<td>Options</td>
				</tr>
				</thead>
				<tbody>
					@foreach($regions as $key => $region)
					<tr>
						<td>{{ $region->id }}</td>
						<td>{{ $region->name }}</td>
						<td>
							@foreach($region->countries as $country)
								{{ $country->name }}
							@endforeach
						</td>
						<td>
							<a class="btn btn-small btn-success" href="{{ URL::to(getenv('CMS_PATH').'/regions/'.$region->id) }}">Show Region</a>
							<a class="btn btn-small btn-info" href="{{ URL::to(getenv('CMS_PATH').'/regions/'.$region->id.'/edit') }}">Edit Region</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
@include('cms.layouts.footer')