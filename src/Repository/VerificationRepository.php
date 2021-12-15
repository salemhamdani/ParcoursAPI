<?php

namespace App\Repository;

/**
 * VerificationRepository
 */
class VerificationRepository extends \Doctrine\ORM\EntityRepository
{
	
	public function getListeAVerifier($entitesource)
	{
		
		// modules
		if($entitesource=='module')
		{
			$resultat=[];
			$sql="
				select v1.id								verification_id,
					v1.itsok,
					v1.remarques,
					DATE_FORMAT(v1.dateinsert, '%d/%m/%Y')	dateinsert,
					empinsert.id							empinsert_id,
					piinsert.prenom,
					piinsert.nom,
					module.id								entite_id,
					module.code								entite_code,
					module.intitule							entite_intitule
				from verifications v1
					inner join module on module.id=v1.idsource
					left outer join employes empinsert on empinsert.id=v1.quiinsert_id
					left outer join personal_informations piinsert on piinsert.id=empinsert.id
				where v1.entitesource='".$entitesource."'
					and v1.id=(select max(id) from verifications v2 where v2.idsource=v1.idsource and v2.entitesource='".$entitesource."')
					and (YEAR(now()) - YEAR(v1.dateinsert) - (DATE_FORMAT(now(), '%m%d') < DATE_FORMAT(v1.dateinsert, '%m%d')))>0
				union
				select null,
					null,
					null,
					null,
					null,
					null,
					null,
					module.id,
					module.code,
					module.intitule
				from module
				where module.id not in (select idsource from verifications where entitesource='".$entitesource."')
			";

			$conn = $this->_em->getConnection();
			$statement = $conn->executeQuery($sql);
			$resultat = $statement->fetchAll();
		}

		// parcours
		if($entitesource=='parcours')
		{
			$resultat=[];
			$sql="
				select v1.id								verification_id,
					v1.itsok,
					v1.remarques,
					DATE_FORMAT(v1.dateinsert, '%d/%m/%Y')	dateinsert,
					empinsert.id							empinsert_id,
					piinsert.prenom,
					piinsert.nom,
					parcours.id								entite_id,
					parcours.code							entite_code,
					parcours.intitule						entite_intitule
				from verifications v1
					inner join parcours on parcours.id=v1.idsource
					left outer join employes empinsert on empinsert.id=v1.quiinsert_id
					left outer join personal_informations piinsert on piinsert.id=empinsert.id
				where v1.entitesource='".$entitesource."'
					and v1.id=(select max(id) from verifications v2 where v2.idsource=v1.idsource and v2.entitesource='".$entitesource."')
					and (YEAR(now()) - YEAR(v1.dateinsert) - (DATE_FORMAT(now(), '%m%d') < DATE_FORMAT(v1.dateinsert, '%m%d')))>0
				union
				select null,
					null,
					null,
					null,
					null,
					null,
					null,
					parcours.id,
					parcours.code,
					parcours.intitule
				from parcours
				where parcours.id not in (select idsource from verifications where entitesource='".$entitesource."')
			";

			$conn = $this->_em->getConnection();
			$statement = $conn->executeQuery($sql);
			$resultat = $statement->fetchAll();
		}

		// certification
		if($entitesource=='certification')
		{
			$resultat=[];
			$sql="
				select v1.id								verification_id,
					v1.itsok,
					v1.remarques,
					DATE_FORMAT(v1.dateinsert, '%d/%m/%Y')	dateinsert,
					empinsert.id							empinsert_id,
					piinsert.prenom,
					piinsert.nom,
					certification.id								entite_id,
					certification.code								entite_code,
					certification.intitule							entite_intitule
				from verifications v1
					inner join certification on certification.id=v1.idsource
					left outer join employes empinsert on empinsert.id=v1.quiinsert_id
					left outer join personal_informations piinsert on piinsert.id=empinsert.id
				where v1.entitesource='".$entitesource."'
					and v1.id=(select max(id) from verifications v2 where v2.idsource=v1.idsource and v2.entitesource='".$entitesource."')
					and (YEAR(now()) - YEAR(v1.dateinsert) - (DATE_FORMAT(now(), '%m%d') < DATE_FORMAT(v1.dateinsert, '%m%d')))>0
				union
				select null,
					null,
					null,
					null,
					null,
					null,
					null,
					certification.id,
					certification.code,
					certification.intitule
				from certification
				where certification.id not in (select idsource from verifications where entitesource='".$entitesource."')
			";

			$conn = $this->_em->getConnection();
			$statement = $conn->executeQuery($sql);
			$resultat = $statement->fetchAll();
		}

		return $resultat;
	}
}
