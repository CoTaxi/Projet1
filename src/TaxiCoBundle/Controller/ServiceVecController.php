<?php

namespace TaxiCoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TaxiCoBundle\Entity\Vehicule;

class ServiceVecController extends Controller
{

    public function listjsonAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $vehicule = $em->getRepository('TaxiCoBundle:Vehicule')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($vehicule);
        return new JsonResponse($formatted);
    }
    public function findjsonAction($matricule)
    {
        $vehicule = $this->getDoctrine()->getManager()
            ->getRepository('TaxiCoBundle:Vehicule')
            ->find($matricule);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($vehicule);
        return new JsonResponse($formatted);
    }

    public function loadAction($idv)
    {
        //  $idv= $request->get('id');
        $em= $this->getDoctrine()->getManager();
        $vehicules= $em->getRepository(Vehicule::class)->findby(['id'=>$idv]);
        $jsonData = array();
        $idx = 0;
        foreach($vehicules as $vec) {

            $temp = array(
                'id' => $vec->getId(),
                'matricule' => $vec->getMatricule(),
                'modele' => $vec->getModele()
            );
            $jsonData[$idx++] = $temp;
        }
        return new JsonResponse($jsonData);

    }

    public function AjoutjsonAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $vehicule = new Vehicule();
        $vehicule->setMatricule($request->get('matricule'));
        $vehicule->setMarque($request->get('marque'));
        $vehicule->setModele($request->get('modele'));
        $vehicule->setCouleur($request->get('couleur'));
        $vehicule->setCartegrise($request->get('cartegrise'));
        $vehicule->setPlaces($request->get('place'));
        $vehicule->setPosition($request->get('position'));
        $vehicule->setAcceptC($request->get('accept_c'));
        $vehicule->setDestination($request->get('destination'));

        $em->persist($vehicule);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($vehicule);
        return new JsonResponse($formatted);
    }

    public function findselectedAction(Request $request){
        $type = $request->get('matricule');
        $em=$this->getDoctrine()->getManager();
        $vehicule = $em->getRepository(Vehicule::class)->findBy(array('matricule' => $type));
        $data = array();
        foreach ($vehicule as $key => $blog){
            $data[$key]['id'] = $blog->getId();
            $data[$key]['matricule'] = $blog->getMatricule();
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($data);
        return new JsonResponse($data);
    }

    public function deletejsonAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $Post = $em->getRepository("TaxiCoBundle:Vehicule")->find($id);
        $em->remove($Post);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Post);
        return new JsonResponse($formatted);
    }


}
