<?php

// ===== MUCHO CUIDADO, tienes que incluir el namespace =====
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity] 
#[ORM\Table(name: 'comentarios')]
class Comentario{
    #[ORM\Id]
    #[ORM\Column(type:'integer', name:'num')]
    #[ORM\GeneratedValue]
    private $num;
   
    #[ORM\Column(type:'string', name:'mensaje')]
    private $mensaje;

	#[ORM\Column(type:'integer', name:'autor')]
	private $autor;

    #[ORM\Column(type:'integer', name:'post')]
	private $post;
    
    #[ORM\Column(type:'datetime', name:'fecha')]
    private $fecha;


	
	public function getNum()
    {
        return $this->num;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

	public function getAutor()
    {
        return $this->autor;
    }

    public function setPost($fundacion)
    {
        $this->post = $post;
    }
	public function getPost()
    {
        return $this->post;
    }
	
    public function getFecha()
    {
        return $this->fecha;
    }
	public function setFecha($socios)
    {
        $this->fecha = $fecha;
    }
}



