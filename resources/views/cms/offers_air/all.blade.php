@include('cms.layouts.header')
<div class="cms-title-container">
	<h1>Air Offers</h1>
</div>
<div class="cms-message-container">
	@if(Session::has('error_gulliver'))
		<div class="bg-danger">{{ Session::get('error_gulliver') }}</div>
	@endif
</div>
<div class="cms-content">
	<table class="table table-bordered" id="offers-list">
		<thead>
		<tr>
			<td>Offer ID</td>
			<td>Origin</td>
			<td>Destination</td>
			<td>Currency</td>
			<td>Price</td>
			<td>Flight Type</td>
		</tr>
		</thead>
		<tbody>
			@if($offers_air != '')
				@foreach($offers_air as $offer)
					<tr>
						<td>{{ $offer->offerId }}</td>
						<td>{{ $offer->city($offer->origin)[0]->name }}</td>
						<td>{{ $offer->city($offer->destination)[0]->name }}</td>
						<td>{{ $offer->currency() }}</td>
						<td>{{ $offer->price() }}</td>
						<td>{{ $offer->flyType() }}</td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>
	<div class="cms-modal-container"></div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#offers-list').DataTable();
		});
	</script>
</div>
@include('cms.layouts.footer')