<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CursusReponse
 *
 * @ORM\Table(name="CursusReponse")
 * @ORM\Entity(repositoryClass="App\Repository\CursusReponseRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CursusReponse {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CursusSelection", inversedBy="reponse",cascade={"persist"})
     */
    private $cursusselection;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CursusFinanceur", inversedBy="reponse",cascade={"persist"})
     */
    private $cursusfinanceur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CursusQuestions",cascade={"persist"})
     */
    private $cursusquestions;

    /**
    * @ORM\Column(type="decimal", precision=3, scale=2, nullable=true)
    */
    private $note;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $bool;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=65, nullable=true)
     */
    private $reponse;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User")
    */
    private $quievalue;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $sourceeval;

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
     * @return CursusReponse
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
     * @return CursusReponse
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
     * @return CursusReponse
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
     * Set cursusselection.
     *
     * @param \App\Entity\Cursusselection|null $cursusselection
     *
     * @return CursusReponse
     */
    public function setCursusselection(\App\Entity\Cursusselection $cursusselection = null)
    {
        $this->cursusselection = $cursusselection;

        return $this;
    }

    /**
     * Get cursusselection.
     *
     * @return \App\Entity\Cursusselection|null
     */
    public function getCursusselection()
    {
        return $this->cursusselection;
    }



    /**
     * Set cursusfinanceur.
     *
     * @param \App\Entity\Cursusfinanceur|null $cursusfinanceur
     *
     * @return CursusReponse
     */
    public function setCursusfinanceur(\App\Entity\Cursusfinanceur $cursusfinanceur = null)
    {
        $this->cursusfinanceur = $cursusfinanceur;

        return $this;
    }

    /**
     * Get cursusfinanceur.
     *
     * @return \App\Entity\Cursusfinanceur|null
     */
    public function getCursusfinanceur()
    {
        return $this->cursusfinanceur;
    }
    
    /**
     * Set cursusquestions.
     *
     * @param \App\Entity\CursusQuestions|null $questions
     *
     * @return CursusReponse
     */
    public function setCursusQuestions(\App\Entity\CursusQuestions $cursusquestions = null)
    {
        $this->cursusquestions = $cursusquestions;

        return $this;
    }

    /**
     * Get cursusquestions.
     *
     * @return \App\Entity\CursusQuestions|null
     */
    public function getCursusQuestions()
    {
        return $this->cursusquestions;
    }

    /**
     * Set reponse.
     *
     * @param string|null $reponse
     *
     * @return CursusReponse
     */
    public function setReponse($reponse = null)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse.
     *
     * @return string|null
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set bool
     *
     * @param boolean $bool
     *
     * @return CursusReponse
     */
    public function setBool($bool)
    {
        $this->bool = $bool;

        return $this;
    }

    /**
     * Get archive
     *
     * @return boolean
     */
    public function getBool()
    {
        return $this->bool;
    }
}
