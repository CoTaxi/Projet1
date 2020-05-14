<?php


namespace ColisBundle\Controller;


use ColisBundle\Entity\Category;
use ColisBundle\Entity\Colis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
class ServicesController extends Controller
{
    public function allAction($id)
    {
        $colis = $this->getDoctrine()->getManager()
            ->getRepository('ColisBundle:Colis')
            ->findBy(array('idExpediteur'=>$id));
        $datas = array();
        foreach ($colis as $key => $col){
            $datas[$key]['Id'] = $col->getIdC();
            $datas[$key]['Depart'] = $col->getDepart();
            $datas[$key]['Destination'] = $col->getDestination();
            $datas[$key]['Poids'] = $col->getPoids();
            $datas[$key]['NomExpediteur'] = $col->getNomExpediteur();
            $datas[$key]['MailExpediteur'] = $col->getMailExpediteur();
            $datas[$key]['NomDestinataire'] = $col->getNomDestinataire();
            $datas[$key]['MailDestinataire'] = $col->getMailDestinataire();
            $datas[$key]['TelDestinataire'] = $col->getTelDestinataire();
            $datas[$key]['Etat']= $col->getEtat();
            #$datas[$key]['Categorie'] = $col->getNomcategorie()->getCategorie();
            }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }
    public function AfficherCategorieAction()
    {
        $categorie = $this->getDoctrine()->getManager()
            ->getRepository('ColisBundle:Category')
            ->findAll();
        $datas = array();
        foreach ($categorie as $key => $cat){
            $datas[$key]['categorie'] = $cat->getCategorie();
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }
    public function newAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $colis = new Colis();
        $colis->setDepart($request->get('Depart'));
        $colis->setDestination($request->get('Destination'));
        $colis->setNomExpediteur($request->get('NomExpediteur'));
        $colis->setMailExpediteur($request->get('MailExpediteur'));
        $colis->setPoids($request->get('Poids'));
        $colis->setEtat(0);
        $colis->setIdExpediteur($id);
        $colis->setNomDestinataire($request->get('NomDestinataire'));
        $colis->setMailDestinataire($request->get('MailDestinataire'));
        $colis->setTelDestinataire($request->get('TelDestinataire'));
        $em->persist($colis);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($colis);
        return new JsonResponse($formatted);
    }
    public function ModifierAction($Id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $find=  $this->getDoctrine()->getManager()
            ->getRepository('ColisBundle:Colis')->findBy(array('idC'=>$Id));
        foreach($find as $fin)
        {
            $fin->setDepart($request->get('Depart'));
            $fin->setDestination($request->get('Destination'));
            $fin->setNomExpediteur($request->get('NomExpediteur'));
            $fin->setMailExpediteur($request->get('MailExpediteur'));
            $fin->setPoids($request->get('Poids'));
            $fin->setNomDestinataire($request->get('NomDestinataire'));
            $fin->setMailDestinataire($request->get('MailDestinataire'));
            $fin->setTelDestinataire($request->get('TelDestinataire'));
        }
        $em->persist($fin);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($find);
        return new JsonResponse($formatted);
    }
    public function findAction($Id)
    {
        $find=  $this->getDoctrine()->getManager()
            ->getRepository('ColisBundle:Colis')->findBy(array('idC'=>$Id));
        $datas = array();
        foreach ($find as $key => $col){
            $datas[$key]['Id'] = $col->getIdC();
            $datas[$key]['Depart'] = $col->getDepart();
            $datas[$key]['Destination'] = $col->getDestination();
            $datas[$key]['Poids'] = $col->getPoids();
            $datas[$key]['NomExpediteur'] = $col->getNomExpediteur();
            $datas[$key]['MailExpediteur'] = $col->getMailExpediteur();
            $datas[$key]['NomDestinataire'] = $col->getNomDestinataire();
            $datas[$key]['MailDestinataire'] = $col->getMailDestinataire();
            $datas[$key]['TelDestinataire'] = $col->getTelDestinataire();
            $datas[$key]['Etat']= $col->getEtat();
            #$datas[$key]['Categorie'] = $col->getNomcategorie()->getCategorie();
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }
    public function findbydepartAction($depart)
    {
        $find=  $this->getDoctrine()->getManager()
            ->getRepository('ColisBundle:Colis')->findByDepart($depart);
        $datas = array();
        foreach ($find as $key => $col){
            $datas[$key]['Id'] = $col->getIdC();
            $datas[$key]['Depart'] = $col->getDepart();
            $datas[$key]['Destination'] = $col->getDestination();
            $datas[$key]['Poids'] = $col->getPoids();
            $datas[$key]['NomExpediteur'] = $col->getNomExpediteur();
            $datas[$key]['MailExpediteur'] = $col->getMailExpediteur();
            $datas[$key]['NomDestinataire'] = $col->getNomDestinataire();
            $datas[$key]['MailDestinataire'] = $col->getMailDestinataire();
            $datas[$key]['TelDestinataire'] = $col->getTelDestinataire();
            $datas[$key]['Etat']= $col->getEtat();
            #$datas[$key]['Categorie'] = $col->getNomcategorie()->getCategorie();
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }
    public function finduserAction($Id)
    {
        $find=  $this->getDoctrine()->getManager()
            ->getRepository('ColisBundle:Colis')->findBy(array('idC'=>$Id));
        $datas = array();
        foreach ($find as $key => $col){
            $id=$col->getIdExpediteur();
            $finduser=  $this->getDoctrine()->getManager()
                ->getRepository('TaxiCoBundle:User')->findBy(array('id'=>$id));
            foreach ($finduser as $key => $user){
                $datas[$key]['Tel'] = $user->getTel();
                $datas[$key]['Nom'] =$user->getNom();
            }
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }
    public function SupprimerAction($Id)
    {
        $em=$this->getDoctrine()->getManager();
        $find=  $this->getDoctrine()->getManager()
            ->getRepository('ColisBundle:Colis')->findBy(array('idC'=>$Id));
        foreach ($find as $col) {
            $em->remove($col);
        }
            $em->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($find);
            return new JsonResponse($formatted);

    }
    public function AffecterAction($Id,$matricule)
    {
        $em=$this->getDoctrine()->getManager();
        $findcolis=  $this->getDoctrine()->getManager()
            ->getRepository('ColisBundle:Colis')->findBy(array('idC'=>$Id));
        $findvehicule=  $this->getDoctrine()->getManager()
            ->getRepository('TaxiCoBundle:Vehicule')->findBy(array('matricule'=>$matricule));
        foreach ($findvehicule as $findv)
        {
            $idv=$findv->getId();

        foreach ($findcolis as $find) {
            $find->setEtat('1');
            $find->setIdKarhba($idv);
          //  $find->setPickup($request->get('pickup'));
            $em->persist($find);
        }
        }
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($findcolis);
        return new JsonResponse($formatted);
    }
    public function accepterAction($Id)
    {
        $em=$this->getDoctrine()->getManager();
        $findcolis=  $this->getDoctrine()->getManager()
            ->getRepository('ColisBundle:Colis')->findBy(array('idC'=>$Id));

            foreach ($findcolis as $find) {
                $find->setEtat('2');

                $em->persist($find);
            }
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($findcolis);
        return new JsonResponse($formatted);
    }
    public function RefusAction($Id)
    {
        $em=$this->getDoctrine()->getManager();
        $findcolis=  $this->getDoctrine()->getManager()
            ->getRepository('ColisBundle:Colis')->findBy(array('idC'=>$Id));

        foreach ($findcolis as $find) {
            $find->setEtat('0');
            $find->setIdKarhba('0');
            $em->persist($find);
        }
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($findcolis);
        return new JsonResponse($formatted);
    }
    public function MAJAction($Id)
    {
        $em=$this->getDoctrine()->getManager();
        $findcolis=  $this->getDoctrine()->getManager()
            ->getRepository('ColisBundle:Colis')->findBy(array('idC'=>$Id));

        foreach ($findcolis as $find) {
            $find->setEtat('3');
            $em->persist($find);
        }
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($findcolis);
        return new JsonResponse($formatted);
    }
    public function triColisAction()
    {
        $em=$this->getDoctrine()->getManager();
        $find = $em->getRepository('ColisBundle:Colis')->findAllOrderedByDepart();
        $datas = array();
        foreach ($find as $key => $col){
            $datas[$key]['Id'] = $col->getIdC();
            $datas[$key]['Depart'] = $col->getDepart();
            $datas[$key]['Destination'] = $col->getDestination();
            $datas[$key]['Poids'] = $col->getPoids();
            $datas[$key]['NomExpediteur'] = $col->getNomExpediteur();
            $datas[$key]['MailExpediteur'] = $col->getMailExpediteur();
            $datas[$key]['NomDestinataire'] = $col->getNomDestinataire();
            $datas[$key]['MailDestinataire'] = $col->getMailDestinataire();
            $datas[$key]['TelDestinataire'] = $col->getTelDestinataire();
            $datas[$key]['Etat']= $col->getEtat();
            #$datas[$key]['Categorie'] = $col->getNomcategorie()->getCategorie();
        }

    $serializer = new Serializer([new ObjectNormalizer()]);
    $formatted = $serializer->normalize($datas);
    return new JsonResponse($formatted);
    }
    public function ListeDemandesAction($matricule)
    {
        $findvehicule=  $this->getDoctrine()->getManager()
            ->getRepository('TaxiCoBundle:Vehicule')->findBy(array('matricule'=>$matricule));
        $datas = array();
        foreach ($findvehicule as $findv)
        {
            $idv=$findv->getId();
            $findcolis=  $this->getDoctrine()->getManager()
                ->getRepository('ColisBundle:Colis')->findBy(array('idKarhba'=>$idv));

            foreach ($findcolis as $key => $col){
                $datas[$key]['Id'] = $col->getIdC();
                $datas[$key]['Depart'] = $col->getDepart();
                $datas[$key]['Destination'] = $col->getDestination();
                $datas[$key]['Poids'] = $col->getPoids();
                $datas[$key]['NomExpediteur'] = $col->getNomExpediteur();
                $datas[$key]['MailExpediteur'] = $col->getMailExpediteur();
                $datas[$key]['NomDestinataire'] = $col->getNomDestinataire();
                $datas[$key]['MailDestinataire'] = $col->getMailDestinataire();
                $datas[$key]['TelDestinataire'] = $col->getTelDestinataire();
                $datas[$key]['Etat']= $col->getEtat();
                $datas[$key]['pickup']= $col->getPickup();
                #$datas[$key]['Categorie'] = $col->getNomcategorie()->getCategorie();
            }
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }


}