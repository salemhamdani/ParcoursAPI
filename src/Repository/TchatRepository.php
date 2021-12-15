<?php

namespace App\Repository;

/**
 * TchatRepository
 */
class TchatRepository extends \Doctrine\ORM\EntityRepository
{
	
	public function getAllLasts($combien)
	{

		$resultat=[];
		$sql="
			select personnes.id									id,
				tchatlignes.texte								texte,
				tchatlignes.dateinsert							dateinsert,
				DATE_FORMAT(curdate(),'%d/%m/%Y')				curdate,
				DATE_FORMAT(tchatlignes.dateinsert,'%d/%m/%Y')	datetot,
				DATE_FORMAT(tchatlignes.dateinsert,'%Y')		annee,
				DATE_FORMAT(tchatlignes.dateinsert,'%m')		mois,
				DATE_FORMAT(tchatlignes.dateinsert,'%d')		jour,
				DATE_FORMAT(tchatlignes.dateinsert,'%H')		heure,
				DATE_FORMAT(tchatlignes.dateinsert,'%i')		minute,
				personal_informations.prenom					prenom,
				personal_informations.nom						nom,
				uploads.directory_upload						directory_upload,
				uploads.link									link,
				tchat.entiteorigine								entiteorigine,
				tchat.idorigine									idorigine,
				infosapprenant.prenom							prenom,
				infosapprenant.nom								nom,
				tchatlignes.id									tchatligne_id
			from tchat
				inner join tchatlignes on tchatlignes.tchat_id=tchat.id
				inner join employes on tchatlignes.quiinsert_id=employes.id
				inner join personal_informations on personal_informations.id=employes.personalinformations_id
				left outer join uploads on uploads.id=personal_informations.photo_id
				inner join personnes on personnes.id=tchat.idorigine
				inner join personal_informations infosapprenant on infosapprenant.id=personnes.personalinformations_id
			where tchat.entiteorigine='Personne'
			order by tchatlignes.dateinsert desc
			limit ".$combien;

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

}
