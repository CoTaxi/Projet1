<?php

namespace TaxiCoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('default/acceuil.html.twig');
    }
    public function ourservicesAction()
    {
        return $this->render('default/ourservices.html.twig');
    }
}
