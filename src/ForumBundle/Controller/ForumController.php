<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\comment;
use ForumBundle\Entity\Forum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ForumController extends Controller
{
    public function showAction(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $forum =$em->getRepository('ForumBundle:Forum')->findBy(['etat'=>0]);
        $f  = $this->get('knp_paginator')->paginate(
            $forum,
            $request->query->get('page', 1),
            6
        );
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

            $forum->setModified(new \DateTime('now'));

            $forum->setEtat(0);
            $file = $forum->getImage();
            $fileName = $file->getClientOriginalName();
            $file->move($this->getParameter('media_directory'), $fileName);
            $forum->setImage($fileName);

            $em->persist($forum);
            $em->flush($forum);
            return $this->redirectToRoute('forum_homepage');

        }


        return $this->render('@Forum/Front/add.html.twig',array('form'=>$form->createView()));
    }

    public function showbackAction(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $forum =$em->getRepository('ForumBundle:Forum')->findAll();
        $f  = $this->get('knp_paginator')->paginate(
            $forum,
            $request->query->get('page', 1),
            4
        );
        return $this->render('@Forum/Back/index.html.twig',array('f'=>$f));
    }

    public function articleAction(Forum $f)
    {

        $em= $this->getDoctrine()->getManager();
        $c =$em->getRepository('ForumBundle:comment')->findby(['forum'=>$f->getId()]);
        return $this->render('@Forum/Front/article.html.twig',array('f'=>$f,'c'=>$c));
    }

    public function commentAction(Request $request, Forum $f)
    {
        $commentText = $request->get("comment");
        $em= $this->getDoctrine()->getManager();

//dump($commentText);exit;
        if($commentText){
        $em = $this->getDoctrine()->getManager();
        $comment = new comment();
        $comment->setContent($commentText);
        $comment->setCreated(new \DateTime('now'));
        $comment->setUpdated(new \DateTime('now'));
        $comment->setForum($f);
        $comment->setEtat(0);
        $em->persist($comment);
        $em->flush();}
        $c =$em->getRepository('ForumBundle:comment')->findby(['forum'=>$f->getId()]);
        return $this->render('@Forum/Front/article.html.twig',array('f'=>$f,'c'=>$c));
    }



    public function archiverAction(Request $request, Forum $forum){

        $em= $this->getDoctrine()->getManager();
        $forum->setEtat(1);
        $em->persist($forum);
        $em->flush();
        return $this->redirectToRoute('forum_homepage_back');

    }
    public function desarchiverAction(Request $request, Forum $forum){

        $em= $this->getDoctrine()->getManager();
        $forum->setEtat(0);
        $em->persist($forum);
        $em->flush();
        return $this->redirectToRoute('forum_homepage_back');

    }


}
