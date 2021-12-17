<?php


namespace App\Service;

use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Forms;
use App\Entity\Lead;
use App\Entity\Parcours;
use App\Form\InscriptionConcoType;
use Doctrine\ORM\EntityManagerInterface;
class LeadFormHelper
{
    public function handleSubmitForm(int $num,EntityManagerInterface $manager,FormBuilder $formBuilder)
    {

        $json=file_get_contents(__DIR__ . '/json/test.json');
        //$data=$parsed_json->data;
        $data = json_decode($json, true);
        $lead= new Lead();
        switch($num)
        {
            case 1:
                //$form = createForm(InscriptionConcoType::class, $lead, array('csrf_protection' => false));
                break;
            case 2:
                //formType 2
                //$form = $this->createForm(InscriptionConcoType::class, $lead, array('csrf_protection' => false));
                break;
            case 3 :
                //formType 3
              //  $form = $this->createForm(InscriptionConcoType::class, $lead, array('csrf_protection' => false));
                break;
        }
     /*

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
        }
        else
        {
            $reponselog=[];
            $reponselog['API']="Lead";
            $reponselog['Errors']=$errorLoggerAPI->getErrors($form);
            $errorLoggerAPI->logapi($reponselog);
        }*/
    }
    public function getErrors($form)
    {
        $errors ="";
        foreach ($form->getErrors(true) as $error) {
            $errors .= $error->getMessage();
        }
        return $errors;
    }
    public function logapi($body)
    {

        $file =fopen(__DIR__ ."/log/log_api_inscription.txt", "a");
        fwrite($file, "\n".implode(",",$body));
    }

}