<?php

namespace OnsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OnsBundle:Default:indexlayout.html.twig');
    }
}
