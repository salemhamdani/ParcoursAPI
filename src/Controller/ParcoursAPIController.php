<?php

namespace App\Controller;

use App\Entity\Parcours;
use App\Service\ParcoursAPIHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParcoursAPIController extends AbstractController
{
    /**
     * @Route("/parcours/details/{id}", name="parcours_details")
     */
    public function parcoursDetails(EntityManagerInterface $manager, $id,ParcoursAPIHelper $parcoursAPIHelper):Response
    {
            $parcours=$manager->getRepository(Parcours::class)->find($id);
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->setContent($this->json($parcoursAPIHelper->getParcoursInfo($parcours)));
            return $response;

    }
    /**
     * @Route("/parcours/all", name="parcours_all")
     */
    public function allParcours(ParcoursAPIHelper $parcoursAPIHelper,EntityManagerInterface $manager):Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setContent($this->json($parcoursAPIHelper->getAllParcours($manager)));
        return $response;
    }
}
