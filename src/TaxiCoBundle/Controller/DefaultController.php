<?php

namespace TaxiCoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('default/acceuil.html.twig');
    }
}
