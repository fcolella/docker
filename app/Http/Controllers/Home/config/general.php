<?php
/**
 * Created by PhpStorm.
 * User: gabrielvazquez
 * Date: 18/12/15
 * Time: 14:54
 */
$settings = [
    'environment'		=> 'general',
    'timezone'			=> 'America/Argentina/Buenos_Aires',
    'language'			=> 'es-AR',
    'static'			=> '//static.garbarinoviajes.com.ar',
    'absolute'			=> false,
    'seo'				=> [
        'title'				=> 'Agencia de viajes y turismo - paquetes turisticos - pasajes aereos - hoteles - cruceros | Garbarino Viajes',
        'description'		=> 'Garbarino Viajes, Agencia de viajes y turismo lider en argentina',
        'keywords'			=> 'Viajes, agencia de viajes, agencia de turismo, paquetes turisticos, pasajes aereos, vuelos, seguro medico, trenes, alquiler de autos',
        'canonical'			=> 'http://www.garbarinoviajes.com.ar',
        'social'			=> [
            //	Open Graph
            'og:title'				=> 'Agencia de viajes y turismo | Garbarino Viajes',
            'og:type'				=> 'article',
            'og:url'				=> 'http://www.garbarinoviajes.com.ar',
            'og:image'				=> 'http://static.garbarinoviajes.com.ar/images/garbarino-viajes-128x128.png',
            'og:description'		=> 'Garbarino Viajes, Agencia de viajes y turismo lider en argentina',
            //	Twitter Card
            'twitter:title'			=> 'Agencia de viajes y turismo | Garbarino Viajes',
            'twitter:card'			=> 'summary',
            'twitter:site'			=> '@Garbarino',
            'twitter:url'			=> 'http://www.garbarinoviajes.com.ar',
            'twitter:image'			=> 'http://static.garbarinoviajes.com.ar/images/garbarino-viajes-128x128.png',
            'twitter:description'	=> 'Garbarino Viajes, Agencia de viajes y turismo lider en argentina',
            //	Google+
            'g+name'				=> 'Agencia de viajes y turismo | Garbarino Viajes',
            'g+description'			=> 'Garbarino Viajes, Agencia de viajes y turismo lider en argentina',
            'g+image'				=> 'http://static.garbarinoviajes.com.ar/images/garbarino-viajes-128x128.png',
            'g+publisher'			=> 'https://plus.google.com/+garbarinoviajes/',
        ]
    ],
    //	Database
    'database'			=> [
        'host'				=> "",
        'user'				=> "",
        'password'			=> "",
        'name'				=> "",
        'timeout'			=> 500
    ],
    'currency'			=> [
        'code' 				=> 'ARS',
        'mask'				=> 'ARS',
        'decimal_amount'	=> '2',
        'decimal_separator'	=> ',',
        'thousand_separator'=> '.'
    ],
    'google'			=> [
        'verification'		=> "",
        'maps_api_key'		=> "",
        'gtm'				=> "",

    ],
    //
   	'header' => [
        0 => [
            'enabled'		=> true,
            'text'			=> 'Llamanos',
            'href'			=> null,
            'class'			=> 'dropdown',
            'content'		=> '<span>
                                        <p>Ventas telefónicas<br><b>4787-7077</b></p>
                                        <p>Interior<br><b>0810-555-7077</b></p>
                                    </span>
                                    <span>
                                        <b>Horario:</b> Lunes a Viernes de 9 a 21 hs / Sábados, Domingos y feriados de 10 a 18 hs.
                                    </span>'
        ],
        1 => [
            'enabled'		=> true,
            'text'			=> 'Contacto',
            'href'			=> '/contacto',
            'class'			=> null,
            'content'		=> null
        ],
        2 => [
            'enabled'		=> true,
            'text'			=> 'Sucursales',
            'href'			=> '/sucursales',
            'class'			=> null,
            'content'		=> null
        ]
    ],
	'products' => [
        0	=> [
            'enabled'		=> true,
            'name'			=> 'Vuelos',
            'title'			=> 'vuelos',
            'href'			=> '/vuelos',
            'css'			=> [],
            'js'			=> [],
            'html'			=> 'layouts.flights.search'
        ],
        1	=> [
            'enabled'		=> true,
            'name'			=> 'Hoteles',
            'title'			=> 'hoteles',
            'href'			=> '/hoteles',
            'css'			=> [],
            'js'			=> [],
            'html'			=> 'layouts.hotels.search'
        ],
        2	=> [
            'enabled'		=> true,
            'name'			=> 'Paquetes',
            'title'			=> 'paquetes turísticos',
            'href'			=> '/paquetes',
            'css'			=> [],
            'js'			=> [],
            'html'			=> 'layouts.packages.search'
        ],
        3	=> [
            'enabled'		=> true,
            'name'			=> 'Cruceros',
            'title'			=> 'cruceros',
            'href'			=> '/cruceros',
            'css'			=> [],
            'js'			=> [],
            'html'			=> 'layouts.cruises.search'
        ],
        4	=> [
            'enabled'		=> true,
            'name'			=> 'Asistencia',
            'title'			=> 'seguros de viajes',
            'href'			=> '/seguros',
            'css'			=> [],
            'js'			=> [],
            'html'			=> 'layouts.insurance.search'
        ]
    ],
	'navbar'	=> [
        0 => [
            'enabled'		=> true,
            'text'			=> 'Verano 2016',
            'href'			=> '/ofertas/verano',
            'title'			=> 'Ofertas Verano 2016',
        ],
        1 => [
            'enabled'		=> true,
            'text'			=> 'Escapadas',
            'href'			=> '/ofertas/escapada',
            'title'			=> 'Ofertas Escapadas',
        ]
    ],
	'footer'	=> [
        'products'			=> [
            0	=> [
                'enabled'		=> true,
                'name'			=> 'Vuelos',
                'title'			=> 'vuelos',
                'href'			=> '/vuelos'
            ],
            1	=> [
                'enabled'		=> true,
                'name'			=> 'Hoteles',
                'title'			=> 'hoteles',
                'href'			=> '/hoteles'
            ],
            2	=> [
                'enabled'		=> true,
                'name'			=> 'Paquetes',
                'title'			=> 'paquetes turísticos',
                'href'			=> '/paquetes',
            ],
            3	=> [
                'enabled'		=> true,
                'name'			=> 'Cruceros',
                'title'			=> 'cruceros',
                'href'			=> '/cruceros'
            ],
            4	=> [
                'enabled'		=> true,
                'name'			=> 'Asistencia',
                'title'			=> 'seguros de viajes',
                'href'			=> '/seguros'
            ],
            5	=> [
                'enabled'		=> true,
                'name'			=> 'Escapadas',
                'title'			=> 'Ofetas Escapadas',
                'href'			=> '/ofertas/escapada'
            ]
        ],
        'information'		=> [
            0	=> [
                'enabled'		=> true,
                'name'			=> 'Formas de pago',
                'title'			=> 'Formas de pago',
                'href'			=> '/promo-bancos'
            ],
            1	=> [
                'enabled'		=> true,
                'name'			=> 'Financiación',
                'title'			=> 'Financiación',
                'href'			=> '/promo-bancos'
            ],
            2	=> [
                'enabled'		=> true,
                'name'			=> 'Condiciones de contratación',
                'title'			=> 'Condiciones de contratación',
                'href'			=> '/condiciones'
            ],
            3	=> [
                'enabled'		=> true,
                'name'			=> 'Documentación para tu viaje',
                'title'			=> 'Documentación para tu viaje',
                'href'			=> 'http://www.migraciones.gov.ar/accesible/?doc_pais'
            ],
            4	=> [
                'enabled'		=> true,
                'name'			=> 'RG (AFIP) 3550',
                'title'			=> 'RG (AFIP) 3550',
                'href'			=> '/resolucion'
            ]
        ],
        'us'		=> [
            0	=> [
                'enabled'		=> true,
                'name'			=> 'Sucursales',
                'title'			=> 'Sucursales',
                'href'			=> '/sucursales'
            ],
            1	=> [
                'enabled'		=> true,
                'name'			=> 'Trabajá con nosotros',
                'title'			=> 'Trabajá con nosotros',
                'href'			=> '/recursos-humanos'
            ]
        ],
        'support'		=> true,
        'social'		=> [
            0	=> [
                'enabled'		=> true,
                'name'			=> 'Facebook',
                'title'			=> 'Facebook',
                'anchor'		=> '<a href="https://www.facebook.com/Garbarino-Viajes-294235743326" target="_blank" rel="nofollow"><span class="icon-facebook" aria-label="Facebook"></span></a>'
            ],
            1	=> [
                'enabled'		=> false,
                'name'			=> 'Google+',
                'title'			=> 'Google+',
                'anchor'		=> '<a href="" target="_blank" rel="nofollow"><span class="icon-google-plus" aria-label="Google+"></span></a>'
            ]
        ]
    ]
];