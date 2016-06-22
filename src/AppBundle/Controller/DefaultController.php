<?php

namespace AppBundle\Controller;

use CanalTP\NavitiaPhp\Api\Coverage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {


        $coverages = $this->get('navitia_coverage')->get();
        dump($coverages);

        return $this->render('AppBundle::index.html.twig');
    }
}
