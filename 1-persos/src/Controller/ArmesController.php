<?php

namespace App\Controller;

use App\Entity\Armes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArmesController extends AbstractController
{
    /**
     * @Route("/armes", name="armes")
     */
    public function index()
    {
        Armes::creerArme();
        return $this->render('armes/index.html.twig', [
            'armes' => Armes::$armes,
        ]);
    }

    /**
     * @Route("/arme/{nom}", name="afficher_arme")
     */
    public function afficherArme($nom)
    {
        Armes::creerArme();
        $arme = Armes::getArmeParNom($nom);
        return $this->render('armes/arme.html.twig', [
            'arme' => $arme,
        ]);
    }
}
