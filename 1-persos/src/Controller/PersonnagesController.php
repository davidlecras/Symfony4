<?php

namespace App\Controller;

use App\Entity\Personnage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PersonnagesController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('personnages/index.html.twig', [
            'controller_name' => 'PersonnagesController',
        ]);
    }

    /**
     * @Route("/persos", name="personnages")
     */
    public function persos()
    {
        Personnage::creerPersonnages();
        return $this->render('personnages/persos.html.twig', [
            'players' => Personnage::$personnages
        ]);
    }

    /**
     * @Route("/persos/{nom}", name="afficher_personnages")
     */
    public function afficherPersos($nom)
    {
        Personnage::creerPersonnages();

        return $this->render('personnages/persos.html.twig', [
            'nom' => $nom
        ]);
    }
}
