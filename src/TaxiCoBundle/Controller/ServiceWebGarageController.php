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

class ServiceWebGarageController extends Controller
{
    public function DisplayAction()
    {
        $em = $this->getDoctrine()->getManager();

        $garage = $em->getRepository(Garage::class)->findAll();
        $data = array();
        foreach ($garage as $key => $blog){
            $data[$key]['idGarage'] = $blog->getIdGarage();
            $data[$key]['name'] = $blog->getName();
            $data[$key]['address'] = $blog->getAddress();
            $data[$key]['service'] = ([$blog->getService()->getIdService(),
                $blog->getService()->getName()]);

        }

        return new JsonResponse($data);
    }
//$serializer = new Serializer([new ObjectNormalizer()]);
//$formatted = $serializer->normalize($garage);
    public function updateAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $garage=$this->getDoctrine()->getRepository(Garage::class)->find($id);
        $garage->setStatus($request->get('status'));
        $em->persist($garage);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($garage);
        return new JsonResponse($formatted);
    }
    public function findAction(Request $request)
    {
        $id = $request->get('idservice');
        $em=$this->getDoctrine()->getManager();
        $garages = $em->getRepository(Garage::class)->findBy(array('idService'=>$id));
        $data = array();
        foreach ($garages as $key => $blog){
            $data[$key]['idGarage'] = $blog->getIdGarage();
            $data[$key]['name'] = $blog->getName();
            $data[$key]['address'] = $blog->getAddress();
            $data[$key]['service'] = $blog->getService()->getIdService();

        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($data);
        return new JsonResponse($data);

    }
    public function findSelectedAction(Request $request)
    {
        $name = $request->get('name');
        $em=$this->getDoctrine()->getManager();
        $garages = $em->getRepository(Garage::class)->findBy(array('name'=>$name));
        $data = array();
        foreach ($garages as $key => $blog){
            $data[$key]['idGarage'] = $blog->getIdGarage();
            $data[$key]['name'] = $blog->getName();
            $data[$key]['address'] = $blog->getAddress();
            $data[$key]['service'] = $blog->getService()->getIdService();

        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($data);
        return new JsonResponse($data);

    }
}
