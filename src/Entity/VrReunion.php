<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Salle
 *
 * @ORM\Table(name="vrreunions")
 * @ORM\Entity(repositoryClass="App\Repository\VrReunionRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class VrReunion
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->participants = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $uuid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $uid;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Salle", inversedBy="vrreunions")
	*/
	private $salle;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionSalle", inversedBy="vrreunions")
	*/
	private $sessionsalle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $topic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $host;

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbparticipants;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $emargement;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\VrReunionParticipant", mappedBy="vrreunion", orphanRemoval=true, cascade={"persist"})
    */
    private $participants;

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
     * Set uuid.
     *
     * @param string|null $uuid
     *
     * @return VrReunion
     */
    public function setUuid($uuid = null)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid.
     *
     * @return string|null
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set uid.
     *
     * @param string|null $uid
     *
     * @return VrReunion
     */
    public function setUid($uid = null)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid.
     *
     * @return string|null
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set topic.
     *
     * @param string|null $topic
     *
     * @return VrReunion
     */
    public function setTopic($topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic.
     *
     * @return string|null
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set host.
     *
     * @param string|null $host
     *
     * @return VrReunion
     */
    public function setHost($host = null)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host.
     *
     * @return string|null
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set debut.
     *
     * @param \DateTime|null $debut
     *
     * @return VrReunion
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
     * @return VrReunion
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
     * Set nbparticipants.
     *
     * @param int|null $nbparticipants
     *
     * @return VrReunion
     */
    public function setNbparticipants($nbparticipants = null)
    {
        $this->nbparticipants = $nbparticipants;

        return $this;
    }

    /**
     * Get nbparticipants.
     *
     * @return int|null
     */
    public function getNbparticipants()
    {
        return $this->nbparticipants;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return VrReunion
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
     * @return VrReunion
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
     * Set salle.
     *
     * @param \App\Entity\Salle|null $salle
     *
     * @return VrReunion
     */
    public function setSalle(\App\Entity\Salle $salle = null)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle.
     *
     * @return \App\Entity\Salle|null
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * Set quiinsert.
     *
     * @param \App\Entity\User|null $quiinsert
     *
     * @return VrReunion
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
     * @return VrReunion
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
     * Set duree.
     *
     * @param int|null $duree
     *
     * @return VrReunion
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
     * Add participant.
     *
     * @param \App\Entity\VrReunionParticipant $participant
     *
     * @return VrReunion
     */
    public function addParticipant(\App\Entity\VrReunionParticipant $participant)
    {
        $this->participants[] = $participant;
		$participant->setVrreunion($this);
        return $this;
    }

    /**
     * Remove participant.
     *
     * @param \App\Entity\VrReunionParticipant $participant
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeParticipant(\App\Entity\VrReunionParticipant $participant)
    {
        return $this->participants->removeElement($participant);
    }

    /**
     * Get participants.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * Set emargement.
     *
     * @param bool|null $emargement
     *
     * @return VrReunion
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
     * Set sessionsalle.
     *
     * @param \App\Entity\SessionSalle|null $sessionsalle
     *
     * @return VrReunion
     */
    public function setSessionsalle(\App\Entity\SessionSalle $sessionsalle = null)
    {
        $this->sessionsalle = $sessionsalle;

        return $this;
    }

    /**
     * Get sessionsalle.
     *
     * @return \App\Entity\SessionSalle|null
     */
    public function getSessionsalle()
    {
        return $this->sessionsalle;
    }
}
