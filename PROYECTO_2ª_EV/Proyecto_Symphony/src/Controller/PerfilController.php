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
use Symfony\Component\HttpFoundation\Request;

class PerfilController extends AbstractController
{
	#[Route('/perfil/{id}', name:'perfil')]	

	public function perfil(EntityManagerInterface $entityManager, $id)
	{
		$userData = $entityManager->getRepository(Usuario::class)->findBy(['id' => $id]);
		foreach ($userData as $usuario) {
		$user = [];
		$user['nombre'] = $usuario->getNombre();
		$user['apellido'] = $usuario->getApellido();
		$user['id'] = $usuario->getId();
		$user['biografia'] = $usuario->getBiografia();
		$user['ruta'] = $usuario->getRutaPfp();
		$user['cumpleaños'] = $usuario->getCumpleaños();
		$user['localidad'] = $usuario->getLocalidad();
		}

		

		$posts = [];
		$postsData = $entityManager->getRepository(Post::class)->findBy(['autor' => $usuario->getId()]);
        foreach ($postsData as $post) {
        $elem = [];
		$elem['num'] = $post->getNum();
        $elem['ruta'] = $post->getRuta();
        $elem['isAdult'] = $post->getIsAdult();
		// pasar la fecha a un formato string
		$elem['fecha'] = $post->getFecha()->format('Y-m-d H:i');
		$comentariosData = $entityManager->getRepository(Comentario::class)->findBy(['post' => $post->getNum()]);
		$elem['numComentarios'] = count($comentariosData);
        $posts[] = $elem;
		
        }
			
		return $this->render('perfil.html.twig', ['usuario' => $user , 'posts' => $posts]);
		}


	#[Route('/editarPerfil', name:'editarPerfil')]	

	public function verPerfil(EntityManagerInterface $entityManager)
	{		
		$userData = $entityManager->getRepository(Usuario::class)->findBy(['id' => $this->getUser()->getId()]);
		foreach ($userData as $usuario) {
		$user = [];
		$user['nombre'] = $usuario->getNombre();
		$user['apellido'] = $usuario->getApellido();
		$user['id'] = $usuario->getId();
		$user['biografia'] = $usuario->getBiografia();
		$user['ruta'] = $usuario->getRutaPfp();
		$user['cumpleaños'] = $usuario->getCumpleaños();
		$user['localidad'] = $usuario->getLocalidad();
		}

		return $this->render('editarPerfil.html.twig', ['usuario' => $user]);
		}
	
	
	#[Route('/guardarCambios', name:'guardarCambios')]	

	public function guardarCambios(EntityManagerInterface $entityManager, Request $request)
	{		
		$nombre = $request->request->get('nombre');
        $apellido = $request->request->get('apellido');
        $biografia = $request->request->get('biografia');
        $cumpleaños = $request->request->get('cumpleaños');
        $localidad = $request->request->get('localidad');
        $foto = $request->files->get('foto');

		$this->getUser()->setNombre($nombre);
		$this->getUser()->setApellido($apellido);
		$this->getUser()->setBiografia($biografia);
		if($cumpleaños != null){
			$this->getUser()->setCumpleaños($cumpleaños);
		}
		if($localidad != null){
			$this->getUser()->setLocalidad($localidad);
		}
		
		if($foto != null){
			$nombreFoto = $foto->getClientOriginalName();
			$foto->move('pfps', $nombreFoto);
			$foto = $nombreFoto;
			$this->getUser()->setRutaPfp($foto);
		}
		$entityManager->persist($this->getUser());
		$entityManager->flush();
		return $this->redirectToRoute('perfil', ['id' => $this->getUser()->getId()]);
		}
	}


