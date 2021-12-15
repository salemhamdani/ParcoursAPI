<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * SessionParcoursBlocCompetence
 *
 * @ORM\Table(name="session_parcours_bloc_competences")
 * @ORM\Entity(repositoryClass="App\Repository\SessionParcoursBlocCompetenceRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionParcoursBlocCompetence
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\BlocCompetence", inversedBy="sessionparcoursbloccompetences")
	*/
	private $bloccompetence;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionDossier", inversedBy="sessionparcoursbloccompetences")
	*/
	private $sessiondossier;


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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return SessionParcoursBlocCompetence
     */
    public function setDateinsert($dateinsert)
    {
        $this->dateinsert = $dateinsert;

        return $this;
    }

    /**
     * Get dateinsert
     *
     * @return \DateTime
     */
    public function getDateinsert()
    {
        return $this->dateinsert;
    }

    /**
     * Set dateupdate
     *
     * @param \DateTime $dateupdate
     *
     * @return SessionParcoursBlocCompetence
     */
    public function setDateupdate($dateupdate)
    {
        $this->dateupdate = $dateupdate;

        return $this;
    }

    /**
     * Get dateupdate
     *
     * @return \DateTime
     */
    public function getDateupdate()
    {
        return $this->dateupdate;
    }

    /**
     * Set bloccompetence
     *
     * @param \App\Entity\BlocCompetence $bloccompetence
     *
     * @return SessionParcoursBlocCompetence
     */
    public function setBloccompetence(\App\Entity\BlocCompetence $bloccompetence = null)
    {
        $this->bloccompetence = $bloccompetence;

        return $this;
    }

    /**
     * Get bloccompetence
     *
     * @return \App\Entity\BlocCompetence
     */
    public function getBloccompetence()
    {
        return $this->bloccompetence;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionParcoursBlocCompetence
     */
    public function setQuiinsert(\App\Entity\User $quiinsert = null)
    {
        $this->quiinsert = $quiinsert;

        return $this;
    }

    /**
     * Get quiinsert
     *
     * @return \App\Entity\User
     */
    public function getQuiinsert()
    {
        return $this->quiinsert;
    }

    /**
     * Set quiupdate
     *
     * @param \App\Entity\User $quiupdate
     *
     * @return SessionParcoursBlocCompetence
     */
    public function setQuiupdate(\App\Entity\User $quiupdate = null)
    {
        $this->quiupdate = $quiupdate;

        return $this;
    }

    /**
     * Get quiupdate
     *
     * @return \App\Entity\User
     */
    public function getQuiupdate()
    {
        return $this->quiupdate;
    }

    /**
     * Set sessiondossier
     *
     * @param \App\Entity\SessionDossier $sessiondossier
     *
     * @return SessionParcoursBlocCompetence
     */
    public function setSessiondossier(\App\Entity\SessionDossier $sessiondossier = null)
    {
        $this->sessiondossier = $sessiondossier;


        return $this;
    }

    /**
     * Get sessiondossier
     *
     * @return \App\Entity\SessionDossier
     */
    public function getSessiondossier()
    {
        return $this->sessiondossier;
    }
}
