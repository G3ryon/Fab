<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Impression3DController extends AbstractController
{
    /**
     * @Route("/impression3/d", name="impression3_d")
     */
    public function index()
    {
        return $this->render('impression3_d/index.html.twig', [
            'controller_name' => 'Impression3DController',
        ]);
    }
}
