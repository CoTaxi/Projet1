<?php

namespace ContratBundle\Controller;

use ContratBundle\Entity\Contrat;
use ContratBundle\Form\ContratType;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VehiculeBundle\Form\VehiculeType;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

class ContratController extends Controller
{
    function AjoutContratAction(Request $request){
        $contrat=new Contrat();
        $form=$this->createForm(ContratType::class,$contrat);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($contrat);
            $em->flush();
        }
        return $this->render("@Contrat/BackContrat/content.html.twig",
            array('form' => $form->createView()));
    }

    public function afficherContratAction()
    {
        $em = $this->getDoctrine()->getManager();
        $contrat= $em->getRepository("ContratBundle:Contrat")->findAll();
        $user= $em->getRepository("ContratBundle:User")->findAll();
        return $this->render("@Contrat/BackContrat/listContrat.html.twig", array('tabs' => $contrat,'tabu' =>$user));
    }
    public function deleteContratAction(Request $request)
    {
        $id = $request->get('id');
        $em= $this->getDoctrine()->getManager();
        $Post=$em->getRepository('ContratBundle:Contrat')->find($id);
        $em->remove($Post);
        $em->flush();
        return $this->redirectToRoute('contrat_list');
    }
    public function updatecontratAction(Request $request, $id)
    {

        $em=$this->getDoctrine()->getManager();
        $contrat= $em->getRepository('ContratBundle:Contrat')->find($id);
        $form=$this->createForm(ContratType::class,$contrat);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($contrat);
            $em->flush();
            return $this->redirectToRoute('contrat_list');

        }
        return $this->render('@Contrat/BackContrat/updatecontrat.html.twig', array(
            "Form"=> $form->createView()
        ));



}
    public function recherchebyniveauAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $user= $em->getRepository('ContratBundle:User')->findAll();
        $contrat= $em->getRepository("ContratBundle:Contrat")->findAll();
        if($request->isMethod("POST"))
        {
            $nom=$request->get('nom');
            $prenom=$request->get('nom');
            $mail=$request->get('nom');
            $user = $em->getRepository('ContratBundle:User')->findBy(array('nom'=>$nom));
            $user = $em->getRepository('ContratBundle:User')->findBy(array('prenom'=>$prenom));
            $user = $em->getRepository('ContratBundle:User')->findBy(array('mail'=>$mail));


        }
        return $this->render("@Contrat/BackContrat/recherche.html.twig",array('tabu'=>$user,'tabs' => $contrat));




    }



    public function MailAction($name)
    {        $em=$this->getDoctrine()->getManager();
        $user= $em->getRepository('ContratBundle:User')->findAll();
        $contrat= $em->getRepository("ContratBundle:Contrat")->findAll();
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('achrefnasri98@gmail.com')
            ->setTo('achref.nasri@esprit.tn')
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    '@Contrat/BackContrat/registration.html.twig',
                    array('name' => $name)
                ),
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;

        $this->get('mailer')->send($message);


        // or, you can also fetch the mailer service this way
        // $this->get('mailer')->send($message);

        return $this->render("@Contrat/BackContrat/listContrat.html.twig", array('tabs' => $contrat,'tabu' =>$user));
    }


    public function pdfAction(Request $request,$nom,$prenom,$typecontrat,$duree)
    {
        $snappy = $this->get('knp_snappy.pdf');
        $html = $this->render('@Contrat/BackContrat/pdf.html.twig', [
            'nom' => $nom,
            'prenom' => $prenom,
            'typecontrat' => $typecontrat,
            'duree' => $duree
        ]);
        $filename = 'SnappyPDF';
        return new Response(
            $snappy->getOutputFromHtml($html),200,array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }

}
