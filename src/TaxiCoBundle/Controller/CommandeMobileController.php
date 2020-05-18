<?php


namespace TaxiCoBundle\Controller;
use TaxiCoBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CommandeMobileController extends Controller
{

    public function allAction()
    {
        $commande= $this->getDoctrine()->getManager()
            ->getRepository('TaxiCoBundle:Commande')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($commande);
        return new JsonResponse($formatted);
    }

    public function newAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $commande= new Commande();
        $commande->setPtDepart($request->get('ptDepart'));
        $commande->setPtArrivee($request->get('ptArrivee'));
        $commande->setModepaiement($request->get('modePaiement'));
        $commande->setDate($request->get('date'));
        $commande->setTime($request->get('time'));
        $commande->setPrix($request->get('prix'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($commande);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($commande);
        return new JsonResponse($formatted);
    }
    public function CmdVehiculeAction(Request $request,$type,$idc,$idv)
    {
        $em=$this->getDoctrine()->getManager();
        $commande= new Commande();
        $commande->setPtDepart($request->get('ptDepart'));
        $commande->setPtArrivee($request->get('ptArrivee'));
        $commande->setModepaiement($request->get('modePaiement'));
        $commande->setDate($request->get('date'));
        $commande->setTime($request->get('time'));
        $commande->setPrix($request->get('prix'));
        $commande->setIdcolis($idc);
        $commande->setTypecmd($type);
        $commande->setVehicule($idv);
        $em = $this->getDoctrine()->getManager();
        $em->persist($commande);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($commande);
        return new JsonResponse($formatted);
    }
    public function CmdColisAction(Request $request,$type,$idcolis,$idclient)
    {
        $em=$this->getDoctrine()->getManager();
        $commande= new Commande();
        $commande->setPtDepart($request->get('ptDepart'));
        $commande->setPtArrivee($request->get('ptArrivee'));
        $commande->setModepaiement($request->get('modePaiement'));
        $commande->setDate($request->get('date'));
        $commande->setTime($request->get('time'));
        $commande->setPrix($request->get('prix'));
        $commande->setIdcolis($idcolis);
        $commande->setClient($idclient);
        $commande->setTypecmd($type);
        $em = $this->getDoctrine()->getManager();
        $em->persist($commande);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($commande);
        return new JsonResponse($formatted);
    }
    public function findAction($id)
    {
        $commande=$this->getDoctrine()->getManager()
            ->getRepository('TaxiCoBundle:Commande')->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($commande);
        return new JsonResponse($formatted);
    }

    public function deleteAction(Request $request, $idCommande)
    {
        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository('TaxiCoBundle:Commande')->find($idCommande);
        $em->remove($commande);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($commande);

        return new JsonResponse($formatted);
    }
    public function findwaAction($id)
    {
        $vehicule = $this->getDoctrine()->getManager()
            ->getRepository('TaxiCoBundle:Commande')
            ->findBy(['vehicule' => $id,'etat'=>"notdone"]);
        $datas = array();
        foreach ($vehicule as $key => $blog)
        {
            $client=$this->getDoctrine()->getManager()->getRepository('TaxiCoBundle:User')
                ->find($blog->getClient());
            $datas[$key]['client'] = $client->getId();
            $datas[$key]['idcommande'] = $blog->getIdCommande();
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }
    public function doingAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $vehicule=$this->getDoctrine()->getRepository('TaxiCoBundle:Commande')
            ->findBy(array('idCommande'=>$id));
        $datas = array();
        foreach ($vehicule as $key => $blog) {
            $blog->setEtat("doing");
            $em->persist($blog);
            $em->flush();
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($vehicule);
        return new JsonResponse($formatted);
    }
    public function doneAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $vehicule=$this->getDoctrine()->getRepository(Commande::class)->find($id);
        $vehicule->setEtat("done");

        $em->persist($vehicule);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($vehicule);
        return new JsonResponse($formatted);
    }

}