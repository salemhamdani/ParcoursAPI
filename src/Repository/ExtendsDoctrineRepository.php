<?php
namespace App\Repository;


class ExtendsDoctrineRepository extends \Doctrine\ORM\EntityRepository
{
	public function findPrecedent($item){$qb = $this->createQueryBuilder('m')->where('m.id < :itemid')->setParameters(array(':itemid'=> $item->getId()))->orderBy('m.id', 'DESC')->setMaxResults(1);$resultat=$qb->getQuery()->getOneOrNullResult();if(is_null($resultat)){return $item;}else{return $resultat;}}
	public function findSuivant($item){$qb = $this->createQueryBuilder('m')->where('m.id > :itemid')->setParameters(array(':itemid'=> $item->getId()))->orderBy('m.id', 'ASC')->setMaxResults(1);$resultat=$qb->getQuery()->getOneOrNullResult();if(is_null($resultat)){return $item;}else{return $resultat;}}

    public function isDoublon($valeursConditions, $signesConditions){

        // Création du QueryBuilder :
        $queryBuilder = $this->createQueryBuilder('n');

        // Récupération des informations :
        $i = 0;
        foreach ($valeursConditions as $key => $value) {
            if ($i == 0) {
                $queryBuilder->where('n.' . $key . ' ' . $signesConditions[$i] . ' :' . $key);
            }else{
                $queryBuilder->andWhere('n.' . $key . ' ' . $signesConditions[$i] . ' :' . $key);
            }
            ++$i;
        }

        // Renvoi du résultat :
        return ! empty($queryBuilder
            ->setParameters($valeursConditions)
            ->getQuery()
            ->getResult());
    }


    public function getMaxOrdrePlusUn()
    {
        // Création du QueryBuilder :
        $queryBuilder = $this->createQueryBuilder('f');
        $queryBuilder->select($queryBuilder->expr()->max('f.ordre'));
        return (int)$queryBuilder->getQuery()->getScalarResult()[0][1] + 1;
    }
}