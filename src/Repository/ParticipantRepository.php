<?php

namespace App\Repository;

/**

 * ParticipantRepository
 */
class ParticipantRepository extends \Doctrine\ORM\EntityRepository
{
    

 public function getByEvenement($event){

    $qb = $this->createQueryBuilder('participant');
    $qb->innerJoin('participant.evenements', 'event')
        ->where('event.id = :ID_EVENT')
        ->setParameter('ID_EVENT', $event)
        ->orderBy('participant.id', 'DESC');

    return $qb->getQuery()->getResult();

    }
}
