<?php

namespace TaxiCoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TaxiCoBundle\Entity\Vehicule;
use TaxiCoBundle\Form\Vehiculeform;
use TaxiCoBundle\Form\VehiculeType;

class VehiculeController extends Controller
{
    public function ajoutVehiculeAction(Request $request){
        $us=$this->getUser();
            $usrId = $this->get('security.token_storage')->getToken()->getUser()->getId();
            $vehicule = new Vehicule();
        $vehicule->setUser($usrId);
            $form = $this->createForm(VehiculeType::class,$vehicule);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $file=$vehicule->getMatricule();
            $filename=md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter( 'photos_directory'),$filename);
            $vehicule->setMatricule($filename);
            $file1=$vehicule->getCartegrise();
            $filename1=md5(uniqid()) . '.' . $file1->guessExtension();
            $file1->move($this->getParameter( 'photos_directory'),$filename1);
            $vehicule->setCartegrise($filename1);
            $em->persist($vehicule);
            $em->flush();
        }
        return $this->render('Vehicule/Vehicule.html.twig',
            array('form' => $form->createView(),'user'=>$us));
    }

    public function listVehiculeAction(Request $request)
    {
        $us=$this->getUser();
        return $this->render('Vehicule/listVehicule.html.twig',array('user'=>$us));
    }

    public function taxiAction(Request $request){
        $us=$this->getUser();
        $usrId = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $vehicule=$em->getRepository('TaxiCoBundle:Vehicule')->findBy(array('user'=>$usrId));
        return $this->render('Vehicule/listTaxi.html.twig',
            array('vehicule'=>$vehicule,
                'user'=>$us
            ));
    }
    public function CovoiturageAction(Request $request){

        $usrId = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $vehicule=$em->getRepository('TaxiCoBundle:Vehicule')->findBy(array('user'=>$usrId));
        return $this->render('Vehicule/listCovoiturage.html.twig',
            array('vehicule'=>$vehicule));
    }



    public function updateTaxiAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $v= $em->getRepository('TaxiCoBundle:Vehicule')->find($id);
        $form=$this->createForm(VehiculeType::class,$v);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $file = $v->getMatricule();
            $filename=md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter( 'photos_directory'),$filename);
            $v->setMatricule($filename);
            $em= $this->getDoctrine()->getManager();
            $em->persist($v);
            $em->flush();
            return $this->redirectToRoute('vehicule_taxi');

        }
        return $this->render('Vehicule/updateTaxi.html.twig', array(
            "Form"=> $form->createView()
        ));

    }
    public function deleteVehiculeAction(Request $request)
    {
        $id = $request->get('id');
        $em= $this->getDoctrine()->getManager();
        $Post=$em->getRepository('TaxiCoBundle:Vehicule')->find($id);
        $em->remove($Post);
        $em->flush();
        return $this->redirectToRoute('vehicule_listVehicule');
    }
    public function ColisChauffeurAction(Request $request,$idV)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Vehicule::class)->find($idV);
        $form = $this->createForm(Vehiculeform::class,$find);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($find);
            $em->flush();
            return $this->redirectToRoute('vehicule_listVehicule');
        }
        return $this->render('Vehicule/updateTaxi.html.twig', array(
            'Form'=>$form->createView()
        ));
    }







}
