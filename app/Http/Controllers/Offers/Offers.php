<?php
/**
 * Created by PhpStorm.
 * User: gabrielvazquez
 * Date: 18/12/15
 * Time: 14:41
**/

namespace App\Http\Controllers\Offers;

class Offers
{
    static function getSearchSliders($mode="")
    {
        $sliders = [
            0	=> [
                'enabled'	=> true,
                'title'		=> 'Ofertas de verano',
                'link'		=> '/ofertas/verano',
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/pkt_verano.jpg',
                'places'	=> [
                    'home',
                    'packages'
                ]
            ],
            1	=> [
                'enabled'	=> true,
                'title'		=> 'Pagá tus vuelos en 12 cuotas',
                'link'		=> null,
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/vuelo_2.jpg',
                'places'	=> [
                    'home',
                    'flights'
                ]
            ],
            2	=> [
                'enabled'	=> true,
                'title'		=> 'Encontrá tu hotel hasta 55% OFF',
                'link'		=> null,
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/hotel3.jpg',
                'places'	=> [
                    'home',
                    'hotel'
                ]
            ],
            3	=> [
                'enabled'	=> true,
                'title'		=> 'Volá a lugares increíbles',
                'link'		=> null,
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/vuelo_1.jpg',
                'places'	=> [
                    'flights'
                ]
            ],
            4	=> [
                'enabled'	=> true,
                'title'		=> 'Volá a cualquier parte del mundo',
                'link'		=> null,
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/vuelo_3.jpg',
                'places'	=> [
                    'flights'
                ]
            ],
            5	=> [
                'enabled'	=> true,
                'title'		=> 'Encontrá tu hotel pagalo en 12 cuotas',
                'link'		=> null,
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/hotel1.jpg',
                'places'	=> [
                    'hotel'
                ]
            ],
            6	=> [
                'enabled'	=> true,
                'title'		=> 'Descubrí el hotel que soñaste',
                'link'		=> null,
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/hotel5.jpg',
                'places'	=> [
                    'hotel'
                ]
            ],
            7	=> [
                'enabled'	=> true,
                'title'		=> 'Tus vacaciones en el hotel perfecto',
                'link'		=> null,
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/hotel4.jpg',
                'places'	=> [
                    'hotel'
                ]
            ],
            8	=> [
                'enabled'	=> true,
                'title'		=> 'Escapate a lugares únicos',
                'link'		=> '/ofertas/escapada',
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/pkt_escapate.jpg',
                'places'	=> [
                    'packages'
                ]
            ],
            9	=> [
                'enabled'	=> true,
                'title'		=> 'Disfrutá Punta Cana',
                'link'		=> '/ofertas/puntacana',
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/pkt_punta-cana.jpg',
                'places'	=> [
                    'packages'
                ]
            ],
            10	=> [
                'enabled'	=> true,
                'title'		=> 'Tus vacaciones en Crucero',
                'link'		=> null,
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/crucero3.jpg',
                'places'	=> [
                    'cruises'
                ]
            ],
            11	=> [
                'enabled'	=> true,
                'title'		=> 'Disfrutá de los mejores Cruceros',
                'link'		=> null,
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/crucero2.jpg',
                'places'	=> [
                    'cruises'
                ]
            ],
            12	=> [
                'enabled'	=> true,
                'title'		=> 'Viajá en Crucero por los mejores destinos',
                'link'		=> null,
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/crucero.jpg',
                'places'	=> [
                    'cruises'
                ]
            ],
            11	=> [
                'enabled'	=> true,
                'title'		=> 'Viajá tranquilo 40% OFF',
                'link'		=> null,
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/asis2.jpg',
                'places'	=> [
                    'insurance'
                ]
            ],
            12	=> [
                'enabled'	=> true,
                'title'		=> 'Viajá tranquilo, viajá a lugares increíbles',
                'link'		=> null,
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/asis1.jpg',
                'places'	=> [
                    'insurance'
                ]
            ],
            13	=> [
                'enabled'	=> true,
                'title'		=> 'Viajá seguro',
                'link'		=> null,
                'src'		=> 'http://img.garbarinoviajes.com.ar/img/cybermonday/widgets/SLIDER1300/asis3.jpg',
                'places'	=> [
                    'insurance'
                ]
            ]
        ];
        //
        $items = [];
        foreach ($sliders as $key => $item)
        {
            $add = false;
            if (true==$item['enabled'])
            {
                if (""===$mode)
                {
                    $add = true;
                } else {
                    foreach ($item['places'] as $place)
                    {
                        if ($mode===$place)
                        {
                            $add = true;
                        }
                    }
                }
            }
            //
            if (true===$add)
            {
                unset($item['enabled']);
                unset($item['places']);
                $items[] = $item;
            }
        }
        return $items;
    }

    static function getDestinations()
    {
        $destinations = [
            0	=> [
                'enabled'		=> true,
                'class'			=> 'caribe',
                'href'			=> '/ofertas/caribe',
                'title'			=> 'Caribe',
                'buttons'		=> '/images/components/buttons/caribe.png',
                'buttons-hover'	=> '/images/components/buttons/caribe-hover.png',
                'headers'		=> '/images/components/headers/caribe.jpg'
            ],
            1	=> [
                'enabled'		=> true,
                'class'			=> 'verano',
                'href'			=> '/ofertas/verano',
                'title'			=> 'Verano',
                'buttons'		=> '/images/components/buttons/verano.png',
                'buttons-hover'	=> '/images/components/buttons/verano-hover.png',
                'headers'		=> '/images/components/headers/verano.jpg'
            ],
            2	=> [
                'enabled'		=> true,
                'class'			=> 'europa',
                'href'			=> '/ofertas/europa',
                'title'			=> 'Europa',
                'buttons'		=> '/images/components/buttons/europa.png',
                'buttons-hover'	=> '/images/components/buttons/europa-hover.png',
                'headers'		=> '/images/components/headers/europa.jpg'
            ],
            3	=> [
                'enabled'		=> true,
                'class'			=> 'argentina',
                'href'			=> '/ofertas/argentina',
                'title'			=> 'Argentina',
                'buttons'		=> '/images/components/buttons/argentina.png',
                'buttons-hover'	=> '/images/components/buttons/argentina-hover.png',
                'headers'		=> '/images/components/headers/argentina.jpg'
            ],
            4	=> [
                'enabled'		=> true,
                'class'			=> 'exotico',
                'href'			=> '/ofertas/exotico',
                'title'			=> 'Exóticos',
                'buttons'		=> '/images/components/buttons/exotico.png',
                'buttons-hover'	=> '/images/components/buttons/exotico-hover.png',
                'headers'		=> '/images/components/headers/exotico.jpg'
            ],
            5	=> [
                'enabled'		=> true,
                'class'			=> 'escapada',
                'href'			=> '/ofertas/escapada',
                'title'			=> 'Escapada',
                'buttons'		=> '/images/components/buttons/escapada.png',
                'buttons-hover'	=> '/images/components/buttons/escapada-hover.png',
                'headers'		=> '/images/components/headers/escapada.jpg'
            ],
            6	=> [
                'enabled'		=> true,
                'class'			=> 'brasil',
                'href'			=> '/ofertas/brasil',
                'title'			=> 'Brasil',
                'buttons'		=> '/images/components/buttons/brasil.png',
                'buttons-hover'	=> '/images/components/buttons/brasil-hover.png',
                'headers'		=> '/images/components/headers/brasil.jpg'
            ],
            7	=> [
                'enabled'		=> true,
                'class'			=> 'cancun',
                'href'			=> '/ofertas/cancun',
                'title'			=> 'Cancún',
                'buttons'		=> '/images/components/buttons/cancun.png',
                'buttons-hover'	=> '/images/components/buttons/cancun-hover.png',
                'headers'		=> '/images/components/headers/cancun.jpg'
            ],
            8	=> [
                'enabled'		=> true,
                'class'			=> 'puntacana',
                'href'			=> '/ofertas/puntacana',
                'title'			=> 'Punta Cana',
                'buttons'		=> '/images/components/buttons/puntacana.png',
                'buttons-hover'	=> '/images/components/buttons/puntacana-hover.png',
                'headers'		=> '/images/components/headers/puntacana.jpg'
            ]
        ];
        $items = [];
        foreach ($destinations as $key => $item)
        {
            if (true==$item['enabled'])
            {
                $items[] = $item;
            }
        }
        return $items;
    }
}