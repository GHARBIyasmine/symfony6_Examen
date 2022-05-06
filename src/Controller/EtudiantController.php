<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/etudiant')]
class EtudiantController extends AbstractController
{
    #[Route('/', name: 'etudiant')]
    public function index(ManagerRegistry $doctrine): Response
    {
       $repo= $doctrine->getRepository(Etudiant::class);
       $etudiant = $repo->findAll();

        return $this->render('etudiant/index.html.twig', [
          'etds'=> $etudiant
        ]);
    }


    #[Route('/remove/{id<\d+>?0}', name: 'removeEtudiant')]
    public function remove(ManagerRegistry $doctrine, Etudiant $etd = null): RedirectResponse
    {
        if (!$etd) {
            $this->addFlash('error', 'student non existent');

        } else {
            $manager = $doctrine->getManager();
            $manager->remove($etd);
            $this->addFlash('success', 'student removed successfully');
            $manager->flush();

        }
        return $this->redirectToRoute('etudiant');
    }

    #[Route('/edit/{id?0}', name: 'etudiantform')]
    public function addEtudiantForm(ManagerRegistry $doctrine , Request $request, Etudiant $etd=null): Response
    {
        if (!$etd){
            $etd = new Etudiant();
        }

        $form = $this->createForm(EtudiantType::class, $etd);

        $form->handleRequest($request);
        if ($form->isSubmitted() ){

            $manager = $doctrine->getManager();
            $manager->persist($etd);
            $manager->flush();
            $this->addFlash('success','form submitted successfully');
            return $this->redirectToRoute('etudiant');
        }
        else{
            return $this->render('etudiant/from.html.twig', [
                'form' => $form->createView()
            ]);
        }


    }


}
