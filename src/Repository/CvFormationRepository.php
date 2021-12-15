<?php

namespace App\Repository;

/**
 * CvFormationRepository
 */
class CvFormationRepository extends \Doctrine\ORM\EntityRepository
{
	  public function findAll()
    {
        return $this->findBy(array(),array('title' => 'ASC'));

    }

  public function findByType()
    {
        return $this->findBy(array('type' => 1),array('rang' => 'ASC'));

    }


       public function findType(){
        $qb = $this->createQueryBuilder('u');
        $qb->select('u.type');

        return $qb->getQuery()->getResult();
    }


	  public function findOneByPath()
    {
        return $this->findOneBy(array('path' => 'path'),array('title' => 'ASC'));
    }


   


}
