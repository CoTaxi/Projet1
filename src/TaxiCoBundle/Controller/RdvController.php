<?php

namespace TaxiCoBundle\Controller;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use TaxiCoBundle\Entity\Garage;
use TaxiCoBundle\Entity\Rdv;
use TaxiCoBundle\Entity\Service;

use Symfony\Component\HttpFoundation\Request;
use TaxiCoBundle\Form\RdvType;
use TaxiCoBundle\Form\ReserveType;
use TaxiCoBundle\Repository\RdvRepository;

class RdvController extends Controller
{
    public function DisplayAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rdv = $em->getRepository(Rdv::class)->findAll();
        return $this->render('@TaxiCo/Rdv/display.html.twig', array('rdvs' => $rdv
        ));
    }
public function Display2Action()
    {
        $em = $this->getDoctrine()->getManager();

//        $service = $em->getRepository(Service::class)->findBy(name);
//        $garage = $em->getRepository(Garage::class)->findBy(name);
//        $rdv = $em->getRepository(Rdv::class)->findBy(dateRdv);
        $rdv2 = $em->getRepository(Rdv::class)->findrdv();
        dump($rdv2);
        return $this->render('@TaxiCo/Rdv/front2.html.twig', array(
            'rdvs' => $rdv2
//            'services' => $service,
//            'garages' => $garage,
        ));
    }

    public function createAction(Request $request)
    {   //create an object to store our data after the form submission
        $rdv=new Rdv();
        //prepare the form with the function: createForm()
        $form=$this->createForm(RdvType::class,$rdv);
        //extract the form answer from the received request
        $form=$form->handleRequest($request);
        //if this form is valid
        if($form->isValid()){
//            $name_service = $rdv->getIdService();
            //create an entity manager object
            $em=$this->getDoctrine()->getManager();

//            $array_service = $em->getRepository(Service::class)->findByIdService($name_service);
//            if($array_service!=null)
//            {
//                $rdv->setIdService($array_service[0]);
//                $rdv->setService($array_service[0]);
                //persist the object $club in the ORM
                $em->persist($rdv);
                //update the data base with flush
                $em->flush();
                //redirect the route after the add
                return $this->redirectToRoute('displayrdv');

//            }else {
//                return new Response('ce service n est pas affecter a un rdv');

//            }

        }
        return $this->render('@TaxiCo/Rdv/create.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function updateAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Rdv::class)->find($id);
        $form = $this->createForm(RdvType::class,$find);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($find);
            $em->flush();
            return $this->redirectToRoute("displayrdv");
        }
        return $this->render('@TaxiCo/Rdv/create.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Rdv::class)->find($id);
        $em->remove($find);
        $em->flush();
        return $this->redirectToRoute('displayrdv');
    }
//    /**
//     * Creates a new coli entity.
//     *
//     */
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

    public function list2Action(Request $request)
    {   $rdv = new Rdv();

//        $student->setDateofbirth(new \DateTime('now'));
        $em = $this->getDoctrine()->getManager();

        $rdv = $em->getRepository(Rdv::class)->findAll();
        $form = $this->createFormBuilder($rdv)

            ->add('service',EntityType::class,array(
                'class'=>'TaxiCoBundle:service','choice_label'=>'name','multiple'=>false,'expanded'  => true,));
        $em->persist($rdv);
        $em->flush();
        $ss = $em->getRepository(Rdv::class)->findDQL($rdv->getIdService());
            $form = $this->createFormBuilder($rdv)
            ->add('garage',EntityType::class,array($ss))
            ->add('Add',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if($request->isMethod('post') && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
        }



        return $this->render('@TaxiCo/Rdv/create.html.twig', array(
            'form'=>$form->createView()
        ));
    }
    public function create2Action(Request $request)
    {   //create an object to store our data after the form submission
        $rdv=new Rdv();
//        $service=new Service();
//        $service->setName("lavage");

        //prepare the form with the function: createForm()
        $form=$this->createForm(ReserveType::class,$rdv);
        //extract the form answer from the received request
        $form=$form->handleRequest($request);

        //if this form is valid
        if($form->isSubmitted() && $form->isValid()){
            $rdv->setStatus("nondisponible");
//            $name_service = $rdv->getIdService();
            //create an entity manager object
            $em=$this->getDoctrine()->getManager();
            $form->getData();
            dump($rdv->getStatus());
//            $em=$this->getDoctrine()->getRepository(Rdv::class)->setStatus("nondisponible");
//            $rdv->setStatus("nondisponible");
//            $form->setStatus("nondisponible");
//            $find=$this->getDoctrine()->getRepository(Rdv::class)->findBy($dateRdv);
//            $array_service = $em->getRepository(Service::class)->findByIdService($name_service);
//            if($array_service!=null)
//            {
//                $rdv->setIdService($array_service[0]);
//                $rdv->setService($array_service[0]);
            //persist the object $club in the ORM
            $em->persist($rdv);
            //update the data base with flush
            $em->flush();
            //redirect the route after the add
//            return $this->redirectToRoute('test');
//            >add('postedBy', HiddenType::class, array(
//                'data' => $options['idservice']
//$form = $this->createForm(NewsType::class, $news, array(
//    'postedBy' => $this->getUser()->getFullname(),
//);
        }
        return $this->render('@TaxiCo/Rdv/front.html.twig', array(
            'form'=>$form->createView()
        ));
    }
    public function frontAction(Request $request)
    {
        $rdv = new Rdv();
        $form = $this->createForm(ReserveType::class, $rdv);
        $form->handleRequest($request);
//
        if ($form->isSubmitted() && $form->isValid()) {
            $rdv ->setStatus("nondisponible");
            dump($rdv);
            die();
            $em = $this->getDoctrine()->getManager();
            $em->persist($rdv);
            $em->flush();
            return $this->redirectToRoute("test2");

        }
        return $this->render("@TaxiCo/Rdv/front.html.twig", array('form' => $form->createView()));
    }
    public function update2Action(Request $request)
    {
        $rdv = new Rdv();
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Rdv::class);
        $form = $this->createForm(ReserveType::class,$find);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $rdv->setStatus("nondisponible");
            $em->persist($find);
            $em->flush();
            return $this->redirectToRoute("test2");
        }
        return $this->render('@TaxiCo/Rdv/front.html.twig', array(
            'form'=>$form->createView()
        ));
    }
    public function listAction(Request $request)
    {
        $rdv = new Rdv();
        $form = $this->createForm(ReserveType::class, $rdv);
        $form->handleRequest($request);
//
        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getParent()->getData());
            $rdv ->setStatus("nondisponible");
//            dump($rdv);
            $em = $this->getDoctrine()->getManager();
            $em->persist($rdv);
            $em->flush();
            return $this->redirectToRoute("test2");

        }
        return $this->render("@TaxiCo/Rdv/front.html.twig", array('form' => $form->createView()));
    }
}
