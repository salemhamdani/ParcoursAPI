<?php

namespace App\Repository;

/**
 * FinanceurRepository
 */
class FinanceurRepository extends \Doctrine\ORM\EntityRepository
{


	
	// pour formType
	public function findOPCO(){

		$qb = $this
			->createQueryBuilder('m')
            ->join('m.category', 'l')
            ->addSelect('l')
            ->where('l.code = :code')
            ->setParameters(array(':code'=>'OPCO'));
    return $qb;
	}

	public function getOPCO(){

		$qb = $this
			->createQueryBuilder('m')
            ->join('m.category', 'l')
            ->addSelect('l');
		return $qb->getQuery()->getResult();
	}


}
