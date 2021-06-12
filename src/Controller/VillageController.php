<?php

namespace App\Controller;

use App\Entity\Village;
use App\Form\VillageType;
use App\Repository\VillageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VillageController extends AbstractController
{

    /**
     * @Route("/village", name="village")
     *
     */
    public function village(Request $request, EntityManagerInterface $manager, VillageRepository $repo)
    {
        $villages = $repo->findAll();
        $village = new Village();
        $form = $this->createForm(VillageType::class,$village);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($village);
            $manager->flush();

            return $this->redirectToRoute('village',[
                'id' => $village->getId()
            ]);
        }
        return $this->render('village/index.html.twig',[
            'controller_name' => 'VillageController',
            'form'=> $form->createView(),
            'villages' => $villages
        ]);

    }

    /**
     * @Route("/village/delete{id}", name="village_delete")
     *
     *
     */
    public function delete($id,EntityManagerInterface $manager)
    {

        $vill = $manager->getRepository(Village::class)->find($id);
        if ($vill != null ){
            $manager->remove($vill);
            $manager->flush();
        }
        return $this->redirectToRoute('village');
    }

    /**
     * @Route("/village/edit/{id}", name="village_edit")
     *
     */
    public function edit($id,VillageRepository $repo, EntityManagerInterface $manager)
    {
        $villages = $repo->findAll();
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository(Village::class)->find($id);
        $form = $this->createForm(VillageType::class,$client);
        $data['form'] = $form->createView();
        $data['clients'] = $em->getRepository(Village::class)->findAll();
        $manager->flush();
        return $this->render('village/index.html.twig', [
            'form' =>$form->createView(),
            'villages' => $villages,
            $data
        ]);


    }

}
