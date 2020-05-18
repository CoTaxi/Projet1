<?php


namespace ForumBundle\Controller;

use ForumBundle\Entity\Forum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
class ForumMobileController extends Controller
{
    public function newblogAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $Forum = new Forum();
        $Forum->setTitle($request->get('title'));
        $Forum->setCreated(new \DateTime());
        $Forum->setContent($request->get('content'));
        $Forum->setImage($request->get('image'));
        $Forum->setIduser($id);
        $em->persist($Forum);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Forum);
        return new JsonResponse($formatted);
    }

    public function allblogAction()
    {
        $forum = $this->getDoctrine()->getManager()
            ->getRepository("ForumBundle:Forum")->findAll();
        $datas = array();
        foreach ($forum as $key => $blog) {
            $datas[$key]['id'] = $blog->getId();
            $datas[$key]['title'] = $blog->getTitle();
            $datas[$key]['content'] = $blog->getContent();
            $datas[$key]['created'] = $blog->getCreated();
            $datas[$key]['image'] = $blog->getImage();
            $datas[$key]['user'] = $blog->getIduser();
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }
    public function ModifierblogAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $find= $this->getDoctrine()->getManager()
            ->getRepository('ForumBundle:Forum')->findBy(array('title'=>$id));
        foreach($find as $fin)
        {
            $fin->setTitle($request->get('title'));
            $fin->setCreated(new \DateTime());
            $fin->setContent($request->get('content'));
            $fin->setImage($request->get('image'));
        }
        $em->persist($fin);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($find);
        return new JsonResponse($formatted);
    }
    public function SupprimerblogAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $find= $this->getDoctrine()->getManager()
            ->getRepository('ForumBundle:Forum')->findBy(array('title'=>$id));
        foreach ($find as $col) {
            $em->remove($col);
        }
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($find);
        return new JsonResponse($formatted);

    }
}