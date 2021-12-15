<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormateurModule
 *
 * @ORM\Table(name="formateur_parcours")
 * @ORM\Entity(repositoryClass="App\Repository\FormateurModuleRepository")
 */
class FormateurParcours {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formateur", inversedBy="formateurParcours")
     * @ORM\JoinColumn(name="formateur_id", nullable=true, onDelete="CASCADE" )
     */
    private $formateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Parcours", inversedBy="formateurParcours")
     * @ORM\JoinColumn(name="module_id", nullable=true, onDelete="CASCADE" )
     */
    private $parcours;

    /**
     * @var string
     *
     * @ORM\Column(name="tarif", type="string", length=100, nullable=true)
     */
    private $tarif;

    /**
     * Set formateur
     *
     * @param \App\Entity\Formateur $formateur
     *
     * @return FormateurModule
     */
    public function setFormateur(\App\Entity\Formateur $formateur = null) {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * Get formateur
     *
     * @return \App\Entity\Formateur
     */
    public function getFormateur() {
        return $this->formateur;
    }

    /**
     * Set parcours
     *
     * @param \App\Entity\Parcours $parcours
     *
     * @return FormateurParcours
     */
    public function setParcours(\App\Entity\Parcours $parcours = null) {
        $this->parcours = $parcours;

        return $this;
    }

    /**
     * Get parcours
     *
     * @return \App\Entity\Parcours
     */
    public function getParcours() {
        return $this->parcours;
    }

    /**
     * Set tarif
     *
     * @param string $tarif
     *
     * @return module
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return string
     */
    public function getTarif()
    {
        return $this->tarif;
    }

}
