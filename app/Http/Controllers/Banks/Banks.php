<?php
/**
 * Created by PhpStorm.
 * User: gabrielvazquez
 * Date: 18/12/15
 * Time: 14:41
**/

namespace App\Http\Controllers\Banks;

class Banks
{
	static function getBanks($mode="") 
	{
		$banks = [
			0 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/18',
				'title'			=> 'Promociones Banco Comafi',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/comafi.jpg',
					'alt'			=> 'Banco Comafi',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			1 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/49',
				'title'			=> 'Promociones Banco Nación',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/nacion.jpg',
					'alt'			=> 'Banco Nación',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			2 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/17',
				'title'			=> 'Promociones Banco Credicoop',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/credicoop.jpg',
					'alt'			=> 'Banco Credicoop',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			3 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/11',
				'title'			=> 'Promociones Tarjetas Cabal',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/cabal-todos.jpg',
					'alt'			=> 'Tarjetas Cabal',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			4 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/4',
				'title'			=> 'Promociones Banco Provincia',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/provincia.jpg',
					'alt'			=> 'Banco Provincia',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				],
				'legal'			=> [
					'title'			=> '',
					'description'	=> ''
				],
				'promos'			=> [
					0 => [
						'enabled'	=> true,
						'legal'			=> [
							'src'			=> '/images/cft/cft-vp.jpg',
							'alt'			=> 'CTF',
							'description'	=> '<p><b><font color="#0793D2">Pasajes aéreos / Paquetes turísticos / Cruceros</font><br>
												HASTA 12 CUOTAS (VP)<br>
												Visa - MasterCard</b></p>
												<p>Promoción válida para la compra de pasajes aéreos, cruceros y  paquetes turísticos que incluyan transporte, alojamiento y traslados.
												<br>excepto productos promocionales.<br></p>',
						],
						'cards'		=> [
						]
					],
					1 => [
						'enabled'	=> true,
						'legal'			=> [
							'src'			=> '/images/cft/cft-vp.jpg',
							'alt'			=> 'CTF',
							'description'	=> '<p><b><font color="#0793D2">Pasajes aéros Aerolíneas Argentinas y Austral</font> <br>
												3,6,12 y 18 cuotas sin interés(VPA)<br>
												Visa y Mastercard*
												Para compras hasta el 31/12/2015</b></p>
												<p>Promoción válida para la compra de tickets aéreos publicados de Aerolineas Argentinas y Austral.
												*Tarjetas Mastercard para compras exclusivamente en forma presencial en las oficinas de Garbarino Viajes S.A. de Belgrano, Unicenter, San Miguel, Caballito, Escobar, Pilar y Lomas.</p>',
						],
						'cards'		=> [
							0		=> [
								'logo'		=> '/images/bancos/ma.jpg',
								'alt'		=> 'Mastercard'
							],
							1		=> [
								'logo'		=> '/images/bancos/vis.jpg',
								'alt'		=> 'Visa'
							]
						]
					],
					2 => [
						'enabled'	=> true,
						'legal'			=> [
							'src'			=> '/images/cft/cft-vp.jpg',
							'alt'			=> 'CTF',
							'description'	=> '<p><b><font color="#0793D2">Pasajes aéreos  Lan </font> <br>
												3, 6, 9 y 12 cuotas sin interés(VPL)<br>
												Visa y Mastercard</b></p>
												<p>Promoción válida para la compra de tickets aéreos publicados de Lan</p>',
						],
						'cards'		=> [
							0		=> [
								'logo'		=> '/images/bancos/ma.jpg',
								'alt'		=> 'Mastercard'
							],
							1		=> [
								'logo'		=> '/images/bancos/vis.jpg',
								'alt'		=> 'Visa'
							]
						]
					]
				]
			],
			5 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/14',
				'title'			=> 'Promociones Banco ICBC',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/icbc.jpg',
					'alt'			=> 'Banco ICBC',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			6 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/20',
				'title'			=> 'Promociones Banco San Juan',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/sanjuan.jpg',
					'alt'			=> 'Banco San Juan',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			7 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/43',
				'title'			=> 'Promociones Tarjetas Visa',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/visa-todos.jpg',
					'alt'			=> 'Tarjetas Visa',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			8 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/30',
				'title'			=> 'Promociones Banco Macro',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/macro.jpg',
					'alt'			=> 'Banco Macro',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			9 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/33',
				'title'			=> 'Promociones Tarjeta Shopping',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/shopping.jpg',
					'alt'			=> 'Tarjeta Shopping',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			10 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/38',
				'title'			=> 'Promociones Banco Galicia',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/galicia.jpg',
					'alt'			=> 'Banco Galicia',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			11 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/42',
				'title'			=> 'Promociones Tarjetas Master',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/master-todos.jpg',
					'alt'			=> 'Tarjetas Master',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			12 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/46',
				'title'			=> 'Promociones Tarjetas Amex',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/amex.jpg',
					'alt'			=> 'Tarjetas Amex',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			13 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/15',
				'title'			=> 'Promociones Tarjeta Garbarino',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/garbarino.jpg',
					'alt'			=> 'Tarjeta Garbarino',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			14 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/23',
				'title'			=> 'Promociones Banco Santa Fe',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/santafe.jpg',
					'alt'			=> 'Banco Santa Fe',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			15 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/26',
				'title'			=> 'Promociones Banco Corrientes',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/corrientes.jpg',
					'alt'			=> 'Banco Corrientes',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			16 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/5',
				'title'			=> 'Promociones Banco Santander',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/santander.jpg',
					'alt'			=> 'Banco Santander',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			17 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/31',
				'title'			=> 'Promociones Tarjetas SI',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/tarjetasi.jpg',
					'alt'			=> 'Tarjetas SI',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			18 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/3',
				'title'			=> 'Promociones Tarjetas Diners',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/diners.jpg',
					'alt'			=> 'Tarjetas Diners',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			19 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/3',
				'title'			=> 'Promociones Banco Ciudad',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/ciudad.jpg',
					'alt'			=> 'Banco Ciudad',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			20 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/2',
				'title'			=> 'Promociones Banco HSBC',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/hsbc.jpg',
					'alt'			=> 'Banco HSBC',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			21 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/59',
				'title'			=> 'Promociones Tarjetas Cencosud',
				'target'		=> '_blank',
				'logo'			=> [
					'src'		=> '/images/medios-de-pago/cencosud.jpg',
					'alt'		=> 'Tarjetas Cencosud',
					'width'		=> 107,
					'height'	=> 54,
					'class'		=> 'izq'
				]
			],
			22 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/16',
				'title'			=> 'Promociones Banco Frances',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/frances.jpg',
					'alt'			=> 'Banco Frances',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			23 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/24',
				'title'			=> 'Promociones Banco Chaco',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/chaco.jpg',
					'alt'			=> 'Banco Chaco',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			24 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/1',
				'title'			=> 'Promociones Banco Citi',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/citi.jpg',
					'alt'			=> 'Banco Citi',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			25 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/39',
				'title'			=> 'Promociones Tarjetas Naranja',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/naranja.jpg',
					'alt'			=> 'Tarjetas Naranja',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			26 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/19',
				'title'			=> 'Promociones Banco Tucuman',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/tucuman.jpg',
					'alt'			=> 'Banco Tucuman',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			27 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/8',
				'title'			=> 'Promociones Banco Supervielle',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/supervielle.jpg',
					'alt'			=> 'Banco Supervielle',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			28 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/6',
				'title'			=> 'Promociones Banco Hipotecario',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/hipotecario.jpg',
					'alt'			=> 'Banco Hipotecario',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			29 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/34',
				'title'			=> 'Promociones Banco Itaú',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/itau.jpg',
					'alt'			=> 'Banco Itaú',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			],
			30 => [
				'enabled'		=> true,
				'href'			=> '/promo-bancos/11',
				'title'			=> 'Promociones Banco Patagonia',
				'target'		=> '_blank',
				'logo'			=> [
					'src'			=> '/images/medios-de-pago/patagonia.jpg',
					'alt'			=> 'Banco Patagonia',
					'width'			=> 107,
					'height'		=> 54,
					'class'			=> 'izq'
				]
			]
		];
		$items = [];
		foreach ($banks as $key => $item)
		{
			if (true==$item['enabled'])
			{
				//
				if ('slider' === $mode)
				{
					$items[] = [
						'href'		=> $item['href'],
						'title'		=> $item['title'],
						'target'	=> $item['target'],
						'logo'		=> $item['logo']
					];
				} else {
					$items[]	= $item;
				}
			}
		}
		return $items;
	}
}
