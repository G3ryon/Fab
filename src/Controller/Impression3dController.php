<?php

namespace App\Controller;
use App\Repository\Impression3DRepository;

use App\Entity\Calendrier;
use App\Entity\Utilisateur;
use App\Entity\Impression3D;
use App\Form\Impression3dFormType;
use App\Form\DayType;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\MimeType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
            if(true){
               $this->HourFree($request);
            }
            else{
            $entityManager = $this->getDoctrine()->getManager();
            $formDate = $form->get('date')->getData();
            $formNoma = $form->get('Noma')->getData();
            $PrintFile = $form['PrintFile']->getData();

            //gestion du upload
            $originalFilename = pathinfo($PrintFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$PrintFile->guessExtension();
            try {
                $PrintFile->move(
                    'Gcode_directory',
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $impression3d->setPrintFilename($newFilename);

            //Id calendrier et Id Utilisateurs pour la Création d'un Impression3D
            $Calendrier =  $entityManager->getRepository('App:Calendrier')->findOneBy(array('Date'=>$formDate));
            $Utilisateur =  $entityManager->getRepository('App:Utilisateur')->findOneBy(array('id'=>$formNoma));

            //Get l'id et la met dans le form
            $impression3d->setCalendrier($Calendrier);
            $impression3d->setUtilisateur($Utilisateur);

            $entityManager->persist($impression3d);
            $entityManager->flush();
            $this->addFlash('success','Impression ajoutée au calendrier');
            return $this->redirectToRoute('impression3d');
        }}


        //render de la page
        if ($formDate != null)
        {return $this->render('impression3d/index.html.twig', [
            'impression3dForm' => $form->createView(),
            'Day'=>$form1->createView(),
            'Data'=>$Data,
            'forma'=>date_format($formDate,'d/M/y'),
            'Sub'=>$Sub

        ]);}
        else
        {return $this->render('impression3d/index.html.twig', [
                'impression3dForm' => $form->createView(),
                'Day'=>$form1->createView(),
                'Sub'=>$Sub
            ]);
        }
    }


    /**
     * @Route("/Download/{ddl}", name="ddl")
     *
     */
    public function fileAction(string $ddl)
    {
        $path = 'Gcode_directory/'.$ddl ;
        // load the file from the filesystem
        $file = new File($path);

        return $this->file($file);
    }

    public function HourFree(Request $request)
    {
        $impression3d = new Impression3D();
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(Impression3dFormType::Class, $impression3d);
        $form->handleRequest($request);
        $formDate = $form->get('date')->getData();
        $Calid= ($entityManager->getRepository('App:Calendrier')->findOneBy(array('Date'=>$formDate)));

        $CalendrierID=$Calid->getId('id');
        $HeureImp = $form ->get('Heure')->getData();
        $TempsImp = $form ->get('Temps')->getData();


        $Data = $this->getDoctrine()
            ->getRepository(Impression3D::class)
            ->findAllPrint($CalendrierID);

        foreach($Data as $infos){

            $this->addFlash('success',$infos);
        }

    }



}

