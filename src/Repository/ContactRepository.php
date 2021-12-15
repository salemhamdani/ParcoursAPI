<?php

namespace App\Repository;

/**
 * ContactRepository
 */
class ContactRepository extends \Doctrine\ORM\EntityRepository
{

	
    function getByEntreprises($entreprise){
 
             $query = $this->createQueryBuilder('c');
        $query = $this->createQueryBuilder('a')
                      ->select('a')
                      ->leftJoin('a.entreprises', 'c')
                      ->addSelect('c')
                      ->add('where', $query->expr()->in('c', ':c'))
                      ->setParameter('c', $entreprise)
                      ->getQuery()
                      ->getResult();
         
        return $query;
 
    }

}
