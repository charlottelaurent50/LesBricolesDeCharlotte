<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Creation;
use App\Entity\Patron;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CreationType;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CreationController extends AbstractController
{
    #[Route('/creation', name: 'app_creation')]
    public function index(): Response
    {
        return $this->render('creation/index.html.twig', [
            'controller_name' => 'CreationController',
        ]);
    }

    public function listerCreation(ManagerRegistry $doctrine){
        $repository = $doctrine->getRepository(Creation::class);
        $creation = $repository->findBy(
            [],
            ['date' => 'DESC']
        );
        return $this->render('creation/lister.html.twig', [
            'pCreation' => $creation,]);	
            
    }

    
    /* Fonction consultercreation pour renvoyer toutes les informations d'un creation en fonction de l'id */

    public function consulterCreation(ManagerRegistry $doctrine, int $id){
        $creation = $doctrine->getRepository(Creation::class)->find($id);

        if(!$creation){
            throw $this->createNotFoundException(
                'Aucun creation trouvé avec comme identifiant '.$id
            );
        }
        
        return $this->render('creation/consulter.html.twig', [
        'creation'=>$creation,]);
    }

    public function ajouterCreation(Request $request,ManagerRegistry $doctrine){
        
        $creation = new Creation();
        $form = $this->createForm(CreationType::class, $creation);
        
        $form->handleRequest($request);
     
     
        if ($form->isSubmitted() && $form->isValid()) {

            $creation = $form->getData();
     
            $entityManager = $doctrine->getManager();
            $entityManager->persist($creation);
            $entityManager->flush();
     
            return $this->redirectToRoute('creationAjouter');
        }
        else
        {
            return $this->render('admin/creation/ajouter.html.twig',[
                'form' => $form->createView(),],);
    }
    }
}
