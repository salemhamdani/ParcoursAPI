<?php

namespace App\Repository;

/**
 * ContentSectionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContentSectionRepository extends \Doctrine\ORM\EntityRepository
{
  public function findByArchive($etat)
    {
        return $this->findBy(array('archive' => $etat),array('title' => 'ASC'));

    }

      public function findByContentslider($id)
    {
        return $this->findBy(array('contentslider' => $id),array('title' => 'ASC'));

    }

          public function getSectionByvaleur($bloc,$valeur)// bloc header , content , footer , left ... type mycommunity or front 
    {
        $qb = $this
      ->createQueryBuilder('section')
            ->join('section.type', 'type')
            ->addSelect('type')
            ->where('type.code = :bloc')
            ->Andwhere('type.valeur = :valeur')
            ->setParameter('bloc', $bloc)
            ->setParameter('valeur', $valeur)
            ->orderBy('section.rang');
    return $qb;

    }
          public function getSectionBytype($type) // type mycommunity or front 
    {
        $qb = $this
      ->createQueryBuilder('section')
            ->join('section.type', 'type')
            ->addSelect('type')
            ->where('type.valeur = :valeur')
            ->setParameter('valeur', $type)
            ->orderBy('section.rang');
    return $qb;

    }

           public function findSectionByvaleur($bloc,$valeur)// bloc header , content , footer , left ... type mycommunity or front 
    {
        $qb = $this
      ->createQueryBuilder('section')
            ->join('section.type', 'type')
            ->addSelect('type')
            ->where('type.code = :bloc')
            ->Andwhere('type.valeur = :valeur')
            ->setParameter('bloc', $bloc)
            ->setParameter('valeur', $valeur)
            ->orderBy('section.rang');
              return $qb->getQuery()->getResult();

    }

           public function findSectionBytype($type) // type mycommunity or front 
    {
        $qb = $this
      ->createQueryBuilder('section')
            ->join('section.type', 'type')
            ->addSelect('type')
            ->where('type.valeur = :valeur')
            ->setParameter('valeur', $type)
            ->orderBy('section.rang');
              return $qb->getQuery()->getResult();

    }


           public function findSectionCMS() // type mycommunity or front 
    {
        $qb = $this
      ->createQueryBuilder('section');
         $qb->where($qb->expr()->isNull('section.type'))
            ->orderBy('section.rang');
              return $qb->getQuery()->getResult();

    }


        public function getRang()
    {
        $queryBuilder = $this->createQueryBuilder('f');
        $queryBuilder->select($queryBuilder->expr()->max('f.rang'));
        return (int)$queryBuilder->getQuery()->getScalarResult()[0][1] + 1;
    }

}
