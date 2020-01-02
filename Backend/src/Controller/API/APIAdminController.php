<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Formation3DType;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 *Admin Controller
 *@Route("/api", name="api_", methods={"POST","OPTIONS","GET"})
 */
class APIAdminController extends AbstractController
{
 public function query($qstr,$request)
    {
        return $request->query->get($qstr);
    }
    /**
         * Update formation status api
         * @Route("/formationbool", name="api_formbool", methods={"POST","HEAD"})
         * @param Request $request
         *
         * @return JsonResponse
         * @throws \Exception
         */
    public function index(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $formNoma = $this->query('Noma',$request);
        $formBool = $this->query('Bool',$request);
        dump($formBool);
        if((bool)($entityManager->getRepository('App:Utilisateur')->findOneBy(array('id'=>$formNoma))))
        {
        $user = $entityManager->getRepository(Utilisateur::class)->find($formNoma);
        $user->setFormprint((bool)$formBool);
        $entityManager->flush();

        $response = JsonResponse::fromJsonString('{ "code": 200 }');
        return $response;
        }
        else{
            $response = JsonResponse::fromJsonString('{ "code": 401 }');
            return $response;
        }
    }
}
