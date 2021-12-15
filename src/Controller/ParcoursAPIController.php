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
     * @Route("/parcoursAPI/{id}", name="parcours_api")
     */
    public function index(EntityManagerInterface $manager, $id,ParcoursAPIHelper $parcoursAPIHelper):Response
    {
            $parcours=$manager->getRepository(Parcours::class)->find($id);
            $sessions=$parcours->getSessions();
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->setContent($this->json($parcoursAPIHelper->ParcoursInfo($parcours)));
            return $response;
          /*  return $this->json([
                'message' => ['Welcome to your new controller!','salem'],
                'path' => ['salem'=>['test1'=>'val1'],['test2'=>'val2']],
            ]);*/
    }
}
