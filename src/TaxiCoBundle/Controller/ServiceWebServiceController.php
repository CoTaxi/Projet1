<?php

namespace TaxiCoBundle\Controller;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TaxiCoBundle\Entity\Garage;
use TaxiCoBundle\Entity\Rdv;
use TaxiCoBundle\Entity\Service;

use Symfony\Component\HttpFoundation\Request;
use TaxiCoBundle\Form\RdvType;
use TaxiCoBundle\Form\ReserveType;
use TaxiCoBundle\Repository\RdvRepository;

class ServiceWebServiceController extends Controller
{
    public function DisplayAction()
    {
        $em = $this->getDoctrine()->getManager();

        $service = $em->getRepository(Service::class)->findAll();
        $datas = array();
        foreach ($service as $key => $blog){
            $datas[$key]['idService'] = $blog->getIdService();
            $datas[$key]['name'] = $blog->getName();

        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($service);
        return new JsonResponse($datas);
    }

    public function updateAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $service=$this->getDoctrine()->getRepository(Service::class)->find($id);
        $service->setStatus($request->get('status'));
        $em->persist($service);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($service);
        return new JsonResponse($formatted);
    }
    public function findAction(Request $request)
    {

//        $em->getConnection()->setAutoCommit(false);
        $name = $request->get('name');
        $em=$this->getDoctrine()->getManager();
        $services = $em->getRepository(Service::class)->findBy(array('name'=>$name));
        $data = array();
        foreach ($services as $key => $blog){
            $data[$key]['idService'] = $blog->getIdService();
            $data[$key]['name'] = $blog->getName();

        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($data);
        return new JsonResponse($data);

    }
}
