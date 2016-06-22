<?php

namespace AppBundle\Controller;

use CanalTP\NavitiaPhp\Api\Coverage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        dump($this->get('navitia.coverage')->all());
        dump($this->get('navitia.coverage')->get());

        dump($this->get('navitia.coverage')->findByCoords('2.37705;48.84675'));

        dump($this->get('navitia.traffic_reports')->forCoverage());
//        die;


        return $this->render('AppBundle::index.html.twig');
    }
}
