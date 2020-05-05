<?php

namespace TaxiCoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TaxiCoBundle\Entity\Reclamation;
use TaxiCoBundle\Entity\typereclamation;

class ReclamationMobileController extends Controller
{
    public function allAction()
    {
        $reclamation = $this->getDoctrine()->getManager()
            ->getRepository("TaxiCoBundle:Reclamation")->findAll();
        $datas = array();
        foreach ($reclamation as $key => $blog) {
            $datas[$key]['idR'] = $blog->getIdR();
            $datas[$key]['message'] = $blog->getMessage();
            $datas[$key]['etat'] = $blog->getEtat();
            $datas[$key]['dateRec'] = $blog->getDateRec();
            $datas[$key]['Objet'] = $blog->getObjet()->getTitre();
            $datas[$key]['Reponse'] = $blog->getReponse();
        }
//        $serializer = new Serializer([new ObjectNormalizer()]);
//        $formatted = $serializer->normalize($reclamation);
        return new JsonResponse($datas);
    }

    public function allTypeAction()
    {
        $type = $this->getDoctrine()->getManager()
            ->getRepository("TaxiCoBundle:typereclamation")->findAll();
        $datas = array();
        foreach ($type as $key => $blog) {
            $datas[$key]['id'] = $blog->getId();
            $datas[$key]['titre'] = $blog->getTitre();
        }
//        $serializer = new Serializer([new ObjectNormalizer()]);
//        $formatted = $serializer->normalize($reclamation);
        return new JsonResponse($datas);
    }

    public function newAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $type = $request->get('IdType');
        $t = $em->getRepository(typereclamation::class)->findOneBy(array('id' => $type));
        $reclamation = new Reclamation();
        $reclamation->setMessage($request->get('message'));
        $reclamation->setObjet($t);
        $reclamation->setEtat("Non traitée");
        $reclamation->setDateRec(new \DateTime());
        $reclamation->setReponse("Aucune réponse");
        $em->persist($reclamation);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reclamation);
        return new JsonResponse($formatted);
    }

    public function findselectedAction(Request $request)
    {
        $type = $request->get('titre');
        $em = $this->getDoctrine()->getManager();
        $rec = $em->getRepository(typereclamation::class)->findBy(array('titre' => $type));
        $data = array();
        foreach ($rec as $key => $blog) {
            $data[$key]['id'] = $blog->getId();
            $data[$key]['titre'] = $blog->getTitre();
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($data);
        return new JsonResponse($data);

    }

    public function removeSelectedAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository("TaxiCoBundle:Reclamation")->find($id);
        $em->remove($reclamation);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reclamation);
        return new JsonResponse($formatted);
    }

    public function updateSelectedAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $find = $this->getDoctrine()->getRepository("TaxiCoBundle:Reclamation")->find($id);
        $find->setDateRec(new \DateTime());
        $find->setMessage($request->get('message'));
        $em->persist($find);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($find);
        return new JsonResponse($formatted);
    }
}
