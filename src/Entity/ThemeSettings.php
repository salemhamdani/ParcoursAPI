<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ThemeSettings
 *
 * @ORM\Table(name="theme_settings")
 * @ORM\Entity()
 * @UniqueEntity(
 *     fields={"value"},
 *     message="ce theme est existant"
 * )
 */
class ThemeSettings {

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
     * @ORM\Column(name="field", type="string", length=100, nullable=false)
     */
    private $field;

    /**
     * @var string
     * @Assert\NotBlank( message = "Ce champs est obligatoire.")
     * @ORM\Column(name="value", type="text", nullable=true)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=65, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

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
     * @return ThemeSettings
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
     * Set value
     *
     * @param string $value
     *
     * @return ThemeSettings
     */
    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return ThemeSettings
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set dataCreation
     *
     * @param \DateTime $dataCreation
     * ORM\PrePersist
     * @return ThemeSettings
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
     * Set dataUpdated
     *
     * @param \DateTime $dataUpdated
     *
     * @return ThemeSettings
     */
    public function setDataUpdated($dataUpdated) {
        $this->dataUpdated = $dataUpdated;

        return $this;
    }

    /**
     * Get dataUpdated
     *
     * @return \DateTime
     */
    public function getDataUpdated() {
        return $this->dataUpdated;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return ThemeSettings
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    public function getPath() {
        return $this->path;
    }


}
