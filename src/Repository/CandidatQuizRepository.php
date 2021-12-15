<?php

namespace App\Repository;

/**
 * CandidatQuizRepository
 */
class CandidatQuizRepository extends \Doctrine\ORM\EntityRepository
{

     public function getByCategorie($candidat,$categorie)
    {
        $qb = $this->createQueryBuilder('cat');
        $qb->innerJoin('cat.quiz', 'quiz')
	        ->innerJoin('cat.candidat', 'candidat')
            ->innerJoin('quiz.categorie', 'categorie')
            ->where('candidat.id = :_CANDIDAT')
            ->andWhere('categorie.id = :_CATEGORY')
            ->setParameter('_CANDIDAT', $candidat->getId())
            ->setParameter('_CATEGORY', $categorie);

        return $qb->getQuery()->getResult();
    }


}
