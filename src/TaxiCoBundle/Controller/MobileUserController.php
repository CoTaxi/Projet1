<?php

namespace TaxiCoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TaxiCoBundle\Entity\Reclamation;
use TaxiCoBundle\Entity\typereclamation;
use TaxiCoBundle\Entity\User;

class MobileUserController extends Controller
{
    public function loginAction(Request $request)
    {
        $username = $request->query->get("username");
        $password = $request->query->get("password");
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("TaxiCoBundle:User")->findOneBy(['username' => $username]);
        if ($user)
        {
            if (password_verify($password, $user->getPassword()))
            {
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize($user);
                return new JsonResponse($formatted);
            }else{
                return new Response("failed");
            }
        }else{
            return new Response("failed");
        }
    }

    public function registerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $t = $em->getRepository(User::class);
        $user = new User();
//        s
        $user->setPrenom($request->get('prenom'));
        $user->setNom($request->get('nom'));
        $user->setTel($request->get('tel'));
        $user->setMail($request->get('email'));
        $user->setEmail($request->get('email'));
        $user->setUsername($request->get('usern'));
        $user->setNaissance($request->get('dtn'));
        $user->setPermis($request->get('permis'));
        $user->setExperience($request->get('exp'));
        $user->setRibCompte($request->get('rib'));
        $user->setPassword($request->get('pwd'));
        $user->setMdp($request->get('pwd'));
//        $user->setRoles($request->get('role'));
        $em->persist($user);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);

    }
}
