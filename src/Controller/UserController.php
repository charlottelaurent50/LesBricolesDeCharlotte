<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserModifierType;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /* Fonction consulteruser pour renvoyer toutes les informations d'un user en fonction de l'id */

    public function consulterUser(ManagerRegistry $doctrine, int $id){
        $user = $doctrine->getRepository(User::class)->find($id);

        if(!$user){
            throw $this->createNotFoundException(
                'Aucun user trouvé avec comme identifiant '.$id
            );
        }
        
        return $this->render('user/consulter.html.twig', [
        'user'=>$user,]);
    }

    public function modifierUser(ManagerRegistry $doctrine, $id, Request $request){
 
        //récupération de l'étudiant dont l'id est passé en paramètre
        $user = $doctrine->getRepository(User::class)->find($id);
     
        if (!$user) {
            throw $this->createNotFoundException('Aucun user trouvé avec le numéro '.$id);
        }
        else
        {
                $form = $this->createForm(UserModifierType::class, $user);
                $form->handleRequest($request);
     
                if ($form->isSubmitted() && $form->isValid()) {
     
                     $user = $form->getData();
                     $entityManager = $doctrine->getManager();
                     $entityManager->persist($user);
                     $entityManager->flush();
                     return $this->render('user/consulter.html.twig', ['user' => $user,]);
               }
               else{
                    return $this->render('registration/register.html.twig', array('registrationForm' => $form->createView(),));
               }
            }
     }

     public function listerUser(ManagerRegistry $doctrine){
         $repository = $doctrine->getRepository(User::class);
         $user = $repository->findBy(
            [],
            ['nom' => 'ASC']
        );
         return $this->render('admin/user/lister.html.twig', [
             'pUser' => $user,]);	
             
     }
}
