<?php

namespace App\Controller;

use App\Entity\Lead;
use App\Form\InscriptionConcoType;
use App\Form\InscriptionRecontacteType;
use App\Form\InscriptionReunionType;
use App\Service\LeadFormHelper;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
class InscriptionAPIController extends AbstractController
{
    /**
     * @OA\Tag(name="Lead")
     * @OA\RequestBody(
     *       required=true,
     *     @OA\JsonContent
     *       (
     *               @OA\Property(
     *                   property="civilite",
     *                   description="donner ",
     *                   type="string",
     *                   example="oui"
     *               ),
     *               @OA\Property(
     *                   property="prenom",
     *                   description="donner le prenom",
     *                   type="string",
     *                   example="salem"
     *               ),
     *      @OA\Property(
     *                   property="nom",
     *                   description="donner votre nom",
     *                   type="string",
     *                   example="hamdani"
     *               ),
     *      @OA\Property(
     *                   property="email",
     *                   description="donner votre email",
     *                   type="string",
     *                   example="salem@gmail.com"
     *               ),
     *      @OA\Property(
     *                   property="telephone",
     *                   description="donner votre numero tel",
     *                   type="string",
     *                   example="54885411"
     *               ),
     *      @OA\Property(
     *                   property="formation",
     *                   description="donner le nom de formation",
     *                   type="string",
     *                   example="symfony"
     *               ),
     *      @OA\Property(
     *                   property="datetest",
     *                   description="donner la date de test",
     *                   type="string",
     *                   example="2021-02-01"
     *               ),
     *     @OA\Property(
     *                   property="campus",
     *                   description="donner le nom de campus",
     *                   type="string",
     *                   example="manar"
     *               )
     *           )
     *
     *   ),
     * @OA\Response (
     *     response=201,
     *     description=" PERSISTED <br/>
        Num Inscription options : <br/>
    1 = Formulaire d'inscription au concours. <br/>
    2 = Formulaire d'inscription etre recontacte. <br/>
    3 =  Formulaire d'inscription en reunion.
    ",
     * )
     *  @OA\Response(
     *     response="300",
     *       description="FORMTYPE IS INVALID",
     * )
     * @OA\Response(
     *     response="400",
     *       description="BAD REQUEST",
     * )
     * @OA\Response(
     *   response="401",
     *       description="Unauthorized"
     * )
     *
     * @Security(name="Bearer")
     * @Route("api/inscription/{num}",requirements={"num"="[1-3]"}, methods={"POST"}, name="inscription_Gestiform")
     */
    public function LeadPersist(EntityManagerInterface $manager, LeadFormHelper $leadFormHelper,$num,Request $request)
    {
        $json=$request->getContent();
        $data = json_decode($json, true);
        $lead= new Lead();
        switch($num)
        {
            case 1:
                $form = $this->createForm(InscriptionConcoType::class, $lead, array('csrf_protection' => false));
                break;
            case 2:
                //formType 2
                $form = $this->createForm(InscriptionRecontacteType::class, $lead, array('csrf_protection' => false));
                break;
            case 3 :
                //formType 3
                $form = $this->createForm(InscriptionReunionType::class, $lead, array('csrf_protection' => false));
                break;
            default:
                return new jsonResponse("the number given in URL is not valid ");
        }
        //$form = $this->createForm(InscriptionConcoType::class, $lead, array('csrf_protection' => false));
        if (isset($data['datetest'])&&$data['datetest']!=="")
        {
            $lead->setDatetest( new \DateTime($data['datetest']));
            unset($data['datetest']);
        }
        if (isset($data['datereunion'])&&$data['datereunion']!=="")
        {
            $lead->setDatereunion( new \DateTime($data['datereunion']));
            unset($data['datereunion']);
        }
        $form->submit($data);
        if($form->isValid())
        {
            $reponselog['API']="Lead";
            $reponselog['Errors']='no';
            $manager->persist($lead);
            $manager->flush();
            $res="request is persisted";
            return new jsonResponse($res,Response::HTTP_CREATED) ;
        }
        else
        {
            $reponselog=[];
            $reponselog['API']="Lead";
            $reponselog['Errors']=$leadFormHelper->getErrors($form);
            $leadFormHelper->logapi($reponselog);
            $res=$leadFormHelper->getErrors($form);
            return new jsonResponse($res,Response::HTTP_MULTIPLE_CHOICES) ;
        }

    }
}
