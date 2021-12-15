<?php

namespace App\Repository;

/**
 * EntrepriseRepository
 */
class EntrepriseRepository extends GlobalRepository
{
	
	public function getListeForStages()
	{
		$resultat=[];
		$sql="select
				ent.id							entreprise_id,
				ent.raisonSocial,
				tuteurs.id						tuteur_id,
				personal_informations.nom		nom,
				personal_informations.prenom	prenom
			from entreprises ent
				left outer join tuteurs on ent.id=tuteurs.entreprise_id
				left outer join personal_informations on personal_informations.id=tuteurs.personalinformations_id
			";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

		public function getLikeIntitule($intitule){

		$qb = $this
			->createQueryBuilder('e')
   			->where('e.raisonSocial LIKE :intitule')
        	->setMaxResults(6)
            ->setParameters(array(':intitule'=> '%'.$intitule.'%'));
		return $qb->getQuery()->getResult();
	}

		 public function findOneByContact($contact)
		    {
				$qb = $this
					->createQueryBuilder('entreprise')
					    ->innerJoin("entreprise.contacts", "c")
					    ->where("c.principal = true")
					    ->Andwhere("c.id =:CONTACT")
					->setParameter('CONTACT', $contact)
		             ->setMaxResults(1);
				return $qb->getQuery()->getOneOrNullResult();


		    }

        


}
