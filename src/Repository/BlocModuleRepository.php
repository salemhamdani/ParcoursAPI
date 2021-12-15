<?php

namespace App\Repository;

/**
 * BlocModuleRepository
 */
class BlocModuleRepository extends \Doctrine\ORM\EntityRepository
{

    public function getMaxOrdrePlusUn()
    {
        // Création du QueryBuilder :
        $queryBuilder = $this->createQueryBuilder('f');
        $queryBuilder->select($queryBuilder->expr()->max('f.ordre'));
        return (int)$queryBuilder->getQuery()->getScalarResult()[0][1] + 1;
    }



          public function getByBloc($bloc)
    {
                $qb = $this->createQueryBuilder('blocmodule')
                    ->where('blocmodule.bloc = :bloc')
                    ->setParameter('bloc', $bloc);
        return $qb->getQuery()->getResult();


    }

    
    
}
