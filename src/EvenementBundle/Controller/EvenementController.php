<?php

namespace EvenementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
                'id'   => $row->getIdEvent(),
                'title'   => $row->getNomEvent(),
                'start'   => $row->getDateEvent()->format('Y-m-d H:i:s'),
                'end'   => $row->getDateEventFin()->format('Y-m-d H:i:s')
            );
        }
        $jsonContent = $serializer->serialize($data, 'json');
        echo $jsonContent;
        $response = new Response(json_encode(array('data' => $data)));
        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }

    public function calendar()
    {
        return $this->render('@Evenement/calendar.html.twig');
    }
}
