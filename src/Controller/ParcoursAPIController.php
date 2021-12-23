<?php

namespace App\Controller;

use App\Entity\Parcours;
use App\Service\ParcoursAPIHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
class ParcoursAPIController extends AbstractController
{
    /**
     *@OA\Tag(name="parcours")
     *
     *
     * @OA\Response(
     *     response=200,
     *     description="Returns the details of a parcours",
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
     * @Route("api/parcours/details/{id}",methods={"GET","POST"}, name="parcours_details")
     *
     *@return JsonResponse
     */

    public function parcoursDetails(EntityManagerInterface $manager, $id,ParcoursAPIHelper $parcoursAPIHelper):Response
    {
            $parcours=$manager->getRepository(Parcours::class)->find($id);
            if (!is_null($parcours))
            {
                return new JsonResponse($parcoursAPIHelper->getParcoursInfo($parcours));
            }
            else
            {
                return new JsonResponse("parcours of id given not found ");
            }


    }


    /**
     * @Route("/parcours/all", name="parcours_all")
     */
    public function allParcours(ParcoursAPIHelper $parcoursAPIHelper,EntityManagerInterface $manager):Response
    {
        return new JsonResponse($parcoursAPIHelper->getAllParcours($manager));
    }
}
