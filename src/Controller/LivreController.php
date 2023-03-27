<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Livre;
use Symfony\Component\HttpFoundation\Request;
use App\Form\LivreType;

class LivreController extends AbstractController
{
    #[Route('/livre', name: 'app_livre')]
    public function index(): Response
    {
        return $this->render('livre/index.html.twig', [
            'controller_name' => 'LivreController',
        ]);
    }

    public function listerLivre(ManagerRegistry $doctrine){
        $repository = $doctrine->getRepository(Livre::class);
        $livre = $repository->findBy(
            [],
            ['nom' => 'ASC']
        );
        return $this->render('livre/lister.html.twig', [
            'pLivre' => $livre,]);	
            
    }

    
    /* Fonction consulterLivre pour renvoyer toutes les informations d'un Livre en fonction de l'id */

    public function consulterLivre(ManagerRegistry $doctrine, int $id){
        $livre = $doctrine->getRepository(Livre::class)->find($id);

        if(!$livre){
            throw $this->createNotFoundException(
                'Aucun Livre trouvé avec comme identifiant '.$id
            );
        }
        
        return $this->render('livre/consulter.html.twig', [
        'livre'=>$livre,]);
    }

    public function ajouterLivre(Request $request,ManagerRegistry $doctrine){
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);
     
        if ($form->isSubmitted() && $form->isValid()) {
     
                $livre = $form->getData();
     
                $entityManager = $doctrine->getManager();
                $entityManager->persist($livre);
                $entityManager->flush();
     
                return $this->render('livre/consulter.html.twig', [
                    'livre'=>$livre,]);        
                }
        else
            {
                return $this->render('admin/livre/ajouter.html.twig', array('form' => $form->createView(),));
        }
    }
}
