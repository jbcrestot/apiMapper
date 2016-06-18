<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Yaml\Yaml;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $networks = $this->get('navitia_coverge');

        if (200 === $networks->getStatusCode()) {
            $networksBody = (string) $networks->getBody();

            $a = Yaml::parse($networksBody);
            dump($a);
        }

        return $this->render('AppBundle:Default:index.html.twig');
    }
}
