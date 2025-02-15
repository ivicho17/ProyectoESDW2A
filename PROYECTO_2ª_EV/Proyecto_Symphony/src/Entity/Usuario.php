<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity] 
#[ORM\Table(name: 'usuarios')]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface {
    #[ORM\Id]
    #[ORM\Column(type:'integer', name:'id')]
    #[ORM\GeneratedValue]
    private $id;
   
    #[ORM\Column(type:'string', name:'nombre')]
    private $nombre;

    #[ORM\Column(type:'string', name:'apellido')]
    private $apellido;

    #[ORM\Column(type:'string', name:'email')]
    private $email;
    
    #[ORM\Column(type:'string', name:'contraseña')]
    private $contraseña;

    #[ORM\Column(type:'integer', name:'teléfono')]
    private $teléfono;

    #[ORM\Column(type:'string', name:'biografia')]
    private $biografia;

    #[ORM\Column(type:'string', name:'cumpleaños')]
    private $cumpleaños;

    #[ORM\Column(type:'string', name:'localidad')]
    private $localidad;

    #[ORM\Column(type:'string', name:'ruta_pfp')]
    private $ruta_pfp;

    #[ORM\Column(type:'boolean', name:'verificado')]
    private $verificado;

    #[ORM\Column(type:'integer', name:'cod_verificacion')]
    private $cod_verificación;
    
    #[ORM\Column(type:'string', name:'amigos')]
    private $amigos;

    public function getAmigos()
    {
        return $this->amigos;
    }

    public function setAmigos($amigos)
    {
        $this->amigos = $amigos;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getContraseña()
    {
        return $this->contraseña;
    }

    public function setContraseña($contraseña)
    {
        $this->contraseña = $contraseña;
    }

    public function getTeléfono()
    {
        return $this->teléfono;
    }

    public function setTeléfono($teléfono)
    {
        $this->teléfono = $teléfono;
    }

    public function getBiografia()
    {
        return $this->biografia;
    }

    public function setBiografia($biografia)
    {
        $this->biografia = $biografia;
    }

    public function getCumpleaños()
    {
        return $this->cumpleaños;
    }

    public function setCumpleaños($cumpleaños)
    {
        $this->cumpleaños = $cumpleaños;
    }

    public function getLocalidad()
    {
        return $this->localidad;
    }

    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    }

    public function getRutaPfp()
    {
        return $this->ruta_pfp;
    }

    public function setRutaPfp($ruta_pfp)
    {
        $this->ruta_pfp = $ruta_pfp;
    }

    public function getVerificado()
    {
        return $this->verificado;
    }

    public function setVerificado($verificado)
    {
        $this->verificado = $verificado;
    }

    public function getCodVerificación()
    {
        return $this->cod_verificación;
    }

    public function setCodVerificación($cod_verificación)
    {
        $this->cod_verificacion = $cod_verificación;
    }

    public function getRoles(): array
    {
		if($this->verificado)
			return ['ROLE_VERIFIED'];
		else
			return ['ROLE_DENIED'];            
	}


    
    public function getPassword(): string
    {
        return $this->contraseña;
    }


    public function getUserIdentifier(): string
    {
        return $this->getEmail();
    }

    public function getSalt(): ?string
    {
        return null;
    }
	
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}



