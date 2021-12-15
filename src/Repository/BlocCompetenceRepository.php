<?php

namespace App\Repository;

/**
 * BlocCompetenceRepository
 */
class BlocCompetenceRepository extends \Doctrine\ORM\EntityRepository
{


    public function getMaxOrdrePlusUn()
    {
        // Création du QueryBuilder :
        $queryBuilder = $this->createQueryBuilder('f');
        $queryBuilder->select($queryBuilder->expr()->max('f.ordre'));
        return (int)$queryBuilder->getQuery()->getScalarResult()[0][1] + 1;
    }
    
    
}
