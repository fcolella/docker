	@include('layouts.footer-links')

	@foreach ($Commons::getJsFooter() as $js)
	{!! $js !!}
	@endforeach

  </body>
</html>