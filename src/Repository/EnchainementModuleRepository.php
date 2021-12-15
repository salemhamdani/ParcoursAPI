<?php

namespace App\Repository;

/**
 * EnchainementModuleRepository
 */
class EnchainementModuleRepository extends \Doctrine\ORM\EntityRepository
{
    public function getMaxOrdrePlusUn()
    {
        // Création du QueryBuilder :
        $queryBuilder = $this->createQueryBuilder('f');
        $queryBuilder->select($queryBuilder->expr()->max('f.ordre'));
        return (int)$queryBuilder->getQuery()->getScalarResult()[0][1] + 1;
    }
    
    public function getAllModuleByParcours($parcours_id,$type){
        
        $enchainementModule = $this->createQueryBuilder('EnchainementModule')
                        ->innerJoin('EnchainementModule.enchainement', 'enchainement')
                        ->innerJoin('EnchainementModule.module', 'module')
                        ->innerJoin('enchainement.parcours', 'parcours')
                        ->where('enchainement.type = :TYPE')
                        ->andWhere('parcours.id = :PARCOURS')
                        ->orderBy('EnchainementModule.ordre', 'DESC')
                        ->setParameter('PARCOURS', $parcours_id)
                        ->setParameter('TYPE', $type)
                        ->getQuery()->getResult();
        
        return $enchainementModule;
                        
    }
}
