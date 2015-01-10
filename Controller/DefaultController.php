<?php

namespace FabLab\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FabLabManagerBundle:Default:index.html.twig', array(
            
        ));
    }
}
