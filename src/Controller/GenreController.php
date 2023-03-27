<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Genre;
use Symfony\Component\HttpFoundation\Request;
use App\Form\GenreType;

class GenreController extends AbstractController
{
    #[Route('/genre', name: 'app_genre')]
    public function index(): Response
    {
        return $this->render('genre/index.html.twig', [
            'controller_name' => 'GenreController',
        ]);
    }

    public function listerGenre(ManagerRegistry $doctrine){
        $repository = $doctrine->getRepository(Genre::class);
        $genre = $repository->findBy(
            [],
            ['nom' => 'ASC']
        );
        return $this->render('genre/lister.html.twig', [
            'pGenre' => $genre,]);	
            
    }

    
    /* Fonction consultergenre pour renvoyer toutes les informations d'un genre en fonction de l'id */

    public function consulterGenre(ManagerRegistry $doctrine, int $id){
        $genre = $doctrine->getRepository(Genre::class)->find($id);

        if(!$genre){
            throw $this->createNotFoundException(
                'Aucun genre trouvé avec comme identifiant '.$id
            );
        }
        
        return $this->render('genre/consulter.html.twig', [
        'genre'=>$genre,]);
    }

    public function ajouterGenre(Request $request,ManagerRegistry $doctrine){
        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);
     
        if ($form->isSubmitted() && $form->isValid()) {
     
                $genre = $form->getData();
     
                $entityManager = $doctrine->getManager();
                $entityManager->persist($genre);
                $entityManager->flush();
     
            return $this->render('admin/genre/ajouter.html.twig', array('form' => $form->createView(),));
        }
        else
            {
                return $this->render('admin/genre/ajouter.html.twig', array('form' => $form->createView(),));
        }
    }
}
