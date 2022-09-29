<?php

namespace App\Controller;

use App\Form\VoitureType;
use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExoController extends AbstractController
{
    #[Route('/exo', name: 'app_exo')]
    public function index(): Response
    {
        return $this->render('exo/index.html.twig', [
            'controller_name' => 'ExoController',
        ]);
    }
    #[Route("/showvoiture/{id}",name: 'show_voiture')]
    public function show($id, VoitureRepository $repo): Response
    {
        $voiture = $repo->find($id);
        
        return $this->render('exo/voitures.html.twig',[
            'voiture' => $voiture
        ]);
    }
    #[Route('/voitures/liste', name: 'voiture_liste')]
    public function listeVoiture(VoitureRepository $repo): Response
    {
        $voitures = $repo->findAll();

        return $this->render('exo/listeVoiture.html.twig', [
            'voitures' => $voitures 
        ]);
    }

    #[Route('/voiture/new', name: 'voiture_create')]
    #[Route("/voiture/edit/{id}", name: 'voiture_edit')]
    public function form(Request $globals, EntityManagerInterface $manager, Voiture $voiture = null)
    {
        if($voiture == null)
        {
            $voiture = new Voiture;
        }

        $form = $this->createForm(VoitureType::class, $voiture);

        $form->handleRequest($globals);

        // dump($voiture);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($voiture);
            $manager->flush();

            return $this->redirectToRoute('show_voiture',[
                'id' => $voiture->getId()
            ]);

        }
        return $this->renderForm("exo/form.html.twig", [
            'formVoiture' => $form,
            'editMode' => $voiture->getId() !== null
        ]);
    }

    #[Route("/voiture/delete/{id}", name:"voiture_delete")]
    // public function delete($id, EntityManagerInterface $manager, VoitureRepository $repo)
    // {
    //     $voiture = $repo->find($id);

    //     $manager->remove($voiture);
    //     $manager->flush();

    //     return $this->redirectToRoute('voiture_liste');
    // }
    public function delete(EntityManagerInterface $manager, Voiture $voiture)
    {

        $manager->remove($voiture);
        $manager->flush();

        return $this->redirectToRoute('voiture_liste');
    }
}
