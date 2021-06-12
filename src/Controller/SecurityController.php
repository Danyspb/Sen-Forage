<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Entity\Employes;
use App\Form\RegistrationType;
use App\Repository\EmployesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/ajout", name="ajout")
     */
    public function ajout(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, EmployesRepository $repo){

        $empl = $repo->findAll();
        $employes = new Employes();
        $form = $this->createForm(RegistrationType::class,$employes);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($employes,$employes->getPassword());
            $employes->setPassword($hash);
            $manager->persist($employes);
            $manager->flush();

            return $this->redirectToRoute('ajout');

        }
        return $this->render('security/ajout.html.twig',[
            'form'=> $form->createView(),
            'empl' => $empl
        ]);
    }

    /**
     * @Route("/employes/delete{id}", name="employes_delete")
     *
     */
    public function delete($id,EntityManagerInterface $manager)
    {

        $empl = $manager->getRepository(Employes::class)->find($id);
        if ($empl != null ){
            $manager->remove($empl);
            $manager->flush();
        }
        return $this->redirectToRoute('ajout');
    }


}
