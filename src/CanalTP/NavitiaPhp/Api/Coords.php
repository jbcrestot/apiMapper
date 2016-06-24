<?php

namespace CanalTP\NavitiaPhp\Api;

use CanalTP\NavitiaPhp\Navitia;

class Coords {

    private $navitia;

    /**
     * Coverage constructor.
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
        return $this->navitia->call(array('path' => array('coords' => $coords)));
    }
}