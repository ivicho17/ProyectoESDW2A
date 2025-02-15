<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Usuario;
use App\Entity\Post;


class ControladoresAJAX extends AbstractController
{
    #[Route('/enviarPeticion/{id}')]
    public function enviarPeticion(EntityManagerInterface $em, $id)
    {
        $usuarioActual = $this->getUser();
        if($usuarioActual == null){
        return $this->redirectToRoute('app_login');
        }


        $stringAmigos = $usuarioActual->getAmigos();
        $stringAmigos .= "?" . $id;
        $usuarioActual->setAmigos($stringAmigos);
        $em->persist($usuarioActual);
        $em->flush();
        
        return new Response('', 204);
    }

    #[Route('/logout', name:'ctrl_logout')]
    public function logout(){    
        return new Response();
    }   
}