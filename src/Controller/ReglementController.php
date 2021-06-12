<?php

namespace App\Controller;

use App\Entity\Factures;
use App\Entity\Reglement;
use App\Form\ReglementType;
use App\Repository\ReglementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReglementController extends AbstractController
{
    /**
     * @Route("/reglement", name="reglement")
     */
    public function index(Request $request, ReglementRepository $repo, EntityManagerInterface $manager)
    {
        $reglement = new Reglement();
        $tabl = $repo->findAll();
        $form = $this->createForm(ReglementType::class,$reglement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $reg = $manager->getRepository(Factures::class)->find($reglement->getFacture()->getId());
            $dtl = $reg->getDatelimitepaye();
            $dtn = new \DateTime();
            if ($dtl < $dtn)
            {
                $pour = $reg->getPrix() * 5/100 ;
                $sommme = $reg->getPrix() + $pour ;
                $reglement->setEtatcompteur('A Couper');
                $reglement->setEtatpaiement('Non Payer');
                $reg->setPrix($sommme);
                $manager->persist($reglement);
                $manager->flush();
                $this->redirectToRoute('reglement');
            }elseif ($dtl > $dtn )
            {
                $reglement->setEtatcompteur('Actif');
                $reglement->setEtatpaiement('En attente');
                $reg->getPrix();
                $manager->persist($reglement);
                $manager->flush();
                $this->redirectToRoute('reglement');
            }
            $manager->persist($reglement);
            $manager->flush();
            $this->redirectToRoute('reglement');
        }

        return $this->render('reglement/index.html.twig', [
            'form'=>$form->createView(),
            'tabl'=> $tabl
        ]);
    }


    /**
     * @Route("/reglement/delete{id}", name="reglement_delete")
     *
     */
    public function delete($id,EntityManagerInterface $manager)
    {

        $regle = $manager->getRepository(Reglement::class)->find($id);
        if ($regle != null ){
            $manager->remove($regle);
            $manager->flush();
        }
        return $this->redirectToRoute('reglement');
    }
}
