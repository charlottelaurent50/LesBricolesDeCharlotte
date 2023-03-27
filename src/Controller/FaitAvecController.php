<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\FaitAvec;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FaitAvecType;
use App\Entity\Creation;

class FaitAvecController extends AbstractController
{
    #[Route('/fait/avec', name: 'app_fait_avec')]
    public function index(): Response
    {
        return $this->render('fait_avec/index.html.twig', [
            'controller_name' => 'FaitAvecController',
        ]);
    }

    /*public function ajouterFaitAvec(Request $request,ManagerRegistry $doctrine){
        $faitAvec = new FaitAvec();
        $form = $this->createForm(FaitAvecType::class, $faitAvec);
        $form->handleRequest($request);

        $repository = $doctrine->getRepository(Creation::class);
        $creation = $repository->findBy(
            [],
            ['id' => 'DESC']
        );
     
        if ($form->isSubmitted() && $form->isValid()) {

                $faitAvec = $form->getData();
     
                $entityManager = $doctrine->getManager();
                $entityManager->persist($faitAvec);
                $entityManager->flush();
     
                return $this->redirectToRoute('creationAjouter');}
        else
            {
                return $this->render('admin/faitAvec/ajouter.html.twig',[
                    'pCreation' => $creation,
                    'form' => $form->createView(),],);
        }

    }*/
}
