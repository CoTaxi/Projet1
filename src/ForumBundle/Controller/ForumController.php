<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\comment;
use ForumBundle\Entity\Forum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TaxiCoBundle\Entity\User;

class ForumController extends Controller
{
    public function showAction(Request $request)
    {
        $us=$this->getUser();
        if($us != null) {
        $em= $this->getDoctrine()->getManager();
        $forum =$em->getRepository('ForumBundle:Forum')->findBy(['etat'=>0]);
        $f  = $this->get('knp_paginator')->paginate(
            $forum,
            $request->query->get('page', 1),
            2
        );

        return $this->render('@Forum/Front/index.html.twig',array(

            'f'=>$f,
            'user'=>$us
        ));
        }
        else
        {
            return $this->redirectToRoute('fos_user_security_login');
        }

    }

    public function addForumAction( Request $request )
    {
        $us = $this->getUser();
            $em = $this->getDoctrine()->getManager();

            $forum = new Forum();
            $id = $this->get('security.token_storage')->getToken()->getUser()->getId();
            $forum->setIduser($id);
            $form = $this->createForm('ForumBundle\Form\ForumType', $forum);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $forum = new Forum();
                $id = $this->get('security.token_storage')->getToken()->getUser()->getId();
                $forum->setIduser($id);
                $form = $this->createForm('ForumBundle\Form\ForumType', $forum);
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {

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

            }
                return $this->render('@Forum/Front/add.html.twig', array('form' => $form->createView(),'user' => $us));

    }
    public function removeSelectedAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $forum =$em->getRepository('ForumBundle:Forum')->find($id);
        foreach ($forum as $key => $f) {

            $c =$em->getRepository('ForumBundle:comment')->findby(['forum'=>$f->getId()]);
            $em->remove($c);
            $em->flush();
        }
        $em->remove($forum);
        $em->flush();
        return $this->render('@Forum/Back/index.html.twig',array('f'=>$forum));
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
    public function editAction(Request $request,$id)
    {
        $us=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $find = $this->getDoctrine()->getRepository('ForumBundle:Forum')->find($id);
        $form=$this->createForm('ForumBundle\Form\ForumForm',$find);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $find->setModified(new \DateTime('now'));
            $em->persist($find);
            $em->flush();
            return $this->redirectToRoute('forum_homepage');
        }
        return $this->render('@Forum/Front/edit.html.twig', array(
            'form' => $form->createView(),
            'find'=>$find,
            'user'=>$us
        ));
    }
    public function articleAction(Forum $f)
    {
        $us=$this->getUser();
        $em= $this->getDoctrine()->getManager();

        $id = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $c =$em->getRepository('ForumBundle:comment')->findby(['forum'=>$f->getId()]);
        $find = $this->getDoctrine()->getRepository(User::class)->find($f->getIduser());
        $datas = array();
        foreach ($c as $key => $cnx) {
            $finduser=$this->getDoctrine()->getRepository(User::class)->find($cnx->getIduser());
            $datas[$key]['username'] = $finduser;
            $datas[$key]['created'] = $cnx->getCreated();
            $datas[$key]['content'] = $cnx->getContent();

            $datas[$key]['idc'] = $cnx->getId();
            $datas[$key]['created'] = $cnx->getCreated();
            $datas[$key]['content'] = $cnx->getContent();
            $datas[$key]['iduser'] = $cnx->getIduser();
        }
        return $this->render('@Forum/Front/article.html.twig',array(
            'id'=>$id,
            'user'=>$find,
            'f'=>$f,
            'cnxuser'=>$datas,
            'c'=>$c,
            'user'=>$us));
    }

    public function commentAction(Request $request, Forum $f)
    {
        $commentText = $request->get("comment");
        $id = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $em= $this->getDoctrine()->getManager();
        $c =$em->getRepository('ForumBundle:comment')->findby(['forum'=>$f->getId()]);
        $datas = array();
        foreach ($c as $key => $cnx) {
            $finduser=$this->getDoctrine()->getRepository(User::class)->find($cnx->getIduser());
            $datas[$key]['username'] = $finduser;
            $datas[$key]['created'] = $cnx->getCreated();
            $datas[$key]['content'] = $cnx->getContent();

            $datas[$key]['idc'] = $cnx->getId();
            $datas[$key]['created'] = $cnx->getCreated();
            $datas[$key]['content'] = $cnx->getContent();
            $datas[$key]['iduser'] = $cnx->getIduser();
        }
//dump($commentText);exit;
        if($commentText){
        $em = $this->getDoctrine()->getManager();
        $comment = new comment();
        $comment->setContent($commentText);
        $comment->setCreated(new \DateTime('now'));
        $comment->setUpdated(new \DateTime('now'));
        $id = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $comment->setIduser($id);
        $comment->setForum($f);
        $comment->setEtat(0);
        $em->persist($comment);
        $em->flush();}

        $find=$this->getDoctrine()->getRepository(User::class)->find($f->getIduser());
        $c =$em->getRepository('ForumBundle:comment')->findby(['forum'=>$f->getId()]);
        return $this->render('@Forum/Front/article.html.twig',array(
            'id'=>$id,
            'user'=>$find,
            'f'=>$f,
            'cnxuser'=>$datas,
            'c'=>$c));

    }
    public function commentdeleteAction(Request $request, Forum $f)
    {
        $idcom = $request->get("idcom");
        $id = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $em= $this->getDoctrine()->getManager();
        $c =$em->getRepository('ForumBundle:comment')->findby(['forum'=>$f->getId()]);
        $comment=$em->getRepository('ForumBundle:comment')->findby(['id'=>$idcom]);
        $datas = array();
        foreach ($c as $key => $cnx) {
            $finduser=$this->getDoctrine()->getRepository(User::class)->find($cnx->getIduser());
            $datas[$key]['username'] = $finduser;
            $datas[$key]['idc'] = $cnx->getId();
            $datas[$key]['created'] = $cnx->getCreated();
            $datas[$key]['content'] = $cnx->getContent();
            $datas[$key]['iduser'] = $cnx->getIduser();
        }

        $find=$this->getDoctrine()->getRepository(User::class)->find($f->getIduser());
        $c =$em->getRepository('ForumBundle:comment')->findby(['forum'=>$f->getId()]);

        foreach ($comment as $cm) {
        $em->remove($cm);
        $em->flush();
        }
        return $this->render('@Forum/Front/article.html.twig',array(
            'id'=>$id,
            'user'=>$find,
            'f'=>$f,
            'cnxuser'=>$datas,
            'c'=>$c));
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
    public function blgAction(Request $request){
        $us=$this->getUser();
        return $this->render('@Forum/Front/blg.html.twig',array('user' => $us));
    }


}
