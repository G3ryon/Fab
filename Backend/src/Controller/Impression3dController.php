<?php

namespace App\Controller;
use App\Repository\Impression3DRepository;

use App\Entity\Calendrier;
use App\Entity\Utilisateur;
use App\Entity\Impression3D;
use App\Form\Impression3dFormType;
use App\Form\DayType;
use phpDocumentor\Reflection\Types\String_;
use PhpParser\Node\Stmt\Foreach_;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\MimeType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class Impression3dController extends AbstractController
{
    static $Sub;

    public function getMatricule()
    {
        $repository = $this->getDoctrine()->getRepository(Utilisateur::class);
        $Utilisateurs = $repository->findAll();

        return $Utilisateurs ;
    }

    public function getCalendarId($form,$Get,$entityManager){

        $Date = $form->get($Get)->getData();
        if((bool)($entityManager->getRepository('App:Calendrier')->findOneBy(array('Date'=>$Date)))){
            $IdCalendrier= ($entityManager->getRepository('App:Calendrier')->findOneBy(array('Date'=>$Date)));
            $CalendrierID=$IdCalendrier->getId('id');
        }
        else{
            $CalendrierID = "null";

        }
        return $CalendrierID;
    }

    public function uploadFile($PrintFile)
        {
            //Upload management
            dump($PrintFile);
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
            return $newFilename;
        }

    public function dayDisplay($form1,$entityManager){
        //Getting the prints which occurs at the date choosen by the user
         global $Sub;
         $Sub=3;
         $Get='Date';
         $CalendrierID=$this->getCalendarId($form1,$Get,$entityManager);
         if($CalendrierID=="null"){

            $this->addFlash('warning', "l'ECAM n'est pas accesible ce jour là");
             return $this->redirectToRoute('impression3d');

         }

         $Data = $this->getDoctrine()
             ->getRepository(Impression3D::class)
             ->findAllPrint($CalendrierID);

        if((bool)($this->getDoctrine()
                        ->getRepository(Impression3D::class)
                        ->findAllPrint($CalendrierID))){
            $Sub = 0;
        }

        return $Data;
     }

     public function formSubmit($form,$impression3d,$entityManager){
        //Submiting the data filled by the user in the print form
         $heure = $form->get('Heure')->getData();
         $temps = $form->get('Temps')->getData();
         if($temps>2 and $heure != 18 ){
             $this->addFlash('warning', "Votre impression est trop longue placez là un jour à 18h");
             return $this->redirectToRoute('impression3d');
         }
         $Get='date';
         $CalendrierID=$this->getCalendarId($form,$Get,$entityManager);

         $Data2 = $this->getDoctrine()
             ->getRepository(Impression3D::class)
             ->findAllHeure($CalendrierID,$heure);

         //let the form be submit only if there isn't other print at the same time
         if($Data2 == [])
         {
            $formNoma = $form->get('Noma')->getData();
            if((bool)$entityManager->getRepository('App:Utilisateur')->findOneBy(array('id'=>$formNoma))){
             //Date and Noma adding
             $entityManager = $this->getDoctrine()->getManager();
             $formDate = $form->get('date')->getData();

             $PrintFile = $form['PrintFile']->getData();

             //PrintFilename adding
             $newFilename= $this->uploadFile($PrintFile);
             $impression3d->setPrintFilename($newFilename);

             //Join in the database to get the data related to the print
             $Calendrier =  $entityManager->getRepository('App:Calendrier')->findOneBy(array('Date'=>$formDate));
             $Utilisateur =  $entityManager->getRepository('App:Utilisateur')->findOneBy(array('id'=>$formNoma));

             //Adding the Calendrier and User data to the query and submitting to the Db
             $impression3d->setCalendrier($Calendrier);
             $impression3d->setUtilisateur($Utilisateur);
             $entityManager->persist($impression3d);
             $entityManager->flush();

             $this->addFlash('success',"L'impression a bien été ajouté au calendrier");
             return $this->redirectToRoute('impression3d');
            }
            else{
             $this->addFlash('warning', "Vous n'avez pas fait la formation pour pouvoir programmer une impression!");
             return $this->redirectToRoute('impression3d');
            }
         }
         else {
             $this->addFlash('warning', 'Il y a déjà une impression à cette heure là');
             return $this->redirectToRoute('impression3d');
         }
     }

    /**
     * @Route("/impression3d", name="impression3d")
     *
     */
    public function index(Request $request)
    {
        global $Sub;
        $Sub=1;
        $entityManager = $this->getDoctrine()->getManager();

        //Displaying of the prints
        $Daylooking = new Calendrier();
        $form1 = $this->createForm(DayType::Class, $Daylooking);
        $form1->handleRequest($request);
        $formDate = $form1->get('Date')->getData();
        if($form1->isSubmitted()){
            $Data=$this->dayDisplay($form1,$entityManager);
        }

        //Form Impression3D
        $impression3d = new Impression3D();
        $form = $this->createForm(Impression3dFormType::Class, $impression3d);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->formSubmit($form,$impression3d,$entityManager);
        }

        //Rendering of the page depending if there are data to display
        if ($formDate != null)
        {return $this->render('impression3d/index.html.twig', [
            'impression3dForm' => $form->createView(),
            'Day'=>$form1->createView(),
            'Data'=>$Data,
            'forma'=>date_format($formDate,'d/M/y'),
            'Sub'=>$Sub,

        ]);}
        else
        {return $this->render('impression3d/index.html.twig', [
                'impression3dForm' => $form->createView(),
                'Day'=>$form1->createView(),
                'Sub'=>$Sub,

            ]);
        }
    }



    /**
     * @Route("/Download/{ddl}", name="ddl", methods={"GET"})
     *
     */
    public function fileAction(string $ddl)
    {
        $path = 'Gcode_directory/'.$ddl ;
        // load the file from the filesystem
        $file = new File($path);

        return $this->file($file);

    }
}
