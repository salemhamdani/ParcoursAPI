<?php

namespace App\Repository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use NoyauBundle\Entity\SessionAccompagnement;
/**
 * SessionAccompagnementRepository
 */
class SessionAccompagnementRepository extends \Doctrine\ORM\EntityRepository
{

	// utilisation dans le service DorancoCalendrier pour connaitre les périodes en stage
	public function getBySession($session)
	{
		
		$resultat=array();

		$sql = "
			select DATE_FORMAT(session_accompagnement.datedebut,'%d/%m/%Y') datedebut,
				DATE_FORMAT(session_accompagnement.datefin,'%d/%m/%Y') datefin,
				session_accompagnement.duree duree
			from session_accompagnement
				inner join session_accompagnement_session on session_accompagnement_session.sessionaccompagnement_id=session_accompagnement.id
			where session_accompagnement_session.session_id=".$session->getId()." 
			order by session_accompagnement.datedebut";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}
	
	public function getAllAccompagnementsPossibles($session)
	{

		$resultat=array();

		$datedebut=$session->getDatedebut();
		$datefin=$session->getDatefin();

		$sql = "
			select distinct session_accompagnement.id						id,
				DATE_FORMAT(session_accompagnement.datedebut,'%d/%m/%Y') 	datedebut,
				DATE_FORMAT(session_accompagnement.datefin,'%d/%m/%Y') 		datefin,
				masterlistelgs.designation									typeaccompagnement
			from session_accompagnement
				inner join masterlistelgs on masterlistelgs.id=session_accompagnement.typeaccompagnement_id
			where datedebut between STR_TO_DATE('".$session->getDatedebut()->format('Y-m-d')."','%Y-%m-%d') 
				and STR_TO_DATE('".$session->getDatefin()->format('Y-m-d')."','%Y-%m-%d')
				and session_accompagnement.id not in(select sessionaccompagnement_id from session_accompagnement_session
				where session_id=".$session->getId().")"
			;

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;

	}

public function trouverSession($debut,$fin,$typeaccompagnement)
	{
	$sql = "select session_accompagnement.*
				from evenements
					inner join session_evenements on session_evenements.id=evenements.id
					inner join session_accompagnement on session_accompagnement.sessionevenement_id=session_evenements.id
					inner join masterlistelgs on masterlistelgs.id=session_accompagnement.typeaccompagnement_id
					where session_accompagnement.datedebut between '".$debut->format('Y-m-d')."' and '".$fin->format('Y-m-d')."'  and masterlistelgs.id=".$typeaccompagnement->getId()."
				order by session_accompagnement.datedebut ";

		$rsmb = new ResultSetMappingBuilder($this->_em);
		$rsmb->addRootEntityFromClassMetadata(SessionAccompagnement::class,'u');
		$resultat = $this->_em->createNativeQuery($sql, $rsmb)->getResult();
		return $resultat;
	}

}
