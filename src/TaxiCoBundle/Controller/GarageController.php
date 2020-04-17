<?php

namespace TaxiCoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TaxiCoBundle\Entity\Garage;
use Symfony\Component\HttpFoundation\Request;
use TaxiCoBundle\Form\GarageType;

class GarageController extends Controller
{
    public function DisplayAction()
    {
        $em = $this->getDoctrine()->getManager();

        $garage = $em->getRepository(Garage::class)->findAll();
        return $this->render('@TaxiCo/Garage/display.html.twig', array('garages' => $garage
        ));
    }

    public function createAction(Request $request)
    {   //create an object to store our data after the form submission
        $garage=new Garage();
        //prepare the form with the function: createForm()
        $form=$this->createForm(GarageType::class,$garage);
        //extract the form answer from the received request
        $form=$form->handleRequest($request);
        //if this form is valid
        if($form->isValid()){
            //create an entity manager object
            $em=$this->getDoctrine()->getManager();
            //persist the object $club in the ORM
            $em->persist($garage);
            //update the data base with flush
            $em->flush();
            //redirect the route after the add
            return $this->redirectToRoute('displaygarage');
        }
        return $this->render('@TaxiCo/Garage/create.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function updateAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Garage::class)->find($id);
        $form = $this->createForm(GarageType::class,$find);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($find);
            $em->flush();
            return $this->redirectToRoute('displaygarage');
        }
        return $this->render('@TaxiCo/Garage/create.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Garage::class)->find($id);
        $em->remove($find);
        $em->flush();
        return $this->redirectToRoute('displaygarage');
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

}
