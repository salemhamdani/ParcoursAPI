<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * VrReunionParticipant
 *
 * @ORM\Table(name="vrreunionparticipants")
 * @ORM\Entity(repositoryClass="App\Repository\VrReunionParticipantRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class VrReunionParticipant
{

    /**
     * Constructor
     */
    public function __construct()
    {
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
	* @ORM\ManyToOne(targetEntity="App\Entity\VrReunion", inversedBy="participants")
	*/
	private $vrreunion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user_email;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $debut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Dossier")
	*/
	private $dossier;

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
     * @return int
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
     * Set username.
     *
     * @param string|null $username
     *
     * @return VrReunionParticipant
     */
    public function setUsername($username = null)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set userEmail.
     *
     * @param string|null $userEmail
     *
     * @return VrReunionParticipant
     */
    public function setUserEmail($userEmail = null)
    {
        $this->user_email = $userEmail;

        return $this;
    }

    /**
     * Get userEmail.
     *
     * @return string|null
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * Set debut.
     *
     * @param \DateTime|null $debut
     *
     * @return VrReunionParticipant
     */
    public function setDebut($debut = null)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut.
     *
     * @return \DateTime|null
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin.
     *
     * @param \DateTime|null $fin
     *
     * @return VrReunionParticipant
     */
    public function setFin($fin = null)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin.
     *
     * @return \DateTime|null
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set duree.
     *
     * @param int|null $duree
     *
     * @return VrReunionParticipant
     */
    public function setDuree($duree = null)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree.
     *
     * @return int|null
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return VrReunionParticipant
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
     * @return VrReunionParticipant
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
     * Set vrreunion.
     *
     * @param \App\Entity\VrReunion|null $vrreunion
     *
     * @return VrReunionParticipant
     */
    public function setVrreunion(\App\Entity\VrReunion $vrreunion = null)
    {
        $this->vrreunion = $vrreunion;

        return $this;
    }

    /**
     * Get vrreunion.
     *
     * @return \App\Entity\VrReunion|null
     */
    public function getVrreunion()
    {
        return $this->vrreunion;
    }

    /**
     * Set quiinsert.
     *
     * @param \App\Entity\User|null $quiinsert
     *
     * @return VrReunionParticipant
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
     * @return VrReunionParticipant
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

    /**
     * Set dossier.
     *
     * @param \App\Entity\Dossier|null $dossier
     *
     * @return VrReunionParticipant
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
}
