<?php

namespace TheFireflies\SportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TheFirefliesSportBundle:Default:index.html.twig', array('name' => $name));
    }
}
