<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zeus CMS</title>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('statics/cms/css/dashboard.css') }}" rel="stylesheet">
	<link href="{{ asset('statics/cms/css/cms.css') }}" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>

<body>
    @include('cms.layouts.header-navbar')
    <div class="container-fluid">
        <div class="row">
			@include('cms.layouts.sidebar')
			<div class="col-sm-9 col-sm-offset-3 col-md-10 main">
