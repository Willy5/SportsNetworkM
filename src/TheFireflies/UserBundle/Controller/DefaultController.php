<?php

namespace TheFireflies\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TheFirefliesUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
