<?php

namespace App\Controller;
use App\Repository\Impression3DRepository;

use App\Entity\Calendrier;
use App\Entity\Utilisateur;
use App\Entity\Impression3D;
use App\Form\Impression3dFormType;
use App\Form\DayType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class Impression3dController extends AbstractController
{
    public function getMatricule()
    {
        $repository = $this->getDoctrine()->getRepository(Utilisateur::class);
        $Utilisateurs = $repository->findAll();

        return $Utilisateurs ;
    }


    /**
     * @Route("/impression3d", name="impression3d")
     *
     */
    public function index(Request $request)
    {

        $Sub=1;

        //Affichage de la journée choisie
        $Daylooking = new Calendrier();
        $form1 = $this->createForm(DayType::Class, $Daylooking);
        $form1->handleRequest($request);
        $formDate = $form1->get('Date')->getData();
        if($form1->isSubmitted()){
            $entityManager = $this->getDoctrine()->getManager();
            $formDate = $form1->get('Date')->getData();
            $Calid= ($entityManager->getRepository('App:Calendrier')->findOneBy(array('Date'=>$formDate)));
            $CalendrierID=$Calid->getId('id');
            $Sub=0;
            $Data = $this->getDoctrine()
                ->getRepository(Impression3D::class)
                ->findAllPrint($CalendrierID);


        }








        //Form Impression3D
        $impression3d = new Impression3D();
        $form = $this->createForm(Impression3dFormType::Class, $impression3d);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            dump('submitted2');
            $entityManager = $this->getDoctrine()->getManager();
            $formDate = $form->get('date')->getData();
            $formNoma = $form->get('Noma')->getData();
            //Id calendrier et Id Utilisateurs pour la Création d'un Impression3D
            $Calendrier =  $entityManager->getRepository('App:Calendrier')->findOneBy(array('Date'=>$formDate));
            $Utilisateur =  $entityManager->getRepository('App:Utilisateur')->findOneBy(array('id'=>$formNoma));
            //Get l'id et la met dansle form
            $impression3d->setCalendrier($Calendrier);
            $impression3d->setUtilisateur($Utilisateur);

            $entityManager->persist($impression3d);
            $entityManager->flush();
            return $this->redirectToRoute('impression3d');
        }
        //render de la page
        if ($formDate != null)
        {return $this->render('impression3d/index.html.twig', [
            'impression3dForm' => $form->createView(),
            'Day'=>$form1->createView(),
            dump('yoloooooooo'),
            'Data'=>$Data,
            'forma'=>date_format($formDate,'d/M/y'),
            'Sub'=>$Sub


        ]);}
        else
        {return $this->render('impression3d/index.html.twig', [
                'impression3dForm' => $form->createView(),
                'Day'=>$form1->createView(),
                dump('yoloooooooo'),
                'Sub'=>$Sub


            ]);
        }
    }

}

//Recup infos pour faire le select matricule
//$UsersList = [];
//$listUsers= $this->getMatricule();
//foreach($listUsers as $Utilisateurs) {
//    array_push($UsersList, $Utilisateurs);
//}
//Recup du get
//$id_User = $request->query->get('id_user');
//Form Day looking