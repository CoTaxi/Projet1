<?php

namespace ColisBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use ColisBundle\Entity\Colis;
use Proxies\__CG__\TaxiCoBundle\Entity\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use VehiculeBundle\Form\Vehiculeform;

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
        $us=$this->getUser();
        if($us != null)
        {
            $em = $this->getDoctrine()->getManager();

            $colis = $em->getRepository('ColisBundle:Colis')->findAll();

            return $this->render('colis/index.html.twig', array(
                'colis' => $colis,
            ));
        }
        else
        {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }

    /**
     * Creates a new coli entity.
     *
     */


    public function newAction(Request $request)
    {
        $us=$this->getUser();
        if($us != null)
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
                'user'=> $us,
            ));
        }
        else
        {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
    /**
     * Finds and displays a coli entity.
     *
     */
    public function showAction(Colis $coli)
    {
        $deleteForm = $this->createDeleteForm($coli);
        $us=$this->getUser();
        if($us != null)
        {
            return $this->render('colis/show.html.twig', array(
                'coli' => $coli,
                'delete_form' => $deleteForm->createView(),
                'user'=>$us,
            ));
        }
        else
        {
            return $this->redirectToRoute('fos_user_security_login');
        }
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

            return $this->redirectToRoute('colis_show', array('idC' => $coli->getIdc()));
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
        $us=$this->getUser();
        if($us != null) {
            $usr = $this->get('security.token_storage')->getToken()->getUser();
            $colis = $this->getDoctrine()->getRepository(Colis::class)->findBy(array('idExpediteur' => $usr));
            return $this->render('colis/afficherparuser.html.twig', array(
                'colis' => $colis,
                'user'=>$us
            ));
        }
        else
        {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }

}
