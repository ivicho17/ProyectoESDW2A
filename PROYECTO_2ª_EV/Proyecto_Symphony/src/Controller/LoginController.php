<?php

namespace App\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('ctrl_logout');
        }

        // Comprueba si hubo algún error
        $error = $authenticationUtils->getLastAuthenticationError();

        // Recupera el último nombre de usuario que se probó
        $lastUsername = $authenticationUtils->getLastUsername();

        // Renderizar el formulario de login
        return $this->render('login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
    #[Route('/logout', name:'ctrl_logout')]
    public function logout(){    
        return new Response();
    }   
}