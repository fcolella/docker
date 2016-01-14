@include('cms.layouts.header')
	<div class="cms-title-container">
		<h1>Regions</h1>
		<a class="btn btn-small btn-success cms-btn-create" href="{{ URL::to(getenv('CMS_PATH').'/regions/create') }}">Create</a>
	</div>
	<div class="cms-message-container">
		@if(Session::has('message_success'))
			<div class="bg-success">{{ Session::get('message_success') }}</div>
		@endif

		@if(Session::has('message_delete'))
			<div class="bg-info">{{ Session::get('message_delete') }}</div>
		@endif

		@if(Session::has('message_update'))
			<div class="bg-info">{{ Session::get('message_update') }}</div>
		@endif
	</div>
	<div class="cms-content">
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
				@if($regions != '')
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
							<a class="btn btn-small btn-danger cms-btn-delete" data-href="{{ URL::to(getenv('CMS_PATH').'/regions/'.$region->id.'/destroy') }}">Delete</a>
						</td>
					</tr>
					@endforeach
				@endif
			</tbody>
		</table>
		<div class="cms-modal-container"></div>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#regions-list').DataTable();

				$(document).on('click', '.cms-btn-delete', function(){
					var region_href = $(this).data('href');
					var modal =    '<div class="modal fade" id="confirm-delete-region" tabindex="-1" role="dialog" aria-hidden="true">' +
										'<div class="modal-dialog">' +
											'<div class="modal-content">' +
												'<div class="modal-header">Delete Region</div>' +
												'<div class="modal-body">' +
													'<p>Are sure you want to delete the selected Region?</p><p>You can\'t undo this action</p>' +
												'</div>' +
												'<div class="modal-footer">' +
													'<button type="button" class="btn btn-default btn-close-modal" data-dismiss="modal">Cancel</button>' +
													'<a href="'+region_href+'" class="btn btn-danger btn-ok">Delete</a>' +
												'</div>' +
											'</div>' +
										'</div>' +
									'</div>';

					$('.cms-modal-container').html(modal);
					$('#confirm-delete-region').modal('show');
				});

				$(document).on('click', '.btn-close-modal', function(){
					$('#confirm-delete-region').remove();
					$('.modal-backdrop').fadeOut('fast', function(){
						$(this).remove();
					});
				});
			});
		</script>
	</div>
@include('cms.layouts.footer')