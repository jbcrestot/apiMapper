<?php

namespace AppBundle\Controller;

use CanalTP\NavitiaPhp\Api\Coverage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
//        return $this->render('AppBundle::index.html.twig', array('dump' => $dump));
    }

    public function coverageAction(Request $request)
    {
        $dump[] = $this->get('navitia')->get('coverage')->getInformations();

        return $this->renderIndex($dump);
    }

    public function coordsAction(Request $request)
    {
        $dump[] = $this->get('navitia')->get('coords')->getInformations('2.37705;48.84675');

        $dump[] = $this->get('navitia')->get('coords')->getClosePois('2.37705;48.84675', array('distance' => 1000));
        
        return $this->renderIndex($dump);
    }

    public function trafficReportsAction(Request $request)
    {
        $dump[] = $this->get('navitia')->get('traffic_reports')->forCoverage();
        
        return $this->renderIndex($dump);
    }

    public function networksAction(Request $request)
    {
        $dump[] = $this->get('navitia')->get('networks')->getAll();

        return $this->renderIndex($dump);
    }

    public function linesAction(Request $request)
    {
        $dump[] = $this->get('navitia')->get('lines')->getAll();

        $dump[] = $this->get('navitia')->get('lines')->getById('line:OIF:019248003:03OIF14');

        $dump[] = $this->get('navitia')->get('lines')->getById('line:OIF:019248003:03OIF14', ['odt_level' => 'scheduled']);

        return $this->renderIndex($dump);
    }

    private function renderIndex(array $dump)
    {
        return $this->render('AppBundle::index.html.twig', array('dump' => $dump));
    }
}
