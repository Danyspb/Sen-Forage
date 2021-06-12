<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Form\ClientsType;
use App\Repository\ClientsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClientsController extends AbstractController
{
    /**
     * @Route("/clients", name="clients")
     *
     */
    public function forms(Request $request, EntityManagerInterface $manager,ClientsRepository $repo)
    {
        $clis = $repo->findAll();
        $client = new Clients();
        $form = $this->createForm(ClientsType::class, $client);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()){

            $manager->persist($client);
            $manager->flush();

            return $this->redirectToRoute('clients');
        }
        return $this->render('clients/index.html.twig', [
            'form' =>$form->createView(),
            'clis' => $clis,
        ]);
    }


    /**
     * @Route("/clients/delete{id}", name="clients_delete")
     *
     */
    public function delete($id,EntityManagerInterface $manager)
    {

        $clie = $manager->getRepository(Clients::class)->find($id);
        if ($clie != null ){
            $manager->remove($clie);
            $manager->flush();
        }
        return $this->redirectToRoute('clients');
    }


    /**
     * @Route("/clients/edit/{id}", name="clients_edit")
     *
     */
    public function edit($id,ClientsRepository $repo)
    {
        $clis = $repo->findAll();
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository(Clients::class)->find($id);
        $form = $this->createForm(ClientsType::class,$client);
        $data['form'] = $form->createView();
        $data['clients'] = $em->getRepository(Clients::class)->findAll();
        return $this->render('clients/index.html.twig', [
            'form' =>$form->createView(),
            'clis' => $clis,
            $data
        ]);
    }

}
