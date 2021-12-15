<?php

namespace App\Repository;



/**
 * ModuleRepository
 */
class ModuleRepository extends \Doctrine\ORM\EntityRepository 
{
    

          public function findById($id)
    {
        return $this->find($id);

    }

 public function moduleAncien()
    {
        // Date du jour moins 1 an :
        $dateMoinsUnAn = new \DateTime();
        $dateMoinsUnAn->sub(new \DateInterval('P1Y'));

        $qb = $this->createQueryBuilder('m');
        $qb->where('m.dateupdate < :dateupdate')
           ->setParameter('dateupdate', $dateMoinsUnAn)
           ->orderBy('m.dateupdate', 'DESC');

        return $qb->getQuery()->getResult();
    }


public function getByCertifications($certif)
    {
        $qb = $this->createQueryBuilder('module');
        $qb->innerJoin('module.certification', 'certification')
                            ->where('certification.id = :ID')
                            ->andWhere('module.archive = :ARCHIVE')
                            ->setParameter('ID', $certif)
                            ->setParameter('ARCHIVE', false)
                            ->orderBy('module.id', 'ASC');

        return $qb->getQuery()->getResult();
    }


public function getByFinanceur($financeur)
    {
        $qb = $this->createQueryBuilder('module');
        $qb->innerJoin('module.financeurs', 'ID_financeur')
                        ->where('module.archive = 0')
                        ->andWhere('ID_financeur IN (:ID_financeur)')
                        ->setParameter('ID_financeur', $financeur);

        return $qb->getQuery()->getResult();
    }


public function getByIntitule()
    {
        $qb = $this->createQueryBuilder('module');
        $qb->where('module.intitule like :INTITULE')
           ->setParameter('INTITULE', '%' . 'photoshop' . '%');

        return $qb->getQuery()->getResult();
    }


          public function getBycpf($opca)
    {
         $qb = $this->createQueryBuilder('m');
         $qb->where('module.archive = 0')
            ->andWhere('module.public = 1')
            ->andWhere('module.cpf = :CPF_REQUEST')
            ->setParameter('CPF_REQUEST', true);

        return $qb->getQuery()->getResult();

    }
    
    /**
     * Méthode retourne la liste des modules en jointure avecles themes et sous theme
     *
     * @param $blnetat
     * @return 
     */
    public function getModuleByThemeAndSousTheme($blnEtat){
        
        $filtre = $this->createQueryBuilder('module')
            // Ajout des tables de jointure
            // Diminutions du nombre des requetes SQL = meilleur perf
            ->join('module.sousthemetheme', 'stt')
            ->join('stt.soustheme', 'st')
            ->join('stt.theme', 't')
            // On met un alias sur le champ intitule pour ne pas les confondre
            ->addSelect('st.intitule intitule_st', 't.intitule intitule_t', 't.couleur');

        // Récupération de la liste :
        $filtre = $filtre
            ->where('module.archive = :ARCHIVE')
            ->setParameter('ARCHIVE', $blnEtat);

        // Tri le tableau sur le Theme / Sous Theme puis le code
        $liste = $filtre
            ->orderBy('t.intitule', 'ASC')
            ->addOrderBy('st.intitule', 'ASC')
            ->addOrderBy('module.code', 'ASC')
            ->getQuery()
            ->getResult();
        
         // Renvoi du résultat :
        return $liste;
        
    }
    

    public function getAllModuleByThemeAndSousTheme(){
        
        $filtre = $this->createQueryBuilder('module')
            // Ajout des tables de jointure
            // Diminutions du nombre des requetes SQL = meilleur perf
            ->join('module.sousthemetheme', 'stt')
            ->join('stt.soustheme', 'st')
            ->join('stt.theme', 't')
            // On met un alias sur le champ intitule pour ne pas les confondre
            ->addSelect('st.intitule intitule_st', 't.intitule intitule_t', 't.couleur');

        // Tri le tableau sur le Theme / Sous Theme puis le code
        $liste = $filtre
            ->orderBy('t.intitule', 'ASC')
            ->addOrderBy('st.intitule', 'ASC')
            ->addOrderBy('module.code', 'ASC')
            ->getQuery()
            ->getResult();
        
         // Renvoi du résultat :
        return $liste;
        
    }
    

    public function getAllModuleByThemeAndSousThemeOpca($opca){
        
        $qb = $this->createQueryBuilder('module');
        $filtre = $this->createQueryBuilder('module')
            // Ajout des tables de jointure
            // Diminutions du nombre des requetes SQL = meilleur perf
            ->join('module.opcaModule', 'om')
            ->join('module.sousthemetheme', 'stt')
            ->join('stt.soustheme', 'st')
            ->join('stt.theme', 't')
            // On met un alias sur le champ intitule pour ne pas les confondre
            ->addSelect('st.intitule intitule_st', 't.intitule intitule_t', 't.couleur', 'om.tarifinterjour tarifinterjouropca', 'om.tarifintrajour tarifintrajouropca')
            ->where($qb->expr()->eq('om.opca', '?1'))
            ->setParameter(1, $opca);

        // Tri le tableau sur le Theme / Sous Theme puis le code
        $liste = $filtre
            ->orderBy('t.intitule', 'ASC')
            ->addOrderBy('st.intitule', 'ASC')
            ->addOrderBy('module.code', 'ASC')
            ->getQuery()
            ->getResult();
        
         // Renvoi du résultat :
        return $liste;
        
    }

	public function getModulesSansDate()
	{
		$resultat=array();
		$sql="
			SELECT module.id,
				module.code,
				module.intitule,
				DATE_FORMAT((select max(datedebut) from session_module sm2 where sm2.module_id=module.id),'%d/%m/%Y') last_date
			FROM module
			where module.publie=1
			and not exists(
				select * from session_module sm
				where sm.module_id=module.id and sm.datedebut>=now())
		";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}
	
	public function getAllModulesSQLNatif()
	{

		$resultat=array();
		$sql="
			select
				module.id,
				module.code,
				module.intitule,
				module.duree,
				theme.intitule themeintitule,
				st.intitule sthemeintitule
			from module
				inner join sous_theme_theme stt on stt.id=module.sousthemetheme
				inner join soustheme st on st.id=stt.soustheme_id
				inner join theme on theme.id=stt.theme_id
			where module.archive=false
		";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}
	
	// La recherche
	public function getAllForRecherche($str='')
	{
		$resultat=array();
		
		$str=strtolower($str);
		
		$sql = "
			select m1.id,
				m1.code,
				m1.intitule,
				m1.duree
			from module m1
			where (lower(m1.code) like '%".$str."%' or lower(m1.intitule) like '%".$str."%')
				and m1.archive=false
			limit 10
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

}
