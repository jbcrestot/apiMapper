<?php

namespace CanalTP\NavitiaPhpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CanalTPNavitiaPhpBundle:Default:index.html.twig');
    }
}
