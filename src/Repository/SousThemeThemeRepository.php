<?php

namespace App\Repository;

/**
 * SousThemeThemeRepository
 */
class SousThemeThemeRepository extends \NoyauBundle\Repository\ExtendsDoctrineRepository
{
    /**
     * M�thode permettant de r�cup�rer la liste des th�mes associ�s � un sous-th�me.
     * @param $id Repr�sente l'id du sous-th�me.
     * @return array
     */
    public function getThemeBySoustheme($id)
    {
        $qb = $this->createQueryBuilder('stt');
        $qb->select('t')
            ->join('NoyauBundle:theme', 't')
            ->where($qb->expr()->eq('t.id', 'stt.theme'))
            ->andWhere($qb->expr()->eq('stt.soustheme', '?1'))
            ->setParameter(1, $id);

        return $qb->getQuery()->getResult();
    }
    

    public function getPublic()
    {
        $qb = $this->createQueryBuilder('stt');
$qb->innerJoin('stt.module', 'module')
->where('module.publie = :PUBLIE')
->setParameter('PUBLIE', true);

        return $qb->getQuery()->getResult();
    }
    

    public function getByModules($modules)
    {
        $qb = $this->createQueryBuilder('sousthemetheme');
                        $qb->innerJoin('sousthemetheme.module', 'module')
                            ->where('module.id IN (:M_REQUEST)')
                            ->setParameter('M_REQUEST', $modules);

        return $qb->getQuery()->getResult();
    }
    


    public function getByModulePublie()
    {
        $qb = $this->createQueryBuilder('sousthemetheme');
                        $qb->from('NoyauBundle:SousThemeTheme', 'sousThemeTheme')
                        ->innerJoin('sousThemeTheme.module', 'module')
                        ->where('module.publie = :PUBLIE')
                        ->setParameter('PUBLIE', true);

        return $qb->getQuery()->getResult();
    }

    /**
     * M�thode permettant de r�cup�rer la liste des th�mes associ�s � un sous-th�me.
     * @param $id Repr�sente l'id du sous-th�me.
     * @return array
     */
    public function getThemeBySousthemetheme($id)
    {
        $qb = $this->createQueryBuilder('stt');
        $qb->select('t')
            ->join('NoyauBundle:theme', 't')
            ->where($qb->expr()->eq('t.id', 'stt.theme'))
            ->andWhere($qb->expr()->eq('stt.id', '?1'))
            ->setParameter(1, $id);

        return $qb->getQuery()->getResult();
    }

    /**
     * M�thode permettant de r�cup�rer l'ensemble des sous-th�mes organis�s en th�mes.
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getAllSousThemeGroupByTheme()
    {
        $qb = $this->createQueryBuilder('stt');
        $qb->innerJoin('stt.theme', 't')
           ->innerJoin('stt.soustheme', 'st');

        return $qb;
    }


    public function getAllSousThemeBymodulepublie()
    {
        $qb =$this->createQueryBuilder('stt')
                        ->innerJoin('stt.module', 'module')
                        ->where('module.publie = :PUBLIE')
                        ->setParameter('PUBLIE', true);
return $qb->getQuery()->getResult();
    }

    /**
     * M�thode permettant de r�cup�rer la liste des sous-th�mes associ�s � un th�me.
     * @param $id Repr�sente l'id du th�me.
     * @param $valeursConditions Exemple : ['archive' => true]
     * @param $signesConditions Exemple : ['=']
     * @return array
     */
    public function getSousThemeByTheme($id, $valeursConditions, $signesConditions)
    {
        $qb = $this->createQueryBuilder('stt');
        $qb->select(['st.archive', 'st.id', 'st.intitule', 'stt.ordre', 'stt.id AS id_stt'])
            ->join('NoyauBundle:SousTheme', 'st')
            ->where($qb->expr()->eq('st.id', 'stt.soustheme'));

        // S'il y a des conditions suppl�mentaires :
        $i = 0;
        foreach ($valeursConditions as $key => $value) {
            $qb->andWhere($key . ' ' . $signesConditions[$i] . ' ?' . $i)
               ->setParameter($i, $value);

            ++$i;
        }

        $qb->andWhere($qb->expr()->eq('stt.theme', '?1'))
            ->setParameter(1, $id);

        return $qb->getQuery()->getResult();
    }


    /**
     * M�thode permettant de supprimer tous les th�mes associ�s � un sous-th�me.
     * @param $id Repr�sente l'id du sous-th�me.
     * @return mixed
     */
    public function deleteThemeBySoustheme($id)
    {
        $qb = $this->createQueryBuilder('stt');
        $qb->delete()
            ->where($qb->expr()->eq('stt.soustheme', '?1'))
            ->setParameter(1, $id);

        return $qb->getQuery()->execute();
    }


    public function getSousThemeThemeByTheme(array $tId, $idSousTheme)
    {
        $qb = $this->createQueryBuilder('stt');
        $qb->where($qb->expr()->in('stt.theme', '?1'))
            ->andWhere($qb->expr()->eq('stt.soustheme', $idSousTheme))
            ->setParameter(1, $tId);

        return $qb->getQuery()->getResult();
    }


    public function getAllSousThemeThemeByOneTheme($pId)
    {
        $qb = $this->createQueryBuilder('stt');
        $qb->where($qb->expr()->in('stt.theme', '?1'))
            ->setParameter(1, $pId);

        return $qb->getQuery()->getResult();
    }


    public function deleteSousThemeTheme($id)
    {
        $qb = $this->createQueryBuilder('stt');
        $qb->delete()
            ->where($qb->expr()->eq('stt.id', '?1'))
            ->setParameter(1, $id);

        return $qb->getQuery()->execute();
    }



}

