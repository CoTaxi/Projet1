<?php

namespace TaxiCoBundle\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use TaxiCoBundle\Entity\Reclamation;
use TaxiCoBundle\Entity\typereclamation;
use TaxiCoBundle\Form\ReclamationType;
use TaxiCoBundle\Form\typereclamationType;

class ReclamationController extends Controller
{
    public function ajouterReclamationAction(Request $request)
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setEtat("Non traitée");
            $reclamation->setDateRec(new \DateTime());
            $reclamation->setReponse("Aucune réponse");
            $reclamation->setIdch($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute("taxi_co_listRec");
        }
        return $this->render("@TaxiCo/ReclamationViews/contact.html.twig", array('form' => $form->createView()));
    }

    public function addtypeRecAction(Request $request)
    {
        $typeRec = new typereclamation();
        $form =$this->createForm(typereclamationType::class, $typeRec);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeRec);
            $em->flush();
            return $this->redirectToRoute("taxi_co_listRec");
        }
        return $this->render("@TaxiCo/ReclamationViews/ok.html.twig", array('form' => $form->createView()));
    }

    public function afficherReclamationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository("TaxiCoBundle:Reclamation")->findAll();
        return $this->render("@TaxiCo/ReclamationViews/listReclamation.html.twig", array('tabs' => $reclamation));
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

    public function mailReclamationAction()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Réclamation')
            ->setFrom('rmilioussama70@gmail.com')
            ->setTo('rmilissou@gmail.com')
            ->setBody('Bonjour monsieur,\n  Veuillez traiter la réclamation que j\'ai envoyé et de laisser une réponse. \n ');
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

    public function countRecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("TaxiCoBundle:typereclamation")->countAllDQB();
        $reclamationsNT=$em->getRepository("TaxiCoBundle:typereclamation")->countNTDQB();
        $reclamationsT=$em->getRepository("TaxiCoBundle:typereclamation")->countTDQB();
        $reclamationsCT=$em->getRepository("TaxiCoBundle:typereclamation")->countCTDQB();
        $reclamationsArch=$em->getRepository("TaxiCoBundle:typereclamation")->countArchDQB();

        return $this->render("@TaxiCo/ReclamationViews/DashboardCountRec.html.twig", array(
            'c1'=> $reclamations,
            'c2'=>$reclamationsNT,
            'c3'=>$reclamationsT,
            'c4'=>$reclamationsCT,
            'c5'=>$reclamationsArch));
    }
}
