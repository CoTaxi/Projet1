<?php


namespace ColisBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ChatController extends Controller
{
    public function getchatAction()
    {
        $chat = $this->getDoctrine()->getManager()
            ->getRepository('ColisBundle:chat')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($chat);
        return new JsonResponse($formatted);
    }
}