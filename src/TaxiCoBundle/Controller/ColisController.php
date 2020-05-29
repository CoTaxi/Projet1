<?php

namespace TaxiCoBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use ColisBundle\Entity\Category;
use ColisBundle\Entity\Colis;
use Proxies\__CG__\TaxiCoBundle\Entity\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TaxiCoBundle\Form\VehiculeForm;
use Twilio\Rest\Client;
use TaxiCoBundle\Entity\User;

/**
 * Coli controller.
 *
 */
class ColisController extends Controller
{
    /**
     * Lists all coli entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $colis = $em->getRepository('ColisBundle:Colis')->findAll();

        return $this->render('colis/index.html.twig', array(
            'colis' => $colis,
        ));
    }

    /**
     * Creates a new coli entity.
     *
     */
    public function newAction(Request $request)
    {
        $usrId = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $usrNom = $this->get('security.token_storage')->getToken()->getUser()->getUsername();
        $usrEmail = $this->get('security.token_storage')->getToken()->getUser()->getEmail();
        $coli = new Colis();
        $coli->setIdExpediteur($usrId);
        $coli->setNomExpediteur($usrNom);
        $coli->setMailExpediteur($usrEmail);
        $form = $this->createForm('ColisBundle\Form\ColisType', $coli);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($coli);
            $em->flush();
            return $this->redirectToRoute('colis_show', array('idC' => $coli->getIdc()));
        }
        return $this->render('colis/new.html.twig', array(
            'coli' => $coli,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a coli entity.
     *
     */
    public function showAction(Colis $coli)
    {
        $deleteForm = $this->createDeleteForm($coli);

        return $this->render('colis/show.html.twig', array(
            'coli' => $coli,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function detailsAction(Request $request,$idV)
    {
        $vehicule=$this->getDoctrine()->getRepository(Vehicule::class)->find($idV);
        $colis=$this->getDoctrine()->getRepository(Colis::class)->find($request->get('idC'));
        $user=$vehicule->getUser();
        $find=$this->getDoctrine()->getRepository(User::class)->find($user);
      return $this->render('colis/detailsclient.html.twig', array(
          'vehicule' => $vehicule,
          'user'=>$find,
          'colis'=>$colis,
      ));
    }
    public function showModalAction($idC)
    {
        $colis=$this->getDoctrine()->getRepository(Colis::class)->find($idC);
        $user=$colis->getIdExpediteur();
        $find=$this->getDoctrine()->getRepository(User::class)->find($user);
        $category=$colis->getnomcategorie();
        $findc=$this->getDoctrine()->getRepository(Category::class)->find($category);
        $nomcat=$findc->getcategorie();
        return $this->render('colis/details.html.twig', array(
            'colis' => $colis,
            'cat'=>$nomcat,
            'user'=>$find,
        ));
    }
    /**
     * Displays a form to edit an existing coli entity.
     *
     */
    public function editAction(Request $request, Colis $coli)
    {
        $deleteForm = $this->createDeleteForm($coli);
        $editForm = $this->createForm('ColisBundle\Form\ColisType', $coli);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('colis_edit', array('idC' => $coli->getIdc()));
        }

        return $this->render('colis/edit.html.twig', array(
            'coli' => $coli,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a coli entity.
     *
     */
    public function deleteAction(Request $request, Colis $coli)
    {
        $form = $this->createDeleteForm($coli);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($coli);
            $em->flush();
        }

        return $this->redirectToRoute('colis_afficher');
    }


    /**
     * Creates a form to delete a coli entity.
     *
     * @param Colis $coli The coli entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Colis $coli)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('colis_delete', array('idC' => $coli->getIdc())))
            ->setMethod('DELETE')
            ->getForm();
    }
    public function mapAction()
    {

        return $this->render('colis/map.html.twig', array(

        ));
    }
    public function weatherAction()
    {

        return $this->render('colis/weather.html.twig', array(

        ));
    }

    public function statAction()
    {
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $villes = $em->getRepository(Colis::class)->findAll();
        $totalpoids=0;
        foreach( $villes as  $ville) {
            $totalpoids= $totalpoids+$ville->getpoids();
        }

        $data= array();
        $stat=['ville', 'nb'];
        $nb=0;
        array_push($data,$stat);
        foreach( $villes as $ville) {
            $stat=array();
            array_push($stat,$ville->getpoids(),(($ville->getpoids()) *100)/ $totalpoids);
            $nb=($ville->getpoids() *100)/ $totalpoids;
            $stat=[$ville->getdepart(),$nb];
            array_push($data,$stat);

        }


        $pieChart->getData()->setArrayToDataTable(
            $data
        );

        $pieChart->getOptions()->setTitle('    STATISTIQUE   '  );
        $pieChart->getOptions()->setHeight(1000);
        $pieChart->getOptions()->setWidth(2000);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(30);


        return $this->render('colis/stat.html.twig', array(
                'piechart' => $pieChart,
            )

        );
    }

    public function AfficherParUserAction()
    {
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $colis=$this->getDoctrine()->getRepository(Colis::class)->findBy(array('idExpediteur'=> $usr));

        return $this->render('colis/afficherparuser.html.twig',array
        (
            'colis'=>$colis,
            'category'=>$colis->getNomcategorie()->getIdcategory(),
        ));
    }
    public function ColisChauffeurAction(Request $request,$idV)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Vehicule::class)->find($idV);
        $categorie=$find->getAcceptC();
        $form = $this->createForm(VehiculeForm::class,$find);
        $demande=$this->getDoctrine()->getRepository(Colis::class)->findBy(array('idKarhba'=>$idV));
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($find);
            $em->flush();
            return $this->redirectToRoute('vehicule_listVehicule');
        }
        return $this->render('colis/colischauffeur.html.twig', array(
            'Form'=>$form->createView(),
            'demande'=>$demande,
            'cat'=>$categorie,
            'idV'=>$idV,
        ));
    }

    public function AffecterColisAction($idC)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Colis::class)->find($idC);
        $category=$find->getnomcategorie();
        $findc=$this->getDoctrine()->getRepository(Category::class)->find($category);
        $nomcat=$findc->getcategorie();
        $vehicule=$this->getDoctrine()->getRepository(Vehicule::class)->findBy(array('acceptC'=>$nomcat));
        return $this->render('colis/affectation.html.twig',array(
            'vehicule'=>$vehicule,
            'colis'=>$find
        ));
    }
    public function choixvoitureAction(Request $request,$idC)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Colis::class)->find($idC);

        $find->setidKarhba($request->get('idv'));
        $find->setEtat('1');
        $em->persist($find);
        $em->flush();
        return $this->redirectToRoute('colis_afficher');
    }
    public function smsAction ()
    {
        $sid = "ACb7d03889ef1f5369ddf8e55d3e4aaa40";
        $token = "f6d47b626954fd9cdc72a0d574bc5fa6";
        $client = new Client($sid, $token);
        $client->messages->create(
        '+21622066396',
        array(
        'from' => '+19382009454',
        'body' => "you have a meeting "
        ));
    }
    public function AcceptAction($idC)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Colis::class)->find($idC);
        $find->setetat('2') ;
        $em->persist($find);
        $em->flush();
        return $this->render('colis/afficheracceptee.html.twig',array( 'colis'=>$find) );
    }
    public function RefuseeAction($idC)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Colis::class)->find($idC);
        $category=$find->getnomcategorie();
        $findc=$this->getDoctrine()->getRepository(Category::class)->find($category);
        $nomcat=$findc->getcategorie();
        $user=$find->getIdExpediteur();
        $findu=$this->getDoctrine()->getRepository(User::class)->find($user);
        $find->setetat('0') ;
        $find->setIdkarhba('0') ;
        $em->persist($find);
        $em->flush();
        return $this->render('colis/details.html.twig',array(
            'colis'=>$find,
            'cat'=>$nomcat,
            'user'=>$findu,
        ) );
    }
    public function AfficheEtatAction($idV)
    {
        $etat=$this->getDoctrine()->getRepository(Colis::class)->findBy(array('idKarhba'=>$idV,'etat'=>'2'));
        $findc=$this->getDoctrine()->getRepository(Vehicule::class)->find($idV);
        $nomcat=$findc->getacceptC();
        return $this->render('colis/afficheracceptee.html.twig',array(
            'colis'=>$etat,
            'cat'=>$nomcat,
            'idV'=>$idV,
        ) );
    }
    public function ArchiveAction($idV)
    {
        $etat=$this->getDoctrine()->getRepository(Colis::class)->findBy(array('idKarhba'=>$idV,'etat'=>'3'));
        $findc=$this->getDoctrine()->getRepository(Vehicule::class)->find($idV);
        $nomcat=$findc->getacceptC();
        return $this->render('colis/archive.html.twig',array(
            'colis'=>$etat,
            'cat'=>$nomcat,
            'idV'=>$idV,
        ) );
    }
    public function MiseAjourAction($idC)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Colis::class)->find($idC);
        $idV=$find->getIdKarhba();
        $find->setetat('3') ;
        $em->persist($find);
        $em->flush();
        return $this->render('colis/afficheracceptee.html.twig',array(
            'colis'=>$find,
            'idV'=>$idV,
        ) );
    }
}
