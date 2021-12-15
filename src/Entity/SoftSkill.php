<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SoftSkill
 *
 * @ORM\Table(name="softskill")
 * @ORM\Entity(repositoryClass="App\Repository\SoftSkillRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class SoftSkill {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cursus", inversedBy="softskills",cascade={"persist"})
     */
    private $cursus;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $softskill;

    /**
    * @ORM\Column(type="decimal", precision=3, scale=2, nullable=true)
    */
    private $note;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User")
    */
    private $quievalue;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $sourceeval;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Sessionevenement")
    */
    private $sessionevenement;

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
     * Set note.
     *
     * @param string|null $note
     *
     * @return SoftSkill
     */
    public function setNote($note = null)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note.
     *
     * @return string|null
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return SoftSkill
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
     * @return SoftSkill
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
     * Set cursus.
     *
     * @param \App\Entity\Cursus|null $cursus
     *
     * @return SoftSkill
     */
    public function setCursus(\App\Entity\Cursus $cursus = null)
    {
        $this->cursus = $cursus;

        return $this;
    }

    /**
     * Get cursus.
     *
     * @return \App\Entity\Cursus|null
     */
    public function getCursus()
    {
        return $this->cursus;
    }

    /**
     * Set softskill.
     *
     * @param \App\Entity\Masterlistelg|null $softskill
     *
     * @return SoftSkill
     */
    public function setSoftskill(\App\Entity\Masterlistelg $softskill = null)
    {
        $this->softskill = $softskill;

        return $this;
    }

    /**
     * Get softskill.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getSoftskill()
    {
        return $this->softskill;
    }

    /**
     * Set quievalue.
     *
     * @param \App\Entity\User|null $quievalue
     *
     * @return SoftSkill
     */
    public function setQuievalue(\App\Entity\User $quievalue = null)
    {
        $this->quievalue = $quievalue;

        return $this;
    }

    /**
     * Get quievalue.
     *
     * @return \App\Entity\User|null
     */
    public function getQuievalue()
    {
        return $this->quievalue;
    }

    /**
     * Set sourceeval.
     *
     * @param \App\Entity\Masterlistelg|null $sourceeval
     *
     * @return SoftSkill
     */
    public function setSourceeval(\App\Entity\Masterlistelg $sourceeval = null)
    {
        $this->sourceeval = $sourceeval;

        return $this;
    }

    /**
     * Get sourceeval.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getSourceeval()
    {
        return $this->sourceeval;
    }

    /**
     * Set sessionevenement.
     *
     * @param \App\Entity\Sessionevenement|null $sessionevenement
     *
     * @return SoftSkill
     */
    public function setSessionevenement(\App\Entity\Sessionevenement $sessionevenement = null)
    {
        $this->sessionevenement = $sessionevenement;

        return $this;
    }

    /**
     * Get sessionevenement.
     *
     * @return \App\Entity\Sessionevenement|null
     */
    public function getSessionevenement()
    {
        return $this->sessionevenement;
    }
}
