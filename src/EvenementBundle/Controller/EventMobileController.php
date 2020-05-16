<?php


namespace EvenementBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class EventMobileController extends Controller
{
    public function alleventAction()
    {
        $event = $this->getDoctrine()->getManager()
            ->getRepository('EvenementBundle:Evennement')
            ->findAll();
        $datas = array();
        foreach ($event as $key => $ev)
        {
            $datas[$key]['id'] = $ev->getIdEvent();
            $datas[$key]['nom'] = $ev->getNomEvent();
            $datas[$key]['date'] = $ev->getDateEvent();
            $datas[$key]['fin'] = $ev->getDateEventFin();
            $datas[$key]['duree'] = $ev->getDureeEvent();
            $datas[$key]['capacite'] = $ev->getCapacite();
            $datas[$key]['emplacement'] = $ev->getEmplacement();
            $datas[$key]['etat'] = $ev->getEtat();
            $datas[$key]['place'] = $ev->getPlace();

        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }
    public function ParticiperAction($idev,$iduser)
    {
        $em=$this->getDoctrine()->getManager();
        $findevent=  $this->getDoctrine()->getManager()
            ->getRepository('EvenementBundle:Evennement')->findBy(array('idEvent'=>$idev));
        $finduser=  $this->getDoctrine()->getManager()
            ->getRepository('TaxiCoBundle:User')->findBy(array('id'=>$iduser));
        foreach ($findevent as $find) {
            $nomevent=$find->getNomEvent();
            $find->setPlace($find->getPlace()+1);
            $em->persist($find);
            foreach ($finduser as $findu) {
                $findu->setNomEvent($nomevent);
                $em->persist($findu);
            }
        }
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($findevent);
        return new JsonResponse($formatted);
    }
    public function QuitterAction($idev,$iduser)
    {
        $em=$this->getDoctrine()->getManager();
        $findevent=  $this->getDoctrine()->getManager()
            ->getRepository('EvenementBundle:Evennement')->findBy(array('idEvent'=>$idev));
        $finduser=  $this->getDoctrine()->getManager()
            ->getRepository('TaxiCoBundle:User')->findBy(array('id'=>$iduser));
        foreach ($findevent as $find) {
            $nomevent=$find->getNomEvent();
            $find->setPlace($find->getPlace()-1);
            $em->persist($find);
            foreach ($finduser as $findu) {
                $findu->setNomEvent("none");
                $em->persist($findu);
            }
        }
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($findevent);
        return new JsonResponse($formatted);
    }
    public function findeventAction($id)
    {
        $findevent=  $this->getDoctrine()->getManager()
            ->getRepository('EvenementBundle:Evennement')->findBy(array('idEvent'=>$id));
        $datas = array();
        foreach ($findevent as $key => $ev)
        {
            $datas[$key]['id'] = $ev->getIdEvent();
            $datas[$key]['nom'] = $ev->getNomEvent();
            $datas[$key]['date'] = $ev->getDateEvent();
            $datas[$key]['fin'] = $ev->getDateEventFin();
            $datas[$key]['duree'] = $ev->getDureeEvent();
            $datas[$key]['capacite'] = $ev->getCapacite();
            $datas[$key]['emplacement'] = $ev->getEmplacement();
            $datas[$key]['etat'] = $ev->getEtat();
            $datas[$key]['place'] = $ev->getPlace();

        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }
    public function listuserAction($iduser)
    {

        $datas = array();
        $finduser=  $this->getDoctrine()->getManager()
            ->getRepository('TaxiCoBundle:User')->findBy(array('id'=>$iduser));

            foreach ($finduser as $key => $findus)
            {
                $datas[$key]['id'] = $findus->getId();
                $datas[$key]['type'] = $findus->getType();
                $datas[$key]['username'] = $findus->getUsername();
                $datas[$key]['email'] = $findus->getEmail();
                $datas[$key]['event'] = $findus->getNomEvent();
            }

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }
}