<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Impression3dController extends AbstractController
{
    /**
     * @Route("/impression3d", name="impression3d")
     */
    public function index()
    {
        return $this->render('impression3d/index.html.twig', [
            'controller_name' => 'Impression3dController',
        ]);
    }
}
