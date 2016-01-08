@include('cms.layouts.header')
<div class="cms-title-container">
	<h1>Cities</h1>
</div>
<div class="cms-content">
	<table class="table table-bordered" id="cities-list">
		<thead>
		<tr>
			<td>Code</td>
			<td>Name</td>
			<td>Country</td>
			<td>Latitude</td>
			<td>Longitude</td>
		</tr>
		</thead>
		<tbody>
		@if($cities != "")
			@foreach($cities as $city)
				<tr>
					<td>{{ $city->code }}</td>
					<td>{{ $city->name }}</td>
					<td>{{ $city->country->name }}</td>
					<td>{{ $city->lat }}</td>
					<td>{{ $city->long }}</td>
				</tr>
			@endforeach
		@endif
		</tbody>
	</table>
	<div class="cms-modal-container"></div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#cities-list').DataTable();
		});
	</script>
</div>
@include('cms.layouts.footer')