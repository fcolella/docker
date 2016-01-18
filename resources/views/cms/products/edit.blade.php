@include('cms.layouts.header')
<div class="cms-title-container">
	<h1>Create Product</h1>
	<div class="btn btn-success cms-btn-submit">Save</div>
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
<div class="cms-content product-content">
	{!! Form::open(array('action' => 'Database\ProductController@update', 'id' => 'products-create-form')) !!}

		<div class="form-group">
			{!! Form::text('name', $product->name, array('class' => 'form-control', 'autocomplete' => 'off')) !!}
		</div>

		<div class="btn btn-success cms-btn-submit">Save</div>

	{!! Form::close() !!}

	<script type="text/javascript">
		$(document).ready(function(){
			$('.product-content [name="name"]').focus();

			$('.cms-btn-submit').click(function(){
				var name = $("input[name='name']").val().length;

				if(!name){
					if(!$('.cms-message-container .bg-danger').length) $('.cms-message-container').append('<div class="bg-danger"><ul></ul></div>');

					var error = $('<li />', { text : 'The name field is required.', "class" : 'error-name' });
					$('.cms-message-container .bg-danger ul').append(error);

					$('html, body').animate({ scrollTop: 0 }, 'slow');

					return false;
				}else{
					$('#products-create-form').submit();
				}
			});
		});
	</script>
</div>
@include('cms.layouts.footer')