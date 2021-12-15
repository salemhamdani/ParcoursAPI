<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historique
 *
 * @ORM\Table(name="historique")
 * @ORM\Entity(repositoryClass="App\Repository\HistoriqueRepository")
 */
class Historique {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="field", type="string", length=255, nullable=true)
     */
    private $field;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer", nullable=true)
     */
    private $count = 1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataCreation", type="datetime", nullable=true)
     */
    private $dataCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataUpdated", type="datetime", nullable=true)
     */
    private $dataUpdated;

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
     * Set field
     *
     * @param string $field
     *
     * @return Historique
     */
    public function setField($field) {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return string
     */
    public function getField() {
        return $this->field;
    }

    /**
     * Set dataCreation
     *
     * @param \DateTime $dataCreation
     * ORM\PrePersist
     * @return Historique
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
     * Set count
     *
     * @param integer $count
     *
     * @return Historique
     */
    public function setCount($count) {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount() {
        return $this->count;
    }

    
    /**
     * Set dataUpdated
     *
     * @param \DateTime $dataUpdated
     *
     * @return Historique
     */
    public function setDataUpdated($dataUpdated)
    {
        $this->dataUpdated = $dataUpdated;

        return $this;
    }

    /**
     * Get dataUpdated
     *
     * @return \DateTime
     */
    public function getDataUpdated()
    {
        return $this->dataUpdated;
    }
}
