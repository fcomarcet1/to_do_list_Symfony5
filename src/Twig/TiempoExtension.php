<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TiempoExtension extends AbstractExtension
{
    const CONFIGURACION = [
        'formato' => 'Y/m/d H:m:s'
    ];

    public function getFilters()
    {
        return [
            new TwigFilter('tiempo', [$this, 'formatearTiempo']),
        ];
    }

    public function formatearTiempo($fecha, $configuracion = []) {

        $configuracion = array_merge(self::CONFIGURACION, $configuracion);
        $fechaActual = new \DateTime();
        $fechaFormateada = $fecha->format($configuracion['formato']);
        $diferenciaFechasSegundos = ($fechaActual->getTimestamp()) - ($fecha->getTimestamp());

        /*
            dump($configuracion);
            dump($fechaActual);
            dump($fechaFormateada);
            dump($diferenciaFechasSegundos);
        */

        if ( $diferenciaFechasSegundos < 60) {
            $fechaFormateada = 'creado ahora mismo';
        }
        elseif ($diferenciaFechasSegundos < 3600) {
            $fechaFormateada = 'creado recientemente';
        }
        elseif ($diferenciaFechasSegundos < 21600) {
            $fechaFormateada = 'creado hace 6h';
        }
        elseif ($diferenciaFechasSegundos < 43200) {
            $fechaFormateada = 'creado hace 12h';
        }
        elseif ($diferenciaFechasSegundos < 86400) {
            $fechaFormateada = 'creado hace 1 dia';
        }
        //dump($fechaFormateada); die();
        return  $fechaFormateada;
    }

}