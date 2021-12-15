<?php

namespace App\Repository;

/**
 * StatisticRepository
 */
class StatisticRepository extends \Doctrine\ORM\EntityRepository
{

		  public function findByArchive($etat)
    {
        return $this->findBy(array('archive' => $etat),array('title' => 'ASC'));

    }
        public function getRang()
    {
        $queryBuilder = $this->createQueryBuilder('f');
        $queryBuilder->select($queryBuilder->expr()->max('f.rang'));
        return (int)$queryBuilder->getQuery()->getScalarResult()[0][1] + 1;
    }
}
