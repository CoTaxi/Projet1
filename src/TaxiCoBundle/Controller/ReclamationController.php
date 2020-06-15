<?php

namespace TaxiCoBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\PieChart\PieSlice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use TaxiCoBundle\Entity\Reclamation;
use TaxiCoBundle\Entity\typereclamation;
use TaxiCoBundle\Entity\User;
use TaxiCoBundle\Form\ReclamationType;
use TaxiCoBundle\Form\typereclamationType;

class ReclamationController extends Controller
{
    public function ajouterReclamationAction(Request $request)
    {
        $usrId = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $reclamation = new Reclamation();
        $find = $this->getDoctrine()->getRepository(User::class)->findOneBy(array('id'=> $usrId));
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setIdch($find);
            $reclamation->setEtat("Non traitée");
            $reclamation->setDateRec(new \DateTime());
            $reclamation->setReponse("Aucune réponse");
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute("taxi_co_listRec");
        }
        return $this->render("@TaxiCo/ReclamationViews/contact.html.twig", array('form' => $form->createView()));
    }

    public function afficherReclamationAction()
    {
        $usrId = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
//        $reclamation = $em->getRepository("TaxiCoBundle:Reclamation")->findBy(array(
//            'idch'=> $usrId,
//        ));
        $reclamation = $em->getRepository("TaxiCoBundle:typereclamation")->findDQLAll($usrId);
        $userRec = $em->getRepository("TaxiCoBundle:User")->find($usrId);
        return $this->render("@TaxiCo/ReclamationViews/listReclamation.html.twig", array('tabs' => $reclamation,
            'user'=>$userRec));
    }

    public function supprimerReclamationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository("TaxiCoBundle:Reclamation")->find($id);
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute("taxi_co_listRec");
    }

    public function modifierReclamationAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $find = $this->getDoctrine()->getRepository(Reclamation::class)->find($id);
        $form = $this->createForm(ReclamationType::class, $find);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $find->setDateRec(new \DateTime());
            $em->persist($find);
            $em->flush();
            return $this->redirectToRoute('taxi_co_listRec');
        }
        return $this->render('@TaxiCo/ReclamationViews/contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function mailReclamationAction($msg)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Réclamation')
            ->setFrom('rmilioussama70@gmail.com')
            ->setTo('rmilissou@gmail.com')
            ->setBody($msg);
//            ->setBody('Bonjour monsieur,
//             Veuillez traiter la réclamation que j\'ai envoyé et de laisser une réponse. ');

        $this->get('mailer')->send($message);
        return $this->redirectToRoute('taxi_co_listRec');
    }

    public function mailBackReclamationAction()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('[Important] Réponse Admin')
            ->setFrom('rmilioussama70@gmail.com')
            ->setTo('rmilissou@gmail.com')
            ->setBody('Bonjour, Votre réclamation est bien traitée.');

        $this->get('mailer')->send($message);
        return $this->redirectToRoute('taxi_co_listRec');
    }

    public function adminlistRecAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository("TaxiCoBundle:Reclamation")->findAll();
        return $this->render("@TaxiCo/ReclamationViews/DashboardContentsRec.html.twig", array('rec' => $reclamation));
    }

    public function adminlistCardRecAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository("TaxiCoBundle:Reclamation")->findAll();
        return $this->render("@TaxiCo/ReclamationViews/CardViewRec.html.twig", array('rec' => $reclamation));
    }

    public function admindeleteRecAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository("TaxiCoBundle:Reclamation")->find($id);
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute("taxi_co__backListRec");
    }

    public function admindeleteRecCardAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository("TaxiCoBundle:Reclamation")->find($id);
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute("taxi_co__backListCardRec");
    }

    public function adminupdateRecAction(Request $request, $id)
    {
        // $reclamation = new Reclamation();
        $em = $this->getDoctrine()->getManager();
        $find = $this->getDoctrine()->getRepository(Reclamation::class)->find($id);
        $form = $this->createFormBuilder($find)
            ->add('reponse', TextareaType::class, array(
                'attr' => ['class' => 'form-control form-control-lg',
                    'placeholder' => 'Votre réponse ici...',
                    'cols' => '3',
                    'rows' => '7'],
            ))
            ->add('etat', ChoiceType::class, array(
                'choices'  => [
                    'Non traitée' => 'Non traitée',
                    'En cours de traitement' => 'En cours de traitement',
                    'Traitée' => 'Traitée',
                    'Archivée' => 'Archivée',
                ],
                'attr' => ['class' => 'form-control-lg form-control',
                    'id' => 'selectLg',
                    'name' => 'selectLg',
                ],
            ))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $find->setDateRec(new \DateTime());
            $em->persist($find);
            $em->flush();
            return $this->redirectToRoute('taxi_co__backListRec');
        }
        return $this->render('@TaxiCo/ReclamationViews/DashboardUpdateRec.html.twig', array('form' => $form->createView()
        ));

    }

    public function findNonTrRecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->findDQLNT();
        return $this->render("@TaxiCo/ReclamationViews/DashboardContentsRec.html.twig", array('rec' => $reclamations));
    }

    public function findTrRecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->findDQLT();
        return $this->render("@TaxiCo/ReclamationViews/DashboardContentsRec.html.twig", array('rec' => $reclamations));
    }

    public function findCTRecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->findDQLCT();
        return $this->render("@TaxiCo/ReclamationViews/DashboardContentsRec.html.twig", array('rec' => $reclamations));
    }

    public function findArchRecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->findDQLArch();
        return $this->render("@TaxiCo/ReclamationViews/DashboardContentsRec.html.twig", array('rec' => $reclamations));
    }

    public function findNonTrCardRecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->findDQLNT();
        return $this->render("@TaxiCo/ReclamationViews/CardViewRec.html.twig", array('rec' => $reclamations));
    }

    public function findTrCardRecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->findDQLT();
        return $this->render("@TaxiCo/ReclamationViews/CardViewRec.html.twig", array('rec' => $reclamations));
    }

    public function findCTCardRecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->findDQLCT();
        return $this->render("@TaxiCo/ReclamationViews/CardViewRec.html.twig", array('rec' => $reclamations));
    }

    public function findArchCardRecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->findDQLArch();
        return $this->render("@TaxiCo/ReclamationViews/CardViewRec.html.twig", array('rec' => $reclamations));
    }

    public function deleteAllRecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->DeleteAllRecDQB();
        return $this->redirectToRoute('taxi_co__count');
    }

    public function deleteAllTRecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->DeleteAllTDQB();
        return $this->redirectToRoute('taxi_co__count');
    }

    public function deleteAllNTRecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->DeleteAllNTDQB();
        return $this->redirectToRoute('taxi_co__count');
    }

    public function deleteAllCTRecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->DeleteAllCTDQB();
        return $this->redirectToRoute('taxi_co__count');
    }

    public function deleteAllArchRecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->DeleteAllArchDQB();
        return $this->redirectToRoute('taxi_co__count');
    }

    public function countRecAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->countAllDQB();
        $reclamationsNT=$em->getRepository("TaxiCoBundle:typereclamation")->countNTDQB();
        $statNT = $reclamationsNT*100/$reclamations;
        $reclamationsT=$em->getRepository("TaxiCoBundle:typereclamation")->countTDQB();
        $statT = $reclamationsT*100/$reclamations;
        $reclamationsCT=$em->getRepository("TaxiCoBundle:typereclamation")->countCTDQB();
        $statCT = $reclamationsCT*100/$reclamations;
        $reclamationsArch=$em->getRepository("TaxiCoBundle:typereclamation")->countArchDQB();
        $statArch = $reclamationsArch*100/$reclamations;
        // Pie Chart :
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [
                ['Pac Man', 'Percentage'],
                ['Réclamation(s) en cours de traitement', $statCT],
                ['Réclamation(s) Traitée(s)', $statT],
                ['Réclamation(s) Non Traitée(s)', $statNT],
                ['Réclamation(s) Archivée(s)', $statArch]
            ]
        );
        $pieChart->getOptions()->getLegend()->setPosition('Right');
        $pieChart->getOptions()->setPieSliceText('none');
        $pieChart->getOptions()->setPieStartAngle(135);
        $pieChart->getOptions()->setIs3D(true);

        $pieSlice1 = new PieSlice();
        $pieSlice1->setColor('orange');
        $pieSlice2 = new PieSlice();
        $pieSlice2->setColor('green');
        $pieSlice3 = new PieSlice();
        $pieSlice3->setColor('red');
        $pieSlice4 = new PieSlice();
        $pieSlice4->setColor('grey');
        $pieChart->getOptions()->setSlices([$pieSlice1, $pieSlice2, $pieSlice3, $pieSlice4]);

        $pieChart->getOptions()->setHeight(400);
        $pieChart->getOptions()->setWidth(1000);
        $pieChart->getOptions()->setTitle('Statistique des réclamations selon l\'état');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(25);

        $rec = $em->getRepository("TaxiCoBundle:typereclamation")->findAll();
        $typeRec = new typereclamation();
        $form =$this->createForm(typereclamationType::class, $typeRec);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeRec);
            $em->flush();
//            echo '<script type="text/javascript">alert("Votre tyoe/Objet est bien ajouté!");</script>';
            return $this->redirectToRoute("taxi_co__count");

        }
        return $this->render("@TaxiCo/ReclamationViews/DashboardCountRec.html.twig", array(
            'form' => $form->createView(),
            'c1'=> $reclamations,
            'piechart' => $pieChart,
            'c2'=>$reclamationsNT,
            'c3'=>$reclamationsT,
            'c4'=>$reclamationsCT,
            'c5'=>$reclamationsArch,
            'rec' => $rec));
    }

//    public function statTypeRecAction(Request $request)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $type = $em->getRepository("TaxiCoBundle:typereclamation")->findAll();
//        $f=$type->getId();
//        return $this->render("@TaxiCo/ReclamationViews/ok.html.twig", array('rec' => $f));
//    }

    public function deleteTypeRecAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $Typereclamation = $em->getRepository("TaxiCoBundle:typereclamation")->find($id);
        $em->remove($Typereclamation);
        $em->flush();
        return $this->redirectToRoute("taxi_co__count");
    }

    public function recAction(Request $request){

        return $this->render('@TaxiCo/ReclamationViews/rec.html.twig');
    }
}
