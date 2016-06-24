<?php

namespace AppBundle\Controller;

use CanalTP\NavitiaPhp\Api\Coverage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $dump = $this->get('navitia')->get('coverage')->getInformations();


        return $this->render('AppBundle::index.html.twig', array('dump' => $dump));
    }
}
