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
        $Date = $request->query->get('date');
        $em = $this->getDoctrine()->getManager();
        $formDates = new DateTime($Date);

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

        return $response;}


    /**
    * @Route("/Download", name="api_ddl", methods={"POST","HEAD","GET"})
    * @param Request $request
    *
    */
    public function fileAction(Request $request)
    {
        $Ddl = $request->query->get('ddl');
        $path = 'Gcode_directory/'.$Ddl ;
        // load the file from the filesystem
        $file = new File($path);

        return $this->file($file);
    }

    public function query($qstr,$request)
    {
        return $request->query->get($qstr);
    }

    /**
     * @Route("/up", name="api_upload", methods={"POST","HEAD","GET"})
     * @param Request $request
     *
     *
     */
    public function uploadfile(Request $request)
    {
        $file = $request->files->get('File');
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
         try {
                    $file->move(
                              'Gcode_directory',
                              $newFilename
                        );
                    } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                    }
        $response = new Response();
        $response->setContent(json_encode(['filename' => $newFilename]));

          return $response;

    }

    /**
     * @Route("/Print", name="api_print", methods={"POST","HEAD","GET"})
     * @param Request $request
     *
     * @return JsonResponse
     * @throws \Exception
     */
        public function insertNewPrint(Request $request)
        {
            $entityManager = $this->getDoctrine()->getManager();
            //looking if there is already a print at this time
            $Heure = $this->query('Heure',$request);
            $DateBrut = $this->query('Date',$request);
            preg_match('/[0-9]{4}(-[0-9]{2}){2}/', $DateBrut, $Datereg);
            $Date = new DateTime($Datereg[0]);
            $Calendrier =  $entityManager->getRepository('App:Calendrier')->findOneBy(array('Date'=>$Date));

            $Data2 = $this->getDoctrine()
                ->getRepository(Impression3D::class)
                ->findAllHeure($Calendrier,$Heure);

            if($Data2 != []) {
                $response = JsonResponse::fromJsonString('{ "code": 403 }');
                return $response;
            }
            else
            {
                $Noma= $this->query('Noma',$request);
                if((bool)$entityManager->getRepository('App:Utilisateur')->findOneBy(array('id'=>$Noma))){
                    $impression3d = new Impression3D();

                    $Utilisateur =  $entityManager->getRepository('App:Utilisateur')->findOneBy(array('id'=>$Noma));
                    $impression3d->setUtilisateur($Utilisateur);

                    //Date id
                    $impression3d->setCalendrier($Calendrier);

                    $Nom = $this->query('Nom',$request);
                    $impression3d->setNom($Nom);

                    $Temps = $this->query('Temps',$request);
                    $impression3d->setTemps((int)$Temps);

                    $Matiere = $this->query('Matiere',$request);
                    $impression3d->setMatiere($Matiere);

                    $Prix = $this->query('Prix',$request);
                    $impression3d->setPrix($Prix);

                    $impression3d->setHeure($Heure);

                    $Printfile = $this->query('Printfile',$request);
                    $impression3d->setPrintFilename($Printfile);

                    $entityManager->persist($impression3d);
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


}

