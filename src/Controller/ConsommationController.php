<?php

namespace App\Controller;

use App\Entity\Consommation;
use App\Form\ConsommatonTypesType;
use App\Repository\CompteursRepository;
use App\Repository\ConsommationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConsommationController extends AbstractController
{
    /**
     * @Route("/consommation", name="consommation")
     */
    public function index(EntityManagerInterface $manager, Request $request, ConsommationRepository $repo, CompteursRepository $comt)
    {
        $comp = $comt->findAll();
        $mat = $repo->findAll();
        $cons = new Consommation();
        $form = $this->createForm(ConsommatonTypesType::class,$cons);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $cons->setPrix('117');
            $manager->persist($cons);
            $manager->flush();
            $up = $manager->getRepository(Consommation::class)->find($cons->getId());
            $t = $up->getLitreconsomme();
            $dt = $cons->getLitreconsomme();
            if($t !=null)
            {
                $ts = $t + $dt;
                $manager->flush();
            }

            return $this->redirectToRoute('consommation');
        }

        return $this->render('consommation/index.html.twig', [
            'controller_name' => 'ConsommationController',
            'form' => $form->createView(),
            'mat' => $mat,
            'comp' => $comp
        ]);
    }

    /**
     * @Route("/consommation/delete{id}", name="consommation_delete")
     *
     */
    public function delete($id,EntityManagerInterface $manager)
    {

        $consomm = $manager->getRepository(Consommation::class)->find($id);
        if ($consomm != null ){
            $manager->remove($consomm);
            $manager->flush();
        }
        return $this->redirectToRoute('consommation');
    }
}
