<?php

namespace App\Repository;

/**
 * BlocRepository
 */
class BlocRepository extends \Doctrine\ORM\EntityRepository
{

    public function getMaxOrdrePlusUn()
    {
        // Création du QueryBuilder :
        $queryBuilder = $this->createQueryBuilder('f');
        $queryBuilder->select($queryBuilder->expr()->max('f.ordre'));
        return (int)$queryBuilder->getQuery()->getScalarResult()[0][1] + 1;
    }

  public function getFils($blocpere){

    $qb = $this->createQueryBuilder('bloc');
    $qb->where('bloc.id = :BLOCPERE')
        ->setParameter('BLOCPERE', $blocpere->getId())
        ->orderBy('bloc.id', 'DESC');

    return $qb->getQuery()->getResult();

    }


}
