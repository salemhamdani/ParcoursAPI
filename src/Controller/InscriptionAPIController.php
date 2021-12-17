<?php

namespace App\Controller;

use App\Entity\Lead;
use App\Form\InscriptionConcoType;
use App\Service\LeadFormHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionAPIController extends AbstractController
{
    /**
     * @Route("/inscription/{num}", name="inscription_1")
     */
    public function LeadPersist(EntityManagerInterface $manager, LeadFormHelper $leadFormHelper,$num,Request $request): Response
    {
        $json=file_get_contents(__DIR__ . '/json/test.json');
        $data = json_decode($json, true);
        $lead= new Lead();
        $form = $this->createForm(InscriptionConcoType::class, $lead, array('csrf_protection' => false));
        if (isset($data['datetest'])&&$data['datetest']!=="")
        {
            $lead->setDatetest( new \DateTime($data['datetest']));
            unset($data['datetest']);
        }
        if (isset($data['date_reunion'])&&$data['date_reunion']!=="")
        {
            $lead->setDatetest( new \DateTime($data['date_reunion']));
            unset($data['date_reunion']);
        }
        $form->submit($data);
        if($form->isValid())
        {
            $reponselog['API']="Lead";
            $reponselog['Errors']='noo';
            $manager->persist($lead);
            $manager->flush();
            $res="true";
        }
        else
        {
            $reponselog=[];
            $reponselog['API']="Lead";
            $reponselog['Errors']=$leadFormHelper->getErrors($form);
            $leadFormHelper->logapi($reponselog);
            $res="false";
        }
            return $this->render('inscription_api/index.html.twig', [
            'controller_name' => $res
        ]);
    }
}
