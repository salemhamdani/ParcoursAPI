<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historiqueemail
 *
 * @ORM\Table(name="historiquestatut")
 * @ORM\Entity(repositoryClass="App\Repository\HistoriquestatutRepository")
 */
class Historiquestatut {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    
    private $id;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Dossier", cascade={"persist"}, inversedBy="historiquestatuts")
    */
    private $dossier;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataCreation", type="datetime", nullable=true)
     */
    private $dataCreation;
    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $type;

    /**
     * Constructor
     */
    public function __construct() {
        $this->dataCreation = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set dataCreation
     *
     * @param \DateTime $dataCreation
     * ORM\PrePersist
     * @return Historiqueemail
     */
    public function setDataCreation() {
        $this->dataCreation = new \DateTime();

        return $this;
    }

    /**
     * Get dataCreation
     *
     * @return \DateTime
     */
    public function getDataCreation() {
        return $this->dataCreation;
    }

    /**
     * Set dossier
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return Historiqueemail
     */
    public function setDossier(\App\Entity\Dossier $dossier = null)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier
     *
     * @return \App\Entity\Dossier
     */
    public function getDossier()
    {
        return $this->dossier;
    }



    /**
     * Set type
     *
     * @param \App\Entity\Masterlistelg $type
     *
     * @return Historiqueemail
     */
    public function setType(\App\Entity\Masterlistelg $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getType()
    {
        return $this->type;
    }
}
