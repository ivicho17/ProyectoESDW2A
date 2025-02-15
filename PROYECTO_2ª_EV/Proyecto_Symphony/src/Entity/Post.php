<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'posts')]
class Post
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', name: 'num')]
    #[ORM\GeneratedValue]
    private $num;

    #[ORM\Column(type: 'string', length: 50, name: 'título')]
    private $título;

    #[ORM\Column(type: 'string', length: 500, name: 'mensaje')]
    private $mensaje;

    #[ORM\Column(type: 'string', length: 150, name: 'etiquetas', nullable: true)]
    private $etiquetas;

    #[ORM\Column(type: 'integer', name: 'autor', nullable: true)]
    private $autor;

    #[ORM\Column(type: 'datetime', name: 'fecha', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $fecha;

    #[ORM\Column(type: 'string', length: 120, name: 'ruta')]
    private $ruta;

    #[ORM\Column(type: 'boolean', name: 'adulto')]
    private $isAdult;

    public function getNum()
    {
        return $this->num;
    }

    public function getTitulo()
    {
        return $this->título;
    }

    public function setTitulo($título)
    {
        $this->título = $título;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    public function getEtiquetas()
    {
        return $this->etiquetas;
    }

    public function setEtiquetas($etiquetas)
    {
        $this->etiquetas = $etiquetas;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
    }

    public function getIsAdult()
    {
        return $this->isAdult;
    }

    public function setIsAdult($isAdult)
    {
        $this->isAdult = $isAdult;
    }
}
