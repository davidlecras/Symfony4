<?php

namespace App\Controller;

use App\Entity\RechercheVoiture;
use App\Entity\Voiture;
use App\Form\RechercheVoitureType;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(VoitureRepository $repo, PaginatorInterface $pagi, Request $request)
    {
        $rechercheVoiture = new RechercheVoiture();
        $form = $this->createForm(RechercheVoitureType::class, $rechercheVoiture);
        $form->handleRequest($request);
        $voitures = $pagi->paginate(
            $repo->findAllwithPagination($rechercheVoiture),
            $request->query->getInt('page', 1), /*page number*/
            6/*limit per page*/
        );
        return $this->render('voiture/voitures.html.twig', [
            'voitures' => $voitures,
            'form' => $form->createView(),
            'admin' => true,
        ]);
    }

    /**
     * @Route("/admin/creation", name="creatVoiture")
     * @Route("/admin/{id}", name="modifVoiture", methods="GET|POST")
     */
    public function Modif(Voiture $voiture = null, Request $request)
    {
        if (!$voiture) {
            $voiture = new Voiture();
        }
        $om = $this->getDoctrine()->getManager();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($voiture);
            $om->flush();
            $this->addFlash('success', "L'action a bien été effectuée");
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/modification.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}", name="supVoiture", methods="SUP")
     */
    public function supression(Voiture $voiture, Request $request)
    {
        if ($this->isCsrfTokenValid("SUP" . $voiture->getId(), $request->get("_token"))) {
            $om = $this->getDoctrine()->getManager();
            $om->remove($voiture);
            $om->flush();
            $this->addFlash('success', "L'action a bien été effectuée");
            return $this->redirectToRoute('admin');
        }
    }
}
