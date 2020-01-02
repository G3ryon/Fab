<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 *API galerie Controller
 *@Route("/api", name="api_", methods={"POST","OPTIONS","GET"})
 */
class APIGalerieController extends AbstractController
{
    /**
     * @Route("/galerie", name="api_galerie")
     */
    public function index()
    {    }
}
