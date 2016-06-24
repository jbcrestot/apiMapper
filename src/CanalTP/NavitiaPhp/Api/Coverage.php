<?php

namespace CanalTP\NavitiaPhp\Api;

use CanalTP\NavitiaPhp\Navitia;

class Coverage {

    private $navitia;

    /**
     * Coverage constructor.
     */
    public function __construct(Navitia $navitia)
    {
        $this->navitia = $navitia;
    }

    /**
     * return a list of the areas covered by navitia
     *
     * @return string
     * @throws \CanalTP\NavitiaPhp\Exception\NavitiaException
     */
    public function getList()
    {
        return $this->navitia->call(array('coverage' => ''));
    }

    /**
     * get Information about a specific region
     * if no coverage given, get information of the coverage you defined in Navitia
     *
     * @param null/string $coverage
     * @return string
     * @throws \Canaltp\NavitiaPhp\Exception\NavitiaException
     */
    public function getInformations($coverage = null)
    {
        if (empty($coverage)) {
            return $this->navitia->call(array());
        }

        return $this->navitia->call(array('coverage' => $coverage));
    }
}