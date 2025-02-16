<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Post;
use App\Entity\Comentario;
use App\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;


class ControladorPosts extends AbstractController{
  #[Route('/posts')]
  public function mostrarPosts(EntityManagerInterface $entityManager, SessionInterface $session){
    // Para cada elemento del carrito se consulta la base de datos y se recuepran sus datos
    $posts = [];

// Se crea un array con todos los datos de los productos y  la cantidad
        $postsData = $entityManager->getRepository(Post::class)->findAll();
        foreach ($postsData as $post) {
        $elem = [];
        $elem['titulo'] = $post->getTitulo();
        $elem['ruta'] = $post->getRuta();
        $elem['isAdult'] = $post->getIsAdult();
        $elem['mensaje'] = $post->getMensaje();
        $posts[] = $elem;
        }
    return $this->render("posts.html.twig", ['posts' => $posts]);
}

#[Route('/nuevoPost', name: 'nuevoPost')]
public function nuevoPost()
	{
		return $this->render('nuevoPost.html.twig');
	}
	
#[Route('/guardarPost', name:'guardarPost')]	

	public function guardarCambios(EntityManagerInterface $entityManager, Request $request)
	{		
		$titulo = $request->request->get('titulo');
        $mensaje = $request->request->get('mensaje');
        $etiquetas = $request->request->get('etiquetas');
        $adulto = $request->request->get('adulto');
        $foto = $request->files->get('foto');

        $post = new Post();
        $post->setTitulo($titulo);
        $post->setMensaje($mensaje);
        $post->setEtiquetas($etiquetas);
        $post->setAutor($this->getUser()->getId());
        $post->setIsAdult($adulto);
        $post->setFecha(new \DateTime());
		
		if($foto != null){
			$nombreFoto = $foto->getClientOriginalName();
			$foto->move('Posts', $nombreFoto);
			$foto = $nombreFoto;
            $post->setRuta($foto);
		}
		$entityManager->persist($post);
		$entityManager->flush();
		return $this->redirectToRoute('perfil', ['id' => $this->getUser()->getId()]);
		}

#[Route('/posts/{id}', name: 'post')]
public function mostrarPost(EntityManagerInterface $entityManager, SessionInterface $session, $id){
    $post = $entityManager->getRepository(Post::class)->find($id);
    $elem = [];
    $elem['num'] = $post->getNum();
    $elem['titulo'] = $post->getTitulo();
    $elem['mensaje'] = $post->getMensaje();
    $elem['etiquetas'] = explode(',',$post->getEtiquetas());
    $elem['autor'] = $post->getAutor();
    $elem['fecha'] = $post->getFecha();
    $elem['ruta'] = $post->getRuta();
    $elem['adulto'] = $post->getIsAdult();

    $comentariosData = $entityManager->getRepository(Comentario::class)->findBy(['post' => $post->getNum()]);
    $comentarios = [];
    foreach ($comentariosData as $comentario) {
        $elem2 = [];
        $elem2['num'] = $comentario->getNum();
        $elem2['mensaje'] = $comentario->getMensaje();
        $elem2['autor'] = $comentario->getAutor();
        $elem2['fecha'] = $comentario->getFecha();
        $usuarioData = $entityManager->getRepository(Usuario::class)->findBy(['id' => $comentario->getAutor()]);
        $autorComentario = $usuarioData[0]->getNombre();
        $apellidoComentario = $usuarioData[0]->getApellido();
        $autorComentario = $autorComentario . " " . $apellidoComentario;
        $elem2['autorComentario'] = $autorComentario;
        $comentarios[] = $elem2;

    }

    $usuarioData = $entityManager->getRepository(Usuario::class)->findBy(['id' => $post->getAutor()]);
    $autorPost = $usuarioData[0]->getNombre();
    $apellidoPost = $usuarioData[0]->getApellido();
    $autorPost = $autorPost . " " . $apellidoPost;

    return $this->render("post.html.twig", ['post' => $elem , 'comentarios' => $comentarios, 'autorPost' => $autorPost]);
}
#[Route('/nuevoComentario', name: 'nuevoComentario')]
public function nuevoComentario(EntityManagerInterface $entityManager, Request $request)
	{
        $mensaje = $request->request->get('comentario');
        $idPost = $request->request->get('idPost');

        $com = new Comentario();

        $com->setMensaje($mensaje);
        $com->setAutor($this->getUser()->getId());
        $com->setFecha(new \DateTime());
        $com->setPost($idPost);

        $entityManager->persist($com);
        $entityManager->flush();
		return $this->redirectToRoute('post', ['id' => $idPost]);
		
	}
}