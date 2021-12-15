<?php

namespace App\Repository;

/**
 * MailReceptionCandidatureRepository
 */
class MailReceptionCandidatureRepository extends \Doctrine\ORM\EntityRepository
{

      public function getByParcours($parcours)
    {
        $idparcours=$parcours->getId();
        $resultat=[];
        $sql="
            select 
                mailreceptioncandidatures.id
            from    mail_reception_candidature_parcours mailreceptioncandidatureparcours
                inner join mailreceptioncandidatures mailreceptioncandidatures on mailreceptioncandidatures.id=mailreceptioncandidatureparcours.mail_reception_candidature_id
                where  mailreceptioncandidatureparcours.parcours_id = '$idparcours'
        ";

        $conn = $this->_em->getConnection();
        $statement = $conn->executeQuery($sql);
        $resultat = $statement->fetchAll();

        return $resultat;


    }

              
    
}
