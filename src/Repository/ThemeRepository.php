<?php

namespace App\Repository;

/**
 * ThemeRepository
 */
class ThemeRepository extends \NoyauBundle\Repository\ExtendsDoctrineRepository
{


		  public function findByCPF($etat)
    {
        return $this->findBy(array('archive' => $etat),array('ordre' => 'ASC'));

    }

     public function getBymodules($modules)
    {
        $qb = $this->createQueryBuilder('theme');
        $qb->innerJoin('theme.sousthemetheme', 'sousthemetheme')
                            ->innerJoin('sousthemetheme.module', 'module')
                            ->where('theme.archive = 0')
                            ->andWhere('module.id IN (:MODULE)')
                            ->setParameter('MODULE', $modules);

        return $qb->getQuery()->getResult();
    }                      

     public function getOthersdomaines($module)
    {
        $qb = $this->createQueryBuilder('theme');
        $qb->select('theme')
                            ->where('theme.id != :ID_theme')
                            ->andwhere('theme.archive = :ARCHIVE')
                            ->setParameter('ID_theme', $module->getSousthemetheme()->getTheme())
                            ->setParameter('ARCHIVE', false)
                            ->orderBy('theme.id', 'DESC');

        return $qb->getQuery()->getResult();
    }


     public function getOthersFormationThemes($selected_theme)
    {
        $qb = $this->createQueryBuilder('theme');
        $qb ->where('theme.id NOT IN  (:ID_THEME)')
            ->andwhere('theme.archive = :ARCHIVE')
            ->setParameter('ID_THEME', $selected_theme->getId())
            ->setParameter('ARCHIVE', false)
            ->orderBy('theme.ordre', 'ASC');

        return $qb->getQuery()->getResult();
    }

     public function getActive()
    {
        $qb = $this->createQueryBuilder('theme');

        return $qb->getQuery()->getResult();
    }   


}
