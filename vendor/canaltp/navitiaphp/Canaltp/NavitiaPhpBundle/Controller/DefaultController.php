<?php

namespace Canaltp\NavitiaPhpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CanaltpNavitiaPhpBundle:Default:index.html.twig');
    }
}
