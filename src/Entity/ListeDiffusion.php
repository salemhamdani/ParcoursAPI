<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * ListeDiffusion
 *
 * @ORM\Table(name="listediffusions")
 * @ORM\Entity(repositoryClass="App\Repository\ListeDiffusionRepository")
 */
class ListeDiffusion
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dateinsert = new \DateTime();
		$this->emargement = false;
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
    * @ORM\ManyToOne(targetEntity="App\Entity\Dossier", inversedBy="listediffusions")
    */
    private $dossier;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable = true)
     */
    private $emargement;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise")
    */
    private $entreprise;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Contact")
    */
    private $contact;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User")
    */
    private $quiinsert;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User")
    */
    private $quiupdate;

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
     * Set emargement.
     *
     * @param bool|null $emargement
     *
     * @return ListeDiffusion
     */
    public function setEmargement($emargement = null)
    {
        $this->emargement = $emargement;

        return $this;
    }

    /**
     * Get emargement.
     *
     * @return bool|null
     */
    public function getEmargement()
    {
        return $this->emargement;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return ListeDiffusion
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return ListeDiffusion
     */
    public function setDateinsert($dateinsert = null)
    {
        $this->dateinsert = $dateinsert;

        return $this;
    }

    /**
     * Get dateinsert.
     *
     * @return \DateTime|null
     */
    public function getDateinsert()
    {
        return $this->dateinsert;
    }

    /**
     * Set dateupdate.
     *
     * @param \DateTime|null $dateupdate
     *
     * @return ListeDiffusion
     */
    public function setDateupdate($dateupdate = null)
    {
        $this->dateupdate = $dateupdate;

        return $this;
    }

    /**
     * Get dateupdate.
     *
     * @return \DateTime|null
     */
    public function getDateupdate()
    {
        return $this->dateupdate;
    }

    /**
     * Set dossier.
     *
     * @param \App\Entity\Dossier|null $dossier
     *
     * @return ListeDiffusion
     */
    public function setDossier(\App\Entity\Dossier $dossier = null)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier.
     *
     * @return \App\Entity\Dossier|null
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Set entreprise.
     *
     * @param \App\Entity\Entreprise|null $entreprise
     *
     * @return ListeDiffusion
     */
    public function setEntreprise(\App\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise.
     *
     * @return \App\Entity\Entreprise|null
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set contact.
     *
     * @param \App\Entity\Contact|null $contact
     *
     * @return ListeDiffusion
     */
    public function setContact(\App\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact.
     *
     * @return \App\Entity\Contact|null
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set quiinsert.
     *
     * @param \App\Entity\User|null $quiinsert
     *
     * @return ListeDiffusion
     */
    public function setQuiinsert(\App\Entity\User $quiinsert = null)
    {
        $this->quiinsert = $quiinsert;

        return $this;
    }

    /**
     * Get quiinsert.
     *
     * @return \App\Entity\User|null
     */
    public function getQuiinsert()
    {
        return $this->quiinsert;
    }

    /**
     * Set quiupdate.
     *
     * @param \App\Entity\User|null $quiupdate
     *
     * @return ListeDiffusion
     */
    public function setQuiupdate(\App\Entity\User $quiupdate = null)
    {
        $this->quiupdate = $quiupdate;

        return $this;
    }

    /**
     * Get quiupdate.
     *
     * @return \App\Entity\User|null
     */
    public function getQuiupdate()
    {
        return $this->quiupdate;
    }
}
