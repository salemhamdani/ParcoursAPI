<?php

namespace App\Repository;

use Doctrine\ORM\Query\ResultSetMappingBuilder;
use NoyauBundle\Entity\Salle;
use NoyauBundle\Entity\Session;
/**
 * SalleRepository
 */
class SalleRepository extends \Doctrine\ORM\EntityRepository
{

	public function findPrecedent($item){$qb = $this->createQueryBuilder('m')->where('m.id < :itemid')->setParameters(array(':itemid'=> $item->getId()))->orderBy('m.id', 'DESC')->setMaxResults(1);$resultat=$qb->getQuery()->getOneOrNullResult();if(is_null($resultat)){return $item;}else{return $resultat;}}
	public function findSuivant($item){$qb = $this->createQueryBuilder('m')->where('m.id > :itemid')->setParameters(array(':itemid'=> $item->getId()))->orderBy('m.id', 'ASC')->setMaxResults(1);$resultat=$qb->getQuery()->getOneOrNullResult();if(is_null($resultat)){return $item;}else{return $resultat;}}

	public function getSallesLibres($datedebut,$datefin)
	{
		$resultat=array();

		$sql = "
			select id from salles
			where id not in(
				select sessions_salles.salle_id
				from evenements event
					inner join sessions_salles on sessions_salles.sessionevenement_id=event.id
				where (
						(event.datedebut between STR_TO_DATE('".$datedebut->format('Y-m-d')."','%Y-%m-%d') and STR_TO_DATE('".$datefin->format('Y-m-d')."','%Y-%m-%d'))
						or (event.datefin between STR_TO_DATE('".$datedebut->format('Y-m-d')."','%Y-%m-%d') and STR_TO_DATE('".$datefin->format('Y-m-d')."','%Y-%m-%d'))
						or (event.datedebut <= STR_TO_DATE('".$datedebut->format('Y-m-d')."','%Y-%m-%d') and event.datefin>=STR_TO_DATE('".$datefin->format('Y-m-d')."','%Y-%m-%d'))
					)
					and event.jourentier=true
				)
		";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();
		return $resultat;
	}


	public function getSallesLibresByPere($datedebut,$datefin)
	{
		$resultat=array();
		//if($datedebut->format('Y-m-d') == $datefin->format('Y-m-d'))
		//$datefin->modify('+1 day');
		$sql = "
			select id from salles where id not
 in( select salles.id from salles salles inner join
  sessions_salles on sessions_salles.salle_id=salles.id inner
   join evenements evenements_pere on sessions_salles.sessionevenement_id=evenements_pere.id
    where ( ( 

    	(  STR_TO_DATE(evenements_pere.datedebut,'%Y-%m-%d') <= STR_TO_DATE('".$datedebut->format('Y-m-d')."','%Y-%m-%d') and 
     	 STR_TO_DATE(evenements_pere.datefin,'%Y-%m-%d') >= STR_TO_DATE('".$datedebut->format('Y-m-d')."','%Y-%m-%d')  )
     or 

    (  STR_TO_DATE(evenements_pere.datedebut,'%Y-%m-%d') <= STR_TO_DATE('".$datefin->format('Y-m-d')."','%Y-%m-%d') and 
     	evenements_pere.datefin >= STR_TO_DATE('".$datefin->format('Y-m-d')."','%Y-%m-%d')  )


     or 
     ( STR_TO_DATE(evenements_pere.datedebut,'%Y-%m-%d') >= STR_TO_DATE('".$datedebut->format('Y-m-d')."','%Y-%m-%d') and 
     	 STR_TO_DATE(evenements_pere.datefin,'%Y-%m-%d') <=STR_TO_DATE('".$datefin->format('Y-m-d')."','%Y-%m-%d') ) ) 
	and evenements_pere.jourentier=true ) group by salles.id )
		";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();
		return $resultat;
	}


	public function getSallesFusionnables($sessionevenement)
	{
		$resultat=array();
		if(count($sessionevenement->getSessionsalles())==0){
			return $resultat;
		}
		
		$potentielles=$sessionevenement->getIdSallesFusionnables();
		$salleslibres=$this->getSallesLibres($sessionevenement->getDatedebut(),$sessionevenement->getDatefin());
		foreach($potentielles as $idligne){
			foreach($salleslibres as $sallelibre){
				if($idligne==$sallelibre['id']){
					$resultat[]=$idligne;
				}
			}
		}

		return $resultat;
	}
	
	public function getNbSallesOccupeesOnDateComplete($date)
	{
		$resultat=array();
		$sql = "
			select count(*) combien
			from evenements
				inner join sessions_salles on sessions_salles.sessionevenement_id=evenements.id
			where evenements.jourentier=true
				and date(evenements.datedebut)=STR_TO_DATE('".$date->format('Y-m-d')."','%Y-%m-%d')
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat[0]['combien'];
	}

	public function getNbSallesTotales()
	{
		$resultat=array();
		$sql = "
			select count(*) combien
			from salles
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat[0]['combien'];
	}
/*
	public function getAllDatesSalleLibreForYear($salle,$annee)
	{

		$sql="
			select jours.jour jour,
				(case when ev.datedebut is null then 0 else 1 end) pris
			from
				(SELECT DATE_ADD(STR_TO_DATE('".$annee."-01-01','%Y-%m-%d'), INTERVAL (@row_number:=@row_number + 1) DAY) jour
					FROM
						masterlistelgs,(SELECT @row_number:=-1) AS t
					LIMIT 365) as jours
				left outer join
				(select date(evenements.datedebut) datedebut from sessions_salles
						inner join session_evenements on sessions_salles.sessionevenement_id=session_evenements.id
						inner join evenements on session_evenements.id=evenements.id
					where sessions_salles.salle_id=".$salle->getId()."
				) as ev on jours.jour=ev.datedebut
		";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}
*/

	public function getAllDatesLibresForYear($annee,$jourentier)
	{

		$sql="
			select *,
				(select count(*)
					from sessions_salles
						inner join session_evenements on sessions_salles.sessionevenement_id=session_evenements.id
						inner join evenements ev1 on session_evenements.id=ev1.id
						inner join evenements ev2 on ev2.pere_id=ev1.id
					where date(ev2.datedebut)=jours.jour
						and ev1.jourentier=".$jourentier."
				) pris
			from
				(SELECT DATE_ADD(STR_TO_DATE('".$annee."-01-01','%Y-%m-%d'), INTERVAL (@row_number:=@row_number + 1) DAY) jour
					FROM
						masterlistelgs,(SELECT @row_number:=-1) AS t
					LIMIT 365) as jours
		";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;

	}

	public function getOccupationForDay($annee, $mois, $jour,$jourentier)
	{
		$sql="
			select salles.id		salle_id,
				salles.intitule		salle_intitule,
				salles.logocouleur	salle_logocouleur,
				ss.salle_id			salle_occupee,
				sites.id			site_id,
				sites.intitule		site_intitule,
				ss.*
			from salles
				inner join sites on sites.id=salles.site_id
				left outer join (
					select salle_id,
						session_module.intitule smodule_intitule,
						module.id module_id,
						module.code module_code,
						module.intitule module_intitule,
						date_format(ev2.heuredebut1,'%H:%i') heuredebut1,
						date_format(ev2.heurefin1,'%H:%i') heurefin1,
						date_format(ev2.heuredebut2,'%H:%i') heuredebut2,
						date_format(ev2.heurefin2,'%H:%i') heurefin2
					from sessions_salles
						inner join session_evenements on sessions_salles.sessionevenement_id=session_evenements.id
						inner join evenements ev1 on session_evenements.id=ev1.id
						inner join evenements ev2 on ev2.pere_id=ev1.id
						left outer join session_module on session_module.id=session_evenements.sessionmodule_id
						left outer join module on module.id=session_module.module_id
					where date(ev2.datedebut)=STR_TO_DATE('".$annee."-".$mois."-".$jour."','%Y-%m-%d')
						and ev1.jourentier=".$jourentier."
				) ss on ss.salle_id=salles.id
						
			order by site_id,
				ss.salle_id
		";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;

	}

}
