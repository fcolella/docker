@extends('layouts.master')

@section('main')
	<div class="clear margen">&nbsp;</div>
	<div class="container container_12">
		<div class="grid_12 alpha ui-corner-all blanco" role="content">
			<div class="loadingWrapper top-40 margen-20 txt-centrado">
				<h1 class="margen-20"><img align="absmiddle" alt="" src="{{ $STATICS  }}images/cruz-big.png"> No encontramos la opción seleccionada</h1>
				<p class="txt-centrado">Por favor, vuelva a <a href="{{ URL::previous()  }}"> buscar </a></p>
			</div>
		</div>
	</div>
@stop