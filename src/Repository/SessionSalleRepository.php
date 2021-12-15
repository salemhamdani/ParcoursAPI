<?php

namespace App\Repository;

use Doctrine\ORM\Query\ResultSetMappingBuilder;

use NoyauBundle\Entity\SessionSalle;

/**
 * SessionSalleRepository
 */
class SessionSalleRepository extends \Doctrine\ORM\EntityRepository
{
	
	public function getBySalleAndDates($salle,$debut,$fin)
	{
		$resultat=[];
		$sql="
			select distinct ssa.*
			from sessions_salles ssa
				inner join evenements ev on ev.id=ssa.sessionevenement_id
			where ssa.salle_id=".$salle->getId()."
				and date(ev.datedebut)
					between STR_TO_DATE('".$debut->format('Y-m-d')."','%Y-%m-%d')
						and STR_TO_DATE('".$fin->format('Y-m-d')."','%Y-%m-%d')
		";

		$rsmb = new ResultSetMappingBuilder($this->_em);
		$rsmb->addRootEntityFromClassMetadata(SessionSalle::class,'u');
		$resultat = $this->_em->createNativeQuery($sql, $rsmb)->getResult();

		return $resultat;
	}

	public function getVirtualSallesForEvent($event)
	{
		$resultat=[];
		$sql="
			select ssa.*
			from sessions_salles ssa
				inner join salles on salles.id=ssa.salle_id
				inner join sites on salles.site_id=sites.id
			where sites.virtuel=true
				and ssa.sessionevenement_id=".$event->getId();

		$rsmb = new ResultSetMappingBuilder($this->_em);
		$rsmb->addRootEntityFromClassMetadata(SessionSalle::class,'u');
		$resultat = $this->_em->createNativeQuery($sql, $rsmb)->getResult();

		return $resultat;
	}

	public function getBySalleAndEvenement($salle,$sessionevenement) {
			$qb = $this
			->createQueryBuilder('ss')
            ->join('ss.salle', 'salle')
            ->join('ss.sessionevenement', 'sessionevenement')
            ->addSelect('salle')
            ->where('salle.id = :salleid')
            ->AndWhere('sessionevenement.id = :sessionevenementid')
            ->setParameters(array(':salleid'=> $salle,':sessionevenementid'=>$sessionevenement));
		return $qb;

	}
}
