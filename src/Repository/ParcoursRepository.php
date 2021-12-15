<?php

namespace App\Repository;

/**

 * ParcoursRepository
 */
class ParcoursRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * M�thode utilis�e pour chercher les parcours ayant une date de modification de plus d'un an.
     *
     * @return array
   
    public function getByParcours($niveauxByParcours){

        $qb = $this
            ->createQueryBuilder()
                            ->select('niveau')
                            ->from('NoyauBundle:Niveau', 'niveau')
                            ->where('niveau.archive = :ARCHIVE')
                            ->andWhere('niveau.id IN (:NIVEAU_BY_PARCOURS)')
                            ->setParameter('ARCHIVE', false)
                            ->setParameter('NIVEAU_BY_PARCOURS', $niveauxByParcours)
                            ->orderBy('niveau.id', 'ASC');
        return $qb->getQuery()->getResult();
    }  */
    public function parcoursAncien() {
        // Date du jour moins 1 an :
        $dateMoinsUnAn = new \DateTime();
        $dateMoinsUnAn->sub(new \DateInterval('P1Y'));

        $qb = $this->createQueryBuilder('p');
        $qb->where('p.datemodification < :datemodification')
                ->setParameter('datemodification', $dateMoinsUnAn)
                ->orderBy('p.dateinscription', 'DESC');

        return $qb->getQuery()->getResult();
    }



    public function getByRncp($search, $rncp) {
        // Date du jour moins 1 an :
        $qb = $this->createQueryBuilder('p');
        $qb->where('parcours.archive = 0')
                            ->andWhere('parcours.parent IS NOT NULL')
                            ->andWhere('parcours.intitule LIKE :SEARCH_REQUEST OR '
                                    . 'parcours.code LIKE :SEARCH_REQUEST')
                            ->andWhere('parcours.rncp = :RNCP_REQUEST')
                            ->setParameter('SEARCH_REQUEST', '%' . $search . '%')
                            ->setParameter('RNCP_REQUEST', $rncp);

        return $qb->getQuery()->getResult();
    }


    public function isExist($options) {

        // Création du QueryBuilder :
        $queryBuilder = $this->createQueryBuilder('p');

        // Récupération des informations :
        $queryBuilder
                ->where($queryBuilder->expr()->eq('p.typeformation', '?1'))
                ->andWhere($queryBuilder->expr()->eq('p.parent', '?2'))
                ->andWhere($queryBuilder->expr()->neq('p.id', '?3'))
                ->setParameter(1, $options['formationtype'])
                ->setParameter(2, $options['parent'])
                ->setParameter(3, $options['id'])
        ;

        // Renvoi du résultat :
        return !empty($queryBuilder->getQuery()->getResult());
    }

    public function findParcours($type,$filiere,$RNCP){//$type le type du formation
                        $queryBuilder =  $this->createQueryBuilder('parcours')
                        ->select('parcours')
                        ->innerJoin('parcours.typeformation', 'formationtype')
                        ->innerJoin('parcours.filiere', 'filiere')
                        ->where('parcours.rncp = :RNCP')
                        ->andWhere('parcours.archive = false')
                        ->andWhere('formationtype.id = :TYPE_FORMATION_ID')
                        ->andWhere('filiere = :FILIERE')
                        ->setParameter('TYPE_FORMATION_ID',$type)
                        ->setParameter('RNCP', $RNCP)
                        ->setParameter('FILIERE', $filiere)
                        ->orderBy('parcours.niveau', 'DESC');;
        $result = $queryBuilder->getQuery()->getResult();
        if($result) return $result;


        }

    public function findParcoursCPF($type,$filiere,$RNCP){//$type le type du formation
                            $queryBuilder =  $this->createQueryBuilder('parcours')
                        ->select('parcours')
                        ->innerJoin('parcours.typeformation', 'formationtype')
                        ->innerJoin('parcours.filiere', 'filiere')
                        ->where('parcours.cpf = :CPF')
                        ->andWhere('parcours.rncp = :RNCP')
                        ->andWhere('parcours.archive = false')
                        ->andWhere('formationtype.id = :TYPE_FORMATION_ID')
                        ->andWhere('filiere = :FILIERE')
                        ->setParameter('TYPE_FORMATION_ID',$type)
                        ->setParameter('CPF', true)
                        ->setParameter('RNCP', $RNCP)
                        ->setParameter('FILIERE', $filiere)
                        ->orderBy('parcours.niveau', 'DESC');;
        $result = $queryBuilder->getQuery()->getResult();
        if($result) return $result;


        }


    
    public function isDoubleIntituleParcoursParent($parcours,$intitule){
        $queryBuilder =  $this->createQueryBuilder('parcours')
                            ->where('parcours.parent IS NULL')
                            ->andWhere('parcours.id != :ID')
                            ->andWhere('parcours.intitule LIKE :INTITULE')
                            ->setParameter('INTITULE', $intitule)
                            ->setParameter('ID', $parcours->getId());
        $result = $queryBuilder->getQuery()->getResult();
        if($result) return $result;
           else return false;  
    }
    public function isDoubleSigleParcoursParent($parcours,$sigle){
        $queryBuilder =  $this->createQueryBuilder('parcours')
                            ->where('parcours.parent IS NULL')
                            ->andWhere('parcours.id != :ID')
                            ->andWhere('parcours.sigle LIKE :SIGLE')
                            ->setParameter('SIGLE', $sigle)
                            ->setParameter('ID', $parcours->getId());
        $result = $queryBuilder->getQuery()->getResult();  
        if($result) return $result;
           else return false;
    }
    
    public function getParcoursByTypeFormation($parcoursPere,$formationType){
            
        if($formationType){
        $parcours = $this->createQueryBuilder('parcours')
                        ->select('parcours')
                        ->innerJoin('parcours.typeformation', 'formationtype')
                        ->where('parcours.parent = :PARCOURS_PARENT')
                        ->andWhere('parcours.archive = false')
                        ->andWhere('formationtype.id = :TYPE_FORMATION_ID')
                        ->setParameter('TYPE_FORMATION_ID', $formationType->getId())
                        ->setParameter('PARCOURS_PARENT', $parcoursPere->getId())
                        ->setMaxResults(1)
                        ->getQuery()
                        ->getOneOrNullResult();

            if($parcours) return $parcours;  
        } 
        
        return false;
    }
    public function getParcoursByModeFormation($parcoursPere,$ModeFormation){
       
        if($ModeFormation){
        $parcours = $this->createQueryBuilder('parcours')
                        ->select('parcours')
                        ->innerJoin('parcours.modeFormation', 'ModeFormation')
                        ->where('parcours.parent = :PARCOURS_PARENT')
                        ->andWhere('parcours.archive = false')
                        ->andWhere('parcours.publication = true')
                        ->andWhere('ModeFormation.id = :MODE_FORMATION_ID')
                        ->setParameter('MODE_FORMATION_ID', $ModeFormation->getId())
                        ->setParameter('PARCOURS_PARENT', $parcoursPere->getId())
                        ->setMaxResults(1)
                        ->getQuery()
                        ->getOneOrNullResult();

            if($parcours) return $parcours;  
        } 
        
        return false;
    }

    public function getAllFils(){
       
		$qb = $this
			->createQueryBuilder('p')
            ->where('p.parent is not null and p.archive=false');
		return $qb->getQuery()->getResult();
    }

    public function findAllFils(){
       
        $qb = $this
            ->createQueryBuilder('p')
            ->where('p.parent is not null and p.archive=false')
            ->orderBy('p.filiere', 'ASC');
        return $qb;
    }

    

	public function getSSReceptionMail()
	{

		$res=[];
		$sql="
			select parcours.id
			from parcours
				left outer join mail_reception_candidature_parcours on parcours.id=mail_reception_candidature_parcours.parcours_id
			where mail_reception_candidature_parcours.parcours_id is null
				and parcours.parent_id is not null
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$res = $statement->fetchAll();
		
		$resultat=[];
		foreach($res as $ligne){
			$resultat[]=$this->find($ligne);
		}
		return $resultat;
	}


public function getBySelectedTypeformation($selected_type_formation)
    {
    $qb =  $this->createQueryBuilder('parcours')
            ->innerJoin('parcours.typeformation', 'typeFormation')
                            ->innerJoin('parcours.filiere', 'filiere')
                            ->innerJoin('parcours.niveau', 'niveau')
                            ->where('typeFormation = :TYPE_FORMATION_ID')
                            ->andWhere('typeFormation.valeur3 = :ARCHIVE')
                            ->andWhere('filiere.archive = :F_ARCHIVE')
                            ->andWhere('parcours.archive = :ARCHIVE')
                            ->andWhere('parcours.publication = true')
                            ->setParameter('TYPE_FORMATION_ID', $selected_type_formation)
                            ->setParameter('ARCHIVE', false)
                            ->setParameter('F_ARCHIVE', false)
                            ->orderBy('parcours.id', 'ASC');
    return $qb->getQuery()->getResult();
    }



public function getParcoursPreparation($typeFormation, $filiere)
    {
    $qb =  $this->createQueryBuilder('parcours')
            ->innerJoin('parcours.niveau', 'niveau')
                        ->innerJoin('parcours.typeformation', 'type')
                        ->innerJoin('parcours.filiere', 'filiere')
                        ->andWhere('niveau.intitule like :NIVEAU')
                        ->andWhere('type.id = :TYPE')
                        ->andWhere('filiere = :FILIERE')
                        ->andWhere('parcours.archive = false')
                        ->andWhere('parcours.publication = true')
                        ->setParameter('TYPE', $typeFormation)
                        ->setParameter('NIVEAU', '%mise%')
                        ->setParameter('FILIERE', $filiere)
                        ->orderBy('parcours.id', 'ASC');
    return $qb->getQuery()->getResult();
    }

public function getPageParcoursdiplomants($typeFormation, $filiere)
    {
    $qb =  $this->createQueryBuilder('parcours')
                        ->innerJoin('parcours.typeformation', 'type')
                        ->innerJoin('parcours.filiere', 'filiere')
                        ->where('parcours.rncp = :RNCP')
                        ->andWhere('type = :TYPE')
                        ->andWhere('filiere = :FILIERE')
                        ->andWhere('parcours.archive = false')
                        ->andWhere('parcours.publication = true')
                        ->setParameter('TYPE', $typeFormation)
                        ->setParameter('FILIERE', $filiere)
                        ->setParameter('RNCP', true)
                        ->orderBy('parcours.id', 'ASC')
                        ->orderBy('parcours.id', 'ASC');
    return $qb->getQuery()->getResult();
    }

public function getPageParcoursProfessionnalisation($typeFormation, $filiere)
    {
    $qb =  $this->createQueryBuilder('parcours')
                        ->innerJoin('parcours.niveau', 'niveau')
                        ->innerJoin('parcours.typeformation', 'type')
                        ->innerJoin('parcours.filiere', 'filiere')
                        ->where('parcours.rncp = :RNCP')
                        ->andWhere('niveau.intitule not like :NIVEAU')
                        ->andWhere('type.id = :TYPE')
                        ->andWhere('filiere = :FILIERE')
                        ->andWhere('parcours.archive = false')
                        ->andWhere('parcours.publication = true')
                        ->setParameter('TYPE', $typeFormation)
                        ->setParameter('FILIERE', $filiere)
                        ->setParameter('RNCP', false)
                        ->setParameter('NIVEAU', '%' . 'mise' . '%')
                        ->orderBy('parcours.id', 'ASC');
    return $qb->getQuery()->getResult();
    }


public function getPageParcoursPreparation($typeFormation, $filiere)
    {
    $qb =  $this->createQueryBuilder('parcours')
                        ->innerJoin('parcours.niveau', 'niveau')
                        ->innerJoin('parcours.typeformation', 'type')
                        ->innerJoin('parcours.filiere', 'filiere')
                        ->andWhere('niveau.intitule like :NIVEAU')
                        ->andWhere('type.id = :TYPE')
                        ->andWhere('filiere = :FILIERE')
                        ->andWhere('parcours.archive = false')
                        ->andWhere('parcours.publication = true')
                        ->setParameter('TYPE', $typeFormation)
                        ->setParameter('NIVEAU', '%mise%')
                        ->setParameter('FILIERE', $filiere)
                        ->orderBy('parcours.id', 'ASC');
    return $qb->getQuery()->getResult();
    }
}
