<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Categorie;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CategorieType;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    public function listerCategorie(ManagerRegistry $doctrine){
        $repository = $doctrine->getRepository(Categorie::class);
        $categorie = $repository->findBy(
            [],
            ['nom' => 'ASC']
        );
        return $this->render('categorie/lister.html.twig', [
            'pCategorie' => $categorie,]);	
            
    }

    
    /* Fonction consultercategorie pour renvoyer toutes les informations d'un categorie en fonction de l'id */

    public function consulterCategorie(ManagerRegistry $doctrine, int $id){
        $categorie = $doctrine->getRepository(Categorie::class)->find($id);

        if(!$categorie){
            throw $this->createNotFoundException(
                'Aucun categorie trouvé avec comme identifiant '.$id
            );
        }
        
        return $this->render('categorie/consulter.html.twig', [
        'categorie'=>$categorie,]);
    }

    public function ajouterCategorie(Request $request,ManagerRegistry $doctrine){
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
     
        if ($form->isSubmitted() && $form->isValid()) {
     
                $categorie = $form->getData();
     
                $entityManager = $doctrine->getManager();
                $entityManager->persist($categorie);
                $entityManager->flush();
     
                return $this->render('categorie/consulter.html.twig', [
                    'categorie'=>$categorie,]);        }
        else
            {
                return $this->render('admin/categorie/ajouter.html.twig', array('form' => $form->createView(),));
        }
    }
}
