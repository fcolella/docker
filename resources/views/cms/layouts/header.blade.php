<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="{{ asset('statics/cms/images/favicon.ico') }}" rel="shortcut icon">
    <title>Zeus CMS</title>

	<link href="{{ asset('statics/cms/css/jquery-ui/1.11.4/jquery-ui.css') }}" rel="stylesheet">
	<link href="{{ asset('statics/cms/css/jquery-ui/1.11.4/jquery-ui.theme.min.css') }}" rel="stylesheet">
	<link href="{{ asset('statics/cms/css/jquery-ui/1.11.4/jquery-ui.structure.min.css') }}" rel="stylesheet">
	<link href="{{ asset('statics/cms/css/bootstrap/3.3.6/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('statics/cms/css/datatables/datatables.min.css') }}" rel="stylesheet">
	<link href="{{ asset('statics/cms/css/dashboard.css') }}" rel="stylesheet">
	<link href="{{ asset('statics/cms/css/cms.css') }}" rel="stylesheet">

	<script src="{{ asset('statics/cms/js/jquery/2.1.4/jquery.min.js') }}"></script>
	<script src="{{ asset('statics/cms/js/jquery-ui/1.11.4/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('statics/cms/js/bootstrap/3.3.6/bootstrap.min.js') }}"></script>
	<script src="{{ asset('statics/cms/js/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('statics/cms/js/plugins/gv-scrollup.js') }}"></script>
	<script>
		$(document).ready(function(){
			$(this).addScrollup({scrollImg: "{{ asset('statics/cms/images/scrollup.png') }}"});
		});
	</script>
</head>

<body>
    @include('cms.layouts.header-navbar')
    <div class="container-fluid">
        <div class="row">
			@include('cms.layouts.sidebar')
			<div class="col-sm-9 col-sm-offset-3 col-md-10 main">