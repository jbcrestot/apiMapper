<?php

namespace CanalTP\NavitiaPhp\Api;

use CanalTP\NavitiaPhp\Navitia;

class Coords {

    private $navitia;

    /**
     * Coords constructor.
     * @param Navitia $navitia
     */
    public function __construct(Navitia $navitia)
    {
        $this->navitia = $navitia;
    }

    /**
     * @param $coords
     * @return mixed
     * @throws \CanalTP\NavitiaPhp\Exception\NavitiaException
     */
    public function getInformations($coords)
    {
        return $this->navitia->call(array('path' => array(
            0 => array(
                'element' => 'coords',
                'value'   => $coords
            )
        )));
    }

    public function getClosePois($coords, array $query)
    {
        return $this->navitia->call(array(
            'path' => array(
                0 => array(
                    'element' => 'coords',
                    'value'   => $coords
                )
            ),
            'query' => $query

        ));
    }
}