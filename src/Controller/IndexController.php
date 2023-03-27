<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Categorie;
use App\Entity\Genre;
use App\Entity\Livre;
use App\Entity\Patron;

class IndexController extends AbstractController
{
    #[Route('', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    public function accueil(ManagerRegistry $doctrine){
        $repository = $doctrine->getRepository(Categorie::class);
        $cat = $repository->findAll();

        $repository = $doctrine->getRepository(Genre::class);
        $genre = $repository->findAll();

        $repository = $doctrine->getRepository(Livre::class);
        $livre = $repository->findAll();

        $repository = $doctrine->getRepository(Patron::class);
        $patron = $repository->findAllByLikeDesc();


        return $this->render('index/index.html.twig', [
            'pCategorie' => $cat,
            'pGenre' => $genre,
            'pLivre' => $livre,
            'pPatron' => $patron,]);	
            
    }


    public function admin(ManagerRegistry $doctrine){
        $repository = $doctrine->getRepository(Categorie::class);
        $cat = $repository->findAll();

        $repository = $doctrine->getRepository(Genre::class);
        $genre = $repository->findAll();

        $repository = $doctrine->getRepository(Livre::class);
        $livre = $repository->findAll();


        return $this->render('admin/index.html.twig', [
            'pCategorie' => $cat,
            'pGenre' => $genre,
            'pLivre' => $livre,]);	
            
    }
}
