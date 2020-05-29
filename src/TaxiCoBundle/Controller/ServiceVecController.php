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
        $iuser= $request->get('user');
        $em = $this->getDoctrine()->getManager();
        $vehicule = $em->getRepository('TaxiCoBundle:Vehicule')->findby(['user'=>$iuser]);
       // $vec = $em->getRepository('TaxiCoBundle:user')->findby(['user'=>$iuser]);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($vehicule);
        return new JsonResponse($formatted);
    }
    public function toutvecAction(Request $request)
    {
        $iuser= $request->get('user');
        $em = $this->getDoctrine()->getManager();
        $vehicule = $em->getRepository('TaxiCoBundle:Vehicule')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($vehicule);
        return new JsonResponse($formatted);
    }
    public function vecmatriculeAction(Request $request,$matricule)
    {

        $em = $this->getDoctrine()->getManager();
        $vehicule = $em->getRepository('TaxiCoBundle:Vehicule')->findBy(array('matricule'=>$matricule));
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
    public function finddispoAction($id)
    {
        $vehicule = $this->getDoctrine()->getManager()
            ->getRepository('TaxiCoBundle:Vehicule')
            ->findBy(['user'=>$id]);

        $datas = array();
        foreach ($vehicule as $key => $blog){
            $datas[$key]['id'] = $blog->getId();
            $datas[$key]['dispo'] = $blog->getDispo();


        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
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
        $vehicule->setUser($request->get('user'));
        $vehicule->setEtat(1);
        $vehicule->setDispo(1);
        $vehicule->setType("taxi");
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
    public function findPositionAction(Request $request,$position,$type)
    {

        $em=$this->getDoctrine()->getManager();
        $vehicule = $em->getRepository(Vehicule::class)->findBy(array('position' => $position,'type'=>$type));
        $data = array();
        foreach ($vehicule as $key => $blog){
            $data[$key]['id'] = $blog->getId();
            $data[$key]['matricule'] = $blog->getMatricule();
            $data[$key]['marque'] = $blog->getMarque();
            $data[$key]['modele'] = $blog->getModele();
            $data[$key]['dispo'] = $blog->getDispo();
            $data[$key]['destination'] = $blog->getDestination();
            $data[$key]['type'] = $blog->getType();
            $data[$key]['user'] = $blog->getUser();
            $data[$key]['places'] = $blog->getPlaces();
            $data[$key]['couleur'] = $blog->getCouleur();
            $data[$key]['position'] = $blog->getPosition();
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($data);
        return new JsonResponse($data);
    }
    public function findvecAction(Request $request,$position,$type)
    {

        $em=$this->getDoctrine()->getManager();
        $vehicule = $em->getRepository(Vehicule::class)->findBy(array('type'=>$type));
        $data = array();
        foreach ($vehicule as $key => $blog){
            if($blog->getPosition()!="$position") {
                $data[$key]['id'] = $blog->getId();
                $data[$key]['matricule'] = $blog->getMatricule();
                $data[$key]['marque'] = $blog->getMarque();
                $data[$key]['modele'] = $blog->getModele();
                $data[$key]['dispo'] = $blog->getDispo();
                $data[$key]['destination'] = $blog->getDestination();
                $data[$key]['type'] = $blog->getType();
                $data[$key]['user'] = $blog->getUser();
                $data[$key]['places'] = $blog->getPlaces();
                $data[$key]['couleur'] = $blog->getCouleur();
                $data[$key]['position'] = $blog->getPosition();
            }
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($data);
        return new JsonResponse($data);
    }
    public function deletejsonAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $vec = $em->getRepository("TaxiCoBundle:Vehicule")->find($id);
        $em->remove($vec);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($vec);
        return new JsonResponse($formatted);
    }
    public function updatevecAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $dispo = $request->get('dispo');
        $vehicule=$this->getDoctrine()->getRepository(Vehicule::class)->find($id);
        $vehicule->setDispo($dispo);

        $em->persist($vehicule);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($vehicule);
        return new JsonResponse($formatted);
    }
    public function ModifiervecAction(Request $request)
    {
        $id = $request->get('id');
        $em=$this->getDoctrine()->getManager();
        $vehicule=$this->getDoctrine()->getRepository(Vehicule::class)->find($id);
        $vehicule->setMatricule($request->get('matricule'));
        $em->persist($vehicule);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($vehicule);
        return new JsonResponse($formatted);
    }
    public function updatepositionAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $position = $request->get('position');
        $vehicule=$this->getDoctrine()->getRepository(Vehicule::class)->findOneBy(array('user'=>$id));
        $vehicule->setPosition($position);

        $em->persist($vehicule);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($vehicule);
        return new JsonResponse($formatted);
    }
    public function positionAction($id)
    {
        $vehicule = $this->getDoctrine()->getManager()
            ->getRepository('TaxiCoBundle:Vehicule')
            ->findBy(['user'=>$id]);

        $datas = array();
        foreach ($vehicule as $key => $blog){
            $datas[$key]['position'] = $blog->getPosition();


        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }







}
