@include('cms.layouts.header')
    <h1 class="page-header">Cities</h1>
    <table class="table table-bordered" id="cities-list" style="width:100%;display:none">
    <thead>
    <tr>
        <td>ID</td>
        <td>name</td>
        <td>englishName</td>
        <td>subdivision</td>
        <td>country</td>
        <td>zipCode</td>
        <td>stateProvinceCode</td>
        <td>stateProvinceName</td>
        <td>areaCode</td>
        <td>cartographyReliability</td>
        <td>latitude</td>
        <td>longitude</td>
    </tr>
    </thead>
    <tbody>
        @foreach($cities as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->englishName }}</td>
            <td>{{ $item->subdivision }}</td>
            <td>{{ $item->country }}</td>
            <td>{{ $item->zipCode }}</td>
            <td>{{ $item->stateProvinceCode }}</td>
            <td>{{ $item->stateProvinceName }}</td>
            <td>{{ $item->areaCode }}</td>
            <td>{{ $item->cartographyReliability }}</td>
            <td>{{ $item->latitude }}</td>
            <td>{{ $item->longitude }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div id="overlay">
    <img src="//ajax.googleapis.com/ajax/libs/dojo/1.10.4/dijit/themes/claro/images/loadingAnimation.gif" alt="Loading">
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#cities-list').DataTable({"initComplete":function(){$('#cities-list').show();$('#overlay').fadeOut(800)}})
    });
</script>

@include('cms.layouts.footer')