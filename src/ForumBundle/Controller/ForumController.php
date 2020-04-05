<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\Forum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ForumController extends Controller
{
    public function showAction()
    {
        $em= $this->getDoctrine()->getManager();
        $f =$em->getRepository('ForumBundle:Forum')->findBy(['etat'=>0]);
        return $this->render('@Forum/Front/index.html.twig',array('f'=>$f));
    }

    public function addForumAction( Request $request )
    {
        $em= $this->getDoctrine()->getManager();

        $forum = new Forum();
        $form=$this->createForm('ForumBundle\Form\ForumType',$forum);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $forum->setCreated(new \DateTime('now'));
            $forum->setFilename('new');
            $forum->setFilepath('new');
            $forum->setModified(new \DateTime('now'));

            $forum->setEtat(0);
            $forum->setFiletype('new');
            $em->persist($forum);
            $em->flush($forum);
            return $this->redirectToRoute('forum_homepage');

        }


        return $this->render('@Forum/Front/add.html.twig',array('form'=>$form->createView()));
    }
}
