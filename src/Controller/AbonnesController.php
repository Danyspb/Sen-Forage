<?php

namespace App\Controller;

use App\Entity\Abonnes;
use App\Form\AbonnesType;
use App\Form\RegistrationType;
use App\Repository\AbonnesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AbonnesController extends AbstractController
{
    /**
     * @Route("/abonnes", name="abonnes")
     *
     */
    public function index(Request $request, EntityManagerInterface $manager, AbonnesRepository $repo)
    {
        $abon = $repo->findAll();
        $abonnes = new Abonnes();
        $form = $this->createForm(AbonnesType::class,$abonnes);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $abonnes->setDate(new \DateTime());
            $manager->persist($abonnes);
            $manager->flush();
            return $this->redirectToRoute('abonnes');
        }

        return $this->render('abonnes/index.html.twig', [
            'form' => $form->createView(),
            'abon' => $abon
        ]);
    }


    /**
     * @Route("/abonnes/delete{id}", name="abonnes_delete")
     *
     */
    public function delete($id,EntityManagerInterface $manager)
    {

        $abo = $manager->getRepository(Abonnes::class)->find($id);
        if ($abo != null ){
            $manager->remove($abo);
            $manager->flush();
        }
        return $this->redirectToRoute('abonnes');
    }
}
