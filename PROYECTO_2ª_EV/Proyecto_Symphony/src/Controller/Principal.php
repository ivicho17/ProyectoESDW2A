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
use App\Entity\Comentario;
use App\Service\sonAmigos;

class Principal extends AbstractController
{
	#[Route('/home', name:'home')]
	public function Acceso(AuthenticationUtils $authenticationUtils, EntityManagerInterface $entityManager, SessionInterface $session)
	{
		// Comprobamos si el usuario está verificado
		$this->denyAccessUnlessGranted('ROLE_VERIFIED');

		$usuarios = [];

	// Se crea un array que almacene los amigos de la persona logueada.
		$amigos = [];
	// Se crea un array con todos los datos de los usuarios
			$usuariosData = $entityManager->getRepository(Usuario::class)->findAll();
			foreach ($usuariosData as $usuario) {
			$elem = [];
			$elem['nombre'] = $usuario->getNombre();
			$elem['apellido'] = $usuario->getApellido();
			$elem['id'] = $usuario->getId();
			$elem['biografia'] = $usuario->getBiografia();
			$elem['ruta'] = $usuario->getRutaPfp();
			$elem['amigos'] = explode('?', $usuario->getAmigos());
			$usuarios[] = $elem;
			$usuarioActual = $this->getUser();
			sonAmigos($usuarioActual.id, $usuario->getId());
			}



		return $this->render('principal.html.twig', ['usuarios' => $usuarios], );
	}
	
	
	}
	
