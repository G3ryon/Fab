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
 *API Activites Controller
 *@Route("/api", name="api_", methods={"POST","OPTIONS","GET"})
 */
class APIActivitesController extends AbstractController
{
    /**
     * @Route("/activites", name="api_activites")
     */
    public function index()
    {    }
}
