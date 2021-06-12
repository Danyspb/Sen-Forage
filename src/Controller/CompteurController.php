<?php

namespace App\Controller;

use App\Entity\Abonnes;
use App\Entity\Compteurs;
use App\Form\CompteursTypesType;
use App\Repository\CompteursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CompteurController extends AbstractController
{
    /**
     * @Route("/compteur", name="compteur")
     */
    public function index(Request $request, EntityManagerInterface $manager,CompteursRepository $repo)
    {
        $comp = $repo->findAll();
        $compteurs = new Compteurs();
        $form = $this->createForm(CompteursTypesType::class, $compteurs);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($compteurs);
            $manager->flush();

            return $this->redirectToRoute('compteur');
        }

        return $this->render('compteur/index.html.twig', [
            'controller_name' => 'CompteurController',
            'form'=>$form->createView(),
            'comp' => $comp
        ]);
    }

    /**
     * @Route("/compteur/delete{id}", name="compteur_delete")
     *
     */
    public function delete($id,EntityManagerInterface $manager)
    {

        $comp = $manager->getRepository(Compteurs::class)->find($id);
        if ($comp != null ){
            $manager->remove($comp);
            $manager->flush();
        }
        return $this->redirectToRoute('compteur');
    }
}
