<?php

namespace AppBundle\Controller;

use CanalTP\NavitiaPhp\Api\Coverage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
//        dump($this->get('navitia')->get('traffic_reports')->forCoverage());

        return $this->render('AppBundle::index.html.twig', array('dump' => $dump));
    }

    public function coverageAction(Request $request)
    {
        dump($this->get('navitia')->get('coverage')->getInformations());

        die;
    }

    public function coordsAction(Request $request)
    {
        echo 'coords infos';
        dump($this->get('navitia')->get('coords')->getInformations('2.37705;48.84675'));

        echo 'close POIs';
        dump($this->get('navitia')->get('coords')->getClosePois('2.37705;48.84675', array('distance' => 1000)));

        die;
    }
}
