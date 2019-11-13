<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class APIActivitesController extends AbstractController
{
    /**
     * @Route("/activites", name="api_activites")
     */
    public function index()
    {
        /* $encoders = array ( new JsonEncoder());
         $normalizers = array (new ObjectNormalizer());
         $serializer = new Serializer ($normalizers , $encoders);
         $em = $this->getDoctrine()->getManager();
         $products = $em->getRepository('App:Product')->findAll();
         $jsonContent = $serializer->serialize($products, 'json');
         $response = new JsonResponse();
         $response->setContent($jsonContent);
         return $response;*/
        return $this->render('activites/index.html.twig');
    }
}
