<?php
namespace App\Service;

class sonAmigos
{
    public function sonAmigos($id1, $id2){ 
        $usuario1Amigos = $entityManager->getRepository(Usuario::class)->find("Usuario",$id1);
        $amigos1['amigos'] = explode('?', $usuario->getAmigos());

        $usuario2Amigos = $entityManager->getRepository(Usuario::class)->find("Usuario",$id2);
        $amigos2['amigos'] = explode('?', $usuario->getAmigos());
    

        $amigo1de2 = false;
        $amigo2de1 = false;

        foreach ($amigos1 as $amigo) {
            if ($amigo == $id2) {
                $amigo1de2 = true;
                break;
            }
        }

        foreach ($amigos2 as $amigo) {
            if ($amigo == $id1) {
                $amigo2de1 = true;
                break;
            }
        }

        if ($amigo1de2 && $amigo2de1) {
            return true;
        } else {
            return false;
        }
    }
}