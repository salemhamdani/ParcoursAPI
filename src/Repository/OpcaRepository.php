<?php

namespace App\Repository;

/**
 * OpcaRepository
 */
class OpcaRepository extends \Doctrine\ORM\EntityRepository
{

    public function getOpcaOrderByIntitule($archive){
        
        
        $qb = $this->createQueryBuilder('o');
        $qb->where($qb->expr()->eq('o.archive', '?1'))   
           ->orderBy('o.intitule', 'ASC')
           ->setParameter(1, $archive);
            
        return $qb->getQuery()->getResult();
        
    }
}



