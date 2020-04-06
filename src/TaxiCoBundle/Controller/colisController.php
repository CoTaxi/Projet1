<?php

namespace TaxiCoBundle\Controller;

use TaxiCoBundle\Entity\Colis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Coli controller.
 *
 */
class colisController extends Controller
{
    /**
     * Lists all coli entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $colis = $em->getRepository('TaxiCoBundle:Colis')->findAll();

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
        $colis = new Colis();
        $form = $this->createForm('TaxiCoBundle\Form\colisType', $colis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($colis);
            $em->flush();

            return $this->redirectToRoute('colis_show', array('idC' => $colis->getIdc()));
        }

        return $this->render('colis/new.html.twig', array(
            'coli' => $colis,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a coli entity.
     *
     */
    public function showAction(colis $colis)
    {
        $deleteForm = $this->createDeleteForm($colis);

        return $this->render('colis/show.html.twig', array(
            'coli' => $colis,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing coli entity.
     *
     */
    public function editAction(Request $request, colis $colis)
    {
        $deleteForm = $this->createDeleteForm($colis);
        $editForm = $this->createForm('TaxiCoBundle\Form\colisType', $colis);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('colis_edit', array('idC' => $colis->getIdc()));
        }

        return $this->render('colis/edit.html.twig', array(
            'colis' => $colis ,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a coli entity.
     *
     */
    public function deleteAction(Request $request, colis $colis)
    {
        $form = $this->createDeleteForm($colis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($colis);
            $em->flush();
        }

        return $this->redirectToRoute('colis_index');
    }

    /**
     * Creates a form to delete a coli entity.
     *
     * @param colis $colis The coli entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(colis $colis)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('colis_delete', array('idC' => $colis->getIdc())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
