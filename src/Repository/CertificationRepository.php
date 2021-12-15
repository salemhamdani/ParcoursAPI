<?php

namespace App\Repository;

/**
 * CertificationRepository
 */
class CertificationRepository extends \Doctrine\ORM\EntityRepository
{
	
	
	public function getAllSQLNatif()
	{

		$resultat=array();
		$sql="
			select
				certification.id,
				certification.code,
				certification.intitule,
				certification.duree
			from certification
			where certification.archive=false
		";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

}
