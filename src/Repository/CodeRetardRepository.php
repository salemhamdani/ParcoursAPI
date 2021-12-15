<?php

namespace App\Repository;

/**
 * CodeRetardRepository
 */
class CodeRetardRepository extends \Doctrine\ORM\EntityRepository
{

	public function getByDossier($dossier)
	{
		$resultat=array();
		$sql = "
			select CodeRetards.*,
				financeurs.intitule financeur_intitule
			from CodeRetards
				inner join financeurs on financeurs.id=CodeRetards.financeur_id
				inner join financements on financements.financeur_id=CodeRetards.financeur_id
			where dossier_id=".$dossier->getId()."
			order by financeurs.id,
				CodeRetards.id
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();
		
		return $resultat;
	}

}
