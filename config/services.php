<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => env('MAILGUN_DOMAIN'),
		'secret' => env('MAILGUN_SECRET'),
	],

	'mandrill' => [
		'secret' => env('MANDRILL_SECRET'),
	],

	'ses' => [
		'key'    => env('SES_KEY'),
		'secret' => env('SES_SECRET'),
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => App\User::class,
		'key'    => env('STRIPE_KEY'),
		'secret' => env('STRIPE_SECRET'),
	],

	'gulliver'      => [
		//	environment fallback to production
		'host'      => env('GULLIVER_HOST', 'http://186.153.135.1428080'),
		'port'      => env('GULLIVER_PORT', '9000')
	],

	'pagos-online'  => [
		'url'       => env('URL_DINAMICA_PAGOS', 'http://www.garbarinoviajes.com.ar/pago-online/op_ok.php')
	],

	'decidir'       => [
		'url'       => env('URL_DECIDIR','https://sps.decidir.com/sps-ar/Validar')
	]
];
