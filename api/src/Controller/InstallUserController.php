<?php

namespace App\Controller;

use App\Entity\MyUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InstallUserController extends AbstractController
{
    /**
     * @Route("/install/user", name="install_user")
     */
    public function index(UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new MyUser();

        $user->setUsername('test');
        $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,'test'
                )
            )
        ;

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->render('install_user/index.html.twig', [
            'controller_name' => 'InstallUserController',
        ]);
    }
}
