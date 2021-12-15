<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * ModuleContrat
 *
 * @ORM\Table(name="modulecontrat")
 * @ORM\Entity(repositoryClass="App\Repository\ModuleContratRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ModuleContrat {

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->actif=true;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Module")
     */
    private $module;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contrat", inversedBy="modulecontrats")
     */
    private $contrat;

    /**
     * @var string
     * 
     * @ORM\Column(type="text", nullable=true)
     */
    private $duree;
    /**
     * @var string
     * 
     * @ORM\Column(type="text", nullable=true)
     */
    private $tarif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datelivraison;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateinsert;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateupdate;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\PrePersist
     */
    public function ajout()
    {
        $this->dateinsert = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function modification()
    {
        $this->dateupdate = new \DateTime();
    }

    /**
     * Set contrat.
     *
     * @param \App\Entity\Contrat|null $contrat
     *
     * @return DossierMentor
     */
    public function setContrat(\App\Entity\Contrat $contrat = null)
    {
        $this->contrat = $contrat;

        return $this;
    }

    /**
     * Get contrat.
     *
     * @return \App\Entity\Contrat|null
     */
    public function getContrat()
    {
        return $this->contrat;
    }

    /**
     * Set module.
     *
     * @param \App\Entity\Module|null $module
     *
     * @return Module
     */
    public function setModule(\App\Entity\Module $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module.
     *
     * @return \App\Entity\Module|null
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set duree.
     *
     * @param string|null $duree
     *
     * @return DossierMentor
     */
    public function setDuree($duree = null)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree.
     *
     * @return string|null
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set tarif.
     *
     * @param string|null $tarif
     *
     * @return DossierMentor
     */
    public function setTarif($tarif = null)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif.
     *
     * @return string|null
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set datelivraison
     *
     * @param \DateTime $datelivraison
     *
     * @return DossierMentor
     */
    public function setDatelivraison($datelivraison)
    {
        $this->datelivraison = $datelivraison;

        return $this;
    }

    /**
     * Get datelivraison
     *
     * @return \DateTime
     */
    public function getDatelivraison()
    {
        return $this->datelivraison;
    }
}
