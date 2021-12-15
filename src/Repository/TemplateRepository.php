<?php

namespace App\Repository;

/**
 * TemplateRepository
 */
class TemplateRepository extends \Doctrine\ORM\EntityRepository
{



          public function findPageBytype($template)
    {
        $qb = $this
      ->createQueryBuilder('template')
            ->join('template.codetemplate', 'codetemplate')
            ->addSelect('codetemplate')
            ->where('codetemplate.code = :code')
            ->setParameter('code', $template)
            ->setMaxResults(1)->orderBy('template.id');
        return $qb->getQuery()->getOneOrNullResult();

    }


         public function findAllByType($type)
    {
        $qb = $this
      ->createQueryBuilder('template')
            ->join('template.type', 'type')
            ->addSelect('type')
            ->where('type.code = :code')
            ->setParameter('code', $type)
            ->setMaxResults(1)->orderBy('template.id');
        return $qb->getQuery()->getResult();

    }
}
