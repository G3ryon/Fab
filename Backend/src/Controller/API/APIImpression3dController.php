<?php

namespace App\Controller\API;

use DateTime;
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
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 *Impression3D Controller
 *@Route("/api", name="api_", methods={"POST","OPTIONS","GET"})
 */
class APIImpression3dController extends AbstractController
{
    public function getMatricule()
    {
        $repository = $this->getDoctrine()->getRepository(Utilisateur::class);
        $Utilisateurs = $repository->findAll();

        return $Utilisateurs ;
    }

    /**
     * Date displayer api
     * @Route("/Date", name="api_date", methods={"POST","HEAD"})
     * @param Request $request
     * @return Response
     */
    public function DateDisplay(Request $request)
    {
        dump($request->query->get('date'));
        $Date = $request->query->get('date');

        $em = $this->getDoctrine()->getManager();
        $formDates = new DateTime($Date);
        dump($Date);
        $Cal= ($em->getRepository('App:Calendrier')->findOneBy(array('Date'=>$formDates)));
        $CalendID=$Cal->getId('id');
        $Data = $this->getDoctrine()
              ->getRepository(Impression3D::class)
              ->findAllPrint($CalendID);

        $products = $Data;
        $encoders = array( new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers,$encoders);
        $defaultContext= [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                            return $object->getId();
                        },
            ObjectNormalizer::CIRCULAR_REFERENCE_LIMIT =>0,
            AbstractNormalizer::IGNORED_ATTRIBUTES =>["utilisateur","Calendrier","date","Noma",'__cloner__','__initializer__','__isInitialized__'],
            ObjectNormalizer::ENABLE_MAX_DEPTH => true,
            DateTimeNormalizer::FORMAT_KEY => 'Y/m/d H:i'
                    ];

        $jsonContent = $serializer->serialize($products,'json',$defaultContext);

        $response = new JsonResponse();
        $response->setContent($jsonContent);
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;}

     /**
     * FormPrint sender api
     * @Route("/newPrint", name="api_formp", methods={"HEAD","POST"})
     * @param Request $request
     * @return Response
     */
  /* public function DateDisplay(request $request)
    {
        $encoders = array( new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers,$encoders);
        $em = $this->getDoctrine()->getManager();
        $formDates = new DateTime($Date);
        $Cal= ($em->getRepository('App:Calendrier')->findOneBy(array('Date'=>$formDates)));
        $CalendID=$Cal->getId('id');
        $Data = $this->getDoctrine()
              ->getRepository(Impression3D::class)
              ->findAllPrint($CalendID);
        $products = $Data;
        $jsonContent = $serializer->serialize($products,'json',
                                             ['circular_reference_handler' => function ($object)
                                              { return $object->getId(); }]);

        $response = new JsonResponse();
        $response->setContent($jsonContent);

        return $response;}*/


/*        $Sub=1;

        //Affichage de la journée choisie
        $Daylooking = new Calendrier();
        $form1 = $this->createForm(DayType::Class, $Daylooking);
        $form1->handleRequest($request);
        $formDate = $form1->get('Date')->getData();
        if($form1->isSubmitted()){
            $Sub=0;
            $entityManager = $this->getDoctrine()->getManager();
            $formDate = $form1->get('Date')->getData();
            $Calid= ($entityManager->getRepository('App:Calendrier')->findOneBy(array('Date'=>$formDate)));
            $CalendrierID=$Calid->getId('id');

            $Data = $this->getDoctrine()
                ->getRepository(Impression3D::class)
                ->findAllPrint($CalendrierID);

        }


        //Form Impression3D
        $impression3d = new Impression3D();
        $form = $this->createForm(Impression3dFormType::Class, $impression3d);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $Date = $form->get('date')->getData();
            $heure = $form->get('Heure')->getData();
            $IdCalendrier= ($entityManager->getRepository('App:Calendrier')->findOneBy(array('Date'=>$Date)));
            $CalendrierID=$IdCalendrier->getId('id');


            $Data2 = $this->getDoctrine()
                ->getRepository(Impression3D::class)
                ->findAllHeure($CalendrierID,$heure);

            dump($Data2,$heure,$CalendrierID);


            if($Data2 == [])
            {

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
            $this->addFlash('success',"L'impression a bien été ajouté au calendrier");
            return $this->redirectToRoute('impression3d');
        }
            else
                {
                $this->addFlash('warning','Il y a déjà une impression à cette heure là');
                }
        }


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
        }*/




    /**
     * @Route("/Download/{ddl}", name="api_ddl", methods={"GET"})
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

