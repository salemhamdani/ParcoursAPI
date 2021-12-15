<?php

namespace App\Repository;

/**
 * SiteRepository
 */
class SiteRepository extends \Doctrine\ORM\EntityRepository
{
	public function findPrecedent($item){$qb = $this->createQueryBuilder('m')->where('m.id < :itemid')->setParameters(array(':itemid'=> $item->getId()))->orderBy('m.id', 'DESC')->setMaxResults(1);$resultat=$qb->getQuery()->getOneOrNullResult();if(is_null($resultat)){return $item;}else{return $resultat;}}
	public function findSuivant($item){$qb = $this->createQueryBuilder('m')->where('m.id > :itemid')->setParameters(array(':itemid'=> $item->getId()))->orderBy('m.id', 'ASC')->setMaxResults(1);$resultat=$qb->getQuery()->getOneOrNullResult();if(is_null($resultat)){return $item;}else{return $resultat;}}

	public function getNbJoursOccupesForWeek(
		$site,
		$debut
	)
	{
		$debut->modify('Monday this week');
		$fin=clone $debut;
		$fin->add(new \DateInterval('P6D'));

		$sql="
			select
				sum((DATEDIFF(evt.datefin, evt.datedebut))+1) nbjours
			from evenements evt
				inner join session_evenements sevt on sevt.id=evt.id
				inner join sessions_salles ssa on ssa.sessionevenement_id=sevt.id
				inner join salles on ssa.salle_id=salles.id
				inner join sites on sites.id=salles.site_id
			where evt.pere_id is null
				and sites.id=".$site->getId()."
				and date(evt.datedebut) between STR_TO_DATE('".$debut->format('Y-m-d')."','%Y-%m-%d') and STR_TO_DATE('".$fin->format('Y-m-d')."','%Y-%m-%d')
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

}
