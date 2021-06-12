<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/acceuil", name="acceuil")
     */
    public function index()
    {
        return $this->render('acceuil/index.html.twig', [
            'controller_name' => 'AcceuilController',
        ]);
    }


    /**
     * @Route("/", name="login")
     */
    public function login()
    {
        return $this->render('login/login.html.twig',[
        ]);

    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){

        return $this->render('login/login.html.twig');

    }



}
