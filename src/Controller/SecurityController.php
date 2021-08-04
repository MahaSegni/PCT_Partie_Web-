<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SecurityController extends AbstractController
{

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/connexionJSON",name="connexionJSON")
     */
    public function connexionJSON(Request $request, UserRepository $repository, NormalizerInterface $Normalizer)
    {
        $user = $repository->findOneBy(["email" => $request->get("email")]);

        if ($user) {
            if (password_verify($request->get('password'), $user->getPassword())) {


                $jsonContent = $Normalizer->normalize($user, 'json', ['groups' => 'post:read']);
                return new Response(json_encode($jsonContent));

            }


        }}
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
       // throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        return $this->redirectToRoute('login');
    }
}
