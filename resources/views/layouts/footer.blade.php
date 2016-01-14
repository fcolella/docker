
	@include('layouts.footer-links')
	@yield('footer-links')

	@foreach ($jsFooter as $item)
	{!! $item !!}
	@endforeach

  </body>
</html>