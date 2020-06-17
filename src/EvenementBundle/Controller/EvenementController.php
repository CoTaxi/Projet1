<?php

namespace EvenementBundle\Controller;

use EvenementBundle\Entity\Evennement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
    public function deleteAction(Request $request){
        $em= $this->getDoctrine()->getManager();
        $id=$request->get("id");
        var_dump($id);
        $event=$em->getRepository('EvenementBundle:Evennement')->find($id);
        $em->remove($event);
        $em->flush();
        return $this->render('@Evenement/Back/indexB.html.twig');
    }
    public function addAction(Request $request){
        $em= $this->getDoctrine()->getManager();
        $event = new Evennement();
        $dateD = new \DateTime($request->get("start"));
        $dateF = new \DateTime($request->get("end"));

        $event->setDateEvent($dateD);
        $event->setDateEventFin($dateF);
        $event->setNomEvent($request->get("title"));
        $event->setEtat('a');
        $event->setEmplacement('a');
        $event->setCapacite(5);
        $event->setDureeEvent(5);
        $em->persist($event);
        $em->flush();
        return $this->render('@Evenement/Back/indexB.html.twig');

    }
    public function modifAction(Request $request){
        $em= $this->getDoctrine()->getManager();

        $id=$request->get("id");
        $event=$em->getRepository('EvenementBundle:Evennement')->find($id);
        $dateD = new \DateTime($request->get("start"));
        $dateF = new \DateTime($request->get("end"));

        $event->setDateEvent($dateD);
        $event->setDateEventFin($dateF);
        $event->setNomEvent($request->get("title"));
        $em->persist($event);
        $em->flush();
        return $this->render('@Evenement/Back/indexB.html.twig');

    }
    public function calendar()
    {
        return $this->render('@Evenement/calendar.html.twig');
    }
    public function newAction(Request $request)
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
}
