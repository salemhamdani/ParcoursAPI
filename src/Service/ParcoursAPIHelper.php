<?php

namespace App\Service;


use App\Entity\Parcours;

class ParcoursAPIHelper
{
    public function ParcoursInfo(Parcours $parcours)
    {
    $sessions =$parcours->getSessions();
    $codesRomes=$parcours->getCodesromes();
    $codesRomesArray=array();
    foreach ($codesRomes as $codesrome)
    {
        array_push($codesRomesArray,$codesrome->getCode());
    }
    $formatCodes=$parcours->getFormacodes();
    $formatCodesArray=array();
        foreach ($formatCodes as $formatCode) {
            array_push($formatCodesArray,$formatCode->getCode());
    }
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
    //array_push($blocsArray,['key'=>'value']);
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
            'Formacodes'=>$formatCodesArray,
            'CodesROME'=>$codesRomesArray,
            'CodeNSF'=>$parcours->getCodensf(),
            'CodeRNCP'=>$parcours->getCoderncp(),
        ]



    ];
    return $body;


    }

}