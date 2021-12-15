<?php

namespace App\Repository;

/**
 * NiveauRepository
 */
class NiveauRepository extends \NoyauBundle\Repository\ExtendsDoctrineRepository
{


	public function getByParcours($niveauxByParcours){

		$qb = $this
			->createQueryBuilder()
                            ->select('niveau')
                            ->from('NoyauBundle:Niveau', 'niveau')
                            ->where('niveau.archive = :ARCHIVE')
                            ->andWhere('niveau.id IN (:NIVEAU_BY_PARCOURS)')
                            ->setParameter('ARCHIVE', false)
                            ->setParameter('NIVEAU_BY_PARCOURS', $niveauxByParcours)
                            ->orderBy('niveau.id', 'ASC');
		return $qb->getQuery()->getResult();
	}




       



}
