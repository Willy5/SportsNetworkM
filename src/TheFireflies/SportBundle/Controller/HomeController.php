<?php

namespace TheFireflies\SportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * Home page.
     *
     */
    public function indexAction()
    {
        return $this->render('TheFirefliesSportBundle:Home:index.html.twig');
    }
}
