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

class ServiceWebRdvController extends Controller
{
    public function DisplayAction(Request $request)
    {
        $status = $request->get('status');
        $idChauffeur = $request->get('idChauffeur');
        $em = $this->getDoctrine()->getManager();
        $rdv = $em->getRepository(Rdv::class)->findBy(array('status'=>$status,
            'idChauffeur'=>$idChauffeur));
        $datas = array();
        foreach ($rdv as $key => $blog){
            $datas[$key]['idRdv'] = $blog->getIdRdv();
            $datas[$key]['idChauffeur'] = $blog->getIdChauffeur();
            $datas[$key]['service'] = $blog->getIdService()->getName();
            $datas[$key]['garage'] = $blog->getIdGarage()->getName();
            $datas[$key]['dateRdv'] = $blog->getDateRdv()->format('Y-m-d');
            $datas[$key]['status'] = $blog->getStatus();

        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }

    public function updateAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $idChauffeur = $request->get('idChauffeur');
        $rdv=$this->getDoctrine()->getRepository(Rdv::class)->find($id);
        $rdv->setStatus("nondisponible");
        $rdv->setIdChauffeur($idChauffeur);
        $em->persist($rdv);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($rdv);
        return new JsonResponse($formatted);
    }
    public function annulerAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $idChauffeur = $request->get('idChauffeur');
        $rdv=$this->getDoctrine()->getRepository(Rdv::class)->find($id);
        $rdv->setStatus("disponible");
        $rdv->setIdChauffeur($idChauffeur);
        $em->persist($rdv);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($rdv);
        return new JsonResponse($formatted);
    }
    public function findAction(Request $request)
    {
        $idservice = $request->get('idservice');
        $idgarage = $request->get('idgarage');
        $em=$this->getDoctrine()->getManager();
        $rdv = $em->getRepository(Rdv::class)->findBy(array('idService'=>$idservice,
            'idGarage' =>$idgarage));
        $data = array();
        foreach ($rdv as $key => $blog){
            $data[$key]['idRdv'] = $blog->getIdRdv();
            $data[$key]['idChauffeur'] = $blog->getIdChauffeur();
            $data[$key]['service'] = $blog->getIdService()->getIdService();
            $data[$key]['garage'] = $blog->getIdGarage()->getIdGarage();
            $data[$key]['dateRdv'] = $blog->getDateRdv()->format('Y-m-d');
            $data[$key]['status'] = $blog->getStatus();

        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($data);
        return new JsonResponse($data);

    }
    public function ReserveRdvAction(Request $request)
    {
        $daterdv = $request->get('dateRdv');
        $idservice = $request->get('idService');
        $idgarage = $request->get('idGarage');
        $em=$this->getDoctrine()->getManager();
        $rdv = $em->getRepository(Rdv::class)
            ->findOneBy(array('dateRdv'=>$daterdv,
                'idService'=>$idservice,
                'idGarage'=>$idgarage));
//        $data = array();
        $rdv->setStatus("nondisponible");
        $em->persist($rdv);
        $em->flush();
        foreach ($rdv as $key => $blog){
//            $data[$key]['idRdv'] = $blog->getIdRdv();
//            $data[$key]['idChauffeur'] = $blog->getIdChauffeur();
//            $data[$key]['service'] = $blog->getService()->getIdService();
//            $data[$key]['garage'] = $blog->getGarage()->getIdGarage();
//            $data[$key]['dateRdv'] = $blog->getDateRdv();
//            $data[$key]['status'] = $blog->getStatus();

        }

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($rdv);
        return new JsonResponse($formatted);

    }


    public function findselectedAction(Request $request){
        $dateRdv = $request->get('dateRdv');
        $em=$this->getDoctrine()->getManager();
        $rdv = $em->getRepository(Rdv::class)->findBy(array('dateRdv' => $dateRdv));
        $data = array();
        foreach ($rdv as $key => $blog){
            $data[$key]['idRdv'] = $blog->getIdRdv();
            $data[$key]['idChauffeur'] = $blog->getIdChauffeur();
            $data[$key]['service'] = $blog->getIdService()->getIdService();
            $data[$key]['garage'] = $blog->getIdGarage()->getIdGarage();
            $data[$key]['dateRdv'] = $blog->getDateRdv();
            $data[$key]['status'] = $blog->getStatus();

        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($data);
        return new JsonResponse($data);

    }

}
