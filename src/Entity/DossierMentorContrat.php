<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * DossierMentorContrat
 *
 * @ORM\Table(name="dossiermentors_contrat")
 * @ORM\Entity(repositoryClass="App\Repository\DossierMentorContratRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class DossierMentorContrat {

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
     * @ORM\OneToOne(targetEntity="App\Entity\DossierMentor", inversedBy="dossiermentorcontrat")
     */
    private $dossiermentor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contrat")
     */
    private $contrat;

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
     * @return DossierMentorContrat
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
     * Set dossiermentor.
     *
     * @param \App\Entity\DossierMentor|null $dossiermentor
     *
     * @return DossierMentorContrat
     */
    public function setDossiermentor(\App\Entity\DossierMentor $dossiermentor = null)
    {
        $this->dossiermentor = $dossiermentor;

        return $this;
    }

    /**
     * Get dossiermentor.
     *
     * @return \App\Entity\DossierMentor|null
     */
    public function getDossiermentor()
    {
        return $this->dossiermentor;
    }

}
