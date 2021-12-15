<?php

namespace App\Repository;

/**
 * CodeAbsenceRepository
 */
class CodeAbsenceRepository extends \Doctrine\ORM\EntityRepository
{

	public function getByDossier($dossier)
	{
		$resultat=array();
		$sql = "
			select CodeAbsences.*,
				financeurs.intitule financeur_intitule
			from CodeAbsences
				inner join financeurs on financeurs.id=CodeAbsences.financeur_id
				inner join financements on financements.financeur_id=CodeAbsences.financeur_id
			where dossier_id=".$dossier->getId()."
			order by financeurs.id,
				CodeAbsences.id
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();
		
		return $resultat;
	}

}
