<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Formation3DType;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends AbstractController
{

    //Handling the update of the formation in the database for a specific user
    public function updateFormation($form,$entityManager,$formNoma)
    {
        $formBool = $form->get('Formprint')->getData();
        $user = $entityManager->getRepository(Utilisateur::class)->find($formNoma);
        $user->setFormprint($formBool);
        $entityManager->flush();
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(Request $request)
    {
        $Formation = new Utilisateur();
        $form = $this->createForm(Formation3DType::Class, $Formation);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
        $entityManager = $this->getDoctrine()->getManager();
        $formNoma = $form->get('noma')->getData();
        //check if the user exist in the database
        if((bool)($entityManager->getRepository('App:Utilisateur')->findOneBy(array('id'=>$formNoma))))
        {
        $this->updateFormation($form,$entityManager,$formNoma);
        $this->addFlash('success', "Success");
        }
        else
        {
        $this->addFlash('warning', "Echec");
        }
        }
        return $this->render('admin/index.html.twig', [
            'Formation3D'=>$form->createView(),
        ]);
    }
}
