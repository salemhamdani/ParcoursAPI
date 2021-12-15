<?php

namespace App\Repository;

/**
 * SessionStageRepository
 */
class SessionStageRepository extends \Doctrine\ORM\EntityRepository
{
	// utilisation dans le service DorancoCalendrier pour connaitre les périodes en stage
	public function getBySession($session)
	{
		
		$resultat=array();

		$sql = "
			select DATE_FORMAT(session_stage.datedebut,'%d/%m/%Y') datedebut,
				DATE_FORMAT(session_stage.datefin,'%d/%m/%Y') datefin,
				duree
			from session_stage
			where session_id=".$session->getId()." 
			order by datedebut";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}



}
