@include('cms.layouts.header')
			<h1>Regions</h1>

			@if(Session::has('message_success'))
				<div class="bg-success">{{ Session::get('message_success') }}</div>
			@endif

			@if(Session::has('message_delete'))
				<div class="bg-info">{{ Session::get('message_delete') }}</div>
			@endif

			@if(Session::has('message_update'))
				<div class="bg-info">{{ Session::get('message_update') }}</div>
			@endif

			<a class="btn btn-small btn-success" href="{{ URL::to(getenv('CMS_PATH').'/regions/create') }}">Create</a>
			<table class="table table-bordered" id="regions-list">
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
								@foreach($region->countries as $index => $country)
									{{ $country->name }}@if($index < $region->countries->count() - 1), @endif
								@endforeach
							</td>
							<td>
								<a class="btn btn-small btn-info" href="{{ URL::to(getenv('CMS_PATH').'/regions/'.$region->id.'/edit') }}">Edit</a>
								<a class="btn btn-small btn-danger" href="{{ URL::to(getenv('CMS_PATH').'/regions/'.$region->id.'/destroy') }}">Delete</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<script type="text/javascript">
				$(document).ready(function() {
					$('#regions-list').DataTable();
				});
			</script>
@include('cms.layouts.footer')