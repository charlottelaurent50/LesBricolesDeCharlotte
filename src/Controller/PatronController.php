<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Patron;
use App\Entity\Creation;
use App\Entity\Like;
use App\Repository\LikeRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PatronType;
use App\Form\PatronModifierType;
use App\Form\PatronsCreationsType;

class PatronController extends AbstractController
{
    #[Route('/patron', name: 'app_patron')]
    public function index(): Response
    {
        return $this->render('patron/index.html.twig', [
            'controller_name' => 'PatronController',
        ]);
    }

    public function listerPatron(ManagerRegistry $doctrine){
        $repository = $doctrine->getRepository(Patron::class);
        $patron = $repository->findBy(
            [],
            ['nom' => 'ASC']
        );
        return $this->render('patron/lister.html.twig', [
            'pPatron' => $patron,]);	
            
    }

    
    /* Fonction consulter patron pour renvoyer toutes les informations d'un patron en fonction de l'id*/

    public function consulterPatron(ManagerRegistry $doctrine, int $id){
        $patron = $doctrine->getRepository(Patron::class)->find($id);

        if(!$patron){
            throw $this->createNotFoundException(
                'Aucun patron trouvé avec comme identifiant '.$id
            );
        }
        
        return $this->render('patron/consulter.html.twig', [
        'patron'=>$patron,]);
    }
    /*  Permet de like ou unlike un patron */

    public function likePatron(Patron $patron, EntityManagerInterface $manager, LikeRepository $likeRepo): Response
    {
        $user = $this->getUser();

        if(!$user) return $this->json([
            'code' => 403,
            'message' => 'Il faut etre connecter'
        ], 403);

        if($patron->isLikedByUser($user)){
            $like = $likeRepo->findOneBy([
                'patrons' => $patron,
                'user' => $user
            ]);

            $manager->remove($like);
            $manager->flush();

            return $this->json([
                'code' => 200,
                'messsage' => 'Like bien supprimé',
                'likes' => $likeRepo->count(['patrons' => $patron])
            ], 200);
        }

        $like = new Like();
        $like -> setPatrons($patron)
            ->setUser($user);

        $manager->persist($like);
        $manager->flush();


        return $this->json([
            'code' => 200, 
            'message' => 'like bien ajoute',
            'likes' => $likeRepo->count(['patrons' => $patron])
        ],200);
    }

    public function ajouterPatron(Request $request,ManagerRegistry $doctrine){
        $patron = new Patron();
        $form = $this->createForm(PatronType::class, $patron);
        $form->handleRequest($request);
     
        if ($form->isSubmitted() && $form->isValid()) {
     
                $patron = $form->getData();
     
                $entityManager = $doctrine->getManager();
                $entityManager->persist($patron);
                $entityManager->flush();
     
                return $this->render('patron/consulter.html.twig', [
                    'patron'=>$patron,]);        }
        else
            {
                return $this->render('admin/patron/ajouter.html.twig', array('form' => $form->createView(),));
        }
    }

    public function modifierPatron(ManagerRegistry $doctrine, $id, Request $request){
 
        //récupération du patron dont l'id est passé en paramètre
        $patron = $doctrine->getRepository(Patron::class)->find($id);
     
        if (!$patron) {
            throw $this->createNotFoundException('Aucun patron trouvé avec le numéro '.$id);
        }
        else
        {
                $form = $this->createForm(PatronModifierType::class, $patron);
                $form->handleRequest($request);
     
                if ($form->isSubmitted() && $form->isValid()) {
     
                     $patron = $form->getData();
                     $entityManager = $doctrine->getManager();
                     $entityManager->persist($patron);
                     $entityManager->flush();
                     return $this->render('patron/consulter.html.twig', ['patron' => $patron,]);
               }
               else{
                    return $this->render('admin/patron/ajouter.html.twig', array('form' => $form->createView(),));
               }
            }
     }
     public function patronsCrea(Request $request, EntityManagerInterface $entityManager,ManagerRegistry $doctrine)
     {
        $patron = new Patron();
        $form = $this->createForm(PatronsCreationsType::class, $patron);
        $form->handleRequest($request);

        $repository = $doctrine->getRepository(Creation::class);
        $creationR = $repository->findBy(
            [],
            ['id' => 'DESC']
        );

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($patron);

            foreach ($patron->getRelation() as $creation) {
                $creation->addPatron($patron);
                $entityManager->persist($creation);
            }

            $entityManager->flush();

            return $this->redirectToRoute('creationAjouter');
        }

        return $this->render('admin/faitAvec/ajouter.html.twig',[
            'pCreation' => $creationR,
            'form' => $form->createView(),],);
    
    }
}
