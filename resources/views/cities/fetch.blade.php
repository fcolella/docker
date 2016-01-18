@include('cms.layouts.header')
    <h1 class="page-header">Actualización de ciudades</h1>
    <div class="jumbotron">
        @if ('success'==$status)
            <h1>Exito</h1>
            <div class="alert alert-success" role="alert">
                La tabla de ciudades se ha actualizado correctaemnte
            </div>
        @else
            <h1>Error</h1>
            <div class="alert alert-danger" role="alert">
                Ocurrio un error al actualizar la tabla de ciudades
            </div>
        @endif
    </div>
@include('cms.layouts.footer')