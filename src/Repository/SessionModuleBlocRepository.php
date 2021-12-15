<?php

namespace App\Repository;

/**
 * SessionModuleBlocRepository
 */
class SessionModuleBlocRepository extends \Doctrine\ORM\EntityRepository
{


          public function getBySession($session)
    {
                $qb = $this->createQueryBuilder('smb')
					->join('smb.blocmodule', 'blocmodule')
                    ->where('smb.session = :session')
            		->groupby('blocmodule.module')
                    ->setParameter('session', $session);
        return $qb->getQuery()->getResult();
    }

           public function getByDate($date)
    {           
         $from =$date->format("Y-m-d")." 08:00:00";
         $to  = $date->format("Y-m-d")." 23:59:59";
                $qb = $this->createQueryBuilder('smb')
                    ->join('smb.sessionmodule', 'sessionmodule')
                    ->where('sessionmodule.datedebut BETWEEN :from AND :to')
                    ->groupBy('sessionmodule')
                    ->setParameter('from', $from)
                    ->setParameter('to', $to)
                    ;
        return $qb->getQuery()->getResult();

    }

    public function getForCalSessionModules($session)
    {
		$resultat=array();
        $idsession=$session->getId();
		$sql = "
            SELECT theme.couleur			couleur,
                module.id					module_id,
                module.code					module_code,
                module.code                 module_session,
                module.intitule				module_intitule,
                bloc.intitule				bloc_intitule,
                module.duree				module_duree_hrs,
                round((module.duree/7),2)	module_duree_jrs,
                smb.id						smb_id,
                (select count(1) from session_evenements sev10 where sev10.sessionmodule_id=smod.id) nbsev
            from sessions
                inner join session_module_bloc smb on smb.session_id=sessions.id
                inner join session_module smod on smb.sessionmodule_id=smod.id
                inner join bloc_modules on bloc_modules.id=smb.blocmodule_id
                inner join bloc on bloc.id=bloc_modules.bloc_id
                inner join module on module.id=smod.module_id
                inner join sous_theme_theme stt on stt.id=module.sousthemetheme
                inner join theme on theme.id=stt.theme_id
            where bloc.type=2
                and sessions.parcours_id=bloc.parcours
                and sessions.id=$idsession
                and smb.session_id=$idsession
                group By module.id ";
    
        $conn = $this->_em->getConnection();
        $statement = $conn->executeQuery($sql);
        $resultat = $statement->fetchAll();

        return $resultat;
    }
}
