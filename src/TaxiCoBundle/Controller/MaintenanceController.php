<?php

namespace TaxiCoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MaintenanceController extends Controller
{
    public function DisplayAction()
    {
        $em = $this->getDoctrine()->getManager();

        $service = $em->getRepository(Service::class)->findAll();
        return $this->render('@TaxiCo/Maintenance/display.html.twig', array('services' => $service
        ));
    }

    public function UpdateAction()
    {
        return $this->render('TaxiCoBundle:Maintenance:update.html.twig', array(
            // ...
        ));
    }
    /**
     * Creates a new coli entity.
     *
     */
//    public function newAction(Request $request)
//    {
//        $service = new Service();
//        $form = $this->createForm('TaxiCoBundle\Form\ServiceType', $service);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($service);
//            $em->flush();
//
//            return $this->redirectToRoute('colis_show', array('idC' => $colis->getIdc()));
//        }
//
//        return $this->render('colis/new.html.twig', array(
//            'coli' => $colis,
//            'form' => $form->createView(),
//        ));
//    }
    public function frontAction()
    {
        return $this->render('@TaxiCo/Rdv/front.html.twig');
    }

    public function maintAction(Request $request){

        return $this->render('@TaxiCo/Maintenance/maint.html.twig');
    }
}
