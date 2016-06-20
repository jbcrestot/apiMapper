<?php

namespace AppBundle\Controller;

use CanalTP\NavitiaPhp\Api\Coverage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        new Coverage('tt');
        die('ici');

        $coverages = $this->get('navitia_coverage')->all();
        dump($coverages);

        return $this->render('AppBundle:Default:index.html.twig');
    }
}
