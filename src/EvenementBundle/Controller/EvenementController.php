<?php

namespace EvenementBundle\Controller;

use EvenementBundle\Entity\Evennement;
use EvenementBundle\Form\EvennementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TaxiCoBundle\Entity\User;

class EvenementController extends Controller
{
    public function showBackAction()
    {
        return $this->render('@Evenement/Back/indexB.html.twig');
    }



    public function loadAction()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        $em= $this->getDoctrine()->getManager();
        $events =$em->getRepository('EvenementBundle:Evennement')->findAll();

        foreach($events as $row)
        {
            $data[] = array(
                "id"   => $row->getIdEvent(),
                'title'   => $row->getNomEvent(),
                'start'   => $row->getDateEvent()->format('Y-m-d H:i:s'),
                'end'   => $row->getDateEventFin()->format('Y-m-d H:i:s')
            );
        }
        $jsonContent = $serializer->serialize($data, 'json');
      //  echo $jsonContent;
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        //echo $response;
        //echo ('******************************');
        //echo($jsonContent);
       // echo ('******************************');
       // dump($response);exit;
        return $response;

    }
    public function deleteAction(Request $request,$id){
        $em= $this->getDoctrine()->getManager();
        var_dump($id);
        $event=$em->getRepository('EvenementBundle:Evennement')->find($id);
        $forum =$em->getRepository('EvenementBundle:Evennement')->findAll();
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute("afficherback");
    }
    public function addAction(Request $request){
        $em= $this->getDoctrine()->getManager();
        $event = new Evennement();
        $dateD = new \DateTime($request->get("start"));
        $dateF = new \DateTime($request->get("end"));

        $event->setDateEvent($dateD);
        $event->setDateEventFin($dateF);
        $event->setNomEvent($request->get("title"));
        $event->setEtat('0');
        $event->setEmplacement('a');
        $event->setCapacite(5);
        $event->setDureeEvent(5);
        $em->persist($event);
        $em->flush();
        return $this->render('@Evenement/Back/afficher.html.twig');

    }

    public function afficherbackAction(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $forum =$em->getRepository('EvenementBundle:Evennement')->findAll();
        return $this->render('@Evenement/Back/afficher.html.twig',array('event'=>$forum));
    }
    public function newAction(Request $request)
    {
            $Event = new Evennement();
            $Event->setEtat(0);
            $form = $this->createForm('EvenementBundle\Form\EvennementType', $Event);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($Event);
                $em->flush();
                return $this->redirectToRoute('afficherback');
            }
            return $this->render('@Evenement/Back/new.html.twig', array(
                'form' => $form->createView(),
            ));
    }
    public function modifAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $event=$em->getRepository('EvenementBundle:Evennement')->find($id);
        $form = $this->createForm(EvennementType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('afficherback');
        }
        return $this->render('@Evenement/Back/update.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    public function updateAction(Request $request)
    {
        $Event = new Evennement();
        $form = $this->createForm('EvenementBundle\Form\EvennementType', $Event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Event);
            $em->flush();
            return $this->redirectToRoute('Event_Back');
        }
        return $this->render('@Evenement/Back/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    public function showAction(Request $request)
    {
        $us=$this->getUser();
        if($us != null) {
        $em= $this->getDoctrine()->getManager();
        $event =$em->getRepository('EvenementBundle:Evennement')->findBy(['etat'=>0]);
        $iduser= $this->get('security.token_storage')->getToken()->getUser()->getId();

        $find = $this->getDoctrine()->getRepository(User::class)->find($iduser);
        return $this->render('@Evenement/Default/show.html.twig',array(

            'f'=>$event,
            'user'=>$find
        ));
        }
        else
        {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
    public function ParticiperEvAction($idev)
    {
        $em=$this->getDoctrine()->getManager();
        $findevent=  $this->getDoctrine()->getManager()
            ->getRepository('EvenementBundle:Evennement')->findBy(array('idEvent'=>$idev));
        $iduser= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $finduser=  $this->getDoctrine()->getManager()
            ->getRepository('TaxiCoBundle:User')->find($iduser);

        $event =$em->getRepository('EvenementBundle:Evennement')->findBy(['etat'=>0]);
        foreach ($findevent as $find) {
            $nomevent=$find->getNomEvent();
            $find->setPlace($find->getPlace()+1);
            $em->persist($find);
            $finduser->setNomEvent($nomevent);
                $em->persist($finduser);
        }
        $em->flush();
        return $this->render('@Evenement/Default/show.html.twig',array(

            'f'=>$event,
            'user'=>$finduser
        ));
    }
    public function QuitterEvAction($idev)
    {
        $em=$this->getDoctrine()->getManager();
        $findevent=  $this->getDoctrine()->getManager()
            ->getRepository('EvenementBundle:Evennement')->findBy(array('idEvent'=>$idev));
        $iduser= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $finduser=  $this->getDoctrine()->getManager()
            ->getRepository('TaxiCoBundle:User')->find($iduser);

        $event =$em->getRepository('EvenementBundle:Evennement')->findBy(['etat'=>0]);
        foreach ($findevent as $find) {
            $nomevent=$find->getNomEvent();
            $find->setPlace($find->getPlace()-1);
            $em->persist($find);
            $finduser->setNomEvent("none");
                $em->persist($finduser);
        }
        $em->flush();
        return $this->render('@Evenement/Default/show.html.twig',array(

            'f'=>$event,
            'user'=>$finduser
        ));
    }
    public function calendar()
    {
        return $this->render('@Evenement/calendar.html.twig');
    }
    public function archiverAction(Request $request, $id){

        $em= $this->getDoctrine()->getManager();

        $event=$em->getRepository('EvenementBundle:Evennement')->find($id);
        $event->setEtat(1);
        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute('afficherback');

    }
    public function desarchiverAction(Request $request, $id){

        $em= $this->getDoctrine()->getManager();

        $event=$em->getRepository('EvenementBundle:Evennement')->find($id);
        $event->setEtat(0);
        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute('afficherback');

    }
}
