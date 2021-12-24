<?php

namespace App\Service;


use App\Entity\Masterlistelg;
use App\Entity\Parcours;
use Doctrine\ORM\EntityManagerInterface;

class ParcoursAPIHelper
{
    public function generateCodesRomes(Parcours $parcours)
    {
        $codesRomes=$parcours->getCodesromes();
        $codesRomesArray=array();
        foreach ($codesRomes as $codesrome)
        {
            array_push($codesRomesArray,$codesrome->getCode());
        }
        return $codesRomesArray;
    }
    public function generateFormatCodes(Parcours $parcours)
    {
        $formatCodes=$parcours->getFormacodes();
        $formatCodesArray=array();
        foreach ($formatCodes as $formatCode) {
            array_push($formatCodesArray,$formatCode->getCode());
        }
        return $formatCodesArray;
    }
    public function getParcoursInfo(Parcours $parcours)
    {
    $blocs=$parcours->getBlocs();
    $blocsArray=array();
    foreach ($blocs as $bloc)
    {
      $blocArray=array();
      $blocmodules=$bloc->getBlocmodules();
      $modulesArray=array();
      foreach ($blocmodules as $blocmodule)
      {
          array_push($modulesArray,$blocmodule->getModule()->getIntitule());
      }
      array_push($blocsArray,[
            'Intitule'=>$bloc->getIntitule(),
            'modules'=>$modulesArray,
      ]);
    }
    $body=[
        'BLOC_PRINCIPAL'=>
            [
                'Intitule'=>$parcours->getIntitule(),
                'LeMetier'=>$parcours->getMetier(),
                'Objectifs'=>$parcours->getObjectif(),
                'LesPlus'=>$parcours->getPlus(),
                'Prerequis'=>$parcours->getPrerequis(),
                'ConditionsDAdmission'=>$parcours->getConditionadmission(),
            ] ,
        'PROGRAMME'=>
            [
            'blocs'=>$blocsArray,
            'debouches'=>$parcours->getDebouche()
            ],
        'BLOC_DROITE'=>
        [
            'Public'=>$parcours->getPublic(),
            'SanctionsEnResume'=>$parcours->getSanctionresume(),
            'ModeDeFormation'=>$parcours->getModeFormation()->getIntitule(),
            'Rythme'=>$parcours->getRythme(),
            'FraisPedagogique'=>$parcours->getFraispedagogique(),

        ] ,
        'BAS_DE_PAGE'=>
        [
            'SanctionsDetaillees'=>$parcours->getSanctionlong(),
            'Formacodes'=>$this->generateFormatCodes($parcours),
            'CodesROME'=>$this->generateCodesRomes($parcours),
            'CodeNSF'=>$parcours->getCodensf(),
            'CodeRNCP'=>$parcours->getCoderncp(),
        ]



    ];
    return $body;
    }
     public function getAllParcours(EntityManagerInterface $manager,$code)
    {
        $typeformation=$manager->getRepository(Masterlistelg::class)->getOneByListeCode('FORMATIONS','TYPEFORMATION',$code);
        $allparcours=array();
        if(! is_null($typeformation))
        {
            $allparcours=$manager->getRepository(Parcours::class)->findByTypeformation($typeformation);
        }
        else
        {
            if($code=='ALL')
            {
                $allparcours=$manager->getRepository(Parcours::class)->findAll();
            }

        }
        $parcoursAllArray=array();
        foreach ($allparcours as $parcours)
        {
            array_push($parcoursAllArray, [
                'BLOC_PRINCIPAL'=>
                    [
                        'Id'=>$parcours->getId(),
                        'Intitule'=>$parcours->getIntitule(),
                        'LeMetier'=>$parcours->getMetier(),
                        'Objectifs'=>$parcours->getObjectif(),
                        'LesPlus'=>$parcours->getPlus(),
                        'Prerequis'=>$parcours->getPrerequis(),
                        'ConditionsDAdmission'=>$parcours->getConditionadmission(),
                    ],
                'BAS_DE_PAGE'=>
                    [
                        'SanctionsDetaillees'=>$parcours->getSanctionlong(),
                        'Formacodes'=>$this->generateFormatCodes($parcours),
                        'CodesROME'=>$this->generateCodesRomes($parcours),
                        'CodeNSF'=>$parcours->getCodensf(),
                        'CodeRNCP'=>$parcours->getCoderncp(),
                    ]
            ]);
        }
        $body=[
            'allParcours'=>$parcoursAllArray
        ];
        return $body;
    }
}