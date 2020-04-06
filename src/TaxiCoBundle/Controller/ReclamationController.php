<?php

namespace TaxiCoBundle\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use TaxiCoBundle\Entity\Reclamation;
use TaxiCoBundle\Form\ReclamationType;

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

//    public function ajouterReclamationAction(Request $request)
//    {
//        $reclamation = new Reclamation();
//        $form = $this->createFormBuilder($reclamation)
//            ->add('Objet', EntityType::class, array(
//                'class' => 'TaxiCoBundle:typereclamation',
//                'choice_label' => 'titre',
//                'label' => 'Objet : ',
//                'attr' => ['class' => 'form-control form-control-lg'],
//                'multiple' => false,
//            ))
//            ->add('message', TextareaType::class, array(
//                'attr' => ['class' => 'form-control form-control-lg',
//                    'placeholder' => 'Votre message ici...',
//                    'cols' => '30',
//                    'rows' => '8'],
//            ))
//            //->add('Ajouter', SubmitType::class)
//            ->getForm();
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $reclamation->setMessage($form['message']->getData());
//            $reclamation->setEtat("Non traitée");
//            $reclamation->setDateRec(new \DateTime());
//            $reclamation->setReponse(" ");
//            $reclamation->setIdch($this->getUser());
//
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($reclamation);
//            $em->flush();
//            return $this->redirectToRoute("taxi_co_listRec");
//        }
//        return $this->render("@TaxiCo/ReclamationViews/contact.html.twig", array('form' => $form->createView()));
//    }


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
            ->setFrom('rmilissou@zohomail.com')
            ->setTo('rmilissou@gmail.com')
            ->setBody('Bonjour monsieur,\n  Veuillez traiter la réclamation que j\'ai envoyé et de laisser une réponse. \n ');
        $this->get('mailer')->send($message);
        return $this->redirectToRoute('taxi_co_listRec');
    }

//    public function mailAction()
//    {
//        $message = (new \Swift_Message('Hello Email'))
//            ->setFrom('rmilioussama70@gmail.com')
//            ->setTo('rmilissou@gmail.com')
//            ->setBody('Hello');
//        $this->get('mailer')->send($message);
//
//        // or, you can also fetch the mailer service this way
//        // $this->get('mailer')->send($message);
//
//        return $this->render('@TaxiCo/ReclamationViews/ok.html.twig');
//    }
}
