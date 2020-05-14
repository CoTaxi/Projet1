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
        $user1 = $em->getRepository("TaxiCoBundle:User")->findBy(array('username' => $username));

        $datas = array();
        if (password_verify($password, $user->getPassword()))
        {
            foreach ($user1 as $key => $blog) {
                $datas[$key]['id'] = $blog->getId();
            }
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);

//        if ($user)
//        {
//            if (password_verify($password, $user->getPassword()))
//            {
//                $serializer = new Serializer([new ObjectNormalizer()]);
//                $formatted = $serializer->normalize($datas);
//                return new JsonResponse($formatted);
//            }else{
//                return new JsonResponse("failed");
//            }
//        }else{
//            return new JsonResponse("failed");
//        }
    }

    public function registerClientAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $t = $em->getRepository(User::class);
        $user = new User();
        $user->setPrenom($request->get('prenom'));
        $user->setNom($request->get('nom'));
        $user->setTel($request->get('tel'));
        $user->setMail($request->get('email'));
        $user->setEmail($request->get('email'));
        $user->setUsername($request->get('usern'));
        $user->setNaissance($request->get('dtn'));
        $user->setPlainPassword($request->get('pwd'));
        $user->setMdp($request->get('pwd'));
//        $user->setRoles($request->get('role'));
        $em->persist($user);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);

    }
    public function registerChauffeurAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $t = $em->getRepository(User::class);
        $user = new User();
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
//        $user->setPassword($request->get('pwd'));
        $user->setPlainPassword($request->get('pwd'));
        $user->setMdp($request->get('pwd'));
//        $user->setRoles($request->get('role'));
        $em->persist($user);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);

    }
}